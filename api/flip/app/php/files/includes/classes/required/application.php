<?

class Application extends Object{
	private $scripts = array();
	private $body_scripts = array();
	private $stylesheets = array();
	private $metas = array();
	private $title = 'Page Title';
	private $admin = false;
	private $menu = "default";
	
	
	public function __construct(){
		$d = Factory::getDocument();
		if(!isset($d->session->auth_id,$d->session->authenticated,$d->session->auth_level)){
			$d->addSessionVariable("auth_level",Factory::guestLevel());
		}
		
		$scripts = Factory::getDefaultScripts();
		$styles = Factory::getDefaultStyles();
		
		foreach($scripts as $s){
			$this->loadScript($s);
		}
		
		foreach($styles as $s){
			$this->loadStylesheet($s);
		}
	}
	
	function renderMenu($menu = false){
		if(!$menu){	$menu = $this->menu; }
		if($this->admin){
			$front_path = Factory::adminMenuPath().$menu.".php";
			$default_path = Factory::adminDefaultMenuPath().$menu.".php";		
		}else{
			$front_path = Factory::menuPath().$menu.".php";
			$default_path = Factory::defaultMenuPath().$menu.".php";
		}	
		
		
		if(!file_exists($front_path)){
			//echo Factory::viewPath().$view.".php"." doesn't exist! Trying Default<br>";
			if(file_exists($default_path)){
				//echo "Exists Loading View";
				require($default_path);
			}else{
				Router::raiseError(404,"Menu $menu doesn't exist!");
				die("Menu $menu doesn't exist");
			}
		}else{
			//echo "Exists Loading View";
			require($front_path);
		}		
	}
	
	
	function loadTemplateFile($file){
		global $template_path;
		if(file_exists($template_path.$file)){
			require($template_path.$file);
		}
	}
	
	function setMenu($def = "default"){
		$this->menu = $def;
	}
	
	function setAdmin($admin = false){
		$this->admin = $admin;
	}
	
	function addStylesheet($path,$name,$media='screen',$weight=0){
		$this->stylesheets[] = new Stylesheet($path,$media,$name,$weight);
	}
	
	function addScript($path,$name,$language='javascript',$weight=0){
		$this->scripts[] = new Script($path,$language,$name,$weight);
	}
	
	function addBodyScript($path,$name,$language='javascript',$weight=0){
		$this->body_scripts[] = new Script($path,$language,$name,$weight);
	}
	
	function loadScript($script){
		global $script_directory;
		$this->addScript($script_directory,$script.".js");
	}
	
	function loadStylesheet($script){
		global $default_css_path;
		$this->addStylesheet($default_css_path,$script.".css");
	}
	
	function loadBodyScript($script){
		global $script_absolute_directory;
		$this->addBodyScript($script_absolute_directory,$script.".js");
	}
	
	function addMeta($name,$content){
		$this->metas[] = new Meta($name,$content);
	}	
	
	function setPageTitle($title){
		$this->title = $title;
	}
	
	function getPageTitle(){
		return $this->title;
	}
	
	function getStylesheetPath(){
		global $default_css_path;
		return $default_css_path;
	}
	
	public function outputHeader(){
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		echo '<head>'."\n";		
		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
		echo $this->getMeta();
		echo '<title>'.$this->title.'</title>'."\n";
		echo $this->getStylesheets();
		echo $this->getScripts();
		echo "</head>\n";
		echo "<body>\n";
	}
	
	public function outputFooter(){
		echo "</body>\n";
		echo "</html>";
	}
	
	
	public function header($module_positions = false){
		
		if($module_positions){
			global $view;
			$view->preRenderModules($module_positions);
		}
		
		echo $this->getMeta();
		echo $this->getStylesheets();
		echo $this->getScripts();
		echo $this->getBodyScripts();
	}
	
	
	public function getMeta(){
		$output ='';
		
		objectAscSort($this->metas,"weight");
		
		foreach($this->metas as $meta){
			$output .= "<meta name=\"$meta->name\" content=\"$meta->content\" />\n";
		}
		
		return $output;
	}
	
	public function getScripts(){
		global $ds;
		$output ='';
		
		objectAscSort($this->scripts,"weight");
		
		foreach($this->scripts as $script){
			$output .= "<script src=\"$script->path$script->name\" language='$script->language'></script>\n";
		}
		
		return $output;
	}
	
	
	public function getBodyScripts(){
		global $ds;
		$output ='';
		
		objectAscSort($this->body_scripts,"weight");
		
		foreach($this->body_scripts as $script){
			$output .= "<!-- BOF $script->name -->\n\t<script>\n";
			$output .= file_get_contents($script->path.$script->name);
			$output .= "\n\t</script>\n<!-- EOF $script->name -->\n";
		}
		
		return $output;
	}
	
	
	
	public function getStylesheets(){
		global $ds;
		$output ='';
		
		objectAscSort($this->stylesheets,"weight");
		
		
		foreach($this->stylesheets as $style){
			$output .= "<link  href='$style->path$style->name' media='$style->media' rel='stylesheet' type=\"text/css\"  />\n";
		}
		
		return $output;
	}
	
	
	function loadView($view, $admin = false){
		global $ds;		
		
		if($admin){
			$front_path = Factory::adminViewPath().$view.".php";
			$default_path = Factory::adminDefaultViewPath().$view.".php";		
		}else{
			$front_path = Factory::viewPath().$view.".php";
			$default_path = Factory::defaultViewPath().$view.".php";
		}		
		
		if(!file_exists($front_path)){
			//echo Factory::viewPath().$view.".php"." doesn't exist! Trying Default<br>";
			if(file_exists($default_path)){
				//echo "Exists Loading View";
				
				
				$viewName = ucwords($view)."View";
				require($default_path);
				return new $viewName;
			}else{
				Router::raiseError(404,"View $view doesn't exist");
				die($default_path." doesn't exist! View $view doesn't exist");
			}
		}else{
			//echo "Exists Loading View";
			
			
			$viewName = ucwords($view)."View";
			require($front_path);
			return new $viewName;
		}
	}
	
	
	
	
	
	
}

class Stylesheet extends Object{
	public $path;
	public $media;
	public $name;
	public $weight = 0;
	
	public function stylesheet($path,$media,$name,$weight){
		$this->path = $path;
		$this->media = $media;
		$this->name = $name;
		$this->weight = $weight;
	}
}

class Script extends Object{
	public $path;
	public $language;
	public $name;
	public $weight = 0;
	
	public function script($path,$language,$name,$weight){
		$this->path = $path;
		$this->language = $language;
		$this->name = $name;
		$this->weight = $weight;
	}
}

class Meta extends Object{
	public $name;
	public $content;
	
	public function meta($name,$content){
		$this->name = $name;
		$this->content = $content;
	}
}

?>