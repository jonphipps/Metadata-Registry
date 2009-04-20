<?php

/**
 * login validator.
 *
 * @package    Registry
 * @subpackage user
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: myLoginValidator.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
 class myLoginValidator extends sfValidator
 {
   public function initialize ($context, $parameters = null)
   {

     // initialize parent
     parent::initialize($context);

     // set defaults
     $this->getParameterHolder()->set('login_error', 'Invalid input');

     $this->getParameterHolder()->add($parameters);

     return true;
   }

   /**
    * Execute this validator.
    *
    * @param mixed A file or parameter value/array.
    * @param error An error message reference.
    *
    * @return bool true, if this validator executes successfully, otherwise
    *              false.
    */
   public function execute (&$value, &$error)
   {
     $actionName = $this->getContext()->getActionStack()->getFirstEntry()->getActionName();

     if (isset ($actionName) and 'add' == $actionName)
     {
       $addError = $this->getContext()->getRequest()->getError('nickname');
       if(isset($addError)) //a nickname error has already been generated so we grab it
       {
         $error = $addError;
         return false;
       }
       //see if there are other errors
       if (count($this->getContext()->getRequest()->getErrorNames()))
       {
         $error = null;
         return false;
       }
     }

     $password_param = $this->getParameterHolder()->get('password');
     $password = $this->getContext()->getRequest()->getParameter($password_param);

     $login = $value;

     // anonymous is not a real user
     if ($login == 'anonymous')
     {
       $error = $this->getParameterHolder()->get('login_error');
       return false;
     }

     if ($user = UserPeer::getAuthenticatedUser($login, $password))
     {
       $this->getContext()->getUser()->signIn($user);

       return true;
     }

     $error = $this->getParameterHolder()->get('login_error');
     return false;
   }
}

