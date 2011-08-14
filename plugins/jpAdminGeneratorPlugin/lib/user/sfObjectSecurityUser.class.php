<?php


/**
 * sfObjectSecurityUser will handle any type of data as a credential.
 *
 * @package    symfony
 * @subpackage user
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <skerr@mojavi.org>
 * @version    SVN: $Id: sfBasicSecurityUser.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class sfObjectSecurityUser
{
  const LAST_REQUEST_NAMESPACE = 'symfony/user/sfUser/lastRequest';
  const AUTH_NAMESPACE = 'symfony/user/sfUser/authenticated';
  const CREDENTIAL_NAMESPACE = 'symfony/user/sfUser/credentials';

  protected $lastRequest = null;

  protected $credentials = null;
  protected $authenticated = null;

  /**
   * Clears all credentials.
   *
   */
  public function clearObjectCredentials()
  {
    $this->credentials = null;
    $this->credentials = array();
  }

  /**
   * returns an array containing the credentials
   */
  public function listObjectCredentials()
  {
    return $this->credentials;
  }

  /**
   * Removes a credential.
   *
   * @param  mixed credential
   */
  public function removeObjectCredential($credential)
  {
    if ($this->hasCredential($credential))
    {
      foreach ($this->credentials as $key => $value)
      {
        if ($credential == $value)
        {
          if (sfConfig::get('sf_logging_enabled'))
          {
            $this->getContext()->getLogger()->info('{sfUser} remove credential "'.$credential.'"');
          }

          unset($this->credentials[$key]);
          return;
        }
      }
    }
  }

  /**
   * Adds a credential.
   *
   * @param  mixed credential
   */
  public function addObjectCredential($credential)
  {
    $this->addCredentials(func_get_args());
  }

  /**
   * Adds several credential at once.
   *
   * @param  mixed array or list of credentials
   */
  public function addObjectCredentials()
  {
    if (func_num_args() == 0) return;

    // Add all credentials
    $credentials = (is_array(func_get_arg(0))) ? func_get_arg(0) : func_get_args();

    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getContext()->getLogger()->info('{sfUser} add credential(s) "'.implode(', ', $credentials).'"');
    }

    foreach ($credentials as $aCredential)
    {
      if (!in_array($aCredential, $this->credentials))
      {
        $this->credentials[] = $aCredential;
      }
    }
  }


  /**
   * Returns true if user has credential.
   *
   * @param  mixed credentials
   * @param  boolean useAnd specify the mode, either AND or OR
   * @return boolean
   *
   * @author Olivier Verdier <Olivier.Verdier@free.fr>
   */
  public function hasObjectCredential($credentials, $useAnd = true)
  {
    if (!is_array($credentials))
    {
      return in_array($credentials, $this->credentials);
    }

    // now we assume that $credentials is an array
    $test = false;

    foreach ($credentials as $credential)
    {
      // recursively check the credential with a switched AND/OR mode
      $test = $this->hasCredential($credential, $useAnd ? false : true);

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

  public function initializeObject($context, $parameters = null)
  {
    // initialize parent
    //parent::initialize($context, $parameters);

    // read data from storage
    $storage = $this->getContext()->getStorage();

    $this->authenticated = $storage->read(self::AUTH_NAMESPACE);
    $this->credentials   = $storage->read(self::CREDENTIAL_NAMESPACE);
    $this->lastRequest   = $storage->read(self::LAST_REQUEST_NAMESPACE);

    if ($this->authenticated == null)
    {
      $this->authenticated = false;
      $this->credentials   = array();
    }

    // Automatic logout if no request for more than [sf_timeout]
    if (null !== $this->lastRequest && (time() - $this->lastRequest) > sfConfig::get('sf_timeout'))
    {
      if (sfConfig::get('sf_logging_enabled'))
      {
        $this->getContext()->getLogger()->info('{sfUser} automatic user logout');
      }
      $this->setTimedOut();
      $this->clearCredentials();
      $this->setAuthenticated(false);
    }

    $this->lastRequest = time();
  }

}
