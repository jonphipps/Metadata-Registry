<?php

class sfRefererFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    // adjust request_stack session attribute before all actions
    $user = $this->getContext()->getUser();
    $request = $this->getContext()->getRequest();

    $request_stack = $user->getAttribute('request_stack', '', 'sfRefererPlugin');

    if (isset($request_stack['current_uri']))
    {
      $request_stack['last_uri'] = $request_stack['current_uri'];
    }

    $request_stack['current_uri'] = $request->getUri();

    $user->setAttribute('request_stack', $request_stack, 'sfRefererPlugin');

    // execute next filter in chain
    $filterChain->execute();

  }
}


