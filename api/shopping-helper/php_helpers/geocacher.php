<?php
function geolookup($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }
 
   print_r($response);
   $geometry = $response['results'][0]['geometry'];
 
    $longitude = $geometry['location']['lat'];
    $latitude = $geometry['location']['lng'];
 
    $array = array(
        'latitude' => $geometry['location']['lng'],
        'longitude' => $geometry['location']['lat'],
        'location_type' => $geometry['location_type'],
    );
 
    return $array;
 
}


$cok = file_get_contents("raw/oshkosh_carters.txt");

$arr = explode("-------------", $cok);
$oshkosh_count = 0;
$carters_count = 0;
$stores = new stdClass();



foreach($arr as $a){
	$entry = explode("_______________", $a);

	if(trim($entry[0]) == "OshKosh B'Gosh"){
		$oshkosh_count++;
	}else if(trim($entry[0]) == "Carter's"){
		$carters_count++;
	}

	$obj = new stdClass();
	$obj->name = trim($entry[0]);
	$obj->address = trim($entry[1]);

	$addr_arr = explode("\n", $obj->address);
	$addr_arr = array_slice($addr_arr, 0, count($addr_arr)-1);
	$plainaddr = implode(" ", $addr_arr)."\r\n";
	$data = geolookup($plainaddr);
	$obj->location_data = $data;

	$key = preg_replace("/[^a-zA-Z]+/", "", $obj->name);


	if(empty($stores->$key) || !is_array($stores->$key)){
		$stores->$key = array();
	}
	array_push($stores->$key, $obj);
	//echo $a."\r\n\r\n";
}
//var_dump($stores);
echo "\r\n\r\n";
echo "Osh Kosh: ".$oshkosh_count."\r\n";
echo "Carters: ".$carters_count."\r\n";
echo "Total: ".count($arr)."\r\n\r\n";


file_put_contents("json/carters_oshkosh_geodata.json", json_encode($stores));
switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }
?>