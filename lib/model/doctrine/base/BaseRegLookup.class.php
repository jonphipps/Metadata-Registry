<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRegLookup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reg_lookup');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('short_value', 'string', 20, array('type' => 'string', 'fixed' => 1, 'length' => '20'));
        $this->hasColumn('type_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('long_value', 'string', 255, array('type' => 'string', 'length' => '255'));
        $this->hasColumn('display_order', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasMany('RegConceptProperty', array('local' => 'id',
                                                   'foreign' => 'status_id'));
    }
}