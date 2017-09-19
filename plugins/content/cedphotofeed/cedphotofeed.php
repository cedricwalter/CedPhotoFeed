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

jimport('joomla.plugin.plugin');

require_once(JPATH_SITE . '/components/com_cedphotofeed/cedphotofeedhtml.php');
require_once(dirname(__FILE__) . '/cedphotofeedparser.php');

class plgContentCedPhotoFEED extends JPlugin
{
    var $parser = null;
    var $photoFeedHtml;

    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
        $this->photoFeedHtml = new CedPhotoFeedHTML($this->params);
    }

    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        //Do not run in admin area and non HTML  (rss, json, error)
        $app = JFactory::getApplication();
        if ($app->isClient('administrator') || JFactory::getDocument()->getType() !== 'html')
        {
            return;
        }

        //simple performance check to determine whether bot should process further
        if (!plgContentPhotoFEEDParser::active($row->text)) {
            return;
        }

        $row->text = $this->replaceText($row->text);

        return;
    }

    /**
     * @param $text
     * @return mixed
     */
    private function replaceText($text)
    {
        $isSSLConnection = false; //JFactory::getApplication()->isSSLConnection();
        $models = plgContentPhotoFEEDParser::parse($text, $isSSLConnection);
        if ($models) {
            foreach ($models as $model) {
                $text = str_replace($model->match, $this->photoFeedHtml->parseRSSFeed($this->params, $model->url, $model->limit, $model->from), $text);
            }
        }

        return $text;
    }

}
