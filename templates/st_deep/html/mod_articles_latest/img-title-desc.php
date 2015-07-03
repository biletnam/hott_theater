<?php
/**
 * @version		$Id: coolfeed.php 100 2012-04-14 17:42:51Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 * @package		Avatar Dream Framework Template
 * @facebook 	http://www.facebook.com/pages/JoomAvatar/120705031368683
 * @twitter	    https://twitter.com/#!/JoomAvatar
 * @support 	http://joomavatar.com/forum/
 */

// No direct access
defined('_JEXEC') or die;
$baseurl = JURI::base();
?>
<ul class="latestnews clearafter <?php echo $moduleclass_sfx; ?>">
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
