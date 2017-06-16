<?

	class Database{
		private $sql;
		
		function lastID(){
			return mysql_insert_id();
		}
		
		function debugState(){
			if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
		}	
	
		function setQuery($sql){
			$this->sql = $sql;
		}
		
		function query(){
			//echo $this->sql."<br />";
			return mysql_query($this->sql);
		}
		
		function getQuery(){
			return $this->sql;
		}
		
		function numResults(){
			return mysql_num_rows($this->query());
		}
		
		function sanitize($db){
			if(is_array($db)){
				foreach($db as $k=>$v){
					$db[$k] = mysql_real_escape_string($v);
				}
			}
			else if(is_object($db)){
				foreach($db as $k=>$v){
					if(is_array($v)){
						$v = implode(",",$v);
					}
					$db->$k = mysql_real_escape_string($v);
				}
			}
			else{
				$db = mysql_real_escape_string($db);
			}
			return $db;
		}
		
		function loadValue($value){
			$this->debugState();		
			$res = $this->query();
			if($row = mysql_fetch_assoc($res)){
				foreach($row as $r){
					$r = stripslashes(stripslashes($r));
				}
				return $row[$value];
			}
		}
		
		function loadArray(){
			$this->debugState();		
			$res = $this->query();
			if($row = mysql_fetch_assoc($res)){
				foreach($row as $r){
					$r = stripslashes(stripslashes($r));
				}
				return $row;
			}
		}
		
		function loadFlatList($field = 'id'){
			$arr = $this->loadObjectList();
			$output = array();
			
			foreach($arr as $a){
				$output[] = $a->$field;
			}
			
			return $output;
		}
		
		function loadObject($obj_type = "Object"){		
			$this->debugState();
			$s = new $obj_type();		
			$res = $this->query();
			if($row = mysql_fetch_assoc($res)){
				foreach($row as $r){
					$r = stripslashes(stripslashes($r));
				}
				$s->load($row);
				return $s;
			}	
		}
		
		function loadArrayList(){
			$this->debugState();
			$res = $this->query();		
			$arr = array();		
			while($row = mysql_fetch_assoc($res)){
				$arr[] = $row;
			}
			$c = count($arr);
			for($i = 0; $i < $c; $i++){
				foreach($arr[$i] as $k){
					$k = stripslashes(stripslashes(stripslashes($k)));
				}
			}
			return $arr;
		}
		
		function loadObjectList($obj_type = "Object"){
			$this->debugState();
			$res = $this->query();
			$arr = array();
			if(!$res){ return $arr; }
			
			while($row = mysql_fetch_assoc($res)){
				$arr[] = $row;
			}
			$c = count($arr);
			for($i = 0; $i < $c; $i++){
				foreach($arr[$i] as $k){
					$k = stripslashes(stripslashes(stripslashes($k)));
				}
			}
			$output = array();
			
			foreach($arr as $o){
				$obj = new $obj_type();
				$obj->load($o);
				$output[] = $obj;
			}
			return $output;
		}
		
		function getResult($table,$data,$key,$index){
			$table = $this->sanitize($table);
			$data = $this->sanitize($data);
			$key = $this->sanitize($key);
			$index = $this->sanitize($index);
			
			$arr = $this->setQuery("select $key from $table where $index = '$data'");
			$arr = $this->loadArray();
			return $arr[$key];
		}
	
	
	
	
		function store($table,$data,$key='id',$task="insert"){ 
		//table is the table in the database,data is the data to be stored 
		//(IT MUST MATCH THE TABLE NAMES), key is the key of the table, task can be update or insert
		
			$fields = array();
			$values = array();
			
			foreach($data as $k=>$v){
				$fields[] = mysql_real_escape_string($k);
				$values[] = mysql_real_escape_string($v);
			}
			
			
			
			$i = count($fields);
			$error = true;
			
			if(strtolower($task) == "update"){
				$middle = "";
				$begin = "update $table set ";
				$end = " where `$key` =".$data[$key];		
				
				for($c = 0 ; $c<$i-1; $c++){
					$middle .= "`".$fields[$c]."`"."='".$values[$c]."', ";
				}
				
				$middle .= "`".$fields[$i-1]."`='".$values[$i-1]."'";		
				$sql = $begin.$middle.$end;		
				//echo $sql;
				if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
				mysql_query($sql) or $error = false; 
			}
			else{
				$middle = "";
				$begin = "insert into $table (";
				
				for($c = 0 ; $c<$i-1; $c++){
					$middle .= "`".$fields[$c]."`, ";
				}
				
				$middle .= "`".$fields[$i-1]."`)  values('";
				
				for($c = 0 ; $c<$i-1; $c++){
					$middle .= $values[$c]."', '";
				}
				
				$middle .= $values[$i-1]."')";
				
				$sql = $begin.$middle;
				//echo $sql; 
				if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}
				
				mysql_query($sql) or $error = false; 
			}
			
			if($error == false){
				return false;
			}
			else{
				return true;
			}
		}
		
		
		
		
		
		
		
		
		function insertObject($table,$obj){
			$keys = array();
			$values = array();
			foreach($obj as $k=>$v){
				if(!is_array($v) && !is_object($v)){
					$keys[] = $k;
					$values[] = $v;
				}
			}
			
			$keys = $this->sanitize($keys);
			$values = $this->sanitize($values);
			
			$i = count($keys);
			$middle = "";
			$begin = "insert into $table (";
			for($c = 0 ; $c<$i-1; $c++){
				$middle .= "`".$keys[$c]."`, ";
			}
			$middle .= "`".$keys[$i-1]."`)  values('";
			for($c = 0 ; $c<$i-1; $c++){
				$middle .= $values[$c]."', '";
			}
			$middle .= $values[$i-1]."')";
			$sql = $begin.$middle;
			
			$this->setQuery($sql);
			return $this->query() == true;
		}
		
		
		
		function convertDateToDB($date){
			$d = strtotime($date);
			$d = date("Y-m-d H:i:s",$d); //ex 2009-05-29 13:13:29
			return $d;
		}
		
		function convertDateToNormal($date){
			$d = strtotime($date);
			$d = date("m/d/Y",$d); //ex 05/29/2009
			return $d;
		}
		
		function filterObject($table,$object){
			$table = $this->sanitize($table);
			
			$this->setQuery("select column_name from information_schema.columns where table_name='$table' ");
			$res = $this->loadArrayList();
			
			foreach($res as $k=>$v){
				$arr[] = $v['column_name'];
			}
			
			//pretty_print_r($arr);
			
			foreach($object as $k=>$v){
				if(!in_array($k,$arr)){
					unset($object->$k);
				}
			}
			
			return $object;
		}
		
		/************** V 1.05 MLO ADDONS ***********/
		function pollTable($table,$keys = false){
			$table = $this->sanitize($table);
			if($keys && is_array($keys)){
				$where = "where ";
				$c = count($keys);
				$i = 0;
				foreach($keys as $key=>$value){
					$key = $this->sanitize($key);
					$value = $this->sanitize($value);
					$where .= "`$key` = '$value'";
					$i++;
					if($i < $c){
						$where .= " and ";
					}
				}
				$sql = "select * from $table $where";
			}else{
				$sql = "select * from $table";
			}
			
			$this->setQuery($sql);
			
			return $this->loadObjectList();
			 
		}
		
		
		function getError(){
			return mysql_error();
		}
		
		
		/********* V 1.05 MLO EDITS **********/
		
		// CHANGED TO ACCOMMODATE arrays of keys
		function updateObject($table,$obj,$key='id'){
			$keys = array();
			$values = array();
			foreach($obj as $k=>$v){
				if(!is_array($v) && !is_object($v)){
					$keys[] = $k;
					$values[] = $v;
				}
			}
			
			$keys = $this->sanitize($keys);
			$values = $this->sanitize($values);
			
			$i = count($keys);
			
			$middle = "";
			$begin = "update $table set ";
			
			if(!is_array($key)){
				$end = " where `$key` ='".$obj->$key."'";		
			}else{
				$end = " where";
				$c = count($key);
				$i = 1;
				foreach($key as $the_key){
					$end .= " `$the_key` ='".$obj->$the_key."'";
					if($i < $c){ $end .= " and "; }
					$i++;
				}
			}
			
			
			for($c = 0 ; $c<$i-1; $c++){
				$middle .= "`".$keys[$c]."`='".$values[$c]."', ";
			}
			$middle .= "`".$keys[$i-1]."`='".$values[$i-1]."'";		
			$sql = $begin.$middle.$end;		
			//echo $sql;
			if(isset($_SESSION['debug']) && $_SESSION['debug'] == true){echo $sql."<BR><BR>";}	
			
			
			
			$this->setQuery($sql);
			return $this->query() == true;
		}
		
		
	}

?>