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

class CedPhotofeedHtmlOutput
{
    var $imageList = array();

    public function addEntry($entry)
    {
        $title = $entry['title'];
        $description = $entry['description'];
        $width = $entry['width'];
        $height = $entry['height'];
        $thumbnailUrl = $entry['thumbnailUrl'];
        $imageUrl = $entry['imageUrl'];

        $this->imageList[] = "<a href=\"$imageUrl\" ><img src=\"$thumbnailUrl\" width=\"$width\" height=\"$height\" title=\"$title\" alt=\"$description\"/></a>";
    }

    public function reset()
    {
        $this->imageList = array();
    }

}