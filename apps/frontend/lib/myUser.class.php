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
    if ($this->isAuthenticated())
    {
       if ($agentId)
       {
         $agentContact = AgentHasUserPeer::retrieveByPK($agentId, $this->getSubscriberId());
         if (isset($agentContact))
         {
            $this->addCredential('agentcontact');
            if ($agentContact->getIsRegistrarFor())
            {
               $this->addCredential('agentregistrar');
            }
            if ($agentContact->getIsAdminFor())
            {
               $this->addCredential('agentadmin');
            }
         }
       }
       //we're doing this here on the assumption that if the user has been able to get to create, she must be authorized.
       elseif ('create' == sfContext::getInstance()->getRequest()->getParameter('action'))
       {
          $this->addCredential('agentcontact');
          $this->addCredential('agentregistrar');
          $this->addCredential('agentadmin');
       }
    }
    return;
  }

  public function getVocabularyCredentials($vocabularyId = false)
  {
    //$vocabularyId = sfContext::getInstance()->getRequest()->getParameter('id');
    if ($this->isAuthenticated())
    {
      if (!$this->hasCredential(array (0 => 'hasAgents' )))
      {
        $this->setHasAgents();
      }
      if ($vocabularyId)
      {
         /* @var VocabularyHasUserPeer */
         $vocabularyContact = VocabularyHasUserPeer::retrieveByPK($vocabularyId, $this->getSubscriberId());
         if (isset($vocabularyContact))
         {
            $this->addCredential('vocabularycontact');
            if ($vocabularyContact->getIsRegistrarFor())
            {
               $this->addCredential('vocabularyregistrar');
            }
            if ($vocabularyContact->getIsMaintainerFor())
            {
               $this->addCredential('vocabularymaintainer');
            }
            if ($vocabularyContact->getIsAdminFor())
            {
               $this->addCredential('vocabularyadmin');
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