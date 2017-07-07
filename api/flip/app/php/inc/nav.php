<?
$db->setQuery("select * from product_categories where parent = 0 order by `order` asc, `name` asc");

$cats = $db->loadObjectList("Category");

foreach($cats as $cat){
	$cat->getChildren(true);
}

$chosen = false;
if($view == "category"  && is_numeric($id)){
	$chosen = $id;
}else if($view == "product" && is_numeric($id)){
	$p = new Product($id);
	$chosen = $p->category;
}

?>

<nav>
<ul>
 <? foreach($cats as $cat){ ?>
 		<?php $cat->outputList($chosen); ?>
<?
}
?>
</ul>
</nav>


<?php /*
<nav>
	<ul>
		<li>
			<a href="#">Product 1</a>
			<ul>
				<li>
					<a href="sub-product-1.html">Sub Product 1</a>
					<ul>
						<li><a href="#">Sub Product</a></li>
					</ul>
				</li>
				<li><a href="#">Sub Product 2</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Product 2</a>
			<ul>
				<li>
					<a href="sub-product-1.html">Sub Product 1</a>
					<ul>
						<li><a href="#">Sub Product</a></li>
					</ul>
				</li>
				<li><a href="#">Sub Product 2</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Product 3</a>
			<ul>
				<li>
					<a href="sub-product-1.html">Sub Product 1</a>
					<ul>
						<li><a href="#">Sub Product</a></li>
					</ul>
				</li>
				<li><a href="#">Sub Product 2</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Product 4</a>
			<ul>
				<li>
					<a href="sub-product-1.html">Sub Product 1</a>
					<ul>
						<li><a href="#">Sub Product</a></li>
					</ul>
				</li>
				<li><a href="#">Sub Product 2</a></li>
			</ul>
		</li>
		<li id="spacer"></li>
	</ul>

</nav> */ ?>