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


} // SkosPropertyPeer
