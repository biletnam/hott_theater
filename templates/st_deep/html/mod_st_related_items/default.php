<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_related_items
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<ul class="relateditems clearafter <?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $key=>$item) :	?>
<?php if($key == 3) { break; } ?>
<li class="row-fluid">
	<div class="span4 image">
		<?php
            if ($item->images != '') { 
            $images = json_decode($item->images);
        ?>
        <a href="<?php echo $item->route; ?>"><img class="img-intro" src="<?php echo $baseurl.$images->image_intro; ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/></a>
        <?php } ?>
    </div>
    <div class="text span8">
        <div class="title">
            <a href="<?php echo $item->route; ?>">
			<?php if ($showDate) echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC4')). " - "; ?>
            <?php echo $item->title; ?></a>
        </div>
        <div class="desc"><?php echo $item->introtext; ?></div>		
    </div>
</li>
<?php endforeach; ?>
</ul>
