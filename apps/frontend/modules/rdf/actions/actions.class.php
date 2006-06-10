<?php

/**
 * rdf actions.
 *
 * @package    registry
 * @subpackage rdf
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1139 2006-04-07 08:46:23Z fabien $
 */
class rdfActions extends sfActions
{
  /**
   * Executes show action
   *
   */
  public function executeShowScheme()
  {
     //build the complete URI
     $rootUri = 'http://'.$_SERVER['SERVER_NAME'].'/';
     $schemeUri = $rootUri . 'uri/' . $this->getRequestParameter('scheme','');
     $this->getContext()->getResponse()->setStatusCode(303);

     switch ($this->getRequestParameter('type'))
     {
       case 'rdf':
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
          $this->redirect('http://' . $_SERVER['SERVER_NAME'] . '/concept/list/vocabulary_id/' . $vocabulary->getId() . '.html');
          break;
       case 'uri':
          //this URI does NOT have an 'id', HAS an 'rdf' suffix, and HAS a 'uri' action
          $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);
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
             $this->redirect('http://' . $_SERVER['SERVER_NAME'] . '/concept/list/vocabulary_id/' . $vocabulary->getId() . '.html');
          }
          //else if ((true === strpos($_SERVER['HTTP_ACCEPT'],'text/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/rdf+xml')))
          else
          {
             $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);

             $this->forward404Unless($vocabulary);
             //we redirect to rdf
             $this->redirect('http://' . $_SERVER['SERVER_NAME'] . '/' . $_SERVER['REDIRECT_URL'] . '.rdf');
          }
          break;
     }

    $this->forward404Unless($vocabulary);

    $concepts = $vocabulary->getConcepts();

    $this->vocabulary = $vocabulary;
    $this->concepts = $concepts;

    // get the list of skos properties that reference resources
    $this->skosProps = SkosPropertyPeer::getResourceProperties();

    //get top concepts for vocabulary
    $this->getTopConcepts($vocabulary);
  }

  public function executeShowConcept()
  {
     //build the complete URI
     $rootUri = 'http://'.$_SERVER['HTTP_HOST'].'/';
     $conceptUri = $rootUri . 'uri/' . $this->getRequestParameter('scheme','') . '/' . $this->getRequestParameter('concept','');
     $this->getContext()->getResponse()->setStatusCode(303);

     switch ($this->getRequestParameter('type'))
     {
       case 'rdf':
          //this URI HAS an 'id', HAS an 'rdf' suffix, and does NOT have a 'uri' action
          $id = $this->getRequestParameter('id');
          $concept = ConceptPeer::retrieveByPK($id);
          $this->getContext()->getResponse()->setStatusCode(200);
          break;
       case 'html':
          //this URI does NOT have an 'id', HAS an 'html' suffix, and HAS a 'uri' action
          //redirect to the base registry using the correct id for the scheme:
          //   http://metadataregistry.org/concept/list/vocabulary_id/16.html
          $concept = ConceptPeer::getConceptByUri($conceptUri);

          $this->forward404Unless($concept);

          //redirect
          $this->redirect('http://' . $_SERVER['HTTP_HOST'] . '/conceptprop/list/concept_id/' . $concept->getId() . '.html');
          break;
       case 'uri':
          //this URI does NOT have an 'id', HAS an 'rdf' suffix, and HAS a 'uri' action
          $concept = ConceptPeer::getConceptByUri($conceptUri);
          break;
       default: //covers case of 'unknown' too
          //this URI does NOT have an 'id', does NOT have a suffix, and HAS a 'uri' action
          //do content negotiation
          if ((true === strpos($_SERVER['HTTP_ACCEPT'],'text/html')) ||
              (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')) ||
              (0 === strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla')) )
          {
             //we redirect to html
             $concept = ConceptPeer::getConceptByUri($conceptUri);

             $this->forward404Unless($concept);
             //redirect
             $this->redirect('http://' . $_SERVER['HTTP_HOST'] . '/conceptprop/list/concept_id/' . $concept->getId() . '.html');
          }
          //else if ((true === strpos($_SERVER['HTTP_ACCEPT'],'text/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/xml')) ||
          //    (true === strpos($_SERVER['HTTP_ACCEPT'], 'application/rdf+xml')))
          else
          {
             $concept = ConceptPeer::getConceptByUri($conceptUri);

             $this->forward404Unless($concept);
             //we redirect to rdf
             $this->redirect('http://' . $_SERVER['HTTP_HOST'] . '/' . $_SERVER['REDIRECT_URL'] . '.rdf');
          }
          break;
     }

    $this->forward404Unless($concept);

    $vocabulary = $concept->getVocabulary();

    //get the property data
    $properties = $concept->getConceptPropertysRelatedByConceptId();

    $this->properties = $properties;
    $this->vocabulary = $vocabulary;
    $this->concept = $concept;

    // get the list of skos properties that reference resources
    $this->skosProps = SkosPropertyPeer::getResourceProperties();

    //get top concepts for vocabulary
    $this->getTopConcepts($vocabulary);
  }

  /**
  * get the top concepts for a vocabulary
  *
  * @return void
  * @param  Vocabulary $vocabulary
  */
  function getTopConcepts($vocabulary)
  {
    //get top concepts for vocabulary
    $c = new Criteria();
    $c->add(ConceptPeer::IS_TOP_CONCEPT, 1);
    $this->topConcepts = $vocabulary->getConcepts($c);

    return;
  }
}

?>