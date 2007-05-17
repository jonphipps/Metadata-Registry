<?php


abstract class BaseAgentHasUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id = 0;


	
	protected $agent_id = 0;


	
	protected $is_registrar_for = true;


	
	protected $is_admin_for = true;

	
	protected $aUser;

	
	protected $aAgent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getAgentId()
	{

		return $this->agent_id;
	}

	
	public function getIsRegistrarFor()
	{

		return $this->is_registrar_for;
	}

	
	public function getIsAdminFor()
	{

		return $this->is_admin_for;
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v || $v === 0) {
			$this->user_id = $v;
			$this->modifiedColumns[] = AgentHasUserPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setAgentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->agent_id !== $v || $v === 0) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = AgentHasUserPeer::AGENT_ID;
		}

		if ($this->aAgent !== null && $this->aAgent->getId() !== $v) {
			$this->aAgent = null;
		}

	} 
	
	public function setIsRegistrarFor($v)
	{

		if ($this->is_registrar_for !== $v || $v === true) {
			$this->is_registrar_for = $v;
			$this->modifiedColumns[] = AgentHasUserPeer::IS_REGISTRAR_FOR;
		}

	} 
	
	public function setIsAdminFor($v)
	{

		if ($this->is_admin_for !== $v || $v === true) {
			$this->is_admin_for = $v;
			$this->modifiedColumns[] = AgentHasUserPeer::IS_ADMIN_FOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->agent_id = $rs->getInt($startcol + 1);

			$this->is_registrar_for = $rs->getBoolean($startcol + 2);

			$this->is_admin_for = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 4; 

		} catch (Exception $e) {
			throw new PropelException("Error populating AgentHasUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AgentHasUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AgentHasUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AgentHasUserPeer::DATABASE_NAME);
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

			if ($this->aAgent !== null) {
				if ($this->aAgent->isModified()) {
					$affectedRows += $this->aAgent->save($con);
				}
				$this->setAgent($this->aAgent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AgentHasUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AgentHasUserPeer::doUpdate($this, $con);
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

			if ($this->aAgent !== null) {
				if (!$this->aAgent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgent->getValidationFailures());
				}
			}


			if (($retval = AgentHasUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentHasUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getAgentId();
				break;
			case 2:
				return $this->getIsRegistrarFor();
				break;
			case 3:
				return $this->getIsAdminFor();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentHasUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getAgentId(),
			$keys[2] => $this->getIsRegistrarFor(),
			$keys[3] => $this->getIsAdminFor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentHasUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setAgentId($value);
				break;
			case 2:
				$this->setIsRegistrarFor($value);
				break;
			case 3:
				$this->setIsAdminFor($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentHasUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAgentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsRegistrarFor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsAdminFor($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentHasUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentHasUserPeer::USER_ID)) $criteria->add(AgentHasUserPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(AgentHasUserPeer::AGENT_ID)) $criteria->add(AgentHasUserPeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(AgentHasUserPeer::IS_REGISTRAR_FOR)) $criteria->add(AgentHasUserPeer::IS_REGISTRAR_FOR, $this->is_registrar_for);
		if ($this->isColumnModified(AgentHasUserPeer::IS_ADMIN_FOR)) $criteria->add(AgentHasUserPeer::IS_ADMIN_FOR, $this->is_admin_for);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AgentHasUserPeer::DATABASE_NAME);

		$criteria->add(AgentHasUserPeer::USER_ID, $this->user_id);
		$criteria->add(AgentHasUserPeer::AGENT_ID, $this->agent_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getAgentId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setAgentId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIsRegistrarFor($this->is_registrar_for);

		$copyObj->setIsAdminFor($this->is_admin_for);


		$copyObj->setNew(true);

		$copyObj->setUserId('null'); 
		$copyObj->setAgentId('0'); 
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
			self::$peer = new AgentHasUserPeer();
		}
		return self::$peer;
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

	
	public function setAgent($v)
	{


		if ($v === null) {
			$this->setAgentId('0');
		} else {
			$this->setAgentId($v->getId());
		}


		$this->aAgent = $v;
	}


	
	public function getAgent($con = null)
	{
				include_once 'lib/model/om/BaseAgentPeer.php';

		if ($this->aAgent === null && ($this->agent_id !== null)) {

			$this->aAgent = AgentPeer::retrieveByPK($this->agent_id, $con);

			
		}
		return $this->aAgent;
	}

} 
