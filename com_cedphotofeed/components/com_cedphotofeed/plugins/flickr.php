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

class CedPhotoFeedFlickrPlugins extends PhotoFeedPlugins
{
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function getFeedUrl($feedUrl, $startAtPhoto, $limit)
    {
        return $feedUrl;
    }

    public function getModelForItem($item, $params)
    {
        $model = array();

        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = $item->get_enclosure()->width;
        $model['height'] =  $item->get_enclosure()->height;
        $model['thumbnailUrl'] = $this->selectImage($item->get_enclosure()->link, $params->get('flickr-thumb-size', 2));
        $model['imageUrl'] = $this->selectImage($item->get_enclosure()->link, $params->get('flickr-img-size', 4));

        return $model;
    }

    private function selectImage($img, $size)
    {
        $img = explode('/', $img);
        $filename = array_pop($img);

        // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the
        //$size variable to selct one.
        // 0 for square, 1 for thumb, 2 for small, etc.
        $s = array(
            '_s.', // square  
            '_t.', // thumb
            '_m.', // small
            '.', // medium
            '_b.' // large
        );

        $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
        return implode('/', $img);
    }
}
