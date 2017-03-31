<?php
class userObjectFilter extends sfFilter
{

  /**
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    // get the cool stuff
    /** @var sfContext **/
    $context    = $this->getContext();
    /** @var sfController **/
    $controller = $context->getController();
    /** @var myUser **/
    $user       = $context->getUser();
    /** @var myWebRequest **/
    $request    = $context->getRequest();

    /** @var myWebRequest $request */
    if ($request->getCookie('MyWebSite'))
    {
      // sign in
      $user->setAuthenticated(true);
    }

    if (!Auth::check())
    {
      //this will make sure we are really signed out
      $user->signOut();
      // we bail
      $filterChain->execute();
    }

    $key = false;

    if (app()->resolved('bugsnag')) {
      app()->bugsnag->registerCallback(function ($report) {
        $userId = Auth::user()->id;
        /** @var \Bugsnag\Report $report */
        $report->setUser([ 'id' => $userId ]);
      });
    }

    if ($user->getSubscriberId() == 0 && auth::user()) {
      $Luser = \UserPeer::retrieveByPK(auth::user()->id);
      if ($Luser) {
        $user->signIn($Luser);
      }
    }
    // get the current action instance
    /** @var sfActionStackEntry **/
    $actionEntry    = $controller->getActionStack()->getLastEntry();
    /** @var sfAction $actionInstance */
    $actionInstance = $actionEntry->getActionInstance();
    $action         = $request->getParameter('action');

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

    //big hack because I'm frustrated:
    if ('import' == $module) {
      if ($request->getParameter('vocabulary_id')) {
        $key = $request->getParameter('vocabulary_id');
        $module = 'vocabulary';
      }
      if ($request->getParameter('schema_id')) {
        $key = $request->getParameter('schema_id');
        $module = 'schema';
      }
    }
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
      if ('schema' == $module)
      {
        $schema = myActionTools::findCurrentSchema();
        if ($schema)
        {
          $key = $schema->getId();
        }
      }

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
      if ('vocabulary' == $module)
      {
        $vocabulary = myActionTools::findCurrentVocabulary();
        if ($vocabulary)
        {
          $agentId = $vocabulary->getAgentId();
          $user->buildModCredentials($agentId, 'agent', true);
        }
      }
    }
    //skip re-setting the modcredentials if the action == create
    else
    {
      $this->setdefaultCred($user);
    }

    // Execute next filter
    $filterChain->execute();
  }


  /**
   * @param myUser $user
   */
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

