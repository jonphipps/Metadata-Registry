<?php
class conceptComponents extends sfComponents
{
    /**
     * @throws PropelException
     */
    public function executePropertylist()
  {
    $c = new Criteria();
    $c->add(ConceptPropertyPeer::CONCEPT_ID, $this->conceptId);
    $c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);
    $c->addAscendingOrderByColumn(ConceptPropertyPeer::LANGUAGE);
    $c->addAscendingOrderByColumn(ProfilePropertyPeer::EXPORT_ORDER);
    $this->properties = ConceptPropertyPeer::doSelect($c);
  } 
}
