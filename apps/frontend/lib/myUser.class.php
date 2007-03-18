<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * The namespace under which object credentials will be stored.
   *
   * Object credentials are stored in this namespace as
   *   module = array(
   *     key = array(
   *       credential
   *       credential
   *   ))
   *
   * setting an object credential may also set an application credential
   *
   */
  const OBJECT_CREDENTIAL_NAMESPACE = 'object_credentials';
  const SUBSCRIBER_NAMESPACE = 'subscriber';

  protected $tmpCredentials = null;

  public function signIn($user)
  {
    $userID = $user->getId();
    $this->setAttribute('subscriber_id', $userID, self::SUBSCRIBER_NAMESPACE);
    $this->setAuthenticated(true);
    $this->setAttribute('nickname', $user->getNickname(), self::SUBSCRIBER_NAMESPACE);
    $this->addCredential('subscriber');

    if ($user->getIsModerator())
    {
      $this->addCredential('moderator');
    }

    if ($user->getIsAdministrator())
    {
      $this->addCredential('administrator');
    }

    //foreach vocbulary and agent (expand as necessary) as object
    //get array of object credentials from model
    //if there are results,
      //set global credential
      //set vocabulary credentials

    $this->setHasAgents();
  }

  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace(self::SUBSCRIBER_NAMESPACE);

    $this->setAuthenticated(false);
    $this->clearCredentials();
  }

  /**
  * set Agent object-level credentials
  *
  * @TODO: this should maybe be in the model?
  * @TODO The models should be defined in an array in this class,
  * along with the methods to call for each. Then we can make it more generic,
  * and much easier to add new objects to
  *
  * @return integer count of agents retrieved
  */
  public function setAgentCredentials()
  {
    $credentials = AgentHasUserPeer::doSelectForCurrentUser();
    foreach ($credentials as $credential)
    {
      $agentId = $credential->getAgentId();
      //build the  array
      $credArray[$agentId]['registrar'] = $credential->getIsRegistrarFor();
      $credArray[$agentId]['admin']     = $credential->getIsAdminFor();
    }

    $this->addObjectCredentials('Agent', $credArray);

    return count($credentials);
  }

  /**
  * set Agent object-level credentials
  *
  * @TODO: this should maybe be in the model?
  * @TODO The models should be defined in an array in this class,
  * along with the methods to call for each. Then we can make it more generic,
  * and much easier to add new objects to
  *
  * @return integer count of agents retrieved
  */
  public function setVocabularyCredentials()
  {
    $credentials = VocabularyHasUserPeer::doSelectForCurrentUser();
    foreach ($credentials as $credential)
    {
      $vocabId = $credential->getVocabularyId();
      //build the  array
      $credArray[$vocabId]['maintainer'] = $credential->getIsMaintainerFor();
      $credArray[$vocabId]['registrar']  = $credential->getIsRegistrarFor();
      $credArray[$vocabId]['admin']      = $credential->getIsAdminFor();
    }

    $this->addObjectCredentials('Vocabulary', $credArray);

    return count($credentials);
  }

  /**
  * clears the credentials for a specific model
  *
  * @param  string $model The model to clear
  */
  public function clearObjectCredentials($model)
  {
    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getContext()->getLogger()->info('{sfUser} clear object credentials  "'.$model.'"');
    }

    $this->addObjectCredentials($model, array());
  }

  /**
  * clears all of the object credentials
  *
  * @TODO The models should be defined in an array in this class
  *
  */
  public function clearAllObjectCredentials()
  {
    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getContext()->getLogger()->info('{sfUser} clear all object credentials');
    }

    $this->clearObjectCredentials('Vocabulary');
    $this->clearObjectCredentials('Agent');
  }
  /**
  * adds all object credentials for a model for this user
  *
  * @param  string $model The model class name
  * @param  array  $credentialsArray an array containing the credentials
  */
  public function addObjectCredentials($model, $credentialsArray)
  {
    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getContext()->getLogger()->info('{sfUser} add object credential(s) "'. print_r($credentialsArray, true)).'"';
    }

    $this->setAttribute($model, $credentialsArray, self::OBJECT_CREDENTIAL_NAMESPACE);
  }

  public function getSubscriberId()
  {
    if ($this->isAuthenticated())
    {
      return $this->getAttribute('subscriber_id', '', self::SUBSCRIBER_NAMESPACE);
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
      return $this->getAttribute('nickname', '', self::SUBSCRIBER_NAMESPACE);
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
         //make sure we've revoked the credentials -- we revoke, then set them every time the agent is accessed
         $this->removeCredential('agentcontact');
         $this->removeCredential('agentregistrar');
         $this->removeCredential('agentadmin');

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
         //make sure we've revoked the credentials -- we revoke, then set them every time the vocabulary is accessed
         $this->removeCredential('vocabularycontact');
         $this->removeCredential('vocabularyregistrar');
         $this->removeCredential('vocabularymaintainer');
         $this->removeCredential('vocabularyadmin');

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
      //we're doing this here on the assumption that if the user has been able to get to create, she must be authorized.
      elseif ('create' == sfContext::getInstance()->getRequest()->getParameter('action'))
      {
         $this->addCredential('vocabularycontact');
         $this->addCredential('vocabularyregistrar');
         $this->addCredential('vocabularyadmin');
      }
    }
    return;
  }

  /**
  * Is this user related to any agents?
  *
  * @return boolean
  */
  public function setHasAgents()
  {
    //we don't bother if the user is an administrator
    if ($this->hasCredential('administrator'))
    {
      return;
    }

    $CredentialCount = $this->setAgentCredentials();
    if ($CredentialCount)
    {
      $this->setAttribute('agentCount', $CredentialCount, self::SUBSCRIBER_NAMESPACE);
      $this->addCredential('hasAgents');

      //add the credentials
    }
      //$criteria = new Criteria();
      //$criteria->add(AgentHasUserPeer::USER_ID, $this->getSubscriberId());
    //$count =  AgentHasUserPeer::doCount($criteria);
    //$user = new User();
    //$count = $user->getAgentCount($this->getSubscriberId());
    //$this->setAttribute('agentCount', $count, self::SUBSCRIBER_NAMESPACE);
    //$this->setAttribute('hasAgents', (bool) $count, self::SUBSCRIBER_NAMESPACE);
    //if ($count)
    //{
      //$this->addCredential('hasAgents');
    //}
    return ;
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

  /**
  * gets the object credentials
  *
  * looks for the correct credential in the id array in the model array for the requested object
  *
  * @return boolean
  * @param string  $model       The model to match the objcte against
  * @param string  $objectId    The object key to match against
  * @param mixed   $credentials An array of credentials
  * @param boolean $useAnd      specify the mode, either AND or OR
  */
  public function hasObjectCredential($model, $key, $credentials)
  {
    //check if there are object credentials at all for this model
    $objCredentialsArray = $this->getAttribute($model, array(), self::OBJECT_CREDENTIAL_NAMESPACE);
    $tmpCredentials = array();

    if (isset($objCredentialsArray[$key]))
    {
      foreach ($objCredentialsArray[$key] as $objCredential => $value)
      {
        if ($value)
        {
          $tmpCredentials[] = $model . $objCredential;
        }
      }

      $this->tmpCredentials = array_merge($this->credentials, $tmpCredentials);

      return $this->hasObjCredential($credentials);

    }
    else
    {
      return $this->hasCredential($credentials);
    }
  }


  /**
   * Returns true if user has credential.
   *
   * Exactly the same as hasCredential except it uses the temporary credentials we built
   * We could also have added the credential array as a param to the regular credential check
   *
   * @param  mixed credentials
   * @param  boolean useAnd specify the mode, either AND or OR
   * @return boolean
   *
   * @author Olivier Verdier <Olivier.Verdier@free.fr>
   */
  public function hasObjCredential($credentials, $useAnd = true)
  {
    if (!is_array($credentials))
    {
      return in_array($credentials, $this->tmpCredentials);
    }

    // now we assume that $credentials is an array
    $test = false;

    foreach ($credentials as $credential)
    {
      // recursively check the credential with a switched AND/OR mode
      $test = $this->hasObjCredential($credential, $useAnd ? false : true);

      if ($useAnd)
      {
        $test = $test ? false : true;
      }

      if ($test) // either passed one in OR mode or failed one in AND mode
      {
        break; // the matter is settled
      }
    }

    if ($useAnd) // in AND mode we succeed if $test is false
    {
      $test = $test ? false : true;
    }

    return $test;
  }

}