<?
/*
Filename: config.php
Purpose: This file holds all of the connection data and global settings for the website.
*/
date_default_timezone_set("America/New_York");

$db_host = 'bricklayerapi.db.10849616.hostedresource.com';
/*$db_user = 'mlo_db_php';
$db_pass = 'Fb0#85751px(81abg-1kx:';*/
$db_user = 'bricklayerapi';
$db_pass = "Br1ckl@y3r!";
$db_name = 'bricklayerapi';
$msalt1 = 'ctfvvoEuBkhFG';
$msalt2 = 'DfkxthjrgxzkA';

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



$includes = $_SERVER['DOCUMENT_ROOT'].$ds."api".$ds."php".$ds;

$doc_root = $_SERVER['DOCUMENT_ROOT'];

$config_dir = $doc_root.$ds."api".$ds."php".$ds."config".$ds;

$common_files = $doc_root.$ds."api".$ds."php".$ds."config".$ds.'common'.$ds;

$utils_dir = $includes.$ds."utils".$ds;


$functions = $includes.$ds."files".$ds."functions.php";

$member_path = $includes.$ds."library".$ds."members".$ds;

$promoter_path = $includes.$ds."library".$ds."promoters".$ds;

$home_dir = "";

$view_path = $_SERVER['DOCUMENT_ROOT'].$ds."views".$ds;

$menu_path = $_SERVER['DOCUMENT_ROOT'].$ds."menus".$ds."site".$ds;

//Path to the Default Modules
$module_path = $_SERVER['DOCUMENT_ROOT'].$ds."modules".$ds;

$uploads_dir = $_SERVER['DOCUMENT_ROOT'].$ds."uploads".$ds;


$admin_view_path = $_SERVER['DOCUMENT_ROOT'].$ds."admin".$ds."views".$ds;

$admin_menu_path = $_SERVER['DOCUMENT_ROOT'].$ds."menus".$ds."admin".$ds;

$admin_layout_path = $_SERVER['DOCUMENT_ROOT'].$ds."admin".$ds."layouts".$ds;

$admin_model_path = $_SERVER['DOCUMENT_ROOT'].$ds."admin".$ds."models".$ds;


$layout_path = $_SERVER['DOCUMENT_ROOT'].$ds."layouts".$ds;

$model_path = $_SERVER['DOCUMENT_ROOT'].$ds."models".$ds;

$template_path = $_SERVER['DOCUMENT_ROOT'].$ds."templates".$ds.$template.$ds;

$template_uri = $ds."templates".$ds.$template.$ds;

$script_directory = $ds."rdata".$ds."js".$ds;

$script_absolute_directory = $_SERVER['DOCUMENT_ROOT'].$ds."rdata".$ds."js".$ds;

$default_css_path = $ds."css/";
$default_css_name = "screen.css";

$default_image_path = "images/";


$site_styles = array("library/highslide/highslide","library/search/livesearch","library/form/default");
$site_scripts = array("library/highslide/highslide.full","library/highslide/highslide.config","library/jquery/jquery","library/search/livesearch","library/form/customfields","library/form/customselect","custom/site/scripts");






?>