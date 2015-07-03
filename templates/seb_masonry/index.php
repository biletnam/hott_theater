<?php
/**
* @version 			SEBLOD 3.x More ~ $Id: index.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// -- Initialize
require_once dirname(__FILE__).'/config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

// -- Prepare
$attributes		=	$cck->item_attributes ? ' '.$cck->item_attributes : '';
$class			=	'masonry';
$display_mode	=	(int)$cck->getStyleParam( 'masonry_display', '0' );
$grid_id		=	$cck->id; //todo
$html			=	'';
$items			=	$cck->getItems();
$fieldnames		=	$cck->getFields( 'element', '', false );
$multiple		=	( count( $fieldnames ) > 1 ) ? true : false;
$count			=	count( $items );
$gutter			=	$cck->getStyleParam( 'masonry_gutter', 0 );
$params			=	array(
						'itemSelector'=>'.item',
						'isAnimated'=>true,
						'isFitWidth'=>true
					);
if ( $gutter ) {
	$params['gutter']	=	(int)$gutter;
}
$event			=	$cck->getStyleParam( 'loading_event', 'ready' );
$event_more		=	false;
if ( $event == 'ready_imagesloaded' ) {
	$event		=	'ready';
	$event_more	=	true;
}
$height			=	$cck->getStyleParam( 'masonry_height', '' );
$height			=	( $height ) ? 'height:'.$height.';' : '';
$margin			=	$cck->getStyleParam( 'masonry_margin', '' );
if ( $margin == '-1' ) {
	$margin		=	$cck->getStyleParam( 'masonry_margin_custom', '' );
} else {
	$margin		.=	'px';
}
$margin			=	( $margin ) ? 'margin:'.$margin.';' : '';
$width			=	$cck->getStyleParam( 'masonry_width', '' );
$width			=	( $width ) ? 'width:'.$width.';' : '';

// Set
$isMore			=	$cck->isLoadingMore();
if ( $cck->isGoingToLoadMore() ) {
	$class		.=	' cck-loading-more';
}
if ( $isMore ) {
	$js_params		=	json_encode( $params );
	$js				=	'$("#'.$grid_id.' .masonry").masonry('.$js_params.');';
	if ( $event_more ) {
		$js			.=	'$("#'.$grid_id.' .masonry").imagesLoaded( function(){ '.$js.' });';
	}
	$js				=	'$("#'.$grid_id.' .masonry").masonry( "destroy" );'.$js;
	$js				=	'(function($){ $(document).ready(function(){'.$js.'}); })(jQuery);';
} else {
	$js_params		=	json_encode( $params );
	$js	 			=	'$("#'.$grid_id.' .masonry").masonry('.$js_params.');';
	if ( $event_more ) {
		$js	 		=	'$("#'.$grid_id.' .masonry").imagesLoaded( function(){ '.$js.' });';
	}
	$cck->addStyleDeclaration( '#'.$grid_id.' .masonry{margin:0 auto;}' );
	$cck->addStyleDeclaration( '#'.$grid_id.' .masonry .item{float:left;'.$margin.$width.$height.'}' );
	if ( $event_more ) {
		$cck->addScript( $cck->base.'/templates/'.$cck->template.'/js/imagesloaded.pkgd.min.js' );
	}
	$cck->addScript( $cck->base.'/templates/'.$cck->template.'/js/masonry.pkgd.min.js' );
	$cck->addScriptDeclaration( $js, $event );
}

// -- Render
if ( !$isMore ) {
?>
<div id="<?php echo $grid_id; ?>"<?php echo ( $cck->id_class ) ? ' class="'.trim( $cck->id_class ).'"' : ''; ?>>
	<div class="<?php echo $class; ?>">
	<?php }
		if ( $count ) {
			if ( $display_mode == 2 ) {
				foreach ( $items as $item ) {
					$row	=	$item->renderPosition( 'element' );
					if ( $row ) {
						$html	.=	'<div class="item"'.$item->replaceLive( $attributes ).'>'.$row.'</div>';
					}
				}
			} elseif ( $display_mode == 1 ) {
				foreach ( $items as $pk=>$item ) {
					$row	=	$cck->renderItem( $pk );
					if ( $row ) {
						$html	.=	'<div class="item"'.$item->replaceLive( $attributes ).'>'.$row.'</div>';
					}
				}
			} else {
				foreach ( $items as $i=>$item ) {
					$row	=	'';
					foreach ( $fieldnames as $fieldname ) {
						$content	=	$item->renderField( $fieldname );
						if ( $content != '' ) {
							if ( $item->getMarkup( $fieldname ) != 'none' && ( $multiple || $item->getMarkup_Class( $fieldname ) ) ) {
								$row	.=	'<div class="cck-clrfix'.$item->getMarkup_Class( $fieldname ).'">'.$content.'</div>';
							} else {
								$row	.=	$content;
							}
						}
					}
					if ( $row ) {
						$html	.=	'<div class="item"'.$item->replaceLive( $attributes ).'>'.$row.'</div>';
					}
				}
			}
			echo $html;
		}
	?>
<?php if ( !$isMore ) { ?>
	</div>
</div>
<?php
}
// -- Finalize
$cck->finalize();

if ( $isMore ) {
?>
<script type="text/javascript">
	<?php echo $js; ?>
</script>
<?php } ?>