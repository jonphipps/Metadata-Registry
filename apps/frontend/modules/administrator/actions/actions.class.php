<?php

/**
 * administrator actions.
 *
 * @package    Registry
 * @subpackage administrator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class administratorActions extends sfActions
{
  public function executeProblematicUsers()
  {
    $this->users = UserPeer::getProblematicUsers();

    $this->title = 'problematic user list';
    $this->setTitle($this->title);
  }

  public function executeModerators()
  {
    $this->users = UserPeer::getModerators();

    $this->title = 'moderator list';
    $this->setTitle($this->title);
  }

  public function executeAdministrators()
  {
    $this->users = UserPeer::getAdministrators();

    $this->title = 'administrator list';
    $this->setTitle($this->title);
  }

  public function executeModeratorCandidates()
  {
    $this->users = UserPeer::getModeratorCandidates();

    $this->title = 'moderator candidates';
    $this->setTitle($this->title);
  }

  public function executePromoteModerator()
  {
    $this->toggleModerator(true);
  }

  public function executeRemoveModerator()
  {
    $this->toggleModerator(false);
  }

  public function executePromoteAdministrator()
  {
    $this->toggleAdministrator(true);
  }

  public function executeRemoveAdministrator()
  {
    $this->toggleAdministrator(false);
  }

  private function toggleModerator($moderator)
  {
    $user = UserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    $this->forward404Unless($user);

    $user->setIsModerator($moderator);
    $user->setWantToBeModerator(false);

    $user->save();

    $this->redirect($this->getRequest()->getReferer());
  }

  private function toggleAdministrator($administrator)
  {
    $user = UserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    $this->forward404Unless($user);

    $user->setIsAdministrator($administrator);

    $user->save();

    $this->redirect($this->getRequest()->getReferer());
  }
}

