<?php
define("MapzenKey", "mapzen-yd47iSe");
define("LocationIQKey","90ad5aa5c5fd173dddd5");
define("LocationIQKey2","151d24fa8cfbb564d50e");
define("LocationIQKey3","7a16d6c6e5c79301dd83");
define("MapQuestKey","zkMSjGrbWTJHdVxuvybO5JfTH4i0fT6G");
require("lib/geohandler.php");


$infile = json_decode(file_get_contents("raw/json_bundles_new.json"));
$lib = new GeoLib();
//$geodriver = $lib->getDriver("Mapzen",MapzenKey,"/Volumes/Samsung USB/Sites/Personal/request-cache");
$geodriver = $lib->getDriver("LocationIQ",LocationIQKey2,"/Volumes/Samsung USB/Sites/Personal/request-cache");
//$geodriver = $lib->getDriver("MapQuest",MapQuestKey,"/Volumes/Samsung USB/Sites/Personal/request-cache");

foreach ($infile as $bundle) {
  # code...
  if(!$bundle->processed){
    $jsonlist = $bundle->data;
    foreach ($jsonlist as $entry) {
      foreach($entry as $filename=>$filecount){
        if(file_exists("json/individual_files/fixed/".$filename)){echo "Skipping ".$filename."\n\n"; continue;}
        echo "PROCESSING ".$filename."\n\n";
        $stores = json_decode(file_get_contents("json/individual_files/queue/".$filename));
        $storecount = 1;
        foreach($stores as $store){
          //var_dump($store);
          //var_dump($geodriver);
          //var_dump($geodriver->generateUrl($store->latitude,$store->longitude));

          //$data = $geodriver->search(trim($store->latitude),trim($store->longitude));
          echo "\nFetching Store $storecount of $filecount from $filename using $geodriver->name\n";
          $data = $geodriver->search(trim($store->latitude),trim($store->longitude));
          foreach($data as $k=>$v){
            $store->$k = $v;
          }
          $storecount++;
        }
        $bundle->processed = true;
        file_put_contents("json/individual_files/fixed/".$filename, json_encode($stores));
      }
      
      
    }
    $bundle->processed = true;
    file_put_contents("raw/json_bundles_new.json", json_encode($infile));
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
    exit();
  }
  
}



?>