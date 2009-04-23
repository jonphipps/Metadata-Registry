<?php

class sfBlogRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    $r->prependRoute('index', new DbFinderObjectsRoute(
      '/home',
      array('module' => 'sfBlog', 'action' => 'index'),
      array(),
      array('model' => 'sfBlogPost', 'finder_methods' => array('innerJoinsfBlog',  'withsfBlog', 'published', 'innerJoinsfGuardUser', 'withsfGuardUser'), 'default_order' => array('published_at', 'desc'))
    ));
    $r->prependRoute('blogs', new DbFinderObjectsRoute(
      '/blogs/all/*',
      array('module' => 'sfBlog', 'action' => 'blogs'),
      array(),
      array('model' => 'sfBlog')
    ));
    $r->prependRoute('comments', new DbFinderObjectsRoute(
      '/comments/all/*',
      array('module' => 'sfBlog', 'action' => 'comments'),
      array(),
      array('model' => 'sfBlogComment', 'finder_methods' => array('recent', 'published', 'withsfBlogPost'))
    ));
    $r->prependRoute('posts', new sfRoute(
      '/posts/*',
      array('module' => 'sfBlog', 'action' => 'posts')
    ));
    $r->prependRoute('blog_comments', new DbFinderObjectRoute(
      '/comments/:stripped_title/*',
      array('module' => 'sfBlog', 'action' => 'blogComments'),
      array('stripped_title' => '((?!all)[^/])*'),
      array('model' => 'sfBlog', 'filter_variables' => array('stripped_title'))
    ));
    $r->prependRoute('blog', new DbFinderObjectRoute(
      '/blogs/:stripped_title/*',
      array('module' => 'sfBlog', 'action' => 'blogPosts'),
      array('stripped_title' => '((?!all)[^/])*'),
      array('model' => 'sfBlog', 'filter_variables' => array('stripped_title'))
    ));
    $r->prependRoute('post', new DbFinderObjectRoute(
      '/blogs/:blog_title/:year/:month/:day/:stripped_title/*',
      array('module' => 'sfBlog', 'action' => 'post'),
      array(),
      array('model' => 'sfBlogPost')
    ));
  }
}
