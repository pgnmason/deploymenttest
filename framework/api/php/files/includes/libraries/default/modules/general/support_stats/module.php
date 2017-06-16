<?
$db = $this->DBO();
$db->setQuery("select * from admin_mailbox where type = 'support'");
$arr = $db->loadObjectList();

$data = new Object();
$data->closed_tickets = 0;
$data->open_tickets = 0;


foreach($arr as $o){
	if($o->status == 1){
		$data->closed_tickets++;
	}else{ $data->open_tickets++; }
}


$db->setQuery("select * from admin_mailbox where type = 'support' and status = 0");
$arr = $db->loadObjectList();

objectAscSort($arr,"date_created");
$data->oldest_ticket = $arr[0];
$data->newest_ticket = $arr[count($arr)-1];



require("layout.php");
?>