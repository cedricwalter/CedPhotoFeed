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

interface CedPhotofeedLayout
{
    /**
     * @param $imageList
     * @return string
     */
    public function render($imageList);

    /**
     * @param $numberOfColumns
     * @return mixed
     */
    public function setNumberOfColumns($numberOfColumns);

    public function addCss();

    public function reset();
}
