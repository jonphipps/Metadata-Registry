<?php

/**
 * Subclass for representing a row from the 'sf_blog' table.
 *
 * 
 *
 * @package plugins.sfBlogsPlugin.lib.model
 */ 
class PluginsfBlog extends BasesfBlog
{
  const
    COMMENT_POLICY_NO_COMMENT = 0,
    COMMENT_POLICY_REQUIRE_MODERATION = 1,
    COMMENT_POLICY_FIRST_REQUIRE_MODERATION = 2,
    COMMENT_POLICY_PUBLISH = 3;
    
  public function __toString()
  {
    return $this->getTitle();
  }
  
  public function setTitle($text)
  {
    if($this instanceof BaseObject)
    {
      parent::setTitle($text);
    }
    else
    {
      $this->rawSet('title', $text);
    }
    
    $this->setStrippedTitle(sfBlogTools::stripText($text));
  }
  
  public function setStrippedTitle($title)
  {
    while(!DbFinder::from('sfBlog')->isStrippedTitleAvailable($title, $this))
    {
      $title .= '_';
    }
    return parent::setStrippedTitle($title);
    
  }
  
  public function allowComments()
  {
    return $this->getCommentPolicy() > 0;
  }
  
  public function getUsers()
  {
    return DbFinder::from('sfGuardUser')->
      join('sfBlogUser')->
      where('sfBlogUser.sfBlogId', $this->getId())->
      find();
  }
  
  public function isAuthoredBy($sfGuardUser)
  {
    return DbFinder::from('sfBlogUser')->
      where('UserId', $sfGuardUser->getId())->
      relatedTo($this)->
      count() > 0;
  }
  
  public function isCreator($sfGuardUser)
  {
    return DbFinder::from('sfBlogUser')->
      where('UserId', $sfGuardUser->getId())->
      relatedTo($this)->
      where('IsCreator', true)->
      count() > 0;
  }
  
  public function getCreator()
  {
    return DbFinder::from('sfGuardUser')->
      join('sfBlogUser')->
      where('sfBlogUser.sfBlogId', $this->getId())->
      where('sfBlogUser.IsCreator', true)->
      findOne();
  }
  
  public function removeUser($user)
  {
    $blogUser = DbFinder::from('sfBlogUser')->
      where('UserId', $user->getId())->
      relatedTo($this)->
      findOne();
    return $blogUser ? $blogUser->delete() : false;
  }
  
  public function canRemove($asker, $user)
  {
    $isCreator = $this->isCreator($asker);
    if ($isCreator && !$asker->equals($user))
    {
      // I can remove others from my blogs
      return 1;
    }
    elseif (!$isCreator && $asker->equals($user))
    {
      // I can remove myself from someone else's blog
      return 2;
    }
    else
    {
      return 0;
    }
  }
  
  public function getListMode()
  {
    return $this->getDisplayExtract() ? 'short' : 'normal';
  }
  
  public function countComments()
  {
    return DbFinder::from('sfBlogComment')->
      relatedToBlog($this)->
      count();
  }
  
  public function countCommentsToModerate()
  {
    return DbFinder::from('sfBlogComment')->
      relatedToBlog($this)->
      where('sfBlogComment.Status', sfBlogComment::PENDING)->
      count();
  }
  
  public function countDraftPosts()
  {
    return DbFinder::from('sfBlogPost')->
      relatedTo($this)->
      where('IsPublished', false)->
      count();
  }
  
  public function getCommentInitialStatus($name, $email)
  {
    switch ($this->getCommentPolicy())
    {
      case self::COMMENT_POLICY_REQUIRE_MODERATION:
        return sfBlogComment::PENDING;
      case self::COMMENT_POLICY_FIRST_REQUIRE_MODERATION:
        if(DbFinder::from('sfBlogComment')->isAuthorApproved($name, $email))
        {
          return sfBlogComment::ACCEPTED;
        }
        else
        {
          return sfBlogComment::PENDING;
        }
      case self::COMMENT_POLICY_PUBLISH:
        return sfBlogComment::PENDING;
      default:
        return sfBlogComment::REJECTED;
    }
  }
  
}
