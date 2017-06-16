<?php
/*------------------------------------------------------------------------
# teams.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * Teams Model
 */
class StatgeekModelteams extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('*');

		// From the statgeek_team table
		$query->from('#__statgeek_team');
		$query->order("league asc");

		return $query;
	}
	
	function getLeagueName($league){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('name');

		// From the statgeek_team table
		$query->from('#__statgeek_league');
		$query->where('id='.$db->quote($league));
		$db->setQuery($query);
		$data = $db->loadResult();
		return $data;
	}
}
?>