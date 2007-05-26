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
class myPropelUniqueConceptValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $vocabId   = $this->getContext()->getRequest()->getParameter('vocabulary_id');
    $conceptId = $this->getContext()->getRequest()->getParameter('id');

    $c = new Criteria();
    $c->add(ConceptPeer::PREF_LABEL, $value);
    $c->add(ConceptPeer::VOCABULARY_ID, $vocabId);

    $object = ConceptPeer::doSelectOne($c);

    if ($object)
    {
       //check to see if the retrieved object has the same id
       if ($conceptId && ($object->getId() == $conceptId))
       {
         return true;
       }
       else
       {
         $error = $this->getParameter('unique_error');

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
