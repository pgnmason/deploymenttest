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

?><div id="statgeek-content">
	<p><strong>Home Team</strong>: <?php echo $this->item->hometeam; ?></p>
	<p><strong>Away Team</strong>: <?php echo $this->item->awayteam; ?></p>
	<p><strong>Home Score</strong>: <?php echo $this->item->homescore; ?></p>
	<p><strong>Away Score</strong>: <?php echo $this->item->awayscore; ?></p>
	<p><strong>Date</strong>: <?php echo $this->item->date; ?></p>
	<p><strong>Season</strong>: <?php echo $this->item->season; ?></p>
</div>