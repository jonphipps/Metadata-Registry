<?php
class conceptComponents extends sfComponents
{
  public function executePropertylist()
  {
    $c = new Criteria();
    $c->add(ConceptPropertyPeer::CONCEPT_ID, $this->getRequestParameter('id'));
    $c->addDescendingOrderByColumn(ConceptPropertyPeer::SKOS_PROPERTY_ID);
    $this->properties = ConceptPropertyPeer::doSelect($c);
  }
}

?>