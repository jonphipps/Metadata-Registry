<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRegConceptProperty extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reg_concept_property');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('updated_at', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('concept_id', 'integer', 4, array('type' => 'integer', 'default' => '', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('skos_property_id', 'integer', 4, array('type' => 'integer', 'default' => '', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('object', 'string', 2147483647, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('language', 'string', 6, array('type' => 'string', 'fixed' => 1, 'default' => 'en', 'length' => '6'));
        $this->hasColumn('status_id', 'integer', 4, array('type' => 'integer', 'default' => '1', 'length' => '4'));
        $this->hasColumn('created_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('deleted_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('last_updated', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('created_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('updated_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('primary_pref_label', 'integer', 1, array('type' => 'integer', 'length' => '1'));
        $this->hasColumn('scheme_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('related_concept_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasOne('RegConcept', array('local' => 'concept_id',
                                          'foreign' => 'id'));

        $this->hasOne('RegSkosProperty', array('local' => 'skos_property_id',
                                               'foreign' => 'id'));

        $this->hasOne('RegVocabulary', array('local' => 'scheme_id',
                                             'foreign' => 'id'));

        $this->hasOne('RegLookup', array('local' => 'status_id',
                                         'foreign' => 'id'));

        $this->hasOne('RegConcept as RegConcept_5', array('local' => 'related_concept_id',
                                                          'foreign' => 'id'));

        $this->hasOne('RegUser', array('local' => 'created_user_id',
                                       'foreign' => 'id'));

        $this->hasOne('RegUser as RegUser_7', array('local' => 'updated_user_id',
                                                    'foreign' => 'id'));

        $this->hasMany('RegConceptPropertyHistory', array('local' => 'id',
                                                          'foreign' => 'concept_property_id'));
    }
}