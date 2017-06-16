<?
class Router extends Object{
	
	public function redirect($url,$backend = false){
		$homedir = Factory::homeDirectory();
		
		if($backend){
			$url ="/".$homedir."backend/$url";
		}else{ $url ="/".$homedir."app/$url"; }
		header("Location:$url");		
	}
	
	
	public function urlRedirect($url){
		header("Location: $url");	
	}
	
	
	
	
	public function makeLink($type=1,$view=false,$layout = false,$task=false,$data=false,$extras=false){
		global $front_path, $front_ajax,$admin_path, $admin_ajax;
		
		//pretty_print_r(func_get_args());
	
		$output = array();
		
		
		
		
		if($type < 5){
		
			
			
		
			switch($type){
				case 1:
					$output[] = $front_path;
					break;
				case 2:
					$output[] = $admin_path;
					break;
				case 3:
					$output[] = $front_ajax;
					break;
				case 4:
					$output[] = $admin_ajax;
					break;
					
			}
			
			if($view !== false){
				$output[] = $view;
				if($layout !== false){
					$output[] = $layout;
					if($task !== false){
						$output[] = $task;
						if($data !== false){
							$output[] = $data;
							if($extras !== false){
								$output[count($output)-1] .= $extras;
							}
						}
					}
				}
			}
			
			
			
		
		}else{ // THESE ARE SPECIAL CASES SPECIFIC TO THE WEBSITE
			switch($type){
				case 5:
					$output[] = "events";
					$output[] = $data;
					$output[] = $extras;
					break;
				case 6: 
					$output[] = "promoters";
					$output[] = $data;
					break;
				case 7:
					$output[] = "members";
					$output = $data;
					break;
				default:
					break;
			}
		
		}
		
		
			$link = Factory::siteUrl().implode("/",$output);
			
			return $link;
		
	}
	
	function renderBreadcrumb($view, $separator = '&raquo;'){
		global $admin, $app;
		$mode = 1;
		
		$arr[] = '<a href="'.Router::makeLink(1).'">Home</a>';
		if($admin){
			$mode = 2;
			$arr[] = '<a href="'.Router::makeLink(2).'">Dashboard</a>';
		}
		
		if($view->name !== "home"){
			if($view->layout !== 'default'){
				$arr[] = '<a href="'.Router::makeLink($mode, $view->name,'default').'">'.$view->print_name.'</a>';	
				$arr[] = '<span class="active">'.ucwords($view->layout).'</span>';
			}else{
				$arr[] = '<span class="active">'.$view->print_name.'</span>';	
			}	
		}
		
		
		echo implode($separator,$arr);
		
	}
	
	
	
	//Basic Error Function - Needs refined
	function raiseError($code, $data){
		$data = urlencode($data);
		$url = Router::makeLink(1,"error","details","display",$data);
		Router::urlRedirect($url);
	}
	
	
}

?>