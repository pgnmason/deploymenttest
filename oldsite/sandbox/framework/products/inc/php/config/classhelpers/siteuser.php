<?
// This is a specific class that will be dependant on the site.
class SiteUser extends User{

	function siteuser($id = false, $use_username = false){
		$db = Factory::getDBO();
		if($id !== false && !is_numeric($id)){
			$use_username = true;
		}	
	
	
		if($use_username){
			
			
			$id = mysql_real_escape_string($id);
			
			
			$db->setQuery("select * from users where username = '$id'");
			//echo $db->getQuery();
			$obj = $db->loadObject();
			$id = $obj->id;	
		}
		
		$id = $db->sanitize($id);
		$db->setQuery("select * from users where id = $id");
		$this->load($db->loadObject());
	}
	
	private function getProfile($id = false){}
	
	private function makeProfile(){}
	
	function load($arr){
		
		if(is_array($arr) || is_object($arr)){
		
			foreach($arr as $k=>$v){
				$this->$k = $v;
			}
		}
	}

	function loadProfile(){
		$id = $this->id;
		$sql = "select * from profiles where user_id = $id";
		$db = Factory::getDBO();
		$db->setQuery($sql);
		
		$obj = $db->loadObject();
		
		return $obj;
	}

}




?>