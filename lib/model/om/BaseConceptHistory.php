<?php


abstract class BaseConceptHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sid = 'null';


	
	protected $concept_property_id = 0;


	
	protected $user_id = 0;


	
	protected $changed_at;


	
	protected $old_values;


	
	protected $new_values;

	
	protected $aConceptProperty;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSid()
	{

		return $this->sid;
	}

	
	public function getConceptPropertyId()
	{

		return $this->concept_property_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getChangedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->changed_at === null || $this->changed_at === '') {
			return null;
		} elseif (!is_int($this->changed_at)) {
						$ts = strtotime($this->changed_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [changed_at] as date/time value: " . var_export($this->changed_at, true));
			}
		} else {
			$ts = $this->changed_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getOldValues()
	{

		return $this->old_values;
	}

	
	public function getNewValues()
	{

		return $this->new_values;
	}

	
	public function setSid($v)
	{

		if ($this->sid !== $v || $v === 'null') {
			$this->sid = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::SID;
		}

	} 
	
	public function setConceptPropertyId($v)
	{

		if ($this->concept_property_id !== $v || $v === 0) {
			$this->concept_property_id = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::CONCEPT_PROPERTY_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}

	} 
	
	public function setUserId($v)
	{

		if ($this->user_id !== $v || $v === 0) {
			$this->user_id = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setChangedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [changed_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->changed_at !== $ts) {
			$this->changed_at = $ts;
			$this->modifiedColumns[] = ConceptHistoryPeer::CHANGED_AT;
		}

	} 
	
	public function setOldValues($v)
	{

		if ($this->old_values !== $v) {
			$this->old_values = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::OLD_VALUES;
		}

	} 
	
	public function setNewValues($v)
	{

		if ($this->new_values !== $v) {
			$this->new_values = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::NEW_VALUES;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sid = $rs->getString($startcol + 0);

			$this->concept_property_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->changed_at = $rs->getTimestamp($startcol + 3, null);

			$this->old_values = $rs->getString($startcol + 4);

			$this->new_values = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
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


												
			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ConceptHistoryPeer::doUpdate($this, $con);
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = ConceptHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSid();
				break;
			case 1:
				return $this->getConceptPropertyId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getChangedAt();
				break;
			case 4:
				return $this->getOldValues();
				break;
			case 5:
				return $this->getNewValues();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSid(),
			$keys[1] => $this->getConceptPropertyId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getChangedAt(),
			$keys[4] => $this->getOldValues(),
			$keys[5] => $this->getNewValues(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSid($value);
				break;
			case 1:
				$this->setConceptPropertyId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setChangedAt($value);
				break;
			case 4:
				$this->setOldValues($value);
				break;
			case 5:
				$this->setNewValues($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConceptPropertyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setChangedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOldValues($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNewValues($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptHistoryPeer::SID)) $criteria->add(ConceptHistoryPeer::SID, $this->sid);
		if ($this->isColumnModified(ConceptHistoryPeer::CONCEPT_PROPERTY_ID)) $criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);
		if ($this->isColumnModified(ConceptHistoryPeer::USER_ID)) $criteria->add(ConceptHistoryPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(ConceptHistoryPeer::CHANGED_AT)) $criteria->add(ConceptHistoryPeer::CHANGED_AT, $this->changed_at);
		if ($this->isColumnModified(ConceptHistoryPeer::OLD_VALUES)) $criteria->add(ConceptHistoryPeer::OLD_VALUES, $this->old_values);
		if ($this->isColumnModified(ConceptHistoryPeer::NEW_VALUES)) $criteria->add(ConceptHistoryPeer::NEW_VALUES, $this->new_values);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptHistoryPeer::DATABASE_NAME);

		$criteria->add(ConceptHistoryPeer::SID, $this->sid);
		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getSid();

		$pks[1] = $this->getConceptPropertyId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setSid($keys[0]);

		$this->setConceptPropertyId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setChangedAt($this->changed_at);

		$copyObj->setOldValues($this->old_values);

		$copyObj->setNewValues($this->new_values);


		$copyObj->setNew(true);

		$copyObj->setSid('null'); 
		$copyObj->setConceptPropertyId('null'); 
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
			self::$peer = new ConceptHistoryPeer();
		}
		return self::$peer;
	}

	
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setConceptPropertyId('null');
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

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId('null');
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->user_id !== null)) {

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUser;
	}

} 