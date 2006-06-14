<?php

class myUser extends sfBasicSecurityUser
{
  public function signIn($user)
  {
    $userID = $user->getId();
    $this->setAttribute('subscriber_id', $userID, 'subscriber');
    $this->setAttribute('agentCount', $user->getAgentCount($userID), 'subscriber');
    $this->setAuthenticated(true);

    $this->addCredential('subscriber');

    if ($user->getIsModerator())
    {
      $this->addCredential('moderator');
    }

    if ($user->getIsAdministrator())
    {
      $this->addCredential('administrator');
    }

    $this->setAttribute('nickname', $user->getNickname(), 'subscriber');
    $this->setHasAgents();
  }

  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('subscriber');

    $this->setAuthenticated(false);
    $this->clearCredentials();
  }

  public function getSubscriberId()
  {
    if ($this->isAuthenticated())
    {
      return $this->getAttribute('subscriber_id', '', 'subscriber');
    }
    else
    {
      return 0;
    }
  }

  public function getSubscriber()
  {
    if ($this->isAuthenticated())
    {
      return UserPeer::retrieveByPk($this->getSubscriberId());
    }
    else
    {
      return null;
    }
  }

  public function getNickname()
  {
    if ($this->isAuthenticated())
    {
      return $this->getAttribute('nickname', '', 'subscriber');
    }
    else
    {
      return '';
    }
  }

  public function getAgentCredentials($agentId = false)
  {
    //$agentId = sfContext::getInstance()->getRequest()->getParameter('id');
    if ($agentId && $this->isAuthenticated())
    {
      $agentContact = $this->getIsAgentContact($agentId);
      if (isset($agentContact))
      {
        if ($agentContact['contact'])
        {
          $this->addCredential('agentcontact');
        }
        if ($agentContact['registrar'])
        {
          $this->addCredential('agentregistrar');
        }
      }
    }
    return;
  }

  public function getVocabularyCredentials($vocabularyId = false)
  {
    //$vocabularyId = sfContext::getInstance()->getRequest()->getParameter('id');
    if ($this->isAuthenticated())
    {
      if (!$this->hasCredential('hasAgents'))
      {
        $this->setHasAgents();
      }
      if ($vocabularyId)
      {
        $vocabularyContact = $this->getIsVocabularyContact($vocabularyId);
        if (isset($vocabularyContact))
        {
          if ($vocabularyContact['contact'])
          {
            $this->addCredential('vocabularycontact');
          }
          if ($vocabularyContact['registrar'])
          {
            $this->addCredential('vocabularyregistrar');
          }
          if ($vocabularyContact['maintainer'])
          {
            $this->addCredential('vocabularymaintainer');
          }
        }
      }
    }
    return;
  }

  /**
  * Is this user related to any agents?
  *
  * @return boolean
  */
  public function setHasAgents() {
		//$criteria = new Criteria();
		//$criteria->add(AgentHasUserPeer::USER_ID, $this->getSubscriberId());
    //$count =  AgentHasUserPeer::doCount($criteria);
    $user = new User();
    $count = $user->getAgentCount($this->getSubscriberId());
    $this->setAttribute('agentCount', $count, 'subscriber');
    //$this->setAttribute('hasAgents', (bool) $count, 'subscriber');
    if ($count)
    {
      $this->addCredential('hasAgents');
    }
    return $count;
  }

  public function getIsAgentContact($agentId)
  {
    $criteria = new Criteria();
  	$criteria->add(AgentHasUserPeer::USER_ID, $this->getSubscriberId());
  	$criteria->add(AgentHasUserPeer::AGENT_ID, $agentId);
    $user = new User();
    $AgentHasUsersColl = $user->getAgentHasUsers($criteria);

    if (count($AgentHasUsersColl))
    {
      $result['contact'] = true;

      $result['registrar'] = $AgentHasUsersColl[0]->getIsRegistrarFor();
      return $result;
    }
  }

  public function getIsVocabularyContact($vocabularyId)
  {
    $criteria = new Criteria();
  	$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getSubscriberId());
  	$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $vocabularyId);
    $user = new User();
    $VocabularyHasUsersColl = $user->getVocabularyHasUsers($criteria);

    if (count($VocabularyHasUsersColl))
    {
      $result['contact'] = true;
      $result['registrar'] = $VocabularyHasUsersColl[0]->getIsRegistrarFor();
      $result['maintainer'] = $VocabularyHasUsersColl[0]->getIsMaintainerFor();
      return $result;
    }
  }

  /**
  * get the current vocabulary
  *
  * @return vocabulary
  */
  public function getCurrentVocabulary()
  {
    return $this->getAttribute('vocabulary');
  }

  /**
  * set the current vocabulary
  *
  * @return boolean the currently set vocabulary object
  * @param  Vocabulary $vocabulary
  */
  public function setCurrentVocabulary(Vocabulary $vocabulary)
  {
    return $this->setAttribute('vocabulary', $vocabulary);
  }

  /**
  * get the current concept
  *
  * @return concept
  */
  public function getCurrentConcept()
  {
    return $this->getAttribute('concept');
  }

  /**
  * set the current concept
  *
  * @return boolean the currently set concept object
  * @param  Concept $concept
  */
  public function setCurrentConcept(Concept $concept)
  {
    return $this->setAttribute('concept', $concept);
  }
}

