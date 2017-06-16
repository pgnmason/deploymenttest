<?
/*
* CLASSNAME - USER
* Function: Storable class object that 
*
*
*
*
*
*/
class User extends Object{
	
	
	private $requirements = array("username","email");
	
	function load($id){
		global $db, $document, $ds;
		$db->setQuery("select * from users where id = $id");
		$arr = $db->loadArray();
		parent::load($arr);
	}
	
	function user($id=false){
		
		if($id === false){
			global $db, $document;
			if(isset($document->user)){
				$this->load($document->user);			
			}
		}else{
			$this->load($id);
		}
	}

	
	function add($data,$table="users"){
		
		$auth = new Authorization();	
		$check = array();
		
		
		foreach($this->requirements as $r){
			if(!isset($data[$r])){
				$this->error = "Missing Parameters";
				return false;
			}
			$check[$r] = $data[$r];
		}
		
		if($auth->checkData($check)){
			global $msalt1;
			global $msalt2;
			
			$db = Factory::getDBO();
			
			$obj = new Object();
			
			$obj->load($data);
			$obj->pass = hash("sha512",$msalt1.$obj->salt.$obj->pass.$msalt2);

			unset($obj->x,$obj->y);
			
			$res = $db->insertObject($table,$obj);
			
			//var_dump($res);
			
			return $res;
	
		}else{
			$this->error = $auth->error;
			return false;
		}			
	}
	
	
	function getRequirements(){
		return $this->requirements;
	}
	
	function addRequirement($data){
		$this->requirements[] = $data;
	}
	
	function getAclChain(){
		
		$chain = array();
		$chain[] = $this->group;
		
		$db = Factory::getDBO();
		
		$db->setQuery("select `parent` from `acl_aros` where id = '$this->group'");
		
		$obj = $db->loadObject();
		
		$p = $obj->parent;
		
		while(true){
			if($p !== 0){
				$chain[] = $p;
				$db->setQuery("select `parent` from `acl_aros` where id = '$p'");
			
				$obj = $db->loadObject();
				
				$p = $obj->parent;
				
				if($p == 0){ break; }
			}else{ break; }
		}
		
		return array_reverse($chain);		
	}
	
}




?>