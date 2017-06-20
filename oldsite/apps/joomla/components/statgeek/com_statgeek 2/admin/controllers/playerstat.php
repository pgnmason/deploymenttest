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

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Players Controller Player
 */
class StatgeekControllerplayerstat extends JControllerForm
{


	function cancel(){
		exit();
		$player = JRequest::getVar("player",false);
		var_dump($_REQUEST);
		var_dump($player);
		if(!$player){
			$this->setRedirect(JRoute::_('index.php?option=com_statgeek&view=players', false));
		}
		echo 'index.php?option=com_statgeek&view=playerstats&player='.$player;
		exit();
		$this->setRedirect(JRoute::_('index.php?option=com_statgeek&view=playerstats&player='.$player, false));
		
	}
}
?>