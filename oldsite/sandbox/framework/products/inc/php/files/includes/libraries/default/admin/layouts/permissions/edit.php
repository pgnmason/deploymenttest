<?
$model = $this->model;
$edit = $model->loadPerm($_POST['edit']);
?>

<form method="post" action="backend/permissions">
	<table class="admin_table">
		<tr>
			<td>
				Permission Name
			</td>
			<td>
				<select name="aco_id">
				<?				
					$arr = $model->loadPerms();
					foreach($arr as $perm){
				?>
					<option value="<?= $perm->id ?>" <? if($perm->id == $edit->aco_id){?> selected<? } ?>><?=$perm->name?></option>
				<? }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				User Group
			</td>
			<td>
				<select name="aro_id">
				<?				
					$arr = $model->loadGroups();
					foreach($arr as $group){
				?>
					<option value="<?= $group->id ?>" <? if($group->id == $edit->aro_id){?> selected<? } ?>><?=$group->name?></option>
				<? }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Allow Access <input type="radio" value="1" <? if(1 == $edit->state){?> checked<? } ?> name="state">
			</td>
			<td>
				Deny Access <input type="radio" value="-1"<? if(-1 == $edit->state){?> checked<? } ?> name="state">
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Save">
			</td>
		</tr>
	</table>
	<input type="hidden" name="task" id="task" value="edit">
	<input type="hidden" name="layout" id="layout" value="list">
	<input type="hidden" name="view_name" id="view_name" value="permissions">
	<input type="hidden" name="ajax" value="true">
	<input type="hidden" name="id" value="<?= $edit->id ?>"
</form>
