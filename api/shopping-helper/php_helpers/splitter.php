<?php

$jsondata = json_decode(file_get_contents("json/geodata.json"));

//$jsondata->Carters = json_decode(file_get_contents("raw/Carters_geodata.json"));
//$jsondata->OshKoshBGosh = json_decode(file_get_contents("raw/OshKoshBGosh_geodata.json"));
//$jsondata->BestBuy = json_decode(file_get_contents("raw/BestBuy_geodata.json"));

foreach($jsondata as $k=>$v){
	file_put_contents("json/individual_files/".$k.".json", json_encode($v));
}


?>