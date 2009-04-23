<?php
/**
 * sfPropelActAsCommentableBehaviorPlugin base actions.
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage sfComment module
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class BasesfCommentActions extends sfActions
{
  /**
   * Saves a comment
   */
  public function executeComment(sfWebRequest $request)
  {
    $this->getConfig();

    if (((sfContext::getInstance()->getUser()->isAuthenticated()
           && $this->config_user['enabled'])
          || $this->config_anonymous['enabled'])
         && $request->isMethod('post'))
    {
      $sf_comment = $request->getParameter('sf_comment');
      $this->form = new sfCommentingForm();
      $this->form->bind($sf_comment);

      if ($this->form->isValid())
      {
        $this->form->doSave($sf_comment);
      }
      else
      {
        $referer = str_replace($request->getScriptName(), '', $sf_comment['referer']);
        $params = $this->getContext()->getRouting()->parse($referer);
        unset($params['_sf_route']);
        $url_params = $this->getContext()->getController()->convertUrlStringToParameters($referer);
        $url_params = array_merge($params, $url_params[1]);

        foreach ($params as $param => $value)
        {
          $request->setParameter($param, $value);
        }

        $this->forward($params['module'], $params['action']);
      }

      $this->redirect($sf_comment['referer']);
    }
  }

  /**
   * Displays the comment form
   */
  public function executeCommentForm()
  {
    $token = $this->getRequestParameter('sf_comment_object_token');
    $this->object = sfPropelActAsCommentableToolkit::retrieveFromToken($token);
    $this->namespace = $this->getRequestParameter('sf_comment_namespace', null);
  }

  /**
   * Gets the plugin's configuration
   */
  protected function getConfig()
  {
    $config = sfPropelActAsCommentableToolkit::getConfig();
    $this->config = $config;
    $this->config_anonymous = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_anonymous', $config['anonymous']);
    $this->config_user = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_user', $config['user']);
  }
}