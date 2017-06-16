<?php
$id = Request::getVar("id","get");

if(!$id){
	exit("Invalid Id");
}

$cat = new Manufacturer($id);
?>




<form action="manufacturer.php?task=save" method="post">
<div class="row">
	<div class="col-lg-3"><label>Name</label></div>
	<div class="col-lg-9"><input type="text" name="name" value="<?php echo $cat->name?>"/>	</div>
</div>	
<div class="row">
	<div class="col-lg-3"><label>Sort Order</label></div>
	<div class="col-lg-9"><input type="text" name="order" value="<?php echo $cat->order?>"/>	</div>
</div>
<input type="hidden" name="id" value="<?php echo $cat->id ?>" />
<button type="submit" class="btn btn-default">Submit</button>
</form>