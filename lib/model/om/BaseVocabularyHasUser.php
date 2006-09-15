<?php


abstract class BaseVocabularyHasUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $vocabulary_id = 0;


	
	protected $user_id = 0;


	
	protected $is_maintainer_for;


	
	protected $is_registrar_for;

	
	protected $aUser;

	
	protected $aVocabulary;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getIsMaintainerFor()
	{

		return $this->is_maintainer_for;
	}

	
	public function getIsRegistrarFor()
	{

		return $this->is_registrar_for;
	}

	
	public function setVocabularyId($v)
	{

		if ($this->vocabulary_id !== $v || $v === 0) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = VocabularyHasUserPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} 
	
	public function setUserId($v)
	{

		if ($this->user_id !== $v || $v === 0) {
			$this->user_id = $v;
			$this->modifiedColumns[] = VocabularyHasUserPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setIsMaintainerFor($v)
	{

		if ($this->is_maintainer_for !== $v) {
			$this->is_maintainer_for = $v;
			$this->modifiedColumns[] = VocabularyHasUserPeer::IS_MAINTAINER_FOR;
		}

	} 
	
	public function setIsRegistrarFor($v)
	{

		if ($this->is_registrar_for !== $v) {
			$this->is_registrar_for = $v;
			$this->modifiedColumns[] = VocabularyHasUserPeer::IS_REGISTRAR_FOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->vocabulary_id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->is_maintainer_for = $rs->getBoolean($startcol + 2);

			$this->is_registrar_for = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating VocabularyHasUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VocabularyHasUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VocabularyHasUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(VocabularyHasUserPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VocabularyHasUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += VocabularyHasUserPeer::doUpdate($this, $con);
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


			if (($retval = VocabularyHasUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VocabularyHasUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getVocabularyId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getIsMaintainerFor();
				break;
			case 3:
				return $this->getIsRegistrarFor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VocabularyHasUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getVocabularyId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getIsMaintainerFor(),
			$keys[3] => $this->getIsRegistrarFor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VocabularyHasUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setVocabularyId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setIsMaintainerFor($value);
				break;
			case 3:
				$this->setIsRegistrarFor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VocabularyHasUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVocabularyId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsMaintainerFor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsRegistrarFor($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VocabularyHasUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(VocabularyHasUserPeer::VOCABULARY_ID)) $criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(VocabularyHasUserPeer::USER_ID)) $criteria->add(VocabularyHasUserPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(VocabularyHasUserPeer::IS_MAINTAINER_FOR)) $criteria->add(VocabularyHasUserPeer::IS_MAINTAINER_FOR, $this->is_maintainer_for);
		if ($this->isColumnModified(VocabularyHasUserPeer::IS_REGISTRAR_FOR)) $criteria->add(VocabularyHasUserPeer::IS_REGISTRAR_FOR, $this->is_registrar_for);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VocabularyHasUserPeer::DATABASE_NAME);

		$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->vocabulary_id);
		$criteria->add(VocabularyHasUserPeer::USER_ID, $this->user_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getVocabularyId();

		$pks[1] = $this->getUserId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setVocabularyId($keys[0]);

		$this->setUserId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIsMaintainerFor($this->is_maintainer_for);

		$copyObj->setIsRegistrarFor($this->is_registrar_for);


		$copyObj->setNew(true);

		$copyObj->setVocabularyId(''); 
		$copyObj->setUserId(''); 
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
			self::$peer = new VocabularyHasUserPeer();
		}
		return self::$peer;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId('');
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
				include_once 'model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->user_id !== null)) {

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUser;
	}

	
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setVocabularyId('');
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	
	public function getVocabulary($con = null)
	{
				include_once 'model/om/BaseVocabularyPeer.php';

		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			
		}
		return $this->aVocabulary;
	}

} 