<?php
   $hostname = "localhost";
   $database = "swregistry2";
   $username = "root";
   $password = "RegIt!";

   $mysqlLocation = "mysql";
   $backupPath = 'C:\\web\\registry\\test\\functional\\fixtures\\';
   $backupFilename = "swregistry2.sql";
   $backupFile = $backupPath.$backupFilename;

// Loading command:
   $command = $mysqlLocation.' -h'.$hostname.' -u'.$username.' -p'.$password.' '.$database.'  < '.$backupFile;

   system($command);

   //reload the main page
   header('location: http://registry');

?>
