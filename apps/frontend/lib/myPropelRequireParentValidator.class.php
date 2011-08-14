<?php

/**
 * requires a parent if the type is a subclass or subproperty
 *
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
class myPropelRequireParentValidator extends sfValidator
{
  public function execute(&$value, &$error)
  {
    $property = $this->getParameter('schema_property');
    $request = $this->getContext()->getRequest();


    //check to see if there's parent uri
    if (in_array($value, array('subclass','subproperty')))
    {
      if ($property['parent_uri'] || $property['is_subclass_of'] || $property['is_subproperty_of'])
      {
        return true;
      }
      else
      {
        if ('subclass' == $value)
        {
          if($property['is_subclass_of'] || $property['parent_uri'])
          {
            return true;
          }
          else
          {
            $error = "A subclass requires a related class to be selected or a related URI to be supplied";
            $request->setError("schema_property{is_subclass_of}", "A related class must be selected or a related URI supplied.");
            $request->setError("schema_property{parent_uri}", "A related URI must be supplied or a related class must be selected.");
            return false;
          }
        }

        if ('subproperty' == $value)
        {
          if($property['is_subproperty_of'] || $property['parent_uri'])
          {
            return true;
          }
          else
          {
            $error = "A subproperty requires a related property to be selected or a related URI to be supplied";
            $request->setError("schema_property{is_subproperty_of}", "A related property must be selected or a related URI supplied.");
            $request->setError("schema_property{parent_uri}", "A related URI must be supplied or a related property must be selected.");
            return false;
          }
        }
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
    $this->setParameter('schema_property', $context->getRequest()->getParameter('schema_property'));

    $this->getParameterHolder()->add($parameters);


    return true;
  }
}
