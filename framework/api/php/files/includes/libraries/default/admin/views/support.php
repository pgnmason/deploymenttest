<?
class SupportView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_admin_layouts, $def_admin_models;
		$this->layout_directory = $def_admin_layouts;
		$this->model_directory = $def_admin_models;
		$this->name = "support";
		$this->access_level = 5;
		$this->model = $this->loadModel();
		$this->loadModule('support_stats','rightColumn');
	}
	
	function view($group = false){
		$this->data = $this->model->getMessages();
		$this->display();
	}
	
	function message($id = false){
		global $document;		
		if(!$id){
			if(isset($document->get->id,$document->get->data) && $document->get->data == "view"){
				$id = $document->get->id;
			}else{
				$this->error = "Invalid Parameters";
				$this->data = false;
				$this->display();
				return false;
			}
		}
		$this->data = $this->model->getMessage($id);		
		if($this->data->status < 1){
			$this->loadModule("support_actions","rightColumn");
		}
		$this->display();
		
	}
	
	function rightColumn(){
		
	}
	

	function preRender(&$template){
		global $app;
		//$template->setLayout("two_column");
		$app->loadScript("library/jquery/jquery.rte");
		$app->loadScript("custom/editor");
		$app->loadStylesheet("library/editor/rte");
	}
	
	function logout(){
		Authorization::logout();
		Router::redirect("login");
	}
	
	function resolve(){
		$doc = $this->Doc();		
		$data = $doc->post;		
		if($this->model->resolve($data)){
			Router::redirect("support/list/view",true);
		}else{
			$this->setLayout("view");
			$this->error = "Unable to resolve issue at this time please try again";
			$this->message($data->id);
		}	
	}
	
	function document(){
		$doc = $this->Doc();
		$data = $doc->post;		
		if($this->model->document($data)){
			Router::redirect("support/view/message/view&id=$data->id",true);
		}else{
			$this->setLayout("view");
			$this->error = "Unable to resolve issue at this time please try again";
			$this->message($data->id);
		}	
		
		
		
	}
	
	
}

?>