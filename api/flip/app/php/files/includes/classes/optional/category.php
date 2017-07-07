<?php

class Category extends Object{
	
	function __construct($id=false){
		if(is_numeric($id)){
			$db = Factory::getDBO();
			$db->setQuery("select * from product_categories where id=".$db->sanitize($id));
			$this->load($db->loadObject());
		}
		if(is_array($id)){
			$this->load($id);
		}
	}
	
	function getChildren($expand = false, $products=false){
		if(empty($this->id)){ $this->children = array();}
		$db = Factory::getDBO();
		$db->setQuery("select * from product_categories where parent=".$this->id);
		$this->children = $db->loadObjectList("Category");
		if($expand){
			foreach($this->children as $child){
				$child->getChildren(true);
			}
		}
	}

	function outputList($chosen = false){
			//var_dump($chosen,$this->id);
		
			echo ($chosen == $this->id)? "<li class='current'>" : "<li>";
			echo "<a href='?view=category&id=".$this->id."'>".$this->name."</a>";
			if(!empty($this->children)){
				echo "<ul>";
				foreach($this->children as $child){
					$child->outputList($chosen);
				}
				echo "</ul>";
			}else{
				
				$this->getProducts();

				if(!empty($this->products)){
					echo "<ul>";
					foreach($this->products as $product){
						echo "<li><a href='?view=product&id=".$product->id."'>".$product->name."</a></li>";
					}
					echo "</ul>";
				}
			}
			echo "</li>";
		
	}



	function getProducts(){
		$db = Factory::getDBO();
		$db->setQuery("select * from product_products where category=".$this->id." order by `order` asc");
		$this->products = $db->loadObjectList("Product");
	}



}