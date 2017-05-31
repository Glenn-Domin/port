<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

$urls  = json_decode($this->item->urls);
$image = json_decode($this->item->images);
?>

<div class="blog-inner <?php echo $urls->urlatext; ?>">

<div class="item-image"> 
<img data-src="<?php echo $image->image_intro; ?>" alt="<?php echo $image->image_intro_alt ?>" />
<p class="img_caption"><?php echo $image->image_intro_alt ?></p>
</div>

<div class="port-content">

<?php echo $this->item->introtext; ?>

<?php if (!empty($this->item->tags->itemTags)) {
  echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags);
} ?>

<?php
	$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
  echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link));
?>


</div>

</div>