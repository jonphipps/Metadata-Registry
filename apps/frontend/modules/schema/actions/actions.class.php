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

  public function executeRdf ()
  {
     $this->forward('rdf','ShowSchema');
  }
}
