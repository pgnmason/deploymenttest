<?php
$jsondata = json_decode(file_get_contents("json/carters_oshkosh_geodata.json"));
$output = new stdClass();
$output->objects = new stdClass();
$output->arrays = new stdClass();
foreach ($jsondata as $key => $arr) {
    echo $key."\r\n";
    $output->objects->$key = array();
    $output->arrays->$key = array();
    $error_count = 0;
    foreach($arr as $obj){
    	if($obj->location_data){
    		$o = new stdClass();
	    	$o->longitude = $obj->location_data->latitude;
	    	$o->latitude = $obj->location_data->longitude;
	    	$o->name = $obj->name;
	    	$o->address = $obj->address;
	    	$outarr = array($o->longitude,$o->latitude,$o->name,implode(" ",explode("\n",$o->address)));
	    	array_push($output->objects->$key, $o);
	    	array_push($output->arrays->$key,$outarr);
    	}else{
    		$error_count++;
    		echo "Something Bad \r\n";
    		echo "Error Count ".$error_count." \r\n";
    	}
    	
    }
    $fp = fopen("raw/".$key.'.csv', 'w');
    foreach($output->arrays->$key as $item){
    	fputcsv($fp, $item);
    }
    fclose($fp);

    file_put_contents("raw/".$key."_geodata.json", json_encode($output->objects->$key));
}
?>