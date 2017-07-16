<?php

/**
* 
*/
class GeoTool 
{
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
/**
* 
*/
class GeoDriver
{
	protected $apikey = "";
	protected $baseurl;
	protected $filename = "";
	protected $filepath = "";
	public $name = "";
	protected $limit = 10000;
	protected $requests = 0;
	
	function __construct($api,$filepath)
	{
		$this->apikey = $api;
		$this->filepath = $filepath;
		# code...
		$this->setData();
	}

	protected function setData(){
		$this->baseurl = "";
		$this->name = "";
		$this->limit = 10000;
	}

	public function search($lat,$lng){
		$url = $this->generateUrl($lat,$lng);
		$this->filename = $this->generateCacheName($url);
		return $this->_search($url);
	}

	protected function _search($url){

		if(!file_exists($this->generateCacheUrl())){
			echo "\nGETTING A NEW ONE"."\n";
			echo $url;
			sleep(1);
			$this->requests++;
			if($this->requests > $this->limit){
			  die("TOO MANY REQUESTS ".$this->name);
			}
			$resp = GeoTool::getData($url);
			$response = json_decode($resp);
			$this->cacheRequest($resp);
		}else{
			echo "LOADING FROM CACHE"."\n";
			$response = json_decode(file_get_contents($this->generateCacheUrl()));
		}
		
		return $this->processRequest($response);
	}

	public function generateUrl($lat,$lng){

	}

	public function generateCacheName($str){
		return $this->name."-".md5($str).".json";
	}

	public function generateCacheUrl(){
		return $this->filepath."/".$this->name."/".$this->filename;
	}

	public function cacheRequest($data){
		file_put_contents($this->generateCacheUrl(), json_encode($data));
	}

	public function processRequest($req){
		return $req;
	}
}


/**
* 
*/
class GoogleDriver extends GeoDriver
{
	protected function setData(){
		$this->name = "google";
		$this->limit = 2500;
	}

	function generateUrl($lat,$lng){
		$details_url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true"; 
		return $details_url;
	}

	function processRequest($response){
		if ($response['status'] != 'OK') {
		    if($response['status'] == 'OVER_QUERY_LIMIT'){
		      echo "\r\n OVER THE QUERY LIMIT\r\n";
		      return null;
		    }else{
		      echo "\r\nERROR - ".$response['status']."\r\n";
		      echo $details_url;
		      return null;
		    }
		}

		$res = $response['results'][0];
	    $locale = json_decode(json_encode($res));
	    $data = new stdClass();
	    if(is_array($locale->address_components)){
	      foreach ($locale->address_components as $key => $value) {
	        if(in_array("street_number",$value->types)){
	          $data->street_number = $value->long_name;
	        }
	        if(in_array("route",$value->types)){
	          $data->street_name = " ".$value->long_name;
	        }
	        if(in_array("postal_code",$value->types)){
	          $data->zip = $value->long_name;
	        }
	        if(in_array("locality",$value->types)){
	          $data->city = $value->long_name;
	        }
	        if(in_array("neighborhood",$value->types)){
	          $data->area = $value->short_name;
	        }
	        if(in_array("administrative_area_level_2",$value->types)){
	          $data->county = $value->long_name;
	        }
	        if(in_array("administrative_area_level_1",$value->types)){
	          $data->state = $value->short_name;
	        }
	        if(in_array("country",$value->types)){
	          $data->country = $value->short_name;
	        }
	      }
	    }
	    $data->formatted_address = $locale->formatted_address;
	    $data->place_id = $locale->place_id;
	    $data->source = "google";
	    return $data;
	} 
}





/**
* MapQuest
*/
class MapQuestDriver extends GeoDriver
{

	protected function setData(){
		$this->baseurl = "";
		$this->name = "mapquest";
		$this->limit = 15000;
	}

	function generateUrl($lat,$lng){
		$details_url = "http://open.mapquestapi.com/geocoding/v1/reverse?key=".$this->apikey."&location=".$lat.",".$lng;
		return $details_url;
	}
	public function processRequest($resp){
		
		if(is_string($resp)){
			$resp = json_decode($resp);
		}

		$data = new GeoData();

		foreach ($resp->results[0]->locations as $location) {


			$filled = 1;
			foreach($data as $k=>$v){
				if(empty($v) && $k !== "area" && $k!=="street_number"){
					$filled = 0;
					break;
				}
			}
			if($filled){
				break;
			}


			$street_arr = explode(" ", $location->street);
			$housenumber = array_shift($street_arr);
			$street = (is_numeric($housenumber)) ? implode(" ", $street_arr) : $location->street;



			if(empty($data->street_number) && is_numeric($housenumber)){
				$data->street_number  = $housenumber;

			}	

			if(empty($data->street_name) && !empty($street)){
				$data->street_name  = $street;
			}

			if(empty($data->zip) && !empty($location->postalCode)){
				$data->zip  = $location->postalCode;
			}

			if(empty($data->city) && !empty($location->adminArea5)){
				$data->city  = $location->adminArea5;
			}

			if(empty($data->area) && !empty($location->adminArea6)){
				$data->area  = $location->adminArea6;
			}

			if(empty($data->county) && !empty($location->adminArea4)){
				$data->county  = $location->adminArea4;
			}

			if(empty($data->state) && !empty($location->adminArea3)){
				$data->state  = $location->adminArea3;
			}

			if(empty($data->country) && !empty($location->adminArea1)){
				$data->country  = $location->adminArea1;
			}

			if(empty($data->formatted_address) && !empty($location->street)){
				$data->formatted_address  = $location->street;
			}

			if(empty($data->place_id) && !empty($location->mapUrl)){
				$data->place_id  = $location->mapUrl;
			}

			$data->datatype  = "mapquest";






			# code...
		}
		
		return $data;
	}

	
}


/**
* 
*/
class MapzenDriver extends GeoDriver
{
	
