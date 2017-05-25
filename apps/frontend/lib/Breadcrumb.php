<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-08-23
 * Time: 6:48 PM
 */

namespace apps\frontend\lib;

class Breadcrumb
{

    private $entityTypeLabel = '';

    private $entityTypeUrl = '';

    private $entityLabel = '';

    private $entityUrl = '';

    private $namespace = ''; //location of stored params to check

    private $filters = []; //an array of available filter paths


    /**
     * breadcrumb constructor.
     *
     * @param string $entityTypeLabel
     * @param string $entityTypeUrl
     * @param string $entityLabel
     * @param string $entityUrl
     * @param string|null $namespace
     * @param array|null $filters
     */
    public function __construct($entityTypeLabel, $entityTypeUrl, $entityLabel, $entityUrl, $namespace = null, $filters = null)
    {
        $this->entityTypeLabel = $entityTypeLabel;
        $this->entityTypeUrl = $entityTypeUrl;
        $this->entityLabel = $entityLabel;
        $this->entityUrl = $entityUrl;
        $this->namespace = $namespace;
        $this->filters = $filters;
    }


    /**
     * @param \Agent $agent
     * @param bool $show
     *
     * @return Breadcrumb
     */
    public static function agentFactory($agent, $show = false)
    {
        $breadcrumb = new Breadcrumb('Projects',
                                     '@agent_list',
                                     $agent->getOrgName(),
                                     '@agent_show?id=' . $agent->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \SchemaPropertyElementHistory $schemaHistory
     *
     * @return Breadcrumb[]
     */
    public static function elementSetHistoryDetailFactory($schemaHistory)
    {
      \sfPropelParanoidBehavior::disable();
      $breadcrumbs    = [];
        $breadcrumbs[3] = new Breadcrumb('History',
                                         '@schemapropel_schemahistory_list?schema_property_element_id=' . $schemaHistory->getSchemaPropertyElementId(),
                                         'History Detail',
                                         null);
        $breadcrumbs[2] = self::statementFactory($schemaHistory->getSchemaPropertyElement());
        $breadcrumbs[1] = self::elementFactory($schemaHistory->getSchemaPropertyRelatedBySchemaPropertyId());
        $breadcrumbs[0] = self::elementSetFactory($schemaHistory->getSchema());

        return $breadcrumbs;

    }


    /**
     * @param \SchemaPropertyElement $statement
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function statementFactory($statement, $show = false)
    {
        $breadcrumb = new Breadcrumb('Statements',
                                     '@schemaprop_schemapropel_list?schema_property_id=' . $statement->getSchemaPropertyId(),
                                     $statement->getProfileProperty()->getLabel(),
                                     '@schemapropel_show?id=' . $statement->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \SchemaProperty $element
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function elementFactory($element, $show = false)
    {
        $breadcrumb = new Breadcrumb('Elements',
                                     '@schema_schemaprop_list?schema_id=' . $element->getSchemaId(),
                                     $element->getLabel(),
                                     '@schemaprop_show?id=' . $element->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \Schema $elementset
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function elementSetFactory($elementset, $show = false)
    {
        $breadcrumb = new Breadcrumb(
            'Element Sets',
            '@schema_list',
            $elementset->getName(),
            '@schema_show?id=' . $elementset->getId(),
            'schema',
            [ 'agent_id' => '@agent_schema_list?agent_id=' ]);

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \ConceptPropertyHistory $vocabularyHistory
     *
     * @return Breadcrumb[]
     */
    public static function vocabularyHistoryDetailFactory(\ConceptPropertyHistory $vocabularyHistory)
    {
      \sfPropelParanoidBehavior::disable();
      $breadcrumbs    = [];
        $breadcrumbs[3] = new Breadcrumb('History',
                                         '@conceptprop_history_list?concept_property_id=' . $vocabularyHistory->getConceptPropertyId(),
                                         'History Detail',
                                         null);
        $breadcrumbs[2] = self::conceptPropertyFactory($vocabularyHistory->getConceptProperty());
        $breadcrumbs[1] = self::conceptFactory($vocabularyHistory->getConceptRelatedByConceptId());
        $breadcrumbs[0] = self::vocabularyFactory($vocabularyHistory->getVocabularyRelatedByVocabularyId());

        return $breadcrumbs;

    }


    /**
     * @param \ConceptProperty $conceptProperty
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function conceptPropertyFactory($conceptProperty, $show = false)
    {
        $breadcrumb = new Breadcrumb('Statements',
                                     '@concept_conceptprop_list?concept_id=' . $conceptProperty->getConceptId(),
                                     $conceptProperty->getProfileProperty()->getLabel(),
                                     '@conceptprop_show?id=' . $conceptProperty->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \Concept $concept
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function conceptFactory($concept, $show = false)
    {
        $breadcrumb = new Breadcrumb('Concepts',
                                     '@vocabulary_concept_list?vocabulary_id=' . $concept->getVocabularyId(),
                                     $concept->getPrefLabel(),
                                     '@concept_show?id=' . $concept->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \Vocabulary $vocabulary
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function vocabularyFactory($vocabulary, $show = false)
    {
        $breadcrumb = new Breadcrumb('Vocabularies',
                                     '@vocabulary_list', $vocabulary->getName(),
                                     '@vocabulary_show?id=' . $vocabulary->getId(),
                                     'vocabulary',
        ['agent_id' => '@agent_vocabulary_list?agent_id=']);

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param string $title
     *
     * @return Breadcrumb
     */
    public static function listFactory($title)
    {
        $breadcrumb = new Breadcrumb(
            $title,
            null,
            null,
            null);

        return $breadcrumb;
    }


    /**
     * @param \FileImportHistory $history
     * @param bool $show
     *
     * @return Breadcrumb
     */
    public static function importElementSetFactory($history, $show = false)
    {
        $breadcrumb = new Breadcrumb('Imports',
                                     '@schema_import_list?schema_id=' . $history->getSchemaId(),
                                     $history->getCreatedAt(),
                                     '@history_show?id=' . $history->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \FileImportHistory $history
     * @param bool $show
     *
     * @return Breadcrumb
     */
    public static function importVocabularyFactory($history, $show = false)
    {
        $breadcrumb = new Breadcrumb('Imports',
                                     '@vocabulary_import_list?vocabulary_id=' . $history->getVocabularyId(),
                                     $history->getCreatedAt(),
                                     '@history_show?id=' . $history->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \User $member
     * @param bool $show
     *
     * @return Breadcrumb
     */
    public static function memberFactory($member, $show = false)
    {
        $breadcrumb = new Breadcrumb('Members',
                                     '@user_list',
                                     $member->getNickname() . " (" . $member->getFullName() . ")",
                                     '@user_show?id=' . $member->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @return string
     */
    public function getEntityTypeLabel()
    {
        return $this->entityTypeLabel;
    }


    /**
     * @param string $entityTypeLabel
     *
     * @return Breadcrumb
     */
    public function setEntityTypeLabel($entityTypeLabel)
    {
        $this->entityTypeLabel = $entityTypeLabel;

        return $this;
    }


    /**
     * @return string
     */
    public function getEntityTypeUrl()
    {
        return $this->entityTypeUrl;
    }


    /**
     * @param string $entityTypeUrl
     *
     * @return Breadcrumb
     */
    public function setEntityTypeUrl($entityTypeUrl)
    {
        $this->entityTypeUrl = $entityTypeUrl;

        return $this;
    }


    /**
     * @return string
     */
    public function getEntityLabel()
    {
        return $this->entityLabel;
    }


    /**
     * @param string $entityLabel
     *
     * @return Breadcrumb
     */
    public function setEntityLabel($entityLabel)
    {
        $this->entityLabel = $entityLabel;

        return $this;
    }


    /**
     * @return string
     */
    public function getEntityUrl()
    {
        return $this->entityUrl;
    }


    /**
     * @param string $entityUrl
     *
     * @return Breadcrumb
     */
    public function setEntityUrl($entityUrl)
    {
        $this->entityUrl = $entityUrl;

        return $this;
    }


    /**
     * @param string $namespace
     *
     * @return Breadcrumb
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }


    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }


    /**
     * @param array $filters
     *
     * @return Breadcrumb
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }


    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
