<?

class ACO extends Object{

	public $name;
	public $parent = NULL;
	public $permissions;
		
	function __construct($id){
		$db = Factory::getDBO();
		$db->setQuery("select * from acl_acos where id = $id");
		//echo $db->getQuery();
		$arr = $db->loadArray();
		if($arr['parent'] == 0){
			unset($arr['parent']);
		}
		$this->load($arr);
		
		$this->buildPermissions();
	}
	
	function getPermissions($group){
		if(in_array($group,$this->permissions['allowed'])  && !in_array($group,$this->permissions['denied'])){
			return true;
		}else if(in_array($group,$this->permissions['denied'])){
			return false;
		}else{
			return 'UNSET';
		}
	}
	
	function buildPermissions(){
		$db = Factory::getDBO();
		$this->permissions['allowed'] = array();
		$this->permissions['denied'] = array();
		$db->setQuery('select * from acl_perm where aco_id = '.$this->id);
		$perms = $db->loadObjectList();
		foreach($perms as $p){
			if($p->state > 0){
				$this->permissions['allowed'][] = $p->aro_id; 
			}else{
				$this->permissions['denied'][] = $p->aro_id;
			}
		}
		
		if($this->parent != NULL){
			$perms = $this->getAncestors();
			$this->permissions['allowed'] = array_merge($this->permissions['allowed'],$perms['allowed']);
			$this->permissions['denied'] = array_merge($this->permissions['denied'],$perms['denied']);
		}
		
	}
	
	function getAncestors($obj = NULL,$perms = array()){
		
		if($obj == NULL){
			$obj = $this;
			$perms['allowed'] = array();
			$perms['denied'] = array();
		} 
		
		
		$p = new ACO($obj->parent);
		
		//pretty_print_r($perms,"PERMISSIONS");
		//pretty_print_r($p,"Parent Object");
		
		
		$perms['allowed'] = array_merge($p->permissions['allowed'],$perms['allowed']);
		$perms['denied'] = array_merge($p->permissions['denied'],$perms['denied']);
		
		if($p->parent !== NULL){
			return $p->getAncestors($p,$perms);
		}else{
			return $perms;
		}
		
	}
}
?>