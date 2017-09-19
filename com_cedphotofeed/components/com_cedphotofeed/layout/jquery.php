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

require_once(dirname(__FILE__) . '/layout.php');

// http://workshop.rs/2010/04/coin-slider-image-slider-with-unique-effects/
class CedPhotofeedJqueryLayout implements CedPhotofeedLayout
{
    var $html = "";

    function __construct()
    {
    }

    /**
     * @param $imageList
     * @return string
     */
    public function render($imageList)
    {
        /*
        <script type="text/javascript" src="jquery-1.4.2.js"></script>
        <script type="text/javascript" src="coin-slider.min.js"></script>
        <link rel="stylesheet" href="coin-slider-styles.css" type="text/css" />

        $(document).ready(function() {
               $('#coin-slider').coinslider();
           });

        <div id='coin-slider'>


            <a href="img01_url" target="_blank">
                <img src='img01.jpg' >
                <span>
                    Description for img01
                </span>
            </a>
*/
    }

    /**
     * @param $numberOfColumns
     * @return mixed
     */
    public function setNumberOfColumns($numberOfColumns)
    {
        // TODO: Implement setNumberOfColumns() method.
    }

    public function addCss()
    {
    }

    public function reset()
    {
    }

}
