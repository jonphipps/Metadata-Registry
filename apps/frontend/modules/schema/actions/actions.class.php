<?php

/**
 * schema actions.
 *
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
    $baseDomain = rtrim(sfConfig::get('app_base_domain') ," /");
    $schema->setBaseDomain($baseDomain . "/schema/");
    $schema->setLanguage(sfConfig::get('app_default_language'));
    $schema->setProfileId(sfConfig::get('app_schema_profile_id'));
    parent::setDefaults($schema);
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
}
