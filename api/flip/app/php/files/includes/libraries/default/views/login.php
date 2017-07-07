<?
class LoginView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_layouts;
		$this->layout_directory = $def_layouts;
		$this->name = "login";
	}
	
	function display(){		
		if(!$this->checkLoggedIn()){
			parent::display();
		}else{
			Router::redirect("home");
		}
	}
	
	function signin(){
		global $authmetric,$pname,$home_dir,$document,$ds;
		
		$document = Factory::getDocument();
		$data = $document->post;
		if(!isset($data->$authmetric,$data->$pname) || strlen($data->$authmetric) == 0 && strlen($data->$pname) == 0){
			$this->error = "Error Signing In: Please fill out the entire form";
			$this->display();
		}else{
			echo "Signing In";
			
			
			$auth = new Authorization();
			
			
			if($auth->login($data->$authmetric,$data->$pname)){
				echo "YAY LOGGED IN";
				
				touch($document->base.$ds.$home_dir."/logs/logins.txt");
				
				if(strlen($data->redirect) === 0){
					//Router::redirect('home');
				}else{
					//Router::redirect($data->redirect);
				}
			}else{
				$this->error = "Error Signing In: ".$auth->error;
				$this->display();
			}
		}			
	}
	
	function logout(){
		global $authmetric,$pname,$home_dir,$document,$ds;
		//loadComponent('Authorization');
		touch($document->base.$ds.$home_dir."/logs/logins.txt");
		Authorization::logout();
		//Router::redirect("home",false);
	}
	
	function checkLoggedIn(){
		
		return Authorization::loggedIn();
	}
	
}


?>