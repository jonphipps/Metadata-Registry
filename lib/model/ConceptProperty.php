<?php

require_once 'model/om/BaseConceptProperty.php';


/**
 * Skeleton subclass for representing a row from the 'reg_concept_property' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class ConceptProperty extends BaseConceptProperty {

	/**
	 * The value for the vocabulary_id field.
	 * @var int
	 */
	protected $vocabulary_id;

	/**
	 * The value for the vocabulary_name field.
	 * @var string
	 */
	protected $vocabulary_name;

	/**
	 * The value for the skos_property_name field.
	 * @var string
	 */
	protected $skos_property_name;

	/**
	 * The value for the concept_pref_label field.
	 * @var string
	 */
	protected $concept_pref_label = '';


  public function __toString()
  {
    return $this->getSkosProperty();
  }

  /**
  * returns the parent vocabulary
  *
  * @return vocabulary
  */
  public function getConceptVocabulary()
  {
    return $this->getConcept()->getVocabulary();
  }

	/**
	 * Get the [vocabulary_id] column value.
	 *
	 * @return int
	 */
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	/**
	 * Get the [vocabulary_name] column value.
	 *
	 * @return string
	 */
	public function getVocabularyName()
	{
		return $this->vocabulary_name;
	}

	/**
	 * Get the [concept_pref_label] column value.
	 *
	 * @return string
	 */
	public function getCONCEPTPrefLabel()
	{

		return $this->concept_pref_label;
	}

	/**
	 * Set the value of [vocabulary_id] column.
	 *
	 * @param int $v new value
	 * @return void
	 */
	public function setVocabularyId($v)
	{

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::VOCABULARY_ID;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [vocabulary_name] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setVocabularyName($v)
	{

		if ($this->vocabulary_name !== $v) {
			$this->vocabulary_name = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::VOCABULARY_NAME;
		}

	} // setVocabularyName()

	/**
	 * Get the [skos_property_name] column value.
	 *
	 * @return string
	 */
	public function getSkosPropertyName()
	{
      if (!$this->skos_property_name && $this->getSkosPropertyId())
      {
         $this->skos_property_name = SkosPropertyPeer::retrieveByPK($this->getSkosPropertyId())->getName();
      }
		return $this->skos_property_name;
	}

	/**
	 * Set the value of [skos_property_name] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setSkosPropertyName($v)
	{

		if ($this->skos_property_name !== $v) {
			$this->skos_property_name = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SKOS_PROPERTY_NAME;
		}

	} // setVocabularyName()

	/**
	 * Set the value of [concept_pref_label] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setConceptPrefLabel($v)
	{

		if ($this->concept_pref_label !== $v || $v === '') {
			$this->concept_pref_label = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::CONCEPT_PREF_LABEL;
		}

	} // setPrefLabel()

} // ConceptProperty