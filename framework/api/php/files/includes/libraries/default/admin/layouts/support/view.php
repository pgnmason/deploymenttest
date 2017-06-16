<?
global $document;

if(!$this->data){ die($this->error); }

$message = $this->data;

//pretty_print_r($message);
?>

<table>
<tr><th style="text-align:left">Dated Created:</th><td><?=date(ADMINDATE, $message->date_created);?></td></tr>
<tr><th style="text-align:left">Customer Name:</th><td><?= $message->name; ?></td></tr>
<tr><th style="text-align:left">Customer Email:</th><td><?= $message->email; ?></td></tr>
<tr><th style="text-align:left">Message Subject:</th><td><?= $message->subject;?></td></tr>
<tr><th style="text-align:left">Additional Data:</th></tr>
<tr><td><?= nl2p($message->data);?></td></tr>
</table>
<table>
<tr><th style="text-align:left">Message:</th></tr>
<tr><td colspan="3"><?= nl2p($message->message);?></td></tr>


<tr><th style="text-align:left">Documentation:</th></tr>
<tr><td colspan="3"><? if(strlen($message->documentation)){ echo nl2p(str_replace("::::","<strong>",str_replace(":::::","</strong>:",$message->documentation))); }else{ echo "<p>No Documentation Available.</p>"; }?></td></tr>

</table>

<?
if($message->edit_date > 0 && $message->status < 1){
$m = "<strong>Message Last Edited</strong> ".date(PRINTDATE,$message->edit_date)." by user ID: $message->edit_user";
}else if($message->edit_date > 0 && $message->status == 1){
	$m = "<strong>Message Resolved</strong> by user ID: $message->edit_user on ".date(PRINTDATE,$message->edit_date); 
}else{
	$m = "This message has not yet been addressed.";
}
?>



<p><?= $m; ?></p>