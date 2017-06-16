<?
loadComponent("mailer");
class Message extends Object{
	
	public $sender;
	public $sender_name;
	public $email_list;
	public $subject;
	public $message;
	
	
	
	function __construct($data= false){
		if($data){
			$this->load($data);
		}
	}
	
	function sendMail(){

		$mail = new PHPMailer();
		
		$mail->IsMail();  // telling the class to use SMTP
		$mail->IsHTML();  
				
		$mail->From = $this->sender;
		$mail->FromName = $this->sender_name;
		
		foreach($this->email_list as $e){
			$mail->AddAddress($e);
		}
		
		$mail->Subject  = $this->subject;
		$mail->Body     = $this->message;
		$mail->WordWrap = 50;
		$mail->Send();
	}
	
}

?>