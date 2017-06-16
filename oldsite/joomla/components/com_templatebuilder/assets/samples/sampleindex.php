<?php
/**
 * @version		$Id: index.php 21140 2011-04-11 17:10:29Z dextercowley $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();

$templateDir = JPATH_THEMES.DS.JFactory::getApplication()->getTemplate().DS;

$style = $this->params->get( 'templateStyle' );
?>
						
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
		<script>
			jQuery.noConflict();
		</script>
        <script src="<?php echo JURI::base();?>/templates/<?php echo $this->template ?>/js/functions.js"></script>
        <script src="<?php echo JURI::base();?>/templates/<?php echo $this->template ?>/js/<?=$style?>.js"></script>
		<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
		<jdoc:include type="head" />
    	

		<!-- The following line loads the template CSS file located in the template folder. -->
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fonts.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layouts/<?=$style?>.css" type="text/css" />
<!--[if IE 9]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie9.css" type="text/css" />
<![endif]-->
</head>
	<body>
	
	
	<div id="container">
		<div id="header">
			<?php if($this->countModules('header_left')) : ?><jdoc:include type="modules" name="header_left" style="none" /><?php endif; ?>
			<?php if($this->countModules('header_right')) : ?><jdoc:include type="modules" name="header_right" style="none" /><?php endif; ?>
		
		</div>
		
		<div id="content">
			<?php 
				require($templateDir."layouts/".$style.".php");
			?>
		</div>
		
		<div id="footer">
			<?php if($this->countModules('footer_left')) : ?><jdoc:include type="modules" name="footer_left" style="none" /><?php endif; ?>
			<?php if($this->countModules('footer_right')) : ?><jdoc:include type="modules" name="footer_right" style="none" /><?php endif; ?>
		</div>
	
	</div>

	</body>
</html>