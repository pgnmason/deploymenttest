<form method="post" action="backend/users">

<table>
<tr>
<td>First Name</td>
<td><input type="text" class="text" name="firstname" /></td>
</tr>

<tr>
<td>Last Name</td>
<td><input type="text" class="text" name="lastname" /></td>
</tr>


<tr>
<td>Username</td>
<td><input type="text" class="text" name="username" /></td>
</tr>

<tr>
<td>Email</td>
<td><input type="text" class="text" name="email" /></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" class="text" name="password" /></td>
</tr>

<tr>
<td>Confirm</td>
<td><input type="password" class="text" name="confirm" /></td>
</tr>

<tr>
<td>User Level</td>
<td>
<select name="group"><?= Factory::generateOptions('acl_aros'); ?>
</select>
</td>
</tr>


<tr><td colspan="2">Send System Emails <small>(Not Applicable for Front End Users)</small></td></tr>

<tr>
<td><label for="send_email">Yes</label><input type="radio" name="send_email" value="1"><label for="send_email">No</label><input type="radio" name="send_email" value="0" checked></td>
</tr>
<tr><td><input type="submit" value="Add User"/></td></tr>
</table>
<input type="hidden" name="register_date" value="<?= time(); ?>" />
<input type="hidden" name="active" value="1">
<input type="hidden" name="task" id="task" value="add">
<input type="hidden" name="layout" id="layout" value="add">
<input type="hidden" name="view_name" id="view_name" value="users">
<input type="hidden" name="ajax" value="true">

</form>