<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note that there are certain parts of this layout used only when there is exactly one tag.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

?>
<div id="blog" class="blog">

  <?php echo $this->loadTemplate('items'); ?>

</div>