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

$player = $this->item;
?>
<div id="player-image">
            <img src="<?php echo stripslashes($player->profile("photo"));?>" />
        </div>
        <div id="player-vitals">
            <p class="player-name"><strong>Name</strong>: <?php echo $player->firstname." ".$player->lastname; ?></p>
            <p class="player-number"><strong>No.</strong>: <?php echo $player->profile("number"); ?></p>
            <p class="player->position"><strong>Position</strong>: <?php echo $player->position->abbreviation; ?></p>
            <p class="player-height"><strong>Height</strong>: <?php echo $player->profile("height"); ?></p>
            <p class="player-weight"><strong>Weight</strong>: <?php echo $player->profile("weight"); ?></p>
            <p class="player-team"><strong>Team</strong>: <?php echo $player->team->name; ?></p>
            <p class="player-school"><strong>School</strong>: <?php echo $player->profile("school"); ?></p>
            
        </div>
        <div style="clear:both"></div>
        <div id="player-bio">
            <p><strong>Bio</strong>: <?php echo $player->bio; ?></p>
        </div>