<?php

class DistanceLib{

	public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
}

class JSONLoader{
	private $path = "json";
	private $files_path = "json";

	function __construct($directory=false,$fpath=false){
		if($directory){
			$this->path = $directory;
		}
		if($fpath){
			$this->files_path = $this->path."/".$fpath;
		}

		if(!file_exists($this->path."/stores.json")){
			throw new Exception("Could Not Find Stores File", 1);
			return false;
		}
	}

	public function getStoreData($input){
		$data = json_decode(file_get_contents($this->path."/stores.json"));
		$names = explode(",", $input);
		$res = false;
		foreach ($names as $name) {
			foreach($data as $k=>$v){
				if(stristr($k, $name) ||stristr($v->name, $name)){
					$res = (!empty($res)) ? $res : array();
					array_push($res, $v);
				}
			}
		}
		return $res;
	}

	public function loadStoreLocations($stores = array()){
		$results = new stdClass();
		foreach($stores as $store){
			$key = $store->code;
			try {
				if(!file_exists($this->files_path."/".$key.".json")){
					throw new Exception("Could Not Find Store File ".$this->files_path."/".$key.".json", 1);
					continue;
				}
				$data = json_decode(file_get_contents($this->files_path."/".$key.".json"));
				$locations = array();
				foreach ($data as $s) {
					$thestore = new Store($s);
					$thestore->setChain($store->name);
					$thestore->setCode($store->code);
					array_push($locations, $thestore);
				}

				$store->locations = $locations;
				$results->$key = $store;
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		return $results;
	}


	public function lookupZipcode($zip){

	}

	public function nearbyStores($lat,$lon,$threshold=25){

	}

}




class StoreLocator{
	private $dict;
	private $units = "M";
	private $distance = 25;

    function __construct($dict=false){
    	if($dict){
    		$this->dict = $dict;
    	}
    }

    function setDistance($distance){
    	$this->distance = $distance;
    }

    public function nearbyStores($lat,$lon){
    	$output = new stdClass();
    	$locations = array();
    	foreach ($this->dict->locations as $store) {
    		if($store->isNearby($lat,$lon,$this->distance)){
    			array_push($locations, $store);
    		}
    	}
    	$output->chain_name = $this->dict->name;
    	$output->code = $this->dict->code;
    	$output->locations = $locations;
    	return $output;
    }
}

class Store{
	public $name;
	public $code;
	public $latitude;
	public $longitude;
	public $address;
	public $chain_name;
	public $distance = 0;

	function __construct($data =false){
		if($data){
			$this->latitude = $data->latitude;
			$this->longitude = $data->longitude;
			$this->address = $data->address;
			$this->name = $data->name;
		}
	}

	function setChain($str){
		$this->chain_name = $str;
	}

	function setCode($str){
		$this->code = $str;
	}

	function isNearby($lat,$lon,$radius,$units="M"){
		$distance = DistanceLib::distance($lat,$lon,$this->latitude,$this->longitude,$units);
		$this->distance =$distance;
		return $distance < $radius;
	}
}


/**
* 
*/
class NodeBuilder{
	private $stores;
	private $clusters;

	function __construct($data = array()){

		try {
			if(empty($data) || !is_array($data)){
				throw new Exception("NodeBuilder: No Input Data", 1);
				return false;
			}
			$this->stores = $data;
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
		# code...
	}

	function getClusters(){
		$stores = $this->stores;
		$c = count($stores);
		$store = array_shift($stores);
		$clusters = array();


		foreach($store->locations as $s){
			$cluster = array();
			array_push($cluster,$s);
			foreach ($stores as $chain) {
				# code...
				$found = false;
				foreach($chain->locations as $loc){
					if($s->isNearby($loc->latitude,$loc->longitude,3) && !$found){
						array_push($cluster,$loc);
						$found = true;
					}
				}
			}
			if(count($cluster) == $c){
				array_push($clusters, $cluster);
			}
		}

		return $clusters;
	}
}
?>