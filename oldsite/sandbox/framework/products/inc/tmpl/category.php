<?php

if($id && is_numeric($id)){
	$db->setQuery("select * from product_categories where id=".$db->sanitize($id));
}else{
	$db->setQuery("select * from product_categories order by parent asc, `order` asc, `name` asc");
}

$cat = $db->loadObject();

?>


<h1><?php echo $cat->name ?></h1>

<?php echo $cat->description ?>