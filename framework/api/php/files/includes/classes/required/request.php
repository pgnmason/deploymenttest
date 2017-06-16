<?
class Request extends Object{
	function getVar($name = 'name', $source = 'post', $default = false, $search = false){
		$doc = Factory::getDocument();
		
		$sources = array("post","get");
		
		if(isset($doc->$source->$name)){
			return $doc->$source->$name;
		}else if($search){
			foreach($sources as $s){
				if(isset($doc->$s->$name)){
					return $doc->$s->$name;
				}
			}
			return $default;
		}else{
			return $default;
		}
	}
}

?>