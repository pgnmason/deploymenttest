<?php 
/* Filename: config.php Purpose: This file holds all of the connection data and global settings for the website. */
date_default_timezone_set("America/New_York");

$db_host = 'bricklayerapi.db.10849616.hostedresource.com';
/*$db_user = 'mlo_db_php';
$db_pass = 'Fb0#85751px(81abg-1kx:';*/
$db_user = 'bricklayerapi';
$db_pass = 'N81sgrr8!';
$db_name = 'bricklayerapi';
$msalt1 = 'JE8_Pru8HEguBUp4c3';
$msalt2 = 'STup9aq8#a3re$a!hu';


$template = 'flyer-city';

$guest_level = 15;

$authtable = "users";
$authmetric = "username";
$pname = "pass";
$saltname="salt";
$use_db = true;


$sys_email = "mandawgus@gmail.com";


$front_path =  'app';
$front_ajax = 'ajax';
$admin_path  = "backend";
$admin_ajax = 'admin-ajax';

$ds = DIRECTORY_SEPARATOR;



//********** FONT AND COLOR DEFINITIONS //

$orange = 'd44a10';
$purple = '711c89';
$black = '000000';
$burnt_orange = 'b2583a';
$white = 'ffffff';

$chaloops['font'] = 'chaloops.otf';
$nilland_black['font'] = 'nilland-black.ttf';
$nilland['font'] = 'nilland.ttf';
$chaloops_med['font'] = 'chaloops-med.ttf';
$asjiggy['font'] = 'ASJiggyRoman.ttf';




//***************** APPLICATION PATHS //



$includes = (empty($inc_root)) ? $_SERVER['DOCUMENT_ROOT'].$ds."php" : $inc_root;

$config_dir = $includes.$ds."config".$ds;

$common_files = $config_dir.'common'.$ds;

$utils_dir = $includes.$ds."utils".$ds;

$default_css_path = $ds."css/";
$default_css_name = "screen.css";

$default_image_path = "images/";
?>