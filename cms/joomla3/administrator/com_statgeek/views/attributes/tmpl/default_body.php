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

$edit = "index.php?option=com_statgeek&view=attributes&task=attribute.edit";
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
        	<a href="<?php echo $edit."&id=".$item->id ?>"><?php echo $item->label; ?></a>
        </td>
        <td>
        	<a href="<?php echo $edit."&id=".$item->id ?>"><?php echo $item->name; ?></a>
        </td>
        <td>
        	<?php 
			switch($item->type){
				case 0:
					echo "Coach";
					break;
				case 1:
					echo "Player";
					break;
				case 2:
					echo "Internal";
					break;	
			}
			?>
        </td>
        <td><?php echo $item->field_type; ?></td>
        <td><?php echo $item->ordering; ?></td>
	</tr>
<?php endforeach; ?>