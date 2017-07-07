<?php

class Agent extends Object{
	function __construct($id=false){
		if($id && is_numeric($id)){
			$db = Factory::getDBO();
			$db->setQuery("select * from locator_agents where id=".$db->sanitize($id));
			$obj = $db->loadObject();
			$this->load($obj);
		}
	}	

	function locate(){
		loadComponent("geocoder");
		if(!empty($this->address1)&&!empty($this->zip)){
			$coords = Geocoder::locate($this->address1." ".$this->zip);
			
			$this->latitude = $coords->results[0]->geometry->location->lat;
			$this->longitude = $coords->results[0]->geometry->location->lng;
			/*echo "<pre>";
			var_dump($coords);
			var_dump($this);
			echo "</pre>";
			exit();*/
		}
	}
}

?>