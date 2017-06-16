<h1 class="page-header">
	Add Product
</h1>
<form action="product.php?task=save" method="post" enctype="multipart/form-data">
	<div class="row ">
		<div class="col-sm-12 page-header">
			<button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
			<a href="products.php" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
		</div>
 		<div class"clr"></div>
	</div>
	<div class="row">
		<div class="col-lg-3"><label>Name</label></div>
		<div class="col-lg-9"><input type="text" name="name"  class="form-control" /></div>
	</div>	
	<div class="row">
		<div class="col-lg-3"><label>Sort Order</label></div>
		<div class="col-lg-9"><input type="text" name="order" class="form-control"  /></div>
	</div>
	<div class="row">
		<div class="col-lg-3"><label>Category</label></div>
		<div class="col-lg-9">
			<select name="category" class="form-control" >
				<?php echo Factory::generateOptions("product_categories"); ?>
			</select>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-3"><label>Photo</label></div>
		<div class="col-lg-9"><input type="file" name="photo"  class="form-control" /></div>
	</div>
	<div class="row">
		<div class="col-lg-3"><label>Brochure</label></div>
		<div class="col-lg-9">
			<input type="file" name="brochure"  class="form-control" />
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<label>Description</label>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<textarea name="description" id="description" class="editor" class="form-control" ></textarea>
		</div>
	</div>
</form>