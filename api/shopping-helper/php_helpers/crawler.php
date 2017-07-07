<?php
$dir = scandir("csv");
$csvlist = array();
foreach ($dir as $key => $value) {
	if(strpos($value, ".csv") > 0){
		array_push($csvlist, $value);
	}
}

$output = new stdClass();

for($i = 0, $cslim = count($csvlist); $i<$cslim; $i++){
$csv = array_map('str_getcsv', file('csv/'.$csvlist[$i]));
$k = str_replace(".csv", "", $csvlist[$i]);
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


}
//var_dump(json_encode($output));
//echo strlen(json_encode($output));

file_put_contents("json/geodata.json", json_encode($output));
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