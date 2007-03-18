<?php
    class userObjectFilter extends sfFilter
    {
      public function execute($filterChain)
      {
        {
          // Filters don't have direct access to the request and user objects.
          // You will need to use the context object to get them
          $request = $this->getContext()->getRequest();
          $user    = $this->getContext()->getUser();

          // get the cool stuff
          $context    = $this->getContext();
          $controller = $context->getController();
          $user       = $context->getUser();
          $request    = $context->getRequest();

          // get the current action instance
          $actionEntry    = $controller->getActionStack()->getLastEntry();
          $actionInstance = $actionEntry->getActionInstance();

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

