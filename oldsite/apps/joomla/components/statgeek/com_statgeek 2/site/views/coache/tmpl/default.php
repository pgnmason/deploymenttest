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
$coach = $this->item;
?>


<div id="coach-profile">

<div id="coach-image">
            <img src="<?php echo stripslashes($coach->profile("coach_photo"));?>" />
        </div>
        <div id="cooa-vitals">
            <p class="coach-name"><strong>Name</strong>: <?php echo $coach->firstname." ".$coach->lastname; ?></p>
            <p class="coach-position"><strong>Position</strong>: <?php echo $coach->position->abbreviation; ?></p>
            <p class="coach-team"><strong>Team</strong>: <?php echo $coach->team->name; ?></p>
            <p class="coach-experience"><strong>PFC Experience</strong>: <?php echo $coach->profile("pfc_experience"); ?></p>
            
        </div>
        <div style="clear:both"></div>
        <div id="coach-bio">
            <p><strong>Bio</strong>: <?php echo $coach->bio; ?></p>
        </div>
        <div id="coach-previous">
            <p><strong>Previous Experience</strong>: <?php echo $coach->profile("previous_experience"); ?></p>
        </div>
</div>