<?php
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
  class schemaActions extends autoschemaActions {
    /**
     * Set defaults
     *
     * @param  Schema $schema
     */
    public function setDefaults($schema) {
      $baseDomain = $this->getRequest()->getUriPrefix() . '/uri';
      $schema->setBaseDomain($baseDomain . "/schema/");
      $schema->setLanguage(sfConfig::get('app_default_language'));
      $schema->setProfileId(sfConfig::get('app_schema_profile_id'));
      parent::setDefaults($schema);
    }

    public function executeImport() {
      //set the form to display just the import if it's a get
      //if it's a post, we redirect to the import module
      if ($this->getRequest()->getMethod() == sfRequest::POST) {
        $this->forward('file', 'import');
      }
    }

    /**
     *
     */
    public function executeList() {
      //clear any detail filters
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property/filters');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_element/filters');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_element_history/filters');
      parent::executeList();
    }

    public function executeSave() {
      $this->getUser()->getAttributeHolder()->remove('schema');
      parent::executeSave();
    }

    public function executeShowRdf() {
      $ts              = strtotime($this->getRequestParameter('ts'));
      $this->timestamp = $ts;
      if (!$this->schema) {
        $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
      }
      $this->labels = $this->getLabels('show');

      $this->forward404Unless($this->schema);
      $this->properties = $this->schema->getProperties();
      $this->classes    = $this->schema->getClasses();
      //$this->forward('rdf','ShowSchema');
    }

    public function executePublish() {
      //send the id to the publishing class
      if (!$this->schema) {
        $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
      }

      ini_set('memory_limit', '640M');
      ini_set('max_execution_time', 600);

      $repo = $this->schema->getRepo();
      $mime = "jsonld";
      if (preg_match('%' . $this->schema->getBaseDomain() . '(.*)[/#]$%i', $this->schema->getUri(), $regs)) {
        $vocabDir = $regs[1];
      } else {
        $this->setFlash('error', 'This Schema has NOT been published. We couldn\'t parse the file names from the uri' );
        return $this->forward('schema', 'show');
      }
      $file = $vocabDir . "." . $mime;

      $repoRoot = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'repos' . DIRECTORY_SEPARATOR ;
      $filesystem = new Filesystem(new Adapter($repoRoot), new Cache);
      $bigPath = $repoRoot . DIRECTORY_SEPARATOR . $repo . DIRECTORY_SEPARATOR . $mime . DIRECTORY_SEPARATOR . $file;

      $uselanguageAsArray = FALSE;
      $useLanguage        = "en";

      $cLang       = $this->schema->getCriteriaForLanguage($uselanguageAsArray, $useLanguage);
      $propArray   = $this->schema->getPropertyArray();
      $statusArray = $this->schema->getStatusArray();

      //open a file for writing the complete vocabulary file
      $vocabFile = fopen($bigPath, 'w+');
      $context = $this->schema->getJsonLdContext("en");
      //prepend the context
      fwrite($vocabFile, "{" . PHP_EOL . '"@context":' . $context . "," . PHP_EOL  . '  "@graph": [');
      $comma = "";
      $counter = 0;
      $aka=array();

      //get a list of the resources
      /** @var SchemaProperty[] $properties */
      $resources = $this->schema->getSchemaPropertys();
      /** @var SchemaProperty $resource */
      foreach ($resources as $resource) {
        $success = $this->schema->getResourceArray($resource, $cLang, $propArray, $statusArray, $uselanguageAsArray, $useLanguage);
        if ($success) {
          $counter++;
          $jsonld    = json_encode($success, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
          $success["@context"] = json_decode($context);
          ksort($success, SORT_FLAG_CASE | SORT_NATURAL);
          $jsonFrag = json_encode($success, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
          $jsonFrag .= PHP_EOL;
          $compacted = JsonLD::compact($jsonFrag,"http://rdaregistry.info/Contexts/elements_en.jsonld");
//          $expanded = JsonLD::expand($jsonFrag);
//          $flattened = JsonLD::flatten($jsonFrag);
//          $prettyC = JsonLD::toString($compacted, true);
//          $prettyE = JsonLD::toString($expanded, true);
//          $prettyF = JsonLD::toString($flattened, true);
//          $quads = JsonLD::toRdf($jsonFrag);
//          $nquads = new NQuads();
//          $serialized = $nquads->serialize($quads);
//          $rdfFormats = EasyRdf_Format::getFormats();
          //append the json to the open file
          fwrite($vocabFile, $comma . PHP_EOL . $jsonld);

          //update the fragment
          //this just gets the last bit after the last slash
          $filename = preg_replace('%.*/%i', '', $resource->getUri());
          $filesystem->put($repo . DIRECTORY_SEPARATOR . $mime . DIRECTORY_SEPARATOR . $vocabDir . DIRECTORY_SEPARATOR . $filename . "." . $mime, $jsonFrag);
          $comma = ",";
        }
      }
      fwrite($vocabFile, PHP_EOL . "  ]" . PHP_EOL . "}" . PHP_EOL);
      fclose($vocabFile);

        //don't display any of this, but instead reshow the 'show' display with 'Published' flash message
        //if publish was successful
        $this->setFlash('notice', 'This Schema has been published');

      //we should modify this to return an error flash message if there was a problem
      //note that error doesn't exist in either css or the default template
      //$this->setFlash('error', 'This Schema has NOT been published');
      return $this->forward('schema', 'show');

      if (!$this->schema) {
        $this->schema = SchemaPeer::retrieveByPk($this->getRequestParameter('id'));
      }
      $this->labels = $this->getLabels('show');

      $this->forward404Unless($this->schema);
      $this->properties = $this->schema->getProperties();
      $this->classes    = $this->schema->getClasses();

    }
  }
