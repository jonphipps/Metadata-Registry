<?php
class userObjectFilter extends sfFilter
{
  public function execute($filterChain)
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

    if ($request->getCookie('MyWebSite'))
    {
      // sign in
      $user->setAuthenticated(true);
    }

    if (!$user->isAuthenticated())
    {
      //this will make sure we are really signed out
      $user->signOut();
      // we bail
      $filterChain->execute();
    }

    $key = false;

    // get the current action instance
    /** @var sfActionStackEntry **/
    $actionEntry    = $controller->getActionStack()->getLastEntry();
    $actionInstance = $actionEntry->getActionInstance();
    $action = $request->getParameter('action');

    //get the object security information
    $securityArray = $actionInstance->getSecurityConfiguration();
    $objectCredArray = myUser::parseSecurity($securityArray, $action);

    //The module is either the current module or the parent module.
    if (isset($objectCredArray['module']))
    {
      $module = $objectCredArray['module'];
    }
    else
    {
      $module = $context->getModuleName();
    }

    //object credentials are stored in
    //  $user->getAttribute($module,'','object_credentials')
    //the key for the object credentials comes from:
    //  request param
    //  the key of a stored parent object (need to know the parent object)

    //so next we need to know the key...

    //Does the request parameter exist?
    if (isset($objectCredArray['request_param']))
    {
      $key = $request->getParameter($objectCredArray['request_param'],'');
      //get the correct id to check against, but only if we haven't already checked it in this request
    }
    //use the default only if we're using the current request
    elseif ($module == $context->getModuleName())
    {
      //we do the default
      $key = $request->getParameter('id');
    }

    //still no key?
    //ok, so this is definitely a hack...
    if (!$key && (('edit' == $action || 'show' == $action || 'list' == $action) || $module != $context->getModuleName()))
    {
      if ('vocabulary' == $module)
      {
        $vocabulary = myActionTools::findCurrentVocabulary();
        if ($vocabulary)
        {
          $key = $vocabulary->getId();
        }
      }

      if ('agent' == $module)
      {
        $agent = myActionTools::findCurrentAgent();
        if ($agent)
        {
          $key = $agent->getId();
        }
      }
    }

    if ($key)
    {
      $user->buildModCredentials($key, $module);
    }
    //skip re-setting the modcredentials if the action == create
    else
    {
      $this->setdefaultCred($user);
    }

    // Execute next filter
    $filterChain->execute();
  }

  private function setdefaultCred($user)
  {
    $user->modCredentials = $user->listCredentials();
    $cred = $user->getTmpCredential();
    if ($cred)
    {
      $user->modCredentials[] = $cred;
    }
  }
}

