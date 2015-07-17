<?php

/**
 * schemaprop actions.
 *
 * @property SchemaProperty property
 * @property Schema         schema
 * @property int            timestamp
 * @property array          labels
 * @property int            schemaID
 * @property SchemaProperty schemaprop
 * @property sfPropelPager  pager
 * @property array          filters
 * @property SchemaProperty schema_property
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
    if ('search' != $this->getRequestParameter('action'))
    {
      $this->getCurrentSchema();
    }
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
      $this->setDefaultUri($schemaprop, $schemaObj);
      $schemaprop->setLabel('');
      //set to the schema defaults
      $schemaprop->setLanguage($schemaObj->getLanguage());
      $schemaprop->setStatusId($schemaObj->getStatusId());
    }

    parent::setDefaults($schemaprop);
  }

  /**
   * @param SchemaProperty $schemaprop
   * @param Schema         $schemaObj
   */
  public function setDefaultUri($schemaprop, $schemaObj)
  {
    $newURI = $this->getBaseUri($schemaObj);

    $UriId = $schemaObj->getLastUriId() + 1;
    $schemaObj->setLastUriId($UriId);
    $schemaObj->save();
    $schemaprop->setUri($newURI . $UriId);

    $this->setDefaultLexicalAlias($schemaprop, $newURI);
  }

  /**
   * @param SchemaProperty $schemaprop
   * @param string         $newURI
   */
  public function setDefaultLexicalAlias($schemaprop, $newURI)
  {
    //$schemaprop->setLexicalAlias($newURI . "[LEXICAL_TOKEN]");
  }

  public function executeEdit()
  {
    /** @var \myUser $sfUser */
    $sfUser = sfContext::getInstance()->getUser();
    $userId = $sfUser->getSubscriberId();
    $schemaObj = $this->getCurrentSchema();
    $CurrentCulture = $sfUser->getCulture();

    //FIXME: If the user is an admin, set the available languages to all of the schema languages
    //FIXME: if the user has no languages set, silently set their language to the default (?)
    if ($userId) {
      $c = new Criteria();
      $c->add(SchemaHasUserPeer::USER_ID, $userId);
      $c->add(SchemaHasUserPeer::SCHEMA_ID, $schemaObj->getId());
      $schemaUser = SchemaHasUserPeer::doSelectOne($c);

      if ($sfUser->hasObjectCredential($schemaObj->getId(), 'schema', array(
            0 => array(
                  0 => 'administrator',
                  2 => 'schemaadmin',
            ),
      ))
      ) {
        $UserLanguages = $schemaObj->getLanguages();
        $DefaultLanguage = $schemaObj->getLanguage();
      } else {
        if ($schemaUser) {
          $UserLanguages = $schemaUser->getLanguages();
          $DefaultLanguage = $schemaUser->getDefaultLanguage();
        } else {
          //set the languages from the schema
          $UserLanguages = $schemaObj->getLanguages();
          $DefaultLanguage = $schemaObj->getLanguage();
        }
      }

      if (is_array($UserLanguages) && !in_array($CurrentCulture, $UserLanguages)) {
        //save the current culture
        $UserCulture = $sfUser->getCulture();
        $this->getUser()->setAttribute("UserCulture", $UserCulture);
        //reset the current culture for edit
        $sfUser->setCulture($DefaultLanguage);
        $this->getUser()->setAttribute("CurrentLanguage", $DefaultLanguage);
        $culture = new sfCultureInfo($this->getUser()->getCulture());
        $this->setFlash('notice', 'Current language is not available for edit! Current editing language has been reset to: ' . $culture->getNativeName());
      }
      $this->getUser()->setAttribute("languages", $UserLanguages);
    }
    parent::executeEdit();
    /** @var $schemaProperty SchemaProperty */
    $schemaProperty = $this->schema_property;
    if ($schemaProperty) {
      $schemaObj = $this->getCurrentSchema();
      $schemaProperty->setSchemaUri($this->getBaseUri($schemaObj));

      $lexUri = $schemaProperty->getLexicalAlias();
      if (empty($lexUri)) {
        $newURI = $this->getBaseUri($schemaObj);
        $this->setDefaultLexicalAlias($schemaProperty, $newURI);
      }
    }
  }

  public function executeList ()
  {
    //a current schema is required to be in the request URL
    myActionTools::requireSchemaFilter();

    //clear any existing property filters since they don't apply now
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_history/filters');
    //clear the existing page
    /**
    * @todo clear the existing page only if sort has changed
    **/
    //$this->getUser()->getAttributeHolder()->remove('page', 'sf_admin/schema_property');
    parent::executeList();
  }

  /**
   * Show RDF
   */
  public function executeShowRdf ()
  {
    $ts = strtotime($this->getRequestParameter('ts'));
    $this->timestamp = $ts;
    /** @var SchemaProperty **/
    if (!$this->property)
    {
      $this->property = SchemaPropertyPeer::retrieveByPk($this->getRequestParameter('id'));
    }
    $this->labels = $this->getLabels('show');

    $this->forward404Unless($this->property);
    $this->schema = $this->property->getSchema();
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
        if ($schema)
        {
          myActionTools::setLatestSchema($schema->getId());
        }
      }
    }

    $this->forward404Unless($schema,'No Element Set has been selected.');

    $this->schema = $schema;
    $this->schemaID = $schema->getId();

    return $schema;
  }

  public function executeProperties()
  {
    $this->redirect('/schemaprop/list?schemaprop_id=' . $this->getRequestParameter('id'));
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

  /**
   * @param  Schema $schemaObj
   *
   * @return string
   */
  public function getBaseUri($schemaObj)
  {
    $schemaDomain = $schemaObj->getUri();
    //URI looks like: agent(base_domain) / schema(token) / schema(next_schemaprop_id) / skos_property_id # schemaprop(next_property_id)
    $trailer = preg_match('%(/|#)$%im', $schemaDomain) ? '' : '/';
    $newURI  = $schemaDomain . $trailer;
    return $newURI;
    //registry base domain is http://metadataregistry.org/uri/
    //schema carries denormalized base_domain from agent
  }

  /**
  * overload saveSchemaProperty
  *
  * @return mixed
  * @param  SchemaProperty $schema_property
  */
  protected function saveSchemaProperty($schema_property)
  {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $affectedRows = $schema_property->saveSchemaProperty($userId);

    return $affectedRows;
  }

  public function executeSearch ()
  {
    if (!$this->getRequestParameter('sort'))
    {
      //make 'updated at' the default sort order
      $this->getRequest()->setParameter('sort','updated');
      $this->getRequest()->setParameter('type','desc');
    }
    $sort_column = $this->getRequestParameter('sort');
    switch ($sort_column)
    {
      case 'schema_prop_label':
        $sort_column = SchemaPropertyPeer::LABEL;
        break;
      case 'schema_name':
        $sort_column = SchemaPeer::NAME;
        break;
      case 'property_type':
        $sort_column = SchemaPropertyPeer::TYPE;
        break;
      case 'language':
        $sort_column = SchemaPropertyPeer::LANGUAGE;
        break;
      case 'updated':
        $sort_column = SchemaPropertyPeer::UPDATED_AT;
        break;
    }
    $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/schema_search/sort');
    $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/schema_search/sort');

   if ($this->getRequest()->hasParameter('sq'))
    {
      $this->getRequest()->setParameter('filter','filter');
      $filters = array('label' => $this->getRequestParameter('sq'));
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_search/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/schema_search/filters');
   }
   $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/schema_search/filters');

    // pager
   $this->pager = new sfPropelPager('SchemaProperty', 20);

   $c = new Criteria();

   //set sort criteria
   if ($sort_column)
   {
    if ($this->getUser()->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc')
    {
      $c->addAscendingOrderByColumn($sort_column);
    }
    else
    {
      $c->addDescendingOrderByColumn($sort_column);
    }
   }

   if (isset($this->filters['label']) && $this->filters['label'] !== '')
    {
      $c->add(SchemaPropertyPeer::LABEL, '%' . $this->filters['label'] . '%', Criteria::LIKE);
    }

    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectSearchResults');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  } //executeSearch


}
