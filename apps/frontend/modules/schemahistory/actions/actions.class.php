<?php

/**
* schemahistory actions.
*
* @package    registry
* @subpackage schemahistory
* @author     Jon Phipps <jonphipps@gmail.com>
* @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
*/
class schemahistoryActions extends autoSchemahistoryActions
{

    public function executeShow()
    {
        parent::executeShow();
        $this->breadcrumbs = \apps\frontend\lib\Breadcrumb::elementSetHistoryDetailFactory($this->schema_property_element_history);
    }


    public function executeFeed()
  {
    /** @var sfWebRequest **/
    $request = $this->getContext()->getRequest();
    $IdType = $this->getRequestParameter('IdType', null);
    $id = $this->getRequestParameter('id', null);

    //Build the title
    $title = "Metadata Registry Change History";
    $filter = false;

    switch ($IdType)
    {
      //Elementset :: (Schema)Element  :: (Schema)ElementProperty
      //Schema     :: SchemaProperty :: SchemaPropertyElement
      case "schema_property_element_id":
        /** @var SchemaPropertyElement **/
        $element = DbFinder::from('SchemaPropertyElement')->findPk($id);
        if ($element)
        {
          /** @var SchemaProperty $property **/
          $property = $element->getSchemaPropertyRelatedBySchemaPropertyId();
          $title .= " for Property: '" .    $element->getProfileProperty()->getLabel();
          if ($property)
          {
            $title .= "' of Element: '" .     $property->getLabel() .
                      "' in Element Set: '" . $property->getSchema()->getName() . "'";
          }
        }
        $filter = true;
        break;
      case "schema_property_id":
        /** @var SchemaProperty **/
        $property = DbFinder::from('SchemaProperty')->findPk($id);
        if ($property)
        {
          $title .= " for Element: '" .     $property->getLabel() .
                    "' in Element Set: '" . $property->getSchema()->getName() . "'";
        }
        $filter = true;
        break;
      case "schema_id":
        /** @var Schema **/
        $schema = DbFinder::from('Schema')->findPk($id);
        if ($schema)
        {
          $title .= " for Element Set: '" . $schema->getName() . "'";
        }
        $filter = true;
        break;
      default: //the whole shebang
        $title .= " for all Element Sets";
        break;
    }

    $column = sfInflector::camelize($IdType);

    //default limit to 100 if not set in config
    $limit = $request->getParameter('nb', sfConfig::get('app_frontend_feed_count', 100));

    $finder = DbFinder::from('SchemaPropertyElementHistory')
      ->orderBy('SchemaPropertyElementHistory.CreatedAt', 'desc')
      ->join('SchemaPropertyElementHistory.SchemaPropertyElementId', 'SchemaPropertyElement.Id', 'left join')
      ->join('SchemaProperty','left join')
      ->join('Schema','left join')
      ->join('Status','left join')
      ->join('User','left join')
      ->join('ProfileProperty','left join')
      ->with('Schema','ProfileProperty','User','Status','SchemaProperty');

    if ($filter)
    {
      $finder = $finder->where('SchemaPropertyElementHistory.'.$column,$id);
    }

    $finder = $finder->find($limit);

    $this->setTemplate('feed');
    $this->feed = sfFeedPeer::createFromObjects(
      $finder,
      array(
        'format'      => $request->getParameter('format', 'atom1'),
        'link'        => $request->getUriPrefix() . $request->getPathInfo(),
        'feedUrl'     => $request->getUriPrefix() . $request->getPathInfo(),
        'title'       => htmlentities($title),
        'methods'     => array('authorEmail' => '', 'link' => 'getFeedUniqueId')
      )
    );

    return;
  }
  public function executeList ()
  {
      $idType = myActionTools::findIdType($this->getRequest()->getParameterHolder());
      $id     = $this->getRequestParameter('id', null);

      if ( ! $idType) {
          //a current schema is required to be in the request URL
          myActionTools::requireSchemaFilter();
      } else {
          if ($id) {
              $this->getRequest()->getParameterHolder()->set($idType, $id);
          }
      }

      if ($idType !== 'import_id') {
          $schema = myActionTools::findCurrentSchema();
          if ($schema) {
              $this->schema = $schema;
              $schemaId     = $schema->getId();
          }
          if ($idType === 'schema_property_id') {
              $property = SchemaPropertyPeer::retrieveByPK($this->getRequestParameter($idType));
          }
          if ($idType === 'schema_property_element_id') {
              $propertyElement = SchemaPropertyElementPeer::retrieveByPK($this->getRequestParameter($idType));
              /** @var SchemaPropertyElement $propertyElement */
              if ($propertyElement) {
                  try {
                      $property = $propertyElement->getSchemaPropertyRelatedBySchemaPropertyId();
                  }
                  catch (PropelException $e) {
                  }
              }
          }
          if (isset($property)) {
              $this->property = $property;
              $this->setFlash('hasProperty', true);
              $schemaId = $this->property->getSchemaId();
          }
      } else {
          $id     = $this->getRequestParameter('import_id', null);
          $import = FileImportHistoryPeer::retrieveByPK($id);
          if ($import) {
              $schema       = $import->getSchema();
              $this->schema = $schema;
              $schemaId     = $schema->getId();
          }
      }

      //get the versions array
      $c = new Criteria();
      $c->add(SchemaHasVersionPeer::SCHEMA_ID, $schemaId);
      $versions = SchemaHasVersionPeer::doSelect($c);
      $this->setFlash('versions', $versions);

      parent::executeList();
  }

  /**
  * description
  *
  * @return this function either does nothing or redirects
  * @param  string  $ns The namespace to check for filters
  */
  private function checkFilter($ns)
  {
    $filters = $this->getUser()->getAttributeHolder()->getAll("sf_admin/$ns/filters");
    $params = $this->getRequest()->getParameterHolder()->getAll();
    if ($filters)
    {
      $params2 = array_merge($params, $filters);
      //if we already have a filter, but adding it changes the string
      if ($params != $params2)
      {
        $curParams = $params;

        foreach ($filters as $filter => $value)
        {
          if (!isset($params[$filter])) //that filter is not already in the URL
          {
            //an exception
            $filter = ('schema_property_element_id' == $filter) ? 'schema_property_id' : $filter;
            //we add it
            $params += array($filter => $value);
          }
        }

        if ($curParams != $params) //we've reset some of the params to match the filter
        {
          //we head on out
          $this->redirect($params);
        }
      }
    }
  }
}
