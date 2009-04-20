<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
   $db = new sfDatabaseManager();
   $db->initialize();
   $db = $db->getDatabase('propel');

   $hostname       = $db->getParameter('hostspec');
   $database       = $db->getParameter('database');
   $username       = $db->getParameter('username');
   $password       = $db->getParameter('password');

   $mysqlLocation  = sfConfig::get('app_mysql_command');
   $backupFilename = sfConfig::get('app_db_load_filename');

   $backupPath     = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'test'.DIRECTORY_SEPARATOR.'functional'.DIRECTORY_SEPARATOR.'fixtures';
   $backupFile     = $backupPath.DIRECTORY_SEPARATOR.$backupFilename;

// Loading command:
   $command = $mysqlLocation.' -h'.$hostname.' -u'.$username.' -p'.$password.' '.$database.'  < '.$backupFile;

   system($command);

   //reload the main page
   header('location: http://registry');

?>
