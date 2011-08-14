<?php

/**
 * validates the uniqueness of a uri in the context of the registry
 *
 * Takes as input the uri of the concept
 * Makes sure that we're not talking about the current URI
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
class myPropelUniqueUriValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $conceptId = $this->getContext()->getRequest()->getParameter('id');

    $c = new Criteria();
    $c->add(ConceptPeer::URI, $value);

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
