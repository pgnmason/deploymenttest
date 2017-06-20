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

/**
 * Statgeek component helper.
 */
abstract class StatgeekHelper
{
	/**
	 *	Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('Statgeek'), 'index.php?option=com_statgeek&view=statgeek', $submenu == 'statgeek');
		JSubMenuHelper::addEntry(JText::_('Sports'), 'index.php?option=com_statgeek&view=sports', $submenu == 'sports');
		JSubMenuHelper::addEntry(JText::_('Leagues'), 'index.php?option=com_statgeek&view=leagues', $submenu == 'leagues');
		JSubMenuHelper::addEntry(JText::_('Seasons'), 'index.php?option=com_statgeek&view=seasons', $submenu == 'seasons');
		JSubMenuHelper::addEntry(JText::_('Games'), 'index.php?option=com_statgeek&view=games', $submenu == 'games');
		JSubMenuHelper::addEntry(JText::_('Stats'), 'index.php?option=com_statgeek&view=stats', $submenu == 'stats');
		JSubMenuHelper::addEntry(JText::_('Positions'), 'index.php?option=com_statgeek&view=positions', $submenu == 'positions');
		JSubMenuHelper::addEntry(JText::_('Teams'), 'index.php?option=com_statgeek&view=teams', $submenu == 'teams');
		JSubMenuHelper::addEntry(JText::_('Players'), 'index.php?option=com_statgeek&view=players', $submenu == 'players');
		JSubMenuHelper::addEntry(JText::_('Coaches'), 'index.php?option=com_statgeek&view=coaches', $submenu == 'coaches');
		JSubMenuHelper::addEntry(JText::_('Attributes'), 'index.php?option=com_statgeek&view=attributes', $submenu == 'attributes');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_categories&view=categories&extension=com_statgeek', $submenu == 'categories');

		// set some global property
		$document = JFactory::getDocument();
		if ($submenu == 'categories'):
			$document->setTitle(JText::_('Categories - Statgeek'));
		endif;
	}

	/**
	 *	Get the actions
	 */
	public static function getActions($Id = 0)
	{
		jimport('joomla.access.access');

		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($Id)):
			$assetName = 'com_statgeek';
		else:
			$assetName = 'com_statgeek.message.'.(int) $Id;
		endif;

		$actions = JAccess::getActions('com_statgeek', 'component');

		foreach ($actions as $action):
			$result->set($action->name, $user->authorise($action->name, $assetName));
		endforeach;

		return $result;
	}
	
	
	private function fieldXML($field){
		
		switch($field->field_type){
			case "sql":
				$xml ='<field
					class="inputbox '.$field->name.'"
					default=""
					description=""
					label="'.$field->label.'"
					name="'.$field->name.'"
					type="'.$field->type.'"
					query="'.$field->field_data.'"
					key_field="id"
					value_field="name"
					multiple="false"
				/>';
				break;
			case "integer":
				$data = explode(":",$field->field_data);
				$data[2] = (empty($data[2])) ? 1 : $data[2];
				$xml='<field 
					name="'.$field->name.'" 
					type="'.$field->type.'" 
					default="'.$data[0].'" 
					label="'.$field->label.'" 
					description="" 
					first="'.$data[0].'" 
					last="'.$data[1].'" 
					step="'.$data[2].'" 
				/>';
				break;
			case "list":
				$data = explode(",",$field->field_data);
				
				
				$xml='<field 
					name="'.$field->name.'" 
					type="'.$field->type.'" 
					label="'.$field->label.'" 
					description=""  
				>';
				
				foreach($data as $d){
					$opt = explode(":",$d);
					$opt[1] = (empty($opt[1])) ? $opt[0] : $opt[1];
					$xml .= '<option value="'.$opt[1].'">'.$opt[2].'</option>';
				}
				
				$xml .= '</field>';
				
					
				break;
			default:
				$xml = '<field
					class="inputbox '.$field->name.'"
					default=""
					description=""
					label="'.$field->label.'"
					name="'.$field->name.'"
					size="40"
					type="'.$field->type.'"
					directory="/"
				/>';
				break;
		}
		
		$fieldxml = new JXMLElement($xml);
		
			return $fieldxml;
	}
	
	
	public function getFields(&$form,$std=array(),$table="attribute",$fieldtype=1){
	    $details = new stdClass();
		if(!empty($std)){
			foreach($std as $k=>$v){ $details->$k = $v;}
		}
		
		$db =& JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_'.$table.' AS b');
		$query->where('b.type = '. (int) $fieldtype);
		$query->order('ordering asc');
		$db->setQuery($query);
		$arr = $db->loadObjectList();
		$fields = array();
		foreach($arr as $field){
			$f = JFormHelper::loadFieldType($field->field_type, true);
			
			$fieldxml = self::fieldXML($field);
			$n = $field->name;
			$f->setForm($form);
			$f->setup($fieldxml,$details->$n,"details");
			$fields[] = $f;
		}
		return $fields;
   }
}
?>