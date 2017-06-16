<?php
/**
 * @version     1.0.0
 * @package     com_templatebuilder
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Nate Mason <nate@fargodesignco.com> - http://apps.fargodesignco.com
 */


// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templatebuilder/assets/css/templatebuilder.css');

$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_templatebuilder');
$saveOrder	= $listOrder == 'a.ordering';
?>

