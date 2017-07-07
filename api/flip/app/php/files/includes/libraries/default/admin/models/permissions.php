<?

class PermissionsModel extends Object{

	function prepList($perms){
		global $db;
		$list = array();
		
		
		foreach($perms as $perm){
			$p = new ACO($perm->aco_id);	
			$db->setQuery("select name from acl_aros where id = ".$perm->aro_id);
			$obj = $db->loadObject();
			
			$o = new Object();
			
			$o->name = $p->name;
			$o->group = $obj->name;
			$o->state = $perm->state;
			$o->id = $perm->id;
			
			$list[] = $o;
			
			
			
		}
		
		return $list;
		
	}
	
	
	function loadPerms(){
		$db = Factory::getDBO();
		$db->setQuery("select * from acl_acos");
		$arr = $db->loadObjectList();
		return $arr;
	}
	
	function loadPerm($id){
		$db = Factory::getDBO();
		$db->setQuery("select * from acl_perm where id = $id");
		$arr = $db->loadObject();
		return $arr;
	}
	
	function loadGroups(){
		$db = Factory::getDBO();
		$db->setQuery("select * from acl_aros");
		$arr = $db->loadObjectList();
		return $arr;
	}
	
	function add($data){
		$db = Factory::getDBO();
		unset($data->task,$data->layout,$data->view_name,$data->ajax);
				
		$e = $db->insertObject("acl_perm",$data);
		
		if(!$e){ $this->error = "Bad Information: ".$db->getQuery(); }
		return $e;
	}
	
	function edit($data){
		$db = Factory::getDBO();
		unset($data->task,$data->layout,$data->view_name,$data->ajax);
		
		//pretty_print_r($data);	
		$e = $db->updateObject("acl_perm",$data);
		
		if(!$e){ $this->error = "Bad Information: ".$db->getQuery(); }
		return $e;
	}
	
	function delete($data){
		$db = Factory::getDBO();
		$ids = implode(",",$data->add);
		
		$db->setQuery("delete from acl_perm where id in ($ids)");
		
		//pretty_print_r($data);	
		$e = $db->query();
		
		if(!$e){ $this->error = "Bad Information: ".$db->getQuery(); }
		return $e;
	}
}

?>