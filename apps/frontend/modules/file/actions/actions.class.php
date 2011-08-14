<?php

/**
 * import actions.
 *
 * @package    registry
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class importActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeImport()
  {
    $this->forward('default', 'module');
  }
}
