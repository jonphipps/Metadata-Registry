<?php


abstract class BaseResource extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type;


	
	protected $agent_id;


	
	protected $created_at;


	
	protected $update_at;


	
	protected $name;


	
	protected $note;


	
	protected $uri;


	
	protected $url;


	
	protected $base_domain;


	
	protected $token;


	
	protected $community;


	
	protected $last_uri_id = 1000;

	
	protected $aAgent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getAgentId()
	{

		return $this->agent_id;
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

	
	public function getUpdateAt($format = 'Y-m-d H:i:s')
	{

		if ($this->update_at === null || $this->update_at === '') {
			return null;
		} elseif (!is_int($this->update_at)) {
			
			$ts = strtotime($this->update_at);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse value of [update_at] as date/time value: " . var_export($this->update_at, true));
			}
		} else {
			$ts = $this->update_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getUri()
	{

		return $this->uri;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getBaseDomain()
	{

		return $this->base_domain;
	}

	
	public function getToken()
	{

		return $this->token;
	}

	
	public function getCommunity()
	{

		return $this->community;
	}

	
	public function getLastUriId()
	{

		return $this->last_uri_id;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ResourcePeer::ID;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = ResourcePeer::TYPE;
		}

	} 
	
	public function setAgentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->agent_id !== $v) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = ResourcePeer::AGENT_ID;
		}

		if ($this->aAgent !== null && $this->aAgent->getId() !== $v) {
			$this->aAgent = null;
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
			$this->modifiedColumns[] = ResourcePeer::CREATED_AT;
		}

	} 
	
	public function setUpdateAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 
				throw new PropelException("Unable to parse date/time value for [update_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->update_at !== $ts) {
			$this->update_at = $ts;
			$this->modifiedColumns[] = ResourcePeer::UPDATE_AT;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ResourcePeer::NAME;
		}

	} 
	
	public function setNote($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = ResourcePeer::NOTE;
		}

	} 
	
	public function setUri($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri !== $v) {
			$this->uri = $v;
			$this->modifiedColumns[] = ResourcePeer::URI;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = ResourcePeer::URL;
		}

	} 
	
	public function setBaseDomain($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->base_domain !== $v) {
			$this->base_domain = $v;
			$this->modifiedColumns[] = ResourcePeer::BASE_DOMAIN;
		}

	} 
	
	public function setToken($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->token !== $v) {
			$this->token = $v;
			$this->modifiedColumns[] = ResourcePeer::TOKEN;
		}

	} 
	
	public function setCommunity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->community !== $v) {
			$this->community = $v;
			$this->modifiedColumns[] = ResourcePeer::COMMUNITY;
		}

	} 
	
	public function setLastUriId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_uri_id !== $v || $v === 1000) {
			$this->last_uri_id = $v;
			$this->modifiedColumns[] = ResourcePeer::LAST_URI_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type = $rs->getInt($startcol + 1);

			$this->agent_id = $rs->getInt($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->update_at = $rs->getTimestamp($startcol + 4, null);

			$this->name = $rs->getString($startcol + 5);

			$this->note = $rs->getString($startcol + 6);

			$this->uri = $rs->getString($startcol + 7);

			$this->url = $rs->getString($startcol + 8);

			$this->base_domain = $rs->getString($startcol + 9);

			$this->token = $rs->getString($startcol + 10);

			$this->community = $rs->getString($startcol + 11);

			$this->last_uri_id = $rs->getInt($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 13; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Resource object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseResource:delete:pre') as $callable)
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
			$con = Propel::getConnection(ResourcePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ResourcePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseResource:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseResource:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ResourcePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ResourcePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseResource:save:post') as $callable)
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


												
			if ($this->aAgent !== null) {
				if ($this->aAgent->isModified()) {
					$affectedRows += $this->aAgent->save($con);
				}
				$this->setAgent($this->aAgent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ResourcePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ResourcePeer::doUpdate($this, $con);
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


												
			if ($this->aAgent !== null) {
				if (!$this->aAgent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgent->getValidationFailures());
				}
			}


			if (($retval = ResourcePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ResourcePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getType();
				break;
			case 2:
				return $this->getAgentId();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdateAt();
				break;
			case 5:
				return $this->getName();
				break;
			case 6:
				return $this->getNote();
				break;
			case 7:
				return $this->getUri();
				break;
			case 8:
				return $this->getUrl();
				break;
			case 9:
				return $this->getBaseDomain();
				break;
			case 10:
				return $this->getToken();
				break;
			case 11:
				return $this->getCommunity();
				break;
			case 12:
				return $this->getLastUriId();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ResourcePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getType(),
			$keys[2] => $this->getAgentId(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdateAt(),
			$keys[5] => $this->getName(),
			$keys[6] => $this->getNote(),
			$keys[7] => $this->getUri(),
			$keys[8] => $this->getUrl(),
			$keys[9] => $this->getBaseDomain(),
			$keys[10] => $this->getToken(),
			$keys[11] => $this->getCommunity(),
			$keys[12] => $this->getLastUriId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ResourcePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setType($value);
				break;
			case 2:
				$this->setAgentId($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdateAt($value);
				break;
			case 5:
				$this->setName($value);
				break;
			case 6:
				$this->setNote($value);
				break;
			case 7:
				$this->setUri($value);
				break;
			case 8:
				$this->setUrl($value);
				break;
			case 9:
				$this->setBaseDomain($value);
				break;
			case 10:
				$this->setToken($value);
				break;
			case 11:
				$this->setCommunity($value);
				break;
			case 12:
				$this->setLastUriId($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ResourcePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAgentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdateAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNote($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUri($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUrl($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBaseDomain($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setToken($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCommunity($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLastUriId($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ResourcePeer::DATABASE_NAME);

		if ($this->isColumnModified(ResourcePeer::ID)) $criteria->add(ResourcePeer::ID, $this->id);
		if ($this->isColumnModified(ResourcePeer::TYPE)) $criteria->add(ResourcePeer::TYPE, $this->type);
		if ($this->isColumnModified(ResourcePeer::AGENT_ID)) $criteria->add(ResourcePeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(ResourcePeer::CREATED_AT)) $criteria->add(ResourcePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ResourcePeer::UPDATE_AT)) $criteria->add(ResourcePeer::UPDATE_AT, $this->update_at);
		if ($this->isColumnModified(ResourcePeer::NAME)) $criteria->add(ResourcePeer::NAME, $this->name);
		if ($this->isColumnModified(ResourcePeer::NOTE)) $criteria->add(ResourcePeer::NOTE, $this->note);
		if ($this->isColumnModified(ResourcePeer::URI)) $criteria->add(ResourcePeer::URI, $this->uri);
		if ($this->isColumnModified(ResourcePeer::URL)) $criteria->add(ResourcePeer::URL, $this->url);
		if ($this->isColumnModified(ResourcePeer::BASE_DOMAIN)) $criteria->add(ResourcePeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(ResourcePeer::TOKEN)) $criteria->add(ResourcePeer::TOKEN, $this->token);
		if ($this->isColumnModified(ResourcePeer::COMMUNITY)) $criteria->add(ResourcePeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(ResourcePeer::LAST_URI_ID)) $criteria->add(ResourcePeer::LAST_URI_ID, $this->last_uri_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ResourcePeer::DATABASE_NAME);

		$criteria->add(ResourcePeer::ID, $this->id);

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

		$copyObj->setType($this->type);

		$copyObj->setAgentId($this->agent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdateAt($this->update_at);

		$copyObj->setName($this->name);

		$copyObj->setNote($this->note);

		$copyObj->setUri($this->uri);

		$copyObj->setUrl($this->url);

		$copyObj->setBaseDomain($this->base_domain);

		$copyObj->setToken($this->token);

		$copyObj->setCommunity($this->community);

		$copyObj->setLastUriId($this->last_uri_id);


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
			self::$peer = new ResourcePeer();
		}
		return self::$peer;
	}

	
	public function setAgent($v)
	{


		if ($v === null) {
			$this->setAgentId(NULL);
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
    if (!$callable = sfMixer::getCallable('BaseResource:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseResource::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
