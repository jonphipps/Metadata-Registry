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

  /**
  * Get the created by user
  *
  * @return User
  */
  public function getCreatedBy()
  {
    return $this->getUserRelatedByCreatedUserId();

  } // getCreatedUser()

  /**
  * Get the updated by user
  *
  * @return User
  */
  public function getUpdatedBy()
  {
    return $this->getUserRelatedByUpdatedUserId();

  } // getUpdatedUser()

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function updateFromRequest($userId, $prefLabel = null, $language = null, $statusId = null)
  {
    //upsert the preflabel concept property
    /** @var ConceptProperty **/
    $conceptProperty = $this->getConceptProperty();
    $updatedAt = time();

    if (!$conceptProperty)
    {
      $conceptProperty = new ConceptProperty();
      $conceptProperty->setSkosPropertyId(SkosProperty::getPrefLabelId());
      $conceptProperty->setCreatedUserId($userId);
      $conceptProperty->setPrimaryPrefLabel(1);
    }

    $conceptProperty->setUpdatedUserId($userId);

    if (isset($prefLabel))
    {
      $conceptProperty->setObject($prefLabel);
      $this->setPrefLabel($prefLabel);
    }

    if (isset($language))
    {
      $conceptProperty->setLanguage($language);
      $this->setLanguage($language);
    }

    if (isset($statusId))
    {
      $conceptProperty->setStatusId($statusId);
      $this->setStatusId($statusId);
    }

    $this->setUpdatedAt($updatedAt);
    $conceptProperty->setUpdatedAt($updatedAt);

    //now let's save the concept
    //if we're in create mode...
    if ($this->isNew())
    {
      $this->setCreatedUserId($userId);
      $this->save();

      $conceptProperty->setConceptRelatedByConceptId($this);
      $conceptProperty->save();
    }
    else
    {
      $conceptProperty->setConceptRelatedByConceptId($this);
    }

    //update the pref_label concept property
    $this->setUpdatedUserId($userId);
    $this->setConceptProperty($conceptProperty);
    $this->save();

    return;

  } //updateFromRequest()

	/**
	 * @param ProfileProperty[] $profileProperties
	 *
	 * @return ConceptProperty[]
	 */
	public function getElementsForImport($profileProperties)
	{
		$elementsTmp = [];
		$elements = [];
		$dbElements = $this->getConceptPropertysRelatedByConceptId();
		/** @var \ConceptProperty $element */
		foreach ($dbElements as $element) {
			$profile = $element->getProfileProperty();
			if ($profile) {
				$profileId = $profile->getId();
				if ($profile->getHasLanguage()) {
					$elementsTmp[$profileId . " (" . $element->getLanguage() . ")"][] = $element;
				} else {
					$elementsTmp[$profile->getId()][] = $element;
				}
			}
		}
		foreach ($elementsTmp as $key => $elementTmp) {
			if (1 == count($elementTmp)) {
				$elements[$key] = $elementTmp[0];
			} else {
				$elements[$key] = $elementTmp;
			}
		}

		return $elements;
	}


} // Concept
