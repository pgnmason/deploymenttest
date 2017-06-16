<table class="admin_table">
<tr><th>Ticket</th><th>Date Created</th><th>Name</th><th>Email</th><th>Subject</th><th>Resolved</th></tr>
<? foreach($this->data as $message){?>
<tr>
	<td><a href="<?= Factory::siteUrl() ?>backend/support/view/message/view&id=<?= $message->id; ?>"><?= $message->ticket ?></a></td>
	<td><?= date(ADMINDATE, $message->date_created); ?></td>
	<td><?= $message->name ?></td>
	<td><?= $message->email ?></td>
	<td><?= $message->subject ?></td>
	<td><?= ($message->status == 1) ? "Yes":"No"; ?></td>
</tr>
<? } ?>
</table>