<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();

if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 


if(empty($_GET['task']) || empty($_GET['email'])){
	$db->setQuery("select * from pdf_downloads order by download_time desc");
	
	$arr = $db->loadObjectList();
	
	$leads = array();
	
	foreach($arr as $a){
		$leads[$a->name][] = $a;
	}
}else{
	$db->setQuery("select * from pdf_downloads where email_address = '".mysql_real_escape_string($_GET['email'])."' order by download_time desc");
	
	$arr = $db->loadObjectList();
}
?>
<?php require("inc/admin_header.php");?>
<h1>Leads Administration</h1>

<? if(empty($_GET['task']) || empty($_GET['email'])){ ?>
<table>
<tr><th>Name</th><th>Email</th><th>Files Downloaded</th><th>Last Download</th></tr>
<?


foreach($leads as $k=>$v){
	$downloaded_files = array();
	$last_download = "";
	$number_downloaded = count($v);
	$email = "";
	
	foreach($v as $file){
		
		if(empty($email)){
			$email = $file->email_address;
		}
		
		if(empty($last_download)){
			$last_download = $file->download_time;
		}
		
		if(!in_array($file->link,$downloaded_files)){
			$downloaded_files[] = $file->link;
		}
		
		
		
	}
	
	
	?>
	<tr><td><a href="leads.php?task=byemail&email=<?php echo $email?>"><?php echo $k?></a></td><td><?php echo $email; ?></td><td><?php echo count($downloaded_files); ?></td><td><?php echo $last_download; ?></td></tr>
	
	<?
	
	
	
}



?>
</table>

<? }else{ 

if(count($arr) == 0){
	echo "No Users";
	//echo "<br />".$db->getQuery();
	
	exit();
}







?>
<h2><?php echo $arr[0]->name;?></h2>
<h3><a href="mailto:<?php echo $arr[0]->email?>"><?php echo $arr[0]->email?></a></h3>


<table>
<tr><th>File Name</th><th>Download Time</th></tr>
<?php

foreach($arr as $a){
 ?>
<tr><td><?php echo $a->link; ?></td><td><?php echo $a->download_time?></td></tr>
<? } ?>
</table>


<? } ?>

<?php require("inc/admin_footer.php"); ?>