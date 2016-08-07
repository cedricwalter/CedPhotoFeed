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

require_once(JPATH_SITE . '/components/com_cedphotofeed/cedphotofeedhtml.php');

$url = $params->get('uri', '//cedricwalter.smugmug.com/hack/feed.mg?Type=gallery&Data=4311718_bRCBj&format=rss200');
$limit = intval($params->get('limit', 10));
$from = intval($params->get('from', 0));

$PhotoFeedHTML = new CedPhotoFeedHTML($params);
$module_content = $PhotoFeedHTML->parseRSSFeed($params, $url, $limit, $from);

JPluginHelper::importPlugin('content');
$module_content = JHtml::_('content.prepare', $module_content, '', 'mod_cedphotofeed.content');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_cedphotofeed', $params->get('layout', 'default'));
