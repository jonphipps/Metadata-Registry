<?php

/**
 * vocabulary actions.
 *
 * @package    registry
 * @subpackage vocabulary
 * @author     Jon Phipps <jonphipps@gmail.com>
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
    $vocabulary->setBaseDomain(rtrim(sfConfig::get('app_base_domain') ," /") . '/');
    $vocabulary->setLanguage('en');
    parent::setDefaults($vocabulary);
  }

  public function executeList ()
  {
    //clear any detail filters
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property_history/filters');
    parent::executeList();
  }

  public function executeSave()
  {
    //strip trailing blanks and tokens from URI
    $vocabulary = $this->getRequestParameter('vocabulary');
    $vocabulary['uri'] = rtrim($vocabulary['uri'], " /");
    $this->requestParameterHolder->set('vocabulary', $vocabulary);
    $this->getUser()->getAttributeHolder()->remove('vocabulary');
    parent::executeSave();
  }

  public function executeRdf ()
  {
     $this->forward('rdf','ShowScheme');
  }
}