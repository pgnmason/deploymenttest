<?php

$dir = scandir("json/individual_files/fixed");
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
$stores = json_decode(file_get_contents("json/individual_files/fixed/".$filename));
$num_duds = 0;
$c = count($stores);

foreach($stores as $store){
	if(empty($store->street_number)  && empty($store->street_name) &&empty($store->zip) &&empty($store->city) &&empty($store->county)&&empty($store->state)&&empty($store->country)){
		$num_duds++;
	}
}
echo $num_duds." STORES EMPTY OUT OF ".$c."\n";

if($c > 500){
	$threshold = ($c/100)*10;
}else if($c < 500 && $c > 100){
	$threshold = ($c/100)*20;
}if($c < 100 && $c > 50){
	$threshold = ($c/100)*50;
}else{
	$threshold = $c;
}

if($threshold > $num_duds){
	echo "MOVING ".$filename." to verified.\n";
	rename("json/individual_files/fixed/".$filename, "json/individual_files/verified/".$filename);
}else{
	echo "Needs to be Reprocessed ".$filename."\n";
	rename("json/individual_files/fixed/".$filename, "json/individual_files/queue/".$filename);
}


}
?>