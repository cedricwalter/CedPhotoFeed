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

require_once(dirname(__FILE__) . '/layout.php');

class CedPhotofeedGridLayout implements CedPhotofeedLayout
{
    var $html = array();
    var $numberOfColumns = 3;
    var $columnsCounter = 0;

    function __construct($config = array())
    {
    }

    public function render($imageList)
    {
        $this->reset();

        foreach ($imageList as $image) {
            $this->createHTMLForImage($image);
        }

        return implode("\n", $this->html);
    }

    public function setNumberOfColumns($numberOfColumns)
    {
        $this->numberOfColumns = $numberOfColumns;
    }

    private function createHTMLForImage($image)
    {
        if ($this->columnsCounter == 0) {
            if (strlen($this->html) != 0) {
                $this->html[] = "</div>";
                $this->html[] = "<div class='cedphotofeedClear'/>";
                $this->html[] = "<div class='cedphotofeedLine'>";
            } else {
                $this->html[] = "<div class='cedphotofeedLine'>";
            }
        }
        $this->html[] = "<div class='cedphotofeed'>" . $image . "</div>";
        $this->columnsCounter++;

        if ($this->columnsCounter == $this->numberOfColumns) {
            $this->columnsCounter = 0;
        }
    }

    public function addCss()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . '/media/com_cedphotofeed/css/grid.css');
    }

    public function reset()
    {
        $this->html = array();
    }

}