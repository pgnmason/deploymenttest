<?php
$orange = 'd44a10';
$purple = '711c89';
$black = '000000';

$chaloops['font'] = 'chaloops.otf';
$nilland_black['font'] = 'nilland-black.ttf';
$nilland['font'] = 'nilland.ttf';
$chaloops_med['font'] = 'chaloops-med.ttf';
$asjiggy['font'] = 'ASJiggyRoman.ttf';

function addFoodItem($data){
	$obj = new Object();
	$obj->load($data);
	$db = Factory::getDBO();
	
	return $db->insertObject("food_items",$db->filterObject("food_items",$obj));
}

function updateFoodItem($data){
	$obj = new Object();
	$obj->load($data);
	$db = Factory::getDBO();
	return $db->updateObject("food_items",$db->filterObject("food_items",$obj));
}


function addTheme($data){
	$obj = new Object();
	$obj->load($data);
	$db = Factory::getDBO();
	
	return $db->insertObject("themes",$db->filterObject("themes",$obj));
}

function updateTheme($data){
	$obj = new Object();
	$obj->load($data);
	$db = Factory::getDBO();
	return $db->updateObject("themes",$db->filterObject("themes",$obj));
}

function deleteTheme($id){
	$db = Factory::getDBO();
	$id = $db->sanitize($id);
	$db->setQuery('delete from themes where id = "'.$id.'"');
	$res = $db->query();
	return $res;
}







function addAddOn($data){
	$obj = new Object();
	$obj->load($data);
	$db = Factory::getDBO();
	
	return $db->insertObject("addons",$db->filterObject("addons",$obj));
}


function loadAddons(){
	$db = Factory::getDBO();
	return $db->pollTable("addons");
}

function loadFood(){
	$db = Factory::getDBO();
	return $db->pollTable("food_items");
}

function loadThemes(){
	$db = Factory::getDBO();
	return $db->pollTable("themes");
}

function loadEventTypes(){
	$db = Factory::getDBO();
	return $db->pollTable("event_types");
}


function getEventType($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("event_types",array("id"=>$id));
	return $arr[0];
}

function loadEvent($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("events",array("id"=>$id));
	
	if(count($arr) > 0){
		return $arr[0];
	}else{
		return false;
	}
}

function loadOrder($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("orders",array("id"=>$id));
	return $arr[0];
}

function deleteFoodItem($id){
	$db = Factory::getDBO();
	$id = $db->sanitize($id);
	$db->setQuery('delete from food_items where id = "'.$id.'"');
	$res = $db->query();
	return $res;
}






function getOpenDates(){
	$db = Factory::getDBO();
	$arr = $db->pollTable("event_days",array("location"=>1,"full"=>0));
	
	$c = count($arr);
	
	for($i =0; $i < $c; $i++){
		$day = strtotime($arr[$i]->day);
		$now = strtotime(date("Y-m-d")."00:00:00");
		$cutoff = (strtotime(date("Y-m-d")."00:00:00") + (7*86400));

		if($day < $now || $day < $cutoff){
			unset($arr[$i]);
		}
	}
	
	return $arr;
}

function loadDailyCalendar($date){
	$db = Factory::getDBO();
	$arr = $db->pollTable("event_days",array("location"=>1,"day"=>$date));
	$obj = $arr[0];
	$day = new Day($obj->toArray());
	return $day;
}

function availableTimes($day, $event_type = false){
	$slots = $day->events;
	$output = array();
	
	foreach($slots as $s){
		if(!isset($s->event) || strlen($s->event) == 0){
			
			if(!$event_type){
				$output[] = $s;
			}else{
				if($event_type->id == 4){
					if($s->attributes['name'] == "10:00:00 am" || $s->attributes['name'] == "5:00:00 pm"){
						$output[] = $s;
					}
				}else{
					$output[] = $s;
				}
			}
		}
	}
	
	
	return $output;
}

function getFoodItem($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("food_items",array("id"=>$id));
	return $arr[0];
}

function getAddon($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("addons",array("id"=>$id));
	return $arr[0];
}

function getTheme($id){
	$db = Factory::getDBO();
	$arr = $db->pollTable("themes",array("id"=>$id));
	return $arr[0];
}

function addOrder($obj){
	$db = Factory::getDBO();
	
	$obj->id = $obj->txn_id;
	$obj->amount = $obj->payment_gross;
	$obj->details = imageEncode($obj);
	$obj->order_date = strtotime($obj->payment_date);
	
	return $db->insertObject("orders",$db->filterObject("orders",$obj));
}


function addEvent($obj){
	$db = Factory::getDBO();
	
	$day = loadDailyCalendar(date("Y-m-d",$obj->date));
//	pretty_print_r($day);
	if($day->addEvent($obj->id,$obj->timeslot)){
		//echo "INSIDE HERE\n";
		//pretty_print_r($day);
		$day->prep();
		$obj = $db->filterObject("events",$obj);
		if($db->insertObject("events",$obj)){
			//echo "STILL INSIDE HERE\n";
			$day = $db->filterObject("event_days",$day);
			//pretty_print_r($day);
			return $db->updateObject("event_days",$day,array("day","location"));
		}else{
			return false;
		}
	}else{
		return false;
	}
	
	
	
	/**/
}



