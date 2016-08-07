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

jimport('joomla.application.component.view');

class cedPhotofeedViewArticle extends JViewLegacy
{
    protected $form;
    protected $item;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        // TODO: This is really dogy - should change this one day.
        $eName = JFactory::getApplication()->input->get('e_name', null, 'string');
        $eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $eName);
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));
        $this->assignRef('eName', $eName);
        parent::display($tpl);
        return;
    }

}
