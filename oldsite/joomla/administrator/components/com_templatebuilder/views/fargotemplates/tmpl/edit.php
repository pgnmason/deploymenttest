<?php
/**
 * @version     1.0.0
 * @package     com_templatebuilder
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Nate Mason <nate@fargodesignco.com> - http://apps.fargodesignco.com
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_templatebuilder/assets/css/templatebuilder.css');
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
        XXX_FILE_VALIDATE_STATEMENT_XXX
		if (task == 'fargotemplates.cancel' || document.formvalidator.isValid(document.id('fargotemplates-form'))) {
			Joomla.submitform(task, document.getElementById('fargotemplates-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

