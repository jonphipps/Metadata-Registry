<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRegSchema extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reg_schema');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('agent_id', 'integer', 4, array('type' => 'integer', 'default' => '', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 255, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '255'));
        $this->hasColumn('uri', 'string', 255, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '255'));
        $this->hasColumn('base_domain', 'string', 255, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '255'));
        $this->hasColumn('token', 'string', 45, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '45'));
        $this->hasColumn('last_uri_id', 'integer', 4, array('type' => 'integer', 'default' => '100000', 'length' => '4'));
        $this->hasColumn('status_id', 'integer', 4, array('type' => 'integer', 'default' => '1', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('language', 'string', 6, array('type' => 'string', 'fixed' => 1, 'default' => 'en', 'notnull' => true, 'length' => '6'));
        $this->hasColumn('ns_type', 'string', 6, array('type' => 'string', 'fixed' => 1, 'default' => 'slash', 'notnull' => true, 'length' => '6'));
        $this->hasColumn('created_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('updated_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('deleted_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('created_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('updated_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('child_updated_at', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('child_updated_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('note', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
        $this->hasColumn('url', 'string', 255, array('type' => 'string', 'length' => '255'));
        $this->hasColumn('community', 'string', 45, array('type' => 'string', 'length' => '45'));
        $this->hasColumn('profile_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasOne('RegAgent', array('local' => 'agent_id',
                                        'foreign' => 'id'));

        $this->hasOne('RegUser', array('local' => 'created_user_id',
                                       'foreign' => 'id'));

        $this->hasOne('RegUser as RegUser_3', array('local' => 'updated_user_id',
                                                    'foreign' => 'id'));

        $this->hasOne('Profile', array('local' => 'profile_id',
                                       'foreign' => 'id'));

        $this->hasOne('RegStatus', array('local' => 'status_id',
                                         'foreign' => 'id'));

        $this->hasMany('ProfileProperty', array('local' => 'id',
                                                'foreign' => 'schema_id'));

        $this->hasMany('RegNamespace', array('local' => 'id',
                                             'foreign' => 'schema_id'));

        $this->hasMany('RegSchemaProperty', array('local' => 'id',
                                                  'foreign' => 'schema_id'));

        $this->hasMany('RegSchemaPropertyElementHistory', array('local' => 'id',
                                                                'foreign' => 'schema_id'));

        $this->hasMany('SchemaHasUser', array('local' => 'id',
                                              'foreign' => 'schema_id'));

        $this->hasMany('SchemaHasVersion', array('local' => 'id',
                                                 'foreign' => 'schema_id'));
    }
}