<?
/*
* CLASSNAME - Session
* Function: Storable class object that 
*
*
*
*
*
*/


class Session extends Object{
	
	
	function load($id){
		global $db, $document;
		$db->setQuery("update msys_sessions set enddate = ".time()." where id = $id");
		$db->query();
		$db->setQuery("select * from msys_sessions where id = $id");
		$arr = $db->loadArray();
		parent::load($arr);
		$this->data = session_real_decode($this->data);
	}
	
	function session(){
		global $db, $document;
		if(!isset($document->sess_id)){
			$this->user_id = $document->user;		
			$this->startdate = time();
			$db->insertObject('msys_sessions',$this);
			$document->addSessionVariable('sess_id',$db->lastID());
		}else{
			$this->load($document->sess_id);
		}
	}
	
	
	function addAction($key,$str){
		global $db;
	
		if(isset($this->$key)){
			$this->$key .= "::::".$str;
		}
		else{
			$this->$key = "::::".$str;
		}
		
		$db->updateObject("msys_sessions",$this,"id");
	}
}
?>