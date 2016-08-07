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

class CedPhotoFeedRenderingFactory
{

    public function __construct($config = array())
    {
    }

    /**
     * @param $type
     * @return mixed
     * @throws Exception
     */
    public static function getInstance($type)
    {
        $filename = dirname(__FILE__) . '/' . strtolower($type) . '.php';
        if (include_once($filename)) {
            $className = 'CedPhotofeed' . $type . 'Output';
            return new $className;
        } else {
            throw new Exception('rendering '.$type.' not  found at '.$filename);
        }
    }

}
