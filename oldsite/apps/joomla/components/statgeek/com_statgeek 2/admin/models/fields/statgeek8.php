<?php
/*------------------------------------------------------------------------
# statgeek8.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * firstname Form Field class for the Statgeek component
 */
class JFormFieldstatgeek8 extends JFormFieldList
{
	/**
	 * The firstname field type.
	 *
	 * @var		string
	 */
	protected $type = 'statgeek8';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__statgeek_player.id as id, #__statgeek_player.firstname as firstname');
		$query->from('#__statgeek_player');
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
		$options = array();
		if($items):
			foreach($items as $item):
				$options[] = JHtml::_('select.option', $item->id, ucwords($item->firstname));
			endforeach;
		endif;
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
?>