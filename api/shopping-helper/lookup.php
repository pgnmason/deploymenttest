<?php
require("lib/jsonloader.php");
require("lib/ajaxresponse.php");

//var_dump($argv);
if($argv[1] && $argv[1] == "debug"){
//	echo "IN HERE";
	parse_str(implode('&', array_slice($argv, 2)), $_GET);
}


$loader = new JSONLoader("json","stores");

$response = new AjaxResponse();

if(!empty($_GET['q']) && ((!empty($_GET['lon']) && !empty($_GET['lat'])) || !empty($_GET['zip']))){
	
	if(!empty($_GET['lon']) && !empty($_GET['lat'])){
		$lat = $_GET['lat'];
		$lon = $_GET['lon'];
	}else{
		$zip = $_GET['zip'];
		$res = DistanceLib::lookupZipcode($zip);
		if(!$res){
			die("Could not find Zip");
		}
		$lat = $res->latitude;
		$lon = $res->longitude;
	}


	if(!empty($_GET['radius'])){
		$distance = intval($_GET['radius']);
	}else{
		$distance = 25;
	}

	$locations = $loader->getStoreData($_GET['q']);
	$storeinfo = $loader->loadStoreLocations($locations);
	$candidates = array();

	foreach ($storeinfo as $key => $value) {
		$locator = new StoreLocator($value);
		$locator->setDistance($distance);
		$results = $locator->nearbyStores($lat,$lon);
		array_push($candidates,$results);
	}
	
	$clusters = new NodeBuilder($candidates,$lat,$lon);
	$output = $clusters->getClusters();
	if($output){
		$response->code=200;
		$response->status="ok";
		$response->message="success";
		$response->data = $output;
	}else{
		$response->code=501;
		$response->message="Internal Error";
	}
}
 header("Access-Control-Allow-Origin: *");
 header('Content-Type: application/json');
echo json_encode($response);
?>