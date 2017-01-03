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

class PhotoFeedPlugins extends JObject
{
    var $doc = null;

    function __construct($config = array())
    {
        parent::__construct($config);
        $this->doc = new DOMDocument();
    }

    function getLibraryLink($data)
    {
        preg_match_all('/ href="([^"]*)"([^>]*)>/i', $data, $matches);
        return $matches[1][1];
    }

    function getImageFromDescription($data)
    {
        $this->doc->loadHTML($data);
        $xml = simplexml_import_dom($this->doc); // just to make xpath more simple
        $images = $xml->xpath('//img');
        foreach ($images as $img) {
            //only support one image in description of rss feed
            return $img;
        }

        return "";
    }





    //do not work in all case
//	function getImageFromDescription($data) {
//		preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
//		return $matches[1][0];
//	}


}