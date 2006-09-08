<?php

/**
 * user actions.
 *
 * @package    registry
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class userActions extends sfActions
{
  public function executeShow()
  {
    if ($this->hasRequestParameter('nickname'))
    {
      $this->subscriber = UserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    }
    else
    {
      $this->subscriber = $this->getUser()->getSubscriber();
    }
    $this->forward404Unless($this->subscriber);

//    $this->setShowVars();
  }

  public function executeUpdate()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->forward404();
    }

    $this->subscriber = $this->getUser()->getSubscriber();
    $this->forward404Unless($this->subscriber);

    $this->updateUserFromRequest();

    // password update
    if ($this->getRequestParameter('password'))
    {
      $this->subscriber->setPassword($this->getRequestParameter('password'));
    }

    $this->subscriber->save();

    $this->redirect('@user_profile?nickname='.$this->subscriber->getNickname());
  }

  public function executeLogin()
  {
      $request = $this->getRequest();
      $request->setAttribute('newaccount', false);
      $post = sfRequest::POST;

    if ($request->getMethod() != sfRequest::POST)
    {
      // display the form
      $response = $this->getResponse();
      $response->setTitle('The Registry! &raquo; sign in / register');
      $AttributeHolder = $request->getAttributeHolder();
      $referrer = $request->getReferer();
      $AttributeHolder->set('referer', $referrer);

      return sfView::SUCCESS;
    }
    else
    {
      // handle the form submission
      // redirect to last page
      return $this->redirect($this->getRequestParameter('referer', '@homepage'));
    }
  }

  public function executeLogout()
  {
    $this->getUser()->signOut();

    $this->redirect('@homepage');
  }

  public function executePasswordRequest()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      // display the form
      return sfView::SUCCESS;
    }

    // handle the form submission
    $c = new Criteria();
    $c->add(UserPeer::EMAIL, $this->getRequestParameter('email'));
    $user = UserPeer::doSelectOne($c);

    // email exists?
    if ($user)
    {
      // set new random password
      $password = substr(md5(rand(100000, 999999)), 0, 6);
      $user->setPassword($password);

      $this->getRequest()->setAttribute('password', $password);
      $this->getRequest()->setAttribute('nickname', $user->getNickname());

      $raw_email = $this->sendEmail('mail', 'sendPassword');
      $this->getLogger()->debug($raw_email);

      // save new password
      $user->save();

      return 'MailSent';
    }
    else
    {
      $this->getRequest()->setError('email', 'There is no Registry user with this email address. Please try again');

      return sfView::SUCCESS;
    }
  }

  public function executeAdd()
  {
    // process only POST requests
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $user = new User();
      $user->setNickname($this->getRequestParameter('nickname'));
      $user->setEmail($this->getRequestParameter('email'));
      $user->setPassword($this->getRequestParameter('password'));

      $user->save();

      $this->forward('user', 'login');
    }

    $this->getRequest()->setAttribute('newaccount', true);
    $this->forward('user', 'login');
  }

  public function handleErrorLogin()
  {
    return sfView::SUCCESS;
  }

  public function handleErrorAdd()
  {
    $this->getRequest()->setAttribute('newaccount', true);

    $this->forward('user', 'login');
    //return array('user', 'loginSuccess');
  }

  public function handleErrorPasswordRequest()
  {
    return sfView::SUCCESS;
  }

  public function handleErrorUpdate()
  {
    $this->subscriber = $this->getUser()->getSubscriber();
    $this->forward404Unless($this->subscriber);

    $this->updateUserFromRequest();
    $this->setShowVars();

    $this->forward('user', 'show');
    //return array('user', 'showSuccess');
  }

  private function updateUserFromRequest()
  {
    $this->subscriber->setFirstName($this->getRequestParameter('first_name'));
    $this->subscriber->setLastName($this->getRequestParameter('last_name'));
    $this->subscriber->setEmail($this->getRequestParameter('email'));
    $this->subscriber->setWantToBeModerator($this->getRequestParameter('want_to_be_moderator'));
  }

  private function setShowVars()
  {
    $response = $this->getResponse();
    $response->setTitle('Registry! :: '.$this->subscriber->__toString().'\'s profile');
  }
}