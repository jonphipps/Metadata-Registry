<?php

/**
 * i18n actions.
 *
 * @package    project
 * @subpackage i18n
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 2757 2006-11-18 10:11:00Z fabien $
 */
class i18nActions extends sfActions
{
  public function executeIndex()
  {
    $this->test = $this->getContext()->getI18N()->__('an english sentence');
    $this->localTest = $this->getContext()->getI18N()->__('a local english sentence');
    $this->otherTest = $this->getContext()->getI18N()->__('an english sentence', array(), 'other');
    $this->otherLocalTest = $this->getContext()->getI18N()->__('a local english sentence', array(), 'other');
  }
}
