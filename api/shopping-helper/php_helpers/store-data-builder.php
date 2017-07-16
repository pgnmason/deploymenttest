<?php
require("lib/jsonloader.php");


$dir = scandir("json/stores");
$jsonlist = array();
foreach ($dir as $key => $value) {
  if(strpos($value, ".json") > 0){
    array_push($jsonlist, $value);
  }
}


$stores = json_decode(file_get_contents("json/stores.json"));

$existing_stores = [];
foreach($stores as $s){
	array_push($existing_stores,$s->code.".json");
}

$new_stores = array_diff($jsonlist, $existing_stores);
$output = [];
foreach($new_stores as $n){
	$st = json_decode("{}");
	$st->name = str_replace(".json", "", $n);
	$st->code = str_replace(".json", "", $n);
	$s = new StoreMeta($st);
	$storecode = $st->code;
	$stores->$storecode = $s;
}

//var_dump($stores);

//echo json_encode($stores);

file_put_contents("json/stores.json", json_encode($stores));
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