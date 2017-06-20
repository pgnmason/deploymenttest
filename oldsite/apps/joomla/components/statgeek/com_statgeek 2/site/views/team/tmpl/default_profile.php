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
$record = $team->getRecord();
$season_name = $team->getSchedule()->currentSeason()->name;
?>
<h2 class="team-name"><?php echo $team->name; ?></h2>
	<p class="team-location"><?php echo $team->city; ?>, <?php echo $team->state; ?></p>
    <p class="team-record"><?php echo $season_name." Season Record: $record->wins - $record->losses - $record->ties";?></p>