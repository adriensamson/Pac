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
use Pac\Model\Product;
use Pac\Model\Purchase;
use Pac\Model\PurchasePeer;
use Pac\Model\PurchaseQuery;
use Pac\Model\User;

/**
 * Base class that represents a query for the 'purchase' table.
 *
 *
 *
 * @method PurchaseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PurchaseQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method PurchaseQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method PurchaseQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method PurchaseQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method PurchaseQuery orderByPaypalCallback($order = Criteria::ASC) Order by the paypal_callback column
 * @method PurchaseQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method PurchaseQuery orderByGenerationDate($order = Criteria::ASC) Order by the generation_date column
 * @method PurchaseQuery orderByTotalDownloadCount($order = Criteria::ASC) Order by the total_download_count column
 * @method PurchaseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PurchaseQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PurchaseQuery groupById() Group by the id column
 * @method PurchaseQuery groupByUserId() Group by the user_id column
 * @method PurchaseQuery groupByProductId() Group by the product_id column
 * @method PurchaseQuery groupByState() Group by the state column
 * @method PurchaseQuery groupByAmount() Group by the amount column
 * @method PurchaseQuery groupByPaypalCallback() Group by the paypal_callback column
 * @method PurchaseQuery groupByVersion() Group by the version column
 * @method PurchaseQuery groupByGenerationDate() Group by the generation_date column
 * @method PurchaseQuery groupByTotalDownloadCount() Group by the total_download_count column
 * @method PurchaseQuery groupByCreatedAt() Group by the created_at column
 * @method PurchaseQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PurchaseQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method PurchaseQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method PurchaseQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method PurchaseQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method PurchaseQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method PurchaseQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method Purchase findOne(PropelPDO $con = null) Return the first Purchase matching the query
 * @method Purchase findOneOrCreate(PropelPDO $con = null) Return the first Purchase matching the query, or a new Purchase object populated from the query conditions when no match is found
 *
 * @method Purchase findOneByUserId(int $user_id) Return the first Purchase filtered by the user_id column
 * @method Purchase findOneByProductId(int $product_id) Return the first Purchase filtered by the product_id column
 * @method Purchase findOneByState(int $state) Return the first Purchase filtered by the state column
 * @method Purchase findOneByAmount(double $amount) Return the first Purchase filtered by the amount column
 * @method Purchase findOneByPaypalCallback(string $paypal_callback) Return the first Purchase filtered by the paypal_callback column
 * @method Purchase findOneByVersion(string $version) Return the first Purchase filtered by the version column
 * @method Purchase findOneByGenerationDate(string $generation_date) Return the first Purchase filtered by the generation_date column
 * @method Purchase findOneByTotalDownloadCount(int $total_download_count) Return the first Purchase filtered by the total_download_count column
 * @method Purchase findOneByCreatedAt(string $created_at) Return the first Purchase filtered by the created_at column
 * @method Purchase findOneByUpdatedAt(string $updated_at) Return the first Purchase filtered by the updated_at column
 *
 * @method array findById(int $id) Return Purchase objects filtered by the id column
 * @method array findByUserId(int $user_id) Return Purchase objects filtered by the user_id column
 * @method array findByProductId(int $product_id) Return Purchase objects filtered by the product_id column
 * @method array findByState(int $state) Return Purchase objects filtered by the state column
 * @method array findByAmount(double $amount) Return Purchase objects filtered by the amount column
 * @method array findByPaypalCallback(string $paypal_callback) Return Purchase objects filtered by the paypal_callback column
 * @method array findByVersion(string $version) Return Purchase objects filtered by the version column
 * @method array findByGenerationDate(string $generation_date) Return Purchase objects filtered by the generation_date column
 * @method array findByTotalDownloadCount(int $total_download_count) Return Purchase objects filtered by the total_download_count column
 * @method array findByCreatedAt(string $created_at) Return Purchase objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Purchase objects filtered by the updated_at column
 *
 * @package    propel.generator.Pac.Model.om
 */
