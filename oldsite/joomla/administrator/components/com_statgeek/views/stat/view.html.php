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
 * Stat View
 */
class StatgeekViewstat extends JView
{
	/**
	 * display method of Stat view
	 * @return void
	 */
	public function display($tpl = null)
	{
		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');
		$script = $this->get('Script');

		// Check for errors.
		if (count($errors = $this->get('Errors'))):
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		endif;

		// Assign the variables
		$this->form = $form;
		$this->item = $item;
		$this->script = $script;

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
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId	= $user->id;
		$isNew = $this->item->id == 0;
		$canDo = StatgeekHelper::getActions($this->item->id);
		JToolBarHelper::title($isNew ? JText::_('Stat :: New') : JText::_('Stat :: Edit'), 'stat');
		// Built the actions for new and existing records.
		if ($isNew):
			// For new records, check the create permission.
			if ($canDo->get('core.create')):
				JToolBarHelper::apply('stat.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('stat.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('stat.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			endif;
			JToolBarHelper::cancel('stat.cancel', 'JTOOLBAR_CANCEL');
		else:
			if ($canDo->get('core.edit')):
				// We can save the new record
				JToolBarHelper::apply('stat.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('stat.save', 'JTOOLBAR_SAVE');
				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($canDo->get('core.create')):
					JToolBarHelper::custom('stat.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				endif;
			endif;
			if ($canDo->get('core.create')):
				JToolBarHelper::custom('stat.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			endif;
			JToolBarHelper::cancel('stat.cancel', 'JTOOLBAR_CLOSE');
		endif;
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('Stat :: New :: Administrator') : JText::_('Stat :: Edit :: Administrator'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "administrator/components/com_statgeek/views/stat/submitbutton.js");
		JText::script('stat not acceptable. Error');
	}
}
?>