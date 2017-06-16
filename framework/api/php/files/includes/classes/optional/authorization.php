<?
class Authorization extends Object{
	
	public $error;
	
	function authenticate($login,$password,$return_id = false,$return_group=false){
		global $msalt1,$msalt2,$authtable,$authmetric,$pname,$saltname;
		$db = Factory::getDBO();
		
		$db->setQuery("select * from $authtable where $authmetric='$login'");
		
		if($db->numResults() > 0){
			$user = $db->loadObject();
			
			$pass_hash = hash("sha512",$msalt1.$user->$saltname.$password.$msalt2);
			
			if($pass_hash == $user->$pname){
				if(!$return_id){
					return true;
				}else{
					if($return_group){
						return $user->group;
					}else{
						return $user->id;
					}
				}
			}else{
				$this->error = "Invalid Credentials, please try again";
				return false;
			}
			
			
		}else{
			$this->error = "Invalid Credentials, please try again";
			return false;
		}
		
	}
	
	
	/*
		Functions
	*/
	//Expects Data in an associative array
	function checkData($data,$table='users'){
		$fields = array();
		$values = array();
		$db = Factory::getDBO();
		
		foreach($data as $k=>$v){
			$fields[] = mysql_real_escape_string($k);
			$values[] = mysql_real_escape_string($v);
		}
		
		$limit = count($fields);
		
		$query = array();
		
		for($i = 0; $i< $limit; $i++){
			$db->setQuery("select * from $table where `".$fields[$i]."` = '".$values[$i]."'");
			
			if($db->numResults() > 0){
				$this->error = "There is another user with a duplicate ".$fields[$i];
				return false;
			}
		}
		
		return true;
		
	}
	
	function login($login,$password){
		
		if($this->authenticate($login,$password)){
			$document = Factory::getDocument();
			$document->addSessionVariable("auth_id",$this->authenticate($login,$password,true));
			$document->addSessionVariable("auth_level",$this->authenticate($login,$password,true,true));
			$document->addSessionVariable("authenticated",true);
			$uid = $_SESSION['auth_id'];
			$document->addSessionVariable("auth_user",imageEncode(Factory::getUser($uid)));
			$db = Factory::getDBO();
			$cookie = $document->cookies['PHPSESSID'];
			$db->setQuery("replace into user_sessions SET uid = '".mysql_real_escape_string($uid)."', sessid = '".mysql_real_escape_string($cookie)."',  last_access = '".time()."'");
			$db->query();
				 
			return true;
		}else{
			return false;
		}
		
	
	}
	
	function logout(){
		global $document;
		
		if(isset($_SESSION['auth_id'])){
			$db = Factory::getDBO();
			$cookie = $document->cookies['PHPSESSID'];
			$uid = $_SESSION['auth_id'];
			$db->setQuery("delete from user_sessions where uid = '".mysql_real_escape_string($uid)."' and sessid = '".mysql_real_escape_string($cookie)."'");
			$db->query();
		}
		session_destroy();
	}
	
	
	function loggedIn(){
		$d = Factory::getDocument();
		$sess = $d->session;
		
		if(isset($sess->auth_id,$sess->authenticated)){
			return true;
		}else{
			return false;
		}
	}
	
	function getAclChain($group){
		
		$chain = array();
		$chain[] = $group;
		
		$db = Factory::getDBO();
		
		$db->setQuery("select `parent` from `acl_aros` where id = '$group'");
		
		$obj = $db->loadArray();
		
		$n = 'parent';
		
		$p = $obj['parent'];
		
		while(true){
			if($p !== 0){
				$chain[] = $p;
				$db->setQuery("select `parent` from `acl_aros` where id = '$p'");
			
				$obj = $db->loadArray();
				
				$p = $obj['parent'];
				
				if($p == 0){ break; }
			}else{ break; }
		}
		
		//pretty_print_r($chain);
		
		return array_reverse($chain);		
	}
	
		
	function checkAccess($group,$level){
	
		//echo "GROUP: $group <br />LEVEL: $level";
		$perms = array();
		$aco = new Aco($level);
		//pretty_print_r($aco);
		$aro_chain = Authorization::getAclChain($group);
		
		//pretty_print_r($aro_chain);
		
		foreach($aro_chain as $aro){
			$perms[] = $aco->getPermissions($aro);
			//echo $aro." ".var_dump($aco->getPermissions($aro))."<br />";
		}
		
		//var_dump($perms);
		
		$result = Authorization::resolvePermissions($perms);
		
		/*echo "<pre>";
		var_dump($result);
		var_dump($perms);
		var_dump($aro_chain);
		var_dump($aco);
		echo "</pre>";
		//die();*/
		return $result;
	}
	
	function resolvePermissions($perms){
		
		foreach($perms as $perm){
			//var_dump($perm);
			//echo "<br />";
			
			if($perm === "UNSET"){
				continue;
			}else{
				$res = $perm;
			}
		}
		
		
		
		if(!isset($res)){
			$res = false;
		}
		
		//var_dump($res);
		
		return $res;
		
	
	
	}
}
?>