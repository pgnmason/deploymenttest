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
        
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('template-form'))) {
			Joomla.submitform(task, document.getElementById('template-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_templatebuilder&layout=edit&id='.(int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="template-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_TEMPLATEBUILDER_LEGEND_TEMPLATE'); ?></legend>
			<ul class="adminformlist">
                
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>
				<li><?php echo $this->form->getLabel('created_by'); ?>
				<?php echo $this->form->getInput('created_by'); ?></li>
				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>
				<li><?php echo $this->form->getLabel('positions'); ?>
				<?php echo $this->form->getInput('positions'); ?></li>
				<li><?php echo $this->form->getLabel('layouts'); ?>
				<?php echo $this->form->getInput('layouts'); ?></li>
				<input type="hidden" name="jform[created]" value="<?php echo $this->item->created; ?>" />
				<input type="hidden" name="jform[version]" value="<?php echo $this->item->version; ?>" />


            </ul>
		</fieldset>
	</div>
    
    

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>