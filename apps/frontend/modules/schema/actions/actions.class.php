<?php
use ImportVocab\ExportVocab;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;
use League\Flysystem\Cache\Memory as Cache;
use ML\JsonLD\JsonLD;
use ML\JsonLD\NQuads;

/**
 * schema actions.
 *
 * @property SchemaProperty[] properties
 * @property SchemaProperty[] classes
 * @property Schema           schema
 * @property array            labels
 * @property int              timestamp
 * @package    registry
 * @subpackage schema
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemaActions extends autoschemaActions
{
/**
* Set defaults
*
* @param  Schema $schema
*/
  public function setDefaults($schema)
  {
    $baseDomain = $this->getRequest()->getUriPrefix() . '/uri';
    $schema->setBaseDomain($baseDomain . "/schema/");
    $schema->setLanguage(sfConfig::get('app_default_language'));
    $schema->setProfileId(sfConfig::get('app_schema_profile_id'));
    parent::setDefaults($schema);
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

  public function executeList ()
  {
    //clear any detail filters
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_element/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_element_history/filters');
    parent::executeList();
  }

  public function executeSave()
  {
    $this->getUser()->getAttributeHolder()->remove('schema');
    parent::executeSave();
  }

  public function executeShowRdf ()
  {
    $ts = strtotime($this->getRequestParameter('ts'));
    $this->timestamp = $ts;
    if (!$this->schema)
    {
      $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
    }
    $this->labels = $this->getLabels('show');

    $this->forward404Unless($this->schema);
    $this->properties = $this->schema->getProperties();
    $this->classes = $this->schema->getClasses();

     //$this->forward('rdf','ShowSchema');
  }

  public function executeExport()
  {
    $this->labels = $this->getLabels('show');
    $this->language = $this->getRequestParameter( 'addLanguage' );
    $this->defaultLanguage = $this->getDefaultLanguage();
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

    $export = new ExportVocab($this->getRequestParameter('id'), '', $populate, $asTemplate, $includeProlog, $languages);

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

  public function executePublish() {
      //send the id to the publishing class
      if (!$this->schema) {
        $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
      }

      $schema = $this->schema;
      //todo: these should be configured by the publish form
      $uselanguageAsArray = FALSE;
      $useLanguage        = "";
      if ($useLanguage == "") {
          $useLanguage = $schema->getLanguage();
      }

      ini_set('memory_limit', '640M');
      ini_set('max_execution_time', 600);

      $repo = $schema->getRepo();
      $mime = "jsonld";
      if (preg_match('%' . $schema->getBaseDomain() . '(.*)[/#]$%i', $schema->getUri(), $regs)) {
        $vocabDir = $regs[1];
      } else {
        $this->setFlash('error', 'This Schema has NOT been published. We couldn\'t parse the file names from the uri.</br>Make sure that you\'ve set the base domain, the uri, and the Git Repository.' );
        return $this->forward('schema', 'show');
      }
      $file = $vocabDir . "." . $mime;

      $repoRoot = SF_ROOT_DIR . DIRECTORY_SEPARATOR .
                  'web' . DIRECTORY_SEPARATOR .
                  'repos' . DIRECTORY_SEPARATOR  .
                  "agents" . DIRECTORY_SEPARATOR .
                  $schema->getAgentId() . DIRECTORY_SEPARATOR .
                  $repo;
      $filesystem = new Filesystem(new Adapter($repoRoot), new Cache);
      $filePath = $repoRoot . DIRECTORY_SEPARATOR .
                  $mime . DIRECTORY_SEPARATOR .
                 $file;
      $aliasPath =  "alias" . DIRECTORY_SEPARATOR . $vocabDir;

      $cLang       = $schema->getCriteriaForLanguage($uselanguageAsArray, $useLanguage);
      $propArray   = $schema->getPropertyArray();
      $statusArray = $schema->getStatusArray();

      //open a file for writing the complete vocabulary file
      $vocabFile = fopen($filePath, 'w+');
      //$context = $schema->getJsonLdContext("en");

      if ( ! $uselanguageAsArray) {
          $jsonldContext = $schema->getBaseDomain() . "Contexts/nolang.jsonld";
          $contextArray = array($jsonldContext, array("@language"=>$useLanguage,),);
      } else {
          //note: this probably isn't right
          $jsonldContext = $schema->getBaseDomain() . "Contexts/" . $useLanguage . ".jsonld";
          $contextArray = array($jsonldContext, "@language"=>$useLanguage,);
      }

      $context = json_encode($contextArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      //prepend the context
      fwrite($vocabFile, '{' . PHP_EOL . '"@context": ' . $context  . ',' . PHP_EOL .  '  "@graph": [');
      fclose($vocabFile);
      $vocabFile = fopen($filePath, 'a+');
      $comma = "";
      $counter = 0;
      $aka=array();

      //get a list of the resources
      /** @var SchemaProperty[] $properties */
      $resources = $schema->getSchemaPropertys();
      /** @var SchemaProperty $resource */
      foreach ($resources as $resource) {
        $success = $schema->getResourceArray($resource, $cLang, $propArray, $statusArray, $uselanguageAsArray, $useLanguage);
        if ($success) {
          $counter++;
          $jsonld    = json_encode($success, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
          //$success["@context"] = json_encode($contextArray);
          $success["@context"] = $contextArray;
          ksort($success, SORT_FLAG_CASE | SORT_NATURAL);
          $jsonFrag = json_encode($success, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
          $jsonFrag .= PHP_EOL;
//          $compacted = JsonLD::compact($jsonFrag);
//          $expanded = JsonLD::expand($jsonFrag);
//          $flattened = JsonLD::flatten($jsonFrag);
//          $prettyC = JsonLD::toString($compacted, true);
//          $prettyE = JsonLD::toString($expanded, true);
//          $prettyF = JsonLD::toString($flattened, true);
//          $quads = JsonLD::toRdf($jsonFrag);
//          $nquads = new NQuads();
//          $serialized = $nquads->serialize($quads);
//          $document = JsonLD::fromRdf($quads);
//          $doc = JsonLD::getDocument($jsonFrag);
//          $graph = $doc->getGraph();
//          $serialized2 = JsonLD::toString($graph->toJsonLd());
//          $rdfFormats = EasyRdf_Format::getFormats();
//          $graph = new EasyRdf_Graph($success["@id"]);
//          $graph->parse($quads, "jsonld", $success["@id"]);
//          $output = $graph->serialise("turtle");

          //append the json to the open file
          fwrite($vocabFile, $comma . PHP_EOL . $jsonld);

          //update the fragment
          //this just gets the last bit after the last slash
          $filename = preg_replace('%.*/%i', '', $resource->getUri());
          $filesystem->put($mime . DIRECTORY_SEPARATOR . $vocabDir . DIRECTORY_SEPARATOR . $filename . "." . $mime, $jsonFrag);
          $comma = ",";
        }
      }
      fwrite($vocabFile, PHP_EOL . "  ]" . PHP_EOL . "}" . PHP_EOL);
      fclose($vocabFile);
      $filesystem->put($aliasPath . ".json", json_encode($schema->getLexicalArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
      $filesystem->put($aliasPath . ".php", serialize($schema->getLexicalArray()));

        //don't display any of this, but instead reshow the 'show' display with 'Published' flash message
        //if publish was successful
        $this->setFlash('notice', 'This Schema has been published');

      //we should modify this to return an error flash message if there was a problem
      //note that error doesn't exist in either css or the default template
      //$this->setFlash('error', 'This Schema has NOT been published');
      return $this->forward('schema', 'show');

/*      if (!$schema) {
        $schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
      }
      $this->labels = $this->getLabels('show');

      $this->forward404Unless($schema);
      $this->properties = $schema->getProperties();
      $this->classes    = $schema->getClasses();
*/
    }

  private function getDefaultLanguage($textual = false)
  {
    if ( ! $this->schema) {
      $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
    }
    $language = $this->schema->getLanguage();

    if ( ! $textual) {
      return $language;
    } else {
      $cultureInfo = new sfCultureInfo($this->getUser()->getCulture());
      $languages = $cultureInfo->getLanguages();

      return $languages[ $language ];
    }

  }
}