abstract class BasePurchaseQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePurchaseQuery object.
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
            $modelName = 'Pac\\Model\\Purchase';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PurchaseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PurchaseQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PurchaseQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PurchaseQuery) {
            return $criteria;
        }
        $query = new PurchaseQuery(null, null, $modelAlias);

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
     * @return   Purchase|Purchase[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PurchasePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Purchase A model object, or null if the key is not found
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
     * @return                 Purchase A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `user_id`, `product_id`, `state`, `amount`, `paypal_callback`, `version`, `generation_date`, `total_download_count`, `created_at`, `updated_at` FROM `purchase` WHERE `id` = :p0';
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
            $obj = new Purchase();
            $obj->hydrate($row);
            PurchasePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Purchase|Purchase[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Purchase[]|mixed the list of results, formatted by the current formatter
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PurchasePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PurchasePeer::ID, $keys, Criteria::IN);
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PurchasePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PurchasePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id >= 12
     * $query->filterByUserId(array('max' => 12)); // WHERE user_id <= 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(PurchasePeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(PurchasePeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id >= 12
     * $query->filterByProductId(array('max' => 12)); // WHERE product_id <= 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(PurchasePeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(PurchasePeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * @param     mixed $state The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (is_scalar($state)) {
            $state = PurchasePeer::getSqlValueForEnum(PurchasePeer::STATE, $state);
        } elseif (is_array($state)) {
            $convertedValues = array();
            foreach ($state as $value) {
                $convertedValues[] = PurchasePeer::getSqlValueForEnum(PurchasePeer::STATE, $value);
            }
            $state = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::STATE, $state, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount >= 12
     * $query->filterByAmount(array('max' => 12)); // WHERE amount <= 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(PurchasePeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(PurchasePeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the paypal_callback column
     *
     * Example usage:
     * <code>
     * $query->filterByPaypalCallback('fooValue');   // WHERE paypal_callback = 'fooValue'
     * $query->filterByPaypalCallback('%fooValue%'); // WHERE paypal_callback LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paypalCallback The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPaypalCallback($paypalCallback = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paypalCallback)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $paypalCallback)) {
                $paypalCallback = str_replace('*', '%', $paypalCallback);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PAYPAL_CALLBACK, $paypalCallback, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion('fooValue');   // WHERE version = 'fooValue'
     * $query->filterByVersion('%fooValue%'); // WHERE version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $version The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($version)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $version)) {
                $version = str_replace('*', '%', $version);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PurchasePeer::VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the generation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByGenerationDate('2011-03-14'); // WHERE generation_date = '2011-03-14'
     * $query->filterByGenerationDate('now'); // WHERE generation_date = '2011-03-14'
     * $query->filterByGenerationDate(array('max' => 'yesterday')); // WHERE generation_date < '2011-03-13'
     * </code>
     *
     * @param     mixed $generationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByGenerationDate($generationDate = null, $comparison = null)
    {
        if (is_array($generationDate)) {
            $useMinMax = false;
            if (isset($generationDate['min'])) {
                $this->addUsingAlias(PurchasePeer::GENERATION_DATE, $generationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($generationDate['max'])) {
                $this->addUsingAlias(PurchasePeer::GENERATION_DATE, $generationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::GENERATION_DATE, $generationDate, $comparison);
    }

    /**
     * Filter the query on the total_download_count column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalDownloadCount(1234); // WHERE total_download_count = 1234
     * $query->filterByTotalDownloadCount(array(12, 34)); // WHERE total_download_count IN (12, 34)
     * $query->filterByTotalDownloadCount(array('min' => 12)); // WHERE total_download_count >= 12
     * $query->filterByTotalDownloadCount(array('max' => 12)); // WHERE total_download_count <= 12
     * </code>
     *
     * @param     mixed $totalDownloadCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByTotalDownloadCount($totalDownloadCount = null, $comparison = null)
    {
        if (is_array($totalDownloadCount)) {
            $useMinMax = false;
            if (isset($totalDownloadCount['min'])) {
                $this->addUsingAlias(PurchasePeer::TOTAL_DOWNLOAD_COUNT, $totalDownloadCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalDownloadCount['max'])) {
                $this->addUsingAlias(PurchasePeer::TOTAL_DOWNLOAD_COUNT, $totalDownloadCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::TOTAL_DOWNLOAD_COUNT, $totalDownloadCount, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PurchasePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PurchasePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PurchasePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PurchasePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PurchaseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(PurchasePeer::USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Pac\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Pac\Model\UserQuery');
    }

    /**
     * Filter the query by a related Product object
     *
     * @param   Product|PropelObjectCollection $product The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PurchaseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof Product) {
            return $this
                ->addUsingAlias(PurchasePeer::PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type Product or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Pac\Model\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Pac\Model\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Purchase $purchase Object to remove from the list of results
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function prune($purchase = null)
    {
        if ($purchase) {
            $this->addUsingAlias(PurchasePeer::ID, $purchase->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PurchasePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PurchasePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PurchasePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PurchasePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PurchasePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PurchaseQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PurchasePeer::CREATED_AT);
    }
}
