<?php

namespace Pac\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Pac\Model\Company;
use Pac\Model\CompanyPeer;
use Pac\Model\CompanyQuery;
use Pac\Model\Subvention;

/**
 * Base class that represents a query for the 'company' table.
 *
 *
 *
 * @method CompanyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CompanyQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method CompanyQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method CompanyQuery orderByPostalCode($order = Criteria::ASC) Order by the postal_code column
 *
 * @method CompanyQuery groupById() Group by the id column
 * @method CompanyQuery groupByName() Group by the name column
 * @method CompanyQuery groupByCity() Group by the city column
 * @method CompanyQuery groupByPostalCode() Group by the postal_code column
 *
 * @method CompanyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CompanyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CompanyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CompanyQuery leftJoinSubvention($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subvention relation
 * @method CompanyQuery rightJoinSubvention($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subvention relation
 * @method CompanyQuery innerJoinSubvention($relationAlias = null) Adds a INNER JOIN clause to the query using the Subvention relation
 *
 * @method Company findOne(PropelPDO $con = null) Return the first Company matching the query
 * @method Company findOneOrCreate(PropelPDO $con = null) Return the first Company matching the query, or a new Company object populated from the query conditions when no match is found
 *
 * @method Company findOneByName(string $name) Return the first Company filtered by the name column
 * @method Company findOneByCity(string $city) Return the first Company filtered by the city column
 * @method Company findOneByPostalCode(int $postal_code) Return the first Company filtered by the postal_code column
 *
 * @method array findById(int $id) Return Company objects filtered by the id column
 * @method array findByName(string $name) Return Company objects filtered by the name column
 * @method array findByCity(string $city) Return Company objects filtered by the city column
 * @method array findByPostalCode(int $postal_code) Return Company objects filtered by the postal_code column
 *
 * @package    propel.generator.Pac.Model.om
 */
abstract class BaseCompanyQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCompanyQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'pac';
        }
        if (null === $modelName) {
            $modelName = 'Pac\\Model\\Company';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CompanyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CompanyQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CompanyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CompanyQuery) {
            return $criteria;
        }
        $query = new CompanyQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Company|Company[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CompanyPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CompanyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Company A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Company A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `city`, `postal_code` FROM `company` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Company();
            $obj->hydrate($row);
            CompanyPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Company|Company[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Company[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CompanyPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CompanyPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CompanyPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompanyPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CompanyPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CompanyPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the postal_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCode(1234); // WHERE postal_code = 1234
     * $query->filterByPostalCode(array(12, 34)); // WHERE postal_code IN (12, 34)
     * $query->filterByPostalCode(array('min' => 12)); // WHERE postal_code >= 12
     * $query->filterByPostalCode(array('max' => 12)); // WHERE postal_code <= 12
     * </code>
     *
     * @param     mixed $postalCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function filterByPostalCode($postalCode = null, $comparison = null)
    {
        if (is_array($postalCode)) {
            $useMinMax = false;
            if (isset($postalCode['min'])) {
                $this->addUsingAlias(CompanyPeer::POSTAL_CODE, $postalCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postalCode['max'])) {
                $this->addUsingAlias(CompanyPeer::POSTAL_CODE, $postalCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompanyPeer::POSTAL_CODE, $postalCode, $comparison);
    }

    /**
     * Filter the query by a related Subvention object
     *
     * @param   Subvention|PropelObjectCollection $subvention  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CompanyQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySubvention($subvention, $comparison = null)
    {
        if ($subvention instanceof Subvention) {
            return $this
                ->addUsingAlias(CompanyPeer::ID, $subvention->getCompanyId(), $comparison);
        } elseif ($subvention instanceof PropelObjectCollection) {
            return $this
                ->useSubventionQuery()
                ->filterByPrimaryKeys($subvention->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySubvention() only accepts arguments of type Subvention or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subvention relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function joinSubvention($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subvention');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Subvention');
        }

        return $this;
    }

    /**
     * Use the Subvention relation Subvention object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Pac\Model\SubventionQuery A secondary query class using the current class as primary query
     */
    public function useSubventionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSubvention($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subvention', '\Pac\Model\SubventionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Company $company Object to remove from the list of results
     *
     * @return CompanyQuery The current query, for fluid interface
     */
    public function prune($company = null)
    {
        if ($company) {
            $this->addUsingAlias(CompanyPeer::ID, $company->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
