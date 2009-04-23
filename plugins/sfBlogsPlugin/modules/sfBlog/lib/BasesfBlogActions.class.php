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
class BasesfBlogActions extends sfActions
{

  /**
   * Displays a list of latest posts from all blogs
   * Required request parameters:
   *   page       Page number (defauls to 1)
   */
  public function executeIndex($request)
  {
    $this->post_pager = $this->getRoute()->getsfBlogPostPager(
      $request->getParameter('page', 1),
      sfConfig::get('app_sfBlogs_post_max_per_page', 5)
    );
    $this->posts = $this->post_pager->getResults();
  }
  
  /**
   * Displays a list of blogs
   * Required request parameters:
   *   page       Page number (defauls to 1)
   */
  public function executeBlogs($request)
  {
    $this->blog_pager = $this->getRoute()->getsfBlogPager(
      $request->getParameter('page', 1),
      sfConfig::get('app_sfBlogs_post_max_per_page', 5)
    );
  }

  /**
   * Displays a list of latest posts from one blog
   * Optional request parameters:
   *   blog       blog object from the routing
   *   tag        Tag string, to restrict to posts using a certain tag
   *   month      Month string (yymm), to restrict to posts using
   *   page       Page number (defauls to 1)
   *   format     html by default, also accepts rss and atom1
   */
  public function executeBlogPosts($request)
  {
    $this->blog = $this->getRoute()->getsfBlog();
    $finder = DbFinder::from('sfBlogPost')->
      distinct()->
      leftJoin('sfBlog')->
      with('sfBlog')->
      recent()->
      relatedTo($this->blog);
    $params = array('stripped_title' => $request->getParameter('stripped_title'));
    if($request->hasParameter('month'))
    {
      $params['month'] = $request->getParameter('month');
      $finder->archived($params['month']);
    }
    if($request->hasParameter('tag'))
    {
      $params['tag'] = $request->getParameter('tag');
      $finder->tagged($params['tag']);
    }
    if($request->getParameter('format', 'html') == 'html')
    {
      $this->post_pager = $finder->paginate(
        $request->getParameter('page', 1), 
        sfConfig::get('app_sfBlogs_post_max_per_page', 5)
      );
      $this->params = $params;
    }
    else
    {
      $this->setTemplate('feed');
      $posts = $finder->find($request->getParameter('nb', sfConfig::get('app_sfBlogs_feed_count', 5)));
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N', 'sfBlog'));
      $this->feed = sfFeedPeer::createFromObjects(
        $posts,
        array(
          'format'      => $request->getParameter('format'),
          'title'       => get_post_list_title($params, null, $this->blog),
          'link'        => $this->getController()->genUrl('sfBlog/posts?'.http_build_query($params)),
          'authorName'  => $this->blog->getCreator()->getUsername(),
          'methods'     => array('authorEmail' => '')
        )
      );
    }
  }


  /**
   * Displays a list of latest posts from all blogs
   * Optional request parameters:
   *   tag        Tag string, to restrict to posts using a certain tag
   *   month      Month string (yymm), to restrict to posts using
   *   page       Page number (defauls to 1)
   *   format     html by default, also accepts rss and atom1
   */
  public function executePosts($request)
  {
    $params = array();
    $finder = DbFinder::from('sfBlogPost')->
      distinct()->
      leftJoin('sfBlog')->
      with('sfBlog')->
      recent();
    if($request->hasParameter('month'))
    {
      $params['month'] = $request->getParameter('month');
      $finder->archived($params['month']);
    }
    if($request->hasParameter('tag'))
    {
      $params['tag'] = $request->getParameter('tag');
      $finder->tagged($params['tag']);
    }
    if($request->getParameter('format', 'html') == 'html')
    {
      $this->post_pager = $finder->paginate(
        $request->getParameter('page', 1), 
        sfConfig::get('app_sfBlogs_post_max_per_page', 5)
      );
      $this->params = $params;
    }
    else
    {
      $this->setTemplate('feed');
      $posts = $finder->find($request->getParameter('nb', sfConfig::get('app_sfBlogs_feed_count', 5)));
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N', 'sfBlog'));
      $this->feed = sfFeedPeer::createFromObjects(
        $posts,
        array(
          'format'      => $request->getParameter('format'),
          'title'       => get_post_list_title($params, null, sfConfig::get('app_sfBlogs_title', 'How is life on earth?')),
          'link'        => $this->getController()->genUrl('sfBlog/posts?'.http_build_query($params)),
          'authorName'  => sfConfig::get('app_sfBlogs_author', ''),
          'methods'     => array('authorEmail' => '')
        )
      );
    }
  }

