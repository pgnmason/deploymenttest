<? 
global $ds, $document;
?>
<div class="content">
	<table>
		<tr>
			<td><a href="<?= Factory::siteUrl()."backend".$ds."users".$ds."list".$ds."view"; ?>">View Users</a></td>
			<? if(Authorization::checkAccess($document->session->auth_level,5)){ ?><td><a href="<?= Factory::siteUrl()."backend".$ds."users".$ds."list".$ds."view"; ?>">Change Permissions</a></td><? } ?>
			<td></td>
		</tr>
	</table>
</div>