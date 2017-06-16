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
	<p><strong>Name</strong>: <?php echo $this->item->name; ?></p>
	<p><strong>Published</strong>: <?php echo $this->item->published; ?></p>
	<p><strong>Start Date</strong>: <?php echo $this->item->startdate; ?></p>
	<p><strong>End Date</strong>: <?php echo $this->item->enddate; ?></p>
	<p><strong>League</strong>: <?php echo $this->item->league; ?></p>
</div>