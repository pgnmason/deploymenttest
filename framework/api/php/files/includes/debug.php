<?
if(isset($_GET['debug'],$_GET['password']) && $_GET['password'] == "fargo123"){
	if($_GET['debug'] == 1){	
		$_SESSION['debug'] =true;
	}
	else if($_GET['debug'] == 0){
		$_SESSION['debug'] =false;
	}
}

$filename = basename($_SERVER['REQUEST_URI']);
//echo "<pre>";print_r($_SERVER);echo "</pre>";
//echo $filename."<br />";

if(strpos($filename,'test') !== false || strpos($filename,'cart') !== false || strpos($filename,'add_locations') !== false || strpos($filename,'completed-registration') !== false || strpos($filename,'listings-added') !== false || strpos($filename,'agent-registration') !== false || strpos($filename,'agent-update') !== false || strpos($filename,'member-registration') !== false || strpos($filename,'member-update') !== false  || strpos($filename,'member-completed') !== false ){
	$loc = "https://".$_SERVER['HTTP_HOST'].str_replace($filename,'',$_SERVER['REQUEST_URI']).$filename;
	if(!isset($_SERVER['HTTPS'])){
		//echo $loc;
		header("Location: $loc");
	}
}
else{
	$loc = "http://".$_SERVER['HTTP_HOST'].str_replace($filename,'',$_SERVER['REQUEST_URI']).$filename;
	if(isset($_SERVER['HTTPS'])){
		//echo $loc;
		header("Location: $loc");
	}
}

?>