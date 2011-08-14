<?php
$hostname = "localhost";
$database = "swregistry";
$username = "root";
$password = "RegIt!";
$mysqlLocation = '"C:\\Program Files\\MySQL\\MySQL Server 5.0\\bin\\mysql.exe"';   // Uses value in Conf.inc.php.
$mysqldumpLocation = '"C:\\Program Files\\MySQL\\MySQL Server 5.0\\bin\\mysqldump.exe"';   // Uses value in Conf.inc.php.
$backupFile = "C:\\web\\registry\\data\\fixtures\\test_data.ctd";   // Uses value in Conf.inc.php.

function loadDatabase()
{
  $hostname = "localhost";
  $database = "swregistry_test";
  $username = "root";
  $password = "RegIt!";
  $mysqlLocation = '"C:\\Program Files\\MySQL\\MySQL Server 5.0\\bin\\mysql.exe"';   // Uses value in Conf.inc.php.
  $backupFile = "C:\\web\\registry\\data\\fixtures\\test_data.ctd";   // Uses value in Conf.inc.php.
  $command = $mysqlLocation.' -h'.$hostname.' -u'.$username.' -p'.$password.' '.$database.'  < '.$backupFile;

  system($command);
}

function saveDatabase()
{
  $hostname = "localhost";
  $database = "swregistry";
  $username = "root";
  $password = "RegIt!";
  $mysqldumpLocation = '"C:\\Program Files\\MySQL\\MySQL Server 5.0\\bin\\mysqldump.exe"';   // Uses value in Conf.inc.php.
  $backupFile = "C:\\web\\registry\\data\\fixtures\\test_data.ctd";   // Uses value in Conf.inc.php.
  $command = $mysqldumpLocation.' --tables -h'.$hostname.' -u'.$username.' -p'.$password.' '.$database.' reg_vocabulary_has_user reg_concept_history reg_concept_property reg_lookup reg_skos_property reg_concept reg_status reg_vocabulary reg_agent_has_user reg_user reg_agent  > '.$backupFile;

  system($command);
}
?>
