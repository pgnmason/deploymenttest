<? 
$class[0] ='light-grey'; 
$class[2] ='dark-grey';
?> 
	  
	  <table id="flytunes_table" cellspacing="0">
        <? 
				$c = count($tracks);
				if($c > 0){
					$i = -1; 
					foreach($tracks as $d){ 
					
					$user = new SiteUser($d->user_id);
					
					
					$trackData = array("filename"=>$d->filename, "user"=>$d->user_id,"track"=>$d->id,"type"=>"file");
					
					
					
					
						?>
        <tr class="flytunes_row">
          <td class="<?= $class[$i+1]; ?> first_cell">
          	<table class="track-meta">
              <tr>
                <td class="black"><span class="bold"><?= $d->artist?> - <?= $d->title ?></span> (<?= $d->genre_name ?>)</td>
				<td rowspan="2" style="text-align:right;">
				<? if(isset($u->id)){  $userData =array("track"=>$d->id,"user"=>$u->id); if(!$u->checkLibrary($d->id)){?><?php /*?><a href="javascript:;" onclick="addToLibrary('<?=  imageEncode($userData);?>')"></a><?php */?>Add to Music Library <input type="checkbox" name="add_array[]" class="add_me" value="<?= imageEncode($userData); ?>" /><? }else{ ?>
				<?php /*?><a href="javascript:;" onclick="removeFromLibrary('<?=  imageEncode($userData);?>')">Remove from Music Library</a><?php */?>In Library<? } } ?>
				</td>
              </tr>
              <tr>
                <td><span class="navy bold"><?= $d->plays ?> PLAYS</span>&nbsp;&nbsp;&nbsp;UPLOADED <?= date("m.j.Y",$d->date_created); ?> by <?= $user->username; ?></td>
              </tr>
            </table>
		  </td>
          <td style="padding:0px;"><? musicPlayer($d->id); ?><?php /*?><iframe src="player.php?data=<?= imageEncode($trackData); ?>&ft=true&i=<?=$user->id?>" style="padding:0px; height:41px; width:120px; border:0px;" frameborder="0"></iframe><?php */?></td>
        </tr>
        <tr>
          <td colspan="3" style="height:5px; font-size:5px;"></td>
        </tr>
        <?
						$i *= -1;
					}
				}else{
					?>
        <tr>
          <td><h3>You currently have no active tracks.</h3></td>
        </tr>
        <?
				}
			?>
      </table>