<?php

/**
 * Subclass for performing query and update operations on the 'reg_skos_property' table.
 *
 *
 *
 * @package lib.model
 */
class SkosPropertyPeer extends BaseSkosPropertyPeer
{
	/** the value for the altLabel ID  */
	const LABEL_ALT_ID = 1;

	/** the value for the hiddenLabel ID  */
	const LABEL_HIDDEN_ID = 9;

	/** the value for the prefLabel ID  */
	const LABEL_PREF_ID = 19;

	/** the value for the label ID  */
	const LABEL_ID = 27;

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function getResourceProperties()
  {
    $c = new Criteria();
    $c->add(SkosPropertyPeer::OBJECT_TYPE,'resource');
    $c->clearSelectColumns()->addSelectColumn(SkosPropertyPeer::ID);
    $rs = SkosPropertyPeer::doSelectRS($c);
    while($rs->next())
    {
		  $results[] = $rs->getInt(1);
    }

    return $results;
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function getPicklist()
  {
    $c = new Criteria();
    $c->add(SkosPropertyPeer::IS_IN_PICKLIST,true);
    $c->addAscendingOrderByColumn(SkosPropertyPeer::PICKLIST_ORDER);
    $results = self::doSelect($c);

    //create appearance of tree
    /** @var $result SkosProperty **/
    foreach ($results as $result)
    {
      if ($result->getParentId())
      {
        $result->setLabel('&nbsp;&nbsp;&nbsp;' . $result->getLabel());
      }
    }

    return $results;
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function getPropertyNames()
  {
    $c = new Criteria();
    $c->clearSelectColumns()->addSelectColumn(SkosPropertyPeer::ID);
    $c->addSelectColumn(self::NAME);
    $rs = SkosPropertyPeer::doSelectRS($c);
    while($rs->next())
    {
      $results[$rs->getString(2)] = $rs->getInt(1);
    }

    return $results;
  }


} // SkosPropertyPeer
