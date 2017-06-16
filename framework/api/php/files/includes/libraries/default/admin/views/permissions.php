<?
class PermissionsView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_admin_layouts,$def_admin_models;
		$this->layout_directory = $def_admin_layouts;
		$this->model_directory = $def_admin_models;
		$this->name = "permissions";
		$this->access_level = 13;
		$this->model = $this->loadModel();
	}
	
	function view($group = false){
		$db = Factory::getDBO();	
		
		if($group){
			$db->setQuery("select * from acl_perm where aro_id = $group order by aco_id");
		}else{
			$db->setQuery("select * from acl_perm order by aco_id asc, aro_id asc");
		}
		$res = $db->loadObjectList();
		
		$this->data = $this->model->prepList($res);
		
		$this->display();
	}
	
	function add(){
		$document = Factory::getDocument();
		if(isset($document->post->aco_id)){
			if($this->model->add($document->post)){
				Router::redirect("permissions/list/view",true);
			}else{
				die($this->model->error);
			}
		}
	}
	
	function edit(){
		$document = Factory::getDocument();
		if(isset($document->post->aco_id)){
			if($this->model->edit($document->post)){
				Router::redirect("permissions/list/view",true);
			}else{
				die($this->model->error);
			}
		}
	}
	
	
	function delete(){
		$document = Factory::getDocument();
		if(isset($document->post->add)){
			if($this->model->delete($document->post)){
				Router::redirect("permissions/list/view",true);
			}else{
				die($this->model->error);
			}
		}
	}
	
	function logout(){
		Authorization::logout();
		Router::redirect("login");
	}	
	
	
	
	function preRender(&$template){
		global $app;
		$template->setLayout("two_column");
	}
}

?>