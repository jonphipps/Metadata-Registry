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
    //show and edit should get the tab associated with the module
    //this overrides the tabnav setting
    $showActions = [ 'show', 'edit' ];
    $tabnav      = in_array($this->getRequestParameter('action'), $showActions)
      ? $this->getRequestParameter('module') : $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $bugsnag = $GLOBALS['bugsnag'];
      /** @var Bugsnag\Client $bugsnag */
      $bugsnag->leaveBreadcrumb($tabnav,
          \Bugsnag\Breadcrumbs\Breadcrumb::NAVIGATION_TYPE,
          ['uri' => $this->getRequest()->getUri()]);
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }
  }


  public function executeHistory()
  {
    $tabnav = $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }

    $history           = isset( $this->concept_property_history ) ? $this->concept_property_history : ConceptPropertyHistoryPeer::retrieveByPK($this->getRequestParameter('id'));
    $this->breadcrumbs = Breadcrumb::vocabularyHistoryDetailFactory($history);

  }


  public function executeSchemahistory()
  {
    $tabnav = $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }

    $history           = isset( $this->schema_property_element_history ) ? $this->schema_property_element_history : SchemaPropertyElementHistoryPeer::retrieveByPK($this->getRequestParameter('id'));
    $this->breadcrumbs = Breadcrumb::elementSetHistoryDetailFactory($history);

  }


  public function executeVocabulary()
    {
        $id = $this->getRequestParameter('vocabulary_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        if ($id) {
            $topnav[] = [ 'title' => 'Details', 'link' => '@vocabulary_show?id=' . $id ];
            $topnav[] = [ 'title' => 'Concepts', 'link' => '@vocabulary_concept_list?vocabulary_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'History', 'link' => '@vocabulary_history_list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Versions', 'link' => '@vocabulary_version_list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@vocabulary_vocabuser_list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Exports', 'link' => '@vocabulary_export_list?vocabulary_id=' . $id ];
            $topnav[]   = [ 'title' => 'Imports', 'link' => '@vocabulary_import_list?vocabulary_id=' . $id ];
            $this->tabs = self::getModulesForRoutes($topnav);

            $vocabulary         = isset( $this->vocabulary ) ? $this->vocabulary : VocabularyPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::vocabularyFactory($vocabulary, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Vocabularies');
        }

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeConcept()
    {
        $id = $this->getRequestParameter('concept_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@concept_show?id=' . $id ];
        $topnav[]   = [ 'title' => 'Properties', 'link' => '@concept_conceptprop_list?concept_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@concept_history_list?concept_id=' . $id ];
        $this->tabs = self::getModulesForRoutes($topnav);

        $concept        = isset( $this->concept ) ? $this->concept : ConceptPeer::retrieveByPK($id);
        $breadcrumbs[1] = Breadcrumb::conceptFactory( $concept, true);
        $breadcrumbs[0] = Breadcrumb::vocabularyFactory($concept->getVocabulary());
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeConceptprop()
    {
        $id = $this->getRequestParameter('concept_property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@conceptprop_show?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@conceptprop_history_list?concept_property_id=' . $id ];
        $this->tabs = self::getModulesForRoutes($topnav);

        $property         = isset( $this->concept_property ) ? $this->concept_property : ConceptPropertyPeer::retrieveByPK($id);
        $breadcrumbs[0]    = Breadcrumb::vocabularyFactory($property->getConceptVocabulary());
        $breadcrumbs[1]    = Breadcrumb::conceptFactory($property->getConceptRelatedByConceptId());
        $breadcrumbs[2]    = Breadcrumb::conceptPropertyFactory($property, true);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeSchema()
    {
        $id = $this->getRequestParameter('schema_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        if ($id) {
            $topnav[] = [ 'title' => 'Details', 'link' => '@schema_show?id=' . $id ];
            $topnav[] = [ 'title' => 'Elements', 'link' => '@schema_schemaprop_list?schema_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Namespaces', 'link' => '/namespace/list?schema_id=' . $id ];
            $topnav[] = [ 'title' => 'History', 'link' => '@schema_schemahistory_list?schema_id=' . $id ];
            //$topnav[2]    = [ 'title' => 'Versions', 'link' => '/schemaversion/list?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Maintainers', 'link' => '@schema_schemauser_list?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Exports', 'link' => '@schema_export_list?schema_id=' . $id ];
            $topnav[]   = [ 'title' => 'Imports', 'link' => '@schema_import_list?schema_id=' . $id ];
            $this->tabs = self::getModulesForRoutes($topnav);

            $schema         = isset( $this->schema ) ? $this->schema : SchemaPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::elementSetFactory($schema, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Element Sets');
        }
        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


  public function executeSchemauser()
  {
    $id            = $this->getRequestParameter('id');
    $schemaHasUser = $this->schema_has_user;
    $schema        = $schemaHasUser->getSchema();
    $member        = $schemaHasUser->getUser();
    $requestStack  = $this->getUser()->getAttribute('request_stack', '', 'sfRefererPlugin');
    $refererRoute  = isset( $requestStack['last_route'] ) ? $requestStack['last_route'] : 0;

    $tabnav = $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }

    $breadcrumbs[$refererRoute == 'user_schema'] = Breadcrumb::elementSetFactory($schema);
    $breadcrumbs[$refererRoute != 'user_schema'] = Breadcrumb::memberFactory($member);
    $breadcrumbs[2]                              = new Breadcrumb('Maintainers',
      '@schema_schemauser_list?schema_id=' . $schema->getId(),
      $member->getNickname(),
      '');

    //there's always a breadcrumb
    $this->breadcrumbs = $breadcrumbs;
  }


  public function executeVocabuser()
  {
    $id = $this->getRequestParameter('id');
    /** @var VocabularyHasUser $vocabHasUser */
    $vocabHasUser = $this->vocabulary_has_user;
    $vocabulary   = $vocabHasUser->getVocabulary();
    $member       = $vocabHasUser->getUser();
    $requestStack = $this->getUser()->getAttribute('request_stack', '', 'sfRefererPlugin');
    $refererRoute = isset( $requestStack['last_route'] ) ? $requestStack['last_route'] : 0;
    $tabnav       = $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }

    $breadcrumbs[$refererRoute == 'user_vocabulary'] = Breadcrumb::vocabularyFactory($vocabulary);
    $breadcrumbs[$refererRoute != 'user_vocabulary'] = Breadcrumb::memberFactory($member);
    $breadcrumbs[2]                                            = new Breadcrumb('Maintainers',
      '@vocabulary_vocabuser_list?vocabulary_id=' . $vocabulary->getId(),
      $member->getNickname(),
      '');

    //there's always a breadcrumb
    $this->breadcrumbs = $breadcrumbs;
  }


    public function executeSchemaprop()
    {
        $id = $this->getRequestParameter('schema_property_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@schemaprop_show?id=' . $id ];
        $topnav[]   = [ 'title' => 'Statements', 'link' => '@schemaprop_schemapropel_list?schema_property_id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@schemaprop_schemahistory_list?schema_property_id=' . $id ];
        $this->tabs = self::getModulesForRoutes($topnav);

        $element         = isset( $this->schema_property ) ? $this->schema_property : SchemaPropertyPeer::retrieveByPK($id);
        $breadcrumbs[0]    = Breadcrumb::elementSetFactory($element->getSchema());
        $breadcrumbs[1]    = Breadcrumb::elementFactory($element, true);
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeSchemapropel()
    {
        $id = $this->getRequestParameter('schema_property_element_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        $topnav[]   = [ 'title' => 'Details', 'link' => '@schemapropel_show?id=' . $id ];
        $topnav[]   = [ 'title' => 'History', 'link' => '@schemapropel_schemahistory_list?schema_property_element_id=' . $id ];
        $this->tabs = self::getModulesForRoutes($topnav);

        $statement         = isset( $this->schema_property_element )
            ? $this->schema_property_element
            : SchemaPropertyElementPeer::retrieveByPK($id);
        $element           = $statement->getSchemaPropertyRelatedBySchemaPropertyId();
        $breadcrumbs[0]    = Breadcrumb::elementSetFactory($element->getSchema());
        $breadcrumbs[1]    = Breadcrumb::elementFactory($element);
        $breadcrumbs[2]    = Breadcrumb::statementFactory($statement, true);
        $this->breadcrumbs = $breadcrumbs;
    }


  public function executeImport()
  {
    $id = $this->getRequestParameter('import_id');
    if ( ! $id) {
      $id = $this->getRequestParameter('id');
    }

    /** @var FileImportHistory $history */
    $history    = ( isset( $this->file_import_history ) ) ? $this->file_import_history : FileImportHistoryPeer::retrieveByPK($id);
    $vocabulary = $history->getVocabulary();
    $schema     = $history->getSchema();

    $topnav[] = [ 'title' => 'Details', 'link' => '@import_show?id=' . $id ];
    if ($history) {
      if ($schema) { //it's an elementset
        $topnav[]       = [ 'title' => 'History', 'link' => '@import_schemahistory_list?import_id=' . $id ];
        $breadcrumbs[0] = Breadcrumb::elementSetFactory($schema);
        $breadcrumbs[1] = Breadcrumb::importElementSetFactory($history, true);
      }
      if ($vocabulary) { //it's a vocabulary
        $topnav[]       = [ 'title' => 'History', 'link' => '@import_history_list?import_id=' . $id ];
        $breadcrumbs[0] = Breadcrumb::vocabularyFactory($vocabulary);
        $breadcrumbs[1] = Breadcrumb::importVocabularyFactory($history, true);
      }
    }

    $this->tabs        = self::getModulesForRoutes($topnav);
    $this->breadcrumbs = $breadcrumbs;
  }


  public function executeExport()
  {
    $tabnav = $this->getRequestParameter('tabnav');
    if ($tabnav) {
      $tabnav = 'execute' . ucfirst($tabnav);
      $this->$tabnav();
    }

    // $id = $this->getRequestParameter('export_id');
    // if ( ! $id) {
    //   $id = $this->getRequestParameter('id');
    // }
    //
    // /** @var ExportHistory $history */
    // $history    = ( isset( $this->export_history ) ) ? $this->export_history : FileImportHistoryPeer::retrieveByPK($id);
    // $vocabulary = $history->getVocabulary();
    // $schema     = $history->getSchema();
    //
    // $topnav[] = [ 'title' => 'Details', 'link' => '@import_show?id=' . $id ];
    // if ($history) {
    //   if ($schema) { //it's an elementset
    //     $topnav[]       = [ 'title' => 'History', 'link' => '@schema_exports?export_id=' . $id ];
    //     $breadcrumbs[0] = Breadcrumb::elementSetFactory($schema);
    //     $breadcrumbs[1] = Breadcrumb::importElementSetFactory($history, true);
    //   }
    //   if ($vocabulary) { //it's a vocabulary
    //     $topnav[]       = [ 'title' => 'History', 'link' => '@vocabulary_exports?export_id=' . $id ];
    //     $breadcrumbs[0] = Breadcrumb::vocabularyFactory($vocabulary);
    //     $breadcrumbs[1] = Breadcrumb::importVocabularyFactory($history, true);
    //   }
    // }
    //
    // $this->tabs        = self::getModulesForRoutes($topnav);
    // $this->breadcrumbs = $breadcrumbs;
  }


  public function executeUser()
    {
        $id = $this->getRequestParameter('user_id');
        if ( ! $id) {
            $id = $this->getRequestParameter('id');
        }
        if ($id) {
            $topnav[]       = [ 'title' => 'Details', 'link' => '@user_show?id=' . $id ];
            $topnav[]       = [ 'title' => 'Agents', 'link' => '@user_agentuser_list?user_id=' . $id ];
            $topnav[]       = [ 'title' => 'Vocabularies', 'link' => '@user_vocabuser_list?user_id=' . $id ];
            $topnav[]       = [ 'title' => 'Element Sets', 'link' => '@user_schemauser_list?user_id=' . $id ];
            $this->tabs     = self::getModulesForRoutes($topnav);
            $member          = isset( $this->user ) ? $this->user : UserPeer::retrieveByPK($id);
            $breadcrumbs[0] = Breadcrumb::memberFactory($member, true);
        } else { //there's no id so it's a list of everything
            $breadcrumbs[0] = Breadcrumb::listFactory('Members');
        }

        //there's always a breadcrumb
        $this->breadcrumbs = $breadcrumbs;
    }


    public function executeAgent()
    {
      $id = $this->getRequestParameter('agent_id');
      if ( ! $id) {
        $id = $this->getRequestParameter('id');
      }
      if ($id) {
        $topnav[]   = [ 'title' => 'Details', 'link' => '@agent_show?id=' . $id ];
        $topnav[]   = [ 'title' => 'Members', 'link' => '@agent_agentuser_list?agent_id=' . $id ];
        $topnav[]   = [ 'title' => 'Vocabularies', 'link' => '@agent_vocabulary_list?agent_id=' . $id ];
        $topnav[]   = [ 'title' => 'Element Sets', 'link' => '@agent_schema_list?agent_id=' . $id ];
        $this->tabs = self::getModulesForRoutes($topnav);

        $agent          = isset( $this->agent ) ? $this->agent : AgentPeer::retrieveByPK($id);
        $breadcrumbs[0] = Breadcrumb::agentFactory($agent, true);
      } else { //there's no id so it's a list of everything
        $breadcrumbs[0] = Breadcrumb::listFactory('Agents');
      }

      //there's always a breadcrumb
      $this->breadcrumbs = $breadcrumbs;
    }


  public static function getModulesForRoutes($topnav)
  {
    foreach ($topnav as &$tab) {
      $routeName = preg_replace('#^\@(.*)\?.*$#uiUs', "$1", $tab['link']);
      if ($routeName) {
        $tab = self::parseRouteName($routeName, $tab);
        if (strstr($routeName, '_list')){
          $route = sfRouting::getInstance()->getRouteByName($routeName);
          $tab['list_module'] = $route[4]['module'];
        }
        //take the middle of the route, if there is one, and add show to it
      }
    }
    return $topnav;
  }


  private static function parseRouteName($routeName, $tab)
  {
    $routeParts = explode('_', $routeName);
    //the action is always the highest part
    $routeAction = array_pop($routeParts);
    //the module for create, show, edit, list is always the one next to the action
    $actionModule = array_pop($routeParts);

    if ($routeAction == 'show') {
      $tab['show_module'] = $actionModule;
      $tab['edit_module'] = $actionModule;
      $tab['create_module'] = $actionModule;

      return $tab;
    }
    //in tabs there are only show and list actions predefined
    $tab['list_module'] = $actionModule;

    //add the action modules for matching
    foreach ([ 'create', 'edit', 'show' ] as $action) {
      $tabAction = $action . '_module';
      //allow override in the tab setup
      if ( ! isset( $tab[$tabAction] )) {
        $tab[$tabAction] = $actionModule;
      }
    }

    return $tab;
  }
}

