<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
?>
<div class="portfolio-content">
  <div class="portfolio-left">
	
	<h1> <?php echo $this->escape($this->item->title); ?> </h1>

	<?php if (!empty($this->item->tags->itemTags)) :
		$this->item->tagLayout = new JLayoutFile('joomla.content.tags');
    echo $this->item->tagLayout->render($this->item->tags->itemTags);
	endif; ?>
  
  </div>
  
  <div class="portfolio-right">

	<?php echo $this->item->fulltext; ?>
  
  </div>


</div>

