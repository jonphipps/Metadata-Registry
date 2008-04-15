<?php

/**
 * schemahistory actions.
 *
 * @package    registry
 * @subpackage schemahistory
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemahistoryActions extends autoschemahistoryActions
{
  public function executeList ()
  {
    //order is important here
    $search = array(
       array('ns' => 'schema_property_element_history', 'id' => ''),
       array('ns' => 'schema_property_element', 'id' => 'schema_property_element_id'),
       array('ns' => 'schema_property', 'id' => 'schema_property_id'),
       array('ns' => 'schema', 'id' => 'schema_id'),
       );
    //one thing -- there's an edge case that has 2 existing IDs in the query string
    //we're not dealing with that yet

    $params = $this->getRequest()->getParameterHolder()->getAll();
    $found = false;

    //we check to see if there's already an id of any kind in the params
    for($i=1; $i<4; $i++)
    {
      if(array_key_exists($search[$i]['id'], $params)) //what we're looking for is in the params
      {
        $found = true;
        break;
      }
    }

    if(!$found) //Still here? We check to see if there's a filter
    {
      for($i=0; $i<4; $i++)
      {
        //check the filters in order and take the first we come to...
        $this->checkFilter($search[$i]['ns']);
        break;
      }
      //if we get to here, no params or filters have been set
      //a current vocabulary is required to be in the request URL
      myActionTools::requireSchemaFilter();
    }

    $schema = myActionTools::findCurrentSchema();
    $this->schema = $schema;

    if (isset($params['schema_property_id']) || isset($params['schema_property_element_id']))
    {
      $this->property = myActionTools::findCurrentSchemaProperty();
      $this->setFlash('hasProperty', true);
    }

    //get the versions array
    $c = new Criteria();
    $c->add(SchemaHasVersionPeer::SCHEMA_ID, $schema->getId());
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
