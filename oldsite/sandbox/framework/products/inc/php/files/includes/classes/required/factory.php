<?
class Factory extends Object{

	
	/******* LOOKUP FUNCTIONS ********/
	
	public static function getDBO(){
		global $db;
		return $db;
	}
	
	public static function getDocument(){
		global $document;
		return $document;
	}
	
	public static function getSystemEmail(){
		global $sys_email;
		return $sys_email;
	}
	
	public static function homeDirectory(){
		global $home_dir;
		return $home_dir;
	}
	
	public static function viewPath(){
		global $view_path;
		return $view_path;
	}
	
	public static function defaultViewPath(){
		global $def_views;
		return $def_views;
	}
	
	public static function adminViewPath(){
		global $admin_view_path;
		return $admin_view_path;
	}
	
	public static function adminDefaultViewPath(){
		global $def_admin_views;
		return $def_admin_views;
	}
	
	public static function menuPath(){
		global $menu_path;
		return $menu_path;
	}
	
	public static function defaultMenuPath(){
		global $def_menus;
		return $def_menus;
	}
	
	public static function adminMenuPath(){
		global $admin_menu_path;
		return $admin_menu_path;
	}
	
	public static function adminDefaultMenuPath(){
		global $def_admin_menus;
		return $def_admin_menus;
	}	
	
	
	public static function base(){
		global $document, $ds;
		return $document->base.$ds;
	}
	
	public static function home(){
		global $document;
		return $document->uriBase;
	} 
	
	
	
	public static function getAcoName($id){
		$db = Factory::getDBO();
		$db->setQuery("select name from acl_acos where id = $id");
		$obj = $db->loadObject();
		return $obj->name;
	}
	
	public static function getAroName($id){
		$db = Factory::getDBO();
		$db->setQuery("select name from acl_aros where id = $id");
		$obj = $db->loadObject();
		return $obj->name;
	}
	
	public static function getTemplate(){
		global $template;
		return $template;
	}
	
	public static function getModulePath(){
		global $module_path;
		return $module_path;
	}
	
	public static function defaultModulePath(){
		global $def_module_path;
		return $def_module_path;
	}
	
	public static function siteUrl(){
		global $ds;
		return Factory::getDocument()->uriBase.$ds.Factory::homeDirectory();
	}
	
	public static function siteBase(){
		global $ds,$document;
		return $_SERVER['DOCUMENT_ROOT'].$ds.Factory::homeDirectory();
	}
	
	public static function getApplication(){
		global $application;
		return $application;
	}
	
	public static function getIncludePath(){
		global $includes;
		return $includes;
	}
	
	public static function getPromoterPath(){
		global $promoter_path;
		return $promoter_path;
	}
	
	public static function getMemberPath(){
		global $member_path;
		return $member_path;
	}
	
	public static function getUploadsDir(){
		global $uploads_dir;
		return $uploads_dir;
	}
	

	
	public static function fileName($location,$filename){
	
		$filename = cleanFileName($filename,getExtension($filename));
		
		if(file_exists($location.strtolower($filename))){
			$filename = renameFile($location,strtolower($filename));
		}	
		
		return $filename;
	}
	
	public static function imagePath(){
		global $default_image_path;
		return $default_image_path;
	}
	
	public static function imageDirectory(){
		return Factory::siteUrl().Factory::imagePath();
	}
	public static function imageAbsoluteDirectory(){
		return Factory::siteBase().Factory::imagePath();
	}
	
	
	public static function getDefaultScripts(){
		global $site_scripts;
		return $site_scripts;
	}
	
	public static function getDefaultStyles(){
		global $site_styles;
		return $site_styles;
	}
	
	public static function utilsDirectory(){
		global $utils_dir;
		return $utils_dir;
	}
	
	
	
	
	
	
	/********* USER FUNCTIONS ***********/
	
	public static function getUserDirectory($id=false){
		global $ds;
	
		
		if(!$id){
			$user = Factory::getCurrentUser();			
		}else{
			$user = Factory::getUser($id);
		}
		//var_dump($id);
		//pretty_print_r($_SESSION);
		$userfolder = $user->username."__".md5($user->username);
		$userdirectory = Factory::getPromoterPath().$userfolder.$ds;
		
		return $userdirectory;
	}	
	public static function getCurrentUser(){
		global $document;
		return Factory::getUser(Factory::userID());
	}
	public static function setCurrentUser(){ return false;}
	/*public static function getCurrentUser(){
		global $document;
		if(!isset($document->session->auth_user)){ return new Object(); }
		return imageDecode($document->session->auth_user);
	}
	
	public static function setCurrentUser(){
		global $document;
		if(!isset($document->session->auth_user)){ return new Object(); 
			$u = Factory::getCurrentUser();
			$document->session->auth_user = imageEncode(Factory::getUser($u->id));
		}
	}*/
	
	public static function guestLevel(){
		global $guest_level;
		return $guest_level;
	}
	
	/*
	DEPRECATED v.75
	public static function getUser($id = false){
		global $db;
		if(!$id){
			return new Object();
		}
		$db->setQuery("select * from users where id = $id");
		return $db->loadObject();
	}
	*/
	
