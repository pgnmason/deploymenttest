<?
/*
Filename: utilities.php
Purpose: this loads the utilities library that will hold most generic functions such as bind, execute, and date conversions.  
Most database functions are deprecated and should be used with the new Database object.
*/
$error = '';


/*
##
## CORE FUNCTIONS
##
*/

function __autoload($className){
	eval("class $className {}");
}
/**/

function loadFiles(){
	global $file_path;
	$arr = walk_directory($file_path);
	foreach($arr as $a){
		require($file_path.$a);
	}
}


function loadClasses(){
	global $class_path;
	$arr = walk_directory($class_path);

	foreach($arr as $a){
		require($class_path.$a);
	}
}


function isgood($var){
	if(isset($var) && $var != '' && $var != NULL){return true;}
	else{return false;}
}

function loadModule($class){
	global $module, $ds;
	if(file_exists($module.strtolower($class).".php")){
		require($module.strtolower($class).".php");
	}else{
		die("Module could not be loaded: $class");
	}
}

function loadComponent($class){
	global $component, $ds;
	if(file_exists($component.strtolower($class).".php")){
		require($component.strtolower($class).".php");
	}else{
		die("Component could not be loaded: $class");
	}
}




/*
##
## DATABASE FUNCTIONS
##
*/

/*
Function: sanitize
Purpose: Takes in a string or array and returns the input with all quotes and unsafe values escapted
*/
function sanitize($db){
	if(is_array($db)){
		foreach($db as $k=>$v){
			$db[$k] = mysql_real_escape_string($v);
			if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $db[$k]."<BR><BR>";}
		}
	}
	else{
		$db = mysql_real_escape_string($db);
		if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $db."<BR><BR>";}
	}
	return $db;
}


/*
Function: bind
Purpose: Takes in a variety of parameters and updates the database table based on those parameters.
*/
function bind($table,$data,$key='id',$task="insert"){ //table is the table in the database,data is the data to be stored (IT MUST MATCH THE TABLE NAMES), key is the key of the table, task can be update or insert
	$fields = array();
	$values = array();
	
	foreach($data as $k=>$v){
		$fields[] = mysql_real_escape_string($k);
		$values[] = mysql_real_escape_string($v);
	}
	$i = count($fields);
	$error = true;
	
	if(strtolower($task) == "update"){
		$middle = "";
		$begin = "update $table set ";
		$end = " where $key =".$data[$key];		
		for($c = 0 ; $c<$i-1; $c++){
			$middle .= $fields[$c]."='".$values[$c]."', ";
		}
		$middle .= $fields[$i-1]."='".$values[$i-1]."'";		
		$sql = $begin.$middle.$end;		
		//echo $sql;
		if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
		mysql_query($sql) or $error = false; 
	}
	else{
		$middle = "";
		$begin = "insert into $table (";
		for($c = 0 ; $c<$i-1; $c++){
			$middle .= $fields[$c].", ";
		}
		$middle .= $fields[$i-1].")  values('";
		for($c = 0 ; $c<$i-1; $c++){
			$middle .= $values[$c]."', '";
		}
		$middle .= $values[$i-1]."')";
		$sql = $begin.$middle;
		//echo $sql; 
		if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
		mysql_query($sql) or $error = false; 
	}
	
	if($error == false){
		return false;
	}
	else{
		return true;
	}
	
}

/*
Function: exectute
Purpose: Accepts a sql query and returns an associative array based on the results
*/
function execute($sql){
	if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
	$res = mysql_query($sql);
	$arr = array();
	if($row = mysql_fetch_assoc($res)){
		foreach($row as $r){
			$r = stripslashes(stripslashes($r));
		}
		return $row;
	}
}

/*
Function: loadObject
Purpose: Accepts a sql query and returns a generic object based on the result
*/
function loadObject($sql){
	$s = new Object();
	if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
	$res = mysql_query($sql);
	$arr = array();
	if($row = mysql_fetch_assoc($res)){
		foreach($row as $r){
			$r = stripslashes(stripslashes($r));
		}
		$s->load($row);
		return $s;
	}	
}

