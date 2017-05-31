<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

?>
<?php if (!empty($displayData)) : ?>
<div class="tags">

<?php
// echo "<pre>";
// print_r($displayData);
// echo "</pre>";
$tagclass = "";
$tagfont = "";
?>

<?php foreach ($displayData as $i => $tag) : ?>

<?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
<?php $tagParams = new Registry($tag->params); ?>
<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>" class="<?php echo $link_class; ?>">

<?php
switch($tag->title) {
  case("Joomla"):
    $tagclass = "joomla";
    $tagfont = '<em class="fa fa-joomla"></em>';
    break;
  case("Wordpress"):
    $tagclass = "wordpress";
    $tagfont = '<em class="fa fa-wordpress"></em>';
    break;
  case("Drupal"):
    $tagclass = "drupal";
    $tagfont = '<em class="fa fa-drupal"></em>';
    break;
  case("Complete-Build"):
    $tagclass = "complete";
    $tagfont = '<em class="fa fa-star"></em>';
    break;
  case("Partial-Build"):
    $tagclass = "partial";
    $tagfont = '<em class="fa fa-star-half-o"></em>';
    break;
}
?>

<figure class="chart <?php echo $tagclass; ?>" data-percent="100">
  <figcaption><?php echo $tag->title; ?></figcaption>
  <?php echo $tagfont; ?>
  <svg width="200" height="200">
    <circle class="outer" cx="95" cy="95" r="85" transform="rotate(-90, 95, 95)"></circle>
  </svg>
</figure>
</a>
<?php endif; ?>
<?php endforeach; ?>

</div>

<?php endif; ?>
