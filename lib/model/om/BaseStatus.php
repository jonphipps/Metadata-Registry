<?php


abstract class BaseStatus extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $display_order;


	
	protected $display_name;

	
	protected $collConcepts;

	
	protected $lastConceptCriteria = null;

	
	protected $collConceptPropertys;

	
	protected $lastConceptPropertyCriteria = null;

	
	protected $collConceptPropertyHistorys;

	
	protected $lastConceptPropertyHistoryCriteria = null;

	
	protected $collVocabularys;

	
	protected $lastVocabularyCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDisplayOrder()
	{

		return $this->display_order;
	}

	
	public function getDisplayName()
	{

		return $this->display_name;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StatusPeer::ID;
		}

	} 
	
	public function setDisplayOrder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_order !== $v) {
			$this->display_order = $v;
			$this->modifiedColumns[] = StatusPeer::DISPLAY_ORDER;
		}

	} 
	
	public function setDisplayName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->display_name !== $v) {
			$this->display_name = $v;
			$this->modifiedColumns[] = StatusPeer::DISPLAY_NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->display_order = $rs->getInt($startcol + 1);

			$this->display_name = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 3; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Status object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseStatus:delete:pre') as $callable)
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
			$con = Propel::getConnection(StatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			StatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseStatus:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseStatus:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseStatus:save:post') as $callable)
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
					$pk = StatusPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += StatusPeer::doUpdate($this, $con);
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

			if ($this->collConceptPropertyHistorys !== null) {
				foreach($this->collConceptPropertyHistorys as $referrerFK) {
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


			if (($retval = StatusPeer::doValidate($this, $columns)) !== true) {
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

				if ($this->collConceptPropertyHistorys !== null) {
					foreach($this->collConceptPropertyHistorys as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDisplayOrder();
				break;
			case 2:
				return $this->getDisplayName();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDisplayOrder(),
			$keys[2] => $this->getDisplayName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDisplayOrder($value);
				break;
			case 2:
				$this->setDisplayName($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDisplayOrder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDisplayName($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(StatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(StatusPeer::ID)) $criteria->add(StatusPeer::ID, $this->id);
		if ($this->isColumnModified(StatusPeer::DISPLAY_ORDER)) $criteria->add(StatusPeer::DISPLAY_ORDER, $this->display_order);
		if ($this->isColumnModified(StatusPeer::DISPLAY_NAME)) $criteria->add(StatusPeer::DISPLAY_NAME, $this->display_name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(StatusPeer::DATABASE_NAME);

		$criteria->add(StatusPeer::ID, $this->id);

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

		$copyObj->setDisplayOrder($this->display_order);

		$copyObj->setDisplayName($this->display_name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConcepts() as $relObj) {
				$copyObj->addConcept($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularys() as $relObj) {
				$copyObj->addVocabulary($relObj->copy($deepCopy));
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
			self::$peer = new StatusPeer();
		}
		return self::$peer;
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

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

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

		$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setStatus($this);
	}


	
	public function getConceptsJoinUser($criteria = null, $con = null)
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

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	
	public function getConceptsJoinVocabulary($criteria = null, $con = null)
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

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	
	public function getConceptsJoinConceptProperty($criteria = null, $con = null)
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

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

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

		$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setStatus($this);
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinVocabulary($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}

	
	public function initConceptPropertyHistorys()
	{
		if ($this->collConceptPropertyHistorys === null) {
			$this->collConceptPropertyHistorys = array();
		}
	}

	
	public function getConceptPropertyHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;
		return $this->collConceptPropertyHistorys;
	}

	
	public function countConceptPropertyHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistory(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorys[] = $l;
		$l->setStatus($this);
	}


	
	public function getConceptPropertyHistorysJoinConceptProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinSkosProperty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinVocabulary($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
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

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

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

		$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVocabulary(Vocabulary $l)
	{
		$this->collVocabularys[] = $l;
		$l->setStatus($this);
	}


	
	public function getVocabularysJoinAgent($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
									
			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	
	public function getVocabularysJoinUser($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseStatus:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseStatus::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
