<?php

/**
 * Subclass for representing a row from the 'reg_schema_property_element_history' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElementHistory extends BaseSchemaPropertyElementHistory
{

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    return $this->getUserRelatedByCreatedUserId();

  } // getCreatedUser

  /**
  * Gets the property label
  *
  * @return SchemaProperty
  */
  public function getPropertyLabel()
  {
    return $this->getSchemaPropertyRelatedBySchemaPropertyId();

  } // getPropertyLabel

  /**
  * Gets the property uri
  *
  * @return string
  */
  public function getPropertyUri()
  {
    return $this->getSchemaPropertyRelatedBySchemaPropertyId()->getUri();

  } // getPropertyUri

  /**
  * gets the previous change if the action is 'modified'
  *
  * @return ConceptPropertyHistory object
  * @param  string $historyTimestamp
  * @param  string $propertyId
  */
  function getPrevious()
  {
    $propertyId = $this->getSchemaPropertyElementId();
    $timestamp = $this->getCreatedAt();

    //build the query string
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $propertyId);
    $crit1 = $c->getNewCriterion(SchemaPropertyElementHistoryPeer::CREATED_AT, $timestamp, Criteria::LESS_THAN);

    // Perform AND at level 0 ($crit0 $crit1 )
    $crit0->addAnd($crit1);
    $c->add($crit0);

    //set order and limits
    $c->setLimit(1);
    $c->addDescendingOrderByColumn(SchemaPropertyElementHistoryPeer::CREATED_AT);

    $result = SchemaPropertyElementHistoryPeer::doSelect($c);

    //return the resulting object
    if (count($result))
    {
        $result = $result[0];
    }

    return $result;

  } //getPrevious

}
