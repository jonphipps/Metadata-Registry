<?php
class userObjectFilter extends sfFilter
{
  public function execute($filterChain)
  {
    {
      // get the cool stuff
      /** @var sfContext **/
      $context    = $this->getContext();
      /** @var sfController **/
      $controller = $context->getController();
      /** @var sfUser **/
      $user       = $context->getUser();
      /** @var sfRequest **/
      $request    = $context->getRequest();

      $key = false;

      // get the current action instance
      /** @var sfActionStackEntry **/
      $actionEntry    = $controller->getActionStack()->getLastEntry();
      $actionInstance = $actionEntry->getActionInstance();

      //get the object security information
      $securityArray = $actionInstance->getSecurityConfiguration();
//      if (isset($securityArray['all']['object_credentials']))
//      {
//        $objectCredArray = $securityArray['all']['object_credentials'];
//      }

      $action = $request->getParameter('action');
//      if ($action && isset($securityArray[$action]['object_credentials']))
//      {
//        $objectCredArray = $securityArray[$request->getParameter('action')]['object_credentials'];
//      }

      $objectCredArray = myUser::parseSecurity($securityArray, $action);

      //set the module to the supplied credential module or the current module
      if (isset($objectCredArray['module']))
      {
        $module = $objectCredArray['module'];
      }
      else
      {
        $module = $context->getModuleName();
      }

       //Does the request parameter exist?
      if (isset($objectCredArray))
      {
        $requestParam = $request->getParameter($objectCredArray['request_param']);
      }

      if (isset($requestParam))
      {
        //get the correct id to check against, but only if we haven't already checked it in this request
        if (isset($objectCredArray['key']))
        {
          //look to see if we already have the attribute
          if (isset($objectCredArray['key']['class']))
          {
            $class = $objectCredArray['key']['class'];
            $method = $objectCredArray['key']['method'];
          }
          $key = $user->getAttribute($requestParam, null, myUser::DATA_NAMESPACE . '/' . $class);
          if (null == $key)
          {
            /*
            *@TODO There should be more error handling here
            */
            //lookup the key
            $key = call_user_func(array($class, $method), $requestParam);
            //add it to the attributes
            $user->setAttribute($requestParam, $key, myUser::DATA_NAMESPACE . '/' . $class);
          }
        }
        //we set the requestparam to lookup, but we didn't set a key
        else
        {
          $key = $requestParam;
        }
      }
      //no security request param set
      elseif ($module == $context->getModuleName())
      {
        //we do the default
        $key = $request->getParameter('id');
      }

      //still no key?
      //ok, so this is definitely a hack...
      if (!$key && 'vocabulary' == $module && ('edit' == $action || 'show' == $action || 'list' == $action))
      {
        $vocabulary = VocabularyPeer::findCurrentVocabulary();
        if ($vocabulary)
        {
          $key = $vocabulary->getId();
        }
      }


      if ($key)
      {
        $user->buildModCredentials($key, $module);
      }
      //skip re-setting the modcredentials if the action == create
      else
      {
        $user->modCredentials = $user->listCredentials();
        $cred = $user->getTmpCredential();
        if ($cred)
        {
          $user->modCredentials[] = $cred;
        }

      }

      if ($request->getCookie('MyWebSite'))
      {
        // sign in
        $user->setAuthenticated(true);
      }
    }

    // Execute next filter
    $filterChain->execute();
  }
}

