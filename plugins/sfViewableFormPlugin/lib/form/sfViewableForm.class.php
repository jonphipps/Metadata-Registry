<?php

/**
 * The sfViewableForm class is used to enhance a project's forms.
 * 
 * @package    sfViewableFormPlugin
 * @subpackage form
 * @author     Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version    SVN: $Id: sfViewableForm.class.php 16928 2009-04-03 00:56:05Z Kris.Wallsmith $
 */
class sfViewableForm
{
  protected
    $config   = array(),
    $enhanced = array();

  /**
   * Connects to the 'template.filter_parameters' event.
   * 
   * @param sfApplicationConfiguration $configuration
   */
  static public function connect(sfApplicationConfiguration $configuration)
  {
    $configuration->getEventDispatcher()->connect('template.filter_parameters', array(new self($configuration), 'filterTemplateParameters'));
  }

  /**
   * Constructor.
   * 
   * @param sfApplicationConfiguration $configuration
   */
  public function __construct(sfApplicationConfiguration $configuration = null)
  {
    if ($configuration && $file = $configuration->getConfigCache()->checkConfig('config/forms.yml', true))
    {
      $config = include $file;
      $this->setConfig($config);
    }
  }

  /**
   * Returns the configuration array.
   * 
   * @return array
   */
  public function getConfig()
  {
    return $this->config;
  }

  /**
   * Sets the configuration array.
   * 
   * @param array $config
   */
  public function setConfig($config)
  {
    $this->config = $config;
  }

  /**
   * Enhances any forms before they're passed to the template.
   * 
   * @param  sfEvent $event
   * @param  array   $parameters
   * 
   * @return array
   */
  public function filterTemplateParameters(sfEvent $event, array $parameters)
  {
    foreach ($parameters as $parameter)
    {
      if ($parameter instanceof sfForm && !in_array($parameter, $this->enhanced, true))
      {
        $this->enhanceForm($parameter);
      }
    }

    return $parameters;
  }

  /**
   * Enhances a form.
   * 
   * @param sfForm $form
   */
  public function enhanceForm(sfForm $form)
  {
    $this->enhanceFormFields($form->getFormFieldSchema(), get_class($form), $form->getEmbeddedForms());
    $this->enhanced[] = $form;
  }

  /**
   * Enhances form fields.
   * 
   * @param sfFormFieldSchema $fieldSchema    Form fields to enhance
   * @param string            $formClass      The name of the form class these fields are from
   * @param array             $embeddedForms  An array of forms embedded in the fields' form
   */
  protected function enhanceFormFields(sfFormFieldSchema $fieldSchema, $formClass, array $embeddedForms = array())
  {
    // loop through the fields and apply the global configuration
    foreach ($fieldSchema as $field)
    {
      if ($field instanceof sfFormFieldSchema)
      {
        if (isset($embeddedForms[$field->getName()]))
        {
          $form = $embeddedForms[$field->getName()];
          $this->enhanceFormFields($field, get_class($form), $form->getEmbeddedForms());
        }
        else
        {
          $this->enhanceFormFields($field, $formClass);
        }
      }

      $this->enhanceWidget($field->getWidget());

      if ($field->hasError())
      {
        $validator = $field->getError()->getValidator();

        $this->enhanceValidator($validator);

        if ($validator instanceof sfValidatorSchema)
        {
          if ($preValidator = $validator->getPreValidator())
          {
            $this->enhanceValidator($preValidator, true);
          }
          if ($postValidator = $validator->getPostValidator())
          {
            $this->enhanceValidator($postValidator, true);
          }
        }
      }
    }

    // loop through the form's lineage and apply configuration
    foreach (self::getLineage($formClass) as $class)
    {
      if (isset($this->config['forms'][$class]))
      {
        foreach ($this->config['forms'][$class] as $name => $params)
        {
          if (preg_match('/^_(pre|post)_validator$/', $name, $match))
          {
            $method = 'get'.ucwords($match[1]).'Validator';

            if (($error = $fieldSchema->getError()) && ($validator = $error->getValidator()->$method()))
            {
              $validator->setMessages(array_merge($validator->getMessages(), $params));
            }

            continue;
          }

          $field = $fieldSchema[$name];
          $widget = $field->getWidget();
          $validator = $field->hasError() ? $field->getError() : null;

          if (isset($params['label']))
          {
            $widget->setLabel($params['label']);
          }

          if (isset($params['help']))
          {
            $fieldSchema->getWidget()->setHelp($name, $params['help']);
          }

          if ($validator && isset($params['messages']))
          {
            $validator->setMessages(array_merge($validator->getMessages(), $params['messages']));
          }
        }
      }
    }
  }

  /**
   * Enhances a widget.
   * 
   * @param sfWidget $widget
   */
  public function enhanceWidget(sfWidget $widget)
  {
    foreach (self::getLineage($widget) as $class)
    {
      if (isset($this->config['widgets'][$class]))
      {
        $config = $this->config['widgets'][$class];

        if (!isset($config['options']) && !isset($config['attributes']))
        {
          $config = array('attributes' => $config);
        }

        $config = array_merge(array('options' => array(), 'attributes' => array()), $config);

        foreach ($config['options'] as $name => $value)
        {
          $widget->setOption($name, $value);
        }

        foreach ($config['attributes'] as $name => $value)
        {
          if ('class' == $name)
          {
            // non-destructive
            $widget->setAttribute($name, implode(' ', array_merge(explode(' ', $widget->getAttribute('class')), array($value))));
          }
          else
          {
            $widget->setAttribute($name, $value);
          }
        }
      }
    }
  }

  /**
   * Enhances a validator.
   * 
   * @param sfValidatorBase $validator
   * @param boolean         $recursive Enhance validator schema recursively
   */
  public function enhanceValidator(sfValidatorBase $validator, $recursive = false)
  {
    foreach (self::getLineage($validator) as $class)
    {
      if (isset($this->config['validators'][$class]))
      {
        $config = $this->config['validators'][$class];

        if (!isset($config['options']) && !isset($config['messages']))
        {
          $config = array('messages' => $config);
        }

        $config = array_merge(array('options' => array(), 'messages' => array()), $config);

        foreach ($config['options'] as $name => $value)
        {
          $validator->setOption($name, $value);
        }

        foreach ($config['messages'] as $code => $message)
        {
          $validator->setMessage($code, $message);
        }
      }
    }

    if ($recursive && $validator instanceof sfValidatorSchema)
    {
      foreach ($validator->getFields() as $v)
      {
        $this->enhanceValidator($v, $recur);
      }
    }

    if (method_exists($validator, 'getValidators'))
    {
      foreach ($validator->getValidators() as $v)
      {
        $this->enhanceValidator($v, $recur);
      }
    }
  }

  /**
   * Returns an object's lineage.
   * 
   * @param  string|object $class
   * 
   * @return array
   */
  static public function getLineage($class)
  {
    if (is_object($class))
    {
      $class = get_class($class);
    }

    $classes = array();
    do
    {
      $classes[] = $class;
    }
    while ($class = get_parent_class($class));

    $lineage = array_reverse($classes);

    return $lineage;
  }
}
