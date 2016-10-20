<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfError404Exception is thrown when a 404 error occurs in an action.
 *
 * @package    symfony
 * @subpackage exception
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfError404Exception.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class sfError404Exception extends sfException
{
  /**
   * Class constructor.
   *
   * @param string $message The error message
   * @param int    $code The error code
   */
  public function __construct($message = null, $code = 0)
  {
    $this->setName('sfError404Exception');
    parent::__construct($message, $code);
  }

  /**
   * Forwards to the 404 action.
   *
   * @param Exception $exception An Exception implementation instance
   */
  public function printStackTrace($exception = null)
  {
    sfContext::getInstance()->getController()->forward(sfConfig::get('sf_error_404_module'), sfConfig::get('sf_error_404_action'));
  }
}
