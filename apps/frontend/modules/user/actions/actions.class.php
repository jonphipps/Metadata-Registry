<?php

/**
* user actions.
*
* @package    registry
* @subpackage user
* @author     Jon Phipps
* @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
*/
class userActions extends autoUserActions
{
  public function executeShowSubscriber()
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
    $this->subscriber->save();

    $this->redirect('@user_profile?nickname='.$this->subscriber->getNickname());
  }

  public function executeLogin()
  {
    $request = $this->getRequest();
    $request->setAttribute('newaccount', false);

    if ($request->getMethod() != sfRequest::POST)
    {
      // display the form
      $response = $this->getResponse();
      $response->setTitle('The Registry! :: sign in / register');
      $AttributeHolder = $request->getAttributeHolder();
      $referrer = $request->getReferer();
      $AttributeHolder->set('referer', $referrer);

      return sfView::SUCCESS;
    }
    else
    {
      // handle the form submission
      // redirect to last page
      $referer = $this->getUser()->getAttribute  ('referer', '@homepage', 'sfRefererPlugin');

      //$this->getUser()->getAttributeHolder()->remove('referer');
      if (preg_match('/add_user|password_request|login|download/', $referer)) {
        $this->redirect('@homepage');
      } else {
        $this->redirect($referer);
      }
    }
  }

  public function executeLogout()
  {
    $referer = $this->getUser()->getAttribute  ('referer', '@homepage', 'sfRefererPlugin');

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
      //$this->getLogger()->debug($raw_email);

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

    $this->labels = $this->getLabels();

    $this->forward('user', 'showSubscriber');
  }

  public function updateUserFromRequest()
  {
    $user['nickname'] = $this->getRequestParameter('nickname');
    $user['salutation'] = $this->getRequestParameter('salutation');
    $user['first_name'] = $this->getRequestParameter('first_name');
    $user['last_name'] = $this->getRequestParameter('last_name');
    $user['email'] = $this->getRequestParameter('email');
    $user['password'] = $this->getRequestParameter('password');
    $user['want_to_be_moderator'] = $this->getRequestParameter('want_to_be_moderator');
    $user['is_moderator'] = $this->getRequestParameter('is_moderator');
    $user['is_administrator'] = $this->getRequestParameter('is_administrator');

    if ($user['nickname'])
    {
      $this->subscriber->setNickname($user['nickname']);
    }
    if ($user['salutation'])
    {
      $this->subscriber->setSalutation($user['salutation']);
    }
    if ($user['first_name'])
    {
      $this->subscriber->setFirstName($user['first_name']);
    }
    if ($user['last_name'])
    {
      $this->subscriber->setLastName($user['last_name']);
    }
    if ($user['email'])
    {
      $this->subscriber->setEmail($this->getRequestParameter('email'));
    }
    if ($user['password'])
    {
      $this->subscriber->setPassword($user['password']);
    }
    $this->subscriber->setWantToBeModerator(isset($user['want_to_be_moderator']) ? $user['want_to_be_moderator'] : 0);
    $this->subscriber->setIsModerator(isset($user['is_moderator']) ? $user['is_moderator'] : 0);
    $this->subscriber->setIsAdministrator(isset($user['is_administrator']) ? $user['is_administrator'] : 0);
  }

  private function setShowVars()
  {
    $response = $this->getResponse();
    $response->setTitle('Registry! :: '.$this->subscriber->__toString().'\'s profile');
  }

}
