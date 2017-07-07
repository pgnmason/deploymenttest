<?
function login(){
	global $db, $document,$msalt1,$msalt2, $error;
	
	if(isset($document->login,$document->pwd)){
			
	
		$db->setQuery("select * from users where user_name = '".$db->sanitize($document->login)."' and password = '".sha1($msalt1.$db->sanitize($document->pwd).$msalt2)."'");		
		//echo $db->getQuery();
		if($db->numResults() > 0){
			$arr = $db->loadArray();
			
			if($arr['active'] == 1 && !($arr['expire_date'] > 0 && $arr['expire_date'] < time())){
				$document->addSessionVariable("user",$arr['id']);
				$db->setQuery("update users set last_login = ".time()." where id = ".$arr['id']);
				$db->query();
				return true;
			}else{
				$error = "<p class='error'>Login Error: Account Deleted or Expired!</p>";
				return false;
			}
		}
		else{
			$error =  "<p class='error'>Login Error: Invalid data provided!</p>";
			return false;
		}
	}else{
		$error =  "<p class='error'>Login Error: Please fill out the entire form!</p>";
		return false;
	}
}

function logout(){
	session_destroy();
}


function check_pass($pass,$confirm){
	return $pass == $confirm;
}

function isLoggedIn(){
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
		return true;
	}
	else{
		return false;
	}
}

function canRate(){
	if(isset($_SESSION['type']) && $_SESSION['type'] == 'members'){
		return true;
	}
	else{
		return false;
	}
}

function checkPrivelege($page){
	switch($page){
		case "view_evaluations":
			return 1;
			break;
		case "view_docs":
			return 2;
			break;
		case "employee_admin":
			return 3;
			break;
		case "manager_admin":
			return 4;
			break;
		case "system_admin":
			return 5;
			break;
		case "view_reports":
			return 6;
			break;
		case "approve_evals":
			return 7;
			break;
		case "office_admin":
			return 8;
			break;
		case "attach_docs":
			return 9;
			break;		 
	}
	return 0;
}


function isAllowed(){
}

?>