<?

class SGeekTeam{
	private $players;
	private $schedules;
	private $coaches;
	
	function loadData(){
		$this->players = $this->loadPlayers();
		$this->coaches = $this->loadCoaches();
		$this->schedules = $this->loadSchedules();
	}
	
	function loadCoaches(){
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."coach.php");
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_coache');
		$query->where('team = "'.$this->id.'"');
		$db->setQuery($query);
		$data = $db->loadObjectList("id","SGeekCoach");
		if(!empty($data)){
			foreach($data as $coach){
				$coach->loadData();
			}
		}
		
		return $data;
	}
	
	function loadPlayers(){
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."season.php");
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."game.php");
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."player.php");
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_player');
		$query->where('team = "'.$this->id.'"');
		$db->setQuery($query);
		$data = $db->loadObjectList("id","SGeekPlayer");
		if(!empty($data)){
			foreach($data as $player){
				$player->loadData();
			}
		}
		
		return $data;
	}
	
	function loadSchedules(){
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."schedules.php");
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."season.php");
		require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."game.php");
		$schedules = new Schedule($this->id);
		return $schedules;
	}
	
	function getRoster(){
		return $this->players;		
	}
	function getStaff(){
		return $this->coaches;
	}
	function getSchedule(){
		return $this->schedules;
	}
	
	function getRecord($id = false){		
		if(empty($this->schedules)){
			$this->schedules = $this->loadSchedules();
		}
		if(!$id){
			$season = $this->schedules->currentSeason();
		}else{
			$season = $this->schedules->getSeason($id);
		}

		$obj = new stdClass();
		$obj->wins = 0;
		$obj->losses = 0;
		$obj->ties = 0;
		$obj->gp = 0;
		
		if(!$season){
			echo "UH OH";
			return $obj;
		}
		
		foreach($season->games as $g){
			$g->loadData();
			if(strtotime($g->date) < time()){
				if($g->result > -1){
					if($g->result == $this->id){
						$obj->wins += 1;
					}else if($g->result == 0){
						$obj->ties +=1;
					}else{
						$obj->losses +=1;
					}
					$obj->gp++;
				}
			}
		}
		
		return $obj;
		
		
	}
}

?>