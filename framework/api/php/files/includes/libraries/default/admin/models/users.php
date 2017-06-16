<? 

class UsersModel extends Model{

	function loadUser($id = false){
		if(!$id){
			$doc = Factory::getDocument();
			
			if(isset($doc->post->uid)){
				$id = $doc->post->uid;
			}else if(isset($doc->get->uid)){
				$id = $doc->get->uid;
			}else{
				return false;
			}
		}
		
		$this->db->setQuery('select * from users where id = '.$id);
		return $this->db->loadObject();
	}
	
	
	
	function add($data){
		$db = Factory::getDBO();
		unset($data->task,$data->layout,$data->view_name,$data->ajax);
		
		
		if($data->password !== $data->confirm){ $this->error = "Passwords Must Match!"; return false; }
		$data->pass = $data->password;
		unset($data->confirm,$data->password);
		
		$data->salt = random_pass(20);
		
		
		$u = new User();

		if($u->add($data->toArray())){
			return true;
			
		}else{
			$this->error = $u->error;
			return false;
		}
	}
}

?>