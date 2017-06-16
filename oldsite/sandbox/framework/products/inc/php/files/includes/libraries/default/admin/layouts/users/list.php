<table class="admin_table">
<tr><th>Name</th><th>Username</th><th>Email</th><th>Date Registered</th><th>Last Visit</th><th>Active</th><th>Actions</th></tr>
<? foreach($this->data as $user){?>
<tr>
	<td><?= $user->firstname ?> <?= $user->lastname ?></td>
	<td><?= $user->username ?></td>
	<td><?= $user->email ?></td>
	<td><?= date(ADMINDATE,$user->register_date); ?></td>
	<td><?= date(ADMINDATE,$user->last_visit); ?></td>
	<td><?= ($user->active = 1) ? "Yes":"No"; ?></td>
	<td><a href="<?= Factory::siteUrl()."admin-ajax/users/details/details/view&uid=".$user->id?>" onclick="return hs.htmlExpand(this, { contentType:'iframe'});">View Details</a></td>
</tr>
<? } ?>
</table>

<div>
<a href="<?= Router::makeLink(2,'users','add','display'); ?>">Add User</a>
</div>