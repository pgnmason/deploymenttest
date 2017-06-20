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
$team = $this->item;
$schedule = $team->getSchedule();
$season = $schedule->getSeason(2013);
foreach($season->games as $game){
	$game->loadData();
	$opponent = $game->getOpponent($team->id);
	
		?>
		<div class="game <?php if($game->hometeam == $team->id){ echo "home"; } ?>">
        	<div class="gamedate"><?php echo date("m/d/y g:i:a",strtotime($game->date))?></div>
        	<div class="opponent">
			<?php if($game->awayteam == $team->id){ echo "@"; } ?>
			<?php echo $opponent->name;?></div>
            <?php if(strtotime($game->date) < time()){?>
                <div class="result">
                    <?php 
                        switch($game->result){
                            case $team->id:
                                echo "W";
                                break;
                            case $opponent->id:
                                echo "L";
                                break;
                            default:
                                echo "T";
                                break;
                        }
                    ?>
                    
                    <?php echo $game->getTeam($team->id)->score;?>-<?php echo $opponent->score?>
                </div>
            <? } ?>
            <div style="clear:both"></div>
        </div>
		<?
}
?>