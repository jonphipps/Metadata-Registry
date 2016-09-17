<?php
use apps\frontend\lib\Breadcrumb;

/**
 * sidebar components.
 *
 * @property FileImportHistory file_import_history
 * @property SchemaHasUser schema_has_user
 * @property Breadcrumb[] breadcrumbs
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
        if ($id) {
            $topnav[] = [ 'title' => 'Details', 'link' => '@vocabulary_detail?id=' . $id ];
            $topnav[] = [ 'title' => 'Concepts', 'link' => '@vocabulary_concepts?vocabulary_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'History', 'link' => '@vocabulary_history?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Versions', 'link' => '@vocabulary_version?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@vocabulary_maintainers?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Exports', 'link' => '@vocabulary_exports?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Imports', 'link' => '@vocabulary_imports?vocabulary_id=' . $id ];
            $this->tabs = self::getModuleForRoutes($topnav);

            $vocabulary         = isset( $this->vocabulary ) ? $this->vocabulary : VocabularyPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::vocabularyFactory($vocabulary, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Vocabularies');
        }

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeConcepts()
    {
        $id = $this->getRequestParameter('concept_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@concept_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Properties', 'link' => '@concept_properties?concept_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@concept_history?concept_id=' . $id ];
        $this->tabs = self::getModuleForRoutes($topnav);

        $concept        = isset( $this->concept ) ? $this->concept : ConceptPeer::retrieveByPK($id);
        $breadcrumbs[1] = Breadcrumb::conceptFactory( $concept, true);
        $breadcrumbs[0] = Breadcrumb::vocabularyFactory($concept->getVocabulary());
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeProperties()
    {
        $id = $this->getRequestParameter('property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@properties_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@properties_history?property_id=' . $id ];
        $this->tabs = self::getModuleForRoutes($topnav);

        $property         = isset( $this->concept_property ) ? $this->concept_property : ConceptPropertyPeer::retrieveByPK($id);
        $breadcrumbs[0]    = Breadcrumb::vocabularyFactory($property->getConceptVocabulary());
        $breadcrumbs[1]    = Breadcrumb::conceptFactory($property->getConceptRelatedByConceptId());
        $breadcrumbs[2]    = Breadcrumb::conceptPropertyFactory($property, true);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeElementsets()
    {
        $id = $this->getRequestParameter('schema_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        if ($id) {
            $topnav[] = [ 'title' => 'Details', 'link' => '@elementset_detail?id=' . $id ];
            $topnav[] = [ 'title' => 'Elements', 'link' => '@elementset_elements?schema_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?schema_id=' . $id ];
            $topnav[] = [ 'title' => 'History', 'link' => '@elementset_history?schema_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Versions', 'link' => '/schemaversion/list?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@schema_schemauser_list?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Exports', 'link' => '@elementset_exports?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Imports', 'link' => '@elementset_imports?schema_id=' . $id ];
            $this->tabs = self::getModuleForRoutes($topnav);

            $schema         = isset( $this->schema ) ? $this->schema : SchemaPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::elementSetFactory($schema, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Element Sets');
        }
        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeElementsets_maintainers()
    {
        $id            = $this->getRequestParameter('id');
        $schemaHasUser = $this->schema_has_user;
        $schema        = $schemaHasUser->getSchema();
        $member        = $schemaHasUser->getUser();
        $requestStack  = $this->getUser()->getAttribute('request_stack', '', 'sfRefererPlugin');
        $refererRoute  = isset( $requestStack['last_route'] ) ? $requestStack['last_route'] : 0;

        $breadcrumbs[$refererRoute == 'member_elementsets'] = Breadcrumb::elementSetFactory($schema);
        $breadcrumbs[$refererRoute != 'member_elementsets'] = Breadcrumb::memberFactory($member);
        $breadcrumbs[2]                                     = new Breadcrumb('Maintainers',
                                                                             '@schema_schemauser_list?schema_id=' . $schema->getId(),
                                                                             $member->getNickname(),
                                                                             '');

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeVocabularies_maintainers()
    {
        $id            = $this->getRequestParameter('id');
        /** @var VocabularyHasUser $vocabHasUser */
        $vocabHasUser = $this->vocabulary_has_user;
        $vocabulary   = $vocabHasUser->getVocabulary();
        $member       = $vocabHasUser->getUser();
        $requestStack = $this->getUser()->getAttribute('request_stack', '', 'sfRefererPlugin');
        $refererRoute = isset( $requestStack['last_route'] ) ? $requestStack['last_route'] : 0;

        $breadcrumbs[$refererRoute != 'vocabulary_maintainers'] = Breadcrumb::vocabularyFactory($vocabulary);
        $breadcrumbs[$refererRoute == 'vocabulary_maintainers'] = Breadcrumb::memberFactory($member);
        $breadcrumbs[2]                                     = new Breadcrumb('Maintainers',
                                                                             '@vocabulary_maintainers?vocabulary_id=' . $vocabulary->getId(),
                                                                             $member->getNickname(),
                                                                             '');

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeElements()
    {
        $id = $this->getRequestParameter('schema_property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@element_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Statements', 'link' => '@element_statements?schema_property_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@element_history?schema_property_id=' . $id ];
        $this->tabs = self::getModuleForRoutes($topnav);

        $element         = isset( $this->schema_property ) ? $this->schema_property : SchemaPropertyPeer::retrieveByPK($id);
        $breadcrumbs[0]    = Breadcrumb::elementSetFactory($element->getSchema());
        $breadcrumbs[1]    = Breadcrumb::elementFactory($element, true);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeStatements()
    {
        $id = $this->getRequestParameter('schema_property_element_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@statement_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@statement_history?schema_property_element_id=' . $id ];
        $this->tabs = self::getModuleForRoutes($topnav);

        $statement         = isset( $this->schema_property_element )
            ? $this->schema_property_element
            : SchemaPropertyElementPeer::retrieveByPK($id);
        $element           = $statement->getSchemaPropertyRelatedBySchemaPropertyId();
        $breadcrumbs[0]    = Breadcrumb::elementSetFactory($element->getSchema());
        $breadcrumbs[1]    = Breadcrumb::elementFactory($element);
        $breadcrumbs[2]    = Breadcrumb::statementFactory($statement, true);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeImports()
    {
        $id = $this->getRequestParameter('import_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }

        /** @var FileImportHistory $history */
        $history = (isset($this->file_import_history)) ? $this->file_import_history :  FileImportHistoryPeer::retrieveByPK($id);
        $vocabulary = $history->getVocabulary();
        $schema = $history->getSchema();

        $topnav[] = [ 'title' => 'Details', 'link' => '@import_detail?id=' . $id ];
        if ($history ) {
            if ($schema) { //it's an elementset
                $topnav[]       = [ 'title' => 'History', 'link' => '@elementset_import_history?import_id=' . $id ];
                $breadcrumbs[0] = Breadcrumb::elementSetFactory($schema);
                $breadcrumbs[1] = Breadcrumb::importElementSetFactory($history, true);
            }
            if ($vocabulary) { //it's a vocabulary
                $topnav[]       = [ 'title' => 'History', 'link' => '@vocabulary_import_history?import_id=' . $id ];
                $breadcrumbs[0] = Breadcrumb::vocabularyFactory($vocabulary);
                $breadcrumbs[1] = Breadcrumb::importVocabularyFactory($history, true);
            }
        }

        $this->tabs        = self::getModuleForRoutes($topnav);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeMembers()
    {
        $id = $this->getRequestParameter('user_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        if ($id) {
            $topnav[]       = [ 'title' => 'Details', 'link' => '@member_detail?id=' . $id ];
            $topnav[]       = [ 'title' => 'Agents', 'link' => '@member_agents?user_id=' . $id ];
            $topnav[]       = [ 'title' => 'Vocabularies', 'link' => '@member_vocabularies?user_id=' . $id ];
            $topnav[]       = [ 'title' => 'Element Sets', 'link' => '@member_elementsets?user_id=' . $id ];
            $this->tabs     = self::getModuleForRoutes($topnav);
            $member          = isset( $this->user ) ? $this->user : UserPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::memberFactory($member, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Members');
        }

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeAgents()
    {
      $id = $this->getRequestParameter('agent_id');
      if ( ! $id) {
        $id = $this->getRequestParameter('id');
      }
      if ($id) {
        $topnav[]   = [ 'title' => 'Details', 'link' => '@agent_detail?id=' . $id ];
        $topnav[]   = [ 'title' => 'Members', 'link' => '@agent_members?agent_id=' . $id ];
        $topnav[]   = [ 'title' => 'Vocabularies', 'link' => '@agent_vocabularies?agent_id=' . $id ];
        $topnav[]   = [ 'title' => 'Element Sets', 'link' => '@agent_elementsets?agent_id=' . $id ];
        $this->tabs = self::getModuleForRoutes($topnav);

        $agent          = isset( $this->agent ) ? $this->agent : AgentPeer::retrieveByPK($id);
        $breadcrumbs[0] = Breadcrumb::agentFactory($agent, true);
      } else { //there's no id so it's a list of everything
        $breadcrumbs[0] = Breadcrumb::listFactory('Agents');
      }

      //there's always a breadcrumb
      $this->breadcrumbs = $breadcrumbs;
    }


  public static function getModuleForRoutes($topnav)
  {
    foreach ($topnav as &$tab) {
      $routeName = preg_replace('#^\@(.*)\?.*$#uiUs', "$1", $tab['link']);
      if ($routeName) {
        $route         = sfRouting::getInstance()->getRouteByName($routeName);
        $tab['module'] = $route[4]['module'];
      }
    }
    return $topnav;
  }
}

