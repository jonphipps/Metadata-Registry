<?php

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
      $success = $this->schema->publish(false);

      if ($success) {
        $graph["@graph"] = $success;
        $json = json_encode($graph);
        $file = "/Users/jonphipps/sites/PuphPet_UidJuy/www/registry/web/repos/RDA-Vocabularies/json-ld/Elements/a.json-ld";
        //don't display any of this, but instead reshow the 'show' display with 'Published' flash message
        //if publish was successful
        $this->setFlash('notice', 'This Schema has been published');
      }
      else {
      }
      //we should modify this to return an error flash message if there was a problem
      //note that error doesn't exist in either css or the default template
      $this->setFlash('error', 'This Schema has NOT been published');
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
