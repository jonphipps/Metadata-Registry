<?php

/**
 * validates the uniqueness of a prefLabel in the context of a Vocabulary
 *
 * Takes as input the prefLabel of the concept
 * Gets the vocabulary id from the request object
 *
 * <b>Optional parameters:</b>
 *
 * # <b>unique_error</b> - [Uniqueness error]   - An error message to use when
 *                                                the value for this column already
 *                                                exists in the database.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Jon Phipps <jp298@cornell.edu>
 * @version    SVN: $Id: sfPropelUniqueValidator.class.php 2995 2006-12-09 18:01:32Z fabien $
 */
class myPropelUniquePrefLabelValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $property   = $this->getContext()->getRequest()->getParameter('concept_property');
    $propertyId = $this->getContext()->getRequest()->getParameter('id');
    $conceptId = $this->getContext()->getRequest()->getParameter('concept_id');
    $vocabId = $this->getContext()->getUser()->getAttribute('vocabulary')->getId();

    //if it's not a prefLabel then we just check for uniqueness in the context of the Concept
    if ((int) $property['skos_property_id'] !== 19)
    {
      $c = new Criteria();
      $c->add(ConceptPropertyPeer::CONCEPT_ID, $conceptId);
      $c->add(ConceptPropertyPeer::LANGUAGE,  $property['language'] );
      $c->add(ConceptPropertyPeer::STATUS_ID, $property['status_id']);
      $c->add(ConceptPropertyPeer::OBJECT, $value);

      $object = ConceptPropertyPeer::doSelectOne($c);

      if ($object)
      {
         //check to see if the retrieved object has the same id
         if ($propertyId && ($object->getId() == $propertyId))
         {
           return true;
         }
         else
         {
           $error = "This Concept already has this exact property.";

           return false;
         }
      }
    }
    else
    {
      //check for no duplicate prefLable in the entire vocabulary
      $c = new Criteria();
      $c->add(ConceptPeer::VOCABULARY_ID, $vocabId);
      $c->add(ConceptPropertyPeer::LANGUAGE,  $property['language'] );
      $c->add(ConceptPropertyPeer::STATUS_ID, $property['status_id']);
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, 19);
      $c->add(ConceptPropertyPeer::OBJECT, $value);
      $c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

      $object = ConceptPropertyPeer::doSelectOne($c);

      if ($object)
      {
           //check to see if the retrieved object has the same id
           if ($propertyId && ($object->getId() == $propertyId))
           {
             return true;
           }
           else
           {
             $error =  "This Vocabulary already has a Concept with a prefLabel with this status and language.";

             return false;
           }
         }

      $c = new Criteria();
      $c->add(ConceptPropertyPeer::CONCEPT_ID, $conceptId);
      $c->add(ConceptPropertyPeer::LANGUAGE,  $property['language'] );
      $c->add(ConceptPropertyPeer::STATUS_ID, $property['status_id']);
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, 19);

      $objects = ConceptPropertyPeer::doSelect($c);

      if ($objects && (($propertyId && count($objects) > 1) or (!$propertyId && count($objects))))
      {
        $error =  "This Concept already has a prefLabel with this status and language.";

        return false;
       }
    }

    return true;
  }

  /**
   * Initialize this validator.
   *
   * @param sfContext The current application context.
   * @param array   An associative array of initialization parameters.
   *
   * @return bool true, if initialization completes successfully, otherwise false.
   */
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('unique_error', 'Uniqueness error');

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}
