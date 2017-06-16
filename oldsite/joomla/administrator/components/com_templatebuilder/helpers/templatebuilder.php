<?php
/**
 * @version     1.0.0
 * @package     com_templatebuilder
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Nate Mason <nate@fargodesignco.com> - http://apps.fargodesignco.com
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Templatebuilder helper.
 */
class TemplatebuilderHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_TEMPLATEBUILDER_TITLE_TEMPLATES'),
			'index.php?option=com_templatebuilder&view=templates',
			$vName == 'templates'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_TEMPLATEBUILDER_TITLE_FARGOTEMPLATESS'),
			'index.php?option=com_templatebuilder&view=fargotemplatess',
			$vName == 'fargotemplatess'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_templatebuilder';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
