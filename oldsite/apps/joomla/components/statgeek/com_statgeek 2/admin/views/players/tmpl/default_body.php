<?php
/*------------------------------------------------------------------------
# default_body.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$edit = "index.php?option=com_statgeek&view=players&task=player.edit";
$stats = "index.php?option=com_statgeek&view=playerstats";
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php echo $item->firstname; ?> - (<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?>"><?php echo 'Edit'; ?></a>)
		</td>
		<td>
			<?php echo $item->lastname; ?>
		</td>
		<td>
			<?php echo $item->team; ?>
		</td>
        <td><a href="<?php echo $stats; ?>&player=<?php echo $item->id; ?>"><?php echo 'View'; ?></a></td>
	</tr>
<?php endforeach; ?>