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
 *
 * @package    registry
 * @subpackage schemaprop
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemapropActions extends autoschemapropActions
{
  public function preExecute()
  {
    if ('search' != $this->getRequestParameter('action') && 'language' != $this->getRequestParameter('action')) {
      $schemaObj = $this->getCurrentSchema();
      $SchemaLanguages = $schemaObj->getLanguages();
      $CurrentCulture = sfContext::getInstance()->getUser()->getCulture();
      $this->getUser()->setAttribute("languages", $SchemaLanguages);
      $this->getUser()->setAttribute("CurrentLanguage", $CurrentCulture);

      //todo: What if the user is an admin and has global editorial access? The following blows up because it requires moderator-level permissions.
      //todo: this should not be in preExecute but rather a method called before create/edit/list _or_ we skip it for save/delete
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();

      if ("edit" == $this->getActionName() && $userId) {
        $c = new Criteria();
        $c->add(SchemaHasUserPeer::USER_ID, $userId);
        $c->add(SchemaHasUserPeer::SCHEMA_ID, $schemaObj->getId());
        $schemaUser = SchemaHasUserPeer::doSelectOne($c);
        if ($schemaUser) {
          $UserLanguages   = $schemaUser->getLanguages();
          $DefaultLanguage = $schemaUser->getDefaultLanguage();
        }
        else {
          //set the languages from the schema
          $UserLanguages   = $schemaObj->getLanguages();
          $DefaultLanguage = $schemaObj->getLanguage();
        }

        //get all the languages if the language is "*"
        if (in_array("*", $UserLanguages))
        {
          $UserLanguages   = $schemaObj->getLanguages();
        }

        if (!in_array($CurrentCulture, $UserLanguages)) {
          //save the current culture
          $UserCulture = sfContext::getInstance()->getUser()->getCulture();
          $this->getUser()->setAttribute("UserCulture", $UserCulture);
          //reset the current culture for edit
          sfContext::getInstance()->getUser()->setCulture($DefaultLanguage);
          $this->getUser()->setAttribute("CurrentLanguage", $DefaultLanguage);
          $culture = new sfCultureInfo($this->getUser()->getCulture());
          $this->setFlash('notice', 'Current language is not available for edit! Current editing language has been reset to: ' . $culture->getNativeName());
        }
        $this->getUser()->setAttribute("languages", $UserLanguages);
      }

      else {
        $UserCulture = $this->getUser()->getAttribute("UserCulture", FALSE);
        if ($this->getUser()->getAttribute("UserCulture", FALSE)) {
          sfContext::getInstance()->getUser()->setCulture($UserCulture);
        }
      }
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
    $schemaId  = $schemaObj->getId();
    $schemaprop->setSchemaId($schemaId);
    $schemaprop->setCulture($this->getUser()->getCulture());

    $schemapropParam = $this->getContext()->getRequest()->getParameter('schema_property');
    if (! $this->getContext()->getRequest()->getErrors() and ! isset($schemapropParam['uri'])) {
      $this->setDefaultUri($schemaprop, $schemaObj);
      $schemaprop->setLabel('');
      //set to the schema defaults
      //$schemaprop->setLanguage($schemaObj->getLanguage());
      $schemaprop->setStatusId($schemaObj->getStatusId());
    }

    parent::setDefaults($schemaprop);
  }

  public function executeLanguage() {
    $culture = $this->getRequestParameter('culture');
    $this->getUser()->setCulture($culture);
    $this->getUser()->setAttribute("UserCulture", $culture);
    $foo = new sfCultureInfo($this->getUser()->getCulture());
    $this->setFlash('notice', 'New current session locale : '. $foo->getNativeName());
    $url = $this->getRequest()->getReferer() != '' ? $this->getRequest()->getReferer() : '@homepage';
    $this->redirect($url);
  } //executeLanguage

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
    $this->setDefaultLexicalUri($schemaprop, $newURI);
  }

  /**
   * @param SchemaProperty $schemaprop
   * @param string         $newURI
   */
  public function setDefaultLexicalUri($schemaprop, $newURI)
  {
    $schemaprop->setLexicalUri($newURI . "[LEXICAL_TOKEN]");
  }

  public function executeEdit()
  {
    parent::executeEdit();
    /** @var $schemaProperty SchemaProperty */
    $schemaProperty = $this->schema_property;
    if ($schemaProperty) {
      $schemaObj = $this->getCurrentSchema();
      $schemaProperty->setSchemaUri($this->getBaseUri($schemaObj));

      $lexUri = $schemaProperty->getLexicalUri();
      if (empty($lexUri)) {
        $newURI = $this->getBaseUri($schemaObj);
        $this->setDefaultLexicalUri($schemaProperty, $newURI);
      }
    }
  }

  public function executeList()
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
  public function executeShowRdf()
  {
    $ts              = strtotime($this->getRequestParameter('ts'));
    $this->timestamp = $ts;

    if (! $this->property) {
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

    if (! $schema) //we have to do it the hard way
    {
      $this->schemaprop = SchemaPropertyPeer::retrieveByPk($this->getRequestParameter('id'));
      if (isset($this->schemaprop)) {
        $schema = $this->schemaprop->getSchema();
        if ($schema) {
          myActionTools::setLatestSchema($schema->getId());
        }
      }
    }

    $this->forward404Unless($schema, 'No Element Set has been selected.');

    $this->schema   = $schema;
    $this->schemaID = $schema->getId();

    return $schema;
  }

  public function executeProperties()
  {
    $this->redirect('/schemaprop/list?schemaprop_id=' . $this->getRequestParameter('id'));
  }

  public function executeGetSchemaPropertyList()
  {
    $schemaId     = $this->getRequestParameter('selectedSchemaId');
    $schemapropId = sfContext::getInstance()->getUser()->getAttribute('schemaprop')->getId();
    $results      = SchemaPropertyPeer::getSchemaPropertysByVocabID($schemaId, $schemapropId);
    foreach ($results as $myCschemaprop) {
      $options[$myCschemaprop->getId()] = $myCschemaprop->getPrefLabel();
    }
    if (! isset($options)) {
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
   *
   * @param  SchemaProperty $schema_property
   */
  protected function saveSchemaProperty($schema_property)
  {
    $userId       = sfContext::getInstance()->getUser()->getSubscriberId();
    $affectedRows = $schema_property->saveSchemaProperty($userId);

    return $affectedRows;
  }

  public function executeSearch()
  {
    if (! $this->getRequestParameter('sort')) {
      //make 'updated at' the default sort order
      $this->getRequest()->setParameter('sort', 'updated');
      $this->getRequest()->setParameter('type', 'desc');
    }
    $sort_column = $this->getRequestParameter('sort');
    switch ($sort_column) {
      case 'schema_prop_label':
        $sort_column = SchemaPropertyi18nPeer::LABEL;
        break;
      case 'schema_name':
        $sort_column = SchemaPeer::NAME;
        break;
      case 'property_type':
        $sort_column = SchemaPropertyPeer::TYPE;
        break;
//      case 'language':
//        $sort_column = SchemaPropertyPeer::LANGUAGE;
//        break;
      case 'updated':
        $sort_column = SchemaPropertyPeer::UPDATED_AT;
        break;
    }
    $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/schema_search/sort');
    $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/schema_search/sort');

    if ($this->getRequest()->hasParameter('sq')) {
      $this->getRequest()->setParameter('filter', 'filter');
      $filters = array('label' => $this->getRequestParameter('sq'));
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_search/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/schema_search/filters');
    }
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/schema_search/filters');

    // pager
    $this->pager = new sfPropelPager('SchemaProperty', 20);

    $c = new Criteria();

    //set sort criteria
    if ($sort_column) {
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/schema_search/sort') == 'asc') {
        $c->addAscendingOrderByColumn($sort_column);
      } else {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }

    if (isset($this->filters['label']) && $this->filters['label'] !== '') {
      $c->add(SchemaPropertyI18nPeer::LABEL, '%' . $this->filters['label'] . '%', Criteria::LIKE);
    }

    $c->addJoin(SchemaPropertyI18nPeer::ID,SchemaPropertyPeer::ID);

    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectSearchResults');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  } //executeSearch

}
