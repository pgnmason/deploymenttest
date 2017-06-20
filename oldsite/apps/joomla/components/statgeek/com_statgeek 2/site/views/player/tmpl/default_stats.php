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

$player = $this->item;

?>
<?php if(count($player->statheadings) >0){ ?>
<table>           	
    <tr>
        <th>Date</th><th>Opponent</th><? foreach($player->statheadings as $s){ echo "<th>".ucwords(implode(" ",explode("_",$s)))."</th>";}?>
    </tr>
    <?php foreach($player->stats as $season=>$games){?>
    <tr><th class="season-stat-heading" colspan="<?php echo count($player->statheadings)+2;?>"><?php echo $season?> Season</th></tr>
        <?php foreach($games as $g){?>
            <tr>
                <td><?php echo $g->date ?></td>
                <td><?php echo $g->getOpponent($player->team->id)->name;?></td>
                <?php foreach($player->statheadings as $s){?>
                <td><?php echo (isset($g->stats[$s])) ? $g->stats[$s] : "0";?></td> 
                <? }?>
            </tr>
        <? }?>
        <tr>
            <td colspan="2" class="season total">Season Totals:</td>
            <?php foreach($player->statheadings as $s){?>
                <td><?php echo $player->seasonTotals($season,$s);?></td> 
            <? }?>
        </tr>
        <tr>
            <td colspan="2" class="season total">Season Avg:</td>
            <?php foreach($player->statheadings as $s){?>
                <td><?php echo (float)($player->seasonTotals($season,$s)/count($games));?></td> 
            <? }?>
        </tr>
    <?php }?>
</table>
<? } ?>