<?php
function geolookuplatlng($string){
 
   $str = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$str."&sensor=true";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    
    if($response['status'] == 'OVER_QUERY_LIMIT'){
      echo "\r\n OVER THE QUERY LIMIT, SLEEPING\r\n";
      sleep(2);
      echo "\r\n LET'S TRY AGAIN \r\n";
      return geolookuplatlng($string);
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
    return $data;
 
}


function geolookupaddress($string){
 
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
 
   //print_r($response);
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



$dir = scandir("json/individual_files");
$jsonlist = array();
foreach ($dir as $key => $value) {
  if(strpos($value, ".json") > 0){
    array_push($jsonlist, $value);
  }
}

foreach ($jsonlist as $filename) {
echo "\r\n\r\n";
echo "PROCESSING ".$filename;
echo "\r\n\r\n";
$stores = json_decode(file_get_contents("json/individual_files/".$filename));

$c = 0;
foreach($stores as $store){
echo $c."\n";
  $addr_arr = explode("<br>", $store->address);
  //$addr_arr = array_slice($addr_arr, 0, count($addr_arr)-1);
  $latlng = $store->latitude.",".$store->longitude;
  $data = geolookuplatlng($latlng);
  if($data){
    foreach ($data as $key => $value) {
      $store->$key =$value;
    }
  }else{
    echo "\r\n Could Not Locate".$latlng."\r\n";
  }
}



file_put_contents("json/individual_files/fixed/".$filename, json_encode($stores));
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
    # code...
    break;
}
?>