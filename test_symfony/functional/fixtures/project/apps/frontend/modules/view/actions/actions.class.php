<?php

/**
 * view actions.
 *
 * @package    project
 * @subpackage view
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 2932 2006-12-06 12:46:11Z fabien $
 */
class viewActions extends sfActions
{
  public function executeIndex()
  {
    $this->setTemplate('foo');
  }
}
