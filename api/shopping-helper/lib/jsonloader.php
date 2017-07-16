<?php
function compareDistance($a,$b){
	if ($a->distance == $b->distance) {
        return 0;
    }
    return ($a->distance < $b->distance) ? -1 : 1;
}

class DistanceLib{

	public static function distance($lat1, $lon1, $lat2, $lon2, $unit="M") {
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

	public static function lookupZipcode($zip){
		$url = "http://ntmasonconsulting.com/api/zipcode/?task=lookup&zip=".$zip;
		$res = self::getData($url);
		$data = json_decode($res);
		if($data->status === "ok"){
			return $data->data;
		}else{
			return false;
		}
	}

	public static function geoLookup($lat,$lng){
		$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true";
		$res = self::getData($url);
		$data = json_decode($res);
		if($data->results[1]){
			return $data->results;
		}else{
			return false;
		}
	}

	public static function getData($url){
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		return $result;
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
					if(!empty($s->latitude) && !empty($s->longitude)){
						$thestore = new Store($s);
						$thestore->setChain($store->name);
						$thestore->setCode($store->code);
						array_push($locations, $thestore);
					}else{
						//var_dump($s);
					}
					
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

	public function getStoreList(){
		$data = json_decode(file_get_contents($this->path."/stores.json"));
		return $data;
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

	public function locate(){
		$res = DistanceLib::geoLookup($this->latitude,$this->longitude);
		$locale = $res[0];
		$this->street_address = "";
		if(is_array($locale->address_components)){
			foreach ($locale->address_components as $key => $value) {
				if(in_array("street_number",$value->types)){
					$this->street_address .= $value->long_name;
				}

				if(in_array("route",$value->types)){
					$this->street_address .= " ".$value->long_name;
				}
				if(in_array("postal_code",$value->types)){
					$this->zip = $value->long_name;
				}
				if(in_array("postal_code",$value->types)){
					$this->zip = $value->long_name;
				}
				if(in_array("locality",$value->types)){
					$this->city = $value->long_name;
				}
				if(in_array("administrative_area_level_2",$value->types)){
					$this->county = $value->long_name;
				}
				if(in_array("administrative_area_level_1",$value->types)){
					$this->state = $value->short_name;
				}
				if(in_array("country",$value->types)){
					$this->country = $value->short_name;
				}
			}
		}
		$this->formatted_address = $locale->formatted_address;
		$this->place_id = $locale->place_id;
		
	}
}


/**
* 
*/
class NodeBuilder{
	private $stores;
	private $clusters;


	function __construct($data = array(),$lat=0,$lng=0){

		try {
			if(empty($data) || !is_array($data)){
				throw new Exception("NodeBuilder: No Input Data", 1);
				return false;
			}
			$this->stores = $data;
			$this->lat = $lat;
			$this->lng = $lng;
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
		# code...
	}

	function getClusters(){
		$stores = $this->stores;
		$c = count($stores);
		//if($c == 1){ return $this->stores;}
		$store = array_shift($stores);
		$clusters = array();

		foreach($store->locations as $s){
			$cluster = array();
			array_push($cluster,$s);
			foreach ($stores as $chain) {
				# code...d
				$found = false;
				foreach($chain->locations as $loc){
					if($s->isNearby($loc->latitude,$loc->longitude,3) && !$found){
						array_push($cluster,$loc);
						$found = true;
					}
				}
			}
			if(count($cluster) == $c){
				$sc =  new StoreCluster($cluster);
				$sc->locate();
				$sc->directionsUrl($this->lat,$this->lng);
				array_push($clusters, $sc);
			}
		}
		usort($clusters, 'compareDistance');
		return $clusters;
	}
}


class StoreCluster {
	
	public $city;
	public $state;
	public $zip;
	public $county;
	public $country;
	public $data;

	function __construct($data = false){
		if(!is_array($data)){
			return false;
		}
		$this->data = $data;
	}

	public function locate(){
		$s = $this->data[0];
		$res = DistanceLib::geoLookup($s->latitude,$s->longitude);
		$locale = $res[0];

		if(is_array($locale->address_components)){
			foreach ($locale->address_components as $key => $value) {
				if(in_array("postal_code",$value->types)){
					$this->zip = $value->long_name;
				}
				if(in_array("locality",$value->types)){
					$this->city = $value->long_name;
				}
				if(in_array("administrative_area_level_2",$value->types)){
					$this->county = $value->long_name;
				}
				if(in_array("administrative_area_level_1",$value->types)){
					$this->state = $value->short_name;
				}
				if(in_array("country",$value->types)){
					$this->country = $value->short_name;
				}
			}
		}

		$this->lat = $locale->geometry->location->lat;
		$this->lng = $locale->geometry->location->lng;

		foreach ($this->data as $store) {
			# code...
			$store->locate();
		}
	}

	public function directionsUrl($lat,$lng){
		$this->start_lng = $lng;
		$this->start_lat = $lat;
		$this->distance = DistanceLib::distance($this->start_lat,$this->start_lng,$this->lat,$this->lng);

		
		foreach ($this->data as $store) {
			$store->distance = DistanceLib::distance($this->start_lat,$this->start_lng,$store->latitude,$store->longitude);
		}

		usort($this->data, 'compareDistance');

		$origin = $this->start_lat.",".$this->start_lng;
		$data = $this->data;
		$c = count($data);

		$dest = array_pop($data);
		$destination = $dest->latitude.",".$dest->longitude;
		$arr = array();
		foreach ($data as $store) {
			array_push($arr, $store->latitude.",".$store->longitude);
		}
		$waypoints = implode("|", $arr);

		$this->directions_data = new stdClass();
		$this->directions_data->waypoints = $waypoints;
		$this->directions_data->origin = $origin;
		$this->directions_data->destination = $destination;

		$this->directions_url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&waypoints=".$waypoints."&key=AIzaSyBTsAp9ogIaE-FBTQC55ddSg_uGkH4LEf4";

	}
}



class StoreMeta{
	public $name ="";
	public $code = "";
	public $logo = "http://ntmasonconsulting.com/shoptimizer/images/logos/logo.png";
	public $categories = [];

	function __construct($opts = false){
		if(is_object($opts)){
			foreach($opts as $k=>$v){
				$this->$k = $v;
			}
		}
	}
}
?>