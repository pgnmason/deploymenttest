<?php
/**
 * Hello Model for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_2
 * @license    GNU/GPL
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TemplatebuilderModelTemplates extends JModel
{
	
	
	
	function loadObjects($table,$sort=false,$dir=false, $cond=false,$class = false){
		$db =& JFactory::getDBO();
		
		if(!$sort){ $sort = "id"; }
		
		if($cond){ $cond = " where $cond "; }else{ $cond =  ' '; }
		
		$dir = ($dir &&  is_numeric($dir) && $dir < 0) ? "desc" : "asc";
		
		
		$query = 'SELECT * from #__'.$table.$cond.'order by '.$db->escape($sort).' '.$dir;
		$db->setQuery( $query );
		
		
		
		//echo str_replace("#__",$db->getPrefix(),$db->getQuery());
		
		if($class){
			$obj_arr = ($t = $db->loadObjectList(NULL,$class)) ? $t: array() ;
		}else{
			$obj_arr = ($t = $db->loadObjectList()) ? $t: array() ;
		}
		
		//var_dump($db->getErrorMsg());
		
		
		//var_dump($t);
		return $obj_arr;
	}

	function getTemplate($id = false, $field="id"){
	   $obj = new stdClass();
	   if($id){
		   $db =& JFactory::getDBO();
		   $query = 'SELECT * FROM #__templatebuilder_templates where '.$field.'='.$db->quote($id);
		   $db->setQuery( $query );
		   $obj = $db->loadObject("TemplatebuilderTemplate");
	   }
	   return $obj;

	}
	
	function getCategory($category){
			$db = JFactory::getDBO();
			$db->setQuery("select * from #__categories where id =".$db->quote($category));
			$cat = $db->loadObject();
			return $cat;
	}
	
	function getTemplates(){
		$db = JFactory::getDBO();
		$db->setQuery("select * from #__templatebuilder_templates  order by created asc, title asc");
		return $db->loadObjectList(NULL,"TemplatebuilderTemplate");
	}
	
	function sortFiles($arr){
		$output = array();
		foreach($arr as $a){
			$a->loadData();
			$output[$a->type_name][] = $a;
		}
		return $output;
	}
	
	
	
	
	
	function uploadFile($category){
		jimport( 'joomla.filesystem.file' );
		if(is_array($category)){
			$category = $category[0];
		}
		
		$files = JRequest::get("files");
		if(!isset($files['filename'])){
			return false;
		}
		
		$file = $files['filename'];
		
	
		$path = AcademyFileHelper::getFilePath($category);
		$clean_name = AcademyFileHelper::getCleanName($file['name'],$path);
		
		/*var_dump($file['tmp_name']); echo "<br />";
		var_dump($clean_name);echo "<br />";
		var_dump(AcademyFileHelper::upload($file['tmp_name'],$clean_name)); echo "<br />";*/
		
		if(AcademyFileHelper::upload($file['tmp_name'],$clean_name,true)){
			return $clean_name;
		}else{
			return false;
		}
		
		return $file;
	}
	
	function insert($data,$table="templatebuilder_templates")
	{
		$categories = $data['categories'];
		$roles = (empty($data['roles'])) ? array() : $data['roles'];
		$agencies = (empty($data['agencies'])) ? array() : $data['agencies'];
		
		$data = $this->prepareData($data,$table);
		$data->upload_date = date("Y-m-d H:i:s");
		$data->modify_date = $data->upload_date;
		$db = $this->getDBO();
		
		if($fname = $this->uploadFile($categories)){
			$data->filename = $fname;
		}else{
			die("File Upload Failed");
		}
		
		$res = $db->insertObject("#__".$table,$data);
		
		if(!$res){
			echo $db->getErrorMsg();
		}else{
			$insert_id = $db->insertid();
			$this->updateRoles($insert_id,$roles);
			$this->updateAgencies($insert_id,$agencies);
			$this->updateCategories($insert_id,$categories);
		}
		
		
		return $res;
	}
	
	
	function updateDownloads($category){
		$db = JFactory::getDBO();
		$db->setQuery("update #__templatebuilder_templates set downloads=downloads+1 where id = ".$db->escape($category));
		return $db->query();;
	}
	
	
	
	
	function updateRoles($id, $roles){
		$db = JFactory::getDBO();
		$db->setQuery("delete * from #__dshare_role_map where docid=".$db->escape($id));
		$db->query();
		
		if(is_array($roles)){
			foreach($roles as $r){
				$obj = new stdClass();
				$obj->docid = $id;
				$obj->roleid = $r;
				$db->insertObject("#__dshare_role_map",$obj);
			}
		}else{
			$obj = new stdClass();
			$obj->docid = $id;
			$obj->roleid = (int)$roles;
			$db->insertObject("#__dshare_role_map",$obj);	
		}
		
		
	}
	
	
	function updateAgencies($id, $arr){
		$db = JFactory::getDBO();
		$db->setQuery("delete * from #__dshare_agency_map where docid=".$db->escape($id));
		$db->query();
		
		if(is_array($arr)){
			foreach($arr as $r){
				$obj = new stdClass();
				$obj->docid = $id;
				$obj->agencyid = $r;
				$db->insertObject("#__dshare_agency_map",$arr);
			}
		}else{
			$obj = new stdClass();
			$obj->docid = $id;
			$obj->agencyid = (int)$roles;
			$db->insertObject("#__dshare_agency_map",$arr);	
		}
		
		
	}
	
	
	
	function updateCategories($id,$categories){
		$db = JFactory::getDBO();
		$db->setQuery("delete * from #__dshare_category_map where docid=".$db->escape($id));
		$db->query();
		
		if(is_array($categories)){
			foreach($categories as $r){
				$obj = new stdClass();
				$obj->docid = $id;
				$obj->catid = $r;
				$db->insertObject("#__dshare_category_map",$obj);
			}
		}else{
			$obj = new stdClass();
			$obj->docid = $id;
			$obj->catid = (int)$categories;
			$db->insertObject("#__dshare_category_map",$obj);	
		}
	}
	
	
	
	
	
	
	function save($data,$table="templatebuilder_templates")
	{
		$data = $this->prepareData($data,$table);
		$db = $this->getDBO();	
		
		//var_dump($data);
		
		
		
		if(!isset($data->id)){
			$res = $db->insertObject("#__".$table,$data);
		}else{
			$res =  $db->updateObject("#__".$table,$data,"id");
		}
		if(!$res){
			echo $db->getErrorMsg();
		}
		return $res;
	}
	
	
	
	function prepareData($data,$table){
		unset($data['option'],$data['task']);
		
		$db = $this->getDBO();	
		$obj = new stdClass();
		
		
			
			$db->setQuery("select column_name from information_schema.columns where table_name='".$db->getPrefix().$table."' ");
			$res = $db->loadAssocList();
			//echo $db->getQuery();
			
			$arr = array();
			
			foreach($res as $k=>$v){
				$arr[] = $v['column_name'];
			}
			
			//pretty_print_r($arr);
			//var_dump($arr);
			
			foreach($arr as $k){
				if(isset($data[$k])){
					$obj->$k = $data[$k];
				}
			}
			
			$user =& JFactory::getUser();
			$obj->user_id = $user->get( 'id' );
			
			return $obj;
	}
	
	function delete($arrayIDs,$table= "templatebuilder_templates"){
	   $db = $this->getDBO();
	   
	   if(!$this->deleteFiles($arrayIDs,$table)){
	   	die("Couldn't Delete Files");
	   }
	   
	   $query = "DELETE FROM #__".$table." WHERE id IN ('".implode("','", $arrayIDs)."')";
	   $db = $this->getDBO();
	   $db->setQuery($query);
	   
	   if (!$db->query()){
				$errorMessage = $this->getDBO()->getErrorMsg();
				JError::raiseError(500, 'Error deleting greetings: '.$errorMessage); 
	   }               
	}
	
	
	function deleteFiles($arrayIDs,$table= "templatebuilder_templates"){
	   jimport( 'joomla.filesystem.file' );
	   $db = $this->getDBO();  
	   $query = "select * FROM #__".$table." WHERE id IN ('".implode("','", $arrayIDs)."')";
	   $db->setQuery($query);
	 
	   $list = $db->loadObjectList();
	   $files = array();
	   foreach($list as $l){
	   	$files[] = $l->filename;
	   }
	   
	   
	   return JFile::delete($files);
	}
}
?>