/*
Function: loadObject
Purpose: Accepts a sql query and returns an array of associative arrays based on the result
*/
function executeMultiple($sql){
	if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
	$res = mysql_query($sql);
	$arr = array();
	while($row = mysql_fetch_assoc($res)){
		$arr[] = $row;
	}
	$c = count($arr);
	for($i = 0; $i < $c; $i++){
		foreach($arr[$i] as $k){
			$k = stripslashes(stripslashes(stripslashes($k)));
		}
	}
	return $arr;
}

/*
Function: loadObject
Purpose: Accepts a sql query and returns an array of generic objects based on the result
*/
function loadObjectArray($sql){
	if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
	$res = mysql_query($sql);
	$arr = array();
	while($row = mysql_fetch_assoc($res)){
		$arr[] = $row;
	}
	$c = count($arr);
	for($i = 0; $i < $c; $i++){
		foreach($arr[$i] as $k){
			$k = stripslashes(stripslashes(stripslashes($k)));
		}
	}
	$output = array();
	
	foreach($arr as $o){
	 	$obj = new Object();
		$obj->load($o);
		$output[] = $obj;
	}
	return $output;
}

/*
Function: loadObject
Purpose: Accepts a table name, data to be checked, the value to be returned, and the index to check against and returns the value.
*/
function getResult($table,$data,$key,$index){
	$table = sanitize($table);
	$data = sanitize($data);
	$key = sanitize($key);
	$index = sanitize($index);
	
	$arr = execute("select $key from $table where $index = '$data'");
	return $arr[$key];
}


/*
##
## STRING FUNCTIONS
##
*/



/*
Function: random_pass
Purpose: Accepts an optional length and returns a random alphanumeric string.  Useful for creating passwords and salts 
*/
function random_pass($length=12){
$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
srand((double)microtime()*1000000);
$i = 0;
$pass = '' ;
while ($i <= $length) {
	$num = rand() % 33;
	$tmp = substr($chars, $num, 1);
	$pass = $pass . $tmp;
	$i++;
}

return $pass;
}


/*
Function: random_pass
Purpose: Accepts an optional length and returns a random alphanumeric string.  Useful for creating passwords and salts 
*/
function expandParagraphs($p,$num=''){
	$output = nl2p($p,$num);	
	echo $output;
}


/*
Function: abbreviateParagraphs
Purpose: Accepts a string of text and N number of words.  It will return the first N words in the string and will append the a Read More prompt if the length of the string is greater than N
*/
function abbreviateParagraphs($p,$num){
	$strarr = explode(" ",$p);
	$c = count($strarr);
	if(count($strarr) > $num){
		$strarr = array_slice($strarr,0,$num);
	}
	
	$p = implode(" ",$strarr);
	
	if($c > $num){
		$p .= "...<small class='orange'>(Click Read More Icon to View Full Bio)</small>";
	}
	$output = nl2p($p);
	
	echo $output;
}

/*
Function: nl2p
Purpose: This is similar to the nl2br function that is included in PHP.  It takes a string and an optional N number of paragraphs.  It will return up to N paragraphs. 
*/
function nl2p($p,$num=''){
	$arr = explode("\n",$p);
	$output = '';
	
	if($num == '' || $num >= count($arr)){
		$num = count($arr);
	}
	for($i = 0; $i < $num; $i++){
		$output .= "<p>".$arr[$i]."</p>\n";
	}
	return $output;
}

/*
Function: obfuscate
Purpose: Simple obfuscation function to hide email addresses and links from hackers
*/
function obfuscate($input)
{
	$output = ""; 
    foreach (str_split($input) as $obj) 
    { 
        $output .= '&#' . ord($obj) . ';'; 
    }
    return $output;
}

/*
Function: countParagraphs
Purpose: Takes a string and returns the number of new line characters.  This is only useful when dealing with input from a text area or a file.
*/
function countParagraphs($p){
	if(strlen($p) == 0){
		return  0;
	}
	else{
		$arr = explode("\n",$p);
		return count($arr);
	}
}

/*
Function: countChars
Purpose: Takes in a string returns its length.  Synonym for strlen. 
*/
function countChars($p){
	return strlen(trim($p));
}


