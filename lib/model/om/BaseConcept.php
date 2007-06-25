<?php


abstract class BaseConcept extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $last_updated;


	
	protected $last_updated_by_user_id;


	
	protected $deleted_at;


	
	protected $uri = 'null';


	
	protected $vocabulary_id;


	
	protected $is_top_concept;


	
	protected $pref_label_id;


	
	protected $pref_label = 'null';


	
	protected $status_id = 1;


	
	protected $language = 'en';

	
	protected $aUser;

	
	protected $aVocabulary;

	
	protected $aConceptProperty;

	
	protected $aStatus;

	
	protected $collConceptPropertysRelatedByConceptId;

	
	protected $lastConceptPropertyRelatedByConceptIdCriteria = null;

	
	protected $collConceptPropertysRelatedByRelatedConceptId;

	
	protected $lastConceptPropertyRelatedByRelatedConceptIdCriteria = null;

	
	protected $collConceptPropertyHistorysRelatedByConceptId;

	
	protected $lastConceptPropertyHistoryRelatedByConceptIdCriteria = null;

	
	protected $collConceptPropertyHistorysRelatedByRelatedConceptId;

	
	protected $lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = null;

	
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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

	
	public function getLastUpdatedByUserId()
	{

		return $this->last_updated_by_user_id;
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

	
	public function getUri()
	{

		return $this->uri;
	}

	
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	
	public function getIsTopConcept()
	{

		return $this->is_top_concept;
	}

	
	public function getPrefLabelId()
	{

		return $this->pref_label_id;
	}

	
	public function getPrefLabel()
	{

		return $this->pref_label;
	}

	
	public function getStatusId()
	{

		return $this->status_id;
	}

	
	public function getLanguage()
	{

		return $this->language;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPeer::ID;
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
			$this->modifiedColumns[] = ConceptPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ConceptPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = ConceptPeer::LAST_UPDATED;
		}

	} 
	
	public function setLastUpdatedByUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_updated_by_user_id !== $v) {
			$this->last_updated_by_user_id = $v;
			$this->modifiedColumns[] = ConceptPeer::LAST_UPDATED_BY_USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
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
			$this->modifiedColumns[] = ConceptPeer::DELETED_AT;
		}

	} 
	
	public function setUri($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri !== $v || $v === 'null') {
			$this->uri = $v;
			$this->modifiedColumns[] = ConceptPeer::URI;
		}

	} 
	
	public function setVocabularyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} 
	
	public function setIsTopConcept($v)
	{

		if ($this->is_top_concept !== $v) {
			$this->is_top_concept = $v;
			$this->modifiedColumns[] = ConceptPeer::IS_TOP_CONCEPT;
		}

	} 
	
	public function setPrefLabelId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pref_label_id !== $v) {
			$this->pref_label_id = $v;
			$this->modifiedColumns[] = ConceptPeer::PREF_LABEL_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}

	} 
	
	public function setPrefLabel($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pref_label !== $v || $v === 'null') {
			$this->pref_label = $v;
			$this->modifiedColumns[] = ConceptPeer::PREF_LABEL;
		}

	} 
	
	public function setStatusId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} 
	
	public function setLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v || $v === 'en') {
			$this->language = $v;
			$this->modifiedColumns[] = ConceptPeer::LANGUAGE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->last_updated = $rs->getTimestamp($startcol + 3, null);

			$this->last_updated_by_user_id = $rs->getInt($startcol + 4);

			$this->deleted_at = $rs->getTimestamp($startcol + 5, null);

			$this->uri = $rs->getString($startcol + 6);

			$this->vocabulary_id = $rs->getInt($startcol + 7);

			$this->is_top_concept = $rs->getBoolean($startcol + 8);

			$this->pref_label_id = $rs->getInt($startcol + 9);

			$this->pref_label = $rs->getString($startcol + 10);

			$this->status_id = $rs->getInt($startcol + 11);

			$this->language = $rs->getString($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 13; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Concept object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseConcept:delete:pre') as $callable)
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
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConcept:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseConcept:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ConceptPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ConceptPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConcept:save:post') as $callable)
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


												
			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}

			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConceptPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collConceptPropertysRelatedByConceptId !== null) {
				foreach($this->collConceptPropertysRelatedByConceptId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByRelatedConceptId !== null) {
				foreach($this->collConceptPropertysRelatedByRelatedConceptId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByConceptId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByConceptId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByRelatedConceptId as $referrerFK) {
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


												
			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}

			if ($this->aConceptProperty !== null) {
				if (!$this->aConceptProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptProperty->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = ConceptPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConceptPropertysRelatedByConceptId !== null) {
					foreach($this->collConceptPropertysRelatedByConceptId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByRelatedConceptId !== null) {
					foreach($this->collConceptPropertysRelatedByRelatedConceptId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByConceptId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByConceptId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByRelatedConceptId as $referrerFK) {
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
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getLastUpdated();
				break;
			case 4:
				return $this->getLastUpdatedByUserId();
				break;
			case 5:
				return $this->getDeletedAt();
				break;
			case 6:
				return $this->getUri();
				break;
			case 7:
				return $this->getVocabularyId();
				break;
			case 8:
				return $this->getIsTopConcept();
				break;
			case 9:
				return $this->getPrefLabelId();
				break;
			case 10:
				return $this->getPrefLabel();
				break;
			case 11:
				return $this->getStatusId();
				break;
			case 12:
				return $this->getLanguage();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getLastUpdated(),
			$keys[4] => $this->getLastUpdatedByUserId(),
			$keys[5] => $this->getDeletedAt(),
			$keys[6] => $this->getUri(),
			$keys[7] => $this->getVocabularyId(),
			$keys[8] => $this->getIsTopConcept(),
			$keys[9] => $this->getPrefLabelId(),
			$keys[10] => $this->getPrefLabel(),
			$keys[11] => $this->getStatusId(),
			$keys[12] => $this->getLanguage(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setLastUpdated($value);
				break;
			case 4:
				$this->setLastUpdatedByUserId($value);
				break;
			case 5:
				$this->setDeletedAt($value);
				break;
			case 6:
				$this->setUri($value);
				break;
			case 7:
				$this->setVocabularyId($value);
				break;
			case 8:
				$this->setIsTopConcept($value);
				break;
			case 9:
				$this->setPrefLabelId($value);
				break;
			case 10:
				$this->setPrefLabel($value);
				break;
			case 11:
				$this->setStatusId($value);
				break;
			case 12:
				$this->setLanguage($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastUpdated($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastUpdatedByUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeletedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUri($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setVocabularyId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsTopConcept($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPrefLabelId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPrefLabel($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStatusId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLanguage($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPeer::ID)) $criteria->add(ConceptPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPeer::CREATED_AT)) $criteria->add(ConceptPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPeer::UPDATED_AT)) $criteria->add(ConceptPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ConceptPeer::LAST_UPDATED)) $criteria->add(ConceptPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(ConceptPeer::LAST_UPDATED_BY_USER_ID)) $criteria->add(ConceptPeer::LAST_UPDATED_BY_USER_ID, $this->last_updated_by_user_id);
		if ($this->isColumnModified(ConceptPeer::DELETED_AT)) $criteria->add(ConceptPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(ConceptPeer::URI)) $criteria->add(ConceptPeer::URI, $this->uri);
		if ($this->isColumnModified(ConceptPeer::VOCABULARY_ID)) $criteria->add(ConceptPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(ConceptPeer::IS_TOP_CONCEPT)) $criteria->add(ConceptPeer::IS_TOP_CONCEPT, $this->is_top_concept);
		if ($this->isColumnModified(ConceptPeer::PREF_LABEL_ID)) $criteria->add(ConceptPeer::PREF_LABEL_ID, $this->pref_label_id);
		if ($this->isColumnModified(ConceptPeer::PREF_LABEL)) $criteria->add(ConceptPeer::PREF_LABEL, $this->pref_label);
		if ($this->isColumnModified(ConceptPeer::STATUS_ID)) $criteria->add(ConceptPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ConceptPeer::LANGUAGE)) $criteria->add(ConceptPeer::LANGUAGE, $this->language);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		$criteria->add(ConceptPeer::ID, $this->id);

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

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setLastUpdatedByUserId($this->last_updated_by_user_id);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setUri($this->uri);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setIsTopConcept($this->is_top_concept);

		$copyObj->setPrefLabelId($this->pref_label_id);

		$copyObj->setPrefLabel($this->pref_label);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLanguage($this->language);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConceptPropertysRelatedByConceptId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByConceptId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByRelatedConceptId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByRelatedConceptId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByConceptId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByConceptId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByRelatedConceptId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByRelatedConceptId($relObj->copy($deepCopy));
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
			self::$peer = new ConceptPeer();
		}
		return self::$peer;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setLastUpdatedByUserId(NULL);
		} else {
			$this->setLastUpdatedByUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->last_updated_by_user_id !== null)) {

			$this->aUser = UserPeer::retrieveByPK($this->last_updated_by_user_id, $con);

			
		}
		return $this->aUser;
	}

	
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setVocabularyId(NULL);
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	
	public function getVocabulary($con = null)
	{
				include_once 'lib/model/om/BaseVocabularyPeer.php';

		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			
		}
		return $this->aVocabulary;
	}

	
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setPrefLabelId(NULL);
		} else {
			$this->setPrefLabelId($v->getId());
		}


		$this->aConceptProperty = $v;
	}


	
	public function getConceptProperty($con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';

		if ($this->aConceptProperty === null && ($this->pref_label_id !== null)) {

			$this->aConceptProperty = ConceptPropertyPeer::retrieveByPK($this->pref_label_id, $con);

			
		}
		return $this->aConceptProperty;
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

	
	public function initConceptPropertysRelatedByConceptId()
	{
		if ($this->collConceptPropertysRelatedByConceptId === null) {
			$this->collConceptPropertysRelatedByConceptId = array();
		}
	}

	
	public function getConceptPropertysRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByConceptId;
	}

	
	public function countConceptPropertysRelatedByConceptId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyRelatedByConceptId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByConceptId[] = $l;
		$l->setConceptRelatedByConceptId($this);
	}


	
	public function getConceptPropertysRelatedByConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	
	public function getConceptPropertysRelatedByConceptIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	
	public function getConceptPropertysRelatedByConceptIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	
	public function getConceptPropertysRelatedByConceptIdJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	
	public function getConceptPropertysRelatedByConceptIdJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}

	
	public function initConceptPropertysRelatedByRelatedConceptId()
	{
		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			$this->collConceptPropertysRelatedByRelatedConceptId = array();
		}
	}

	
	public function getConceptPropertysRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}

	
	public function countConceptPropertysRelatedByRelatedConceptId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyRelatedByRelatedConceptId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByRelatedConceptId[] = $l;
		$l->setConceptRelatedByRelatedConceptId($this);
	}


	
	public function getConceptPropertysRelatedByRelatedConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertysRelatedByRelatedConceptIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertysRelatedByRelatedConceptIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertysRelatedByRelatedConceptIdJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertysRelatedByRelatedConceptIdJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}

	
	public function initConceptPropertyHistorysRelatedByConceptId()
	{
		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			$this->collConceptPropertyHistorysRelatedByConceptId = array();
		}
	}

	
	public function getConceptPropertyHistorysRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}

	
	public function countConceptPropertyHistorysRelatedByConceptId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistoryRelatedByConceptId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByConceptId[] = $l;
		$l->setConceptRelatedByConceptId($this);
	}


	
	public function getConceptPropertyHistorysRelatedByConceptIdJoinConceptProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByConceptIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByConceptIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByConceptIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByConceptId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByConceptId;
	}

	
	public function initConceptPropertyHistorysRelatedByRelatedConceptId()
	{
		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
		}
	}

	
	public function getConceptPropertyHistorysRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}

	
	public function countConceptPropertyHistorysRelatedByRelatedConceptId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistoryRelatedByRelatedConceptId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByRelatedConceptId[] = $l;
		$l->setConceptRelatedByRelatedConceptId($this);
	}


	
	public function getConceptPropertyHistorysRelatedByRelatedConceptIdJoinConceptProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByRelatedConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByRelatedConceptIdJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByRelatedConceptIdJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}


	
	public function getConceptPropertyHistorysRelatedByRelatedConceptIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByRelatedConceptId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByRelatedConceptId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConcept:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConcept::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
