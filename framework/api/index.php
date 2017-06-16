<? header('Access-Control-Allow-Origin: *');
ini_set("display_errors",1);
require("php/config/config.php");
require($functions);
define("BL_EXEC", "NATE RULES");

$sub = Request::getVar("sub","get");
$task = Request::getVar("task","get");

if(!($sub) || !($task)){
    die("UNAUTHORIZED ACCESS");
}

if(!file_exists("subs".$ds.$sub.".php")){
    die("INVALID API");
}

require("subs".$ds.$sub.".php");
$classname = str_replace(" ","",ucwords(str_replace(array("_","-")," ",$sub)));

$f = new $sub();

$f->setTask($task);
$f->run();









?>