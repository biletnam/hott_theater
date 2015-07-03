<?php
/**
 * Slideshow Module Entry Point
 * 
 * @package    Joomla 1.5.0
 * @subpackage Modules
 * @license        GNU/GPL, see LICENSE.php
 * mod_tagcloud is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');
 
//params
$type = $params->get( 'type', 'article' );
$width = $params->get( 'width', 500 );
$height = $params->get( 'height', 200 );
$readmore = $params->get( 'readmore', 0 );
$navigation_type = $params->get( 'navigation_type', 'numbers' );
$fx = $params->get( 'fx', 'fade' );
$timeout = $params->get( 'timeout' );
$slideSpeed = $params->get( 'slideSpeed' );
$tabSpeed = $params->get( 'tabSpeed' );
$bg_yes = $params->get( 'bg_yes' );
if ($bg_yes==0) $bg_yes='false';
if ($bg_yes==1) $bg_yes='true';
$navigate = $params->get( 'navigate', 1 );
$prev_next = $params->get( 'prev_next' );
$pause_resume = $params->get( 'pause_resume' );
$number_items = $params->get( 'number_items' );
$layout = $params->get('layout', 'default');
$loadjquery = $params->get('loadjquery', 1);

//append javascript AND css files files
$document =& JFactory::getDocument();		
if($loadjquery) $document->addscript("http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js");
$document->addStyleSheet(JURI::root().'/modules/mod_jslideshow/css/'.str_replace("_:","",$params->get('layout', 'default')).'.css');

// get the items to display from the helper
$slideShow = ModSlideShow::getList($params);
$number_items = count($slideShow);

require JModuleHelper::getLayoutPath('mod_jslideshow', $params->get('layout', 'default'));

?>