	protected function setData(){
		$this->baseurl = "";
		$this->name = "mapzen";
		$this->limit = 10000;
	}

	function generateUrl($lat,$lng){
		$details_url = "https://search.mapzen.com/v1/reverse?api_key=".$this->apikey."&point.lat=".$lat."&point.lon=".$lng;
		return $details_url;
	}


	function processRequest($resp){
		if(is_string($resp)){
			$resp = json_decode($resp);
		}

		$data = new GeoData();

		foreach ($resp->features as $feature) {
			if($feature->properties->layer !== "address"){
				continue;
			}
			$filled = 1;
			foreach($data as $k=>$v){
				if(empty($v) && $k !== "area"){
					$filled = 0;
					break;
				}
			}
			if($filled){
				break;
			}


			if(empty($data->street_number) && !empty($feature->properties->housenumber)){
				$data->street_number  = $feature->properties->housenumber;
			}

			if(empty($data->street_name) && !empty($feature->properties->street)){
				$data->street_name  = $feature->properties->street;
			}

			if(empty($data->zip) && !empty($feature->properties->postalcode)){
				$data->zip  = $feature->properties->postalcode;
			}

			if(empty($data->city) && !empty($feature->properties->locality)){
				$data->city  = $feature->properties->locality;
			}

			if(empty($data->county) && !empty($feature->properties->county)){
				$data->county  = $feature->properties->county;
			}

			if(empty($data->state) && !empty($feature->properties->region_a)){
				$data->state  = $feature->properties->region_a;
			}

			if(empty($data->country) && !empty($feature->properties->country_a)){
				$data->country  = $feature->properties->country_a;
			}

			if(empty($data->formatted_address) && !empty($feature->properties->label)){
				$data->formatted_address  = $feature->properties->label;
			}

			if(empty($data->place_id) && !empty($feature->properties->gid)){
				$data->place_id  = $feature->properties->gid;
			}

			if(empty($data->datatype) && !empty($feature->properties->source)){
				$data->datatype  = $feature->properties->source;
			}




			# code...
		}
		return $data;
	} 
}

/**
* 
*/
class LocationIQDriver extends GeoDriver
{
	
	protected function setData(){
		$this->baseurl = "";
		$this->name = "locationiq";
		$this->limit = 10000;
	}
	function generateUrl($lat,$lng){
		$details_url = "http://locationiq.org/v1/reverse.php?format=json&key=".$this->apikey."&lat=".$lat."&lon=".$lng."&zoom=18&addressdetails=1";
		return $details_url;
	}


	function processRequest($resp){
		if(is_string($resp)){
			$resp = json_decode($resp);
		}

		$data = new GeoData();

			if(empty($data->street_number) && !empty($resp->address->house_number)){
				$data->street_number  = $resp->address->house_number;
			}

			if(empty($data->street_name) && !empty($resp->address->road)){
				$data->street_name  = $resp->address->road;
			}

			if(empty($data->zip) && !empty($resp->address->postcode)){
				$data->zip  = $resp->address->postcode;
			}

			if(empty($data->city) && !empty($resp->address->city)){
				$data->city  = $resp->address->city;
			}

			if(empty($data->county) && !empty($resp->address->county)){
				$data->county  = $resp->address->county;
			}

			if(empty($data->area) && !empty($resp->address->neighbourhood)){
				$data->area  = $resp->address->neighbourhood;
			}

			

			if(empty($data->state) && !empty($resp->address->state)){
				$data->state  = $resp->address->state;
			}

			if(empty($data->state) && !empty($resp->address->state_district)){
				$data->state  = $resp->address->state_district;
			}


			if(empty($data->country) && !empty($resp->address->country_code)){
				$data->country  = $resp->address->country_code;
			}

			if(empty($data->formatted_address) && !empty($resp->display_name)){
				$data->formatted_address  = $resp->display_name;
			}

			if(empty($data->place_id) && !empty($resp->place_id)){
				$data->place_id  = $resp->place_id;
			}

			$data->datatype  = "locationiq";
		return $data;
	} 
}



/**
* 
*/
class GeoLib 
{
	private $drivers = [];

	function getDriver($name,$key,$filepath){
		if(empty($this->drivers[$name])){
			$fname = $name."Driver";
			$driver = new $fname($key,$filepath);
			$this->drivers[$name] = $driver;
		}else{
			$driver = $this->drivers[$name];
		}	
		return $driver;
	}
}

/**
* 
*/
class GeoData
{	
	public $street_number;
	public $street_name;
	public $zip;
	public $city;
	public $area;
	public $county;
	public $state;
	public $country;
	public $formatted_address;
	public $place_id;	
	public $datatype;
}

?>