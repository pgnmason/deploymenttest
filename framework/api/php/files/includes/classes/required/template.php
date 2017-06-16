<?

class Template extends Object{
	protected $path;
	protected $layout = '';
	protected $layout_path;
	protected $view;
	protected $view_task;
	protected $view_layout;
	protected $name;
	
	function template(){
		global $template_path, $ds;
		
		if(defined("BROWSER_MODE") && BROWSER_MODE == "mobile" && file_exists($template_path.$ds."mobile".$ds)){
			$this->path = $template_path.$ds."mobile".$ds;
		}else{
			$this->path = $template_path;
		}
		$this->layout_path = $this->path."layouts".$ds;
	}
	
	
	function setLayout($layout){
		$this->layout = $layout;
	}
	
	function setName($name){
		$this->name = $name;
	}
	
	function setView(&$view,$task,$layout){
		$view->setLayout($layout);
		$view->setTask($task);
		$this->view = $view;
	}
	
	function render(){
	    $this->view->preRender($this);
		
		
		if(strlen($this->layout) > 0  && file_exists($this->layout_path.$this->layout.".php")){
			$file = $this->layout_path.$this->layout.".php";
		}else{
			$file = $this->path."index.php";
		}
		
		//echo $file;
		require($file);
		$this->view->postRender($this);
	}
	
}

?>