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
?>

<?php
global $user;

$app		=	JFactory::getApplication();
$path_lib	=	JPATH_SITE.'/libraries/cck/rendering/rendering.php';
$user		=	CCK::getUser();

if ( ! file_exists( $path_lib ) ) {
	print( '/libraries/cck/rendering/rendering.php file is missing.' );
	die;
}

// Require Library
require_once $path_lib;
?>