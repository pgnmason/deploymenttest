<?

class Search extends Model{
	
	function cleanse($m){
		global $db;
		$query = 'SELECT * FROM swears';
		$db->setQuery($query);
	
		$output = array();
		$m = $this->strip($m);
		$m = strtolower($m);
		$words = $this->chunk($m);
		
		$swears = $db->loadArrayList();
		
		
		foreach($words as $w){	
			$banned  = false;
			foreach($swears as $s){		
				if(strcasecmp($w,$s['name']) != 0){
					if(substr_count($w,$s['name']) > 0){
						if($s['banned'] == 1){
							$banned = true;
						}
					}
				}
				else{
					$banned = true;
				}
				if($w == '' || strlen($w) == 0 || $w == " "){
					$banned = true;
				}
			}
			if(!$banned){
				$output[] = $w;
			}
		}
		
		$output = $this->removeArticles($output);
		//print_r($output);
		if(count($output) > 0){
			//pretty_print_r($output);
			$c = count($output);
			
			for($i = 0; $i < $c; $i++){
				if(isset($output[$i]) && strlen($output[$i]) < 3){
					unset($output[$i]);
				}
			}
		
		
			return $output;
		}
		else{
			return false;
		}
	}
	
	function strip($m){
		$m = preg_replace("/[^a-zA-Z0-9\s\"_]/", "", $m);
		//echo $m;
		return $m;
	}
	
	function chunk($m,$o=array()){
	    if(substr_count($m,'"') == 1){
			$m = str_replace('"',"",$m);
		}
		if(strpos($m,"\"") >= -1){
			$dummy = $m;		
			$start = strpos($dummy,"\"");
			$end = strpos($dummy,"\"",$start+1);
			$word = substr($m,$start,($end+1) - ($start));
			$m = substr_replace($m,'',$start,($end+1) - ($start-1));
			$o[] = $word;
			//echo "<br>Recurse<br>";
			return $this->chunk($m,$o);		
		}
		else{
			//echo $m;
			$arr = explode(" ",$m);
			
			foreach($arr as $val){
				$o[] = $val;
			}
			//print_r($o);
			return $o;
		}
	}	
	
	function removeArticles($text){
		$articles = array("the","of","to","and","a","in","is","it","you","that","he","was","for","on","are","with","as","I","his","they","be","at","one","have","this","from","or","had","by","hot","but");
		$c = count($text);
		for($i = 0; $i < $c; $i++){
			if(in_array($text[$i],$articles)){
				unset($text[$i]);
			}
		}
		return $text;
	}
	
	function condenseResults($data){     //takes in an multidimensional array of flyers and returns a single dimensional array
		$results = array();
		$used = array();
		
		foreach($data as $k){
			if(is_array($k)){
				foreach($k as $v){
					if(!in_array($v->id,$used)){
						$results[] = $v;
						$used[] = $v->id;
					}
				}
			}
		}
		
		
		return $results;
		
	}
	
}

?>