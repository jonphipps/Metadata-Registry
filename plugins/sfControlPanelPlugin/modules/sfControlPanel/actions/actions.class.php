<?php

/**
 * sfControlPanel actions.
 *
 * @package    sfControlPanelPlugin
 * @author     François Zaninotto
 */
class sfControlPanelActions extends sfActions
{

  public function preExecute()
  {
    $this->getResponse()->addStylesheet('/sfControlPanelPlugin/css/control_panel', 'last');
    $this->getResponse()->setTitle('symfony control panel');
  }

  public function executeDataManager()
  {
    $this->setLayout(sfLoader::getTemplateDir('sfControlPanel', 'layout.php').'/layout');
    if($files = sfFinder::type('file')->name("*Peer.php")->relative()->prune('om')->ignore_version_control()->in(SF_ROOT_DIR.'/lib/model'))
    {
      $this->model_files = $files;
    }    
  }

  public function executeTableManager()
  {
    $class = $this->getRequestParameter('class');
    $generator_configuration = array(
      'model_class' =>  $class,
      'theme'       => 'sfControlPanel',
      'moduleName'  => $class.'ControlPanel',
      'list' => array(
          'title' => $class.' list',
      ),
      'edit' => array(
          'title' => 'edit '.$class,
      ),
    );
    if(file_exists(SF_ROOT_DIR.'/config/sfControlPanel_generator.yml'))
    {
      $custom_configuration = sfYaml::load(SF_ROOT_DIR.'/config/sfControlPanel_generator.yml');
      if(isset($custom_configuration[$class]))
      {
        $generator_configuration = sfToolkit::arrayDeepMerge($generator_configuration, $custom_configuration[$class]); 
      }
    }
    $generatorManager = new sfGeneratorManager();
    $generatorManager->initialize(); 
    $data = $generatorManager->generate('sfControlPanelGenerator', $generator_configuration);
    $this->redirect('auto'.$class.'ControlPanel/list');
  }
  
  public function executeTaskManager()
  {
    $this->setLayout(sfLoader::getTemplateDir('sfControlPanel', 'layout.php').'/layout');
    $controllers    = sfFinder::type('file')->relative()->ignore_version_control()->maxdepth(1)->name('*.php')->in(SF_ROOT_DIR.'/web');
    $apps           = sfFinder::type('dir')->relative()->ignore_version_control()->maxdepth(0)->in(SF_ROOT_DIR.'/apps');
    $environments   = array();
    foreach ($apps as $app)
    {
      foreach ($controllers as $controller)
      {
        $contents = file_get_contents(SF_ROOT_DIR.'/web/'.$controller);
        preg_match('/\'SF_APP\',[\s]*\''.$app.'\'\)/', $contents, $found_app);
        preg_match_all('/\'SF_ENVIRONMENT\',[\s]*\'(.*)\'\)/', $contents, $envs);
        if (isset($found_app[0]) && isset($envs[1][0]))
        {
          $environments[$app][$envs[1][0]] = $controller;
        }
      }
    }
    $this->controllers    = $controllers;
    $this->apps           = $apps;
    $this->environments   = $environments;
    if($files = sfFinder::type('file')->name("*Peer.php")->relative()->prune('om')->ignore_version_control()->in(SF_ROOT_DIR.'/lib/model'))
    {
      $this->model_files = $files;
    }
    if($files = sfFinder::type('file')->name("*.php")->maxdepth(3)->relative()->ignore_version_control()->in(SF_ROOT_DIR.'/batch'))
    {
      $this->batches = $files;
    }
  }
  
  public function executeTaskExecute()
  {
    if(!$this->getRequest()->isXmlHttpRequest())
    {
      $this->getResponse()->getParameterHolder()->removeNamespace('helper/asset/auto/stylesheet/last'); 
    }
    $this->php_cli = sfToolkit::getPhpCli();
    
    if($batch = $this->getRequestParameter('batch'))
    {
      $command = sprintf('%s "%s"', $this->php_cli, SF_ROOT_DIR.'/batch/'.$batch);
      $visible_command = 'php '.$batch; 
    }
    else
    {
      $command = $this->getRequestParameter('freetask');
      if(!$command)
      {
        if($args = $this->getRequestParameter('arg'))
        {
          ksort($args);
          $args = implode(' ', $args);
        }
        else
        {
          $args = '';
        }
        $command  = $this->getRequestParameter('task').' '.$args;
      }
      $visible_command = 'symfony '.$command; 
      $command = sprintf('%s "%s" %s', $this->php_cli, SF_ROOT_DIR.'/symfony', $command);
    }
    
    ob_start();
    passthru($command, $return);
    $content = ob_get_clean();

    $this->command = $visible_command;
    $this->output = $content;
  }
  
