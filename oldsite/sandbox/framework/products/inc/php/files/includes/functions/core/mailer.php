<?
$mailed = false;
$bad = "";
$message ='';
$error = "";

function draw_dash(){
	$mess = "<BR>--------------------------------------------------------------<BR>";
	return $mess;
}

function build_profile($data){
	$mess = '';
	if(isset($data['name'])){
		$mess .= $data['name']."<BR>";
	}
	else{
		$mess .= $data['first_name']." ".$data['last_name']."<BR>";
	}
	
	if(isset($data['title'])){
		$mess .= $data['title']."<BR>";
	}
	
	if(isset($data['company'])){
		$mess .= $data['company']."<BR>";
	}
	
	if(isset($data['city']) && isset($data['state'])){
		if(isset($data['address']) && isset($data['zip'])){
			$mess .= $data['address']."<BR>".$data['city'].",".$data['state']." ".$data['zip']."<BR>";
		}
		else if(isset($data['zip'])){
			$mess .= $data['city'].",".$data['state']." ".$data['zip']."<BR>";
		}
		else{
			$mess .= $data['city'].",".$data['state']."<BR>";
		}
	}
	else if(isset($data['state'])){
		$mess .= $data['state']."<BR>";		
	}
	
	if(isset($data['phone'])){
		$mess .= $data['phone']."<BR>";
	}
	
	if(isset($data['email'])){
		$mess .= $data['email']."<BR>";
	}
	
	return $mess;
}

function add_options($data){
	$mess = '';
	if(isset($data['private_duty']) || isset($data['pediatric']) || isset($data['hospice']) || isset($data['medicare']) || isset($data['staffing']) || isset($data['payment']) || isset($data['callme'])){
		$mess .= draw_dash();
		$mess.="<BR>Requested Services<BR><BR>";
		if(isset($data['private_duty'])){$mess.=$data['private_duty'];}
		if(isset($data['pediatric'])){$mess.=$data['pediatric'];}
		if(isset($data['hospice'])){$mess.=$data['hospice'];}
		if(isset($data['medicare'])){$mess.=$data['medicare'];}
		if(isset($data['staffing'])){$mess.=$data['staffing'];}
		if(isset($data['payment'])){$mess.=$data['payment'];}
		if(isset($data['call_me'])){$mess.=$data['call_me'];}
	}
	return $mess;
}

function add_comments($data){
	$mess = '';
	$mess .= draw_dash();
	$mess .= "Comments <BR><BR>".$data['comments'];
	$mess.="<BR>";
	
	return $mess;
}

function check_sec(){
	if($data['sec'] == $data['code']){
		return true;
	}
	else{
		return false;
	}
}


function build_verify($data,$mode,$metric){
	$message = '';
	switch($mode){	
		case 1:
			$message .= "Hello ".$data['login'].",<BR><BR>";
			$message .= "Thank you for registering with TripWitt.com.<BR><BR>";			
			$message .= "To complete your TripWitt.com registration process, please confirm your email address by clicking on the following link:<BR><BR>";
			$message .= "http://www.tripwitt.com/verifier?id=".$data[$metric]."&mode=".$mode."&code=".$data['salt']." <BR><BR>";
			$message .= "(If you can't click the link, copy and paste it into your web browser.)<BR><BR>";			
			$message .= "Your Profile has been created and you may login anytime at http://www.TripWitt.com using the information below: <BR><BR>";
			$message .= "\t\t Username:".$data['login']."<BR><BR>";
			$message .= "Please keep this email for your records.<BR><BR>";
			$message .= "Thanks!<BR>";
			$message .= "TripWitt.com<BR><BR><BR>";
			$message .= "If you believe you have gotten this email in error or have any questions about this email, please contact support@tripwitt.com.<BR><BR><BR>";
			$message .= "PLEASE DO NOT REPLY TO THIS EMAIL.";
			break;
		case 2:
			$message .= "Hello ".$data['login'].",<BR><BR>";
			$message .= "Thank you for joining with TripWitt.com and becoming our newest \"Tripwitter\".<BR><BR>";
			$message .= "We received a request to create a member account for you. To complete your registration process, please click this link:<BR><BR>";
			$message .= "http://www.tripwitt.com/verifier.php?id=".$data[$metric]."&mode=".$mode."&code=".$data['salt']." <BR><BR>";
			$message .= "(If you can't click the link, copy and paste it into your web browser.)<BR><BR>";
			$message .= "Your account has been created and you may login anytime at http://www.TripWitt.com using the information below: <BR><BR>";
			$message .= "Please keep this email for your records.<BR><BR>";
			$message .= "Thanks!<BR>";
			$message .= "TripWitt.com<BR><BR>";
			$message .= "If you believe you have gotten this email in error or have any questions about this email, please contact support@tripwitt.com.<BR><BR><BR>";
			$message .= "PLEASE DO NOT REPLY TO THIS EMAIL.";	
			break;
	}
	return $message;
}

function build_reminder($data){
	$id = $data['agent_id'];
	$salt = $data['salt'];
	$message = '';
	$message .= "Dear TripWitt Member,<BR><BR>";
	$message .= "We've noticed that your account is going to expire soon.<BR><BR>";
	$message .= "Click the link below to login to your account to begin the renewal process.<BR><BR>";
	$message .= "http://www.tripwitt.com/renewal?id=$id&salt=$salt <BR><BR>";
	$message .= "Please keep this email for your records.<BR><BR>";
	$message .= "Sincerely<BR>";
	$message .= "TripWitt.com<BR><BR>";
	$message .= "If you believe you have gotten this email in error or have any questions about this email, please contact support@tripwitt.com.<BR><BR><BR>";
	$message .= "PLEASE DO NOT REPLY TO THIS EMAIL.";
	return $message;	
}

