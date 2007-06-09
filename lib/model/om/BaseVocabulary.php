<?php


abstract class BaseVocabulary extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $agent_id;


	
	protected $created_at;


	
	protected $last_updated;


	
	protected $name;


	
	protected $note;


	
	protected $uri;


	
	protected $url;


	
	protected $base_domain;


	
	protected $token;


	
	protected $community;


	
	protected $last_uri_id = 1000;


	
	protected $language;


	
	protected $status_id = 1;

	
	protected $aAgent;

	
	protected $aStatus;

	
	protected $collConcepts;

	
	protected $lastConceptCriteria = null;

	
	protected $collConceptPropertys;

	
	protected $lastConceptPropertyCriteria = null;

	
	protected $collVocabularyHasUsers;

	
	protected $lastVocabularyHasUserCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = VocabularyPeer::ID;
		}

	} 
	
	public function setAgentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->agent_id !== $v) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::AGENT_ID;
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
			$this->modifiedColumns[] = VocabularyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = VocabularyPeer::LAST_UPDATED;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = VocabularyPeer::NAME;
		}

	} 
	
	public function setNote($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = VocabularyPeer::NOTE;
		}

	} 
	
	public function setUri($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri !== $v) {
			$this->uri = $v;
			$this->modifiedColumns[] = VocabularyPeer::URI;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = VocabularyPeer::URL;
		}

	} 
	
	public function setBaseDomain($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->base_domain !== $v) {
			$this->base_domain = $v;
			$this->modifiedColumns[] = VocabularyPeer::BASE_DOMAIN;
		}

	} 
	
	public function setToken($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->token !== $v) {
			$this->token = $v;
			$this->modifiedColumns[] = VocabularyPeer::TOKEN;
		}

	} 
	
	public function setCommunity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->community !== $v) {
			$this->community = $v;
			$this->modifiedColumns[] = VocabularyPeer::COMMUNITY;
		}

	} 
	
	public function setLastUriId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_uri_id !== $v || $v === 1000) {
			$this->last_uri_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::LAST_URI_ID;
		}

	} 
	
	public function setLanguage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = VocabularyPeer::LANGUAGE;
		}

	} 
	
	public function setStatusId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->agent_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->last_updated = $rs->getTimestamp($startcol + 3, null);

			$this->name = $rs->getString($startcol + 4);

			$this->note = $rs->getString($startcol + 5);

			$this->uri = $rs->getString($startcol + 6);

			$this->url = $rs->getString($startcol + 7);

			$this->base_domain = $rs->getString($startcol + 8);

			$this->token = $rs->getString($startcol + 9);

			$this->community = $rs->getString($startcol + 10);

			$this->last_uri_id = $rs->getInt($startcol + 11);

			$this->language = $rs->getString($startcol + 12);

			$this->status_id = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 14; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Vocabulary object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VocabularyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(VocabularyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
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


												
			if ($this->aAgent !== null) {
				if ($this->aAgent->isModified()) {
					$affectedRows += $this->aAgent->save($con);
				}
				$this->setAgent($this->aAgent);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VocabularyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += VocabularyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collConcepts !== null) {
				foreach($this->collConcepts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertys !== null) {
				foreach($this->collConceptPropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularyHasUsers !== null) {
				foreach($this->collVocabularyHasUsers as $referrerFK) {
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


												
			if ($this->aAgent !== null) {
				if (!$this->aAgent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgent->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = VocabularyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConcepts !== null) {
					foreach($this->collConcepts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertys !== null) {
					foreach($this->collConceptPropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularyHasUsers !== null) {
					foreach($this->collVocabularyHasUsers as $referrerFK) {
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
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAgentId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getLastUpdated();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getNote();
				break;
			case 6:
				return $this->getUri();
				break;
			case 7:
				return $this->getUrl();
				break;
			case 8:
				return $this->getBaseDomain();
				break;
			case 9:
				return $this->getToken();
				break;
			case 10:
				return $this->getCommunity();
				break;
			case 11:
				return $this->getLastUriId();
				break;
			case 12:
				return $this->getLanguage();
				break;
			case 13:
				return $this->getStatusId();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VocabularyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAgentId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getLastUpdated(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getNote(),
			$keys[6] => $this->getUri(),
			$keys[7] => $this->getUrl(),
			$keys[8] => $this->getBaseDomain(),
			$keys[9] => $this->getToken(),
			$keys[10] => $this->getCommunity(),
			$keys[11] => $this->getLastUriId(),
			$keys[12] => $this->getLanguage(),
			$keys[13] => $this->getStatusId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAgentId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setLastUpdated($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setNote($value);
				break;
			case 6:
				$this->setUri($value);
				break;
			case 7:
				$this->setUrl($value);
				break;
			case 8:
				$this->setBaseDomain($value);
				break;
			case 9:
				$this->setToken($value);
				break;
			case 10:
				$this->setCommunity($value);
				break;
			case 11:
				$this->setLastUriId($value);
				break;
			case 12:
				$this->setLanguage($value);
				break;
			case 13:
				$this->setStatusId($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VocabularyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAgentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastUpdated($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNote($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUri($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUrl($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBaseDomain($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setToken($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCommunity($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastUriId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLanguage($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setStatusId($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		if ($this->isColumnModified(VocabularyPeer::ID)) $criteria->add(VocabularyPeer::ID, $this->id);
		if ($this->isColumnModified(VocabularyPeer::AGENT_ID)) $criteria->add(VocabularyPeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(VocabularyPeer::CREATED_AT)) $criteria->add(VocabularyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(VocabularyPeer::LAST_UPDATED)) $criteria->add(VocabularyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(VocabularyPeer::NAME)) $criteria->add(VocabularyPeer::NAME, $this->name);
		if ($this->isColumnModified(VocabularyPeer::NOTE)) $criteria->add(VocabularyPeer::NOTE, $this->note);
		if ($this->isColumnModified(VocabularyPeer::URI)) $criteria->add(VocabularyPeer::URI, $this->uri);
		if ($this->isColumnModified(VocabularyPeer::URL)) $criteria->add(VocabularyPeer::URL, $this->url);
		if ($this->isColumnModified(VocabularyPeer::BASE_DOMAIN)) $criteria->add(VocabularyPeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(VocabularyPeer::TOKEN)) $criteria->add(VocabularyPeer::TOKEN, $this->token);
		if ($this->isColumnModified(VocabularyPeer::COMMUNITY)) $criteria->add(VocabularyPeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(VocabularyPeer::LAST_URI_ID)) $criteria->add(VocabularyPeer::LAST_URI_ID, $this->last_uri_id);
		if ($this->isColumnModified(VocabularyPeer::LANGUAGE)) $criteria->add(VocabularyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(VocabularyPeer::STATUS_ID)) $criteria->add(VocabularyPeer::STATUS_ID, $this->status_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		$criteria->add(VocabularyPeer::ID, $this->id);

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

		$copyObj->setAgentId($this->agent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setName($this->name);

		$copyObj->setNote($this->note);

		$copyObj->setUri($this->uri);

		$copyObj->setUrl($this->url);

		$copyObj->setBaseDomain($this->base_domain);

		$copyObj->setToken($this->token);

		$copyObj->setCommunity($this->community);

		$copyObj->setLastUriId($this->last_uri_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConcepts() as $relObj) {
				$copyObj->addConcept($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
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
			self::$peer = new VocabularyPeer();
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

				$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

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

		$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setVocabulary($this);
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

				$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}

	
	public function initConceptPropertys()
	{
		if ($this->collConceptPropertys === null) {
			$this->collConceptPropertys = array();
		}
	}

	
	public function getConceptPropertys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
					$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;
		return $this->collConceptPropertys;
	}

	
	public function countConceptPropertys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setVocabulary($this);
	}


	
	public function getConceptPropertysJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}

	
	public function initVocabularyHasUsers()
	{
		if ($this->collVocabularyHasUsers === null) {
			$this->collVocabularyHasUsers = array();
		}
	}

	
	public function getVocabularyHasUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
					$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;
		return $this->collVocabularyHasUsers;
	}

	
	public function countVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

		return VocabularyHasUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVocabularyHasUser(VocabularyHasUser $l)
	{
		$this->collVocabularyHasUsers[] = $l;
		$l->setVocabulary($this);
	}


	
	public function getVocabularyHasUsersJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;

		return $this->collVocabularyHasUsers;
	}

} 
