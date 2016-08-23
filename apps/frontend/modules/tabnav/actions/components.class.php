<?php

/**
 * sidebar components.
 *
 * @package    Registry
 * @subpackage tabnav
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: components.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class tabnavComponents extends sfComponents
{

    public function executeDefault()
    {
        $tabnav = $this->getRequestParameter('tabnav');
        if ($tabnav) {
            $tabnav = 'execute' . ucfirst($tabnav);
            $this->$tabnav();
        }
    }


    public function executeVocabularies()
    {
        $id = $this->getRequestParameter('vocabulary_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[] = [ 'title' => 'Detail', 'link' => '@vocabulary_detail?id=' . $id ];
        $topnav[] = [ 'title' => 'Concepts', 'link' => '@vocabulary_concepts?vocabulary_id=' . $id ];
        //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?vocabulary_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@vocabulary_history?vocabulary_id=' . $id ];
        $topnav[]   = [ 'title' => 'Versions', 'link' => '@vocabulary_version?vocabulary_id=' . $id ];
        $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@vocabulary_maintainers?vocabulary_id=' . $id ];
        $topnav[]   = [ 'title' => 'Export', 'link' => '@vocabulary_exports?vocabulary_id=' . $id ];
        $topnav[]   = [ 'title' => 'Import', 'link' => '@vocabulary_imports?vocabulary_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeConcepts()
    {
        $id = $this->getRequestParameter('concept_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@concept_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Properties', 'link' => '@concept_properties?concept_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@concept_history?concept_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeProperties()
    {
        $id = $this->getRequestParameter('property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@properties_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@properties_history?property_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeElementsets()
    {
        $schemaId = $this->getRequestParameter('schema_id');
        if ( ! $schemaId) {
            $schemaId = $this->getRequestParameter('id');
        }
        $topnav[] = [ 'title' => 'Detail', 'link' => '@elementset_detail?id=' . $schemaId ];
        $topnav[] = [ 'title' => 'Elements', 'link' => '@elementset_elements?schema_id=' . $schemaId ];
        //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?schema_id=' . $schemaId ];
        $topnav[] = [ 'title' => 'History', 'link' => '@elementset_history?schema_id=' . $schemaId ];
        //$topnav[2]    = [ 'title' => 'Versions', 'link' => '/schemaversion/list?schema_id=' . $schemaId ];
        $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@elementset_maintainers?schema_id=' . $schemaId ];
        $topnav[]   = [ 'title' => 'Export', 'link' => '@elementset_exports?schema_id=' . $schemaId ];
        $topnav[]   = [ 'title' => 'Import', 'link' => '@elementset_imports?schema_id=' . $schemaId ];
        $this->tabs = $topnav;
    }


    public function executeElements()
    {
        $id = $this->getRequestParameter('schema_property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@element_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Statements', 'link' => '@element_statements?schema_property_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@element_history?schema_property_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeStatements()
    {
        $id = $this->getRequestParameter('schema_property_element_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@statement_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@statement_history?schema_property_element_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeImports()
    {
        $id = $this->getRequestParameter('import_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@import_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@import_history?import_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeMembers()
    {
        $id = $this->getRequestParameter('user_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@member_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Agents', 'link' => '@member_agents?user_id=' . $id ];
        $topnav[]   = [ 'title' => 'Vocabularies', 'link' => '@member_vocabularies?user_id=' . $id ];
        $topnav[]   = [ 'title' => 'Element Sets', 'link' => '@member_elementsets?user_id=' . $id ];
        $this->tabs = $topnav;
    }


    public function executeAgents()
    {
        $id = $this->getRequestParameter('agent_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Detail', 'link' => '@agent_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Members', 'link' => '@agent_members?agent_id=' . $id ];
        $this->tabs = $topnav;
    }
}

