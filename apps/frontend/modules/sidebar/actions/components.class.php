<?php

/**
 * sidebar components.
 *
 * @package    Registry
 * @subpackage sidebar
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: components.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class sidebarComponents extends sfComponents
{
  public function executeDefault()
  {
  }

  public function executeQuestion()
  {
    $this->question = QuestionPeer::getQuestionFromTitle($this->getRequestParameter('stripped_title'));
  }
}