/*
Function: countWords
Purpose: Takes in a string and counts the number of words. 
*/
function countWords($p){
	$strarr = explode(" ",trim($p));
	return count($strarr);
}


/*
Function: compareChars
Purpose: Takes in a string and a number of characters N.  If the length of the string is greater than N it returns true. 
*/
function compareChars($p,$n){
	if(strlen($p) > $n){
		return true;
	}
	else{
		return false;
	}
}


/*
Function: compareWords
Purpose: Takes in a string and a number of words N.  If the number of words in the string is greater than N it returns true. 
*/
function compareWords($p,$n){
	$strarr = explode(" ",$p);
	if(count($strarr) > $n){
		return true;
	}
	else{
		return false;
	}
}



/*
Function: shortenText
Purpose: Takes in a string and a number of characters N.  It then truncates the length of p to N characters. 
*/
function shortenText($p,$n){
	if(strlen($p) > $n){
		return substr($p,0,$n-3)."...";
	}
	else{
		return $p;
	}
}



/*
Function: entityEnc
Purpose: Takes in a string and converts it to its entity code
*/

function entityEnc($str)
{
  $newstring = '';
  $text_array = explode("\r\n", chunk_split($str, 1));
  for ($n = 0; $n < count($text_array) - 1; $n++)
  {
    $newstring .= "&#" . ord($text_array[$n]) . ";";
  }
  return $newstring;
}

/*
##
## ARRAY FUNCTIONS
##
*/




/*
Function: objectDescSort
Purpose: Takes and array of objects and sorts them based on key descendingly.
*/

function objectDescSort(&$object, $key){
	for ($i = count($object) - 1; $i >= 0; $i--)
	{
	  $swapped = false;
	  for ($j = 0; $j < $i; $j++)
	  {
		   if ($object[$j]->$key < $object[$j + 1]->$key)
		   {
				$tmp = $object[$j];
				$object[$j] = $object[$j + 1];      
				$object[$j + 1] = $tmp;
				$swapped = true;
		   }
	  }
	  if (!$swapped) return;
	}
} 

/*
Function: objectDescSort
Purpose: Takes and array of objects and sorts them based on key ascendingly.
*/

function objectAscSort(&$data, $key)
{
    for ($i = count($data) - 1; $i >= 0; $i--)
    {
      $swapped = false;
      for ($j = 0; $j < $i; $j++)
      {
           if ($data[$j]->$key > $data[$j + 1]->$key)
           {
                $tmp = $data[$j];
                $data[$j] = $data[$j + 1];       
                $data[$j + 1] = $tmp;
                $swapped = true;
           }
      }
      if (!$swapped) return;
    }
}

/*
Function: pretty_print_r
Purpose: Takes a variable and an optional name.  It calls print_r on the variable with a label in preformatted form.
*/
function pretty_print_r($arr,$name=''){
	echo "<pre>";
	echo $name."<br />";
	print_r($arr);
	echo "</pre>";
}


/*
Function: array_in_array
Purpose: Takes two arrays and checks to see if any values in the needles array are in the haystack array  
*/
function array_in_array($needles, $haystack){
	foreach($needles as $needle){
		if(in_array($needle,$haystack)){
			return true;
		}
	}
	return false;
}

function array_get_index($array, $value){
	$val = -1;
	$c = count($array);
	for($i = 0; $i < $c; $i++){
		if($array[$i] == $value){
			return $i;
		}
	}
	
	return $val;
}

function array_chunks($array, $number){
	
	$c = count($array);
	if($c > $number){
		$pages = ceil($c/$number);
		$arr = array();
		
		for($i = 0; $i < $pages; $i++){
			$arr[] = array_slice($array, $i * $number,$number);
		}
		
		
		return $arr;
	}
	else{
		return $array;
	}
	
}


