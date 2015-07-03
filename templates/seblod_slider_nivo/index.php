<?php
/**
* @version 			SEBLOD 2.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2012 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

// No Direct Access
defined( '_JEXEC' ) or die;

// -- Initialize
require_once dirname(__FILE__).DS.'config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$doc->addStyleSheet(juri::base(TRUE)."/templates/seblod_slider_nivo/css/default.css");
$doc->addStyleSheet(juri::base(TRUE)."/templates/seblod_slider_nivo/css/nivo-slider.css");
$doc->addScript(juri::base(TRUE)."/templates/seblod_slider_nivo/js/jquery-1.7.1.min.js");
$doc->addScript(juri::base(TRUE)."/templates/seblod_slider_nivo/js/jquery.nivo.slider.pack.js");

// -- Render
?>

	<div class="slider-wrapper theme-default">
      <div class="ribbon"></div>
      <div id="slider" class="nivoSlider">
			<?php
			
			$items = $cck->getItems();
			
			$captionCount = 1;
			foreach( $items as $item ) {
				$img = $item->getThumb1('art_image_fulltext');
				$imgAlt = $item->getValue('art_title');
				$captionId = "#caption" . $captionCount;
				echo '<img src="' . $img . '" alt="' .$imgAlt. '" title="' .$captionId. '"/>';
				$captionCount ++;
			}
			?>
			
		</div>
			<?php
			$captionCount = 1;
			foreach( $items as $item) {
			$captionId = "caption" . $captionCount;
			$artLink = $item->get('art_title')->link;
			
			?>
				<div id="<?php echo $captionId ?>" class="nivo-html-caption">
               <a href="<?php echo $artLink; ?>"><strong> <?php echo $item->getValue('art_title'); ?> </strong></a>
					<p class="theme-default"> <?php echo strip_tags( substr($item->getValue('art_introtext'),0,100)); echo "..." ?>
               <a href="<?php echo $artLink; ?>">Readmore</a> </p>
            </div>
         <?php
         $captionCount ++;
			}
			?>
	</div>
		<script type="text/javascript" >
		    jQuery(window).load(function($) {
        $('#slider').nivoSlider();
    }); 
    </script>


<?php
// -- Finalize
$cck->finalize();
?>