<div id="support_stats" class="admin-module">
<h3>Support Statistics</h3>
<table>
<tr><th>Open Tickets:</th><td><?= $data->open_tickets ?></td></tr>
<tr><th>Closed Tickets:</th><td><?= $data->closed_tickets ?></td></tr>
<tr><th>Oldest Ticket:</th><td><a href="<?= Factory::siteUrl() ?>backend/support/view/message/view&id=<?= $data->oldest_ticket->id; ?>"><?= $data->oldest_ticket->ticket ?></a></td></tr>
<tr><th>Newest Ticket:</th><td><a href="<?= Factory::siteUrl() ?>backend/support/view/message/view&id=<?= $data->newest_ticket->id; ?>"><?= $data->newest_ticket->ticket ?></a></td></tr>
</table>
</div>