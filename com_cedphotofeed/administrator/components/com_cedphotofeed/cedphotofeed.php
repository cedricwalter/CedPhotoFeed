<?php
/**
 * @package     CedPhotoFeed
 * @subpackage  com_cedphotofeed
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/liveupdate/liveupdate.php';
if( JFactory::getApplication()->input->get('view','') == 'liveupdate') {
    JToolBarHelper::preferences( 'com_cedphotofeed' );
    LiveUpdate::handleRequest();
    return;
}

// Include dependencies
jimport('joomla.application.component.controller');
require_once (dirname(__FILE__) . '/controller.php');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root() . '/media/com_cedphotofeed/css/admin.css');

$task = JFactory::getApplication()->input->get('task');

$controller = JControllerLegacy::getInstance('cedphotofeed');
$controller->execute($task);
$controller->redirect();
