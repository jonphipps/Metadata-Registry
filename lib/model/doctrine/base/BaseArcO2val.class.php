<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseArcO2val extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('arc_o2val');
        $this->hasColumn('id', 'integer', 3, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'length' => '3'));
        $this->hasColumn('cid', 'integer', 3, array('type' => 'integer', 'unsigned' => '1', 'default' => '', 'notnull' => true, 'length' => '3'));
        $this->hasColumn('misc', 'integer', 1, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('val', 'string', 2147483647, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '2147483647'));
    }

}