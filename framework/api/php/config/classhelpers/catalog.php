<?php
class CategoryListing extends Object{
	
	function analyze(){
		$cat_count = array();
		$scat_count = array();
		$mcat_count = array();
		$mscat_count = array();
		
		foreach($this->categories as $k=>$v){
				$cat_count[$k] = count($v);
		}
		
		foreach($this->sub_categories as $k=>$v){
				$scat_count[$k] = count($v);
		}
		
		foreach($this->music_categories as $k=>$v){
				$mcat_count[$k] = count($v);
		}
		
		foreach($this->music_subcategories as $k=>$v){
				$mscat_count[$k] = count($v);
		}
		
		$this->category_data = $cat_count;
		$this->subcategory_data = $scat_count;
		$this->music_category_data = $mcat_count;
		$this->music_sub_category_data = $mscat_count;
		
		arsort($this->category_data);
		arsort($this->subcategory_data);
		arsort($this->music_category_data);
		arsort($this->music_sub_category_data);
		
		$this->categorize();
		
	}
	
	
	function categorize(){
		$this->prepFlyerList();
		
		$top_four = array(0,0,0,0);
		$keys = array("category_data","subcategory_data","music_category_data","music_sub_category_data");
		$names = array("categories","sub_categories","music_categories","music_subcategories");
		
		$top_four = $this->groupData($top_four,$keys,$names);
		
		var_dump($top_four);
		
		asort($top_four);
		
		foreach($top_four as $k=>$v){
			$tmp = $k;
			$k = explode("::::",$k);
			var_dump($k);
			//echo $k[0];
			$a = $this->$k[0];
			$top_four[$k[1]] = $a[$k[1]]; 
			unset($top_four[$tmp]);
		}
		
		$used = array();
		$total_cats = 0;
		
		
		foreach($top_four as $k=>$v){
			$c = count($v);
			for($i = 0; $i<$c; $i++){
				
				if(!in_array($v[$i],$used)){
					$used[] = $v[$i];
				}else{
					unset($v[$i]);
				}
			}
			$top_four[$k] = $v;
			$total_cats += count($v);
		}
		
		uasort($top_four,"cmp");
		
		if($total_cats < $this->total_flyers){
			$misc= array();
			foreach($this->flyer_list as $flyer){
				if(!in_array($flyer->id,$used)){
					$misc[] = $flyer->id;
				}
			}
			$top_four['Miscellaneous'] = $misc;
			
		}
		
		foreach($top_four as $k=>$v){
			$c = count($v);
			for($i = 0; $i<$c; $i++){
				if(isset($v[$i])){
					$v[$i] = $this->flyer_list[$v[$i]];
				}
			}
			$top_four[$k] = $v;
		}
		
		
		
		$this->top_cats = $top_four;
		
		//print_r($top_four);
		
	}
	
	
	function groupData($top_four, $keys, $names){
		$keycount = count($keys);
		
		for($i = 0; $i<$keycount; $i++){
			foreach($this->$keys[$i] as $k=>$v){
				print_r($top_four);
				echo "$k = $v\n";
				if(min($top_four) < $v  && $v > 2){
					$top_four[$names[$i]."::::$k"] = $v;
					arsort($top_four);
					array_pop($top_four);
				}
			}
			
		}
		/*
		
		
		
		
		
		foreach($this->subcategory_data as $k=>$v){
			if(min($top_four) < $v && $v > 2){
				$top_four["sub_categories::::$k"] = $v;
				arsort($top_four);
				array_pop($top_four);
			}
		}
		
		foreach($this->music_category_data as $k=>$v){
			if(min($top_four) < $v && $v >= 2){
				$top_four["music_categories::::$k"] = $v;
				arsort($top_four);
				array_pop($top_four);
			}
		}
		
		foreach($this->music_sub_category_data as $k=>$v){
			if(min($top_four) < $v && $v >= 2){
				$top_four["music_subcategories::::$k"] = $v;
				arsort($top_four);
				array_pop($top_four);
			}
		}*/
		
		return $top_four;
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	function prepFlyerList(){
		$output = array();
		foreach($this->flyer_list as $flyer){
			$output[$flyer->id] = $flyer;
		}
		$this->flyer_list = $output;
	}
	
}


function cmp($a,$b){
	if (count($a) == count($b)) {
        return 0;
    }
    return (count($a) < count($b)) ? 1 : -1;
	
}