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

DEFINE('PF_REGEX_G2', 'g2_itemId');
DEFINE('PF_REGEX_OTHER', '.com');
DEFINE('PF_REGEX_ISTOCKPHOTO', 'www.istockphoto.com');
DEFINE('PF_REGEX_PICASA', 'picasa');
DEFINE('PF_REGEX_SMUGMUG', 'smugmug.com');
DEFINE('PF_REGEX_FLICKR', 'flickr.com');
DEFINE('PF_REGEX_YOUTUBE', 'youtube.com');

class CedPhotofeedPluginsFactory
{

    public function __construct($config = array())
    {
    }

    /**
     * @param $feedUrl
     * @return mixed
     */
    public static function getInstance($feedUrl)
    {
        if (strpos($feedUrl, PF_REGEX_FLICKR)) {
            $class = "Flickr";
        } else if (strpos($feedUrl, PF_REGEX_SMUGMUG)) {
            $class = "Smugmug";
        } else if (strpos($feedUrl, PF_REGEX_PICASA)) {
            $class = "Picasa";
        } else if (strpos($feedUrl, PF_REGEX_ISTOCKPHOTO)) {
            $class = "IsStockPhoto";
        } else if (strpos($feedUrl, PF_REGEX_YOUTUBE)) {
            $class = "Youtube";
        } else if (strpos($feedUrl, PF_REGEX_G2)) {
            $class = "G2";
        } else {
            $class = "Generic"; //default
        }

        return CedPhotofeedPluginsFactory::pluginsFactory($class);
    }

    /**
     * @param $type
     * @return mixed
     * @throws Exception
     */
    private static function pluginsFactory($type)
    {
        $filename = dirname(__FILE__) . '/' . strtolower($type) . '.php';
        if (include_once($filename)) {
            $className = 'CedPhotoFeed' . $type . 'Plugins';
            return new $className;
        } else {
            throw new Exception('plugin '.$type.' not  found at '.$filename);
        }
    }

}
