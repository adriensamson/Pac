<?php

namespace Pac\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'purchase' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Pac.Model.map
 */
class PurchaseTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Pac.Model.map.PurchaseTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('purchase');
        $this->setPhpName('Purchase');
        $this->setClassname('Pac\\Model\\Purchase');
        $this->setPackage('Pac.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'id', false, null, null);
        $this->addColumn('state', 'State', 'ENUM', false, null, 'done');
        $this->getColumn('state', false)->setValueSet(array (
  0 => 'done',
  1 => 'rejected',
  2 => 'undone',
));
        $this->addColumn('amount', 'Amount', 'DOUBLE', false, null, null);
        $this->addColumn('paypal_callback', 'PaypalCallback', 'VARCHAR', false, 255, null);
        $this->addColumn('version', 'Version', 'VARCHAR', false, 255, null);
        $this->addColumn('generation_date', 'GenerationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('total_download_count', 'TotalDownloadCount', 'INTEGER', false, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'Pac\\Model\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Product', 'Pac\\Model\\Product', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // PurchaseTableMap
