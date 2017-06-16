<?php 
require("application_top.php");
loadComponent("category");
loadComponent("product");
$db->setQuery("select * from users");
//var_dump($db->loadObjectList());


require("inc/php/inc/site_top.php");



$view = Request::getVar("view","get","category");
$id = Request::getVar("id","get",false);

?>



<!-- products -->
		<section id="products" class="products">
		
			<!-- inner -->
			<div class="inner">
			
				<!-- sidebar -->
				<aside id="sidebar" class="left">
						
					<?php
						require("inc/php/inc/nav.php");
					?>
					
					<div id="stretch"></div>
					
				</aside>
				<!-- /sidebar -->
				
				<!-- content -->
				<article id="content" class="content left">

					<?php 
						require("inc/tmpl/".$view.".php")
					?>
					
										
				</article>
				<!-- /content -->
				
				<div class="clear"></div>
				
			</div>
			<!-- /inner -->
			
		</section>
		<!-- /products -->



<?
require("inc/php/inc/bottom.php");
?>