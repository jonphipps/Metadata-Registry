<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfUrlValidator verifies a parameter contains a value that qualifies as a
 * valid URL.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfUrlValidator.class.php 1679 2006-08-21 08:53:31Z fabien $
 */
class sfUrlValidator extends sfValidator
{
  /**
   * Execute this validator.
   *
   * @param mixed A file or parameter value/array.
   * @param error An error message reference.
   *
   * @return bool true, if this validator executes successfully, otherwise false.
   */
  public function execute (&$value, &$error)
  {
    $re = '/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i';
    
    if (!preg_match($re, $value))
    {
      $error = $this->getParameterHolder()->get('url_error');
      return false;
    }

    return true;
  }

  public function initialize ($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->getParameterHolder()->set('url_error', 'Invalid input');

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}
