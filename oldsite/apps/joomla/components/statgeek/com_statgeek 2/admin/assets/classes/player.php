<?php

class SGeekPlayer{
	
	function loadData(){
		$this->_team = $this->team;
		$this->profile = json_decode($this->details);
		$this->linkURL = $item->linkURL = JRoute::_('index.php?option=com_statgeek&view=player&id='.$this->id.':'.strtolower($this->firstname)."_".strtolower($this->lastname));
		$this->team = $this->getTeam();
		$this->position = $this->getPosition();
		$this->stats = $this->getStats();
		
	}
	
	function getTeam(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_team');
		$query->where('id = "'.$this->_team.'"');
		$db->setQuery($query);
		$data = $db->loadObject("SGeekTeam");
		return $data;
	}
	
	
	function getPosition(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_position');
		$query->where('id = "'.$this->profile->position.'"');
		$db->setQuery($query);
		$data = $db->loadObject();
		return $data;
	}
	
	function getStats(){
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		
		
		$query->select('DISTINCT a.game');
		$query->from('#__statgeek_player_stats as a, #__statgeek_game as g');
		$query->where("a.player=".$db->quote($this->id)." and a.game = g.id");
		$query->order("g.date");
		$db->setQuery($query);
		$games = $db->loadObjectList();
		$stats = array();
		
		
		foreach($games as $game){
			$g = new SGeekGame($game->game);
			$g->stats = $this->getGameStats($game->game);
			$g->loadTeams();
			$stats[$g->getSeasonName()][] = $g;
		}
		
		
		return $stats;
		
		
	}
	
	function getGameStats($game){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
				$query->select('a.*, b.abbreviation');
		$query->from('#__statgeek_player_stats as a, #__statgeek_stat as b');
		$query->where("player=".$db->quote($this->id)." and game=".$db->quote($game)." and a.stat = b.name");
		$query->order("game");
		$db->setQuery($query);
		$data = $db->loadObjectList();
		
		
		
		
		$stats = array();
		foreach($data as $d){
			$stats[$d->abbreviation] = $d->value;
		}
		
		if(empty($this->statheadings)){
			$this->statheadings = array();
			foreach($stats as $k=>$v){
				$this->statheadings[] = $k;
			}
		}
		
		return $stats;
	}
	
	function seasonTotals($season,$stat){
		if(empty($this->stats) || empty($this->stats[$season]) || !in_array($stat,$this->statheadings)){
			die("Invalid Stat Total");
		}
		$total = 0;
		foreach($this->stats[$season] as $game){
			$total += $game->stats[$stat];
		}
		
		return $total;
		
	}
	
	
	function profile($key){
		if(!is_object($this->profile)){
			$this->profile = json_decode($this->details); 
		}
		
		return $this->profile->$key;
		
	}
	
}

?>