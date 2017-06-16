<?php
/**
 * @version     1.0.0
 * @package     com_templatebuilder
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Nate Mason <nate@fargodesignco.com> - http://apps.fargodesignco.com
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Fargotemplatess list controller class.
 */
class TemplatebuilderControllerFargotemplatess extends TemplatebuilderController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Fargotemplatess', $prefix = 'TemplatebuilderModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}