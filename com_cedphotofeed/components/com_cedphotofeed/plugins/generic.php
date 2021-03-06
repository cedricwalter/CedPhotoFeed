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

require_once(dirname(__FILE__) . '/plugins.php');

class CedPhotoFeedGenericPlugins extends PhotoFeedPlugins
{
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function getFeedUrl($feedUrl, $startAtPhoto, $limit)
    {
        return $feedUrl;
    }

    function getModelForItem($item, $params)
    {
        $model = array();

        $thumbnailUrl = "";
        foreach ($item->get_enclosures() as $enclosure) {
            $thumbnails = $enclosure->get_thumbnails();
            if (isset($thumbnails)) {
                $thumbnailUrl = $thumbnails[0];
            }
            if (isset($enclosure->link)) {
                $imageUrl = $enclosure->link;
            }
            if (isset($enclosure->width)) {
                $model['width'] = $enclosure->width;
            }
            if (isset($enclosure->height)) {
                $model['height'] = $enclosure->height;
            }
            if (isset($enclosure->title)) {
                $model['title'] = $enclosure->title;
            }
        }

        $media_content = $item->get_item_tags('http://search.yahoo.com/mrss/', 'content');
        if (isset($media_content)) {
            $attributes = $media_content[0]['attribs'][''];
            $imageUrl = $attributes['url'];
            $model['width'] = $attributes['width'];
            $model['height'] = $attributes['height'];
        }

        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));

        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

}
