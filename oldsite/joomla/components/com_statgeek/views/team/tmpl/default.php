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
<div id="team-data">
<div id="team-profile">
	<?php echo $this->loadTemplate("profile");?>
</div>
<div id="team-staff">
<h3>Staff</h3>
<?php echo $this->loadTemplate("staff");?>
</div>

<div id="team-roster">
<h3>Roster</h3>
<?php echo $this->loadTemplate("roster");?>
</div>
</div>


<div id="team-schedule">
<h3>Schedule</h3>
<?php echo $this->loadTemplate("schedule");?>
</div>
<div style="clear:both"></div>