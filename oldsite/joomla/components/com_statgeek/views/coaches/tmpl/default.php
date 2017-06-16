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
<div id="statgeek-coaches">
	<?php foreach($this->items as $item): ?>
		<?php
		if(empty($item->alias)):
			$item->alias = $item->firstname;
		endif;
		$item->alias = JFilterOutput::stringURLSafe($item->alias);
		$item->linkURL = JRoute::_('index.php?option=com_statgeek&view=coache&id='.$item->id.':'.$item->alias);
		?>
		<p><strong>First Name</strong>: <a href="<?php echo $item->linkURL; ?>"><?php echo $item->firstname; ?></a></p>
		<p><strong>Last Name</strong>: <?php echo $item->lastname; ?></p>
		<p><strong>Team</strong>: <?php echo $item->team; ?></p>
		<p><strong>Bio</strong>: <?php echo $item->bio; ?></p>
		<p><strong>Link URL</strong>: <a href="<?php echo $item->linkURL; ?>">Go to page</a> - <?php echo $item->linkURL; ?></p>
		<br /><br />
	<?php endforeach; ?>
</div>
