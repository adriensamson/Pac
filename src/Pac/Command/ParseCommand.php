<?php

/*
 * This file is part of the c2is/silex-bootstrap.
 *
 * (c) Morgan Brunot <brunot.morgan@gmail.com>
 */

namespace Pac\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use EasyCSV\Reader as CSVReader;

use Pac\Model\Company;
use Pac\Model\CompanyQuery;
use Pac\Model\Subvention;
use Pac\Model\SubventionQuery;

class ParseCommand extends Command
{
    const COMPANY_NAME      = "NOM PRENOM OU RAISON SOCIALE";
    const COMPANY_CITY      = "LIBELLE DE LA COMMUNE DE RESIDENCE";
    const COMPANY_ZIPCODE   = "CODE POSTAL DE LA COMMUNE DE RESIDENCE";
    const SUBVENTION_AMOUNT = "MONTANT TOTAL";

    protected function configure()
    {
        $this
            ->setName('parse')
            ->setDescription('Parse open data pac file')
            ->addArgument('year', InputArgument::REQUIRED, 'Year')
            ->addArgument('file', InputArgument::OPTIONAL, 'Open data csv pac file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year    = $input->getArgument('year');
        $csvFile = $input->getArgument('file');

        if (!in_array($year, array(2010, 2011, 2012))) {
            throw new \Exception("Only year 2010, 2011 and 2013 are supported");
        }

        if (!$csvFile) {
            $csvFile = sprintf("app/resources/%s.txt", $year);
        }

        if (!file_exists($csvFile)) {
            throw new \Exception(sprintf("CSV file %s does not exists", $csvFile));
        }

        $reader = new CSVReader($csvFile);
        $reader->setDelimiter(';');

        // remove all subvention by current year
        SubventionQuery::create()
            ->findByYear($year)
            ->delete();

        while ($row = $reader->getRow()) {
            // prepare new subvention
            $subvention = new Subvention();
            $subvention
                ->setYear($year)
                ->setAmount($row[self::SUBVENTION_AMOUNT]);

            // find company
            $company = CompanyQuery::create()
                ->filterByName($row[self::COMPANY_NAME])
                ->filterByZipcode($row[self::COMPANY_ZIPCODE])
                ->findOne();

            // check if company already exists
            if (!$company) {
                $company = new Company();
                $company
                    ->setName($row[self::COMPANY_NAME])
                    ->setCity($row[self::COMPANY_CITY])
                    ->setZipcode($row[self::COMPANY_ZIPCODE])
                    ->save();
            } else {
                // find last subvention
                $lastSubvention = SubventionQuery::create()
                    ->filterByCompanyId($company->getId())
                    ->filterByYear($year - 1)
                    ->findOne();

                if ($lastSubvention) {
                    $growthAmount  = $row[self::SUBVENTION_AMOUNT] - $lastSubvention->getAmount();
                    $growthPercent = $growthAmount / $lastSubvention->getAmount() * 100;

                    $subvention
                        ->setGrowthAmount($growthAmount)
                        ->setGrowthPercent(round($growthPercent, 1));
                }
            }

            // save subvention
            $subvention->save();

            // adding new subvention
            $company
                ->addSubvention($subvention)
                ->save();

            $output->writeln(sprintf("line %d : %s %s (%s)", $reader->getLineNumber(), $company->getZipcode(), $company->getName(), $subvention->getGrowthPercent()));
        }

        return true;
    }
}
