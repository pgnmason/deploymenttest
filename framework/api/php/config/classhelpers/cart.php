<?

class Cart extends Object{
	
	var $event_type = NULL;
	var $food = array();
	var $addons = array();
	var $theme = NULL;
	var $attendants = 1;
	
	function cart($event_type = false){
		if($event_type){
			$this->event_type = getEventType($event_type);
		}
	}
	
	function addFoodItem($data){
		$found = false;
		foreach($this->food as $f){
			if($f->id == $data){
				$f->qty += 1;
				$found = true;
				break;
			}
		}
		
		if(!$found){
			$obj = getFoodItem($data);
			$obj->qty = 1;
			$this->food[] = $obj;
		}
		
	}
	
	
	function removeFoodItem($data){
		$found = false;
		$c = count($this->food);
		
		for($i = 0; $i < $c; $i++){
			
			$f = $this->food[$i];
			
			
			
			if($f->id == $data){
				$f->qty -= 1;
				
				if($f->qty === 0){
					unset($this->food[$i]);
					$found = true;
					break;
				}
				
				
			}
		}
		
		if($found){ $this->food = array_values($this->food);}
		
	}
	
	
	
	
	function addAddon($data){
		$found = false;
		foreach($this->addons as $f){
			if($f->id == $data){
				$f->qty += 1;
				$found = true;
				break;
			}
		}
		
		if(!$found){
			$obj = getAddon($data);
			$obj->qty = 1;
			$this->addons[] = $obj;
		}
		
	}
	
	
	function removeAddon($data){
		$found = false;
		$c = count($this->addons);
		
		for($i = 0; $i < $c; $i++){
			
			$f = $this->addons[$i];
			
			
			
			if($f->id == $data){
				$f->qty -= 1;
				
				if($f->qty === 0){
					unset($this->addons[$i]);
					$found = true;
					break;
				}
				
				
			}
		}
		
		if($found){ $this->addons = array_values($this->addons);}
		
	}
	
	
	
	
	function addTheme($data){
		$obj = getTheme($data);
		$this->theme = $obj;	
	}
	
	
	function removeTheme($data){
		$this->theme = NULL;
	}
	
	
	
	
	function foodTotal(){
		$cost = 0;
		foreach($this->food  as $f){
			$cost += ($f->qty * $f->price);
		}
		return $cost;
	}
	
	
	function addonTotal(){
		$cost = 0;
		foreach($this->addons  as $f){
			$cost += ($f->qty * $f->price);
		}
		return $cost;
	}
	
	
	function themeTotal(){
		$cost = 0;
		if($this->event_type->has_theme == 1){ return $cost; }
		
		if($this->theme && is_object($this->theme) && isset($this->theme->id)){
			$cost = $this->attendants  * 4.5;
		}
		return $cost;
	}
	
	
	function baseTotal(){
		$cost = $this->event_type->price;
		
		if($this->attendants > $this->event_type->guests){
			$cost += (($this->attendants-$this->event_type->guests) * $this->event_type->guest_cost);
		}
		
		return $cost;
	}
	
	
	function total(){
		return $this->foodTotal()+$this->addonTotal()+$this->baseTotal()+$this->themeTotal();
	}
	
	
	
	
	
	
	
}

?>