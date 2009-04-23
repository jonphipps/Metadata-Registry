<?php

/**
 * Subclass for representing a row from the 'sf_blog_comment' table.
 *
 * 
 *
 * @package plugins.sfBlogsPlugin.lib.model
 */ 
class PluginsfBlogComment extends BasesfBlogComment
{
  const 
    ACCEPTED = 0,
    PENDING  = 1,
    DUBIOUS  = 2,
    REJECTED = 3;
  
  public static function isStatusValid($status)
  {
    return in_array($status, array(self::ACCEPTED, self::PENDING, self::DUBIOUS, self::REJECTED));
  }
  
  public function setAccepted()
  {
    return $this->setStatus(self::ACCEPTED);
  }

  public function setPending()
  {
    return $this->setStatus(self::PENDING);
  }
  
  public function setDubious()
  {
    return $this->setStatus(self::DUBIOUS);
  }
  
  public function setSpam()
  {
    return $this->setStatus(self::REJECTED);
  }
  
  public function isAccepted()
  {
    return $this->getStatus() == self::ACCEPTED;
  }
  
  public function isPending()
  {
    return $this->getStatus() == self::PENDING;
  }
  
  public function isSpam()
  {
    return $this->getStatus() >= self::DUBIOUS;
  }
  
  public function setAuthorUrl($url)
  {
    if(strpos($url, 'http://') !== 0)
    {
      $url = 'http://'.$url; 
    }
    parent::setAuthorUrl($url);
  }
  
  public function getPostTitle()
  {
    return $this->getsfBlogPost()->getTitle();
  }
  
  public function getFeedLink()
  {
    return array('sf_route' => 'post', 'sf_subject' => $this->getsfBlogPost());
  }
  
  public function doSave(PropelPDO $con)
  {
    $affectedRows = parent::doSave($con);
    $this->updateNbComments($con);
    
    return $affectedRows;
  }

  public function delete(PropelPDO $con = null)
  {
    $ret = parent::delete($con);
    $this->updateNbComments($con);
    
    return $ret;
  }
  
  protected function updateNbComments(PropelPDO $con = null)
  {
    $post = $this->getsfBlogPost();
    $post->setNbComments($post->countPublishedComments());
    $post->leaveUpdatedAtUnchanged();
    $post->save($con);
  }
}
