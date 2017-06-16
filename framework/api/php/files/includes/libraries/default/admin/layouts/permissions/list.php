<?
$perms = $this->data;
?>
<form method="post" id="the_form">
<table class="admin_table">
<tr><th>Permission Name</th><th>User Group</th><th>Acceess</th><td>Edit</td><td>Delete</td></tr>
<? foreach($perms as $perm){ ?>
<tr>
	<td><?= $perm->name?></td>
	<td><?= $perm->group ?></td>
	<td><?= ($perm->state == 1) ? "Allowed":"Denied"; ?></td>
	<td><input type="radio" name="edit" value="<?= $perm->id; ?>"></td>
	<td><input type="checkbox" name="add[]" value="<?= $perm->id?>"></td>
</tr>
<? } ?>
<tr><td>&nbsp;</td></tr>
<tr>
	<td><input type="button" onClick=" alert($('#task').attr('name')); $('#task').val('display'); alert($('#task').attr('value')); $('#layout').val('add'); $('#the_form').submit();" value="Add"></td>
	<td><input type="button" onClick="$('#task').val('display'); $('#layout').val('edit'); $('#the_form').submit();" value="Edit"></td>
	<td><input type="button" onClick="if(confirm('Are you sure that you wish to delete this permission?  This will be a permanent decision and may affect the way the the website functions.')){ $('#task').val('delete'); $('#the_form').submit(); }else{ return false; }" value="Delete"></td>
</tr>
</table>
<input type="hidden" name="task" id="task" value="">
<input type="hidden" name="layout" id="layout" value="">
<input type="hidden" name="view_name" id="view_name" value="permissions">
</form>