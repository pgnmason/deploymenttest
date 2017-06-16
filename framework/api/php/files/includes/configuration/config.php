<?
/*
Filename: config.php
Purpose: This file holds all of the connection data and global settings for the website.
*/

//Path to the required Files
$file_path = $includes.$ds.'files'.$ds.'includes'.$ds.'functions'.$ds.'core'.$ds.'';
//Path to Modules
$module = $includes.$ds.'files'.$ds.'includes'.$ds.'functions'.$ds.'optional'.$ds.'';

//Path to the required Classes
$class_path = $includes.$ds.'files'.$ds.'includes'.$ds.'classes'.$ds.'required'.$ds.'';

//Path to the Components
$component = $includes.$ds.'files'.$ds.'includes'.$ds.'classes'.$ds.'optional'.$ds.'';







//Path to the Default Views
$def_views = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'views'.$ds.'';

//Path to the Default Layouts
$def_layouts = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'layouts'.$ds.'';

$def_menus = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'menus'.$ds.'site'.$ds;

//Path to the Default Layouts
$def_models = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'models'.$ds.'';

//Path to the Default Modules
$def_module_path = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'modules'.$ds.'';









//Path to the Default Admin Views
$def_admin_views = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'admin'.$ds.'views'.$ds.'';

//Path to the Default Admin Views
$def_admin_models = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'admin'.$ds.'models'.$ds.'';

//Path to the Default Admin Layouts
$def_admin_layouts = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'admin'.$ds.'layouts'.$ds.'';

$def_admin_menus = $includes.$ds.'files'.$ds.'includes'.$ds.'libraries'.$ds.'default'.$ds.'menus'.$ds.'admin'.$ds;





$image_path = 'files'.$ds.'';
$image_folder = $_SERVER['DOCUMENT_ROOT'].''.$ds.'filemanager'.$ds.'images'.$ds.'';

$pdf_path = 'files'.$ds.'';
$pdf_folder = $_SERVER['DOCUMENT_ROOT'].''.$ds.'filemanager'.$ds.'images'.$ds.'';

define("PRINTDATE","F j, Y, g:i a");
define("ADMINDATE","m/d/Y g:i a");


?>