<?

class Model extends Object{

	function __construct(){
		$this->db = Factory::getDBO();
		$this->doc = Factory::getDocument();
	}
}


?>