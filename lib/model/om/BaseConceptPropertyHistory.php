<?php


abstract class BaseConceptPropertyHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $action;


	
	protected $concept_property_id;


	
	protected $concept_id;


	
	protected $skos_property_id;


	
	protected $object;


	
	protected $scheme_id;


	
	protected $related_concept_id;


	
	protected $language = 'en';


	
	protected $status_id = 1;


	
	protected $created_user_id;

	
	protected $aConceptProperty;

	
	protected $aConceptRelatedByConceptId;

	
	protected $aSkosProperty;

	
	protected $aVocabulary;

	
	protected $aConceptRelatedByRelatedConceptId;

	
	protected $aStatus;

	
	protected $aUser;

	
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

	
	public function getAction()
	{

		return $this->action;
	}

	
	public function getConceptPropertyId()
	{

		return $this->concept_property_id;
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

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::ID;
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
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CREATED_AT;
		}

	} 
	
	public function setAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action !== $v) {
			$this->action = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::ACTION;
		}

	} 
	
	public function setConceptPropertyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_property_id !== $v) {
			$this->concept_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}

	} 
	
	public function setConceptId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_id !== $v) {
			$this->concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CONCEPT_ID;
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

		if ($this->skos_property_id !== $v) {
			$this->skos_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID;
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
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::OBJECT;
		}

	} 
	
	public function setSchemeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheme_id !== $v) {
			$this->scheme_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::SCHEME_ID;
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
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID;
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
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::LANGUAGE;
		}

	} 
	
	public function setStatusId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::STATUS_ID;
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
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CREATED_USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->action = $rs->getString($startcol + 2);

			$this->concept_property_id = $rs->getInt($startcol + 3);

			$this->concept_id = $rs->getInt($startcol + 4);

			$this->skos_property_id = $rs->getInt($startcol + 5);

			$this->object = $rs->getString($startcol + 6);

			$this->scheme_id = $rs->getInt($startcol + 7);

			$this->related_concept_id = $rs->getInt($startcol + 8);

			$this->language = $rs->getString($startcol + 9);

			$this->status_id = $rs->getInt($startcol + 10);

			$this->created_user_id = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 12; 

		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptPropertyHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:delete:pre') as $callable)
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
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPropertyHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:save:post') as $callable)
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


												
			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}

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

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPropertyHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConceptPropertyHistoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aConceptProperty !== null) {
				if (!$this->aConceptProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptProperty->getValidationFailures());
				}
			}

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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = ConceptPropertyHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPropertyHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAction();
				break;
			case 3:
				return $this->getConceptPropertyId();
				break;
			case 4:
				return $this->getConceptId();
				break;
			case 5:
				return $this->getSkosPropertyId();
				break;
			case 6:
				return $this->getObject();
				break;
			case 7:
				return $this->getSchemeId();
				break;
			case 8:
				return $this->getRelatedConceptId();
				break;
			case 9:
				return $this->getLanguage();
				break;
			case 10:
				return $this->getStatusId();
				break;
			case 11:
				return $this->getCreatedUserId();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getAction(),
			$keys[3] => $this->getConceptPropertyId(),
			$keys[4] => $this->getConceptId(),
			$keys[5] => $this->getSkosPropertyId(),
			$keys[6] => $this->getObject(),
			$keys[7] => $this->getSchemeId(),
			$keys[8] => $this->getRelatedConceptId(),
			$keys[9] => $this->getLanguage(),
			$keys[10] => $this->getStatusId(),
			$keys[11] => $this->getCreatedUserId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPropertyHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAction($value);
				break;
			case 3:
				$this->setConceptPropertyId($value);
				break;
			case 4:
				$this->setConceptId($value);
				break;
			case 5:
				$this->setSkosPropertyId($value);
				break;
			case 6:
				$this->setObject($value);
				break;
			case 7:
				$this->setSchemeId($value);
				break;
			case 8:
				$this->setRelatedConceptId($value);
				break;
			case 9:
				$this->setLanguage($value);
				break;
			case 10:
				$this->setStatusId($value);
				break;
			case 11:
				$this->setCreatedUserId($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAction($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConceptPropertyId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setConceptId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSkosPropertyId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setObject($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSchemeId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRelatedConceptId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLanguage($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStatusId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedUserId($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPropertyHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPropertyHistoryPeer::ID)) $criteria->add(ConceptPropertyHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_AT)) $criteria->add(ConceptPropertyHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::ACTION)) $criteria->add(ConceptPropertyHistoryPeer::ACTION, $this->action);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID)) $criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CONCEPT_ID)) $criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->concept_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID)) $criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->skos_property_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::OBJECT)) $criteria->add(ConceptPropertyHistoryPeer::OBJECT, $this->object);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::SCHEME_ID)) $criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->scheme_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID)) $criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->related_concept_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::LANGUAGE)) $criteria->add(ConceptPropertyHistoryPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::STATUS_ID)) $criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_USER_ID)) $criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->created_user_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptPropertyHistoryPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyHistoryPeer::ID, $this->id);

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

		$copyObj->setAction($this->action);

		$copyObj->setConceptPropertyId($this->concept_property_id);

		$copyObj->setConceptId($this->concept_id);

		$copyObj->setSkosPropertyId($this->skos_property_id);

		$copyObj->setObject($this->object);

		$copyObj->setSchemeId($this->scheme_id);

		$copyObj->setRelatedConceptId($this->related_concept_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setCreatedUserId($this->created_user_id);


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
			self::$peer = new ConceptPropertyHistoryPeer();
		}
		return self::$peer;
	}

	
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setConceptPropertyId(NULL);
		} else {
			$this->setConceptPropertyId($v->getId());
		}


		$this->aConceptProperty = $v;
	}


	
	public function getConceptProperty($con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';

		if ($this->aConceptProperty === null && ($this->concept_property_id !== null)) {

			$this->aConceptProperty = ConceptPropertyPeer::retrieveByPK($this->concept_property_id, $con);

			
		}
		return $this->aConceptProperty;
	}

	
	public function setConceptRelatedByConceptId($v)
	{


		if ($v === null) {
			$this->setConceptId(NULL);
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
			$this->setSkosPropertyId(NULL);
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

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->created_user_id !== null)) {

			$this->aUser = UserPeer::retrieveByPK($this->created_user_id, $con);

			
		}
		return $this->aUser;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConceptPropertyHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConceptPropertyHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
