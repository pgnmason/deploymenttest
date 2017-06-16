<?
global $authmetric;
global $pname;
global $document;

?>


<? if(strlen($this->error) > 0){ ?><p class="error"><?= $this->error; ?></p> <? }?>
<form method="post">
<table>
<tr><td>Login:</td><td><input type="text" name="<?= $authmetric; ?>" /></td></tr>
<tr><td>Password:</td><td><input type="password" name="<?= $pname; ?>" /></td></tr>
<tr><td><input type="submit" value="Login" /></td></tr>
</table>
<input type="hidden" name="task" value="signin" />
<input type="hidden" name="view_name" value="login" />
<? if(isset($document->get->redirect)){ ?><input type="hidden" name="redirect" value="<?= $document->get->redirect ?>" /><? } ?>
<? if(isset($document->get->admin)){ ?><input type="hidden" name="admin" value="<?= $document->get->admin ?>" /><? } ?>
</form>