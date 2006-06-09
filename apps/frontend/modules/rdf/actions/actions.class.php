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
    if ('rdf' == $this->getRequestParameter('type'))
    {
       $id = $this->getRequestParameter('id');
       $vocabulary = VocabularyPeer::retrieveByPK($id);
    }
    else
    {
        //build the complete URI
       /**
       * @todo set the rootURI in a config parameter
       **/
       $rootUri = 'http://uri.registry/';
       $schemeUri = $rootUri . $this->getRequestParameter('scheme','');

       $vocabulary = VocabularyPeer::retrieveByUri($schemeUri);
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
    if ('rdf' == $this->getRequestParameter('type'))
    {
       $id = $this->getRequestParameter('id');
       $concept = ConceptPeer::retrieveByPK($id);
    }
    else
    {
       //build the complete URI
       /**
       * @todo set the rootURI in a config parameter
       **/
       $rootUri = 'http://uri.registry/';
       $conceptUri = $rootUri . $this->getRequestParameter('scheme','') . '/' . $this->getRequestParameter('concept','');

       $concept = ConceptPeer::getConceptByUri($conceptUri);
    }
    
    $vocabulary = $concept->getVocabulary();

    $this->forward404Unless($concept);

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