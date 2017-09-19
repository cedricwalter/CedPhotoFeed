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
 * build-date %%DATE%%
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__) . '/plugins.php');


class CedPhotoFeedYouTubePlugins extends PhotoFeedPlugins
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
        $thumbnailUrl = "";
        foreach ($item->get_enclosures() as $enclosure) {
            $thumbnails = $enclosure->get_thumbnails();
            if ($thumbnails != null) {
                $thumbnailUrl = $thumbnails[0];
            }
        }

        $media_group = $item->get_item_tags('http://search.yahoo.com/mrss/', 'group');
        $media_content = $media_group[0]['child']['http://search.yahoo.com/mrss/']['content'];
        $attributes = $media_content[0]['attribs'][''];
        $imageUrl = $attributes['url'];

        $model = array();
        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = $item->get_enclosure()->width;
        $model['height'] =  $item->get_enclosure()->height;
        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

    //YouTube specific
    function getImageFromDescription($description)
    {
        $content = strip_tags($description, '<img>');
        preg_match('/<img([^>]*)src="([^"]*)\.youtube\.com([^"]*)"([^>]*)>/i', $content, $m);
        $image = $m[2] . '.youtube.com' . $m[3];
        return $image;
    }

}