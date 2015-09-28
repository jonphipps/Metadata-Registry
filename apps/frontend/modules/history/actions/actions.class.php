<?php

/**
 * history actions.
 *
 * @package    registry
 * @subpackage history
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class historyActions extends autohistoryActions
{

  /**
  * rss and atom feeds
  *
  * @return return_type
  */
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
      case "property_id":
        /** @var ConceptProperty **/
        $conceptProperty = ConceptPropertyPeer::retrieveByPK($id);
        if ($conceptProperty)
        {
          $vocabularyname = ($conceptProperty->getVocabulary()) ? $conceptProperty->getVocabulary()->getName() : "?" ;
          $title .= " for Property: '" .   $conceptProperty->getProfileProperty()->getName() .
                    "' of Concept: '" .    $conceptProperty->getConceptRelatedByConceptId()->getPrefLabel().
                    "' in Vocabulary: '" . $vocabularyname . "'";
        }
        $filter = true;
        break;
      case "concept_id":
        /** @var Concept **/
        $concept = DbFinder::from('Concept')->findPk($id);
        if ($concept)
        {
          $title .= " for Concept: '" . $concept->getPrefLabel() .
                    "' in Vocabulary: '" . $concept->getVocabulary()->getName() . "'";
        }
        $filter = true;
        break;
      case "vocabulary_id":
        /** @var Vocabulary **/
        $vocab = DbFinder::from('Vocabulary')->findPk($id);
        if ($vocab)
        {
          $title .= " for Vocabulary: '" . $vocab->getName() . "'";
        }
        $filter = true;
        break;
      default: //the whole shebang
        $title .= " for all Vocabularies";
        break;
    }

    //special rule for property_id
    $column = ("property_id" == $IdType) ? "ConceptPropertyId" : sfInflector::camelize($IdType);

    //default limit to 100 if not set in config
    $limit = $request->getParameter('nb', sfConfig::get('app_frontend_feed_count', 100));

    $finder = DbFinder::from('ConceptPropertyHistory')
      ->orderBy('ConceptPropertyHistory.CreatedAt', 'desc')
      ->join('ConceptProperty','left join')
      ->join('Concept','left join')
      ->join('Vocabulary','left join')
      ->join('Status','left join')
      ->join('User','left join')
      ->join('SkosProperty','left join')
      ->with('Vocabulary','SkosProperty','User','Status','ConceptProperty','Concept');

    if ($filter)
    {
      $finder = $finder->where('ConceptPropertyHistory.'.$column,$id);
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
    $idType = $this->getRequestParameter('IdType', null);
    $id = $this->getRequestParameter('id', null);

    if(!$idType)
    {
      //a current vocabulary is required to be in the request URL
      myActionTools::requireVocabularyFilter();
    }
    else
    {
      $this->getRequest()->getParameterHolder()->set($idType, $id);
    }

    $vocabulary = myActionTools::findCurrentVocabulary();
    $this->vocabulary = $vocabulary;

    if (in_array($idType, array('concept_id','property_id')))
    {
      $this->concept = myActionTools::findCurrentConcept();
      $this->setFlash('hasConcept', true);
    }

    //get the versions array
    $c = new Criteria();
    $c->add(VocabularyHasVersionPeer::VOCABULARY_ID, $vocabulary->getId());
    $versions = VocabularyHasVersionPeer::doSelect($c);
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
            $filter = ('concept_property_id' == $filter) ? 'property_id' : $filter;
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

  /**
  * Finds the id type
  *
  * @deprecated 2009/06/28
  *
  * @return boolean
  * @param  boolean $checkFilters (optional)
  */
  private function findId($checkFilters = false)
  {
    $params = $this->getRequest()->getParameterHolder()->getAll();

    //order is important here
    $search = array(
       array('ns' => 'concept_property_history', 'id' => ''),
       array('ns' => 'concept_property', 'id' => 'property_id'),
       array('ns' => 'concept', 'id' => 'concept_id'),
       array('ns' => 'vocabulary', 'id' => 'vocabulary_id'),
       );
    /* @TODO -- there's an edge case that has 2 existing IDs in the query string
    we're not dealing with that yet
    */

    //we check to see if there's already an id of any kind in the params
    for($i=1; $i<4; $i++)
    {
      if(array_key_exists($search[$i]['id'], $params)) //what we're looking for is in the params
      {
        return $search[$i]['id'];
      }
    }
    //Still here? We check to see if there's a filter
    //
    if($checkFilters)
    {
      for($i=0; $i<4; $i++)
      {
        //check the filters in order and take the first we come to...
        $this->checkFilter($search[$i]['ns']);
      }
    }
    //if we get to here, no params or filters have been set
    return false;

  }
}
