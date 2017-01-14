<?php

class sfRefererFilter extends sfFilter
{

    /**
     * @param sfFilterChain $filterChain
     */
    public function execute($filterChain)
    {
        // adjust request_stack session attribute before all actions
        /** @var sfContext $this ->getContext() * */
        /** @var myUser $user */
        $user = $this->getContext()->getUser();
        /** @var myWebRequest $request * */
        $request = $this->getContext()->getRequest();
        $action  = $this->getContext()->getActionName();
        $module  = $this->getContext()->getModuleName();
        $route_name = sfRouting::getInstance()->getCurrentRouteName();

        /** @var myUser * */
        //uncomment this for test-clearing all user session variables
        //$user->getAttributeHolder()->clear();

        if ( ! ( "user" == $module and ( "login" == $action or "logout" == $action ) )) {
            $default_referer = '@homepage';
            if ($this->getContext()->getActionStack()->getSize() > 0) {
                /** @var sfActions $action */
                $action      = $this->getContext()->getActionStack()->getFirstEntry()->getActionInstance();
                $security    = $action->getSecurityConfiguration();
                $action_name = $this->getContext()->getActionStack()->getFirstEntry()->getActionName();

                // module/config/security.yml action setting takes priority
                if (isset( $security[$action_name]['is_secure'] ) && $security[$action_name]['is_secure']) {
                    $referer      = $request->getUri();
                    $refererRoute = $route_name;
                } elseif (isset( $security['all']['is_secure'] ) && ! $security['all']['is_secure']) {
                    $referer      = $request->getUri();
                    $refererRoute = $route_name;
                } else {
                    $referer      = $default_referer;
                    $refererRoute = $default_referer;
                }

            } else {
                $referer      = $default_referer;
                $refererRoute = $default_referer;
            }

            $user->setAttribute('referer', $referer, 'sfRefererPlugin');
            $user->setAttribute('referer_route', $refererRoute, 'sfRefererPlugin');
        }

        if (sfRequest::GET == $request->getMethod()) {
            $request_stack = $user->getAttribute('request_stack', [], 'sfRefererPlugin');

            if (isset( $request_stack['current_uri'] )) {
                $request_stack['last_uri'] = $request_stack['current_uri'];
            }
            if (isset( $request_stack['current_route'] )) {
                $request_stack['last_route'] = $request_stack['current_route'];
            }

            $request_stack['current_uri'] = $request->getUri();
            $request_stack['current_route'] = $route_name;

            $user->setAttribute('request_stack', $request_stack, 'sfRefererPlugin');
        }

        // execute next filter in chain
        $filterChain->execute();

    }

}


