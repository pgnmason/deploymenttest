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
class StatgeekModelplayer extends JModelAdmin
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
	public function getTable($type = 'player', $prefix = 'StatgeekTable', $config = array())
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
		$form = $this->loadForm('com_statgeek.player', 'player', array('control' => 'jform', 'load_data' => $loadData));

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
		return 'administrator/components/com_statgeek/models/forms/player.js';
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
		$data = JFactory::getApplication()->getUserState('com_statgeek.edit.player.data', array());

		if (empty($data)):
			$data = $this->getItem();
		endif;

	return $data;
	}
	
	protected function prepareTable(&$table)
   {
	 $form = JRequest::getVar("jform","ARRAY");
	 $s = new stdClass();
	 foreach($form['details'] as $k=>$v){
		 $s->$k = $v;
	 }
	 $table->details = json_encode($s);
   }
   
   public function getFields(&$form,$std=array(),$fieldtype=1){
	   
	   
	   	$fields = StatGeekHelper::getFields($form,$std,"attribute",1);
	   /*
	   
	    $details = new stdClass();
		if(!empty($std)){
		foreach($std as $k=>$v){ $details->$k = $v;}
		}
		
		$db =& JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__statgeek_attribute AS b');
		$query->where('b.type = '. (int) $fieldtype);
		$query->order('ordering asc');
		$db->setQuery($query);
		$arr = $db->loadObjectList();
		$fields = array();
		foreach($arr as $field){
			$f = JFormHelper::loadFieldType($field->field_type, true);
			if($field->field_type !== "sql"){
				$fieldxml = new JXMLElement('<field
					class="inputbox '.$field->name.'"
					default=""
					description=""
					label="'.$field->label.'"
					name="'.$field->name.'"
					size="40"
					type="'.$field->type.'"
					directory="/"
				/>');
			}else{
				$fieldxml = new JXMLElement('<field
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
				/>');
			}
			$n = $field->name;
			$f->setForm($form);
			$f->setup($fieldxml,$details->$n,"details");
			$fields[] = $f;
		}
		*/
		return $fields;
   }
}
?>