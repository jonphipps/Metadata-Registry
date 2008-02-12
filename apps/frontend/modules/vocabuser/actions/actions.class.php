<?php

/**
 * vocabuser actions.
 *
 * @package    registry
 * @subpackage vocabuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 63 2006-06-14 17:31:15Z jphipps $
 */
class vocabuserActions extends autovocabuserActions
{
  /**
  * overrides the parent executeList function
  *
  */
  public function executeList()
  {
    if (!$this->hasRequestParameter('user_id'))
    {
      //a current vocabulary is required
      myActionTools::requireVocabulary('vocabuser', 'list');
    }

    parent::executeList();
  }
}
