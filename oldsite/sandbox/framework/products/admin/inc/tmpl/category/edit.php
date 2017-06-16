<?php
$id = Request::getVar("id","get");

if(!$id){
	exit("Invalid Id");
}

$cat = new Category($id);
?>



<h1 class="page-header">
	Add Category
</h1>
<form action="category.php?task=save" method="post">
	<div class="row ">
		<div class="col-sm-12 page-header">
			<button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
			<a href="categories.php" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
		</div>
 		<div class"clr"></div>
	</div>
	<div class="row">
		<div class="col-lg-3"><label>Name</label></div>
		<div class="col-lg-9"><input type="text" name="name" value="<?php echo $cat->name?>" class="form-control"/>	</div>
	</div>	
	<div class="row">
		<div class="col-lg-3"><label>Sort Order</label></div>
		<div class="col-lg-9"><input type="text" name="order" value="<?php echo $cat->order?>" class="form-control"/>	</div>
	</div>	
	<div class="row">
		<div class="col-lg-3"><label>Parent</label></div>
		<div class="col-lg-9">
			<select name="parent" class="form-control">
				<option value="0">Top Level</option>
				<?php echo Factory::generateOptions("product_categories","id","name",$cat->parent); ?>
			</select>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12">
			<label>Description</label>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<textarea name="description" id="description" class="editor"><?php echo $cat->description?></textarea>
		</div>
	</div>

<input type="hidden" name="id" value="<?php echo $cat->id ?>" />
<button type="submit" class="btn btn-default">Submit</button>
</form>