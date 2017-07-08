<?php
ini_set("display_errors", 1);
$config_path = dirname(__FILE__)."/../flip/app/php/config/";
$inc_root = dirname(__FILE__)."/../flip/app/php";

require(dirname(__FILE__)."/../flip/app/php/files/functions.php"); 
loadComponent("ajaxresponse");
$task = Request::getVar("task","get",false);

$response = new AjaxResponse();


switch ($task) {
	case 'lookup':
		# code...
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

		break;
	case "nearest":
		$lat = Request::getVar("lat","get",false);
		$lng = Request::getVar("lng","get",false);
		$lat = trim($lat);
		$lng = trim($lng);

		if(!$lat || !$lng){
			$response->code=433;
			$response->message="Missing Parameters";
		}else if(!is_numeric($lat) || !is_numeric($lng)){
			$response->code = 431;
			$response->message = "Invalid Parameters";
		}else{
			$db = Factory::getDBO();
		 	$lat = $db->sanitize($lat);
		 	$lng = $db->sanitize($lng);
		 	
		 	$db->setQuery('SELECT *, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM zip_codes HAVING distance < 2 ORDER BY distance limit 1');
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
		break;
}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($response)

?>