<?php
// auto-generated by sfPropelCrud
// date: 2007/02/03 15:47:09
?>
<?php

/**
 * vocabuser actions.
 *
 * @package    registry
 * @subpackage vocabuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class vocabuserActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('vocabuser', 'list');
  }

  public function executeList()
  {
    $this->vocabulary_has_users = VocabularyHasUserPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->vocabulary_has_user = VocabularyHasUserPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'),
             $this->getRequestParameter('user_id'));
    $this->forward404Unless($this->vocabulary_has_user);
  }

  public function executeCreate()
  {
    $this->vocabulary_has_user = new VocabularyHasUser();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->vocabulary_has_user = VocabularyHasUserPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'),
             $this->getRequestParameter('user_id'));
    $this->forward404Unless($this->vocabulary_has_user);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('vocabulary_id')
     || !$this->getRequestParameter('user_id'))
    {
      $vocabulary_has_user = new VocabularyHasUser();
    }
    else
    {
      $vocabulary_has_user = VocabularyHasUserPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'),
         $this->getRequestParameter('user_id'));
      $this->forward404Unless($vocabulary_has_user);
    }

    $vocabulary_has_user->setVocabularyId($this->getRequestParameter('vocabulary_id') ? $this->getRequestParameter('vocabulary_id') : null);
    $vocabulary_has_user->setUserId($this->getRequestParameter('user_id') ? $this->getRequestParameter('user_id') : null);
    $vocabulary_has_user->setIsMaintainerFor($this->getRequestParameter('is_maintainer_for', 0));
    $vocabulary_has_user->setIsRegistrarFor($this->getRequestParameter('is_registrar_for', 0));
    $vocabulary_has_user->setIsAdminFor($this->getRequestParameter('is_admin_for', 0));

    $vocabulary_has_user->save();

    return $this->redirect('vocabuser/show?vocabulary_id='.$vocabulary_has_user->getVocabularyId().'&user_id='.$vocabulary_has_user->getUserId());
  }

  public function executeDelete()
  {
    $vocabulary_has_user = VocabularyHasUserPeer::retrieveByPk($this->getRequestParameter('vocabulary_id'),
       $this->getRequestParameter('user_id'));

    $this->forward404Unless($vocabulary_has_user);

    $vocabulary_has_user->delete();

    return $this->redirect('vocabuser/list');
  }
}
