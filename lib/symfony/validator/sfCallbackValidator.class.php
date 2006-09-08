<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfCallbackValidator allows you to use a custom callback function or method to
 * validate the input. The function should return true on valid and false on invalid
 * and should be callable using is_callable().
 *
 * <b>Required parameters:</b>
 *
 * # <b>callback</b> - [none] - A valid callback function or Class::method array.
 * When using class/method specify it as an array in yml file as [class, method]
 *
 * <b>Optional parameters:</b>
 *
 * # <b>invalid_error</b> - [Invalid input] - An error message to use when the
 *                                          input fails the callback check
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfCallbackValidator.class.php 1831 2006-08-25 06:01:37Z fabien $
 */
class sfCallbackValidator extends sfValidator
{
  /**
   * Execute this validator.
   *
   * @param string A parameter value.
   * @param string An error message reference.
   *
   * @return bool true, if this validator executes successfully, otherwise false.
   */
  public function execute (&$value, &$error)
  {
    $callback = $this->getParameterHolder()->get('callback');

    if (!call_user_func($callback, $value))
    {
      $error = $this->getParameterHolder()->get('invalid_error');

      return false;
    }

    return true;
  }

  /**
   * Initialize this validator.
   *
   * @param Context The current application context.
   * @param array   An associative array of initialization parameters.
   *
   * @return bool true, if initialization completes successfully, otherwise false.
   */
  public function initialize ($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->getParameterHolder()->set('callback', null);
    $this->getParameterHolder()->set('invalid_error', 'Invalid input');

    $this->getParameterHolder()->add($parameters);

    // check parameters
    if (!is_callable($this->getParameterHolder()->get('callback')))
    {
      // no pattern specified
      $error = 'Callback function must be a valid callback using is_callable()';

      throw new sfValidatorException($error);
    }

    return true;
  }
}
