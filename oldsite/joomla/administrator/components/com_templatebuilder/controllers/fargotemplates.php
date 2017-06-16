<?php
/**
 * @version     1.0.0
 * @package     com_templatebuilder
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Nate Mason <nate@fargodesignco.com> - http://apps.fargodesignco.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Fargotemplates controller class.
 */
class TemplatebuilderControllerFargotemplates extends JControllerForm
{

    function __construct() {
        $this->view_list = 'fargotemplatess';
        parent::__construct();
    }

}