<?

class Day extends Object{
	
	var $events = array();
	var $day = NULL;
	var $full = 0;
	var $location = NULL;
	
	function day($data = false){
		if($data){
			$this->load($data);
		}/*else{
			$db = Factory::getDBO();
			$arr = $db->pollTable("time_slots",array("location"=>1));
			foreach($arr as $a){
				$t = new Timeslot();
				$t->attributes["name"] = $a->name;
				$t->attributes["time"] = $a->time;
				$t->attributes['location'] = $a->location; 
				$this->events[] = $t;
			}
		}*/
	}
	
	function load($data){
		parent::load($data);
		$this->events = unserialize($this->events);
	}
	
	function addEvent($id,$timeslot){
		//echo $id."<br /><br /><br />";
		foreach($this->events as $e){
			if($e->attributes['time'] == $timeslot){
				if(strlen($e->attributes['event']) > 0){
					return false;
				}else{
					$e->attributes['event'] = $id;
				}
				break;
			}
		}
		
		return $this->fullCheck();
	}
	
	
	
	function fullCheck(){
		$full = true;
		
		foreach($this->events as $e){
			if($e->attributes['name'] !== "3:00:00 pm"){
				if(strlen($e->attributes['event']) > 0){
					//echo $e->attributes['name']." is full<br />";
					continue;
				}else{
					//echo $e->attributes['name']." is empty<br />";
					$full = false;
					break;
				}
			}
		}
		
		if($full){ $this->full = 1;}else{ $this->full = 0; }
		
		
		return true;
	}
	
	
	function prep(){
		$this->events = serialize($this->events);
		$this->day = trim($this->day);
	}
	
}

?>