/* 
Function: filter_array 
Purpose: Takes a dictionary and an array of test values. Returns array of test values that are in the dictionary array.  

Takes an optional mode argument, its values follow.
0: The test array is of the same type as the dictionary, $param argument is ignored.
1: The test array is an array of arrays, the $param arguement is used to test.
2: The test array is an array of objects, the $param arguement is used to test.
	
*/
function filter_array($dict, $test, $mode=0,$param='id'){
	
	$output = array();
	
	foreach($test as $t){
		if($mode === 0){
			$check = $t;
		}else if($mode === 1){
			$check = $t[$param];
		}else if($mode === 2){
			$check = $t->$param;
		}
		
		if(in_array($check,$dict)){
			$output[] = $t;
		}
		
	}
	
	return $output;
	
	
	
}

/*
##
## URL FUNCTIONS
##
*/
/*
Function: curPageURL
Purpose: Returns the current pages url
*/
function curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}




/*
##
## DATE FUNCTIONS
##
*/

/*
Function: convertDateToDB
Purpose: Takes a date format and converts it to the format used by MySQL's datetime object  
*/
function convertDateToDB($date){
	$d = strtotime($date);
	$d = date("Y-m-d H:i:s",$d); //ex 2009-05-29 13:13:29
	return $d;
}


/*
Function: convertDateToNormal
Purpose: Takes a date format and converts it to the standard MM/DD/YYYY format
*/
function convertDateToNormal($date){
	$d = strtotime($date);
	$d = date("m/d/Y",$d); //ex 05/29/2009
	return $d;
}



/*
##
## EMAIL FUNCTIONS
##
*/


/*
Function: contains_bad_str
Purpose: Takes an email message and checks to see if any banned strings are within the message.  Prevents header injections
*/
function contains_bad_str($str_to_test) {
  global $bad;
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
	  $bad = $bad_string;
	  return true;
	}
  }
  return false;
}


/*
Function: checkEmail
Purpose: takes an email address and checks to see if it is a valid address. Basic
*/
function checkEmail($email) {
   if(eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email)){
      return FALSE;
   }
   list($Username, $Domain) = split("@",$email);
   if(getmxrr($Domain, $MXHost)) {
      return TRUE;
   }
   else {
      if(fsockopen($Domain, 25, $errno, $errstr, 30)) {
         return TRUE; 
      }
      else 
      {
         return FALSE; 
      }
   }
}





/*
##
## ERROR FUNCTIONS
##
*/

/*
Function: showError
Purpose: Takes an integer and checks it against known error codes.  This is used for custom error pages.  
*/
function showError($message){
	switch($message){
		case 1:
			$output = "CODE 001: ACCESS DENIED.  <br />You are trying to access a page that either: <br />1. Has restricted access. <br />or<br />2. Has expired.<br />";
			break;
		case 2:
			$output = "CODE 002: MISSING CRITERIA. <br />The page you are trying to view requires certain criteria that are missing to function correctly.  <br />Please navigate away from this page and try again.<br />";
			break;
		case 3:
			$output = "CODE 003: INVALID CRITERIA. <br />The page you are trying to view has been provided with fraudulent or invalid criteria.<br />";
			break;
		case 4:
			$output = "CODE 004: PAGE NOT FOUND. <br />The page you are trying to view cannot be found at this time.<br />";
			break;
		case 5:
			$output = "CODE 005: PAGE INACTIVE. <br />The page you are trying to view is currently inactive.  <br />"; 
			break;
		case 99:
			$output = "CODE 099: MISSING CRITERIA. <br />This page requires criteria that is currently missing to accurately display errors.<br />"; 
			break;
		default:
			$output = "CODE 000: UNKNOWN ERROR. <br />Oops! You have run across and uknown error.  <br />Please contact <a href=\"mailto:".obfuscate("support@tripwitt.com")."?subject=Tripwitt.com Unknown Error\" class='orange'>".obfuscate("support@tripwitt.com")."</a> to help us fix this problem. <br />";
			break;
	}
	
	$output .= " If you feel you have reached this page in error, please <a href=\"mailto:".obfuscate("support@tripwitt.com")."?subject=Tripwitt.com Error\" class='orange'>contact</a> an administrator.";
	echo $output; 
}




