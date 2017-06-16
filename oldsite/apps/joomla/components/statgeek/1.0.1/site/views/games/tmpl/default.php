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
<div id="statgeek-games">
	<?php foreach($this->items as $item): ?>
		<?php
		if(empty($item->alias)):
			$item->alias = $item->hometeam;
		endif;
		$item->alias = JFilterOutput::stringURLSafe($item->alias);
		$item->linkURL = JRoute::_('index.php?option=com_statgeek&view=game&id='.$item->id.':'.$item->alias);
		?>
		<p><strong>Home Team</strong>: <a href="<?php echo $item->linkURL; ?>"><?php echo $item->hometeam; ?></a></p>
		<p><strong>Away Team</strong>: <?php echo $item->awayteam; ?></p>
		<p><strong>Home Score</strong>: <?php echo $item->homescore; ?></p>
		<p><strong>Away Score</strong>: <?php echo $item->awayscore; ?></p>
		<p><strong>Date</strong>: <?php echo $item->date; ?></p>
		<p><strong>Season</strong>: <?php echo $item->season; ?></p>
		<p><strong>Link URL</strong>: <a href="<?php echo $item->linkURL; ?>">Go to page</a> - <?php echo $item->linkURL; ?></p>
		<br /><br />
	<?php endforeach; ?>
</div>
