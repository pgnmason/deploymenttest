<?php
require("lib/geohandler.php");
require("lib/jsonloader.php");


$dir = scandir("raw/unformatted-locations");
$jsonlist = array();
foreach ($dir as $key => $value) {
  if(strpos($value, ".json") > 0){
    array_push($jsonlist, $value);
  }
}

foreach ($jsonlist as $filename) {
echo "\n\n";
echo "PROCESSING ".$filename;
echo "\n";
$stores = json_decode(file_get_contents("raw/unformatted-locations/".$filename));
$output = [];

foreach($stores as $store){
	$s = new stdClass();
	$s->name = $store->nam;
	$s->latitude = $store->lat;
	$s->longitude = $store->lng;
	$s->address = $store->adr;
	$thestore = new Store($s);

	array_push($output,$thestore);
}


file_put_contents("raw/formatted-locations/".$filename, json_encode($output));
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

echo "\n";

}

?>