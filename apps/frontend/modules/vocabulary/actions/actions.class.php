<?php
use apps\frontend\lib\services\jsonldService;
use ImportVocab\ExportVocab;
use League\Flysystem\Adapter\Local as Adapter;
use League\Flysystem\Cache\Memory as Cache;
use League\Flysystem\Filesystem;

/**
 * vocabulary actions.
 *
 * @package    registry
 * @subpackage vocabulary
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 14 2006-04-13 13:08:36Z jphipps $
 */
class vocabularyActions extends autoVocabularyActions
{

  /**
   * Set defaults
   *
   * @param  Vocabulary $vocabulary
   */
  public function setDefaults($vocabulary)
  {
    $baseDomain = myActionTools::getBaseDomain($this);
    $vocabulary->setBaseDomain($baseDomain);
    $vocabulary->setLanguage(sfConfig::get('app_default_language'));
    $vocabulary->setProfileId(sfConfig::get('app_vocabulary_profile_id'));
    $agent_id = $this->getRequestParameter('agent_id');
    if ($agent_id) {
      $vocabulary->setAgentId($agent_id);
    }
    parent::setDefaults($vocabulary);
  }


    public function executeList()
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
        $this->requestParameterHolder->set('vocabulary', $vocabulary);
        $this->getUser()->getAttributeHolder()->remove('vocabulary');
        parent::executeSave();
    }


    public function executeRdf()
    {
        $this->forward('rdf', 'ShowScheme');
    }


    public function executeExport()
    {
        $this->labels            = $this->getLabels('show');
        $this->language          = $this->getRequestParameter('addLanguage');
        $this->defaultLanguage   = $this->getDefaultLanguage();
        $this->includeDeleted    = $this->getRequestParameter('includeDeleted', false);
        $this->excludeDeprecated = $this->getRequestParameter('excludeDeprecated', false);
        $this->excludeGenerated  = $this->getRequestParameter('excludeGenerated', false);
    }


    public function executeGetcsv()
    {
        $asTemplate    = '';
        $includeProlog = '';
        $populate      = '';
        $addLanguage   = $this->getRequestParameter('addLanguage');

        if ($addLanguage) {
            $languages = [ $this->getDefaultLanguage(), $addLanguage, ];
        } else {
            $languages = [ $this->getDefaultLanguage(), ];
        }
        switch ($this->getRequestParameter('exportType')) {
            case "1": //empty template
                $asTemplate    = true;
                $populate      = false;
                $includeProlog = true;
                break;
            case "2": //populated template
                $asTemplate    = true;
                $populate      = true;
                $includeProlog = true;
                break;
            case "3": //sparse data
                $asTemplate    = false;
                $populate      = true;
                $includeProlog = false;
                break;
            case "4": //rich data
                $asTemplate    = true;
                $populate      = true;
                $includeProlog = false;
                break;
            default:
        }
        $this->setLayout(false);
        sfConfig::set('sf_escaping_strategy', false);
        $includeDeleted    = (bool) $this->getRequestParameter('includeDeleted', false);
        $excludeDeprecated = (bool) $this->getRequestParameter('excludeDeprecated', false);
        $excludeGenerated  = (bool) $this->getRequestParameter('excludeGenerated', false);

        $export = new ExportVocab($this->getRequestParameter('id'),
                                  '',
                                  $populate,
                                  $asTemplate,
                                  $includeProlog,
                                  $includeDeleted,
                                  $excludeDeprecated,
                                  $excludeGenerated,
                                  $languages,
                                  'vocabulary');

//    $this->getResponse()->clearHttpHeaders();
//    $this->getResponse()->setHttpHeader('Content-Description','File Transfer');
        $this->getResponse()->setHttpHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->getResponse()
             ->setHttpHeader('Content-Disposition', 'attachment; filename="' . $export->getFileName() . '"');
        $this->getResponse()->setHttpHeader('Pragma', '');
        $this->getResponse()->setHttpHeader('Cache-Control', '');
//    $this->getResponse()->sendHttpHeaders();
        $export->write();
        $this->export = $export;
        //$this->renderText($export->getPath() .  $export->getFileName());

        //return $this->redirect( 'schema/export?id=' . $this->getRequestParameter( 'id' ) );
        //return sfView::NONE;
    }


    public function executeImport()
    {
        //set the form to display just the import if it's a get
        //if it's a post, we redirect to the import module
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->forward('file', 'import');
        }
    }


    private function getDefaultLanguage($textual = false)
    {
        $language = 'en';
        if ( ! $this->vocabulary) {
            $this->vocabulary = VocabularyPeer::retrieveByPk($this->getRequestParameter('id'));
        }
        if (isset( $this->vocabulary )) {
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


    public function executePublish()
    {
        //send the id to the publishing class
        if ( ! $this->vocabulary) {
            $this->vocabulary = VocabularyPeer::retrieveByPK($this->getRequestParameter('id'));
        }

        $vocabulary = $this->vocabulary;
        //todo: these should be configured by the publish form
        $uselanguageMap = true;
        $useLanguage    = "";
        $cLang          = null;

        ini_set('memory_limit', '640M');
        ini_set('max_execution_time', 600);

        $repo     = $vocabulary->getRepo();
        $mime     = "jsonld";
        $vocabDir = parse_url($vocabulary->getNamespace(), PHP_URL_PATH);
        if ( ! $vocabulary->getRepo() || ! $vocabDir) {
            $this->setFlash('error',
                            'This Vocabulary has NOT been published. We couldn\'t parse the file names from the uri.</br>Make sure that you\'ve set the the Git repository and have a valid namespace');
            $this->redirect($this->getRequest()
                                 ->getUriPrefix() . '/vocabulary/show/id/' . $vocabulary->getId() . '.html');
        }
        $file = rtrim($vocabDir, "/") . "." . $mime;

        $repoRoot   = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'repos' . DIRECTORY_SEPARATOR . "agents" . DIRECTORY_SEPARATOR . $vocabulary->getAgentId() . DIRECTORY_SEPARATOR . $repo;
        $filesystem = new Filesystem(new Adapter($repoRoot), new Cache);
        $filePath   = $repoRoot . DIRECTORY_SEPARATOR . $mime . DIRECTORY_SEPARATOR . $file;
        //TODO: create an alias file
        $aliasPath = "alias" . DIRECTORY_SEPARATOR . $vocabDir;

        //make sure the path is created
        $filesystem->put($mime . DIRECTORY_SEPARATOR . $file, '');
        //open a file for writing the complete vocabulary file
        $vocabFile     = fopen($filePath, 'w');
        $jsonLdService = new jsonldService($vocabulary);
        fwrite($vocabFile, $jsonLdService->getJsonLd());
        fclose($vocabFile);

        //TODO: generate RDF/XML and save
        //TODO: generate other flavours of RDF using EasyRDF and save

        //if publish was successful
        $this->setFlash('notice', 'This Vocabulary has been published');
        $this->redirect($this->getRequest()->getUriPrefix() . '/vocabulary/show/id/' . $vocabulary->getId() . '.html');


    }

}
