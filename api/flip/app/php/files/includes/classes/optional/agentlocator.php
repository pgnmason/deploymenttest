<?php

class AgentLocator{
	
	function search($zip_code,$radius=100){
	 	loadComponent("agent");
	 	$db = Factory::getDBO();
	 	if($c = self::checkCache($zip_code,$radius) && false){
	 		return $c;
	 	}
	 	$zip_code = $db->sanitize($zip_code);
	 	$db->setQuery("SELECT * FROM zip_codes WHERE zip_code = ".$zip_code." LIMIT 1");
	 	$loc = $db->loadObject();

	 	//echo $db->getQuery();

	 	if(empty($loc->latitude)){ return false; }

	 	$sql = "SELECT *, ( 3959 * acos( cos( radians(".$loc->latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$loc->longitude.") ) + sin( radians(".$loc->latitude.") ) * sin( radians( latitude ) ) ) ) AS distance FROM locator_agents HAVING distance < ".$radius." ORDER BY distance;";
	 	$db->setQuery($sql);

	 	//echo $db->getQuery();

	 	$res = $db->loadObjectList("Agent");
	 	
	 	if(count($res) > 0){
	 		self::cacheResults($zip_code,$radius,$res);
	 	}

	 	return $res;
	}

	function checkCache($zip_code,$radius){
		$db = Factory::getDBO();

		$threshold = time()-86400;

		$db->setQuery("select * from locator_searchcache where zip_code=".$db->sanitize($zip_code)." and radius=".$db->sanitize($radius)." and cachetime > ".$threshold);

		if($a = $db->loadObject()){
			return json_decode($a->results);
		}else{
			return false;
		}

	}

	function cacheResults($zip_code,$radius,$results){
		$db = Factory::getDBO();
		$db->setQuery("delete from locator_searchcache where zip_code='".$db->sanitize($zip_code)."' and radius=".$db->sanitize($radius));
		$db->query();
		$obj = new Object();
		$obj->zip_code = $zip_code;
		$obj->radius = $radius;
		$obj->results = json_encode($results);
		$obj->cachetime = time();
		$db->insertObject("locator_searchcache",$obj);
	}


}