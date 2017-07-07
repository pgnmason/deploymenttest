<?php

$csv = array_map('str_getcsv', file('raw/'."BestBuy.csv"));
$k = "BestBuy";



$output = new stdClass();
$output->$k = array();

for($j = 0, $csvcount = count($csv); $j<$csvcount; $j++ ){
	$outtd = new stdClass();
	$row=$csv[$j];
	try {
		if(count($row) < 4){
			throw new Exception('Bad CSV '.$k);
		}
		$outtd->latitude = utf8_encode($row[1]);
		$outtd->longitude = utf8_encode($row[0]);
		$outtd->name = utf8_encode($row[2]);
		$outtd->address = utf8_encode($row[3]);
		array_push($output->$k, $outtd);
	} catch (Exception $e) {
		echo $e->getMessage()."\r\n";
		break;
	}


}
file_put_contents("raw/".$k."_geodata.json", json_encode($output->$k));
?>