<?php

class Geocoder{
	
	function locate($input){
		if (is_object($input)){

			$lookup = "";
			if(!empty($input->address)){
				$lookup .= $input->address;
			}

			if(!empty($input->city)){
				$lookup .= " ".$input->city;
			}

			if(!empty($input->state)){
				$lookup .= ", ".$input->state;
			}

			if(!empty($input->zip)){
				$lookup .= " ".$input->zip;
			}

		}else{
			$lookup = $input;
		}

		$lookup = urlencode($lookup);

		$response = self::getData("https://maps.googleapis.com/maps/api/geocode/json?address=".$lookup);

		if($t = json_decode($response)){
			return $t;
		}else{
			return false;
		}

	}


	function getData($url){
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


?>