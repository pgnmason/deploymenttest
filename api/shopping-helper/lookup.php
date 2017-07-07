<?php
require("lib/jsonloader.php");
$loader = new JSONLoader("json","individual_files");
parse_str(implode('&', array_slice($argv, 1)), $_GET);

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

	echo $distance;

	$locations = $loader->getStoreData($_GET['q']);
	//var_dump($locations);
	$storeinfo = $loader->loadStoreLocations($locations);
	//var_dump($storeinfo);
	$candidates = array();

	foreach ($storeinfo as $key => $value) {
		$locator = new StoreLocator($value);
		$locator->setDistance($distance);
		$results = $locator->nearbyStores($lat,$lon);
		array_push($candidates,$results);
	}

	$clusters = new NodeBuilder($candidates);
	$output = $clusters->getClusters();
	var_dump($clusters->getClusters());
}
?>