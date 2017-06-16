<? 
global $ds, $document;
?>
<table>
	<tr>
		<td>
			<a href="<?= Factory::siteUrl()."backend".$ds."users".$ds."list".$ds."view"; ?>">View Users</a>
		</td>
		<? if(Authorization::checkAccess($document->session->auth_level,5)){ ?><td><a href="<?= Factory::siteUrl()."backend".$ds."support".$ds."list".$ds."view"; ?>">Support</a></td><? } ?>
		<? if(Authorization::checkAccess($document->session->auth_level,13)){ ?><td><a href="<?= Factory::siteUrl()."backend".$ds."permissions".$ds."list".$ds."view"; ?>">Group Permissions</a></td><? } ?>
	</tr>
</table>