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


$player = $this->player;
$edit = "index.php?option=com_statgeek&view=playerstat&layout=edit&player=".$this->player->id."&id=";
?>


 <?php foreach($player->stats as $season=>$games){?>
<tr  class="row<?php echo ($i+1) % 2; $i=$i+1;?>"><th class="season-stat-heading" colspan="<?php echo count($player->statheadings)+4;?>"><?php echo $season?> Season</th></tr>
        <?php foreach($games as $i=>$g){?>
             
            <tr class="row<?php echo $i % 2; ?>">  
                <td>
                    <?php echo $item->id; ?>
                </td>
                <td>
                    <?php echo JHtml::_('grid.id', $i, $g->id); ?>
                </td>              
            	<td><a href="<?php echo $edit.$g->id?>"><?php echo $g->date ?></a></td>
                <td><?php echo $g->getOpponent($player->team->id)->name;?></td>
                <?php foreach($player->statheadings as $s){?>
                <td><?php echo (isset($g->stats[$s])) ? $g->stats[$s] : "0";?></td> 
                <? }?>
            </tr>
        <? }?>
       <?php /*?> <tr class="row<?php echo ($i+1) % 2; ?>">
            <td colspan="4" class="season total">Season Totals:</td>
            <?php foreach($player->statheadings as $s){?>
                <td><?php echo $player->seasonTotals($season,$s);?></td> 
            <? }?>
        </tr>
        <tr class="row<?php echo ($i+2) % 2; ?>">
            <td colspan="4" class="season total">Season Avg:</td>
            <?php foreach($player->statheadings as $s){?>
                <td><?php echo (float)($player->seasonTotals($season,$s)/count($games));?></td> 
            <? }?>
        </tr><?php */?>
    <?php }?>