	public static function getUser($id = false){
		global $db;
		if($id === false){
			return new Object();
		}
		
		
		if($id !== false && is_numeric($id)){
			return new SiteUser($id);
		}else{
			return new SiteUser($id,true);
		}
	}
	
	
	public static function userExists($data){
		
		$db = Factory::getDBO();
		$data = mysql_real_escape_string($data);
		$db->setQuery("select * from users where username = '$data' or id = '$data'");
		if($db->numResults() > 0){ return true; }else{ return false;}
		
	}
	
	
	
	public static function userID(){
		global $document;
		if(!isset($document->session->auth_id)){ return false; }
		return $document->session->auth_id;
	}
	
	
	public static function updateSessions(){
		global $document;
		$db = Factory::getDBO();
		$uid = (Factory::userId()) ? Factory::userId() : 0;
		$cookie = $document->cookies['PHPSESSID'];
		
		/*$obj = new Object();
		$obj->uid = $uid;
		$obj->last_access =time();
		$obj->sessid = $cookie;
		;*/
		
		
		
		$db->setQuery("replace into user_sessions SET
                 uid = '".mysql_real_escape_string($uid)."', 
				 sessid = '".mysql_real_escape_string($cookie)."', 
                 last_access = '".time()."'");
		
		$db->query();
		
		//echo $db->getQuery();
		$db->setQuery("delete from user_sessions where sessid NOT IN (select id from sessions_new)");
		$db->query();
		echo $db->getQuery();
		
	}
	
	public static function validSession($uid,$cookie){
		$db = Factory::getDBO();
		$uid = mysql_real_escape_string($uid);
		$cookie = mysql_real_escape_string($cookie);
		$db->setQuery("select * from user_sessions where uid = $uid and sessid = '$cookie'");
		if($db->numResults() > 0){ return true; }else{ return false;}
	}
	
	
	public static function usersOnline(){
		$db = Factory::getDBO();
		$db->setQuery("select uid from user_sessions where uid != 0 and last_access >".time()."-3600");
		//echo $db->getQuery();
		return $db->loadObjectList();
	}
	
	
	
	
	public static function userLevel(){
		global $document;
		if(!isset($document->session->auth_level)){ return false; }
		return $document->session->auth_level;
	}
	
	public static function authenticated(){
		global $document;
		if(!isset($document->session->authenticated)){ return false; }
		return $document->session->authenticated;
	}
	
	
	
	
	/******* OUTPUT FUNCTIONS ******/
	
	/* DEPRECATED
	public static function image($path, $width = false, $height = false,  $params = array(), $square = false){
	
		//PREP THE IMAGE SIZE
		if($height && !$width){ $size = $height; $height = false;  $mode = 'h';}
		else if(!$height && $width){ $size = $width; $width = false; $mode = 'w'; }
		else{ $size = false; $mode = 'd';  }
	
		return outputImage($path,	array('square'=>$square,'size'=>$size, 'height'=>$height, 'width'=>$width, 'mode' => $mode),$params);
	}
	
	
	*/
	
	public static function image($params, $extras = array(),$raw = false){
		return outputAdvancedImage($params,$extras,$raw);
	}
	
	public static function text($params, $extras = array(),$raw = false){
		return outputTextImage($params,$extras,$raw);
	}
	
	public static function button($params, $extras = array(),$raw = false){
		return outputButton($params,$extras,$raw);
	}
	
	
	
	public static function generateOptions($table, $metric='id', $label = 'name', $value = false, $length = false,$parent=false){
		global $db;
		
		if($parent){
			$db->setQuery("select * from $table where parent = '$parent'");
		}else{
			$db->setQuery("select * from $table");
		}
		$opts = '';
		
		$arr = $db->loadObjectList();
		
		//pretty_print_r($arr,"Option List");
		foreach($arr as $a){
			if(is_numeric($length)){
				$l = shortenText($a->$label,$length);
			}else{
				$l = $a->$label;
			}
		
			
		
			if($value && $a->$metric == $value){ $selected = "selected = 'selected'";}else{ $selected = ''; }
			$opts .= "\n\t<option value='".$a->$metric."' $selected title='".$a->$label."'>".$l."</option>";
		}
		
		return $opts;	
	}


	/************** MOBILE WEBSITE FUNCTIONS *******************/
		public static function mobileCheck(){
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		$force_stan = isset($_GET['force']);
		$stan_cookie = isset($_SESSION['force_standard']);
		$mobi_match = preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
		$force_mobi = isset($_GET['view_mobile']);
		$mobi_cookie = isset($_SESSION['force_mobile']);
		
		$is_mobile_phone_check_no_force = (!$force_stan && !$stan_cookie && $mobi_match);
		/*echo "First Logic<br />";
		var_dump($force_stan);
		var_dump($stan_cookie);
		var_dump($mobi_match);
		
		echo "<br />First Result<br />";
		var_dump($is_mobile_phone_check_no_force); // Force is not set, force cookie isn't set, is mobile browser
		
		
		
		
		echo "<br />Second Logic<br />";
		var_dump($force_mobi);
		
		echo "<br />Third Logic Result<br />";
		
		var_dump ( $mobi_cookie && !$force_stan );
		*/
		if(($is_mobile_phone_check_no_force) || $force_mobi || ( $mobi_cookie && !$force_stan ) ){
			unset($_SESSION['force_standard']);
			$_SESSION["force_mobile"] = true;
			define("BROWSER_MODE","mobile");
		}else{
			$_SESSION["force_standard"] =true;
			unset($_SESSION['force_mobile']);
			define("BROWSER_MODE","standard");
		}
}







}



?>