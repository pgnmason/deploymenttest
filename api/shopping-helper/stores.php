<?php
require("lib/jsonloader.php");
require("lib/ajaxresponse.php");
//parse_str(implode('&', array_slice($argv, 1)), $_GET);
$loader = new JSONLoader("json","individual_files");

$response = new AjaxResponse();

$output = $loader->getStoreList();

if($output){
	$response->code=200;
	$response->status="ok";
	$response->message="success";
	$response->data = $output;
}else{
	$response->code=501;
	$response->message="Internal Error";
}

 header("Access-Control-Allow-Origin: *");
 header('Content-Type: application/json');
echo json_encode($response);
?>