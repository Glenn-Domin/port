<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.


$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : 'class="' . $item->title . '" ';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

$linktype = $item->title;

switch ($item->browserNav)
{
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" <?php echo $title; ?>><span data-hover="<?php echo $linktype; ?>"><?php echo $linktype; ?></span></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><span data-hover="<?php echo $linktype; ?>"><?php echo $linktype; ?></span></a><?php
		break;
	case 2:
	// Use JavaScript "window.open"
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><span data-hover="<?php echo $linktype; ?>"><?php echo $linktype; ?></span></a>
<?php
		break;
}
