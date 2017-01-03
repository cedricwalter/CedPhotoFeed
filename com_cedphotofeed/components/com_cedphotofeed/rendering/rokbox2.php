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
 * @date %%Date%%
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CedPhotofeedRokbox2Output
{
    var $imageList = array();

    var $uuid = null;

    function __construct($config = array())
    {
        $this->uuid = uniqid();
        $this->imageList = array();
    }

    public function reset()
    {
        $this->imageList = array();
    }

    /**
     * @param $entry
     */
    public function addEntry($entry)
    {
        $html = array();

        $html[] = "<a ";
        $html[] = "data-rokbox";
        $html[] = 'data-rokbox-album="' . $this->uuid . '"';
        $html[] = 'data-rokbox-caption="' . $entry['title'] . ' ' . $entry['description'] . '"';
        $html[] = 'href="' . $entry['imageUrl'] . '"';


        $html[] = 'data-rokbox-size="' . $entry['width'] . ' ' . $entry['height'] . '"';
        $html[] = '><img src="' . $entry['thumbnailUrl'] . '" /></a>';

        $this->imageList[] = implode(" ", $html);
    }


}