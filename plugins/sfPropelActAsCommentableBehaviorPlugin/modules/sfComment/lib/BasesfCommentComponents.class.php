<?php
/**
 * sfPropelActAsCommentableBehaviorPlugin base components.
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage sfComment module
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class BasesfCommentComponents extends sfComponents
{
  /**
   * Displays the author name
   */
  public function executeAuthor()
  {
    if (isset($this->author_id))
    {
      $this->getConfig();
      $class = $this->config_user['class'];
      $toString = $this->config_user['toString'];
      $peer = sprintf('%sPeer', $class);
      $author = call_user_func(array($peer, 'retrieveByPk'), $this->author_id);
      $this->author = (!is_null($author)) ? $author->$toString() : '';
    }
    else
    {
      $this->author = $this->author_name;
    }
  }

  /**
   * Diplays the commenting form
   *
   * @param $request
   */
  public function executeCommentForm(sfWebRequest $request)
  {
    $this->getConfig();
    $config = sfContext::getInstance()->getUser()->isAuthenticated() ? $this->config_user : $this->config_anonymous;
    $this->layout = $config['layout'];

    if ($this->config['use_css'])
    {
      sfContext::getInstance()->getResponse()->addStylesheet('/sfPropelActAsCommentableBehaviorPlugin/css/sf_comment', 'first');
    }

    // get the list of the allowed tags
    $allowed_html_tags = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_allowed_tags', array());
    sort($allowed_html_tags);
    $this->allowed_html_tags = $allowed_html_tags;

    // build the comment form
    $sf_comment = $request->getParameter('sf_comment');
    $this->form = new sfCommentingForm();

    if ($request->isMethod('post') && is_array($sf_comment))
    {
      $this->form->bind($sf_comment);
    }
    else
    {
      // get the object token
      if ($this->object instanceof sfOutputEscaperObjectDecorator)
      {
        $object = $this->object->getRawValue();
      }
      else
      {
        $object = $this->object;
      }

      $this->object_model = get_class($object);
      $this->object_id = $object->getPrimaryKey();
      $token = sfPropelActAsCommentableToolkit::addTokenToSession($this->object_model, $this->object_id);

      $this->form->setDefaults(array(
        'referer' => str_replace($request->getUriPrefix(), '', $request->getUri()),
        'token'   => $token
      ));
    }
  }

  /**
   * Displays the list of the comments
   */
  public function executeCommentList()
  {
    $object = $this->object;
    $order = $this->order;
    $namespace = $this->namespace;
    $limit = $this->limit;

    if (!$order)
    {
      $order = 'asc';
    }

    if (!$namespace)
    {
      $namespace = null;
    }

    if (!$limit)
    {
      $criteria = null;
    }
    else
    {
      $criteria = new Criteria();
      $criteria->setLimit($limit);
    }

    $this->comments = $object->getComments(array('order' => $order, 'namespace' => $namespace), $criteria);
  }

  /**
   * Displays one author's gravatar
   */
  public function executeGravatar()
  {
    if (isset($this->author_id))
    {
      $this->getConfig();
      $class = $this->config_user['class'];
      $toString = $this->config_user['toString'];
      $toEmail = $this->config_user['toEmail'];
      $peer = sprintf('%sPeer', $class);
      $author = call_user_func(array($peer, 'retrieveByPk'), $this->author_id);
      $this->author_name = (!is_null($author)) ? $author->$toString() : '';
      $this->author_email = (!is_null($author)) ? $author->$toEmail() : '';
    }
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