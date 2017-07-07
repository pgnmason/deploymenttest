<? 
global $document,$ds;
?>

<p>Fill out the contact form below to drop us a line.  All fields are required</p>

<form action="<?= $document->uriBase.$ds.Factory::homeDirectory().$ds."app".$ds."contact"?>" id="contact_form" method="post">
	<table>
		<tr><td><label id="name_label">Name:</label></td><td> <input type="text" name="Name" class="required text" id="contact_name" /></td></tr>
		<tr><td><label id="subject_label">Subject:</label></td><td> <input type="text" name="Subject" class="required text" id="contact_subject"/></td></tr>
		<tr><td><label id="subject_label">Email Address:</label></td><td> <input type="text" name="Email" class="required email" id="contact_subject"/></td></tr>
		<tr><td><label id="message_label">Message:</label></td></tr>
		<tr><td><textarea name="Message" class="required"></textarea></td></tr>
		<tr><td><input type="submit" value="Send" /></td></tr>
	</table>
	<input type="hidden" name="method" value="email" />
	<input type="hidden" name="task" value="sendIt" />
	<input type="hidden" name="view_name" value="contact" />
	<input type="hidden" name="recipient" value="contact" />
</form>