/*
Function: failedSearch
Purpose: generic failed search method.  It can be replaced.
*/
function failedSearch($case=1){
	$output = '<div class="search_error">'."\n";
	$output .= '<p class="exclamation">Currently we do not have a Travel Professional under this listing -</p>'."\n";
	$output .= '<p>'."\n";
	$output .= '&bull;&nbsp;Please Check back often - we may have one tomorrow<br />'."\n";
	$output .= '&bull;&nbsp;Try changing your search terms and don\'t forget to check your spelling<br />'."\n";
	$output .= '&bull;&nbsp;Please check our Search Tips for additional options<br />'."\n";
	$output .= '&bull;&nbsp;or email us at support@TripWitt.com  for  profile suggestions.<br />'."\n";
	$output .= "</p>\n";
	$output .= '<p><br /><a onclick="history.go(-1)" class="back_arrow" style="cursor:pointer">Back to Search</a></p>'."\n";
	$output .= '</div>';	
	return $output;
}



/*
Function: _unserialize
Purpose: Unserializes an object saved in a database or session correctly.
*/
function __unserialize($sObject) {
   
	$__ret =preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $sObject );
	//echo $__ret;
   
	return @unserialize($__ret);
   
}





/*

Function: session_real_decode
Purpose: Decodes the session data stored in database;


*/

define('PS_DELIMITER', '|');
define('PS_UNDEF_MARKER', '!');

function session_real_decode($str)
{
    $str = (string)$str;

    $endptr = strlen($str);
    $p = 0;

    $serialized = '';
    $items = 0;
    $level = 0;

    while ($p < $endptr) {
        $q = $p;
        while ($str[$q] != PS_DELIMITER)
            if (++$q >= $endptr) break 2;

        if ($str[$p] == PS_UNDEF_MARKER) {
            $p++;
            $has_value = false;
        } else {
            $has_value = true;
        }
       
        $name = substr($str, $p, $q - $p);
        $q++;

        $serialized .= 's:' . strlen($name) . ':"' . $name . '";';
       
        if ($has_value) {
            for (;;) {
                $p = $q;
                switch ($str[$q]) {
                    case 'N': /* null */
                    case 'b': /* boolean */
                    case 'i': /* integer */
                    case 'd': /* decimal */
                        do $q++;
                        while ( ($q < $endptr) && ($str[$q] != ';') );
                        $q++;
                        $serialized .= substr($str, $p, $q - $p);
                        if ($level == 0) break 2;
                        break;
                    case 'R': /* reference  */
                        $q+= 2;
                        for ($id = ''; ($q < $endptr) && ($str[$q] != ';'); $q++) $id .= $str[$q];
                        $q++;
                        $serialized .= 'R:' . ($id + 1) . ';'; /* increment pointer because of outer array */
                        if ($level == 0) break 2;
                        break;
                    case 's': /* string */
                        $q+=2;
                        for ($length=''; ($q < $endptr) && ($str[$q] != ':'); $q++) $length .= $str[$q];
                        $q+=2;
                        $q+= (int)$length + 2;
                        $serialized .= substr($str, $p, $q - $p);
                        if ($level == 0) break 2;
                        break;
                    case 'a': /* array */
                    case 'O': /* object */
                        do $q++;
                        while ( ($q < $endptr) && ($str[$q] != '{') );
                        $q++;
                        $level++;
                        $serialized .= substr($str, $p, $q - $p);
                        break;
                    case '}': /* end of array|object */
                        $q++;
                        $serialized .= substr($str, $p, $q - $p);
                        if (--$level == 0) break 2;
                        break;
                    default:
                        return false;
                }
            }
        } else {
            $serialized .= 'N;';
            $q+= 2;
        }
        $items++;
        $p = $q;
    }
    return @unserialize( 'a:' . $items . ':{' . $serialized . '}' );
}





/*
##
## GENERIC CLASSES
##
*/

/*
Classname: Object
Purpose: Generic object class.
Functions: load -- Takes in an array or object and loads all of its values in to the object as public variables.  
*/


class Object{

	function load($arr = false){
		if($arr){
			foreach($arr as $k=>$v){
				$this->$k = $v;
			}
		}
	}
	
	function toArray(){
		$output = array();
		foreach($this as $k=>$v){
			$output[$k]=$v;
		}
		return $output;
	}
	
}
?>