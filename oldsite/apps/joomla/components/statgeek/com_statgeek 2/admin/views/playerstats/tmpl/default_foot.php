<?php
/*------------------------------------------------------------------------
# default_foot.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<tr>
	<td colspan="<?php echo count($this->player->statheadings)+4;?>"><?php echo $this->pagination->getListFooter(); ?></td>
</tr>