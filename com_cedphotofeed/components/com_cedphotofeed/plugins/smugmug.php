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

require_once(dirname(__FILE__) . '/plugins.php');


class CedPhotoFeedSmugmugPlugins extends PhotoFeedPlugins
{
    function CedPhotoFeedSmugmugPlugins($config = array())
    {
        parent::__construct($config);
    }

    //Handle library with more than 100 entries
    public function getFeedUrl($feedUrl, $startAtPhoto, $limit)
    {
        $imageCount = ($startAtPhoto + $limit);

        if ($startAtPhoto > 100) {
            $feedUrl .= '&ImageCount=' . $imageCount;
        }
        if ($imageCount > 100) {
            $feedUrl .= '&Paging=0';
        }

        return $feedUrl;
    }


    function getModelForItem($item, $params)
    {
        $size = $params->get('smugmugSize');
        $thumbSize = $params->get('smugmugThumbSize');

        //$permalink = $item->get_permalink();
        //$link = $item->get_link();
        //$img = $this->getImageFromDescription($item->get_description());

        $imageUrl = '';
        $thumbnailUrl = '';
        $width = '';
        $height = '';
        foreach ($item->get_enclosures() as $enclosure) {
            $mediaContentUrl = $enclosure->get_link();

            if ($thumbSize == 'Th' && strpos($mediaContentUrl, '-Th')) {
                $thumbnailUrl = $mediaContentUrl;
            } else if ($thumbSize == 'Ti' && strpos($mediaContentUrl, '-Ti')) {
                $thumbnailUrl = $mediaContentUrl;
            } else if ($size == 'S' && strpos($mediaContentUrl, '-S')) {
                $width = 400;
                $height = 300;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'M' && strpos($mediaContentUrl, '-M')) {
                $width = 600;
                $height = 450;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'L' && strpos($mediaContentUrl, '-L')) {
                $width = 800;
                $height = 600;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'XL' && strpos($mediaContentUrl, '-XL')) {
                $width = 1024;
                $height = 768;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'X2' && strpos($mediaContentUrl, '-X2')) {
                $width = 1280;
                $height = 960;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'X3' && strpos($mediaContentUrl, '-X3')) {
                $width = 1600;
                $height = 1200;
                $imageUrl = $mediaContentUrl;
            } else if ($size == 'O' && strpos($mediaContentUrl, '-O')) {
                $width = '';
                $height = '';
                $imageUrl = $mediaContentUrl;
            }
        }

        $model = array();
        $model['title'] = htmlspecialchars(strip_tags($item->get_title()));
        $model['description'] = htmlspecialchars(strip_tags($item->get_description()));
        $model['width'] = $width;
        $model['height'] = $height;
        $model['thumbnailUrl'] = $thumbnailUrl;
        $model['imageUrl'] = $imageUrl;

        return $model;
    }

}