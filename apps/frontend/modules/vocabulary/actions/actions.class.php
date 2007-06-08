<?php

/**
 * vocabulary actions.
 *
 * @package    registry
 * @subpackage vocabulary
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 14 2006-04-13 13:08:36Z jphipps $
 */
class vocabularyActions extends autovocabularyActions
{

/**
* Set defaults
*
* @param  Vocabulary $vocabulary
*/
  public function setDefaults($vocabulary)
  {
    $vocabulary->setBaseDomain('http://metadataregistry.org/uri/');
    $vocabulary->setLanguage('en');
    parent::setDefaults($vocabulary);
  }

  public function executeList ()
  {
    //clear any detail filters
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property/filters');
    parent::executeList();
  }

  public function executeRdf ()
  {
     $this->forward('rdf','ShowScheme');
  }
}