<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- InstanceBegin template="/Templates/popup.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Contact Us</title>
<!-- InstanceEndEditable -->
<link href="../css/screen.css" type="text/css" rel="stylesheet"/>
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="pop-top"></div>
<div id="pop-middle"> <!-- InstanceBeginEditable name="ptitle" -->
  <p> <img src="../images/page header/contact_header.jpg" /></p>
  <!-- InstanceEndEditable --> <!-- InstanceBeginEditable name="content" -->
<?php 
if($_POST["submitted"]){
	
import_request_variables("p","var_");

$divider = "----------------------------------------------------------------------------------\n\n";


$body .= "First Name : ".$var_firstname."\n\n";
$body .= "Last Name : ".$var_lastname."\n\n";
$body .= "Phone: ".$var_phone."\n\n";
$body .= "Email: ".$var_email."\n\n";
$body .= $divider;
$body .= "Comments: \n".$var_comments."\n\n";


function is_valid_email($email) {
 if(preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email)){
  return true;
 }
 return false;
}

function contains_bad_str($str_to_test) {
  $bad_strings = array(
                "content-type:"
                ,"mime-version:"
                ,"multipart/mixed"
		,"Content-Transfer-Encoding:"
                ,"bcc:"
		,"cc:"
		,"to:"
  );
  
  foreach($bad_strings as $bad_string) {
    if(eregi($bad_string, strtolower($str_to_test))) {
      echo "$bad_string found. Suspected injection attempt - mail not being sent.";
      exit;
    }
  }
}

function contains_newlines($str_to_test) {
   if(preg_match("/(%0A|%0D|\\n+|\\r+)/i", $str_to_test) != 0) {
     echo "newline found in $str_to_test. Suspected injection attempt - mail not being sent.";
     exit;
   }
} 

if(!is_valid_email($var_email)) {  
  echo 'Invalid email submitted - mail not being sent - click the button to return to the form. ';
  exit;
}

contains_bad_str($var_email);
contains_bad_str($body);
contains_newlines($var_email);


ini_set("sendmail_from","info@mylittleoutback.com");
$title = "Contact from your site";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
$headers .= 'From: MLO Site <info@mylittleoutback.com>' . "\r\n";
$headers .= 'Reply-To: '.$email. "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

$ok = @mail("todd@mylittleoutback.com",$title,$body,$headers);
if ($ok)
{
echo "<p class=thanks>Your information has been successfully sent.</p>";
}
else{
echo "<p class=thanks>Email error! Please contact My Little Outback and alert them of this error.</p>";
}


}
?>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="contact_form">
    <label>First Name</label><input type="text" name="firstname" id="firstname" />
    <label>Last Name</label><input type="text" name="lastname" id="lastname" />
    <label>Email</label><input type="text" name="email" id="email" />
    <label>Phone</label><input type="text" name="phone" id="phone" />
    <input type="hidden" name="submitted" id="submitted" value="1" />
    <label>Comments</label><textarea name="comments" id="comments"></textarea>
    <input name="submit" type="submit" id="submit" style="width:80px;" onclick="MM_validateForm('firstname','','R','lastname','','R','email','','RisEmail','phone','','R');return document.MM_returnValue" value="submit" />
  </form>

  <!-- InstanceEndEditable -->
  <div style="clear:both"></div>
</div>
<div id="pop-bottom"></div>
</body>
<!-- InstanceEnd -->
</html>
