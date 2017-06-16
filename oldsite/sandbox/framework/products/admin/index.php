<?php require("inc/admin_top.php");

$user = Factory::getCurrentUser();
?>
<?php require("inc/admin_header.php");?>
<h1 class="page-header">Control Panel</h1>
<? if(Authorization::checkAccess($user->group,3) && false){?>
	<div class="col-md-4">
		<h3>Users</h3>
		<a href="users.php">Create User</a>

	</div>
<? } ?>

<? if(Authorization::checkAccess($user->group,3)){?>
	<div class="col-md-4">
		<h3>Categories</h3>
		<p><a href="categories.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-th-list"></span> View All</a></p>
		<p><a href="category.php?task=add" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Category</a></p>
	</div>

<? } ?>

<? if(Authorization::checkAccess($user->group,3)){?>
	<div class="col-md-4">
		<h3>Products</h3>
		<p><a href="products.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-th-list"></span> View All</a></p>
		<p><a href="product.php?task=add" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Product</a></p>
	</div>
<? } ?>

<?php require("inc/admin_footer.php");?>