  public function executeIndex()
  {
    $this->setLayout(sfLoader::getTemplateDir('sfControlPanel', 'layout.php').'/layout');
    $controllers    = sfFinder::type('file')->relative()->ignore_version_control()->maxdepth(1)->name('*.php')->in(SF_ROOT_DIR.'/web');
    $apps           = sfFinder::type('dir')->relative()->ignore_version_control()->maxdepth(0)->in(SF_ROOT_DIR.'/apps');
    $environments   = array();
    $modules        = array();
    $module_actions        = array();
    $module_templates      = array();
    $model_methods         = array();
    $app_templates  = array();
    foreach ($apps as $app)
    {
      foreach ($controllers as $controller)
      {
        $contents = file_get_contents(SF_ROOT_DIR.'/web/'.$controller);
        preg_match('/\'SF_APP\',[\s]*\''.$app.'\'\)/', $contents, $found_app);
        preg_match_all('/\'SF_ENVIRONMENT\',[\s]*\'(.*)\'\)/', $contents, $envs);
        if (isset($found_app[0]) && isset($envs[1][0]))
        {
          $environments[$app][$envs[1][0]] = $controller;
        }
      }
      $modules[$app] = sfFinder::type('dir')->maxdepth(0)->relative()->ignore_version_control()->in(SF_ROOT_DIR.'/apps/'.$app.'/modules'); 
      foreach ($modules[$app] as $module)
      {
        $action_files = sfFinder::type('file')->name('*action*.class.php')->maxdepth(0)->ignore_version_control()->relative()->in(SF_ROOT_DIR.'/apps/'.$app.'/modules/'.$module.'/actions'); 
        foreach ($action_files as $action_file)
        {
          preg_match_all('/function\s+execute(.*)\(\)/', file_get_contents(SF_ROOT_DIR.'/apps/'.$app.'/modules/'.$module.'/actions/'.$action_file), $action_names); 
          foreach ($action_names[1] as $action_name)
          {
            $module_actions[$app][$module][$action_name] = $action_file;
          }
        }
        if(isset($module_actions[$app][$module]))
        {
          ksort($module_actions[$app][$module]);
        }
        if($files = sfFinder::type('file')->name('*.php')->maxdepth(0)->relative()->ignore_version_control()->in(SF_ROOT_DIR.'/apps/'.$app.'/modules/'.$module.'/templates'))
        {
          $module_templates[$app][$module] = $files;
        }
      }
      
      if($files = sfFinder::type('file')->relative()->ignore_version_control()->in(SF_ROOT_DIR.'/apps/'.$app.'/templates'))
      {
        $app_templates[$app] = $files;
      }
    }
    if($files = sfFinder::type('file')->name("*schema.*")->maxdepth(3)->relative()->prune('web')->prune('lib')->prune('data')->ignore_version_control()->in(SF_ROOT_DIR))
    {
      $this->schema_files = $files;
    }
    if($files = sfFinder::type('file')->name('databases.yml')->maxdepth(3)->relative()->prune('lib')->prune('data')->ignore_version_control()->in(SF_ROOT_DIR))
    {
      $this->connection_files = $files;
    }
    if($files = sfFinder::type('file')->name("*Peer.php")->relative()->prune('om')->ignore_version_control()->in(SF_ROOT_DIR.'/lib/model'))
    {
      $this->model_files = $files;
    }
    foreach($files as $model_file)
    {
      $model = substr($model_file, 0, strlen($model_file)-8);
      preg_match_all('/function\s+(.*?)\(/', file_get_contents(SF_ROOT_DIR.'/lib/model/'.$model_file), $model_names); 
      foreach ($model_names[1] as $model_name)
      {
        $model_methods[$model]['peer'][$model_name] = array('lib/model/'.$model_file, 'custom');
      }
      preg_match_all('/function\s+(.*?)\(/', file_get_contents(SF_ROOT_DIR.'/lib/model/om/Base'.$model_file), $model_names); 
      foreach ($model_names[1] as $model_name)
      {
        if(!isset($model_methods[$model]['peer'][$model_name]))
        {
          $model_methods[$model]['peer'][$model_name] = array('lib/model/om/Base'.$model_file, 'base');
        }
      }
      ksort($model_methods[$model]['peer']);
      preg_match_all('/function\s+(.*?)\(/', file_get_contents(SF_ROOT_DIR.'/lib/model/'.$model.'.php'), $model_names); 
      foreach ($model_names[1] as $model_name)
      {
        $model_methods[$model]['object'][$model_name] = array('lib/model/'.$model.'.php', 'custom');
      }
      preg_match_all('/function\s+(.*?)\(/', file_get_contents(SF_ROOT_DIR.'/lib/model/om/Base'.$model.'.php'), $model_names); 
      foreach ($model_names[1] as $model_name)
      {
        if(!isset($model_methods[$model]['object'][$model_name]))
        {
          $model_methods[$model]['object'][$model_name] = array('lib/model/om/Base'.$model.'.php', 'base');
        }
      }
      ksort($model_methods[$model]['object']);
    }
    if($files = sfFinder::type('dir')->maxdepth(0)->relative()->ignore_version_control()->in(SF_ROOT_DIR.'/plugins'))
    {
      $this->plugins = $files;
    }
    $this->sf_version     = file_get_contents(sfConfig::get('sf_symfony_lib_dir').'/VERSION');    
    $this->controllers    = $controllers;
    $this->apps           = $apps;
    $this->environments   = $environments;
    $this->modules        = $modules;
    $this->module_actions = $module_actions;
    $this->module_templates = $module_templates;
    $this->app_templates  = $app_templates;
    $this->model_methods  = $model_methods;
  }

    
  public function executeShowFile()
  {
    $this->forward404Unless($this->retrieveFile());
  }
  
