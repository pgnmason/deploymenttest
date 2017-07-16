<?php


$dir = scandir("json/individual_files/queue");
$jsonlist = array();
foreach ($dir as $key => $value) {
  if(strpos($value, ".json") > 0){
    array_push($jsonlist, $value);
  }
}

$store_arr = array();

$total_stores = 0;

foreach ($jsonlist as $filename) {
$stores = json_decode(file_get_contents("json/individual_files/queue/".$filename));
$total_stores+=count($stores);
$store_arr[$filename] = count($stores);
}
echo "\n\n TOTAL Files - ".count($jsonlist)."\n\n";
echo "\n\n TOTAL STORES - ".$total_stores."\n\n";

$stotal = 0;
$bundle = [];
$c = count($store_arr);
$output = [];
$special_cases = [];
$passes = 0;
while($c > 0){
  echo "PASSES: ".$passes."\n\n";
  foreach ($store_arr as $sto=>$num) {
    if($num > 10000){
      $t = json_decode("{}");
      $t->$sto = $num;
      array_push($special_cases, $t);
      unset($store_arr[$sto]);
    }else if($stotal + $num <10000){
      $stotal += $num;
      $t = json_decode("{}");
      $t->$sto = $num;
      array_push($bundle, $t);
      unset($store_arr[$sto]);
      echo "STOTAL = ".$stotal."\n";
    }else{
      echo "Skipping ".$num."\n";
      echo "STOTAL ".$stotal."\n";
    }
  } 
  //echo "Store LENGTH ".count($store_arr)."\n\n";
  $tbundle = json_decode('{}');
  $tbundle->data = $bundle;
  $tbundle->processed = false;
  array_push($output,$tbundle);
  $bundle = [];
  $c = count($store_arr);
  $passes ++;
  $stotal = 0;
  //echo "\nStores Left = ".$c."\n";
}


file_put_contents("raw/json_bundles_new.json", json_encode($output));
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

file_put_contents("raw/json_specials.json", json_encode($special_cases));
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