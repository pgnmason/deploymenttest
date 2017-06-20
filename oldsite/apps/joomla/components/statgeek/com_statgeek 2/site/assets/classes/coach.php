<?

class SGeekCoach{
	
	function loadData(){
		$this->profile = json_decode($this->details);
		$this->linkURL = $item->linkURL = JRoute::_('index.php?option=com_statgeek&view=coache&id='.$this->id.':'.strtolower($this->firstname)."_".strtolower($this->lastname));
		$this->team = $this->getTeam();
		$this->position = $this->getPosition();
		
	}
	function getTeam(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_team');
		$query->where('id = "'.$this->team.'"');
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
	
	function profile($key){
		if(!is_object($this->profile)){
			$this->profile = json_decode($this->details); 
		}
		
		return $this->profile->$key;
		
	}
	
}

?>