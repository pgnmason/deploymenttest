<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();

if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 
loadComponent("category");

$task = Request::getVar("task","get","add");


switch($task){
	case "delete":
		$id = Request::getVar("id","get");
		if(empty($id)){
			header("Location:categories.php");
		}

		$db = Factory::getDBO();
		if(is_array($id)){
			$output = array();
			foreach($id as $i){
				if(is_numeric($i)){$output[] = $i;}
			}
			$db->setQuery("delete from product_categories where id in (".implode(",", $output).")");
		}

		if(is_numeric($id)){
			$id = $db->sanitize($id);
			$db->setQuery("delete from product_categories where id=".$id);
		}

		$res = $db->query();
		if($res){
			header("Location:categories.php");
		}else{
			die($db->getError());
		}
		
		break;
	case "add":
		require("inc/admin_header.php");
		require("inc/tmpl/category/add.php");
		require("inc/admin_footer.php");
		break;
	case "edit":
		require("inc/admin_header.php");
		require("inc/tmpl/category/edit.php");
		require("inc/admin_footer.php");
		break;
	case "save":
		if(empty($_POST) || empty($_POST['name'])){ die("Empty Request.");}
		$names = array('name' => $_POST['name'], 'order' => $_POST['order'], 'parent' => $_POST['parent'], 'description' => $_POST['description'] );
		if(!empty($_POST['id'])){
			$names['id'] = $_POST['id'];
		}

		$cat =  new Category($names);

		$db = Factory::getDBO();

		if(!empty($cat->id)){
			$res = $db->updateObject("product_categories", $cat);
		}else{
			$res = $db->insertObject("product_categories", $cat);
		}

		if($res){
			header("Location:categories.php");
		}else{
			die($db->getError());
		}

		break;
}
