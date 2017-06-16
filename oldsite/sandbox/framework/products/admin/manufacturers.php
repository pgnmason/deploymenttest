<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();


if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 
loadComponent("manufacturer");
$db = Factory::getDBO();
$db->setQuery("select * from product_manufacturers order by `order` asc, `name` asc");
$arr = $db->loadObjectList("Manufacturer");
?>
<?php require("inc/admin_header.php") ?>
<a href="manufacturer.php?task=add" class="btn">Add Manufacturer</a>

<form action="manufacturer.php">
<table>
<tr>
	<th><input type='checkbox' id='checkToggle'/></th>
	<th>ID</th>
    <th>Name</th>
    <th>Actions</th>
</tr>
<?php foreach($arr as $obj){ ?>
<tr>
	<td><input type='checkbox' id='chkbx-<?php echo $obj->id?>' class='chkbx-group' value='<?php echo $obj->id?>'/></td>
	<td><?php echo $obj->id; ?></td>
	<td><?php echo $obj->name; ?></td>
	<td><a href="manufacturer.php?task=edit&id=<?php echo $obj->id ?>">Edit</a> <br /><a href="manufacturer.php?task=delete&id=<?php echo $obj->id ?>" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');">Delete</a></td>

</tr>

<? } ?>

</table>
<input type="hidden" id="task" name="task" />
</form>
<?php require("inc/admin_footer.php") ?>