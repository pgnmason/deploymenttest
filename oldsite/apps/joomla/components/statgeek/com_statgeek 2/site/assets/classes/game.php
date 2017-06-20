<?

class SGeekGame{
	public $_hometeam;
	public $_awayteam;
	public $result;
	
	function __construct($id = false){
		if(!empty($id) && is_numeric($id)){
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select("*");
			$query->from("#__statgeek_game");
			$query->where("id = ".$db->quote($id));
			$db->setQuery($query);
			$game = $db->loadObject();
			foreach($game as $k=>$v){
				$this->$k=$v;
			}
		}
	}
	
	function loadData(){
		$this->profile = json_decode($this->details);
		$this->loadTeams();
		$this->result = $this->setWinner();
	}
	
	function getOpponent($id){
		if($this->_hometeam->id == $id){
			return $this->_awayteam;
		}else if($this->_awayteam->id == $id){
			return $this->_hometeam;
		}
	}
	
	function getTeam($id){
		
		if($this->_hometeam->id == $id){
			return $this->_hometeam;
		}else if($this->_awayteam->id == $id){
			return $this->_awayteam;
		}
	}
	
	function getSeasonName(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("name");
		$query->from("#__statgeek_season");
		$query->where("id = ".$db->quote($this->season));
		$db->setQuery($query);
		$t = $db->loadResult();
		return $t;
	}
	
	function loadTeams(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_team");
		$query->where("id = ".$db->quote($this->hometeam));
		$db->setQuery($query);
		$this->_hometeam = $db->loadObject("SGeekTeam");
		$this->_hometeam->score = $this->homescore;
		
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_team");
		$query->where("id = ".$db->quote($this->awayteam));
		$db->setQuery($query);
		$this->_awayteam = $db->loadObject("SGeekTeam");
		$this->_awayteam->score = $this->awayscore;	
	}
	
	private function setWinner(){
		if($this->homescore > $this->awayscore){
			return $this->hometeam;
		}else if($this->homescore < $this->awayscore){
			return $this->awayteam;
		}else if($this->homescore == $this->awayscore){
			return 0;
		}else{
			return -1;
		}
	}
	
}

?>