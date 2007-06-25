<?php


abstract class BaseAgent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $last_updated;


	
	protected $deleted_at;


	
	protected $org_email = '';


	
	protected $org_name = '';


	
	protected $ind_affiliation;


	
	protected $ind_role;


	
	protected $address1;


	
	protected $address2;


	
	protected $city;


	
	protected $state;


	
	protected $postal_code;


	
	protected $country;


	
	protected $phone;


	
	protected $web_address;


	
	protected $type;

	
	protected $collAgentHasUsers;

	
	protected $lastAgentHasUserCriteria = null;

	
	protected $collVocabularys;

	
	protected $lastVocabularyCriteria = null;

	
	protected $collResources;

	
	protected $lastResourceCriteria = null;

	
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

	
	public function getOrgEmail()
	{

		return $this->org_email;
	}

	
	public function getOrgName()
	{

		return $this->org_name;
	}

	
	public function getIndAffiliation()
	{

		return $this->ind_affiliation;
	}

	
	public function getIndRole()
	{

		return $this->ind_role;
	}

	
	public function getAddress1()
	{

		return $this->address1;
	}

	
	public function getAddress2()
	{

		return $this->address2;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getState()
	{

		return $this->state;
	}

	
	public function getPostalCode()
	{

		return $this->postal_code;
	}

	
	public function getCountry()
	{

		return $this->country;
	}

	
	public function getPhone()
	{

		return $this->phone;
	}

	
	public function getWebAddress()
	{

		return $this->web_address;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AgentPeer::ID;
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
			$this->modifiedColumns[] = AgentPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AgentPeer::LAST_UPDATED;
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
			$this->modifiedColumns[] = AgentPeer::DELETED_AT;
		}

	} 
	
	public function setOrgEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->org_email !== $v || $v === '') {
			$this->org_email = $v;
			$this->modifiedColumns[] = AgentPeer::ORG_EMAIL;
		}

	} 
	
	public function setOrgName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->org_name !== $v || $v === '') {
			$this->org_name = $v;
			$this->modifiedColumns[] = AgentPeer::ORG_NAME;
		}

	} 
	
	public function setIndAffiliation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ind_affiliation !== $v) {
			$this->ind_affiliation = $v;
			$this->modifiedColumns[] = AgentPeer::IND_AFFILIATION;
		}

	} 
	
	public function setIndRole($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ind_role !== $v) {
			$this->ind_role = $v;
			$this->modifiedColumns[] = AgentPeer::IND_ROLE;
		}

	} 
	
	public function setAddress1($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address1 !== $v) {
			$this->address1 = $v;
			$this->modifiedColumns[] = AgentPeer::ADDRESS1;
		}

	} 
	
	public function setAddress2($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address2 !== $v) {
			$this->address2 = $v;
			$this->modifiedColumns[] = AgentPeer::ADDRESS2;
		}

	} 
	
	public function setCity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = AgentPeer::CITY;
		}

	} 
	
	public function setState($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = AgentPeer::STATE;
		}

	} 
	
	public function setPostalCode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->postal_code !== $v) {
			$this->postal_code = $v;
			$this->modifiedColumns[] = AgentPeer::POSTAL_CODE;
		}

	} 
	
	public function setCountry($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = AgentPeer::COUNTRY;
		}

	} 
	
	public function setPhone($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = AgentPeer::PHONE;
		}

	} 
	
	public function setWebAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->web_address !== $v) {
			$this->web_address = $v;
			$this->modifiedColumns[] = AgentPeer::WEB_ADDRESS;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = AgentPeer::TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->org_email = $rs->getString($startcol + 4);

			$this->org_name = $rs->getString($startcol + 5);

			$this->ind_affiliation = $rs->getString($startcol + 6);

			$this->ind_role = $rs->getString($startcol + 7);

			$this->address1 = $rs->getString($startcol + 8);

			$this->address2 = $rs->getString($startcol + 9);

			$this->city = $rs->getString($startcol + 10);

			$this->state = $rs->getString($startcol + 11);

			$this->postal_code = $rs->getString($startcol + 12);

			$this->country = $rs->getString($startcol + 13);

			$this->phone = $rs->getString($startcol + 14);

			$this->web_address = $rs->getString($startcol + 15);

			$this->type = $rs->getString($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 17; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Agent object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAgent:delete:pre') as $callable)
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AgentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAgent:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAgent:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AgentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAgent:save:post') as $callable)
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
					$pk = AgentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AgentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAgentHasUsers !== null) {
				foreach($this->collAgentHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularys !== null) {
				foreach($this->collVocabularys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collResources !== null) {
				foreach($this->collResources as $referrerFK) {
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


			if (($retval = AgentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAgentHasUsers !== null) {
					foreach($this->collAgentHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularys !== null) {
					foreach($this->collVocabularys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collResources !== null) {
					foreach($this->collResources as $referrerFK) {
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
		$pos = AgentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOrgEmail();
				break;
			case 5:
				return $this->getOrgName();
				break;
			case 6:
				return $this->getIndAffiliation();
				break;
			case 7:
				return $this->getIndRole();
				break;
			case 8:
				return $this->getAddress1();
				break;
			case 9:
				return $this->getAddress2();
				break;
			case 10:
				return $this->getCity();
				break;
			case 11:
				return $this->getState();
				break;
			case 12:
				return $this->getPostalCode();
				break;
			case 13:
				return $this->getCountry();
				break;
			case 14:
				return $this->getPhone();
				break;
			case 15:
				return $this->getWebAddress();
				break;
			case 16:
				return $this->getType();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getOrgEmail(),
			$keys[5] => $this->getOrgName(),
			$keys[6] => $this->getIndAffiliation(),
			$keys[7] => $this->getIndRole(),
			$keys[8] => $this->getAddress1(),
			$keys[9] => $this->getAddress2(),
			$keys[10] => $this->getCity(),
			$keys[11] => $this->getState(),
			$keys[12] => $this->getPostalCode(),
			$keys[13] => $this->getCountry(),
			$keys[14] => $this->getPhone(),
			$keys[15] => $this->getWebAddress(),
			$keys[16] => $this->getType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOrgEmail($value);
				break;
			case 5:
				$this->setOrgName($value);
				break;
			case 6:
				$this->setIndAffiliation($value);
				break;
			case 7:
				$this->setIndRole($value);
				break;
			case 8:
				$this->setAddress1($value);
				break;
			case 9:
				$this->setAddress2($value);
				break;
			case 10:
				$this->setCity($value);
				break;
			case 11:
				$this->setState($value);
				break;
			case 12:
				$this->setPostalCode($value);
				break;
			case 13:
				$this->setCountry($value);
				break;
			case 14:
				$this->setPhone($value);
				break;
			case 15:
				$this->setWebAddress($value);
				break;
			case 16:
				$this->setType($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOrgEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrgName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIndAffiliation($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIndRole($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAddress1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAddress2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCity($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setState($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPostalCode($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCountry($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPhone($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setWebAddress($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setType($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentPeer::ID)) $criteria->add(AgentPeer::ID, $this->id);
		if ($this->isColumnModified(AgentPeer::CREATED_AT)) $criteria->add(AgentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AgentPeer::LAST_UPDATED)) $criteria->add(AgentPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(AgentPeer::DELETED_AT)) $criteria->add(AgentPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(AgentPeer::ORG_EMAIL)) $criteria->add(AgentPeer::ORG_EMAIL, $this->org_email);
		if ($this->isColumnModified(AgentPeer::ORG_NAME)) $criteria->add(AgentPeer::ORG_NAME, $this->org_name);
		if ($this->isColumnModified(AgentPeer::IND_AFFILIATION)) $criteria->add(AgentPeer::IND_AFFILIATION, $this->ind_affiliation);
		if ($this->isColumnModified(AgentPeer::IND_ROLE)) $criteria->add(AgentPeer::IND_ROLE, $this->ind_role);
		if ($this->isColumnModified(AgentPeer::ADDRESS1)) $criteria->add(AgentPeer::ADDRESS1, $this->address1);
		if ($this->isColumnModified(AgentPeer::ADDRESS2)) $criteria->add(AgentPeer::ADDRESS2, $this->address2);
		if ($this->isColumnModified(AgentPeer::CITY)) $criteria->add(AgentPeer::CITY, $this->city);
		if ($this->isColumnModified(AgentPeer::STATE)) $criteria->add(AgentPeer::STATE, $this->state);
		if ($this->isColumnModified(AgentPeer::POSTAL_CODE)) $criteria->add(AgentPeer::POSTAL_CODE, $this->postal_code);
		if ($this->isColumnModified(AgentPeer::COUNTRY)) $criteria->add(AgentPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(AgentPeer::PHONE)) $criteria->add(AgentPeer::PHONE, $this->phone);
		if ($this->isColumnModified(AgentPeer::WEB_ADDRESS)) $criteria->add(AgentPeer::WEB_ADDRESS, $this->web_address);
		if ($this->isColumnModified(AgentPeer::TYPE)) $criteria->add(AgentPeer::TYPE, $this->type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		$criteria->add(AgentPeer::ID, $this->id);

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

		$copyObj->setOrgEmail($this->org_email);

		$copyObj->setOrgName($this->org_name);

		$copyObj->setIndAffiliation($this->ind_affiliation);

		$copyObj->setIndRole($this->ind_role);

		$copyObj->setAddress1($this->address1);

		$copyObj->setAddress2($this->address2);

		$copyObj->setCity($this->city);

		$copyObj->setState($this->state);

		$copyObj->setPostalCode($this->postal_code);

		$copyObj->setCountry($this->country);

		$copyObj->setPhone($this->phone);

		$copyObj->setWebAddress($this->web_address);

		$copyObj->setType($this->type);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAgentHasUsers() as $relObj) {
				$copyObj->addAgentHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularys() as $relObj) {
				$copyObj->addVocabulary($relObj->copy($deepCopy));
			}

			foreach($this->getResources() as $relObj) {
				$copyObj->addResource($relObj->copy($deepCopy));
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
			self::$peer = new AgentPeer();
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

				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

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

		$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

		return AgentHasUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAgentHasUser(AgentHasUser $l)
	{
		$this->collAgentHasUsers[] = $l;
		$l->setAgent($this);
	}


	
	public function getAgentHasUsersJoinUser($criteria = null, $con = null)
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

				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;

		return $this->collAgentHasUsers;
	}

	
	public function initVocabularys()
	{
		if ($this->collVocabularys === null) {
			$this->collVocabularys = array();
		}
	}

	
	public function getVocabularys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
			   $this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
					$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyCriteria = $criteria;
		return $this->collVocabularys;
	}

	
	public function countVocabularys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVocabulary(Vocabulary $l)
	{
		$this->collVocabularys[] = $l;
		$l->setAgent($this);
	}


	
	public function getVocabularysJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
				$this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}

	
	public function initResources()
	{
		if ($this->collResources === null) {
			$this->collResources = array();
		}
	}

	
	public function getResources($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseResourcePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collResources === null) {
			if ($this->isNew()) {
			   $this->collResources = array();
			} else {

				$criteria->add(ResourcePeer::AGENT_ID, $this->getId());

				ResourcePeer::addSelectColumns($criteria);
				$this->collResources = ResourcePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ResourcePeer::AGENT_ID, $this->getId());

				ResourcePeer::addSelectColumns($criteria);
				if (!isset($this->lastResourceCriteria) || !$this->lastResourceCriteria->equals($criteria)) {
					$this->collResources = ResourcePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastResourceCriteria = $criteria;
		return $this->collResources;
	}

	
	public function countResources($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseResourcePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ResourcePeer::AGENT_ID, $this->getId());

		return ResourcePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addResource(Resource $l)
	{
		$this->collResources[] = $l;
		$l->setAgent($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAgent:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAgent::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
