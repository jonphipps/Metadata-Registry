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

  /**
  * Gets the date of the last update of a domain or uri
  *
  * @return integer (unless a format string is supplied)
  * @param  var_type $var
  */
  public function executeLastupdate()
  {
    //DebugBreak();
        /** @var sfRequest **/
    $request = $this->getRequest();
    $domain = $this->getRequestParameter('domain');
    $objects = $this->getRequestParameter('objects');
    $type = $this->getRequestParameter('type', "json");
    if (isset($domain))
    {
      if ('schemas' == $objects)
      {
        $lastUpdate = SchemaPropertyElementHistoryPeer::getLastUpdateForDomain($domain, null);
      }
      if ('vocabs' == $objects)
      {
        $lastUpdate = ConceptPropertyHistoryPeer::getLastUpdateForDomain($domain, null);
      }
    }

    switch ($type)
    {
      case "json":
        echo json_encode($lastUpdate);
        break;
      default:
    }

    return(sfView::NONE);
  }

  /**
  * gets information about all schema/vocab in a domain
  *
  * @return array
  */
  public function executeGetinfo()
  {
    //DebugBreak();
        /** @var sfRequest **/
    $request = $this->getRequest();
    $domain = $this->getRequestParameter('domain');
    $objects = $this->getRequestParameter('objects');
    $type = $this->getRequestParameter('type', "json");
    if (isset($domain))
    {
      if ('schemas' == $objects)
      {
        //get the schemas for this domain
        $result = SchemaPeer::getSchemasForDomain($domain);

        /** @var Schema **/
        for($id=0; $id<count($result); $id++)
        {
          $value = $result[$id];
          $uri = rtrim($value->getUri(),"/#");
          $index = strtolower($uri);
          $data[$index]['count'] = SchemaPeer::getPropertyCount($value->getId());
          $data[$index]['id'] = $value->getId();
          $data[$index]['language'] = $value->getLanguage();
          $data[$index]['lastUpdate'] = SchemaPeer::getLastUpdateDate($value->getId());
          $data[$index]['name'] = $value->getName();
          $data[$index]['note'] = $value->getNote();
          $data[$index]['status'] = $value->getStatus()->getDisplayName();
          $data[$index]['token'] = $value->getToken();
          $data[$index]['uri'] = $uri;
        }
      }
      if ('vocabs' == $objects)
      {
        //get the vocabularies for this domain
        $result = VocabularyPeer::getVocabulariesForDomain($domain);

        /** @var Vocabulary **/
        for($id=0; $id<count($result); $id++)
        {
          $value = $result[$id];
          $uri = rtrim($value->getUri(),"/#");
          $index = strtolower($uri);
          $data[$index]['count'] = VocabularyPeer::getConceptCount($value->getId());
          $data[$index]['id'] = $value->getId();
          $data[$index]['language'] = $value->getLanguage();
          $data[$index]['lastUpdate'] = VocabularyPeer::getLastUpdateDate($value->getId());
          $data[$index]['name'] = $value->getName();
          $data[$index]['note'] = $value->getNote();
          $data[$index]['status'] = $value->getStatus()->getDisplayName();
          $data[$index]['token'] = $value->getToken();
          $data[$index]['uri'] = $uri;
        }
      }
    }

    switch ($type)
    {
      case "json":
        echo json_encode($data);
        break;
      case "php":
        echo serialize($data);
        break;
      default:
    }

    return(sfView::NONE);
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
            /** @var Concept $concept **/
            $concept = ConceptPeer::getConceptByUri($uri);
            $this->forward404Unless($concept);
            $uri = $request->getUriPrefix() . "/concept/show/id/". $concept->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            //forward
            //$request->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $request->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'rdf', 'showConcept');
            break;
        }
        break;
      case 'concept_scheme':
      case 'conceptscheme':
        switch ($module)
        {
          case 'html':
            /** @var Vocabulary $vocabulary **/
            $vocabulary = VocabularyPeer::retrieveByUri($uri);
            $this->forward404Unless($vocabulary);
            $uri = $request->getUriPrefix() . "/vocabulary/show/id/". $vocabulary->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            //forward
            //$request->setParameter('vocabulary_id', $vocabulary->getId());
            //$this->forward('concept','list');
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $request->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'rdf', 'showScheme');
            break;
          case 'xsd':
            //reset the type
            $request->setParameter('type', 'api_uri');
            $this->forwardIf($uri, 'xml', 'showScheme');
            break;
        }
        break;
      case 'schema':
        /** @var Schema $schema **/
        $schema = SchemaPeer::retrieveByUri($uri);
        $this->forward404Unless($schema);
        switch ($module)
        {
          case 'html':
            $uri = $request->getUriPrefix() . "/schema/show/id/". $schema->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $request->setParameter('id', $schema->getId());
            $this->forwardIf($uri, 'schema', 'showRdf');
            break;
        }
        break;
      case 'schema_property':
      case 'schemaproperty':
        /** @var SchemaProperty $property **/
        $property = SchemaPropertyPeer::retrieveByUri($uri);
        $this->forward404Unless($property);
        switch ($module)
        {
          case 'html':
            $uri = $request->getUriPrefix() . "/schemaprop/show/id/". $property->getId() . ".html";
            //redirect
            $this->redirectIf($redir, $uri, 303);
            //return the url
            return $this->renderText($uri);
            break;
          case 'rdf':
            //redirect
            $this->redirectIf($redir, $uri . '.rdf', 303);
            //forward
            $request->setParameter('id', $property->getId());
            $this->forwardIf($uri, 'schemaprop', 'showRdf');
            break;
        }
        break;
      default:
        $this->forward404();
    }

    return(sfView::NONE);
  }

  public function executeError()
  {
  }
}

