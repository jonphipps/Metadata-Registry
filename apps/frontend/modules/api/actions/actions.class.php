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
    /** @var sfRequest **/
    $request = $this->getRequest();

    $redir = $this->getRequestParameter('redir', false);
    $uri = $this->getRequestParameter('uri');
    if (!$uri) //then build it
    {
      $uri = "http://" . $request->getPathInfoParam('HTTP_HOST') . $request->getPathInfoParam('REQUEST_URI');
      //strip trailing type
      $uri = preg_replace('/\.\w+$/U', '', $uri);
      //strip _dev script if it's part of the URI'
      $uri = preg_replace('%\w+\_dev.php/%', '', $uri);
    }

    $module = $this->getRequestParameter('type');
    if ('unknown' == $module) //then we have to figure it out
    {
      $accept = $request->getPathInfoParam('HTTP_ACCEPT');
      $agent = $request->getPathInfoParam('HTTP_USER_AGENT');

      //any of these will return html
      /*RewriteCond %{HTTP_ACCEPT} !application/rdf\+xml.*(text/html|application/xhtml\+xml)
        RewriteCond %{HTTP_ACCEPT} text/html [OR]
        RewriteCond %{HTTP_ACCEPT} application/xhtml\+xml [OR]
        RewriteCond %{HTTP_USER_AGENT} ^Mozilla/.*
        RewriteRule ^(.*)$ rdtest.php?type=html&uri=$1 [QSA,L]
      */
      if ((!preg_match('%application/rdf\+xml.*(text/html|application/xhtml\+xml)%im', $accept))
          && (preg_match('%text/html%im', $accept)
              || preg_match('%application/xhtml\+xml%im', $accept)
              || (preg_match('%^Mozilla/.*%im', $agent) && preg_match('%\*/\*%im', $accept))))
      {
        $module = 'html';
      }
      /*# Rewrite rule to serve RDF content is requested
        RewriteCond %{HTTP_ACCEPT} application/rdf\+xml
        RewriteRule ^(.*)$ rdtest.php?type=rdf&uri=$1 [QSA,L]
      */
      elseif (preg_match('%application/rdf\+xml%im', $accept))
      {
        $module = 'rdf';
      }
      elseif (preg_match('%text/rdf+n3%im', $accept))
      {
        $module = 'n3';
      }
      //default
      else
      {
        $module = sfConfig::get('default_conneg_type');
      }
    }

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
            $uri = $this->getRequest()->getUriPrefix() . "/concept/show/id/". $concept->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            //forward
            //$this->getRequest()->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
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
            $uri = $this->getRequest()->getUriPrefix() . "/vocabulary/show/id/". $vocabulary->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            //forward
            //$this->getRequest()->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
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
        /** @var Schema **/
        $schema = SchemaPeer::retrieveByUri($uri);
        $this->forward404Unless($schema);
        switch ($module)
        {
          case 'html':
            $uri = $this->getRequest()->getUriPrefix() . "/schema/show/id/". $schema->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $this->getRequest()->setParameter('id', $schema->getId());
            $this->forwardIf($uri, 'schema', 'showRdf');
            break;
        }
        break;
      case 'schema_property':
      case 'schemaproperty':
        /** @var SchemaProperty **/
        $property = SchemaPropertyPeer::retrieveByUri($uri);
        $this->forward404Unless($property);
        switch ($module)
        {
          case 'html':
            $uri = $this->getRequest()->getUriPrefix() . "/schemaprop/show/id/". $property->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $this->getRequest()->setParameter('id', $property->getId());
            $this->forwardIf($uri, 'schemaprop', 'showRdf');
            break;
        }
        break;
      default:
        $this->forward404();
    }
  }

  public function executeError()
  {
  }
}

