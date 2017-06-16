<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();


if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 
loadComponent("product");
$db = Factory::getDBO();
$db->setQuery("select * from product_products order by category asc, `order` asc, `name` asc");
$arr = $db->loadObjectList("Product");
?>


<?php require("inc/admin_header.php") ?>
<h1 class="page-header">
	Products
</h1>
<form action="product.php">
<div class="row">
 <div class="col-sm-12">
 	<a href="product.php?task=add" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Product</a>
	<button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');"><span class="glyphicon glyphicon-remove"></span> Delete Product(s)</a>
 </div>
 <div class"clr"></div>
</div>
<table class="table table-striped">
<tr>
	<th><input type='checkbox' id='checkToggle'/></th>
	<th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Actions</th>
</tr>
<?php foreach($arr as $obj){ ?>
<tr>
	<td><input type='checkbox' id='chkbx-<?php echo $obj->id?>' class='chkbx-group' value='<?php echo $obj->id?>'/></td>
	<td><?php echo $obj->id; ?></td>
	<td><?php echo $obj->name; ?></td>
	<td><?php echo $obj->category; ?></td>
	<td><a href="product.php?task=edit&id=<?php echo $obj->id ?>">Edit</a> <br /><a href="product.php?task=delete&id=<?php echo $obj->id ?>" onclick="return confirm('Continue Deleting <?php echo $obj->name; ?>');">Delete</a></td>

</tr>

<? } ?>

</table>
<input type="hidden" id="task" name="task" />
</form>
<?php require("inc/admin_footer.php") ?>