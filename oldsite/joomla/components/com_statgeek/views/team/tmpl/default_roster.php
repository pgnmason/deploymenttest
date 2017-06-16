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
$roster = $team->getRoster();
?>
<table>
<tr><th>#</th><th>Pos.</th><th>Last Name</th><th>First Name</th><th>Profile</th></tr>
<?php foreach($roster as $player){?>
<tr><td><?php echo $player->profile("number")?></td><td><?php echo $player->position->abbreviation?></td><td><?php echo $player->lastname ?></td><td><?php echo $player->firstname ?></td><td><a href="<?php echo $player->linkURL?>">View</a></td></tr>
<? } ?>
</table>