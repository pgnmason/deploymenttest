<?php require("inc/admin_top.php");
$user = Factory::getCurrentUser();

if(!Authorization::checkAccess($user->group,3)){ header("Location:index.php");} 
loadComponent("product");

$task = Request::getVar("task","get","add");


switch($task){
	case "delete":
		$id = Request::getVar("id","get");
		if(empty($id)){
			header("Location:products.php");
		}

		$db = Factory::getDBO();
		if(is_array($id)){
			$output = array();
			foreach($id as $i){
				if(is_numeric($i)){$output[] = $i;}
			}
			$db->setQuery("delete from product_products where id in (".implode(",", $output).")");
		}

		if(is_numeric($id)){
			$id = $db->sanitize($id);
			$db->setQuery("delete from product_products where id=".$id);
		}

		$res = $db->query();
		if($res){
			header("Location:products.php");
		}else{
			die($db->getError());
		}
		
		break;
	case "add":
		require("inc/admin_header.php");
		require("inc/tmpl/product/add.php");
		require("inc/admin_footer.php");
		break;
	case "edit":
		require("inc/admin_header.php");
		require("inc/tmpl/product/edit.php");
		require("inc/admin_footer.php");
		break;
	case "save":
		if(empty($_POST) || empty($_POST['name'])){ die("Empty Request.");}
		$names = array('name' => $_POST['name'], 'order' => $_POST['order'], 'category' => $_POST['category'], 'description' => $_POST['description'] );
		if(!empty($_POST['id'])){
			$names['id'] = $_POST['id'];
		}

		if(!empty($_POST['image'])){
			$names['manufacturer'] = $_POST['image'];
		}

		if(!empty($_POST['manufacturer'])){
			$names['manufacturer'] = $_POST['manufacturer'];
		}

		
		

		

		if(!empty($_FILES['photo']['name'])){
			$fpath = $_SERVER['DOCUMENT_ROOT'].$ds.'beta'.$ds.'products'.$ds.'images'.$ds."uploads".$ds;
			$img = $_FILES['photo'];
			$names['image'] = 'images'.$ds."uploads".$ds.handle_upload($fpath, $img);
		}
		if(!empty($_FILES['brochure']['name'])){
			$fpath = $_SERVER['DOCUMENT_ROOT'].$ds.'beta'.$ds.'products'.$ds.'images'.$ds."uploads".$ds;
			$img = $_FILES['brochure'];
			$names['manufacturer'] = 'images'.$ds."uploads".$ds.handle_upload($fpath, $img);
		}
		$prod =  new Product($names);
		$db = Factory::getDBO();
		
		if(!empty($prod->id)){
			$res = $db->updateObject("product_products", $prod);
		}else{
			$res = $db->insertObject("product_products", $prod);
		}

		if($res){
			header("Location:products.php");
		}else{
			die($db->getError());
		}

		break;
}
