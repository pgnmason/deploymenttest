<?php

if(!defined("BL_EXEC")){ die("Unauthorized Access");}



class Locations extends Subroutine{

    

    static function lookup(){

        $data = self::search();

        echo $data->output();

    }

    

    private function search(){

        

        $query = Request::getVar("type","get");

        

        if(!$query){

            return self::error(701,"Missing Parameters","You must provide search parameters");

        }

        

        $query = trim($query);

        
		if($query == "zip"){
			$zip = Request::getVar("zip","get"); ;
			if(!$zip || !is_numeric($zip)){
				return self::error(702,"Missing Parameters","Invalid Parameter Type");
			}
			return self::zip_search($zip);
		}else{
			return self::text_search();
		}
    }

    

    

    private function zip_search($zip){

        $db = Factory::getDBO();
		
        $zip = $db->sanitize($zip);

        $db->setQuery("select * from zip_codes where zip_code='".$zip."'");

        $obj = $db->loadObject();
		
        if(!empty($obj)){

            return self::success(300,"Success",$obj);

        }else{

            return self::error(702,"Data Not Found","Lookup Failed. Data could not be found");

        }

    }


	 private function text_search(){

        $db = Factory::getDBO();
		
		
		// CHECK TO SEE IF IT HAS A ZIP CODE
		
		$zip = Request::getVar("zip","get"); 
		if($zip && is_numeric($zip)){
			return self::zip_search($zip);
		}
		
		$city = Request::getVar("city","get"); 
		$state = Request::getVar("state","get"); 
		$country = Request::getVar("country","get"); 
		
		
		if(empty($city)){
			return self::error(703,"Missing Parameters","Invalid Parameter Type");
		}
		$city = strtolower($city);
		
		if(empty($state) && empty($country)){
			return self::error(704,"Missing Parameters","Invalid Parameter Type");
		}
		
		if(!empty($state)){
			$res = self::state_search($city,$state);
		}else if(!empty($country)){
			$res = self::country_search($city,$country);
		}
			
		if(!$res){
			return self::remote_search($city,$state,$country);
		}else{
			return $res;
		}
    }
	
	function state_search($city,$state){
		 $db = Factory::getDBO();
        $city = strtoupper($db->sanitize($city));
		$state = strtoupper($db->sanitize($state));
		
		if(strlen($state) > 2){
			$state = self::stateFilter($state);
		}
		 
        $db->setQuery("select * from zip_codes where (city='".$city."' or city_alias_name='".$city."') and state='".$state."'");
		
		//echo $db->getQuery();
        $obj = $db->loadObject();
        if(!empty($obj)){
            return self::success(300,"Success",$obj);
        }else{
            return false;
        }
	}
	
	function country_search($city, $country){
		$db = Factory::getDBO();
		if(strlen($country) > 2){
			$country = strtolower(self::country_code($country));
		}
		
		$city = strtolower($db->sanitize($city));
		$db->setQuery("select * from world_cities where city='".$city."' and country='".$country."'");
		$obj = $db->loadObject();
		if(!empty($obj)){
			return self::success(300,"Success",$obj);
		}else{
			return false;
		}
	}
	
	
	
	function country_code($country){
		 $db = Factory::getDBO();
		$country = strtolower($db->sanitize(ucwords($country)));
		$db->setQuery("select code from country_codes where name='".$country."'");
		$obj = $db->loadObject();
		if(empty($obj->code)){
			return "NULL";
		}else{
			return $obj->code;
		}
	}
	
	function remote_search($city,$state=false,$country=false){
		$q = $city;
		if($state){
			$q.= ",".$state;
		}
		if($country){
			$q .= ",".$country;
		}
		
		$url = "http://geocoding.cloudmade.com/a94447869652468f970425d6b893d22b/geocoding/v2/find.js?query=".$q;
		
		$obj = json_decode(file_get_contents($url));
		
		if(is_array($obj->features) && !empty($obj->features)){
			$res = $obj->features[0]->centroid->coordinates;
			//echo json_encode($res);
			$t = new stdClass();
			$t->latitude = $res[0];
			$t->longitude = $res[1];
			//echo "<pre>";print_r($obj); echo "</pre>";
			return self::success(300,"Success",$t);
		}else{
			return self::error(703,"Missing Parameters","Invalid Parameter Type");
		}
	}

    

    

    

    function success($code,$message,$details){

        $data = new Response();

        $data->set("status",1);

        $data->set("code",$code);

        $data->set("message",$message);

        $data->set("details",$details);

        return $data;

    }

	function stateFilter($abbrev){
		$states = array(
			'AL'=>'Alabama',
			'AK'=>'Alaska',
			'AZ'=>'Arizona',
			'AR'=>'Arkansas',
			'CA'=>'California',
			'CO'=>'Colorado',
			'CT'=>'Connecticut',
			'DE'=>'Delaware',
			'DC'=>'District of Columbia',
			'FL'=>'Florida',
			'GA'=>'Georgia',
			'HI'=>'Hawaii',
			'ID'=>'Idaho',
			'IL'=>'Illinois',
			'IN'=>'Indiana',
			'IA'=>'Iowa',
			'KS'=>'Kansas',
			'KY'=>'Kentucky',
			'LA'=>'Louisiana',
			'ME'=>'Maine',
			'MD'=>'Maryland',
			'MA'=>'Massachusetts',
			'MI'=>'Michigan',
			'MN'=>'Minnesota',
			'MS'=>'Mississippi',
			'MO'=>'Missouri',
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',
			'OK'=>'Oklahoma',
			'OR'=>'Oregon',
			'PA'=>'Pennsylvania',
			'RI'=>'Rhode Island',
			'SC'=>'South Carolina',
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',
			'TX'=>'Texas',
			'UT'=>'Utah',
			'VT'=>'Vermont',
			'VA'=>'Virginia',
			'WA'=>'Washington',
			'WV'=>'West Virginia',
			'WI'=>'Wisconsin',
			'WY'=>'Wyoming',
		);
		
		$abbrev = strtoupper($abbrev);
		foreach($states as $k=>$v){
			$v = strtoupper($v);
			if($abbrev == $v){
				return $k;
			}
		}
		
		return $abbrev;
		
		//return (isset($states[strtoupper($abbrev)]) && $t = $states[strtoupper($abbrev)]) ? $t : $abbrev;
	}    

}

?>