  private function retrieveFile()
  {
    if(!$filename = str_replace('%%', '.', $this->getRequestParameter('filename')))
    {
      return false;
    }    
    $file = realpath(SF_ROOT_DIR.'/'.$filename);
    $this->logMessage($file, 'debug');
    if(!(0 === strpos($file, SF_ROOT_DIR) && file_exists($file)))
    {
      return false;
    }
    $this->filename = $filename;
    if('.php' == substr($file, -4))
    {
      $file = highlight_file($file, true);
      $file = preg_replace('/function&nbsp;<\/span><span style="color: #0000BB">(.+?)(&nbsp;)*(\s*)<\/span>/m', 'function&nbsp;</span><span style="color: #0000BB" id="function_${1}">${1}${2}${3}</span>', $file);
    }
    else
    {
      $file = '<pre>'.htmlentities(file_get_contents($file), ENT_QUOTES, 'UTF-8').'</pre>';
    }
    $this->file = $file;
    return true;
  }
  
  public function executeFileBrowser()
  {
    $this->setLayout(sfLoader::getTemplateDir('sfControlPanel', 'layout.php').'/layout');
    $line = array();
    $lines = array();
    $previous_dirs = array();  
    $files = sfFinder::type('file')->relative()->ignore_version_control()->discard('.sf')->prune('cache')->prune('symfony')->in(SF_ROOT_DIR); 
    foreach($files as $file)
    {
      $file = str_replace('\\', '/', $file);
      $line['path'] = $file;
      $dirs = explode ('/', $file);
      $line['filename'] = array_pop($dirs);
      $temp_dirs = $dirs;
      foreach($dirs as $dir)
      {
        if($previous_dirs && $dir == $previous_dirs[0])
        {
          array_shift($previous_dirs); 
          array_shift($dirs);
        } 
      }
      foreach($dirs as $dir)
      {
        $line['open'][] = $dir;        
      }
      foreach($previous_dirs as $dir)
      {
        $line['close'][] = $dir;        
      }
      $lines[] = $line;
      $line = array();
      $previous_dirs = $temp_dirs;
    }
    
    $this->lines = $lines;
    $this->retrieveFile();
  }
  
  public function executeConfigShow()
  {
    $this->setLayout(sfLoader::getTemplateDir('sfControlPanel', 'layout.php').'/layout');
    $config = sfConfig::getAll();
    ksort($config);
    $this->config = $config;
  }

}
