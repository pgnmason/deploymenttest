<?php

if(!defined("BL_EXEC")){ die("Unauthorized Access");}

define("API_KEY","373a86600791e56db2b6c8cdafd2cb9d");
define("API_ENDPOINT","http://api.chartbeat.com/live/");
define("API_DOMAIN","post-gazette.com");




class Chartbeat extends Subroutine{

    

    static function toppages(){
		$data = new stdClass();
		$data->type = "toppages";
		$data->query->limit = (!empty($_GET['limit'])) ? $_GET['limit'] : "20";
		$data->query->section = (empty($_GET['section']) || $_GET['section'] == 'all') ? "" :  $_GET['section'];
		$res = self::fetch($data,true);
		if(!$res){
			die("ERROR");
		}
		
		
		
		//echo $res;
		
		$arr = json_decode($res);
		
		$output = array();
		foreach($arr->pages as $p){
			$s = new stdClass();
			$s->url = $p->path;
			$s->url_encoded = urlencode("http://".$s->url);
			$s->count = $p->stats->visits;
			$s->hist = $p->stats->visit->hist;
			$s->image = false;
			$s->articleID = uniqid("pg_");
			$s->title = $p->title;
			
			$output[] = $s;
		}
		
		echo json_encode($output);
    }
	
	
	
	static function fetch($data,$return = false){
		$url=API_ENDPOINT.$data->type."/v3/?apikey=".API_KEY."&host=".API_DOMAIN;
		if(!empty($data->query)){
			$url.="&".http_build_query($data->query);
		}
		
		$ch = curl_init($url);
		if($return){
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		}
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}
	
	
	
	
	

}

?>