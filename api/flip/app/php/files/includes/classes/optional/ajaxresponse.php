<?php 

class AjaxResponse extends Object{
	public $status;
	public $message;
	public $data;
	public $code;

	function __construct($status="error",$message="Forbidden Access",$code=403,$data = array()){
		$this->status = $status;
		$this->message = $message;
		$this->data = $data;
		$this->code = $code;
	}

}

?>