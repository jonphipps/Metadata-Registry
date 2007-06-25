<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $last_updated;


	
	protected $deleted_at;


	
	protected $nickname;


	
	protected $salutation;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $want_to_be_moderator = false;


	
	protected $is_moderator = false;


	
	protected $is_administrator = false;


	
	protected $deletions = 0;


	
	protected $password;

	
	protected $collAgentHasUsers;

	
	protected $lastAgentHasUserCriteria = null;

	
	protected $collConceptPropertysRelatedByCreatedUserId;

	
	protected $lastConceptPropertyRelatedByCreatedUserIdCriteria = null;

	
	protected $collConceptPropertysRelatedByUpdatedUserId;

	
	protected $lastConceptPropertyRelatedByUpdatedUserIdCriteria = null;

	
	protected $collConceptPropertyHistorysRelatedByCreatedUserId;

	
	protected $lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = null;

	
	protected $collConceptPropertyHistorysRelatedByUpdatedUserId;

	
	protected $lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = null;

	
	protected $collVocabularyHasUsers;

	
	protected $lastVocabularyHasUserCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getLastUpdated($format = 'Y-m-d H:i:s')
	{

		if ($this->last_updated === null || $this->last_updated === '') {
			return null;
		} elseif (!is_int($this->last_updated)) {
			
			$ts = strtotime($this->last_updated);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse value of [last_updated] as date/time value: " . var_export($this->last_updated, true));
			}
		} else {
			$ts = $this->last_updated;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
			
			$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getNickname()
	{

		return $this->nickname;
	}

	
	public function getSalutation()
	{

		return $this->salutation;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getWantToBeModerator()
	{

		return $this->want_to_be_moderator;
	}

	
	public function getIsModerator()
	{

		return $this->is_moderator;
	}

	
	public function getIsAdministrator()
	{

		return $this->is_administrator;
	}

	
	public function getDeletions()
	{

		return $this->deletions;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
		}

	} 
	
	public function setLastUpdated($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse date/time value for [last_updated] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_updated !== $ts) {
			$this->last_updated = $ts;
			$this->modifiedColumns[] = UserPeer::LAST_UPDATED;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = UserPeer::DELETED_AT;
		}

	} 
	
	public function setNickname($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v) {
			$this->nickname = $v;
			$this->modifiedColumns[] = UserPeer::NICKNAME;
		}

	} 
	
	public function setSalutation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salutation !== $v) {
			$this->salutation = $v;
			$this->modifiedColumns[] = UserPeer::SALUTATION;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UserPeer::SALT;
		}

	} 
	
	public function setWantToBeModerator($v)
	{

		if ($this->want_to_be_moderator !== $v || $v === false) {
			$this->want_to_be_moderator = $v;
			$this->modifiedColumns[] = UserPeer::WANT_TO_BE_MODERATOR;
		}

	} 
	
	public function setIsModerator($v)
	{

		if ($this->is_moderator !== $v || $v === false) {
			$this->is_moderator = $v;
			$this->modifiedColumns[] = UserPeer::IS_MODERATOR;
		}

	} 
	
	public function setIsAdministrator($v)
	{

		if ($this->is_administrator !== $v || $v === false) {
			$this->is_administrator = $v;
			$this->modifiedColumns[] = UserPeer::IS_ADMINISTRATOR;
		}

	} 
	
	public function setDeletions($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deletions !== $v || $v === 0) {
			$this->deletions = $v;
			$this->modifiedColumns[] = UserPeer::DELETIONS;
		}

	} 
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->nickname = $rs->getString($startcol + 4);

			$this->salutation = $rs->getString($startcol + 5);

			$this->first_name = $rs->getString($startcol + 6);

			$this->last_name = $rs->getString($startcol + 7);

			$this->email = $rs->getString($startcol + 8);

			$this->sha1_password = $rs->getString($startcol + 9);

			$this->salt = $rs->getString($startcol + 10);

			$this->want_to_be_moderator = $rs->getBoolean($startcol + 11);

			$this->is_moderator = $rs->getBoolean($startcol + 12);

			$this->is_administrator = $rs->getBoolean($startcol + 13);

			$this->deletions = $rs->getInt($startcol + 14);

			$this->password = $rs->getString($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 16; 

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUser:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAgentHasUsers !== null) {
				foreach($this->collAgentHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByCreatedUserId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularyHasUsers !== null) {
				foreach($this->collVocabularyHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAgentHasUsers !== null) {
					foreach($this->collAgentHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByCreatedUserId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularyHasUsers !== null) {
					foreach($this->collVocabularyHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getLastUpdated();
				break;
			case 3:
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getNickname();
				break;
			case 5:
				return $this->getSalutation();
				break;
			case 6:
				return $this->getFirstName();
				break;
			case 7:
				return $this->getLastName();
				break;
			case 8:
				return $this->getEmail();
				break;
			case 9:
				return $this->getSha1Password();
				break;
			case 10:
				return $this->getSalt();
				break;
			case 11:
				return $this->getWantToBeModerator();
				break;
			case 12:
				return $this->getIsModerator();
				break;
			case 13:
				return $this->getIsAdministrator();
				break;
			case 14:
				return $this->getDeletions();
				break;
			case 15:
				return $this->getPassword();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getNickname(),
			$keys[5] => $this->getSalutation(),
			$keys[6] => $this->getFirstName(),
			$keys[7] => $this->getLastName(),
			$keys[8] => $this->getEmail(),
			$keys[9] => $this->getSha1Password(),
			$keys[10] => $this->getSalt(),
			$keys[11] => $this->getWantToBeModerator(),
			$keys[12] => $this->getIsModerator(),
			$keys[13] => $this->getIsAdministrator(),
			$keys[14] => $this->getDeletions(),
			$keys[15] => $this->getPassword(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setLastUpdated($value);
				break;
			case 3:
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setNickname($value);
				break;
			case 5:
				$this->setSalutation($value);
				break;
			case 6:
				$this->setFirstName($value);
				break;
			case 7:
				$this->setLastName($value);
				break;
			case 8:
				$this->setEmail($value);
				break;
			case 9:
				$this->setSha1Password($value);
				break;
			case 10:
				$this->setSalt($value);
				break;
			case 11:
				$this->setWantToBeModerator($value);
				break;
			case 12:
				$this->setIsModerator($value);
				break;
			case 13:
				$this->setIsAdministrator($value);
				break;
			case 14:
				$this->setDeletions($value);
				break;
			case 15:
				$this->setPassword($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNickname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalutation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFirstName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLastName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSha1Password($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSalt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setWantToBeModerator($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsModerator($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsAdministrator($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDeletions($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPassword($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserPeer::LAST_UPDATED)) $criteria->add(UserPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(UserPeer::DELETED_AT)) $criteria->add(UserPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(UserPeer::NICKNAME)) $criteria->add(UserPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(UserPeer::SALUTATION)) $criteria->add(UserPeer::SALUTATION, $this->salutation);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::SHA1_PASSWORD)) $criteria->add(UserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UserPeer::SALT)) $criteria->add(UserPeer::SALT, $this->salt);
		if ($this->isColumnModified(UserPeer::WANT_TO_BE_MODERATOR)) $criteria->add(UserPeer::WANT_TO_BE_MODERATOR, $this->want_to_be_moderator);
		if ($this->isColumnModified(UserPeer::IS_MODERATOR)) $criteria->add(UserPeer::IS_MODERATOR, $this->is_moderator);
		if ($this->isColumnModified(UserPeer::IS_ADMINISTRATOR)) $criteria->add(UserPeer::IS_ADMINISTRATOR, $this->is_administrator);
		if ($this->isColumnModified(UserPeer::DELETIONS)) $criteria->add(UserPeer::DELETIONS, $this->deletions);
		if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setNickname($this->nickname);

		$copyObj->setSalutation($this->salutation);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setWantToBeModerator($this->want_to_be_moderator);

		$copyObj->setIsModerator($this->is_moderator);

		$copyObj->setIsAdministrator($this->is_administrator);

		$copyObj->setDeletions($this->deletions);

		$copyObj->setPassword($this->password);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAgentHasUsers() as $relObj) {
				$copyObj->addAgentHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	
	public function initAgentHasUsers()
	{
		if ($this->collAgentHasUsers === null) {
			$this->collAgentHasUsers = array();
		}
	}

	
	public function getAgentHasUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
			   $this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
					$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;
		return $this->collAgentHasUsers;
	}

	
	public function countAgentHasUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

		return AgentHasUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAgentHasUser(AgentHasUser $l)
	{
		$this->collAgentHasUsers[] = $l;
		$l->setUser($this);
	}


	
	public function getAgentHasUsersJoinAgent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
				$this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
									
			$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;

		return $this->collAgentHasUsers;
	}

	
	public function initConceptPropertysRelatedByCreatedUserId()
	{
		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			$this->collConceptPropertysRelatedByCreatedUserId = array();
		}
	}

	
	public function getConceptPropertysRelatedByCreatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	
	public function countConceptPropertysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyRelatedByCreatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertysRelatedByCreatedUserIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertysRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	
	public function initConceptPropertysRelatedByUpdatedUserId()
	{
		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			$this->collConceptPropertysRelatedByUpdatedUserId = array();
		}
	}

	
	public function getConceptPropertysRelatedByUpdatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}

	
	public function countConceptPropertysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyRelatedByUpdatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertysRelatedByUpdatedUserIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertysRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}

	
	public function initConceptPropertyHistorysRelatedByCreatedUserId()
	{
		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
		}
	}

	
	public function getConceptPropertyHistorysRelatedByCreatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}

	
	public function countConceptPropertyHistorysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistoryRelatedByCreatedUserId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByCreatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByCreatedUserId;
	}

	
	public function initConceptPropertyHistorysRelatedByUpdatedUserId()
	{
		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
		}
	}

	
	public function getConceptPropertyHistorysRelatedByUpdatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}

	
	public function countConceptPropertyHistorysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistoryRelatedByUpdatedUserId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinConceptProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}


	
	public function getConceptPropertyHistorysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByUpdatedUserId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByUpdatedUserId;
	}

	
	public function initVocabularyHasUsers()
	{
		if ($this->collVocabularyHasUsers === null) {
			$this->collVocabularyHasUsers = array();
		}
	}

	
	public function getVocabularyHasUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
					$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;
		return $this->collVocabularyHasUsers;
	}

	
	public function countVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

		return VocabularyHasUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVocabularyHasUser(VocabularyHasUser $l)
	{
		$this->collVocabularyHasUsers[] = $l;
		$l->setUser($this);
	}


	
	public function getVocabularyHasUsersJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;

		return $this->collVocabularyHasUsers;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
