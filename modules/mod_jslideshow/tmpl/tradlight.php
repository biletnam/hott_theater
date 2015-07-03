<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<script type="text/javascript" language="javascript">
jQuery(function() {
    // add a 'js' class to the body
    jQuery('body').addClass('js');
    
    // initialise the slideshow when the DOM is ready
    $slideshow.init('<?php echo $fx ?>', <?php echo $timeout ?>, <?php echo $slideSpeed ?>, <?php echo $tabSpeed ?>, '<?php echo $bg_yes ?>' );
});  
</script>
<!--[if IE 6]>
<script src="modules/mod_jslideshow/js/DD_belatedPNG.js"></script>
<script>
  DD_belatedPNG.fix('.slides-nav li');
  DD_belatedPNG.fix('.js #slideshow #cycle_prev');
  DD_belatedPNG.fix('.js #slideshow #cycle_next');
</script>
<![endif]--> 
<style>
<?php 
$width_minus_navigation = $width - 208;
echo '
#slideshow {
	width:'.$width.'px;
	height:'.$height.'px;
}';
echo '
#slideshow .slides {
	width:'.$width_minus_navigation.'px;
}';
echo '
#slideshow .slides li {
	width:'.$width_minus_navigation.'px;
}';
?>
</style>
<div id="slideshow">
	
    <div class="top"></div>
 
	<ul class="slides-nav">
    	 <?php 
            
            if($navigation_type=='numbers') {
                
                for ($i=0, $n=$number_items; $i < $n; $i++)	{
                    $item = &$slideShow[$i];
                    $t=$i+1
                    ?>
                     <li<?php if($i==0) {echo ' class="on"';}?>><a href="#slide-<?php echo $i; ?>"><?php echo $t; ?></a></li>
                    <?php
                }
            }else{
            
                for ($i=0, $n=$number_items; $i < $n; $i++)	{
                    $item = &$slideShow[$i];
                    $t=$i+1;
                    $class_slideshow = "number_$t";
                    ?>
                     <li<?php if($i==0) {echo ' class="on"';}?>><a href="#slide-<?php echo $item->title; ?>" class="<?php echo $class_slideshow; ?>"><?php echo $item->title; ?></a></li>
                     <?php
                }
                
            }
            ?>
    </ul>
    <?php
	$t= 0;
	$i=0;
	?>
    <div class="slides">
    	 <?php if($prev_next==1) :?> 
    		<div id="cycle_next">Next</div>
    	 <?php endif;?> 
        <ul>
			<?php 
			for ($i=0, $n=$number_items; $i < $n; $i++)	{
				$item = &$slideShow[$i];
					if($navigation_type=='numbers') {
						echo "<li id='slide-$i'>";
					 }else{
						echo "<li id='slide-$item->title'>";  
					 }
				
					if($type=='article') {
						echo "<h2>$item->title</h2>";
                   	 	echo $item->introtext;
						if($readmore) {
							$readmore_link = $item->link;  
							echo '<p><a href="'.$readmore_link.'" class="readon">'.JText::sprintf('Read more...').'</a></p>';
						}
					}else{
						echo '<img src="'.JURI::base().$params->get( 'path').$item.'" border="0">';
					}
                	
                echo "</li>";
			}
            ?>   
        </ul>
    </div>

    <div class="footer">
		<?php if($pause_resume==1 && 0) :?> 
            <div id="cycle_pause">Pause</div>
            <div id="cycle_resume">Resume</div>
        <?php endif;?> 
  	</div>
   
</div>


 <script src="<?php echo JURI::root(); ?>modules/mod_jslideshow/js/jquery.cycle.js" type="text/javascript"></script>
  <script src="<?php echo JURI::root(); ?>modules/mod_jslideshow/js/slideshow.js" type="text/javascript"></script>