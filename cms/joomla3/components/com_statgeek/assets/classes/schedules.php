<?php

class Schedule{
	private $seasons;
	function __construct($id=false,$season=false){
		if(!$id){ return false;}
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("distinct season");
		$query->from("#__statgeek_game");
		if(!$season){
			$query->where("hometeam = ".$db->quote($id)." or awayteam=".$db->quote($id));
		}else{
			$query->where("(hometeam = ".$db->quote($id)." or awayteam=".$db->quote($id).") and season=".$db->quote($season));
		}
		$query->order(array("season asc", "`date` asc"));
		$db->setQuery($query);
		$arr = $db->loadObjectList();
		
		$seasons = array();
		foreach($arr as $t){
			$a = new SGeekSeason($id,$t->season);
			$seasons[$a->name] = $a;
		}
		
		$this->seasons = $seasons;
		
		
		
	}
	
	function getSeason($id){
		return $this->seasons[$id];
	}
	
	
	function currentSeason(){
		$t = time();
		foreach($this->seasons as $s){
			$sdate = strtotime($s->startdate);
			$edate = strtotime($s->enddate);
			if($sdate < $t && $t < $edate){
				return $s;
			}
		}
		return false;
	}
}
?>