  /**
   * Displays a post from one blog, together with its comments
   * If the format request parameter is passed, this action serves a feed of comments for the post
   * Required request parameters:
   *   blog_title      Stripped title of the blog
   *   stripped_title  Stripped title of the blog post
   * Optional request parameters:
   *   format     html by default, also accepts rss and atom1
   */  
  public function executePost($request)
  {
    $post = $this->getRoute()->getsfBlogPost();
    $blog = $post->getsfBlog();
    
    if($request->getParameter('format', 'html') == 'html')
    {
      $this->post = $post;
      $this->blog = $blog;
      $this->comments = $post->getComments();
    }
    else
    {
      $comments = DbFinder::from('sfBlogComment')->
        relatedTo($post)->
        recent()->
        published()->
        with('sfBlogPost')->
        find($request->getParameter('nb', sfConfig::get('app_sfBlogs_feed_count', 5)));

      $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
      $this->feed = sfFeedPeer::createFromObjects(
        $comments,
        array(
          'format'      => $request->getParameter('format', 'atom1'),
          'title'       => __('Comments on post "%1%" from "%2%"', array('%1%' => $post->getTitle(), '%2%' => $blog->getTitle())),
          'link'        => $this->getController()->genUrl(array('sf_route' => 'post', 'sf_subject' => $post), true),
          'authorName'  => sfConfig::get('app_sfBlogs_author', ''),
          'methods'     => array('title' => 'getPostTitle', 'authorEmail' => '')
        )
      );
      $this->setTemplate('feed');
      
    }
  }
  
  /**
   * Displays a feed of the latest comments from all blogs
   * Required request parameters:
   *   format     accepts rss and atom1
   */
  public function executeComments($request)
  {
    $comments = $this->getRoute()->getsfBlogComments($request->getParameter('nb', sfConfig::get('app_sfBlogs_feed_count', 5)));
    
    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
    $this->feed = sfFeedPeer::createFromObjects(
      $comments,
      array(
        'format'      => $request->getParameter('format', 'atom1'),
        'title'       => __('Comments from "%1%"', array('%1%' => sfConfig::get('app_sfBlogs_title', 'How is life on earth?'))),
        'link'        => $this->getController()->genUrl('sfBlog/index'),
        'authorName'  => sfConfig::get('app_sfBlogs_author', ''),
        'methods'     => array('title' => 'getPostTitle', 'authorEmail' => '')
      )
    );
    $this->setTemplate('feed');
  }
  
  /**
   * Displays a feed of the latest comments from a blog
   * Required request parameters:
   *   stripped_title   Stripped title of the blog
   *   format           accepts rss and atom1
   */
  public function executeBlogComments($request)
  {
    $blog = $this->getRoute()->getsfBlog();
    
    $comments = DbFinder::from('sfBlogComment')->
      join('sfBlogPost')->
      where('sfBlogPost.SfBlogId', $blog->getId())->
      recent()->
      published()->
      with('sfBlogPost')->
      find($request->getParameter('nb', sfConfig::get('app_sfBlogs_feed_count', 5)));
    
    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
    $this->feed = sfFeedPeer::createFromObjects(
      $comments,
      array(
        'format'      => $request->getParameter('format', 'atom1'),
        'title'       => __('Comments from "%1%"', array('%1%' => $blog->getTitle())),
        'link'        => $this->getController()->genUrl('sfBlog/blogPosts?stripped_title='.$blog->getStrippedTitle()),
        'authorName'  => $blog->getCreator(),
        'methods'     => array('title' => 'getPostTitle', 'authorEmail' => '')
      )
    );
    $this->setTemplate('feed');
  }
  
