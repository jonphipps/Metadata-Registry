<?php

/*
 * This file is part of the sfBlog package.
 * (c) 2004-2006 Francois Zaninotto <francois.zaninotto@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Blog backend components
 *
 * @package    sfBlog
 * @subpackage plugin
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @version    SVN: $Id$
 */
class BasesfBlogAdminComponents extends sfComponents
{
  public function executeMainNavigation()
  {
    $user = $this->getUser();
    $this->nb_comments_to_moderate = DbFinder::from('sfBlogComment')->
      managedBy($user)->
      pending()->
      count();
    $this->nb_draft_posts = DbFinder::from('sfBlogPost')->
      managedBy($user)->
      draft()->
      count();
  }
  
  public function executePostFilter()
  {
    $user = $this->getUser();
    $this->tags = DbFinder::from('sfBlogTag')->
      managedBy($this->getUser())->
      groupBy('Tag')->
      orderBy('Tag')->
      find();
    $this->blogs = DbFinder::from('sfBlog')->
      managedBy($user)->
      orderBy('CreatedAt', 'desc')->
      find();
  }
  
  public function executeCommentFilter()
  {
    $user = $this->getUser();
    $this->posts = DbFinder::from('sfBlogPost')->
      join('sfBlog')->with('sfBlog')->
      managedBy($user)->
      orderBy('sfBlog.CreatedAt', 'desc')->
      orderBy('sfBlogPost.CreatedAt', 'desc')->
      find();
    $this->spam_count = DbFinder::from('sfBlogComment')->
      managedBy($user)->
      spam()->
      count();
  }
  
  public function executeBlogFilter()
  {
    $this->blogs = DbFinder::from('sfBlog')->
      managedBy($this->getUser())->
      orderBy('CreatedAt', 'desc')->
      find();
  }
}
