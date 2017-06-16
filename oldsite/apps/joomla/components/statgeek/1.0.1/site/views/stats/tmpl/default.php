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
jimport('joomla.filter.output');
?>
<div id="statgeek-stats">
	<?php foreach($this->items as $item): ?>
		<?php
		if(empty($item->alias)):
			$item->alias = $item->name;
		endif;
		$item->alias = JFilterOutput::stringURLSafe($item->alias);
		$item->linkURL = JRoute::_('index.php?option=com_statgeek&view=stat&id='.$item->id.':'.$item->alias);
		?>
		<p><strong>Name</strong>: <a href="<?php echo $item->linkURL; ?>"><?php echo $item->name; ?></a></p>
		<p><strong>Sports</strong>: <?php echo $item->sports; ?></p>
		<p><strong>Link URL</strong>: <a href="<?php echo $item->linkURL; ?>">Go to page</a> - <?php echo $item->linkURL; ?></p>
		<br /><br />
	<?php endforeach; ?>
</div>
