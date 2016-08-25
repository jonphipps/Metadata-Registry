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


    /**
     * breadcrumb constructor.
     *
     * @param string $entityTypeLabel
     * @param string $entityTypeUrl
     * @param string $entityLabel
     * @param string $entityUrl
     */
    public function __construct($entityTypeLabel, $entityTypeUrl, $entityLabel, $entityUrl)
    {
        $this->entityTypeLabel = $entityTypeLabel;
        $this->entityTypeUrl = $entityTypeUrl;
        $this->entityLabel = $entityLabel;
        $this->entityUrl = $entityUrl;
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
    public function getEntityTypeLabel()
    {
        return $this->entityTypeLabel;
    }


    /**
     * @return string
     */
    public function getEntityTypeUrl()
    {
        return $this->entityTypeUrl;
    }


    /**
     * @return string
     */
    public function getEntityLabel()
    {
        return $this->entityLabel;
    }


    /**
     * @return string
     */
    public function getEntityUrl()
    {
        return $this->entityUrl;
    }


    /**
     * @param \Schema $elementSet
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function elementSetFactory($elementSet, $show = false)
    {
        $breadcrumb = new Breadcrumb(
            'ElementSets',
            '@elementset_list',
            $elementSet->getName(),
            '@elementset_detail?id=' . $elementSet->getId());

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
        $breadcrumb = new Breadcrumb(
            'Elements',
            '@elementset_elements?schema_id=' . $element->getSchemaId(),
            $element->getLabel(),
            '@element_detail?id=' . $element->getId());

        if ($show) {
            $breadcrumb->entityUrl = null;
        }

        return $breadcrumb;
    }


    /**
     * @param \SchemaPropertyElement $statement
     * @param bool $show if it's a show-only breadcrumb
     *
     * @return Breadcrumb
     */
    public static function statementFactory($statement, $show = false)
    {
        $breadcrumb = new Breadcrumb(
            'Statements',
            '@element_statements?schema_property_id=' . $statement->getSchemaPropertyId(),
            $statement->getProfileProperty()->getLabel(),
            '@statement_detail?id=' . $statement->getId());

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
        $breadcrumbs    = [];
        $breadcrumbs[3] = new Breadcrumb(
            'History',
            '@statement_history?schema_property_element_id=' . $schemaHistory->getSchemaPropertyElementId(),
            'History Detail',
            null);
        $breadcrumbs[2] = self::statementFactory($schemaHistory->getSchemaPropertyElement());
        $breadcrumbs[1] = self::elementFactory($schemaHistory->getSchemaPropertyRelatedBySchemaPropertyId());
        $breadcrumbs[0] = self::elementSetFactory($schemaHistory->getSchema());

        return $breadcrumbs;

    }
}
