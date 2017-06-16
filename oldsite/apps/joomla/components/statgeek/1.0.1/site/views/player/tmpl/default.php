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
<div id="statgeek-content">
	<div id="player-details">
        <?php echo $this->loadTemplate("profile"); ?>
     </div>   
        <div id="player-stats">
            <?php echo $this->loadTemplate("stats"); ?>
            
        </div>
        
    
</div>
<input type="hidden" name="player" value="<?php echo $this->item->id?>" />