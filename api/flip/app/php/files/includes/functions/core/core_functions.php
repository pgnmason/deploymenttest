<?

function hasModule($view,$module){
	return method_exists($view,$module);
}

function renderModule($view,$module,$position= false){
	if(method_exists($view,$module)){
		$view->$module();
		if(!$position){ $position = $module; }
		$view->renderModule($position);
	}
}




?>