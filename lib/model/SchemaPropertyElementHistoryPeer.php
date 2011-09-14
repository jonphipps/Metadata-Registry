<?php

/**
 * Subclass for performing query and update operations on the 'reg_schema_property_element_history' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElementHistoryPeer extends BaseSchemaPropertyElementHistoryPeer
{

  /**
   * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except SchemaPropertyRelatedByRelatedSchemaPropertyId.
   *
   * This is a corrected version of doSelectJoinAllExceptSchemaPropertyRelatedByRelatedSchemaPropertyId
   * that adds the schema property object onto the query
   * @return array Array of SchemaPropertyElementHistory objects.
   * @throws PropelException Any exceptions caught during processing will be
   *     rethrown wrapped into a PropelException.
   */
  public static function doSelectForList(Criteria $c, $con = null)
  {
    $c = clone $c;

    // Set the correct dbName if it has not been overridden
    // $c->getDbName() will return the same object if not set to another value
    // so == check is okay and faster
    if ($c->getDbName() == Propel::getDefaultDB()) {
      $c->setDbName(self::DATABASE_NAME);
    }

    SchemaPropertyElementHistoryPeer::addSelectColumns($c);
    $startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    UserPeer::addSelectColumns($c);
    $startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

    SchemaPropertyElementPeer::addSelectColumns($c);
    $startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

    SchemaPeer::addSelectColumns($c);
    $startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

    StatusPeer::addSelectColumns($c);
    $startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

    SchemaPropertyPeer::addSelectColumns($c);
    $startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

    $c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

    $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

    $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

    $c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

    $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = SchemaPropertyElementHistoryPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);

      $omClass = UserPeer::getOMClass();


      $cls = Propel::import($omClass);
      $obj2  = new $cls();
      $obj2->hydrate($rs, $startcol2);

      $newObject = true;
      for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
        $temp_obj1 = $results[$j];
        $temp_obj2 = $temp_obj1->getUser(); //CHECKME
        if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
          $newObject = false;
          $temp_obj2->addSchemaPropertyElementHistory($obj1);
          break;
        }
      }

      if ($newObject) {
        $obj2->initSchemaPropertyElementHistorys();
        $obj2->addSchemaPropertyElementHistory($obj1);
      }

      $omClass = SchemaPropertyElementPeer::getOMClass();


      $cls = Propel::import($omClass);
      $obj3  = new $cls();
      $obj3->hydrate($rs, $startcol3);

      $newObject = true;
      for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
        $temp_obj1 = $results[$j];
        $temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
        if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
          $newObject = false;
          $temp_obj3->addSchemaPropertyElementHistory($obj1);
          break;
        }
      }

      if ($newObject) {
        $obj3->initSchemaPropertyElementHistorys();
        $obj3->addSchemaPropertyElementHistory($obj1);
      }

      $omClass = SchemaPeer::getOMClass();


      $cls = Propel::import($omClass);
      $obj4  = new $cls();
      $obj4->hydrate($rs, $startcol4);

      $newObject = true;
      for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
        $temp_obj1 = $results[$j];
        $temp_obj4 = $temp_obj1->getSchema(); //CHECKME
        if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
          $newObject = false;
          $temp_obj4->addSchemaPropertyElementHistory($obj1);
          break;
        }
      }

      if ($newObject) {
        $obj4->initSchemaPropertyElementHistorys();
        $obj4->addSchemaPropertyElementHistory($obj1);
      }

      $omClass = StatusPeer::getOMClass();


      $cls = Propel::import($omClass);
      $obj5  = new $cls();
      $obj5->hydrate($rs, $startcol5);

      $newObject = true;
      for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
        $temp_obj1 = $results[$j];
        $temp_obj5 = $temp_obj1->getStatus(); //CHECKME
        if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
          $newObject = false;
          $temp_obj5->addSchemaPropertyElementHistory($obj1);
          break;
        }
      }

      if ($newObject) {
        $obj5->initSchemaPropertyElementHistorys();
        $obj5->addSchemaPropertyElementHistory($obj1);
      }

      $omClass = SchemaPropertyPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj6  = new $cls();
      $obj6->hydrate($rs, $startcol6);

      $newObject = true;
      for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
        $temp_obj1 = $results[$j];
        $temp_obj6 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
        if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
          $newObject = false;
          $temp_obj6->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
          break;
        }
      }

      if ($newObject) {
        $obj6->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
        $obj6->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
      }

      $results[] = $obj1;
    }
    return $results;
  }

  /**
  * Gets the last update for a domain
  *
  * @return mixed Either a date string or a time integer
  * @param  string $domain
  * @param  string $format A date format string. If $format is null, then an integer is returned
  */
  static public function getLastUpdateForDomain($domain, $format = 'Y-m-d H:i:s')
  {
    if (!preg_match('/%$/', $domain))
    {
      $domain .="%";
    }
    $c = new Criteria();
    $c->add(SchemaPeer::URI, $domain, Criteria::LIKE);
    $c->addJoin(self::SCHEMA_ID, SchemaPeer::ID);
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $rs = self::doSelectOne($c);
    $results = $rs->getCreatedAt($format);
    return $results;
  }

  /**
  * Gets the last update for a schema
  *
  * @return mixed Either a date string or a time integer
  * @param  integer $id
  * @param  string $format A date format string. If $format is null, then an integer is returned
  */
  static public function getLastUpdateForSchema($id, $format = 'Y-m-d H:i:s')
  {
    $c = new Criteria();
    $c->add(self::SCHEMA_ID, $id);
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $rs = self::doSelectOne($c);
    $results = 0; //there may be no elements
    if ($rs)
    {
      $results = $rs->getCreatedAt($format);
    }
    return $results;
  }


}
