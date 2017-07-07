<?php

class Filesystem extends Folder{
	
	function __construct($directory){
		parent::__construct($directory);
		$this->getChildren();
	}
	
	
}

class Folder extends Object{
	protected $name;
	protected $directory;
	public $children;
	
	
	function __construct($directory,$name="Root"){
		if(file_exists($directory)){
			$this->directory = $directory;
			$this->name = $name;
		}
	}
	
	function getChildren(){
		if(!is_array($this->children)){
			$this->loadChildren();
		}
		return $this->children;
	}
	
	private function loadChildren(){
			$this->children = array();
			
			$arr = walk_directory($this->directory,true);
			
			$folders = (isset($arr['folders'])) ? $arr['folders'] : array();
			$files = (isset($arr['files'])) ? $arr['files'] : array();
			
			foreach($folders as $f){
				$obj = new Folder($this->directory.$f.DIRECTORY_SEPARATOR,$f);
				$obj->loadChildren();
				$this->children[] = $obj;
			}
			
			foreach($files as $f){
				$obj = new File($f, $this->directory);
				if($obj->isImage()){
					$this->children[] = $obj;
				}
			}
	}
	
	function isFolder(){
		return true;
	}
	
	function isFile(){
		return false;
	}
	
	function getName(){
		return $this->name;
	}
	
	function output($list_wrap = "ul", $item_wrap = "li", $level = 1, $link = true){
		echo "<".$list_wrap.">";
		foreach($this->children as $c){
			if($c->isFolder()){
				echo "<".$item_wrap." class='parent level-$level'>"; 
				echo "<a href='#' class='folder'>".$c->getName()."</a>";
				$c->output($list_wrap, $item_wrap, $level+1);
				echo "</".$item_wrap.">";
			}else{
				echo "<".$item_wrap.">";
				echo "<a href='#".str_replace(Factory::base(),"",$c->getPath()).$c->getName()."' class='file'>".$c->getName()."</a>";
				echo "</".$item_wrap.">";
			}
		}
		echo "</".$list_wrap.">";
	}
	
}

class File extends Object{
	private $name;
	private $extension;
	private $type;
	private $path;
	
	function __construct($name,$directory){
		if(file_exists($directory.$name) && is_file($directory.$name) && file_exists($directory) && is_dir($directory)){
			$this->name = $name;
			$this->extension = getExtension($name);
			$this->type = typeCipher($this->name);
			$this->path = $directory;
		}
	}
	
	
	function isImage(){
		return isImage($this->name);
	}
	
	function isFolder(){
		return false;
	}
	
	function isFile(){
		return true;
	}
	
	function getName(){
		return $this->name;
	}
	
	function getExtension(){
		return $this->extension;
	}
	
	function getType(){
		return $this->type;
	}
	
	function getPath(){
		return $this->path;
	}
	
	
	
	
	
}

?>