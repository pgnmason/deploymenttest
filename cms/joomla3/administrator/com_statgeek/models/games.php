<?php
/*------------------------------------------------------------------------
# games.php - Stat Geek Component
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
 * Games Model
 */
class StatgeekModelgames extends JModelList
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

		// From the statgeek_game table
		$query->from('#__statgeek_game');
		$query->order(array('season asc','date asc'));

		return $query;
	}
	
	public function getTeamName($id){
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('name');
		$query->from("#__statgeek_team");
		$query->where("id=".$db->escape($id));
		$db->setQuery($query);
		
		return $db->loadResult();
	}
	
	public function getSeasonName($id){
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('CONCAT(b.name," - ",a.name)');
		$query->from("#__statgeek_season as a, #__statgeek_league as b");
		$query->where("a.id=".$db->escape($id)." and a.league = b.id");
		$db->setQuery($query);
		
		return $db->loadResult();
	}
}
?>