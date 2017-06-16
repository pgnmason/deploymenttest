<?php
/**
 * @version		
 * @package		Quick Events
 * @author 		
 * @author mail	
 * @link		
 * @copyright	Copyright (C) 2011  - All rights reserved.
 * @license		GNU/GPL
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');
 
// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');





JLoader::register('TemplatebuilderHelper', dirname(__FILE__) . DS . 'helper.php');
JHTML::script("components/com_templatebuilder/assets/javascript/function.js");

// Require specific controller if requested
if($controller = JRequest::getVar('view','templates')) 
{
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if ( file_exists( $path ) ) {
		require_once( $path );
	} else {
		$controller = '';
	}
}

// Create the controller
$classname	= 'TemplatebuilderController' . ucfirst($controller);
$controller = new $classname();

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();