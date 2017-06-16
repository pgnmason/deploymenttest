<?php
/*------------------------------------------------------------------------
# player.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Players Table Player class
 */
class StatgeekTableplayerstat extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__statgeek_player_stats', 'id', $db);
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form 'table_name.id'
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_statgeek.message.'.(int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetTitle()
	{
		return $this->title;
	}

	/**
	 * Get the parent asset id for the record
	 *
	 * @return	int
	 * @since	2.5
	 */
	protected function _getAssetParentId()
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_statgeek');

		return $asset->id;
	}
	
	
	public function statpurge(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->delete("#__statgeek_player_stats");
		$query->where("player=".$db->quote($this->player)." and game = ".$db->quote($this->game)." and season = ".$db->quote($this->season));
		$db->setQuery($query);
		$db->execute();
	}
	
	
	function statsave($obj){
		$clone = new stdclass();
		
		$clone->id = $this->id;
		$clone->player = $this->player;
		$clone->team = $this->team;
		$clone->season = $this->season;
		$clone->game = $this->game;
		
		foreach($obj as $k=>$v){
			$clone->stat = $k;
			$clone->value = $v;
			$this->_db->insertObject($this->_tbl,$clone);
		}
	}

}
?>