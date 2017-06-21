<?php

class SGeekSeason{
	public $games;
	function __construct($id=false,$season=false){
		if(!$id){ return false;}
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_game");
		if(!$season){
			$query->where("hometeam = ".$db->quote($id)." or awayteam=".$db->quote($id));
		}else{
			$query->where("(hometeam = ".$db->quote($id)." or awayteam=".$db->quote($id).") and season=".$db->quote($season));
		}
		$query->order(array("season asc", "`date` asc"));
		$db->setQuery($query);
		$arr = $db->loadObjectList("id","SGeekGame");
		
		$this->games = $arr;
		
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_season");
		$query->where("id = ".$db->quote($season));
		$db->setQuery($query);
		$obj = $db->loadObject();
		$this->name = $obj->name;
		$this->startdate = $obj->startdate;
		$this->enddate = $obj->enddate;
	}
	
}
?>