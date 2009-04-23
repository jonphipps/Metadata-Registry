<?php

/**
 * sfComment Creation form.
 *
 * @package    sfPropelActAsCommentableBehaviorPlugin
 * @subpackage form
 * @author     Xavier Lacot <xavier@lacot.org>
 * @see        http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfCommentingForm extends sfFormPropel
{
  public function setup()
  {
    $config = sfPropelActAsCommentableToolkit::getConfig();
    $config = sfContext::getInstance()->getUser()->isAuthenticated() ? $config['user'] : $config['anonymous'];
    $layout = $config['layout'];

    $widgets = array(
      'referer' => new sfWidgetFormInputHidden(),
      'text'    => new sfWidgetFormTextarea(array(), array('rows' => 5, 'cols' => 40)),
      'token'   => new sfWidgetFormInputHidden(),
    );

    $validators = array(
      'referer' => new sfValidatorString(array('required' => false)),
      'text'    => new sfValidatorString(array('required' => true), array('required' => 'The comment is required.')),
      'token'   => new sfValidatorString(array('required' => true)),
    );

    if (isset($layout['name']))
    {
      $widgets['name'] = new sfWidgetFormInput();
      $validators['name'] = new sfValidatorString(
        array(
          'max_length' => 50,
          'required'   => ($layout['name'] == 'required')
        ),
        array(
          'max_length' => 'The name is too long. It must be of %max_length% characters maximum.',
          'required' => 'Your name is required.',
        )
      );
    }

    if (isset($layout['email']))
    {
      $widgets['email'] = new sfWidgetFormInput();
      $validators['email'] = new sfValidatorAnd(
        array(
          new sfValidatorString(
            array('max_length' => 100),
            array('max_length' => 'The email is too long. It must be of %max_length% characters maximum.')
          ),
          new sfValidatorEmail(array(), array('invalid' => 'The email address is invalid.'))
        ),
        array('required' => ($layout['email'] == 'required')),
        array('required' => 'Your email is required.')
      );
    }

    if (isset($layout['website']))
    {
      $widgets['website'] = new sfWidgetFormInput();
      $validators['website'] = new sfValidatorAnd(
        array(
          new sfValidatorString(
            array('max_length' => 255),
            array('max_length' => 'The website address is too long. It must be of %max_length% characters maximum.')
          ),
          new sfValidatorUrl(array(), array('invalid' => 'This url is invalid.'))
        ),
        array('required' => ($layout['website'] == 'required')),
        array('required' => 'Your website\'s adress is required.')
      );
    }

    if (isset($layout['title']))
    {
      $widgets['title'] = new sfWidgetFormInput();
      $validators['title'] = new sfValidatorString(
        array(
          'max_length' => 100,
          'required'   => ($layout['title'] == 'required')
        ),
        array(
          'max_length' => 'The title is too long. It must be of %max_length% characters maximum.',
          'required' => 'The title is required.',
        )
      );
    }

    $this->setWidgets($widgets);
    $this->setValidators($validators);

    $this->widgetSchema->setNameFormat('sf_comment[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::setup();
  }

  public function doSave($con = null)
  {
    $token = $this->getValue('token');
    $object = sfPropelActAsCommentableToolkit::retrieveFromToken($token);

    $comment = array(
      'title' => $this->getValue('title'),
      'text'  => $this->getValue('text')
    );

    $config = sfPropelActAsCommentableToolkit::getConfig();

    if (sfContext::getInstance()->getUser()->isAuthenticated())
    {
      $id_method = $config['user']['id_method'];
      $comment['author_id'] = sfContext::getInstance()->getUser()->$id_method();
    }
    else
    {
      $comment['author_name'] = $this->getValue('name');
      $comment['author_email'] = $this->getValue('email');
      $comment['author_website'] = $this->getValue('website');
    }

    $namespace = $this->getValue('namespace');
    $namespaces = $config['namespaces'];

    if (isset($namespaces[$namespace]) && !$this->getUser()->hasCredential($namespaces[$namespace]))
    {
      $this->setError('unauthorized',
                      'You do not have the right to add comments in this namespace.');
    }
    else
    {
      $comment['namespace'] = $namespace;
    }

    foreach (sfMixer::getCallables('sfCommentActions:addComment:pre') as $callable)
    {
      if (false !== strpos($callable, '::'))
      {
        $callable = explode('::', $callable);
      }

      call_user_func($callable, $comment, $object);
    }

    $comment_object = $object->addComment($comment);

    foreach (sfMixer::getCallables('sfCommentActions:addComment:post') as $callable)
    {
      if (false !== strpos($callable, '::'))
      {
        $callable = explode('::', $callable);
      }

      call_user_func($callable, $comment_object, $object);
    }
  }

  public function getModelName()
  {
    return 'sfComment';
  }
}
