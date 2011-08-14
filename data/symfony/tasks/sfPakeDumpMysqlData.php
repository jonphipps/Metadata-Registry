<?php

pake_desc('dumps all data from mysql');
pake_task('mysql-dump-data', 'project_exists');

pake_desc('loads all data from mysql');
pake_task('mysql-load-data', 'project_exists');

pake_desc('propel-build-all without losing data');
pake_task('propel-build-all-save-mysql', 'project_exists');
//debugbreak();
function run_mysql_dump_data($task, $args) {

    $config = set_database($task, $args);

    $thecmd = $config['mysqldump'] . ' -u '.$config['username'].' --password='.$config['password'].' '.$config['database'].' --opt --no-create-db';

    $output = array('SET FOREIGN_KEY_CHECKS = 0;', 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";','SET AUTOCOMMIT=0;','START TRANSACTION;');

    exec($thecmd, $output);

    array_push($output,'SET FOREIGN_KEY_CHECKS = 1;','COMMIT;');

    $output = implode("\n", $output);

    try {
        $newfile = $config['backupFile'];
        $file = fopen ($newfile, "w");
        fwrite($file, $output);
        fclose ($file);
    } catch(Exception $e) {
        throw new Exception('The following problem occured while attempting to write the sql dump file:'."\n".$e->getMessage()."\n");
    }

    echo "\n\ndump written to: ".$newfile;

}

function run_mysql_load_data($task, $args) {
    //debugbreak();

    $config = set_database($task, $args);
    //global $config;
    //$sf_root_dir = sfConfig::get('sf_root_dir');
    //$sql_data_dir = $sf_root_dir.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'sql';
    $newfile = $config['backupFile'];
    echo 'executing ' . $newfile . "\n\n";
    $thecmd =  $config['mysql'] . ' -u ' . $config['username'] . ' --password=' . $config['password'] . ' ' . $config['database'] . ' < ' . $newfile;
    echo $thecmd . "\n\n";
    passthru($thecmd);

    echo "dump loaded from: " . $newfile . "\n\n";

}

function run_propel_build_all_save_mysql($task, $args) {

    run_mysql_dump_data($task, $args);
    passthru('symfony propel-build-all');
    run_mysql_load_data($task, $args);

}

function set_database($task, $args) {

  if (!count($args))
  {
    throw new Exception('You must provide the app.');
  }

  $app = $args[0];

  if (!is_dir(sfConfig::get('sf_app_dir').DIRECTORY_SEPARATOR.$app))
  {
    throw new Exception('The app "'.$app.'" does not exist.');
  }

  if (count($args) > 1 && $args[count($args) - 1] == 'append')
  {
    array_pop($args);
    $delete = false;
  }
  else
  {
    $delete = true;
  }

  $env = empty($args[1]) ? 'test' : $args[1];

  // define constants
  define('SF_ROOT_DIR',    sfConfig::get('sf_root_dir'));
  define('SF_APP',         $app);
  define('SF_ENVIRONMENT', $env);
  define('SF_DEBUG',       true);

  // get configuration
  require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

  if (count($args) == 1)
  {
    if (!$pluginDirs = glob(sfConfig::get('sf_root_dir') . '/plugins/*/data'))
    {
      $pluginDirs = array();
    }
    $fixtures_dirs = pakeFinder::type('dir')->ignore_version_control()->name('fixtures')->in(array_merge($pluginDirs, array(sfConfig::get('sf_data_dir'))));
  }
  else
  {
    $fixtures_dirs = array_slice($args, 1);
  }

   $db = new sfDatabaseManager();
   $db->initialize();
   $db = $db->getDatabase('propel');

  $config = array(
    'hostname'       => $db->getParameter('hostspec'),
    'database'       => $db->getParameter('database'),
    'username'       => $db->getParameter('username'),
    'password'       => $db->getParameter('password'),

    'mysql'          => sfConfig::get('app_mysql_command'),
    'mysqldump'      => sfConfig::get('app_mysqldump_command'),
    'backupPath'     => SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'functional' . DIRECTORY_SEPARATOR . 'fixtures'
  );

  $config['backupFilename'] = $config['database'] . '_dump.sql';
  $config['backupFile']     = $config['backupPath'] . DIRECTORY_SEPARATOR . $config['backupFilename'];

  return $config;

}

