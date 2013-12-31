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
    const COMPANY_NAME        = "NOM PRENOM OU RAISON SOCIALE";
    const COMPANY_CITY        = "LIBELLE DE LA COMMUNE DE RESIDENCE";
    const COMPANY_POSTAL_CODE = "CODE POSTAL DE LA COMMUNE DE RESIDENCE";
    const SUBVENTION_AMOUNT        = "MONTANT TOTAL";

    protected function configure()
    {
        $this
            ->setName('parse')
            ->setDescription('Parse open data pac file')
            ->addArgument('year', InputArgument::REQUIRED, 'Year')
            ->addArgument('file', InputArgument::REQUIRED, 'Open data csv pac file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year    = $input->getArgument('year');
        $csvFile = $input->getArgument('file');

        if (!file_exists($csvFile)) {
            throw new \Exception(sprintf("CSV file %s does not exists", $csvFile));
        }

        $reader = new CSVReader($csvFile);
        $reader->setDelimiter(';');

        // remove all grant by current year
        $grantRowsToDelete = SubventionQuery::create()
            ->findByYear($year)
            ->delete();

        while ($row = $reader->getRow()) {
            $company = CompanyQuery::create()
                ->filterByName($row[self::COMPANY_NAME])
                ->findOne();

            // check if company already exists
            if (!$company) {
                $company = new Company();
                $company
                    ->setName($row[self::COMPANY_NAME])
                    ->setCity($row[self::COMPANY_CITY])
                    ->setPostalCode($row[self::COMPANY_POSTAL_CODE])
                    ->save();
            }

            // create new grant
            $grant = new Subvention();
            $grant
                ->setYear($year)
                ->setAmount($row[self::SUBVENTION_AMOUNT]);

            // adding new grant
            $company
                ->addSubvention($grant)
                ->save();

            $output->writeln(sprintf("line %d : %s", $reader->getLineNumber(), $company->getName()));
        }

        return true;
    }
}
