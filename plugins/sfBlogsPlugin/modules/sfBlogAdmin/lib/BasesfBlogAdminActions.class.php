<?php

/*
 * This file is part of the sfBlog package.
 * (c) 2004-2006 Francois Zaninotto <francois.zaninotto@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/BaseAdminActions.class.php');

/**
 * Blog backend actions
 *
 * @package    sfBlog
 * @subpackage plugin
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @version    SVN: $Id$
 */
class BasesfBlogAdminActions extends BaseAdminActions
{
  /**
   * Dashboard
   */
  public function executeIndex()
  {
    $this->logs = DbFinder::from('sfBlogLog')->
      relatedTo($this->getUser()->getGuardUser())->
      orderBy('CreatedAt', 'desc')->
      find(100);
  }
  
  /**
   * Post management methods
   */
   
  public function executePosts($request)
  {
    $this->hasBlog = DbFinder::from('sfBlog')->authoredBy($this->getUser()->getGuardUser())->count() > 0;
    $this->pager = $this->getPostPager($request);
    if($request->isXmlHttpRequest())
    {
      $this->setTemplate('postsAjax');
    }
  }
  
  public function executePostPreview($request)
  {
    $this->post = $this->getObjectFromRequest($request, 'sfBlogPost');
    $this->forward404Unless($this->post);
  }
  
  public function executePostPreviewFull($request)
  {
    $this->post = $this->getObjectFromRequest($request, 'sfBlogPost');
    $this->forward404Unless($this->post);
    $this->updatePostFromRequest($request);
    $this->blog = $this->post->getsfBlog();
    $this->comments = $this->post->getComments();
  }
  
