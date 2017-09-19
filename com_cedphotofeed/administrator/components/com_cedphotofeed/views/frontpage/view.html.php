<?php
/**
 * @package     CedPhotoFeed
 * @subpackage  com_cedphotofeed
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

require_once(JPATH_SITE . '/components/com_cedphotofeed/helpers/helper.php');

class cedPhotofeedViewFrontpage extends JViewLegacy
{
    function display($tpl = null)
    {
        $this->defaultTpl($tpl);
    }

    function defaultTpl($tpl = null)
    {
        JToolBarHelper::title(JText::_('CedPhotofeed') . " 3.0.1",
            JURI::root() . '/media/com_cedphotofeed/images/rss.gif');

        $user = JFactory::getUser();
        if ($user->authorise('core.admin', 'com_cedphotofeed')) {
            JToolbarHelper::preferences('com_cedphotofeed');
        }

        parent::display($tpl);
    }
}
