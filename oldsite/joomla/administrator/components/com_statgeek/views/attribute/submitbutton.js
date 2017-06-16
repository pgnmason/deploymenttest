/**
 *	Attribute : Submit Button Override
 *	Filename : submitbutton.js
 *
 *	Author : Nate Mason
 *	Component : Stat Geek
 *
 *	Copyright : Copyright (C) 2013. All Rights Reserved
 *	License : GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
Joomla.submitbutton = function(task)
{
	if (task == '')
	{
		return false;
	}
	else
	{
		var isValid=true;
		var action = task.split('.');
		if (action[1] != 'cancel' && action[1] != 'close')
		{
			var forms = $$('form.form-validate');
			for (var i=0;i<forms.length;i++)
			{
				if (!document.formvalidator.isValid(forms[i]))
				{
					isValid = false;
					break;
				}
			}
		}
		if (isValid)
		{
			Joomla.submitform(task);
			return true;
		}
		else
		{
			alert(Joomla.JText._('attribute, some values are not acceptable.','Some values are unacceptable'));
			return false;
		}
	}
}









/*

jQuery(document).ready(function(e) {
    jQuery("#jform_field_type").change(function(){
		if(jQuery(this).val() == "sql"){
			jQuery(this).parent().after('<div id="ajax_form_holder"><label id="jform_field_data-lbl" for="jform_field_data" class="">Field Data</label><input name="jform[field_data]" id="jform_field_data" value="" class="inputbox field_data" size="40" type="text"></div>');
		}else{
			jQuery("#ajax_form_holder").remove();
		}
	});
});*/