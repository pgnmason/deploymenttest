<?

class Page extends Object{

	protected $access_level = 1;
	public $layout_directory;
	public $model_directory;
	public $layout = 'default';
	public $name;
	public $task='display';
	private $modules = array();
	private $module_info = array();
	private $title = 'PAGE TITLE';
	public $print_name = 'Home';
	
	function checkLoggedIn(){
		
		return Authorization::loggedIn();
	}

	function setAccessLevel($num){
		$this->access_level = $num;
	}
	
	function getAccessLevel(){
		return $this->accessLevel();
	}
	
	function checkAccess($redirect = true){
		$d = Factory::getDocument();
		
		if(!isset($d->session->auth_level)){
			$this->error = "Application Error: Improper User Credentials";
			Router::raiseError(404,$this->error);
			die($this->error);
		}else{
			
			
			if(isset($d->session->auth_id,$d->session->authenticated)){
				$user = new User($d->session->auth_id);
			}else{
				$user = new User();
				$user->group = $d->session->auth_level;
			}
			
			if(!Authorization::checkAccess($user->group,$this->access_level)){
				if($redirect){
					Router::redirect("login");
				}
			}
		}
	}
	
	
	function display(){
		global $ds;
		if(defined("BROWSER_MODE") && BROWSER_MODE == "mobile" && file_exists($this->layout_directory.$this->name.$ds."mobile".$ds.$this->layout.".php")){
			require($this->layout_directory.$this->name.$ds."mobile".$ds.$this->layout.".php");
		}else{
			require($this->layout_directory.$this->name.$ds.$this->layout.".php");
		}
	}
	
	function setLayout($layout){
		$this->layout = $layout;
	}
	
	function setTask($task){
		global $app;
		$app->setPageTitle($this->title);
		$this->task = $task;
	}
	
	function loadModel(){
		$model_name = ucwords($this->name)."Model"; 
		require($this->model_directory.$this->name.".php");
		return new $model_name();
	}
	
	function render(){
		$task = $this->task;
		$this->$task();
	}
	
	function preRender(){
		return true;
	}
	
	function postRender(){
		return true;
	}
	
	function loadModule($name,$position){
		global $ds;
		$front_path = Factory::getModulePath().$this->name.$ds.$name.$ds."module.php";
		$front_general_path = Factory::getModulePath()."general".$ds.$name.$ds."module.php";
		$default_path = Factory::defaultModulePath().$this->name.$ds.$name.$ds."module.php";
		$default_general_path = Factory::defaultModulePath()."general".$ds.$name.$ds."module.php";
		
		if(!file_exists($front_path)){
			if(!file_exists($front_general_path)){
				if(!file_exists($default_path)){
					if(!file_exists($default_general_path)){
						$err = urlencode(" Module doesn't Exist!<br />$front_path<br />$front_general_path<br />$default_path<br />$default_general_path");
						Router::raiseError(404,"Error Loading Module $name.  Module doesn't Exist!");
						die("Error Loading Module $name.  Module doesn't Exist!<br />$front_path<br />$front_general_path<br />$default_path<br />$default_general_path");						
					}else{ $this->modules[$position][] = $default_general_path; }
				}else{ $this->modules[$position][] = $default_path; }	
			}else{	$this->modules[$position][] = $front_general_path; }
		}else{  $this->modules[$position][] = $front_path; }		
	}


	function renderModule($position){
		if(isset($this->modules[$position])){
			foreach($this->modules[$position] as $k){
				require($k);
			}
		}
	}
	
	function DBO(){
		return Factory::getDBO();
	}
	
	function Doc(){
		return Factory::getDocument();
	}
	
	
	function preRenderModules($module_positions){
		global $app;
		
		//pretty_print_r($module_positions);
		
		foreach($module_positions as $p){
			if(isset($this->modules[$p])){
				foreach($this->modules[$p] as $m){
					$conf = str_replace("module.php","config.php",$m);
					//echo $conf."<br />";
					
					
					if(file_exists($conf)){
						//echo "Loading $conf<br />";
						require($conf);
						foreach($styles as $s){
							$app->loadStylesheet($s);
						}
						foreach($scripts as $s){
							$app->loadScript($s);
						}
					}
				}
			}
		}
	}
}


?>