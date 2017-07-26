<?php

class conceptComponents extends sfComponents
{
    public function executePropertylist()
    {
        $c = new Criteria();
        $c->add(ConceptPropertyPeer::CONCEPT_ID, $this->conceptId);
        $c->addAscendingOrderByColumn(ConceptPropertyPeer::PROFILE_PROPERTY_ID);
        $c->addAscendingOrderByColumn(ConceptPropertyPeer::LANGUAGE);
        $this->properties = ConceptPropertyPeer::doSelect($c);
    }
}
