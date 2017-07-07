<? 
global $document,$ds;
?>

<p>Fill out the form below to request support.  A technician will contact you to resolve your problem.</p>

<form action="<?= Factory::siteUrl()."app".$ds."contact"?>" id="contact_form" method="post">
	<table>
		<tr><td><label id="name_label">Name:</label></td><td> <input type="text" name="Name" class="required text" id="contact_name" /></td></tr>
		<tr><td><label id="subject_label">Email Address:</label></td><td> <input type="text" name="Email" class="required email" id="contact_subject"/></td></tr>
		<tr><td><label id="subject_label">Issue:</label></td><td> <input type="text" name="Subject" class="required text" id="contact_subject"/></td></tr>
		<tr><td><label id="subject_label">Company:</label></td><td> <input type="text" name="Company" class="required text" id="contact_company"/></td></tr>
		<tr><td><label id="message_label">Details:</label></td></tr>
		<tr><td><textarea name="Message" class="required"></textarea></td></tr>
		<tr><td><input type="submit" value="Send" /></td></tr>
	</table>
	<input type="hidden" name="method" value="both" />
	<input type="hidden" name="task" value="sendIt" />
	<input type="hidden" name="view_name" value="contact" />
	<input type="hidden" name="recipient" value="support" />
</form>