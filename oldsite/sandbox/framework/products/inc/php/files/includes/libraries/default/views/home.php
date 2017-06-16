<?
class HomeView extends Page{
	protected $error = '';
	
	function __construct(){
		global $def_layouts;
		$this->layout_directory = $def_layouts;
		$this->name = "home";
		$this->access_level = 1;
	}
}

?>