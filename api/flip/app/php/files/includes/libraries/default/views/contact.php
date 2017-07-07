<?
class ContactView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_layouts, $def_models;
		$this->layout_directory = $def_layouts;
		$this->model_directory = $def_models;
		$this->name = "contact";
	}
	
	function display(){
			parent::display();
	}
	
	function sendIt(){
		$document = Factory::getDocument();
		$db = Factory::getDBO();	
		
		$model = $this->loadModel();
				
		$data = $document->post;
		
		switch($data->method){
			case "email":
				$model->sendEmail($data);
				break;
			case "internal":
				$model->sendInternal($data);
				break;
			case "both":
				$model->sendEmail($data);
				$model->sendInternal($data);
		}
		
	}
	
}


?>