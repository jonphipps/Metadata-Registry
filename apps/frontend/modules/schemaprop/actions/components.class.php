<?php
class schemapropComponents extends sfComponents
{
  public function executePropertylist()
  {
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::SCHEMA_ID, $this->schemaId);
//    $c->addDescendingOrderByColumn(ConceptPropertyPeer::SKOS_PROPERTY_ID);
    $this->properties = SchemaPropertyPeer::doSelect($c);
  }
}