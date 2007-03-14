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


	
	protected $language;


	
	protected $status_id;

	
	protected $aConceptRelatedByConceptId;

	
	protected $aSkosProperty;

	
	protected $aVocabulary;

	
	protected $aConceptRelatedByRelatedConceptId;

	
	protected $aLookup;

	
	protected $collConceptHistorys;

	
	protected $lastConceptHistoryCriteria = null;

	
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
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
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
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_updated] as date/time value: " . var_export($this->last_updated, true));
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

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
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
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_updated] from input: " . var_export($v, true));
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

		if ($this->object !== $v) {
			$this->object = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::OBJECT;
		}

	} 
	
	public function setSchemeId($v)
	{

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

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::LANGUAGE;
		}

	} 
	
	public function setStatusId($v)
	{

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::STATUS_ID;
		}

		if ($this->aLookup !== null && $this->aLookup->getId() !== $v) {
			$this->aLookup = null;
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

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptProperty object", $e);
		}
	}

	
	public function delete($con = null)
	{
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
	}

	
	public function save($con = null)
	{
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

			if ($this->aLookup !== null) {
				if ($this->aLookup->isModified()) {
					$affectedRows += $this->aLookup->save($con);
				}
				$this->setLookup($this->aLookup);
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

			if ($this->collConceptHistorys !== null) {
				foreach($this->collConceptHistorys as $referrerFK) {
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

			if ($this->aLookup !== null) {
				if (!$this->aLookup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLookup->getValidationFailures());
				}
			}


			if (($retval = ConceptPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConceptHistorys !== null) {
					foreach($this->collConceptHistorys as $referrerFK) {
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
			default:
				return null;
				break;
		} 	}

	
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
		} 	}

	
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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConceptHistorys() as $relObj) {
				$copyObj->addConceptHistory($relObj->copy($deepCopy));
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

	
	public function setLookup($v)
	{


		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aLookup = $v;
	}


	
	public function getLookup($con = null)
	{
				include_once 'lib/model/om/BaseLookupPeer.php';

		if ($this->aLookup === null && ($this->status_id !== null)) {

			$this->aLookup = LookupPeer::retrieveByPK($this->status_id, $con);

			
		}
		return $this->aLookup;
	}

	
	public function initConceptHistorys()
	{
		if ($this->collConceptHistorys === null) {
			$this->collConceptHistorys = array();
		}
	}

	
	public function getConceptHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptHistorys === null) {
			if ($this->isNew()) {
			   $this->collConceptHistorys = array();
			} else {

				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptHistoryPeer::addSelectColumns($criteria);
				$this->collConceptHistorys = ConceptHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptHistoryCriteria) || !$this->lastConceptHistoryCriteria->equals($criteria)) {
					$this->collConceptHistorys = ConceptHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptHistoryCriteria = $criteria;
		return $this->collConceptHistorys;
	}

	
	public function countConceptHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

		return ConceptHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptHistory(ConceptHistory $l)
	{
		$this->collConceptHistorys[] = $l;
		$l->setConceptProperty($this);
	}


	
	public function getConceptHistorysJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptHistorys = array();
			} else {

				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptHistorys = ConceptHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptHistoryCriteria) || !$this->lastConceptHistoryCriteria->equals($criteria)) {
				$this->collConceptHistorys = ConceptHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptHistoryCriteria = $criteria;

		return $this->collConceptHistorys;
	}

} 