<?php

class Counter{
    public $count;

    public function __construct($value=0){
        $this->count = $value;
    }

    public function increment(){
        $this->count += 1;
    }

    public function decrement(){
        $this->count -= 1;
    }

    public function __toString(){
        return "$this->count";
    }
}


/**
 * CREATE TABLE `sessions` (
 *  `sessid` varchar(255) NOT NULL,
 *  `data` text,
 *  `lastaccess` int(10) unsigned default '0',
 *  PRIMARY KEY  (`sessid`)
 * ) ENGINE=MyISAM;
 *
 */
class MySqlSessionStore {

    const DBSERVER = 'bricklayerapi.db.10849616.hostedresource.com';
    const DBUSER = 'bricklayerapi';
    const DBPASSWD = 'Br1ckl@y3r!';
    const DBNAME = 'bricklayerapi';

    private $dbh;

    function __construct(){
        session_set_save_handler(array($this,"open"),
        array($this,"close"),
        array($this,"read"),
        array($this,"write"),
        array($this,"destroy"),
        array($this,"gc"));
    }

    function open($savePath, $sessName) {

        //connect to the database
        $dbh = mysql_connect(self::DBSERVER ,self::DBUSER ,self::DBPASSWD);
        $db = mysql_select_db(self::DBNAME ,$dbh);
        if(!$dbh || !$db){
            return false;
        }
        $this->dbh = $dbh;
        return true;
    }

    function close() {
        $this->gc(get_cfg_var("session.gc_maxlifetime"));
        return @mysql_close($this->dbh);
    }

    function read($sessid) {
        //fetch the session record
        $res = mysql_query("SELECT data FROM user_sessions
                           WHERE sessid = '".mysql_real_escape_string($sessid)."'"); 
		//echo "SELECT data FROM sessions WHERE sessid = '".mysql_real_escape_string($sessid)."'";
        if($row = mysql_fetch_assoc($res)){
            return $row['data'];
        }
        //MUST send an empty string if no session data
        return "";
    }

    function write($sessid,$data){
        mysql_query("REPLACE INTO user_sessions SET
                 sessid = '".mysql_real_escape_string($sessid)."', 
                 lastaccess = '".time()."',
                 data = '".mysql_real_escape_string($data)."'",$this->dbh);

        if(mysql_affected_rows($this->dbh)){
            return true;
        }
        return false;
    }

    function destroy($sessid) {
        //remove session record from the database and return result
        mysql_query("DELETE FROM user_sessions 
                WHERE sessid = '".mysql_real_escape_string($sessid)."'",$this->dbh);
        if(mysql_affected_rows($this->dbh)){
            return true;
        }else{
            return false;
        }
    }

    function gc($maxLifeTime){
        //garbage collection
        $timeout = time() - $maxLifeTime;
        mysql_query("DELETE FROM user_sessions 
                        WHERE lastaccess < '".$timeout."'",$this->dbh);
        return mysql_affected_rows($this->dbh);
    }
}

new MySqlSessionStore();
session_start();


if (!isset($_SESSION['counters'])){
    $_SESSION['counters']['up'] = new Counter();
    $_SESSION['counters']['down'] = new Counter(100);
}

$_SESSION['counters']['up']->increment();
$_SESSION['counters']['down']->decrement(); 

?>