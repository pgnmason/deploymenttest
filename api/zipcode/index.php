<?php
ini_set("display_errors", 1);
$config_path = dirname(__FILE__)."/../flip/app/php/config/";
$inc_root = dirname(__FILE__)."/../flip/app/php";

require(dirname(__FILE__)."/../flip/app/php/files/functions.php"); 
loadComponent("ajaxresponse");
$response = new AjaxResponse();

if(!empty($_GET['zip']) && is_numeric($_GET['zip'])){
	$zip_code = Request::getVar("zip","get",false);
	$zip_code = trim($zip_code);
	if(!$zip_code){
		$response->code=433;
		$response->message="Missing Parameters";
	}else if(!is_numeric($zip_code)){
		$response->code = 431;
		$response->message = "Invalid Parameters";
	}else{
		$db = Factory::getDBO();
	 	$zip_code = $db->sanitize($zip_code);
	 	$db->setQuery("SELECT * FROM zip_codes WHERE zip_code = ".$zip_code." LIMIT 1");
	 	$data = $db->loadObject();

		if($data){
			$response->code=200;
			$response->status="ok";
			$response->message="success";
			$response->data = $data;
		}else{
			$response->code=501;
			$response->message="Internal Error";
		}
	} 	//echo $db->getQuery();
}

header('Content-Type: application/json');
echo json_encode($response)

?>