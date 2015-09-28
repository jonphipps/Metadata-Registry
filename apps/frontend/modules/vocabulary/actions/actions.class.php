<?php
use ImportVocab\ExportVocab;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;
use League\Flysystem\Cache\Memory as Cache;
use ML\JsonLD\JsonLD;
use ML\JsonLD\NQuads;

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
    $vocabulary->setBaseDomain($this->getRequest()->getUriPrefix() . '/uri/');
    $vocabulary->setLanguage(sfConfig::get('app_default_language'));
    $vocabulary->setProfileId(sfConfig::get('app_vocabulary_profile_id'));
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

  public function executeExport()
  {
    $this->labels = $this->getLabels('show');
    $this->language = $this->getRequestParameter('addLanguage');
    $this->defaultLanguage = $this->getDefaultLanguage();
    $this->includeDeleted = $this->getRequestParameter('includeDeleted', false);
    $this->excludeDeprecated = $this->getRequestParameter('excludeDeprecated', false);
    $this->excludeGenerated = $this->getRequestParameter('excludeGenerated', false);
  }

  public function executeGetcsv()
  {
    $asTemplate = '';
    $includeProlog = '';
    $populate = '';
    $addLanguage = $this->getRequestParameter('addLanguage');

    if ($addLanguage) {
      $languages = [ $this->getDefaultLanguage(), $addLanguage, ];
    } else {
      $languages = [ $this->getDefaultLanguage(), ];
    }
    switch ($this->getRequestParameter('exportType')) {
      case "1": //empty template
        $asTemplate = true;
        $populate = false;
        $includeProlog = true;
        break;
      case "2": //populated template
        $asTemplate = true;
        $populate = true;
        $includeProlog = true;
        break;
      case "3": //sparse data
        $asTemplate = false;
        $populate = true;
        $includeProlog = false;
        break;
      case "4": //rich data
        $asTemplate = true;
        $populate = true;
        $includeProlog = false;
        break;
      default:
    }
    $this->setLayout(false);
    sfConfig::set('sf_escaping_strategy', false);
    $includeDeleted = (bool) $this->getRequestParameter('includeDeleted', false);
    $excludeDeprecated = (bool) $this->getRequestParameter('excludeDeprecated', false);
    $excludeGenerated = (bool) $this->getRequestParameter('excludeGenerated', false);

    $export = new ExportVocab($this->getRequestParameter('id'), '', $populate, $asTemplate, $includeProlog,
        $includeDeleted, $excludeDeprecated, $excludeGenerated, $languages, 'vocabulary');

//    $this->getResponse()->clearHttpHeaders();
//    $this->getResponse()->setHttpHeader('Content-Description','File Transfer');
    $this->getResponse()->setHttpHeader('Content-Type', 'text/csv; charset=UTF-8');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="' . $export->getFileName() . '"');
    $this->getResponse()->setHttpHeader('Pragma', '');
    $this->getResponse()->setHttpHeader('Cache-Control', '');
//    $this->getResponse()->sendHttpHeaders();
    $export->write();
    $this->export = $export;
    //$this->renderText($export->getPath() .  $export->getFileName());

    //return $this->redirect( 'schema/export?id=' . $this->getRequestParameter( 'id' ) );
    //return sfView::NONE;
  }

  public function executeImport ()
  {
    //set the form to display just the import if it's a get
    //if it's a post, we redirect to the import module
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->forward('file', 'import');
    }
  }

  private function getDefaultLanguage($textual = false)
  {
    $language = 'en';
    if ( ! $this->vocabulary) {
      $this->vocabulary = VocabularyPeer::retrieveByPk($this->getRequestParameter('id'));
    }
    if (isset($this->vocabulary)) {
      $language = $this->vocabulary->getLanguage();
    }

    if ( ! $textual) {
      return $language;
    } else {
      $culture = 'en';
      /** @var sfUser $user */
      $user = $this->getUser();
      if ($user) {
        $culture = $user->getCulture();
      }
      $cultureInfo = new sfCultureInfo($culture);

      $languages = $cultureInfo->getLanguages();

      return $languages[$language];
    }
  }

}
