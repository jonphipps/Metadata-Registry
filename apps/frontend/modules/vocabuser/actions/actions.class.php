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
  protected function updateVocabularyHasUserFromCreateRequest()
  {
    $vocabulary_has_user = $this->getRequestParameter('vocabulary_has_user');

    $this->vocabulary_has_user->setUserId(isset($vocabulary_has_user['user_id']) ? $vocabulary_has_user['user_id'] : 0);
    $this->vocabulary_has_user->setVocabularyId(isset($vocabulary_has_user['vocabulary_id']) ? $vocabulary_has_user['vocabulary_id'] : 0);
    $this->vocabulary_has_user->setIsAdminFor(isset($vocabulary_has_user['is_admin_for']) ? $vocabulary_has_user['is_admin_for'] : 0);
    $this->vocabulary_has_user->setIsMaintainerFor(isset($vocabulary_has_user['is_maintainer_for']) ? $vocabulary_has_user['is_maintainer_for'] : 0);
  }
   
}