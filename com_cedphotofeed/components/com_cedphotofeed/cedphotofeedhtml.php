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

require_once(dirname(__FILE__) . '/helpers/helper.php');

require_once(dirname(__FILE__) . '/plugins/pluginsfactory.php');
require_once(dirname(__FILE__) . '/sorting/sortingfactory.php');
require_once(dirname(__FILE__) . '/rendering/renderingfactory.php');
require_once(dirname(__FILE__) . '/layout/layoutfactory.php');

require_once(JPATH_SITE . '/libraries/cedsimplepie/vendor/autoload.php');

jimport('joomla.filesystem.path');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class CedPhotoFeedHTML
{
    var $params = null;

    var $cacheLocation = null;

    var $rssCachingTime;

    var $sorting;

    var $layout;

    public function __construct($params)
    {
        $this->params = $params;

        $this->cacheLocation = JPATH_SITE."/cache/CedPhotoFeed";
        self::createDirectoryIfNotExist($this->cacheLocation);

        $this->rssCachingTime = $this->params->get('RssCachetime', 3600);

        $this->sorting = CedPhotofeedSortingFactory::getSorting($params->get('sorting', 'exif'));
        $this->layout = CedPhotofeedLayoutFactory::getInstance($this->params->get('contentlayout', 'Flow'));
    }

    public function parseRSSFeed($params, $feedUrl, $limit = 10, $startAtPhoto = 0)
    {
        //php translates that '&' to '&amp' ! and obviously the address does not remain the same
        $feedUrl = html_entity_decode($feedUrl);

        $plugin = CedPhotofeedPluginsFactory::getInstance($feedUrl);

        //Ask plugin to create url has it may have some specificities
        $feedUrl = $plugin->getFeedUrl($feedUrl, $startAtPhoto, $limit);
        //TODO move this in getFeedUrl
        $feedUrl = PhotoFeedHelper::clean_htmlentities($feedUrl);

        //Init SimplePie
        $feed = new SimplePie($feedUrl, $this->cacheLocation, $this->rssCachingTime);

        // set sorting before parsing feed
        // Reorder feed by date descending
        $feed->enable_order_by_date(false);

        //do the parsing
        $feed->handle_content_type();
        //$feedEntries = $SimplePie->get_item_quantity();

        $imageCount = ($startAtPhoto + $limit);
        if ($startAtPhoto == "") {
            $startAtPhoto = 0;
        }
        //get_items($startAtPhoto, $imageCount) cant be used
        $items = $feed->get_items($startAtPhoto, $imageCount);

        $this->sorting->sort($items);

        $model = array();
        $model['link'] = $feed->get_link();
        $model['title'] = $feed->get_title();
        $model['description'] = $feed->get_description();
        $model['items'] = array();

        foreach ($items as $item) {
            if ($enclosure = $item->get_enclosure()) {
                $model['items'][] = $plugin->getModelForItem($item, $params);
            }
        }

        $rendering = CedPhotofeedRenderingFactory::getInstance($this->params->get('rendering', 'Rokbox2'));
        $entries = $model['items'];
        foreach ($entries as $entry) {
            $rendering->addEntry($entry);
        }
        return $this->getHtmlOutput($model, $rendering->imageList);
    }

    private function getHtmlOutput($model, $imageList)
    {
        if (sizeof($imageList) == 0) {
            //No images found
            //TODO use css
            $defaultImage = $this->params->get('DefaultImage', 'media/com_cedphotofeed/notfound.jpg');
            return "<img src='" . $defaultImage . "' width='150px' height='150px' target='_blank' />";
        } else {
            $this->layout->setNumberOfColumns($this->params->get('NumberOfColumns', 2));
            $this->layout->addCss();

            //$categories = $SimplePie->get_categories();

            $html = array();

            $html[] = "<!-- Copyright (C) 2013-2017 galaxiis.com All rights reserved. --> <div class='cedphotofeed'>";

            if ($this->params->get('displayGalleryTitle', true)) {
                $html[] = " <div class='cedphotofeedTitle'><a href='" .$model['link'] . "' target='_blank'>" . $model['title'] . "</a></div>";
            }
            if ($this->params->get('displayGalleryDescription', true)) {
                $html[] = " <div class='cedphotofeedDescription'>" . $model['description'] . "</div>";
            }
            $html[] = "<div class='cedphotofeedBody'>".$this->layout->render($imageList)."</div><div class='cedphotofeedClear'/></div>";

            if ($this->params->get('displayLinkToGallery', true)) {
                $html[] = '<div class="cedphotofeedGallery"><a href="' . $model['link'] . '" target="_blank">Gallery</a></div>';
            }

            if ($this->params->get('branding', true)) {
                $html[] = '<div class="cedphotofeedGallery"><a href="https://www.galaxiis.com/cedphotofeed-showcase/" target="_blank">CedPhotoFeed</a></div>';
            }

            $html[] = "<div class='cedphotofeedClear'></div>";

            return implode("\n",$html);
        }
    }

    private function createDirectoryIfNotExist($thumbnailFileNamePath)
    {
        $directory = dirname($thumbnailFileNamePath);
        if (!JFolder::exists($directory)) {
            JFolder::create($directory);
        }
    }

}
