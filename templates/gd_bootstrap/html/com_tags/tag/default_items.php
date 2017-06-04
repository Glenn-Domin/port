<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');

$items = $this->items;
$n = count($this->items);
// echo "<pre>";
// print_r($this);
// echo "</pre>";
?>


	<?php if ($this->items == false || $n == 0) : ?>
		<p> <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>


		<?php foreach ($items as $i => $item) : ?>

    
    
    
<?php

// Get a db connection.
$db = JFactory::getDbo();
 
// Create a new query object.
$query = $db->getQuery(true);
 
// Select all records from the user profile table where key begins with "custom.".
// Order it by the ordering field.
$query->select($db->quoteName(array('urls', 'introtext')));
$query->from($db->quoteName('#__content'));
$query->where($db->quoteName('id') ." = ". $item->content_item_id);
 
// Reset the query using our newly populated query object.
$db->setQuery($query);
 
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

// echo "<pre>";
// print_r($results);
// echo "</pre>";

$urls  = json_decode($results[0]->urls);
$image = json_decode($item->core_images);
?>


<div class="items-row">
<div class="blog-inner <?php echo $urls->urlatext; ?>">

<div class="item-image"> 
<img data-src="<?php echo $image->image_intro; ?>" alt="<?php echo $image->image_intro_alt ?>" />
<p class="img_caption"><?php echo $image->image_intro_alt ?></p>
</div>

<div class="port-content">

<?php echo $results[0]->introtext; ?>

<a class="btn" href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>"><span class="icon-chevron-right"></span>Read more</a>


</div>

</div>
</div>
    
    
    

		<?php endforeach; ?>

	<?php endif; ?>





