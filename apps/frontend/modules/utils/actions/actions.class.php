<?php

/**
 * utils actions.
 *
 * @package    registry
 * @subpackage utils
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class utilsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeLanguage() {
    $this->getUser()->setCulture($this->getRequestParameter('culture'));
    $this->setFlash('notice', 'New current session locale : '.$this->getUser()->getCulture());
    $url = $this->getRequest()->getReferer() != '' ? $this->getRequest()->getReferer() : '@homepage';
    $this->redirect($url);
  }
}
