<?php

/*function intializeTimeslots(){
	for($i = 10; $i <18; $i++){
		if($i == 12){ continue; }
		$obj = new Object();
		$obj->name = date("g:i:s a",mktime(date("$i"),0,0));
		$obj->time = mktime(date("$i"),0,0);
		$obj->location = 1;
		$db = Factory::getDBO();
		$db->insertObject("time_slots",$obj);
	}
}*/

function generatePassword($password){
		global $msalt1,$msalt2,$authtable,$authmetric,$pname,$saltname;
		$salt = md5(mt_rand());
		$pass_hash = hash("sha512",$msalt1.$salt.$password.$msalt2);
		
		echo $salt."<br />".$pass_hash;
	}


?>