<?php
ini_set("display_errors", 1);
$config_path = dirname(__FILE__)."/../flip/app/php/config/";
$inc_root = dirname(__FILE__)."/../flip/app/php";

require(dirname(__FILE__)."/../flip/app/php/files/functions.php"); 
if(!empty($_GET['zip']) && is_numeric($_GET['zip'])){

	var_dump($_GET['zip']);
	$db = Factory::getDBO();
 	/*if($c = self::checkCache($zip_code,$radius) && false){
 		return $c;
 	}*/
 	$zip_code = $db->sanitize($zip_code);
 	$db->setQuery("SELECT * FROM zip_codes WHERE zip_code = ".$zip_code." LIMIT 1");
 	$loc = $db->loadObject();

 	//echo $db->getQuery();
 	echo json_encode($loc);
}else{
	die("SOMETHING IS WRONG");
}
?>