function updateEvent($event,$cart){
	$db = Factory::getDBO();
	
	//var_dump($event);
	//var_dump($cart);
	
	if(isset($event->order)){
		$event->payment_status = "COMPLETE";
	}
	return $db->updateObject("events",$event);
	
	
	/*
	$day = loadDailyCalendar(date("Y-m-d",$obj->date));
	if($day->addEvent($obj->id,$obj->timeslot)){
		//echo "INSIDE HERE\n";
		//pretty_print_r($day);
		$day->prep();
		$obj = $db->filterObject("events",$obj);
		if($db->insertObject("events",$obj)){
			//echo "STILL INSIDE HERE\n";
			$day = $db->filterObject("event_days",$day);
			//pretty_print_r($day);
			return $db->updateObject("event_days",$day,array("day","location"));
		}else{
			return false;
		}
	}else{
		return false;
	}*/
	
	
	
	/**/
}








	function signin(){
		global $authmetric,$pname,$home_dir,$document,$ds,$error;
		$error = NULL;
		$document = Factory::getDocument();
		$data = $document->post;
		
		if(!isset($data->$authmetric,$data->$pname) || strlen($data->$authmetric) == 0 && strlen($data->$pname) == 0){
			$error = "Error Signing In: Please fill out the entire form";
			return false;
		}else{
		//	echo "Signing In";
			
			
			$auth = new Authorization();
			
			
			if($auth->login($data->$authmetric,$data->$pname)){
				return true;
			}else{
				$error= "Error Signing In: ".$auth->error;
				return false;
			}
		}			
	}




	function checkAccess($level){
		$d = Factory::getDocument();
		
		if(!isset($d->session->auth_level)){
			$error = "Application Error: Improper User Credentials";
			die($error);
		}else{
			if(isset($d->session->auth_id,$d->session->authenticated)){
				$user = new User($d->session->auth_id);
			}else{
				$user = new User();
				$user->group = $d->session->auth_level;
			}
			return Authorization::checkAccess($user->group,$level);
		}
	}



function getEventDates($location = 1){
	$db = Factory::getDBO();
	$arr = $db->pollTable("events",array("location"=>$location));
	
	$events = array();
	foreach($arr as $a){
		if(!in_array($a->date,$events)){
			$events[] = date("Y-m-d",$a->date);
			//echo date("Y-m-d",$a->date)." ".$a->id."<br />";
		}
	}
	
	
	$db->setQuery('select * from event_days where day in ("'.implode('","',$events).'") and location = '.$db->sanitize($location));
	
	$arr = $db->loadObjectList();

	return $arr;
}



function generateID(){
	$db = Factory::getDBO();
	$db->setQuery("select * from events where id like 'mlo_%' order by id desc");
	$o = $db->loadObject();
	if(isset($o->id)){
		$arr = explode("_",$o->id);
		$num = (int) $arr[1];
		$num += 1;
		$id = "mlo_".$num;
	}else{
		$id = "mlo_100000";	
	}
	return $id;
}




function deleteEvent($id){
	$db = Factory::getDBO();
	$event = loadEvent($id);
	if($event){
	$day =  loadDailyCalendar(date("Y-m-d",$event->date));
	
	foreach($day->events as $t){
		if($t->attributes['event'] == $id){
			$t->attributes['event'] = NULL;
		}
	}
	
	$day->events = serialize($day->events);
	
//	pretty_print_r($day);
	

	
	
	$day = $db->filterObject("event_days",$day);
	$res = $db->updateObject("event_days",$day,array("day","location"));
	//var_dump($res);
	// echo "<br />".$db->getQuery()."<br />";
	$id = $db->sanitize($id);
	$db->setQuery('delete from orders where id = "'.$id.'"');
	//echo $db->getQuery()."<br />";
	$res = $db->query();
    // var_dump($res);
	$db->setQuery('delete from events where id = "'.$id.'"');
	//echo $db->getQuery()."<br />";
    $res = $db->query();
	return $res;
    //var_dump($res);
	}else{ return true; }
}




function sendConfirmation($data){
}

function buildConfirmation($order,$event){
	
	
	$message = new MLOMessage();
	
	$message->setConfirmation($order,$event);
	
	$message->sendMail();
	
	
}

function buildPreConfirmation($event){
	
	
	$message = new MLOMessage();
	
	$message->setPreConfirmation($event);
	
	$message->sendMail();
	
	
}


function eventsInMonth($date){
	$datetime = strtotime($date);
	$startdate = mktime(0, 0, 0, date("m",$datetime), 1,   date("Y",$datetime));
	$enddate = mktime(23,59,0,date("m",$datetime),date("t",$datetime),date("Y",$datetime));
	
	$dates = getEventDates();
	
	$output = array();
	
	foreach($dates as $d){
		$day = strtotime($d->day);
		if($day >= $startdate && $day <= $enddate){
			$d->events = unserialize($d->events);
			$output[] = $d;
		}
	}
	
	return $output;
	
}







/*function intializeTimeslots(){
	for($i = 10; $i <18; $i++){
		if($i == 12){ continue; }
		$obj = new Object();
		$obj->name = date("g:i:s a",mktime(date("$i"),0,0));
		$obj->time = mktime(date("$i"),0,0);
		$obj->location = 1;
		$db = Factory::getDBO();
		$db->insertObject("time_slots",$obj);
	}
}*/

function generatePassword($password){
		global $msalt1,$msalt2,$authtable,$authmetric,$pname,$saltname;
		$salt = md5(mt_rand());
		$pass_hash = hash("sha512",$msalt1.$salt.$password.$msalt2);
		
		echo $salt."<br />".$pass_hash;
	}


?>