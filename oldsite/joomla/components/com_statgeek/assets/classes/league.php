<?php

class SGeekLeague{
	private $seasons;
	public $teams;
	
	function __construct($id=false){
		if(!$id){ return false;}
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_league');
		$query->where('id = "'.$pk.'"');
		$db->setQuery($query);
		$data = $db->loadObject();
		foreach($data as $k=>$v){
			$this->$k = $v;
		}
	}
	
	function loadData(){
		$this->loadSeasons();
		$this->loadTeams();
	}
	
	protected function loadSeasons(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_season");
		$query->where("league=".$db->quote($this->id));
		$query->order(array("startdate asc", "`enddate` asc"));
		$db->setQuery($query);
		$this->seasons = $db->loadObjectList("id","SGeekSeason");
	}
	
	function loadTeams($current = true){ //By Default Load Current Seasons Teams
	
		if($current == true){
		    $season = $this->currentSeason()->id;
		}else{
			$season = "*";
		}
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_team as t");
		$query->where("t.league=".$db->quote($this->id)." and (t.id in (select hometeam from #__statgeek_game where season=".$db->quote($season).") or t.id in (select awayteam from #__statgeek_game where season=".$db->quote($season)."))");
		$query->order(array("name asc"));
		$db->setQuery($query);
		$this->teams = $db->loadObjectList("id","SGeekTeam");
		
		
		/*********/
		if(count($this->teams) > 0){
			foreach($this->teams as $t){
				$t->record = $t->getRecord($this->currentSeason()->name);
			}
			$this->sortTeams();
			
		}
	}
	
	
	function loadStandings(){
		
	}
	
	
	function sortTeams(){
		usort(&$this->teams, array("SGeekLeague", "cmp"));
	}
	
	function cmp($a,$b){ 
	    //Check Wins
		if ($a->record->wins == $b->record->wins) {
            $n = 0;
        }else{
			$n = ($a->record->wins > $b->record->wins) ? -1 : 1;
		}
		
		if($n === 0){ // Check Ties
			if ($a->record->ties == $b->record->ties) {
				$m = 0;
			}else{
				$m = ($a->record->ties > $b->record->ties) ? -1 : 1;
			}
			
			if($m === 0){ //Team with least losses 
				return ($a->record->losses < $b->record->losses) ? -1 : 1;
			}else{
				return $m;
			}
		}else{
			return $n;
		}
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