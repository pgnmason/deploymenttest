<?php
/*------------------------------------------------------------------------
# view.html.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * teams View
 */
class StatgeekViewteams extends JView
{
	/**
	 * Teams view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$model = $this->getModel();

		// Check for errors.
		if (count($errors = $this->get('Errors'))):
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		endif;
		
		foreach($items as $item){
			$item->league = $model->getLeagueName($item->league);
		}
		// Assign data to the view
		$this->items = $items;
		
		
		
		
		$this->pagination = $pagination;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$canDo = StatgeekHelper::getActions();
		JToolBarHelper::title(JText::_('Statgeek Manager'), 'statgeek');
		if($canDo->get('core.create')):
			JToolBarHelper::addNew('team.add', 'JTOOLBAR_NEW');
		endif;
		if($canDo->get('core.edit')):
			JToolBarHelper::editList('team.edit', 'JTOOLBAR_EDIT');
		endif;
		if($canDo->get('core.delete')):
			JToolBarHelper::deleteList('', 'teams.delete', 'JTOOLBAR_DELETE');
		endif;
		if($canDo->get('core.admin')):
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_statgeek');
		endif;
	}

	/**
	 * Method to set up the document properties
	 *
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('Statgeek Manager - Administrator'));
	}
}
?>