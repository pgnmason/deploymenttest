<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();

if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 
loadComponent("category");
$db = Factory::getDBO();
$db->setQuery("select * from product_categories order by parent asc, `order` asc, `name` asc");
$arr = $db->loadObjectList("Category");
?>
<?php require("inc/admin_header.php") ?>
<h1 class="page-header">
	Product Categories
</h1>


<form action="category.php">
<div class="row">
 <div class="col-sm-12">
 	<a href="category.php?task=add" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Category</a>
	<button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');"><span class="glyphicon glyphicon-remove"></span> Delete Category(s)</a>
 </div>
 <div class"clr"></div>
</div>
<table class="table table-striped">
<tr>
	<th><input type='checkbox' id='checkToggle'/></th>
	<th>ID</th>
    <th>Name</th>
    <th>Parent ID</th>
    <th>Actions</th>
</tr>
<?php foreach($arr as $obj){ ?>
<tr>
	<td><input type='checkbox' id='chkbx-<?php echo $obj->id?>' class='chkbx-group' value='<?php echo $obj->id?>' name="id[]"/></td>
	<td><?php echo $obj->id; ?></td>
	<td><?php echo $obj->name; ?></td>
	<td><?php echo $obj->parent; ?></td>
	<td><a href="category.php?task=edit&id=<?php echo $obj->id ?>">Edit</a> <br /><a href="category.php?task=delete&id=<?php echo $obj->id ?>" >Delete</a></td>

</tr>

<? } ?>

</table>
<input type="hidden" id="task" name="task" value="delete" />
</form>


<script>
$(document).ready(function(){
	$("#checkToggle").click(function(e){

		$(".chkbx-group").prop("checked", $(this).prop("checked"));
	})
});
</script>
<?php require("inc/admin_footer.php") ?>