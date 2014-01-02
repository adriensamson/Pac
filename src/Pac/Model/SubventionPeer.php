<?php

namespace Pac\Model;

use Pac\Model\om\BaseSubventionPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'subvention' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Pac.Model
 */
class SubventionPeer extends BaseSubventionPeer
{
    /**
     * Retrieve biggest amount by year
     *
     * @param integer $year
     * @param integer $limit
     *
     * @return \PropelObjectCollection
     */
    static public function retrieveBiggestAmountByYear($year, $limit = 10)
    {
        return SubventionQuery::create()
            ->filterByYear($year)
            ->orderByAmount(\Criteria::DESC)
            ->limit($limit)
            ->find();
    }

    /**
     * Retrieve biggest growth amount by year
     *
     * @param integer $year
     * @param integer $limit
     *
     * @return \PropelObjectCollection
     */
    static public function retrieveBiggestGrowthAmountByYear($year, $limit = 10)
    {
        return SubventionQuery::create()
            ->filterByYear($year)
            ->orderByGrowthAmount(\Criteria::DESC)
            ->limit($limit)
            ->find();
    }

    /**
     * Retrieve biggest growth percent by year
     *
     * @param integer $year
     * @param integer $limit
     *
     * @return \PropelObjectCollection
     */
    static public function retrieveBiggestGrowthPercentByYear($year, $limit = 10)
    {
        return SubventionQuery::create()
            ->filterByYear($year)
            ->orderByGrowthPercent(\Criteria::DESC)
            ->limit($limit)
            ->find();
    }

    /**
     * Retrieve amount by year and zipcode
     *
     * @param integer $year
     * @param integer $zipcode
     * @param integer $limit
     *
     * @return \PropelObjectCollection
     */
    static public function retrieveAmountByYearAndZipcode($year, $zipcode, $limit = 10)
    {
        return SubventionQuery::create()
            ->filterByYear($year)
            ->useCompanyQuery()
                ->filterByZipcode($zipcode)
            ->endUse()
            ->orderByAmount(\Criteria::DESC)
            ->limit($limit)
            ->find();
    }

    /**
     * Retrieve amount sum by year and zipcode
     *
     * @param integer $year
     * @param integer $zipcode
     * @param integer $limit
     *
     * @return \PropelObjectCollection
     */
    static public function retrieveAmountSumByYearAndZipcode($year, $zipcode, $limit = 10)
    {
        return SubventionQuery::create()
            ->withColumn('SUM('.SubventionPeer::AMOUNT.')', 'Sum')
            ->filterByYear($year)
            ->useCompanyQuery()
                ->filterByZipcode($zipcode)
            ->endUse()
            ->limit($limit)
            ->select(array('Sum'))
            ->findOne();
    }

    static public function retrieveNextSubventionsFromZipcodeAndYear($year, $zipcode, $limit)
    {
        $upLimit = floor($zipcode / 1000) * 1000 + 1000;

        return SubventionQuery::create()
            ->filterByYear($year)
            ->useCompanyQuery()
                ->filterByZipcode($zipcode, \Criteria::GREATER_THAN)
                ->filterByZipcode($upLimit, \Criteria::LESS_THAN)
                ->orderByZipcode(\Criteria::ASC)
                ->groupBy(CompanyPeer::ZIPCODE)
            ->endUse()
            ->limit($limit)
            ->find();

        return iterator_to_array($subventions);
    }

    static public function retrievePreviousSubventionsFromZipcodeAndYear($year, $zipcode, $limit)
    {
        $upLimit = floor($zipcode / 1000) * 1000;

        $subventions = SubventionQuery::create()
            ->filterByYear($year)
            ->useCompanyQuery()
                ->filterByZipcode($zipcode, \Criteria::LESS_THAN)
                ->filterByZipcode($upLimit, \Criteria::GREATER_EQUAL)
                ->orderByZipcode(\Criteria::DESC)
                ->groupBy(CompanyPeer::ZIPCODE)
            ->endUse()
            ->limit($limit)
            ->find();

        return array_reverse(iterator_to_array($subventions));
    }
}
