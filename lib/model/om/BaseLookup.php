<?php


abstract class BaseLookup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type_id;


	
	protected $short_value;


	
	protected $long_value;

	
	protected $collConceptPropertys;

	
	protected $lastConceptPropertyCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTypeId()
	{

		return $this->type_id;
	}

	
	public function getShortValue()
	{

		return $this->short_value;
	}

	
	public function getLongValue()
	{

		return $this->long_value;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LookupPeer::ID;
		}

	} 

	
	public function setTypeId($v)
	{

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = LookupPeer::TYPE_ID;
		}

	} 

	
	public function setShortValue($v)
	{

		if ($this->short_value !== $v) {
			$this->short_value = $v;
			$this->modifiedColumns[] = LookupPeer::SHORT_VALUE;
		}

	} 

	
	public function setLongValue($v)
	{

		if ($this->long_value !== $v) {
			$this->long_value = $v;
			$this->modifiedColumns[] = LookupPeer::LONG_VALUE;
		}

	} 

	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type_id = $rs->getInt($startcol + 1);

			$this->short_value = $rs->getString($startcol + 2);

			$this->long_value = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 4; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Lookup object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LookupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LookupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(LookupPeer::DATABASE_NAME);
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
		$affectedRows = 0; 
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LookupPeer::doInsert($this, $con);
					$affectedRows += 1; 
										 
										 

					$this->setId($pk);  

					$this->setNew(false);
				} else {
					$affectedRows += LookupPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 
			}

			if ($this->collConceptPropertys !== null) {
				foreach($this->collConceptPropertys as $referrerFK) {
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


			if (($retval = LookupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConceptPropertys !== null) {
					foreach($this->collConceptPropertys as $referrerFK) {
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
		$pos = LookupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTypeId();
				break;
			case 2:
				return $this->getShortValue();
				break;
			case 3:
				return $this->getLongValue();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LookupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeId(),
			$keys[2] => $this->getShortValue(),
			$keys[3] => $this->getLongValue(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LookupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTypeId($value);
				break;
			case 2:
				$this->setShortValue($value);
				break;
			case 3:
				$this->setLongValue($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LookupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLongValue($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LookupPeer::DATABASE_NAME);

		if ($this->isColumnModified(LookupPeer::ID)) $criteria->add(LookupPeer::ID, $this->id);
		if ($this->isColumnModified(LookupPeer::TYPE_ID)) $criteria->add(LookupPeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(LookupPeer::SHORT_VALUE)) $criteria->add(LookupPeer::SHORT_VALUE, $this->short_value);
		if ($this->isColumnModified(LookupPeer::LONG_VALUE)) $criteria->add(LookupPeer::LONG_VALUE, $this->long_value);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LookupPeer::DATABASE_NAME);

		$criteria->add(LookupPeer::ID, $this->id);

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

		$copyObj->setTypeId($this->type_id);

		$copyObj->setShortValue($this->short_value);

		$copyObj->setLongValue($this->long_value);


		if ($deepCopy) {
			
			
			$copyObj->setNew(false);

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
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
			self::$peer = new LookupPeer();
		}
		return self::$peer;
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
		$l->setLookup($this);
	}


	
	public function getConceptPropertysJoinConcept($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			
			
			

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConcept($criteria, $con);
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

} 
