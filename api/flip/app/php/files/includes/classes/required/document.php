<?
class Document extends Object{

	public $post;
	public $get;
	public $session;
	
	function load($arr){
		parent::load($arr);
	}	
	
	function document(){
		$this->post = new Object();
		$this->get = new Object();
		$this->session = new Object();
	
		if(isset($_POST)) $this->post->load($_POST);
		if(isset($_GET)) $this->get->load($_GET);
		if(isset($_REQUEST)) $this->get->load($_REQUEST);
		if(isset($_FILES)) $this->files = $_FILES;
		if(isset($_COOKIE)) $this->cookies = $_COOKIE;
		if(isset($_SESSION)) $this->session->load($_SESSION);
		$this->base = $_SERVER['DOCUMENT_ROOT'];
		$this->uriBase = "http://".$_SERVER['HTTP_HOST'];
	}
	
	function addSessionVariable($key,$value){
		
		$_SESSION[$key] = $value;	
		/*echo "<pre>";
		var_dump($key);
		var_dump($value);
		var_dump($_SESSION);
		echo "</pre>";*/
		$this->reload();
	}
	
	function reload(){
		$this->document();
	}

}
?>