  protected function getDateFromRequest()
  {
    return $this->getRequestParameter('date') != null ? $this->getRequestParameter('date') : $this->getRequestParameter('year').'-'.$this->getRequestParameter('month').'-'.$this->getRequestParameter('day');
  }
  
  public function executeAddComment($request)
  {
    // check input
    $this->forward404Unless(sfConfig::get('app_sfBlogs_comment_enabled', true));
    
    $blog = DbFinder::from('sfBlog')->
      findOneByStrippedTitle($request->getParameter('blog_title'));
    $this->forward404Unless($blog);
    $this->forward404Unless($blog->allowComments());
    
    $post = DbFinder::from('sfBlogPost')->
      relatedTo($blog)->
      findByStrippedTitleAndDate(
        $request->getParameter('stripped_title'),
        $this->getDateFromRequest()
      );
    $this->forward404Unless($post);
    $this->forward404Unless($post->allowComments());
    
    // create comment record
    $comment = new sfBlogComment();
    $comment->setSfBlogPostId($post->getId());
    $comment->setAuthorName($request->getParameter('name'));
    $comment->setAuthorEmail($request->getParameter('mail'));
    $comment->setAuthorUrl($request->getParameter('website', ''));
    $comment->setContent(strip_tags($request->getParameter('content')));
    $comment->setStatus($blog->getCommentInitialStatus(
      $request->getParameter('name'), 
      $request->getParameter('mail')
    ));
    $comment->save();
    
    // set flash parameter for the feedback
    $this->getUser()->setFlash('add_comment', $comment->isAccepted() ? 'normal' : 'moderated');
    
    // send email alert
    $email_pref = sfConfig::get('app_sfBlogs_comment_mail_alert', 1);
    if($email_pref == 1 || ($email_pref == 'moderated' && $comment->isPending()))
    {
      $request->setAttribute('comment', $comment);
      $raw_email = $this->getController()->getPresentationFor('sfBlog', 'sendMailOnComment', 'sfMail');
      $this->logMessage($raw_email, 'debug');
    }
    
    if($request->isXmlHttpRequest())
    {
      $this->post = $post;
      $this->comments = $post->getComments();
      return 'Ajax';
    }
    else
    {
      $this->redirect(sfBlogTools::generatePostUri($post));
    }
  }
  
  public function executeSendMailOnComment()
  {
    // Mail action cannot be called directly from the outside
    $this->forward404If($this->getController()->getActionStack()->getSize() == 1);
    
    $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
    $this->comment = $this->getRequest()->getAttribute('comment');

    $mail = new sfMail();
    $mail->setCharset('utf-8');
    $mail->setSender('no-reply@'.$this->getRequest()->getHost());
    $mail->setMailer('mail');
    $mail->setFrom($mail->getSender(), $this->comment->getsfBlogPost()->getsfBlog()->getTitle());

    $mail->addAddresses(sfConfig::get('app_sfBlogs_email'));

    if($this->comment->isPending())
    {
      $subject_string = '[%blog%] Please moderate: New comment on "%post%"';
    }
    else
    {
      $subject_string = '[%blog%] New comment on "%post%"';
    }
    $mail->setSubject(__($subject_string, array(
      '%blog%' => $this->comment->getsfBlogPost()->getsfBlog()->getTitle(),
      '%post%' => $this->comment->getPostTitle()
    )));
    
    $this->mail = $mail;
  }
  
  public function handleErrorAddComment()
  {
    if($this->getRequest()->isXmlHttpRequest())
    {
      $this->post = DbFinder::from('sfBlogPost')->findByStrippedTitleAndDate(
        $this->getRequestParameter('stripped_title'),
        $this->getDateFromRequest()
      );
      $this->forward404Unless($this->post);
      $this->comments = $this->post->getComments();
      $this->getResponse()->setContentType('text/html; charset=utf-8');
      return 'Ajax';
    }
    else
    {
      $this->forward('sfBlog', 'show');
    }
  }

}
