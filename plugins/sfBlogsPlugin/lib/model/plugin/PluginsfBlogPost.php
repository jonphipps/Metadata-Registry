<?php

/**
 * Subclass for representing a row from the 'sf_blog_post' table.
 *
 * 
 *
 * @package plugins.sfBlogsPlugin.lib.model
 */ 
class PluginsfBlogPost extends BasesfBlogPost
{
  protected $nbComments = null;
  
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

  public function getAuthor()
  {
    $getUserMethod = 'get'.sfConfig::get('app_sfBlogs_user_class', 'sfGuardUser');
    if(is_callable(array($this, $getUserMethod)))
    {
      return $this->$getUserMethod();
    }
    else
    {
      throw new sfException(sprintf('Method sfBlogPost::%s() does not exist - check the sfBlog_user_class parameter of the app.yml file', $getUserMethod));
    }
  }
  
  public function getExcerpt()
  {
    $extract = $this->getExtract();
    if(!$extract)
    {
      $content = $this->getContent(ESC_RAW);
      if ($content == '')
      {
        return '';
      }

      $mbstring = extension_loaded('mbstring');
      if($mbstring)
      {
       @mb_internal_encoding(mb_detect_encoding($content));
      }
      $substr = ($mbstring) ? 'mb_substr' : 'substr';
      if(($pos = strpos($content, '<hr class="end_excerpt"')) !== false)
      {
        $extract = strip_tags($substr($content, 0, $pos));
      }
      else
      {
        $extract = $substr(strip_tags($content), 0, sfConfig::get('app_sfBlogs_excerpt_size', 500)) . sfConfig::get('app_sfBlogs_excerpt_suffix', '...');
      }
    }
    return $extract;
  }

  public function getComments()
  {
    return DbFinder::from('sfBlogComment')->
      relatedTo($this)->
      orderBy('CreatedAt')->
      published()->
      find();
  }

  public function countPublishedComments()
  {
    return DbFinder::from('sfBlogComment')->
      relatedTo($this)->
      published()->
      count();
  }
  
  public function getTagsAsString()
  {
    $tags = DbFinder::from('sfBlogTag')->
      relatedTo($this)->
      orderBy('Tag')->
      find();
    $ret = '';
    foreach ($tags as $tag)
    {
      $ret .= (empty($ret) ? '' : ' ') . (string) $tag;
    }
    
    return $ret;
  }

  public function setTagsAsString($tagString)
  {
    DbFinder::from('sfBlogTag')->
      relatedTo($this)->
      delete();
    $tags = explode(' ', $tagString);
    foreach ($tags as $tag)
    {
      if (!$tag) continue;
      $tagObject = new sfBlogTag();
      $tagObject->setTag($tag);
      $tagObject->setSfBlogPostId($this->getId());
      $tagObject->setsfBlogPost($this);
      $tagObject->save();
    }
  }

  public function getFeedLink()
  {
    return sfContext::getInstance()->getController()->genUrl(array('sf_route' => 'post', 'sf_subject' => $this), true);
  }
  
  public function getBlogTitle()
  {
    return $this->getsfBlog()->getStrippedTitle();
  }
  
  public function getYear()
  {
    return date('Y', $this->getPublishedAt('U'));
  }

  public function getMonth()
  {
    return date('m', $this->getPublishedAt('U'));
  }
  
  public function getDay()
  {
    return date('d', $this->getPublishedAt('U'));
  }
  
  public function allowComments()
  {
    if ($this->getAllowComments())
    {
      $validity = sfConfig::get('app_sfBlogs_comment_disable_after', 0);
      if ($validity == 0 || $this->getPublishedSinceDays() < $validity)
      {
        return true;
      }
    }

    return false;
  }
  
  public function getPublishedSinceDays()
  {
    return round((time() - $this->getPublishedAt('U')) / (24 * 60 * 60));
  }

  public function setIsPublished($flag)
  {
    if ($flag == true && !$this->getPublishedAt())
    {
      $this->setPublishedAt(date("Y-m-d"));
    }
    
    if($this instanceof BaseObject)
    {
      parent::setIsPublished($flag);
    }
    else
    {
      $this->rawSet('is_published', $flag);
    }
  }
  
  public function leaveUpdatedAtUnchanged()
  {
    $this->modifiedColumns[] = sfBlogPostPeer::UPDATED_AT;
  }

}
