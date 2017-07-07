<?
/*
Filename: connection.php
Purpose: Connects to database using data from config.php

*/

if($use_db){
$link = mysql_connect($db_host, $db_user, $db_pass); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
//echo 'Connected successfully'; 
mysql_select_db($db_name); 

$db = new Database();
}


?>