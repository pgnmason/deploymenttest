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

// Set the component css/js
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_statgeek/assets/css/statgeek.css');

// Require helper file
JLoader::register('StatgeekHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'statgeek.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by Statgeek
$controller = JController::getInstance('Statgeek');

// Perform the request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
?>