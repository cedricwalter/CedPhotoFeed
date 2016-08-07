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

require_once JPATH_SITE . '/components/com_cedphotofeed/helpers/helper.php';

// Load the javascript
JHtml::_('behavior.framework');
JHtml::_('behavior.modal', 'a.modal');
?>

<div class="cedphotofeedpanel">
    <div style="float: left;">
        <div class="icon">
            <a href="index.php?option=com_cedphotofeed&view=liveupdate"
               title="<?php echo JText::_('Live Update');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedphotofeed/images/update_48x48.png"
                    alt="<?php echo JText::_('Live Update');?>"/>
                <span><?php echo JText::_('Live Update');?></span></a></div>
    </div>
    <div style="float: left;">
        <div class="icon"><a href="https://www.galaxiis.com" target="_blank"
                             title="<?php echo JText::_('HOME PAGE'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/frontpage.png"/>
                <span><?php echo JText::_('HOME PAGE'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="https://www.galaxiis.com/cedphotofeed-doc/"
                target="_blank"
                title="<?php echo JText::_('MANUAL'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/manual.png"/>
                <span><?php echo JText::_('MANUAL'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="https://www.galaxiis.com/forums/"
                target="_blank"
                title="<?php echo JText::_('FORUM'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/forum.png"/>
                <span><?php echo JText::_('FORUM'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="http://confluence.galaxiis.com/display/GAL/SOFTWARE+LICENSE+AGREEMENT"
                target="_blank"
                title="<?php echo JText::_('LICENSE'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/license.png"/>
                <span><?php echo JText::_('LICENSE'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="skype:cedric.walter?call"
               title="<?php echo JText::_('SKYPE ME'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/skype.png"/>
                <span><?php echo JText::_('SKYPE ME'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/social-web/social-media/photo-channels/8941"
               target="_blank"
               title="<?php echo JText::_('JED VOTE'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/jed.png"/>
                <span><?php echo JText::_('JED VOTE'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/owner/cedric_walter"
               target="_blank"
               title="<?php echo JText::_('Other Extensions By the Same Author'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/jed.png"/>
                <span><?php echo JText::_('OTHER EXTENSIONS'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://www.galaxiis.com/cedphotofeed-download/"
               target="_blank"
               title="<?php echo JText::_('Download Latest Version'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/download.png"/>
                <span><?php echo JText::_('Download Latest Version'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://www.facebook.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Like on Facebook'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/facebook.png"/>
                <span><?php echo JText::_('Like on Facebook'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://twitter.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Twitter'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/twitter.png"/>
                <span><?php echo JText::_('Follow Me on Twitter'); ?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://plus.google.com/u/0/104558366166000378462"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Google+'); ?>"> <img
                    src="<?php  echo JURI::root() ?>/media/com_cedphotofeed/images/google.png"/>
                <span><?php echo JText::_('Follow Me on Google+'); ?></span></a>
        </div>
    </div>
</div>

<div class="tagversion">
    <h1><img src="<?php echo JURI::root() ?>media/com_cedphotofeed/images/rss.gif"/> CedPhotoFeed 1.2.0</h1>

    <p>
        <a href="http://www.galaxiis.com">Copyright (C) 2013-2016 galaxiis.com All rights reserved.</a>
    </p>
</div>