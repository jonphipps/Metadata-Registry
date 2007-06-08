<?php

/**
 * Subclass for representing a row from the 'reg_concept' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Concept extends BaseConcept
{
	/**
	 * The value for the vocabulary_name field.
	 * @var string
	 */
	protected $vocabulary_name;

	/**
	 * The value for the agent_id field.
	 * @var int
	 */
	protected $agent_id;

	/**
	 * The value for the agent_name field.
	 * @var string
	 */
	protected $agent_name;

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
	 * Get the [agent_id] column value.
	 *
	 * @return int
	 */
	public function getAgentId()
	{

		return $this->agent_id;
	}

	/**
	 * Get the [agent_name] column value.
	 *
	 * @return string
	 */
	public function getAgentName()
	{

		return $this->agent_name;
	}

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
			$this->modifiedColumns[] = ConceptSearchResultsPeer::VOCABULARY_NAME;
		}

	} // setVocabularyName()

	/**
	 * Set the value of [agent_id] column.
	 *
	 * @param int $v new value
	 * @return void
	 */
	public function setAgentId($v)
	{

		if ($this->agent_id !== $v) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = ConceptSearchResultsPeer::AGENT_ID;
		}

	} // setAgentId()

	/**
	 * Set the value of [agent_name] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setAgentName($v)
	{

		if ($this->agent_name !== $v) {
			$this->agent_name = $v;
			$this->modifiedColumns[] = ConceptSearchResultsPeer::AGENT_NAME;
		}

	} // setAgentName()

  public function __toString()
  {
    return $this->getConcept();
  }

  public function getConcept()
  {
    return $this->getPrefLabel();
  }

} // Concept
