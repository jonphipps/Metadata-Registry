<?php


abstract class BaseAgentHasUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $deleted_at;


	
	protected $user_id = 0;


	
	protected $agent_id = 0;


	
	protected $is_registrar_for = true;


	
	protected $is_admin_for = true;

	
	protected $aUser;

	
	protected $aAgent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
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
			$this->modifiedColumns[] = AgentHasUserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AgentHasUserPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = AgentHasUserPeer::DELETED_AT;
		}

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

			$this->created_at = $rs->getTimestamp($startcol + 0, null);

			$this->updated_at = $rs->getTimestamp($startcol + 1, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 2, null);

			$this->user_id = $rs->getInt($startcol + 3);

			$this->agent_id = $rs->getInt($startcol + 4);

			$this->is_registrar_for = $rs->getBoolean($startcol + 5);

			$this->is_admin_for = $rs->getBoolean($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 7; 

		} catch (Exception $e) {
			throw new PropelException("Error populating AgentHasUser object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentHasUser:delete:pre') as $callable)
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
	

    foreach (sfMixer::getCallables('BaseAgentHasUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentHasUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AgentHasUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AgentHasUserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

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
    foreach (sfMixer::getCallables('BaseAgentHasUser:save:post') as $callable)
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
				return $this->getCreatedAt();
				break;
			case 1:
				return $this->getUpdatedAt();
				break;
			case 2:
				return $this->getDeletedAt();
				break;
			case 3:
				return $this->getUserId();
				break;
			case 4:
				return $this->getAgentId();
				break;
			case 5:
				return $this->getIsRegistrarFor();
				break;
			case 6:
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
			$keys[0] => $this->getCreatedAt(),
			$keys[1] => $this->getUpdatedAt(),
			$keys[2] => $this->getDeletedAt(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getAgentId(),
			$keys[5] => $this->getIsRegistrarFor(),
			$keys[6] => $this->getIsAdminFor(),
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
				$this->setCreatedAt($value);
				break;
			case 1:
				$this->setUpdatedAt($value);
				break;
			case 2:
				$this->setDeletedAt($value);
				break;
			case 3:
				$this->setUserId($value);
				break;
			case 4:
				$this->setAgentId($value);
				break;
			case 5:
				$this->setIsRegistrarFor($value);
				break;
			case 6:
				$this->setIsAdminFor($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentHasUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCreatedAt($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUpdatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDeletedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAgentId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsRegistrarFor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsAdminFor($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentHasUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentHasUserPeer::CREATED_AT)) $criteria->add(AgentHasUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AgentHasUserPeer::UPDATED_AT)) $criteria->add(AgentHasUserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(AgentHasUserPeer::DELETED_AT)) $criteria->add(AgentHasUserPeer::DELETED_AT, $this->deleted_at);
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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAgentHasUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAgentHasUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
