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
$staff = $team->getStaff();
?>
<table>
<tr><th>Role</th><th>First Name</th><th>Last Name</th><th>Profile</th></tr>
<?php foreach($staff as $coach){?>
<tr><td><?php echo $coach->position->name?></td><td><?php echo $coach->firstname ?></td><td><?php echo $coach->lastname ?></td><td><a href="<?php echo $coach->linkURL?>">View</a></td></tr>
<? } ?>
</table>