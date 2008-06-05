<?php

/**
 * api actions.
 *
 * @package    Registry
 * @subpackage api
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class apiActions extends sfActions
{
  public function preExecute()
  {
    sfConfig::set('sf_web_debug', false);
  }

  public function executeGet()
  {
    //debugbreak();
    $uri = $this->getRequestParameter('uri');
    $module = $this->getRequestParameter('type');
    $class = strtolower($this->getRequestParameter('class'));
    switch ($class)
    {
      case 'concept':
        switch ($module)
        {
          case 'html':
            /** @var Concept **/
            $concept = ConceptPeer::getConceptByUri($uri);
            $this->forward404Unless($concept);
            //redirect
            $host = $this->getRequest()->getPathInfoParam('HTTP_HOST');
            return $this->renderText("http://" . $host . "/concept/show/id/". $concept->getId() . ".html");
            //forward
            //$this->getRequest()->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            $this->getRequest()->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'rdf', 'showConcept');
            break;
        }
        break;
      case 'concept_scheme':
      case 'conceptscheme':
        switch ($module)
        {
          case 'html':
            /** @var Vocabulary **/
            $vocabulary = VocabularyPeer::retrieveByUri($uri);
            $this->forward404Unless($vocabulary);
            //redirect
            $host = $this->getRequest()->getPathInfoParam('HTTP_HOST');
            return $this->renderText("http://" . $host . "/vocabulary/show/id/". $vocabulary->getId() . ".html");
            //forward
            //$this->getRequest()->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            $this->getRequest()->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'rdf', 'showScheme');
            break;
          case 'xsd':
            //reset the type
            $this->getRequest()->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'xml', 'showScheme');
            break;
        }
        break;
      case 'schema':
        /** @var Vocabulary **/
        $schema = SchemaPeer::retrieveByUri($uri);
        $this->forward404Unless($schema);
        //forward
        $this->getRequest()->setParameter('id', $schema->getId());
        $this->forwardIf($uri, 'schema', 'showRdf');
        break;
      case 'schema_property':
      case 'schemaproperty':
        $this->forwardIf($uri, 'schemaprop', 'showRdf');
        break;
      default:
        $this->forward404();
    }
  }

  public function executeError()
  {
  }
}

