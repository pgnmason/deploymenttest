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

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Player Model
 */
class StatgeekModelplayerstat extends JModelAdmin
{
	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param	array	$data	An array of input data.
	 * @param	string	$key	The name of the key for the primary key.
	 *
	 * @return	boolean
	 * @since	2.5
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Check specific edit permission then general edit permission.
		return JFactory::getUser()->authorise('core.edit', 'com_statgeek.message.'. ((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);
	}

	/**
	 * Returns a reference to the a table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	2.5
	 */
	public function getTable($type = 'playerstat', $prefix = 'StatgeekTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	2.5
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_statgeek.playerstat', 'playerstat', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form)):
			return false;
		endif;

		return $form;
	}

	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	script files
	 */
	public function getScript()
	{
		return 'administrator/components/com_statgeek/models/forms/playerstat.js';
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	2.5
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_statgeek.edit.playerstat.data', array());

		if (empty($data)):
			$data = $this->getItem();
		endif;

	return $data;
	}
	
	
	function getItem(){
		$game = JRequest::getVar("id",false,"INT");
		$player = JRequest::getVar("player",false,"INT");
		
		if(!$game && !$player){
			return false;
		}
		if(!$game){
			JError::raiseError(500, "Game Undefined");
			return false;
		}
		
		if(!$player){
			JError::raiseError(500, "Player Undefined");
			return false;
		}
		$data = new stdClass();
		$data->player = $player;
		$data->game = $game;
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select("*");
		$query->from("#__statgeek_player_stats");
		$query->where("game=".$game." and player=".$player);
		$db->setQuery($query);
		$objlist = $db->loadObjectList();
		
		$details = new stdClass();
		
		foreach($objlist as $obj){
			$k = $obj->stat;
			$details->$k = $obj->value;
			$data->team = $obj->team;
			$data->season = $obj->season;
			
		}
		$data->details = json_encode($details);
		
		return $data;
	}
	
	
	protected function prepareTable(&$table)
   {
	 $table->statpurge();
	 $form = JRequest::getVar("jform","ARRAY");
	 $s = new stdClass();
	 $c = count($form['details']);
	 $i = 1;
	 foreach($form['details'] as $k=>$v){
		 $table->stat = $k;
		 $table->value = $v;
		 if($i == $c){ break; }
		 $s->$k = $v;
		 $i++; 
	 }
	 $table->statsave($s);
   }
   
   public function getFields(&$form,$std=array(),$fieldtype=1){
	   	$fields = StatGeekHelper::getFields($form,$std,"stat",1);
		return $fields;
   }
}
?>