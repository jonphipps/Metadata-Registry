<?php


abstract class BaseSkosProperty extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $parent_id;


	
	protected $inverse_id;


	
	protected $name = 'null';


	
	protected $uri = 'null';


	
	protected $object_type = 'null';


	
	protected $display_order;


	
	protected $picklist_order;


	
	protected $label;


	
	protected $definition;


	
	protected $comment;


	
	protected $examples;


	
	protected $is_required = false;


	
	protected $is_reciprocal = false;


	
	protected $is_singleton = false;


	
	protected $is_scheme = false;


	
	protected $is_in_picklist = true;

	
	protected $collConceptPropertys;

	
	protected $lastConceptPropertyCriteria = null;

	
	protected $collConceptPropertyHistorys;

	
	protected $lastConceptPropertyHistoryCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getInverseId()
	{

		return $this->inverse_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getUri()
	{

		return $this->uri;
	}

	
	public function getObjectType()
	{

		return $this->object_type;
	}

	
	public function getDisplayOrder()
	{

		return $this->display_order;
	}

	
	public function getPicklistOrder()
	{

		return $this->picklist_order;
	}

	
	public function getLabel()
	{

		return $this->label;
	}

	
	public function getDefinition()
	{

		return $this->definition;
	}

	
	public function getComment()
	{

		return $this->comment;
	}

	
	public function getExamples()
	{

		return $this->examples;
	}

	
	public function getIsRequired()
	{

		return $this->is_required;
	}

	
	public function getIsReciprocal()
	{

		return $this->is_reciprocal;
	}

	
	public function getIsSingleton()
	{

		return $this->is_singleton;
	}

	
	public function getIsScheme()
	{

		return $this->is_scheme;
	}

	
	public function getIsInPicklist()
	{

		return $this->is_in_picklist;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::ID;
		}

	} 
	
	public function setParentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::PARENT_ID;
		}

	} 
	
	public function setInverseId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inverse_id !== $v) {
			$this->inverse_id = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::INVERSE_ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === 'null') {
			$this->name = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::NAME;
		}

	} 
	
	public function setUri($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri !== $v || $v === 'null') {
			$this->uri = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::URI;
		}

	} 
	
	public function setObjectType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_type !== $v || $v === 'null') {
			$this->object_type = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::OBJECT_TYPE;
		}

	} 
	
	public function setDisplayOrder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_order !== $v) {
			$this->display_order = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::DISPLAY_ORDER;
		}

	} 
	
	public function setPicklistOrder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->picklist_order !== $v) {
			$this->picklist_order = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::PICKLIST_ORDER;
		}

	} 
	
	public function setLabel($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::LABEL;
		}

	} 
	
	public function setDefinition($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->definition !== $v) {
			$this->definition = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::DEFINITION;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::COMMENT;
		}

	} 
	
	public function setExamples($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->examples !== $v) {
			$this->examples = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::EXAMPLES;
		}

	} 
	
	public function setIsRequired($v)
	{

		if ($this->is_required !== $v || $v === false) {
			$this->is_required = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_REQUIRED;
		}

	} 
	
	public function setIsReciprocal($v)
	{

		if ($this->is_reciprocal !== $v || $v === false) {
			$this->is_reciprocal = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_RECIPROCAL;
		}

	} 
	
	public function setIsSingleton($v)
	{

		if ($this->is_singleton !== $v || $v === false) {
			$this->is_singleton = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_SINGLETON;
		}

	} 
	
	public function setIsScheme($v)
	{

		if ($this->is_scheme !== $v || $v === false) {
			$this->is_scheme = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_SCHEME;
		}

	} 
	
	public function setIsInPicklist($v)
	{

		if ($this->is_in_picklist !== $v || $v === true) {
			$this->is_in_picklist = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_IN_PICKLIST;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->parent_id = $rs->getInt($startcol + 1);

			$this->inverse_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->uri = $rs->getString($startcol + 4);

			$this->object_type = $rs->getString($startcol + 5);

			$this->display_order = $rs->getInt($startcol + 6);

			$this->picklist_order = $rs->getInt($startcol + 7);

			$this->label = $rs->getString($startcol + 8);

			$this->definition = $rs->getString($startcol + 9);

			$this->comment = $rs->getString($startcol + 10);

			$this->examples = $rs->getString($startcol + 11);

			$this->is_required = $rs->getBoolean($startcol + 12);

			$this->is_reciprocal = $rs->getBoolean($startcol + 13);

			$this->is_singleton = $rs->getBoolean($startcol + 14);

			$this->is_scheme = $rs->getBoolean($startcol + 15);

			$this->is_in_picklist = $rs->getBoolean($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 17; 

		} catch (Exception $e) {
			throw new PropelException("Error populating SkosProperty object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSkosProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SkosPropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSkosProperty:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSkosProperty:save:pre') as $callable)
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
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSkosProperty:save:post') as $callable)
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
					$pk = SkosPropertyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SkosPropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = SkosPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SkosPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getParentId();
				break;
			case 2:
				return $this->getInverseId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getUri();
				break;
			case 5:
				return $this->getObjectType();
				break;
			case 6:
				return $this->getDisplayOrder();
				break;
			case 7:
				return $this->getPicklistOrder();
				break;
			case 8:
				return $this->getLabel();
				break;
			case 9:
				return $this->getDefinition();
				break;
			case 10:
				return $this->getComment();
				break;
			case 11:
				return $this->getExamples();
				break;
			case 12:
				return $this->getIsRequired();
				break;
			case 13:
				return $this->getIsReciprocal();
				break;
			case 14:
				return $this->getIsSingleton();
				break;
			case 15:
				return $this->getIsScheme();
				break;
			case 16:
				return $this->getIsInPicklist();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SkosPropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getInverseId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getUri(),
			$keys[5] => $this->getObjectType(),
			$keys[6] => $this->getDisplayOrder(),
			$keys[7] => $this->getPicklistOrder(),
			$keys[8] => $this->getLabel(),
			$keys[9] => $this->getDefinition(),
			$keys[10] => $this->getComment(),
			$keys[11] => $this->getExamples(),
			$keys[12] => $this->getIsRequired(),
			$keys[13] => $this->getIsReciprocal(),
			$keys[14] => $this->getIsSingleton(),
			$keys[15] => $this->getIsScheme(),
			$keys[16] => $this->getIsInPicklist(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SkosPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setParentId($value);
				break;
			case 2:
				$this->setInverseId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setUri($value);
				break;
			case 5:
				$this->setObjectType($value);
				break;
			case 6:
				$this->setDisplayOrder($value);
				break;
			case 7:
				$this->setPicklistOrder($value);
				break;
			case 8:
				$this->setLabel($value);
				break;
			case 9:
				$this->setDefinition($value);
				break;
			case 10:
				$this->setComment($value);
				break;
			case 11:
				$this->setExamples($value);
				break;
			case 12:
				$this->setIsRequired($value);
				break;
			case 13:
				$this->setIsReciprocal($value);
				break;
			case 14:
				$this->setIsSingleton($value);
				break;
			case 15:
				$this->setIsScheme($value);
				break;
			case 16:
				$this->setIsInPicklist($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SkosPropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInverseId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUri($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObjectType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDisplayOrder($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPicklistOrder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLabel($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDefinition($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setExamples($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsRequired($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsReciprocal($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsSingleton($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIsScheme($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setIsInPicklist($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(SkosPropertyPeer::ID)) $criteria->add(SkosPropertyPeer::ID, $this->id);
		if ($this->isColumnModified(SkosPropertyPeer::PARENT_ID)) $criteria->add(SkosPropertyPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(SkosPropertyPeer::INVERSE_ID)) $criteria->add(SkosPropertyPeer::INVERSE_ID, $this->inverse_id);
		if ($this->isColumnModified(SkosPropertyPeer::NAME)) $criteria->add(SkosPropertyPeer::NAME, $this->name);
		if ($this->isColumnModified(SkosPropertyPeer::URI)) $criteria->add(SkosPropertyPeer::URI, $this->uri);
		if ($this->isColumnModified(SkosPropertyPeer::OBJECT_TYPE)) $criteria->add(SkosPropertyPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(SkosPropertyPeer::DISPLAY_ORDER)) $criteria->add(SkosPropertyPeer::DISPLAY_ORDER, $this->display_order);
		if ($this->isColumnModified(SkosPropertyPeer::PICKLIST_ORDER)) $criteria->add(SkosPropertyPeer::PICKLIST_ORDER, $this->picklist_order);
		if ($this->isColumnModified(SkosPropertyPeer::LABEL)) $criteria->add(SkosPropertyPeer::LABEL, $this->label);
		if ($this->isColumnModified(SkosPropertyPeer::DEFINITION)) $criteria->add(SkosPropertyPeer::DEFINITION, $this->definition);
		if ($this->isColumnModified(SkosPropertyPeer::COMMENT)) $criteria->add(SkosPropertyPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(SkosPropertyPeer::EXAMPLES)) $criteria->add(SkosPropertyPeer::EXAMPLES, $this->examples);
		if ($this->isColumnModified(SkosPropertyPeer::IS_REQUIRED)) $criteria->add(SkosPropertyPeer::IS_REQUIRED, $this->is_required);
		if ($this->isColumnModified(SkosPropertyPeer::IS_RECIPROCAL)) $criteria->add(SkosPropertyPeer::IS_RECIPROCAL, $this->is_reciprocal);
		if ($this->isColumnModified(SkosPropertyPeer::IS_SINGLETON)) $criteria->add(SkosPropertyPeer::IS_SINGLETON, $this->is_singleton);
		if ($this->isColumnModified(SkosPropertyPeer::IS_SCHEME)) $criteria->add(SkosPropertyPeer::IS_SCHEME, $this->is_scheme);
		if ($this->isColumnModified(SkosPropertyPeer::IS_IN_PICKLIST)) $criteria->add(SkosPropertyPeer::IS_IN_PICKLIST, $this->is_in_picklist);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);

		$criteria->add(SkosPropertyPeer::ID, $this->id);

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

		$copyObj->setParentId($this->parent_id);

		$copyObj->setInverseId($this->inverse_id);

		$copyObj->setName($this->name);

		$copyObj->setUri($this->uri);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setDisplayOrder($this->display_order);

		$copyObj->setPicklistOrder($this->picklist_order);

		$copyObj->setLabel($this->label);

		$copyObj->setDefinition($this->definition);

		$copyObj->setComment($this->comment);

		$copyObj->setExamples($this->examples);

		$copyObj->setIsRequired($this->is_required);

		$copyObj->setIsReciprocal($this->is_reciprocal);

		$copyObj->setIsSingleton($this->is_singleton);

		$copyObj->setIsScheme($this->is_scheme);

		$copyObj->setIsInPicklist($this->is_in_picklist);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
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
			self::$peer = new SkosPropertyPeer();
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

		$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setSkosProperty($this);
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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

		$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptPropertyHistory(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorys[] = $l;
		$l->setSkosProperty($this);
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinStatus($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	
	public function getConceptPropertyHistorysJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSkosProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSkosProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
