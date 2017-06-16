<?

class ContactModel extends Object{

		
	function sendEmail($data){
		$data = $this->prepData($data);
		loadComponent("Mailer");
			
		$mail = new PHPMailer();
		
		$mail->IsMail();  // telling the class to use SMTP
				
		$mail->From = $data->email;
		$mail->FromName = $data->name;
		
		$list = $this->buildEmailList($data->type);
		
		//pretty_print_r($list);
		if(count($list) == 0){ return true; }
		
		
		foreach($list as $l){
			$mail->AddAddress($l->email);
		}
			
			
		
		$mail->Subject  = $data->subject;
		$mail->Body     = $data->message;
		$mail->WordWrap = 50;
		
		if(!$mail->Send()) {
		  echo 'Message was not sent.';
		  echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
		  echo 'Message has been sent.';
		}
	}
	
	function sendInternal($data){
		$db = Factory::getDBO();
		$data = $this->prepData($data);
	
		if($data->type == 'support'){
			$db->setQuery('update counters set value = value + 1 where name ="support_tickets"');
			$db->query();			
			$db->setQuery("select * from counters where name = 'support_tickets'");
			$arr = $db->loadArray();
			$data->ticket = $arr['value'];
		}
		
		$db->insertObject("admin_mailbox",$data);
	}
	
	function prepData($data){
	
		
		$output = new Object();
		$d = "";
		
		
		if(isset($data->method)){
			unset($data->method);
		}
		
		if(isset($data->recipient)){
			$data->type = $data->recipient;
			unset($data->recipient);
		}
		
		if(isset($data->view_name)){
			unset($data->view_name);
		}
		
		if(isset($data->task)){
			unset($data->task);
		}
		
		
		$cipher = array("name","email","subject","message","type");
		
		foreach($data as $k=>$v){
			if(in_array(strtolower($k),$cipher)){
				$k = strtolower($k);
				$output->$k = $v;
			}else{
				$d .= ucwords($k).": $v\n";
			}
		}
		
		$output->data = $d;
		$output->date_created = time();
		
		return $output;		
	}
	
	function buildEmailList($task){
		$db = Factory::getDBO();
		$db->setQuery("select * from users where send_email = 1");
		$arr = $db->loadObjectList();
		$c = count($arr);
		
		if($task == 'support'){
			$level = 5;
		}else{
			$level = 14;
		}
		
		//pretty_print_r($arr);
		
		
		for($i = 0; $i<$c; $i++){
			if(!Authorization::checkAccess($arr[$i]->group,$level)){
				unset($arr[$i]);
			}
		}
		
		//pretty_print_r($arr);
		
		return $arr;
		
	}
}
?>