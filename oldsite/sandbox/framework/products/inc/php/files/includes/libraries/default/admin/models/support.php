<?

class SupportModel extends Object{

	function resolve($data){
		unset($data->task,$data->layout,$data->view_name,$data->ajax);	
		$db = Factory::getDBO();
		$msg = $this->getMessage($data->id);	
		foreach($data as $k=>$v){
			$msg->$k = $v;
		}		
		$msg->status = 1;
		return $db->updateObject("admin_mailbox",$msg);
	}
	
	function document($data){
		unset($data->task,$data->layout,$data->view_name,$data->ajax);	
		$db = Factory::getDBO();
		$msg = $this->getMessage($data->id);	
		$d = $data->documentation;
		unset($data->documentation);		
		foreach($data as $k=>$v){
			$msg->$k = $v;
		}		
		$user = Factory::getUser($msg->edit_user);
		
		//pretty_print_r(Factory::getDocument());
		$msg->documentation .= "\n::::".date(ADMINDATE,$data->edit_date)." - User ".$user->firstname." ".$user->lastname." (<span class='italic normal'>Id - ".$msg->edit_user." | Login - ".$user->username."</span>):::::\n".$d;		
		return $db->updateObject("admin_mailbox",$msg);
	}
	
	
	
	
	
	function getMessage($id){
		$db = Factory::getDBO();
		$db->setQuery("select * from admin_mailbox where id = $id");
		$msg = $db->loadObject();
		return $msg;
	}
	
	function getMessages(){
		$db = Factory::getDBO();
		$db->setQuery("select * from admin_mailbox order by status asc, ticket asc");
		$msg = $db->loadObjectList();
		return $msg;
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