<?
/*
Filename: connection.php
Purpose: Connects to database using data from config.php

*/

if($use_db){
$con = mysql_connect($db_host,$db_user,$db_pass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name, $con);

$db = new Database();
}


function db_connect($db_host = false,$db_user = false,$db_pass = false,$db_name = false){
	global $con;
	mysql_close($con);
	
	if(!$db_host){
		global $db_host,$db_user,$db_pass,$db_name;
	}
	$con = mysql_connect($db_host,$db_user,$db_pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db($db_name, $con);
}


function db_disconnect(){
	global $con; 
	mysql_close($con);
}
?>