  public function executePostEdit($request)
  {
    if($request->getParameter('preview'))
    {
      return $this->forward('sfBlogAdmin', 'postPreviewFull');
    }
    if ($request->getParameter('id') === '' || $request->getParameter('id') === null)
    {
      $this->post = new sfBlogPost();
    }
    else
    {
      $this->post = $this->getObjectFromRequest($request, 'sfBlogPost');
    }

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      if($this->post->isNew())
      {
        $logMethod = $request->getParameter('draft') ? 'create' : 'publish';
      }
      elseif($this->post->getIsPublished() && $request->getParameter('draft'))
      {
        $logMethod = 'unpublish';
      }
      elseif(!$this->post->getIsPublished() && $request->getParameter('save'))
      {
        $logMethod = 'publish';
      }
      else
      {
        $logMethod = 'update';
      }
      $this->updatePostFromRequest($request);
      $this->post->save();
      call_user_func(array('sfBlogPostLogger', $logMethod), $this->post, $this->getUser()->getGuardUser());
      
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
      $this->getUser()->setFlash('notice', __('Your modifications have been saved'));

      return $this->redirect('sfBlogAdmin/postEdit?id='.$this->post->getId());
    }
    else
    {
      $this->blogs = DbFinder::from('sfBlog')->
        _if($this->post->isNew())->
          open()->
        _endif()->
        managedBy($this->getUser())->
        orderBy('CreatedAt', 'desc')->
        find();
    }
  }

  public function executePostDelete($request)
  {
    $post = $this->getObjectFromRequest($request, 'sfBlogPost');

    try
    {
      sfBlogPostLogger::delete($post, $this->getUser()->getGuardUser());
      $post->delete();
    }
    catch (PropelException $e)
    {
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
      $this->getUser()->setFlash('notice', __('Could not delete the selected post.'));
      return $this->forward('sfBlogAdmin', 'posts');
    }
    
    return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY : $this->redirect('sfBlogAdmin/posts');
  }

  public function executeTogglePublishPost($request)
  {
    $post = $this->getObjectFromRequest($request, 'sfBlogPost');
    $targetStatus = !$post->getIsPublished();
    $post->setIsPublished($targetStatus);
    $post->save();
    $logMethod = $targetStatus ? 'publish' : 'unpublish';
    call_user_func(array('sfBlogPostLogger', $logMethod), $post, $this->getUser()->getGuardUser());
    
    if ($request->isXmlHttpRequest())
    {
      return $this->renderPartial('sfBlogAdmin/post', array('post' => $post));
    }
    else
    {
      return $this->redirect('sfBlogAdmin/posts');
    }
  }
  
  protected function getPostPager($request)
  {
    $this->filters = $this->getFilters($request, 'sf_admin/sf_blog_post/filters');
    $this->sort = $this->getSort($request, 'sf_admin/sf_blog_post/sort');
    return DbFinder::from('sfBlogPost')->
      with('sfBlog')->
      managedBy($this->getUser())->
      applyFilters($this->filters)->
      applySort($this->sort)->
      paginate($request->getParameter('page', 1), sfConfig::get('app_sfBlogs_backend_page', 10));
  }
  
  protected function updatePostFromRequest($request)
  {
    $post = $request->getParameter('post');

    if (isset($post['author_id']))      $this->post->setAuthorId($post['author_id'] ? $post['author_id'] : null);
    
    $this->forward404Unless(isset($post['blog_id']));
    $blog = DbFinder::from('sfBlog')->findPk($post['blog_id']);
    $this->forward404Unless(in_array($blog, DbFinder::from('sfBlog')->findAuthorizedFor($this->getUser())));
    $this->post->setsfBlog($blog);
    
    if (isset($post['extract']))        $this->post->setExtract($post['extract']);
    if (isset($post['content']))        $this->post->setContent($post['content']);
    if (isset($post['tags_as_string'])) $this->post->setTagsAsString($post['tags_as_string']);
    if (isset($post['title']) && $post['title'])
    {
      $this->post->setTitle($post['title']);
    }
    else
    {
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
      $this->post->setTitle(__('Untitled'));
    }
    if($request->getParameter('save'))
    {
      $this->post->setIsPublished(true);
    }
    elseif($request->getParameter('draft'))
    {
      $this->post->setIsPublished(false);
    }
    $this->post->setAllowComments(isset($post['allow_comments']) ? $post['allow_comments'] : 0);
  }
  
  /**
   * Comment management methods
   */
   
  public function executeComments($request)
  {
    $this->pager = $this->getCommentPager($request);
    if($request->isXmlHttpRequest())
    {
      $this->setTemplate('commentsAjax');
    }
  }
  
  public function executeAcceptComment($request)
  {
    $comment = $this->getObjectFromRequest($request, 'sfBlogComment');
    $comment->setAccepted()->save();
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('sfBlogAdmin/comment', array('comment' => $comment));
    }
    else
    {
      $this->redirect('sfBlogAdmin/comments');
    }
  }

  public function executeDespamComment($request)
  {
    $comment = $this->getObjectFromRequest($request, 'sfBlogComment');
    $comment->setAccepted()->save();
    
    return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY : $this->redirect('sfBlogAdmin/comments');
  }

  public function executeSpamComment($request)
  {
    $comment = $this->getObjectFromRequest($request, 'sfBlogComment');
    $comment->setSpam()->save();
    // TODO: call spam WS
    
    return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY : $this->redirect('sfBlogAdmin/comments');
  }

  public function executeDeleteComment($request)
  {
    $comment = $this->getObjectFromRequest($request, 'sfBlogComment');
    $comment->delete();
    
    return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY : $this->redirect('sfBlogAdmin/comments');
  }
  
  protected function getCommentPager($request)
  {
    $this->filters = $this->getFilters($request, 'sf_admin/sf_blog_comment/filters');
    return DbFinder::from('sfBlogComment')->
      join('sfBlogPost')->with('sfBlogPost')->
      managedBy($this->getUser())->
      applyFilters($this->filters)->
      orderBy('CreatedAt', 'desc')->
      paginate($request->getParameter('page', 1), sfConfig::get('app_sfBlogs_backend_page', 10));
  }
  
  /**
   * Blog management methods
   */
   
   public function executeBlogs($request)
   {
   }
   
   public function executeBlogEdit($request)
   {
     if ($request->getParameter('id') === '' || $request->getParameter('id') === null)
     {
       $this->blog = new sfBlog();
     }
     else
     {
       $this->blog = $this->getObjectFromRequest($request, 'sfBlog');
     }
     if ($this->getRequest()->getMethod() == sfRequest::POST)
     {
       $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
       $logMethod = $this->blog->isNew() ? 'create' : 'update';
       $this->updateBlogFromRequest($request);
       $this->blog->save();
       call_user_func(array('sfBlogLogger', $logMethod), $this->blog, $this->getUser()->getGuardUser());
       $this->getUser()->setFlash('notice', __('Your modifications have been saved'));

       return $this->redirect('sfBlogAdmin/blogEdit?id='.$this->blog->getId());
     }
   }
   
   public function executeBlogPreview($request)
   {
     $this->blog = $this->getObjectFromRequest($request, 'sfBlog');
   }
   
   public function executeBlogDelete($request)
   {
     $blog = $this->getObjectFromRequest($request, 'sfBlog');
     try
     {
       sfBlogLogger::delete($blog, $this->getUser()->getGuardUser());
       $blog->delete();
     }
     catch (PropelException $e)
     {
       $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
       $this->getUser()->setFlash('notice', __('Could not delete the selected blog.'));
       return $this->forward('sfBlogAdmin', 'blogs');
     }

     return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY : $this->redirect('sfBlogAdmin/blogs');
   }
   
   public function executeRemoveAuthor($request)
   {
     $blog = $this->getObjectFromRequest($request, 'sfBlog');
     $currentUser = $this->getUser()->getGuardUser();
     $userToRemove = DbFinder::from('sfGuardUser')->
       findOneByUsername($request->getParameter('username'));
     $type = $blog->canRemove($currentUser, $userToRemove);
     $this->forward404Unless($type);
     
     if($blog->removeUser($userToRemove))
     {
       $this->getUser()->setFlash('notice', __('The author was removed from this blog'));
     }
     
     if ($type == 1)
     {
       // I delete someone from one of my blogs
       return $request->isXmlHttpRequest() ? sfView::HEADER_ONLY :  $this->redirect('sfBlogAdmin/blogEdit?id='.$blog->getId());
     }
     elseif ($type == 2)
     {
       // I delete myself from someone else's blog
       return $this->redirect('sfBlogAdmin/blogs');
     }
   }
   
   protected function updateBlogFromRequest($request)
   {
     $blog = $request->getParameter('blog');
     
     if (trim($blog['title']))
     {
       $this->blog->setTitle($blog['title']);
     }
     else
     {
       $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
       $this->blog->setTitle(__('Untitled'));
     }
     if (trim($blog['stripped_title']))
     {
       $this->blog->setStrippedTitle(sfBlogTools::stripText($blog['stripped_title']));
     }
     $this->blog->setTagline(isset($blog['tagline']) ? $blog['tagline'] : '');
     $this->blog->setCopyright(isset($blog['copyright']) ? $blog['copyright'] : '');
     $this->blog->setIsFinished(isset($blog['is_finished']) ? $blog['is_finished'] : 0);
     $this->blog->setDisplayExtract(isset($blog['display_extract']) ? $blog['display_extract'] : 0);
     $this->blog->setCommentPolicy(isset($blog['comment_policy']) ? $blog['comment_policy'] : 2);
     if($this->blog->isNew())
     {
       $blogUser = new sfBlogUser();
       $blogUser->setsfGuardUser($this->getUser()->getGuardUser());
       $this->blog->addsfBlogUser($blogUser);
     }
   }
}
