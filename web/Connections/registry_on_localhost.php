<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_registry_on_localhost = "localhost";
$database_registry_on_localhost = "registry";
$username_registry_on_localhost = "root";
$password_registry_on_localhost = "RegIt!";
$registry_on_localhost = mysql_pconnect($hostname_registry_on_localhost, $username_registry_on_localhost, $password_registry_on_localhost) or trigger_error(mysql_error(),E_USER_ERROR); 
?>