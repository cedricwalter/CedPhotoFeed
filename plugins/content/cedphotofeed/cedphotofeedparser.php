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

class plgContentPhotoFEEDParser
{
    const PATTERN = "/{rss\s+(.*?)}/i";
    const START = '{rss';

    public static function active($text) {
        if (strpos($text, self::START) === false) {
            return false;
        }

        return true;
    }

    public static function parse($text, $isSSLConnection)
    {
        $models = array();

        preg_match_all(self::PATTERN, $text, $matches, PREG_SET_ORDER);

        // plugin only processes if there are any instances of the plugin in the text
        if ($matches) {
            foreach ($matches as $match) {
                $inline_params = $match[1];
                $result = array();
                $pairs = explode(' ', trim($inline_params));
                foreach ($pairs as $pair) {
                    $pos = strpos($pair, "=");
                    $key = substr($pair, 0, $pos);
                    $value = substr($pair, $pos + 1);
                    $result[$key] = $value;
                }

                $url = null;
                if (isset($result['uri'])) {
                    $url = trim($result['uri']);
                }
                $limit = null;
                if (isset($result['limit'])) {
                    //has to be an integer
                    $limit = intval(trim($result['limit']));
                }
                $from = null;
                if (isset($result['from'])) {
                    //has to be an integer
                    $from = intval(trim($result['from']));
                }

                $protocol = $isSSLConnection ? "https" : "http";
                if (self::startsWith($url, "http") && $protocol == "https") {
                    $url = str_replace("http", "https", $url);
                }

                $model = new stdClass();
                $model->url = $url;
                $model->limit = $limit;
                $model->from = $from;
                $model->match = $match[0];

                $models[] = $model;
            }
        }

        return $models;
    }

    private static function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }
}
