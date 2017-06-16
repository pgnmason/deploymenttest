<?php header("Location:index.php");
require("inc/admin_top.php");

if(Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 

$user = Factory::getCurrentUser();
$task = Request::getVar("task","post","get_users",true);

if($task == "edit" &&!empty($_GET['id'])){ 
	$user = Factory::getUser($_GET['id']);
	//$users = Factory::getUsers();
}

if($task == "add"&&!empty($_POST['password'])){ 

if(!$_POST['password'] == $_POST['confirm']){
	$task = "create_new";
	$error = "Passwords Don't Match";
}else{
	$_POST['pass'] = $_POST['password'];
	$u = new User();
	unset($_POST['ajax'],$_POST['confirm'],$_POST['task'],$_POST['view_name'],$_POST['layout'],$_POST['password']);
	$u->add($_POST);
	$task = "get_users";
}




}


if($task == "update"){ 

if(!empty($_POST['password'])){
		if(!$_POST['password'] == $_POST['confirm']){
			$task = "edit";
			$error = "Passwords Don't Match";
		}
		else{
			
			$_POST['pass'] = hash("sha512",$msalt1.$_POST['password'].$msalt2);
			$obj = new Object();
			unset($_POST['ajax'],$_POST['confirm'],$_POST['task'],$_POST['view_name'],$_POST['layout'],$_POST['password']);
			$obj->load($_POST);
			$db->updateObject("users",$obj);
			$task = "get_users";
		}
}else{
	$obj = new Object();
	unset($_POST['ajax'],$_POST['confirm'],$_POST['task'],$_POST['view_name'],$_POST['layout'],$_POST['password']);
	$obj->load($_POST);
	$db->updateObject("users",$obj);
	$task = "get_users";
}





}






// $users
?>
<?php require("inc/admin_header.php");?>



<?php
if($task == "get_users"){ 
	$db->setQuery("select * from users where id > 2");
	$users = $db->loadObjectList();
	//$users = Factory::getUsers();


	?>
<h1 class="page-header">Users</h1>
<form action="users.php">
<div class="row">
 <div class="col-sm-12">
 	<a href="users.php?task=add" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add User</a>
	<button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');"><span class="glyphicon glyphicon-remove"></span> Delete User(s)</a>
 </div>
 <div class"clr"></div>
</div>
<table class="table table-striped">
<tr>
	<th><input type='checkbox' id='checkToggle'/></th>
	<th>ID</th>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Username</th>
    <th>Actions</th>
</tr>
<?php foreach($users as $obj){ ?>
<tr>
	<td><input type='checkbox' id='chkbx-<?php echo $obj->id?>' class='chkbx-group' value='<?php echo $obj->id?>'/></td>
	<td><?php echo $obj->id; ?></td>
	<td><?php echo $obj->lastname; ?></td>
	<td><?php echo $obj->firstname; ?></td>
	<td><?php echo $obj->username; ?></td>
	<td><a href="users.php?task=edit&id=<?php echo $obj->id ?>">Edit</a> <br /><a href="users.php?task=delete&id=<?php echo $obj->id ?>" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');">Delete</a></td>

</tr>

<? } ?>

</table>
	<?
}
?>

<?php

if(!empty($task) && $task == "create_new"){ ?>
<form method="post" action="users.php">

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
<select name="group" id="group"><?= Factory::generateOptions('acl_aros'); ?>
</select>
</td>
</tr>

<tr><td><input type="submit" value="Add User"/></td></tr>
</table>
<input type="hidden" name="register_date" value="<?= time(); ?>" />
<input type="hidden" name="active" value="1">
<input type="hidden" name="send_email" value="0">
<input type="hidden" name="task" id="task" value="add">
<input type="hidden" name="layout" id="layout" value="add">
<input type="hidden" name="view_name" id="view_name" value="users">
<input type="hidden" name="ajax" value="true">

</form>

<?
}else if($task == "edit" &&!empty($_GET['id']) && !empty($user)){ ?>
<form method="post" action="users.php">

<table>
<tr>
<td>First Name</td>
<td><input type="text" class="text" name="firstname" value="<?php echo $user->firstname?>" /></td>
</tr>

<tr>
<td>Last Name</td>
<td><input type="text" class="text" name="lastname" value="<?php echo $user->lastname?>"/></td>
</tr>


<tr>
<td>Username</td>
<td><input type="text" class="text" name="username" value="<?php echo $user->username?>" /></td>
</tr>

<tr>
<td>Email</td>
<td><input type="text" class="text" name="email" value="<?php echo $user->email?>" /></td>
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
<select name="group" id="group"><?= Factory::generateOptions('acl_aros',"id","name",$user->group); ?>
</select>
</td>
</tr>

<tr><td><input type="submit" value="Add User"/></td></tr>
</table>
<input type="hidden" name="register_date" value="<?= $user->register_date; ?>" />
<input type="hidden" name="active" value="1">
<input type="hidden" name="send_email" value="0">
<input type="hidden" name="task" id="task" value="update">
<input type="hidden" name="layout" id="layout" value="update">
<input type="hidden" name="view_name" id="view_name" value="users">
<input type="hidden" name="ajax" value="true">
<input type="hidden" name="id" value="<?= $user->id; ?>">

</form>

<? } 


?>



<?php require("inc/admin_footer.php");?>