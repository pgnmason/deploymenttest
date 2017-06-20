<?php
/*------------------------------------------------------------------------
# default.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$this->item->loadData();

?>


<div id="league-information">
	<h1><?php echo $this->item->name; ?></h1>
    <div id="league-standings">
       <?php $league = $this->item;?>
       <h2><?php echo $league->currentSeason()->name;?> Season Standings</h2>
       <table>
       	<tr><th>Team</th><th>Wins</th><th>Losses</th><th>Ties</th><th>Games Played</th></tr>
        <?php foreach($league->teams as $t){
			
			if(empty($t->alias)):
				$t->alias = $t->name;
			endif;
			$t->alias = JFilterOutput::stringURLSafe($t->alias);
			//echo JRoute::_('index.php?option=com_statgeek&view=team&id='.$item->id);
			$t->linkURL = JRoute::_('index.php?option=com_statgeek&view=team&id='.$t->id.':'.$t->alias);	
		?>
        
		<tr><td><a href="<?php echo $t->linkURL?>"><?php echo $t->name ?></a></td><td><?php echo $t->record->wins?></td><td><?php echo $t->record->losses?></td><td><?php echo $t->record->ties?></td><td><?php echo $t->record->gp?></td></tr>
		<? }?>
       </table>
    </div>
</div>

