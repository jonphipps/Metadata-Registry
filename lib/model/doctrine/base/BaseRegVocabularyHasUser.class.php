<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRegVocabularyHasUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reg_vocabulary_has_user');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('updated_at', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('vocabulary_id', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('is_maintainer_for', 'integer', 1, array('type' => 'integer', 'default' => '1', 'length' => '1'));
        $this->hasColumn('is_registrar_for', 'integer', 1, array('type' => 'integer', 'default' => '1', 'length' => '1'));
        $this->hasColumn('is_admin_for', 'integer', 1, array('type' => 'integer', 'default' => '1', 'length' => '1'));
        $this->hasColumn('created_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('deleted_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
    }

    public function setUp()
    {
        $this->hasOne('RegUser', array('local' => 'user_id',
                                       'foreign' => 'id'));

        $this->hasOne('RegVocabulary', array('local' => 'vocabulary_id',
                                             'foreign' => 'id'));
    }
}