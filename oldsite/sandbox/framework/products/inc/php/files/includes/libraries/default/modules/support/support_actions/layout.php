<div id="support_actions" class="admin-module">
<h3>Available Actions</h3>
<form method="post" action="backend/support">
<h4>Resolve Ticket</h4>
<input type="submit" onClick="if(!confirm('By clicking this you are agreeing that the issue has been resolved. Continue?')){ return false; }" value="Go" />
<input type="hidden" name="id" value="<?= $this->data->id; ?>" />
<input type="hidden" name="task" id="task" value="resolve">
<input type="hidden" name="layout" id="layout" value="default">
<input type="hidden" name="view_name" id="view_name" value="support">
<input type="hidden" name="edit_user" id="edit_user" value="<?= Factory::getDocument()->session->auth_id; ?>">
<input type="hidden" name="edit_date" id="edit_date" value="<?= time(); ?>">
</form>

<form method="post" action="backend/support">
<h4>Document Ticket</h4>
<textarea name="documentation" id="documentation" class="rte-zone"></textarea>
<input type="submit" value="Save" id="saveButton" />
<input type="hidden" name="id" value="<?= $this->data->id; ?>" />
<input type="hidden" name="task" id="task" value="document">
<input type="hidden" name="layout" id="layout" value="default">
<input type="hidden" name="view_name" id="view_name" value="support">
<input type="hidden" name="edit_user" id="edit_user" value="<?= Factory::getDocument()->session->auth_id; ?>">
<input type="hidden" name="edit_date" id="edit_date" value="<?= time(); ?>" />
</form>



<? //pretty_print_r($this->data); ?>
</div>