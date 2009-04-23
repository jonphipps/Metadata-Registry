<?php

/*
 * This file is part of the sfBlog package.
 * (c) 2004-2006 Francois Zaninotto <francois.zaninotto@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Blog frontend actions
 *
 * @package    sfBlog
 * @subpackage plugin
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @version    SVN: $Id$
 */
class BasesfBlogComponents extends sfComponents
{
  public function executeRecentPosts()
  {
    $this->posts = DbFinder::from('sfBlogPost')->
      with('sfBlog')->
      recent()->
      limit(sfConfig::get('app_sfBlogs_post_recent', 5))->
      find();
  }
  
  public function executeRecentBlogPosts()
  {
    $posts = DbFinder::from('sfBlogPost')->
      relatedTo($this->blog)->
      recent()->
      limit(sfConfig::get('app_sfBlogs_post_recent', 5))->
      find();
    // set related blog by hand to save on queries
    foreach ($posts as $post)
    {
      $this->blog->addsfBlogPost($post);
    }
    $this->posts = $posts;
  }
  
  public function executeTagList()
  {
    $blogId = isset($this->blog) ? $this->blog->getId() : null;
    $this->tags = DbFinder::from('sfBlogTag')->findAllWithCount($blogId);
    $this->link = $this->getLink();
  }
  
  public function executeArchives()
  {
    $this->archives = DbFinder::from('sfBlogPost')->
      findArchives(isset($this->blog) ? $this->blog : null);
    $this->link = $this->getLink();
  }
  
  protected function getLink()
  {
    return isset($this->blog) ? 'sfBlog/blogPosts?stripped_title=' . $this->blog->getStrippedTitle() . '&' : 'sfBlog/posts?';
  }
}
