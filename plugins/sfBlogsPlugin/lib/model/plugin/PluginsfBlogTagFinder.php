<?php

class PluginsfBlogTagFinder extends Dbfinder
{
  protected $class = 'sfBlogTag';
  
  public function managedBy($user)
  {
    return $this->
      _if(!$user->hasCredential('administrator'))->
        join('sfBlogPost')->join('sfBlog')->join('sfBlogUser')->
        where('sfBlogUser.UserId', $user->getGuardUser()->getId())->
      _endif();
  }
  
  public function findAllWithCount($blogId = null)
  {
    return $this->
      join('sfBlogPost p')->
      withColumn('count(p.Id)', 'count')->
      where('p.IsPublished', true)->
      groupBy('Tag')->
      _if($blogId)->
        where('p.sfBlogId', $blogId)->
      _endif()->
      find();
  }
}