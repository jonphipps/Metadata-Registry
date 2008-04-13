<?php

/**
 * schemaprop actions.
 *
 * @package    registry
 * @subpackage schemaprop
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemapropActions extends autoschemapropActions
{
  public function preExecute ()
  {
    //$this->getCurrentSchema();
    parent::preExecute();
  }

/**
* Set defaults
*
* @param  SchemaProperty $schemaprop
*/
  public function setDefaults($schemaprop)
  {
    $schemaObj = $this->getCurrentSchema();
    $schemaId = $schemaObj->getId();
    $schemaprop->setSchemaId($schemaId);

    $schemapropParam = $this->getContext()->getRequest()->getParameter('schemaprop');
    if (!$this->getContext()->getRequest()->getErrors() and !isset($schemapropParam['uri']))
    {
      $schemaDomain = $schemaObj->getBaseDomain();
      $schemaToken = $schemaObj->getToken();
      //get the next id
      $nextUriId = SchemaPeer::getNextSchemaPropertyId($schemaId);
      //URI looks like: agent(base_domain) / schema(token) / schema(next_schemaprop_id) / skos_property_id # schemaprop(next_property_id)
      $vSlash = preg_match('@(/$)@i', $schemaDomain) ? '' : '/';
      $tSlash = preg_match('@(/$)@i', $schemaToken ) ? '' : '/';
      $newURI = $schemaDomain . $vSlash . $schemaToken . $tSlash . $nextUriId;
      //registry base domain is http://metadataregistry.org/uri/
      //next_schemaprop_id is always initialized to 100000, allowing for 999,999 schemaprops
      //schema carries denormalized base_domain from agent

      $schemaprop->setUri($newURI);
      $schemaprop->setLabel('');
      //set to the schema defaults
      $schemaprop->setLanguage($schemaObj->getLanguage());
      $schemaprop->setStatusId($schemaObj->getStatusId());
    }

    parent::setDefaults($schemaprop);
  }

  public function executeList ()
  {
    //a current schema is required to be in the request URL
    myActionTools::requireSchemaFilter();

    //clear any existing property filters since they don't apply now
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schemapprop/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schemapprop_history/filters');
    parent::executeList();
  }

  /**
  * gets the current schema object
  *
  * @return schema current schema object
  */
  public function getCurrentSchema()
  {
    $schema = myActionTools::findCurrentSchema();

    if (!$schema) //we have to do it the hard way
    {
      $this->schemaprop = SchemaPropertyPeer::retrieveByPk($this->getRequestParameter('id'));
      if (isset($this->schemaprop))
      {
        $schema = $this->schemaprop->getSchema();
      }
    }

    $this->forward404Unless($schema,'No schema has been selected.');

    $this->schema = $schema;
    $this->schemaID = $schema->getId();

    return $schema;
  }

  public function executeProperties()
  {
    $this->redirect('/schemapropprop/list?schemaprop_id=' . $this->getRequestParameter('id') );
  }

  public function executeGetSchemaPropertyList()
  {
     $schemaId = $this->getRequestParameter('selectedSchemaId');
     $schemapropId = sfContext::getInstance()->getUser()->getAttribute('schemaprop')->getId();
     $results = SchemaPropertyPeer::getSchemaPropertysByVocabID($schemaId, $schemapropId);
     foreach ($results as $myCschemaprop)
     {
        $options[$myCschemaprop->getId()] = $myCschemaprop->getPrefLabel();
     }
     if (!isset($options))
     {
         $options[''] = 'There are no related schemaprops to select';
     }
     $this->schemaprops = $options;
  }

}
