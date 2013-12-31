<?php

namespace Pac\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'company' table.
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
class CompanyTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Pac.Model.map.CompanyTableMap';

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
        $this->setName('company');
        $this->setPhpName('Company');
        $this->setClassname('Pac\\Model\\Company');
        $this->setPackage('Pac.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->getColumn('name', false)->setPrimaryString(true);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('zipcode', 'Zipcode', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Subvention', 'Pac\\Model\\Subvention', RelationMap::ONE_TO_MANY, array('id' => 'company_id', ), 'CASCADE', null, 'Subventions');
    } // buildRelations()

} // CompanyTableMap
