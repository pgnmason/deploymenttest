<?php
/*------------------------------------------------------------------------
# statgeek.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_statgeek')):
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
endif;

// require helper files
JLoader::register('StatgeekHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'statgeek.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Add CSS file for all pages
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_statgeek/assets/css/statgeek.css');
$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$document->addScript('components/com_statgeek/assets/js/statgeek.js');

// Get an instance of the controller prefixed by Statgeek
$controller = JControllerLegacy::getInstance('Statgeek');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>