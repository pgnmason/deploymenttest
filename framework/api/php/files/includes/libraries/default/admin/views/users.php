<?
class UsersView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_admin_layouts, $def_admin_models;
		$this->model_directory = $def_admin_models;
		$this->layout_directory = $def_admin_layouts;
		$this->name = "users";
		$this->access_level = 2;
		$this->model = $this->loadModel();
	}
	
	function view($group = false){
		$db = Factory::getDBO();
		if($group){
			$db->setQuery("select * from users where group = $group");
		}else{
			$db->setQuery("select * from users");
		}
		$res = $db->loadObjectList();
		$this->data = $res;
		$this->display();
	}
	
	function details(){
		$this->data = $this->model->loadUser();
		$this->display();
	}
	
	function logout(){
		Authorization::logout();
		Router::redirect("login");
	}
	
	function add(){
		$document = Factory::getDocument();
		if(isset($document->post->firstname)){
			if($this->model->add($document->post)){
				Router::redirect("users/list/view",true);
			}else{
				die($this->model->error);
			}
		}
	}
	
	
	
}

?>