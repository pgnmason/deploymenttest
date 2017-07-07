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


	function expand(){
		if(empty($this->details)){ $this->details = new stdClass(); return true;}

		$details = json_decode($this->details);
		foreach($details as $k=>$v){
			$this->$k = $v;
		}
	}

	function loadGallery(){
		$db = Factory::getDBO();
		$db->setQuery("select * from product_images where category=".$db->sanitize($this->id));
		$this->gallery=$db->loadObjectList("ProductImage");
	}

	function parseVideo($url,$height,$width){
		preg_match(
	        '/[\\?\\&]v=([^\\?\\&]+)/',
	        $url,
	        $matches
	    );
		$id = $matches[1];

		return '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?autoplay=0" frameborder="0" allowfullscreen></iframe>';
	}

}