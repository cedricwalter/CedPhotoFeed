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

class CedPhotofeedFlowLayout implements CedPhotofeedLayout
{
    var $html = "";

    /**
     * @param $imageList
     * @return string
     */
    public function render($imageList)
    {
        $this->reset();

        foreach ($imageList as $image) {
            $this->createHTMLForImage($image);
        }
        return $this->html;
    }

    private function createHTMLForImage($image)
    {
        $this->html .= '<div class="cedphotofeedImage">'.$image.'</div>';
    }

    /**
     * @param $numberOfColumns
     */
    public function setNumberOfColumns($numberOfColumns)
    {
       //do nothing no meaning here
    }

    public function addCss()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . '/media/com_cedphotofeed/css/flow.css');
    }

    public function reset()
    {
        $this->html = "";
    }


}
