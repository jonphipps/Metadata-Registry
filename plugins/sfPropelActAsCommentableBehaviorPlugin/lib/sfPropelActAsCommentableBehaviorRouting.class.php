<?php

/**
 * Routing configuration
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage routing
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfPropelActAsCommentableBehaviorRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();
    $r->prependRoute(
      'sf_comment',
      new sfRoute(
        '/sf_comment',
        array('module' => 'sfComment', 'action' => 'comment')
      )
    );
  }

  static public function addRouteForAdmin(sfEvent $event)
  {
    $event->getSubject()->prependRoute(
      'sf_comment_admin',
      new sfPropelRouteCollection(array(
        'name'                 => 'sf_comment_admin',
        'model'                => 'sfComment',
        'module'               => 'sfCommentAdmin',
        'prefix_path'          => 'sf_comment_admin',
        'with_wildcard_routes' => true,
        'requirements'         => array(),
      ))
    );
  }
}
