<?php

class PluginsfBlogCommentFinder extends Dbfinder
{
  protected $class = 'sfBlogComment';
  
  public function recent()
  {
    return $this->
      orderBy('CreatedAt', 'desc');
  }
  
  public function published()
  {
    // FIXME: rely on the blog's comment publication policy
    return $this->
      where('Status', '<=', sfConfig::get('app_sfBlogs_moderation_treshold', sfBlogComment::ACCEPTED));
  }
  
  public function spam()
  {
    // FIXME: rely on the blog's comment publication policy
    return $this->
      where('Status', '>=', sfConfig::get('app_sfBlogs_spam_treshold', sfBlogComment::DUBIOUS));
  }
  
  public function pending()
  {
    return $this->
      where('Status', sfBlogComment::PENDING);
  }
  
  public function relatedToBlog($blog)
  {
    return $this->
      join('sfBlogPost')->
      where('sfBlogPost.SfBlogId', $blog->getId());
  }
  
  public function managedBy($user)
  {
    return $this->
      _if(!$user->hasCredential('administrator'))->
        join('sfBlogPost')->join('sfBlog')->join('sfBlogUser')->
        where('sfBlogUser.UserId', $user->getGuardUser()->getId())->
      _endif();
  }
  
  public function applyFilters($filters)
  {
    if (isset($filters['parent_id']) && ($parent = $filters['parent_id']))
    {
      if(substr($parent, 0, 4) == 'blog')
      {
        $this->
          join('sfBlogPost')->
          where('sfBlogPost.sfBlogId', substr($parent, 5));
      }
      elseif(substr($parent, 0, 4) == 'post')
      {
        $this->
          where('sfBlogPost.Id', substr($parent, 5));
      }
    }
    if (isset($filters['text']) && $filters['text'] !== '')
    {
      $value = '%'.trim($filters['text'], '*%').'%';
      $this->
        where('AuthorName', 'like', $value)->
        orWhere('AuthorEmail', 'like', $value)->
        orWhere('Content', 'like', $value);
    }
    if (isset($filters['created_at']))
    {
      if (isset($filters['created_at']['from']) && $filters['created_at']['from'] !== '')
      {
        $this->where('CreatedAt', '>=', $filters['created_at']['from']);
      }
      if (isset($filters['created_at']['to']) && $filters['created_at']['to'] !== '')
      {
        $this->where('CreatedAt', '<=', $filters['created_at']['to']);
      }
    }
    if (isset($filters['status']) && $filters['status'] !== '')
    {
      switch ($filters['status'])
      {
        case 'pending':
          $this->
            where('Status', sfBlogComment::PENDING)->
            orwhere('Status', sfBlogComment::DUBIOUS);
          break;
        case 'approved':
          $this->where('Status', sfBlogComment::ACCEPTED);
          break;
        case 'spam':
          $this->where('Status', sfBlogComment::REJECTED);
          break;
      }
    }
    
    return $this;
  }
  
  public function isAuthorApproved($author_name, $author_email)
  {
    $acceptedComments = $this->
      where('AuthorName', $author_name)->
      where('AuthorEmail', $author_email)->
      where('Status', sfBlogComment::ACCEPTED)->
      count();
    
    return $acceptedComments > 0;
  }
}