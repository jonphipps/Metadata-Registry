<?php

/**
 * rdf actions.
 *
 * @package    registry
 * @subpackage xml
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 1139 2006-04-07 08:46:23Z fabien $
 */
class xmlActions extends sfActions
{
  /**
   * Executes show action
   *
   */
  public function executeShowScheme()
  {
     //build the complete URI
     $rootUri = $this->getRequest()->getUriPrefix().'/';
     $schemeUri = $rootUri . 'uri/' . $this->getRequestParameter('scheme','');
     $type = $this->getRequestParameter('type');
     $ts = strtotime($this->getRequestParameter('ts'));
     $this->timestamp = $ts;
     $version = $this->getRequestParameter('version');

     //$_SERVER['HTTP_ACCEPT'] = '';
     //$_SERVER['HTTP_USER_AGENT'] = '';


     switch ($type)
     {
       case 'xmlschema':
          //this URI HAS an 'id', HAS an 'rdf' suffix, and does NOT have a 'uri' action
          $id = $this->getRequestParameter('id');
          $vocabulary = VocabularyPeer::retrieveByPK($id);
          $this->getContext()->getResponse()->setStatusCode(200);
          break;
       case 'html':
          //this URI does NOT have an 'id', HAS an 'html' suffix, and HAS a 'uri' action
          //redirect to the base registry using the correct id for the scheme:
          //   http://metadataregistry.org/concept/list/vocabulary_id/16.html
          $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);

          $this->forward404Unless($vocabulary);

          //redirect
          $this->getContext()->getResponse()->setStatusCode(303);
          $this->redirect($this->getRequest()->getUriPrefix() . '/concept/list/vocabulary_id/' . $vocabulary->getId());
          break;
       case 'uri':
          //this URI does NOT have an 'id', HAS an 'rdf' suffix, and HAS a 'uri' action
          //$this->getContext()->getResponse()->setStatusCode(303);
          $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);
          break;
       case 'api_uri':
          //this URI does NOT have an 'id', does NOT have an 'html' suffix, and comes from the API
          $uri = $this->getRequestParameter('uri','');
          $vocabulary = VocabularyPeer::retrieveByUri($uri);
          break;
       default: //covers case of 'unknown' too
          //this URI does NOT have an 'id', does NOT have a suffix, and HAS a 'uri' action
          //do content negotiation
          if ((true === strpos($_SERVER['HTTP_ACCEPT'],'text/html')) ||
              (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')) ||
              (0 === strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla')) )
          {
             //we redirect to html
             $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);

             $this->forward404Unless($vocabulary);
             //redirect
             $this->redirect($this->getRequest()->getUriPrefix() . '/concept/list/vocabulary_id/' . $vocabulary->getId() );
          }
          //else if ((true === strpos($_SERVER['HTTP_ACCEPT'],'text/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/rdf+xml')))
          else
          {
             $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);

          }
          break;
     }

    $this->forward404Unless($vocabulary);

    $this->vocabulary = $vocabulary;

    //forward to the timeslice if there's a version
    if($version && !$ts)
    {
      $c = new Criteria();
      $c->add(VocabularyHasVersionPeer::NAME, $version);
      $version = VocabularyHasVersionPeer::doSelectOne($c);
      $this->forward404Unless($version, 'Unknown version!');
      $ts = $version->getTimeslice('YmdHis');
      $this->getRequest()->getParameterHolder()->set('ts', $ts);
      $this->forward('xml','showScheme');
    }

    if (!$ts)
    {
      $this->concepts = $vocabulary->getConcepts();
    }
    else
    {
      $this->concepts = ConceptPeer::doSelectConceptByHistoryTimestamp($vocabulary->getid(), $ts);
    }
  }
}
