<?php
/*------------------------------------------------------------------------
# players.php - Stat Geek Component
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
require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."game.php");
require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."team.php");
require_once(JPATH_COMPONENT.DS."assets".DS."classes".DS."player.php");
/**
 * Players Model
 */
class StatgeekModelplayerstats extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		$player = JRequest::getVar("player",false,"INT");
		if(!$player){
			JError::raiseError(500, "Player Undefined");
			return false;
		}
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('*');

		// From the statgeek_player table
		$query->from('#__statgeek_player_stats');
		
		$query->where("player=".$db->quote($player));

		return $query;
	}
	
	
	function getPlayer(){
		$player = JRequest::getVar("player",false,"INT");
		if(!$player){
			JError::raiseError(500, "Player Undefined");
			return false;
		}
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('*');

		// From the statgeek_player table
		$query->from('#__statgeek_player');
		
		$query->where("id=".$db->quote($player));
		$db->setQuery($query);
		return $db->loadObject("SGeekPlayer");
	}
}
?>