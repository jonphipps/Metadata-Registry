<?php


abstract class BaseConceptProperty extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $last_updated;


	
	protected $concept_id = 0;


	
	protected $skos_property_id = 0;


	
	protected $object;


	
	protected $scheme_id;


	
	protected $related_concept_id;


	
	protected $language = 'en';


	
	protected $status_id = 1;


	
	protected $created_user_id;


	
	protected $updated_user_id;

	
	protected $aConceptRelatedByConceptId;

	
	protected $aSkosProperty;

	
	protected $aVocabulary;

	
	protected $aConceptRelatedByRelatedConceptId;

	
	protected $aStatus;

	
	protected $aUserRelatedByCreatedUserId;

	
	protected $aUserRelatedByUpdatedUserId;

	
	protected $collConcepts;

	
	protected $lastConceptCriteria = null;

	
	protected $collConceptPropertyHistorys;

	
	protected $lastConceptPropertyHistoryCriteria = null;

	
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

	
	public function getConceptId()
	{

		return $this->concept_id;
	}

	
	public function getSkosPropertyId()
	{

		return $this->skos_property_id;
	}

	
	public function getObject()
	{

		return $this->object;
	}

	
	public function getSchemeId()
	{

		return $this->scheme_id;
	}

	
	public function getRelatedConceptId()
	{

		return $this->related_concept_id;
	}

	
	public function getLanguage()
	{

		return $this->language;
	}

	
	public function getStatusId()
	{

		return $this->status_id;
	}

	
	public function getCreatedUserId()
	{

		return $this->created_user_id;
	}

	
	public function getUpdatedUserId()
	{

		return $this->updated_user_id;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::ID;
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
			$this->modifiedColumns[] = ConceptPropertyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ConceptPropertyPeer::LAST_UPDATED;
		}

	} 
	
	public function setConceptId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_id !== $v || $v === 0) {
			$this->concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::CONCEPT_ID;
		}

		if ($this->aConceptRelatedByConceptId !== null && $this->aConceptRelatedByConceptId->getId() !== $v) {
			$this->aConceptRelatedByConceptId = null;
		}

	} 
	
	public function setSkosPropertyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->skos_property_id !== $v || $v === 0) {
			$this->skos_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SKOS_PROPERTY_ID;
		}

		if ($this->aSkosProperty !== null && $this->aSkosProperty->getId() !== $v) {
			$this->aSkosProperty = null;
		}

	} 
	
	public function setObject($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object !== $v) {
			$this->object = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::OBJECT;
		}

	} 
	
	public function setSchemeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheme_id !== $v) {
			$this->scheme_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SCHEME_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} 
	
	public function setRelatedConceptId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->related_concept_id !== $v) {
			$this->related_concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::RELATED_CONCEPT_ID;
		}

		if ($this->aConceptRelatedByRelatedConceptId !== null && $this->aConceptRelatedByRelatedConceptId->getId() !== $v) {
			$this->aConceptRelatedByRelatedConceptId = null;
		}

	} 
	
	public function setLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v || $v === 'en') {
			$this->language = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::LANGUAGE;
		}

	} 
	
	public function setStatusId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} 
	
	public function setCreatedUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_user_id !== $v) {
			$this->created_user_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::CREATED_USER_ID;
		}

		if ($this->aUserRelatedByCreatedUserId !== null && $this->aUserRelatedByCreatedUserId->getId() !== $v) {
			$this->aUserRelatedByCreatedUserId = null;
		}

	} 
	
	public function setUpdatedUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_user_id !== $v) {
			$this->updated_user_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::UPDATED_USER_ID;
		}

		if ($this->aUserRelatedByUpdatedUserId !== null && $this->aUserRelatedByUpdatedUserId->getId() !== $v) {
			$this->aUserRelatedByUpdatedUserId = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->concept_id = $rs->getInt($startcol + 3);

			$this->skos_property_id = $rs->getInt($startcol + 4);

			$this->object = $rs->getString($startcol + 5);

			$this->scheme_id = $rs->getInt($startcol + 6);

			$this->related_concept_id = $rs->getInt($startcol + 7);

			$this->language = $rs->getString($startcol + 8);

			$this->status_id = $rs->getInt($startcol + 9);

			$this->created_user_id = $rs->getInt($startcol + 10);

			$this->updated_user_id = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 12; 

		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptProperty object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConceptProperty:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptProperty:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ConceptPropertyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConceptProperty:save:post') as $callable)
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


												
			if ($this->aConceptRelatedByConceptId !== null) {
				if ($this->aConceptRelatedByConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByConceptId->save($con);
				}
				$this->setConceptRelatedByConceptId($this->aConceptRelatedByConceptId);
			}

			if ($this->aSkosProperty !== null) {
				if ($this->aSkosProperty->isModified()) {
					$affectedRows += $this->aSkosProperty->save($con);
				}
				$this->setSkosProperty($this->aSkosProperty);
			}

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if ($this->aConceptRelatedByRelatedConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByRelatedConceptId->save($con);
				}
				$this->setConceptRelatedByRelatedConceptId($this->aConceptRelatedByRelatedConceptId);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if ($this->aUserRelatedByCreatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByCreatedUserId->save($con);
				}
				$this->setUserRelatedByCreatedUserId($this->aUserRelatedByCreatedUserId);
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if ($this->aUserRelatedByUpdatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByUpdatedUserId->save($con);
				}
				$this->setUserRelatedByUpdatedUserId($this->aUserRelatedByUpdatedUserId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPropertyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConceptPropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collConcepts !== null) {
				foreach($this->collConcepts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorys !== null) {
				foreach($this->collConceptPropertyHistorys as $referrerFK) {
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


												
			if ($this->aConceptRelatedByConceptId !== null) {
				if (!$this->aConceptRelatedByConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByConceptId->getValidationFailures());
				}
			}

			if ($this->aSkosProperty !== null) {
				if (!$this->aSkosProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSkosProperty->getValidationFailures());
				}
			}

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if (!$this->aConceptRelatedByRelatedConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByRelatedConceptId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if (!$this->aUserRelatedByCreatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedUserId->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if (!$this->aUserRelatedByUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedUserId->getValidationFailures());
				}
			}


			if (($retval = ConceptPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConcepts !== null) {
					foreach($this->collConcepts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorys !== null) {
					foreach($this->collConceptPropertyHistorys as $referrerFK) {
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
		$pos = ConceptPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getConceptId();
				break;
			case 4:
				return $this->getSkosPropertyId();
				break;
			case 5:
				return $this->getObject();
				break;
			case 6:
				return $this->getSchemeId();
				break;
			case 7:
				return $this->getRelatedConceptId();
				break;
			case 8:
				return $this->getLanguage();
				break;
			case 9:
				return $this->getStatusId();
				break;
			case 10:
				return $this->getCreatedUserId();
				break;
			case 11:
				return $this->getUpdatedUserId();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getConceptId(),
			$keys[4] => $this->getSkosPropertyId(),
			$keys[5] => $this->getObject(),
			$keys[6] => $this->getSchemeId(),
			$keys[7] => $this->getRelatedConceptId(),
			$keys[8] => $this->getLanguage(),
			$keys[9] => $this->getStatusId(),
			$keys[10] => $this->getCreatedUserId(),
			$keys[11] => $this->getUpdatedUserId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setConceptId($value);
				break;
			case 4:
				$this->setSkosPropertyId($value);
				break;
			case 5:
				$this->setObject($value);
				break;
			case 6:
				$this->setSchemeId($value);
				break;
			case 7:
				$this->setRelatedConceptId($value);
				break;
			case 8:
				$this->setLanguage($value);
				break;
			case 9:
				$this->setStatusId($value);
				break;
			case 10:
				$this->setCreatedUserId($value);
				break;
			case 11:
				$this->setUpdatedUserId($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConceptId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSkosPropertyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObject($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchemeId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRelatedConceptId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLanguage($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatusId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedUserId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedUserId($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPropertyPeer::ID)) $criteria->add(ConceptPropertyPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPropertyPeer::CREATED_AT)) $criteria->add(ConceptPropertyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPropertyPeer::LAST_UPDATED)) $criteria->add(ConceptPropertyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(ConceptPropertyPeer::CONCEPT_ID)) $criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->concept_id);
		if ($this->isColumnModified(ConceptPropertyPeer::SKOS_PROPERTY_ID)) $criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->skos_property_id);
		if ($this->isColumnModified(ConceptPropertyPeer::OBJECT)) $criteria->add(ConceptPropertyPeer::OBJECT, $this->object);
		if ($this->isColumnModified(ConceptPropertyPeer::SCHEME_ID)) $criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->scheme_id);
		if ($this->isColumnModified(ConceptPropertyPeer::RELATED_CONCEPT_ID)) $criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->related_concept_id);
		if ($this->isColumnModified(ConceptPropertyPeer::LANGUAGE)) $criteria->add(ConceptPropertyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(ConceptPropertyPeer::STATUS_ID)) $criteria->add(ConceptPropertyPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ConceptPropertyPeer::CREATED_USER_ID)) $criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(ConceptPropertyPeer::UPDATED_USER_ID)) $criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->updated_user_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyPeer::ID, $this->id);

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

		$copyObj->setConceptId($this->concept_id);

		$copyObj->setSkosPropertyId($this->skos_property_id);

		$copyObj->setObject($this->object);

		$copyObj->setSchemeId($this->scheme_id);

		$copyObj->setRelatedConceptId($this->related_concept_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setUpdatedUserId($this->updated_user_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConcepts() as $relObj) {
				$copyObj->addConcept($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
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
			self::$peer = new ConceptPropertyPeer();
		}
		return self::$peer;
	}

	
	public function setConceptRelatedByConceptId($v)
	{


		if ($v === null) {
			$this->setConceptId('null');
		} else {
			$this->setConceptId($v->getId());
		}


		$this->aConceptRelatedByConceptId = $v;
	}


	
	public function getConceptRelatedByConceptId($con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';

		if ($this->aConceptRelatedByConceptId === null && ($this->concept_id !== null)) {

			$this->aConceptRelatedByConceptId = ConceptPeer::retrieveByPK($this->concept_id, $con);

			
		}
		return $this->aConceptRelatedByConceptId;
	}

	
	public function setSkosProperty($v)
	{


		if ($v === null) {
			$this->setSkosPropertyId('null');
		} else {
			$this->setSkosPropertyId($v->getId());
		}


		$this->aSkosProperty = $v;
	}


	
	public function getSkosProperty($con = null)
	{
				include_once 'lib/model/om/BaseSkosPropertyPeer.php';

		if ($this->aSkosProperty === null && ($this->skos_property_id !== null)) {

			$this->aSkosProperty = SkosPropertyPeer::retrieveByPK($this->skos_property_id, $con);

			
		}
		return $this->aSkosProperty;
	}

	
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setSchemeId(NULL);
		} else {
			$this->setSchemeId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	
	public function getVocabulary($con = null)
	{
				include_once 'lib/model/om/BaseVocabularyPeer.php';

		if ($this->aVocabulary === null && ($this->scheme_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->scheme_id, $con);

			
		}
		return $this->aVocabulary;
	}

	
	public function setConceptRelatedByRelatedConceptId($v)
	{


		if ($v === null) {
			$this->setRelatedConceptId(NULL);
		} else {
			$this->setRelatedConceptId($v->getId());
		}


		$this->aConceptRelatedByRelatedConceptId = $v;
	}


	
	public function getConceptRelatedByRelatedConceptId($con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';

		if ($this->aConceptRelatedByRelatedConceptId === null && ($this->related_concept_id !== null)) {

			$this->aConceptRelatedByRelatedConceptId = ConceptPeer::retrieveByPK($this->related_concept_id, $con);

			
		}
		return $this->aConceptRelatedByRelatedConceptId;
	}

	
	public function setStatus($v)
	{


		if ($v === null) {
			$this->setStatusId('1');
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aStatus = $v;
	}


	
	public function getStatus($con = null)
	{
				include_once 'lib/model/om/BaseStatusPeer.php';

		if ($this->aStatus === null && ($this->status_id !== null)) {

			$this->aStatus = StatusPeer::retrieveByPK($this->status_id, $con);

			
		}
		return $this->aStatus;
	}

	
	public function setUserRelatedByCreatedUserId($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUserRelatedByCreatedUserId = $v;
	}


	
	public function getUserRelatedByCreatedUserId($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUserRelatedByCreatedUserId === null && ($this->created_user_id !== null)) {

			$this->aUserRelatedByCreatedUserId = UserPeer::retrieveByPK($this->created_user_id, $con);

			
		}
		return $this->aUserRelatedByCreatedUserId;
	}

	
	public function setUserRelatedByUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setUpdatedUserId(NULL);
		} else {
			$this->setUpdatedUserId($v->getId());
		}


		$this->aUserRelatedByUpdatedUserId = $v;
	}


	
	public function getUserRelatedByUpdatedUserId($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUserRelatedByUpdatedUserId === null && ($this->updated_user_id !== null)) {

			$this->aUserRelatedByUpdatedUserId = UserPeer::retrieveByPK($this->updated_user_id, $con);

			
		}
		return $this->aUserRelatedByUpdatedUserId;
	}

	
	public function initConcepts()
	{
		if ($this->collConcepts === null) {
			$this->collConcepts = array();
		}
	}

	
	public function getConcepts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
			   $this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
					$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptCriteria = $criteria;
		return $this->collConcepts;
	}

	
	public function countConcepts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setConceptProperty($this);
	}


	
	public function getConceptsJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	
	public function getConceptsJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::PREF_LABEL_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}

	
	public function initConceptPropertyHistorys()
	{
		if ($this->collConceptPropertyHistorys === null) {
			$this->collConceptPropertyHistorys = array();
		}
	}

	
	public function getConceptPropertyHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;
		return $this->collConceptPropertyHistorys;
	}

	
	public function countConceptPropertyHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistory(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorys[] = $l;
		$l->setConceptProperty($this);
	}


	
	public function getConceptPropertyHistorysJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConceptProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConceptProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
