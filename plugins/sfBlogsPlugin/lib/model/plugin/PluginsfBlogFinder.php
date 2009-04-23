<?php

class PluginsfBlogFinder extends Dbfinder
{
  protected $class = 'sfBlog';
  
  public function authoredBy($sfGuardUser)
  {
    return $this->
      join('sfBlogUser')->
      where('sfBlogUser.UserId', $sfGuardUser->getId());
  }
  
  public function managedBy($user)
  {
    return $this->
      _if(!$user->hasCredential('administrator'))->
        join('sfBlogUser')->
        where('sfBlogUser.UserId', $user->getGuardUser()->getId())->
      _endif();
  }
  
  public function open()
  {
    return $this->where('IsFinished', false);
  }
  
  public function applySort($sort)
  {
    return $this;
  }
  
  public function findAuthorizedFor($user)
  {
    return $this->
      managedBy($user)->
      orderBy('CreatedAt', 'desc')->
      find();
  }
  
  public function isStrippedTitleAvailable($strippedTitle, $excluded = null)
  {
    return $this->
      where('StrippedTitle', $strippedTitle)->
      _if($excluded && !$excluded->isNew())->
        where('Id', '<>', $excluded->getId())->
      _endif()->
      count() == 0;
  }
}