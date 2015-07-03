<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_popular
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="mostread latestnews <?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) :  ?>
	<?php 
		$time = strtotime($item->created);
		$day = date("d", $time);
		$month = date("M", $time);
		$year = date("Y", $time);
	?>
	<li class="row-fluid">
    	<div class="span4">    	
		<?php 
			if ($item->images != '') { 
			$images = json_decode($item->images);
		?>
		<a href="<?php echo $item->link; ?>"><img class="img-intro" src="<?php echo $baseurl.$images->image_intro; ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/></a>
		<?php } ?>
        </div>
		<div class="text span8">
			<div class="title">
				<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			</div>
            <div class="date">
            	<span class="month"><?php echo $month; ?></span>
                <span class="day"><?php echo $day; ?></span> ,              
                <span class="year"><?php echo $year; ?></span>
            </div>
			<div class="desc"><?php echo $item->introtext; ?></div>		
		</div>
	</li>
<?php endforeach; ?>
</ul>
