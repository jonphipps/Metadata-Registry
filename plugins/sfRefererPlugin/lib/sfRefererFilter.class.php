<?php

class sfRefererFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    // adjust request_stack session attribute before all actions
    $user = $this->getContext()->getUser();
    /** @var myWebRequest **/
    $request = $this->getContext()->getRequest();
    /** @var sfContext **/
    $action = $this->getContext()->getActionName();
    $module = $this->getContext()->getModuleName();

    /** @var myUser **/
    //uncomment this for test-clearing all user session variables
    //$user->getAttributeHolder()->clear();

    if (!("user" == $module and ("login" == $action or "logout" == $action)))
    {
      $default_referer = '@homepage';
      if ($this->getContext()->getActionStack()->getSize() > 0) {
        $action = $this->getContext()->getActionStack()->getFirstEntry()->getActionInstance();
        $security = $action->getSecurityConfiguration();
        $action_name = $this->getContext()->getActionStack()->getFirstEntry()->getActionName();

        // module/config/security.yml action setting takes priority
        if (isset($security[$action_name]['is_secure']) && $security[$action_name]['is_secure']) {
          $referer = $request->getUri();
        } elseif (isset($security['all']['is_secure']) && !$security['all']['is_secure']) {
          $referer = $request->getUri();
        } else {
          $referer = $default_referer;
        }

      } else {
        $referer = $default_referer;
      }

      $user->setAttribute('referer', $referer, 'sfRefererPlugin');
    }

    if (sfRequest::GET == $request->getMethod())
    {
      $request_stack = $user->getAttribute('request_stack', '', 'sfRefererPlugin');

        if (is_array($request_stack)) {
            if (isset($request_stack['current_uri'])) {
                $request_stack['last_uri'] = $request_stack['current_uri'];
            }
            $request_stack['current_uri'] = $request->getUri();
        } else {
            $request_stack = array();
        }
        $user->setAttribute('request_stack', $request_stack, 'sfRefererPlugin');
    }

    // execute next filter in chain
    $filterChain->execute();

  }



}


