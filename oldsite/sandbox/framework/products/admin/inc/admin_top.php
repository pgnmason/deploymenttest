<?php

$config_path = dirname(dirname(dirname(__FILE__)))."/inc/php/config/";
$inc_root = dirname(dirname(dirname(__FILE__)))."/inc/php";

require(dirname(dirname(dirname(__FILE__)))."/inc/php/files/functions.php"); 
if(!Authorization::loggedIn() && basename($_SERVER['SCRIPT_NAME']) !== "login.php"){ header("Location:login.php"); }



?>