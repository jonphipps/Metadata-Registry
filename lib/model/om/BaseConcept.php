<?php


abstract class BaseConcept extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $created_at;


	
	protected $last_updated;


	
	protected $uri = '';


	
	protected $pref_label = '';


	
	protected $vocabulary_id;


	
	protected $is_top_concept;

	
	protected $aVocabulary;

	
	protected $collConceptPropertys;

	
	protected $lastConceptPropertyCriteria = null;

	
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

	
	public function getUri()
	{

		return $this->uri;
	}

	
	public function getPrefLabel()
	{

		return $this->pref_label;
	}

	
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	
	public function getIsTopConcept()
	{

		return $this->is_top_concept;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPeer::ID;
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
			$this->modifiedColumns[] = ConceptPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ConceptPeer::LAST_UPDATED;
		}

	} 

	
	public function setUri($v)
	{

		if ($this->uri !== $v || $v === '') {
			$this->uri = $v;
			$this->modifiedColumns[] = ConceptPeer::URI;
		}

	} 

	
	public function setPrefLabel($v)
	{

		if ($this->pref_label !== $v || $v === '') {
			$this->pref_label = $v;
			$this->modifiedColumns[] = ConceptPeer::PREF_LABEL;
		}

	} 

	
	public function setVocabularyId($v)
	{

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} 

	
	public function setIsTopConcept($v)
	{

		if ($this->is_top_concept !== $v) {
			$this->is_top_concept = $v;
			$this->modifiedColumns[] = ConceptPeer::IS_TOP_CONCEPT;
		}

	} 

	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->uri = $rs->getString($startcol + 3);

			$this->pref_label = $rs->getString($startcol + 4);

			$this->vocabulary_id = $rs->getInt($startcol + 5);

			$this->is_top_concept = $rs->getBoolean($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			
			return $startcol + 7; 

		} catch (Exception $e) {
			throw new PropelException("Error populating Concept object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified('created_at'))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
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


			
			
			
			

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}


			
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPeer::doInsert($this, $con);
					$affectedRows += 1; 
										 
										 

					$this->setId($pk);  

					$this->setNew(false);
				} else {
					$affectedRows += ConceptPeer::doUpdate($this, $con);
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


			
			
			
			

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}


			if (($retval = ConceptPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUri();
				break;
			case 4:
				return $this->getPrefLabel();
				break;
			case 5:
				return $this->getVocabularyId();
				break;
			case 6:
				return $this->getIsTopConcept();
				break;
			default:
				return null;
				break;
		} 
	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getUri(),
			$keys[4] => $this->getPrefLabel(),
			$keys[5] => $this->getVocabularyId(),
			$keys[6] => $this->getIsTopConcept(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUri($value);
				break;
			case 4:
				$this->setPrefLabel($value);
				break;
			case 5:
				$this->setVocabularyId($value);
				break;
			case 6:
				$this->setIsTopConcept($value);
				break;
		} 
	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUri($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrefLabel($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVocabularyId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsTopConcept($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPeer::ID)) $criteria->add(ConceptPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPeer::CREATED_AT)) $criteria->add(ConceptPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPeer::LAST_UPDATED)) $criteria->add(ConceptPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(ConceptPeer::URI)) $criteria->add(ConceptPeer::URI, $this->uri);
		if ($this->isColumnModified(ConceptPeer::PREF_LABEL)) $criteria->add(ConceptPeer::PREF_LABEL, $this->pref_label);
		if ($this->isColumnModified(ConceptPeer::VOCABULARY_ID)) $criteria->add(ConceptPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(ConceptPeer::IS_TOP_CONCEPT)) $criteria->add(ConceptPeer::IS_TOP_CONCEPT, $this->is_top_concept);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		$criteria->add(ConceptPeer::ID, $this->id);

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

		$copyObj->setUri($this->uri);

		$copyObj->setPrefLabel($this->pref_label);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setIsTopConcept($this->is_top_concept);


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
			self::$peer = new ConceptPeer();
		}
		return self::$peer;
	}

	
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setVocabularyId(NULL);
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	
	public function getVocabulary($con = null)
	{
		
		include_once 'lib/model/om/BaseVocabularyPeer.php';

		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			
		}
		return $this->aVocabulary;
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

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			
			if (!$this->isNew()) {
				
				
				


				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

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

		$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setConcept($this);
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

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			
			
			

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

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

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			
			
			

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	
	public function getConceptPropertysJoinLookup($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		} else {
			
			
			

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}

} 