function build_thanks($data,$cart){
	$listings = viewListings($cart->agent);
	//echo $listings;
	$listings = str_replace("<p>","",$listings);
	$listings = str_replace("</p>","<BR>",$listings);
	$message  = '';
	$message .= "Hello ".$data['login'].",<BR><BR>";
	$message .= "Thank you for ordering more listings from TripWitt.com.<BR><BR>";
	$message .= "Your profile has been updated and you will now appear in searches for the following listings:<BR>";
	$message .= "\t\t $listings <BR><BR>";
	$message .= "Please keep this email for your records.<BR><BR>";
	$message .= "Sincerely<BR>";
	$message .= "TripWitt.com<BR><BR>";
	$message .= "If you believe you have gotten this email in error or have any questions about this email, please contact support@tripwitt.com.<BR><BR><BR>";
	$message .= "PLEASE DO NOT REPLY TO THIS EMAIL.";
	return $message;
}


function print_mail($to,$from,$sub,$mess){
	echo $to."<BR>".$from."<BR>".$sub."<BR>".$mess;
}

function contact($data){
	//print_r($data);Larissa Soroka <Larissa@superiorinhome.com>
	$message = '';
	$realmail = "support@tripwitt.com";
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$subject = $data['subject'];
	$from = $data['email'];
	$message .= build_profile($data);
	//$message .= add_options();
	$message .= add_comments($data);
	//print_mail($fargomail,$from,$subject,$message);
	$message = str_replace("<BR>","\n",$message);
	
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $realmail, "Subject: $subject",$message, "From: ".$from)) { 
			  	echo "<div class='search_error'><p class='exclamation'> Your message has been sent successfully </p><p><a class='back_arrow' href='index'>Home</a></p></div>";
			  }
			  else {
					$error = "ERROR: Mail Could Not Be Sent At This Time";
			  }
			  //$mailed = true;
		  }  //else
	//print_r($data);
	
}


function sendEmail($data){
	//print_r($data);Larissa Soroka <Larissa@superiorinhome.com>
	$message = '';
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$agent = get_agent($data['agent_id']);
	$to = $agent['email'];
	if(isset($data['subject'])){
		$subject = "TripWitt.com Client Inquiry: ".$data['subject'];
	}
	
	
	$from = $data['email'];
	$message .= build_profile($data);
	//$message .= add_options();
	$message .= add_comments($data);
	//print_mail($fargomail,$from,$subject,$message);
	$message = str_replace("<BR>","\n",$message);
	
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $to, "Subject: $subject",$message, "From: ".$from)) { 
			  		return true;
			  }
			  else {
					return false;
			  }
			  //$mailed = true;
		  }  //else
	//print_r($data);
	
}



function sendVerification($data,$mode=1){
	//print_r($data);Larissa Soroka <Larissa@superiorinhome.com>
	switch($mode){
		case 1:
			$metric = "agent_id";
			break;
		case 2:
			$metric = "user_id";
			break;
		default:
			$metric = "agent_id";
			break;
	}
	
	$message = build_verify($data,$mode,$metric);
	
	
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$to = $data['email'];
	$subject = "TripWitt.com Account Activation";	
	$from = "noreply@tripwitt.com";
	
	//echo $message;
	
	$message = str_replace("<BR>","\n\r",$message);
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $to, "Subject: $subject",$message, "From: ".$from)) { 
			  		return true;
			  }
			  else {
					return false;
			  }
			  //$mailed = true;
		  }  //else
	//print_r($data);
}


function sendWelcome($data,$mode=1){
	switch($mode){
		case 1:
			$metric = "agent_id";
			break;
		case 2:
			$metric = "user_id";
			break;
		default:
			$metric = "agent_id";
			break;
	}
	
	$message = build_welcome($data,$mode,$metric);
	
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$to = $data['email'];
	$subject = "Welcome to TripWitt";	
	$from = "noreply@tripwitt.com";
	
	//echo $message;
	$message = str_replace("<BR>","\n\r",$message);
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $to, "Subject: $subject",$message, "From: ".$from)) { 
			  		return true;
			  }
			  else {
					return false;
			  }
			  //$mailed = true;
		  }  //else
	//print_r($data);
}


function sendReminder($data){
	$message = build_reminder($data);
	
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$to = $data['email'];
	$subject = "TripWitt.com Account Expiration Reminder";	
	$from = "noreply@tripwitt.com";
	
	//echo $message;
	$message = str_replace("<BR>","\n\r",$message);
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $to, "Subject: $subject",$message, "From: ".$from)) { 
			  		return true;
			  }
			  else {
					return false;
			  }
			  //$mailed = true;
		  }  //else
}


function sendThankYou($data, $cart){
	$message = build_thanks($data,$cart);
	
	$testmail ="mandawgus@gmail.com";
	$fargomail ="nate@fargodesignco.com";
	$to = $data['email'];
	$subject = "TripWitt.com Additional Listings Purchased";	
	$from = "noreply@tripwitt.com";
	
	//echo $message;
	$message = str_replace("<BR>","\n\r",$message);
	 
	 
		 if (contains_bad_str($message))
			{
				$error = "ERROR: BAD STRINGS FOUND!!!!<br>".$bad;
			} // if mail
		  else{
			  //send email
			  if(mail( $to, "Subject: $subject",$message, "From: ".$from)) { 
			  		return true;
			  }
			  else {
					return false;
			  }
			  //$mailed = true;
		  }  //else
	
	
}


?>