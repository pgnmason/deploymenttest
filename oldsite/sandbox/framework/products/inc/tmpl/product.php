<?php

if(!$id || !is_numeric($id)){
	echo "<h1>Invalid Product Selection</h1>";
}else{

$product = new Product($id);

?>

<h1><?php echo $product->name ?></h1>

<img src="<?php echo $product->image?>" alt="<?php echo $product->title?>" class="aligncenter">

<?php echo $product->description ?>

<?php 
	if(!empty($product->manufacturer) && file_exists($product->manufacturer)){
		echo "<p><a href='".$product->manufacturer."'>View Brochure</a></p>";
	}

}
?>