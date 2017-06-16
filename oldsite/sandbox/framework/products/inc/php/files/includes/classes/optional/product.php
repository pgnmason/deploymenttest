<?php

class Product extends Object{
	
	function __construct($id=false){
		if(is_numeric($id)){
			$db = Factory::getDBO();
			$db->setQuery("select * from product_products where id=".$db->sanitize($id));
			$this->load($db->loadObject());
		}
		if(is_array($id)){
			$this->load($id);
		}
	}

}