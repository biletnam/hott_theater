<?php
/**
* @version 			SEBLOD 3.x More
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// Plugin
class plgCCK_FieldCck_Canonical extends JCckPluginField
{
	protected static $type		=	'cck_canonical';
	protected static $path;
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct
	
	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct( $type, &$data = array() )
	{
		if ( self::$type != $type ) {
			return;
		}
		parent::g_onCCK_FieldConstruct( $data );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent( &$field, $value = '', &$config = array() )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		parent::g_onCCK_FieldPrepareContent( $field, $config );

		// Process
		if ( $field->state ) {
			$app		=	JFactory::getApplication();
			$doc		=	JFactory::getDocument();
			$postpone	=	false;

			if ( count( $doc->_links ) ) {
				foreach ( $doc->_links as $k=>$link ) {
					if ( $link['relation'] == 'canonical' ) {
						unset( $doc->_links[$k] );
					}
				}
			}
			if ( $field->options2 != '' ) {
				$fieldname		=	'';
				$fieldname2		=	'';
				$options2		=	new JRegistry( $field->options2 );
				$location		=	( $config['location'] ) ? $config['location'] : 'joomla_article';
				if ( $options2->get( 'content' ) == '2' ) {				
					$postpone	=	true;
					$fieldname	=	$options2->get( 'content_fieldname' );
				}
				if ( $options2->get( 'itemid' ) == '-2' ) {
					$fieldname2	=	$options2->get( 'itemid_fieldname' );
					$itemId		=	$config['Itemid'];
					$postpone	=	true;
				} else {
					$itemId		=	$options2->get( 'itemid', $config['Itemid'] );
				}
				if ( $postpone !== false ) {
					parent::g_addProcess( 'beforeRenderContent', self::$type, $config, array( 'name'=>$field->name, 'fieldname'=>$fieldname, 'itemId'=>$itemId, 'fieldname2'=>$fieldname2, 'location'=>$location, 'sef'=>$options2->get( 'sef', JCck::getConfig_Param( 'sef' ) ) ) );
				} elseif ( $config['pk'] ) {
					$uri		=	JUri::getInstance();
					$domain		=	$uri->toString( array( 'scheme', 'host', 'port' ) );
					$link		=	JCck::callFunc_Array( 'plgCCK_Storage_Location'.$location, 'getRoute', array( $config['pk'], $options2->get( 'sef', JCck::getConfig_Param( 'sef' ) ), $options2->get( 'itemid', $config['Itemid'] ), $config ) );
					$doc->addHeadLink( $domain.$link, 'canonical' );
					$app->cck_canonical_url	=	$link;
				}
			}
			$app->cck_canonical	=	true;
		}
		
		$field->display	=	0;
		$field->value	=	'';
	}
	
	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
		self::$path	=	parent::g_getPath( self::$type.'/' );
		parent::g_onCCK_FieldPrepareForm( $field, $config );
		
		$field->display	=	0;
		$field->form	=	'';
		$field->value	=	'';
		
		// Return
		if ( $return === true ) {
			return $field;
		}
	}
	
	// onCCK_FieldPrepareSearch
	public function onCCK_FieldPrepareSearch( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
	}
	
	// onCCK_FieldPrepareStore
	public function onCCK_FieldPrepareStore( &$field, $value = '', &$config = array(), $inherit = array(), $return = false )
	{
		if ( self::$type != $field->type ) {
			return;
		}
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Render
	
	// onCCK_FieldRenderContent
	public static function onCCK_FieldRenderContent( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderContent( $field );
	}
	
	// onCCK_FieldRenderForm
	public static function onCCK_FieldRenderForm( $field, &$config = array() )
	{
		return parent::g_onCCK_FieldRenderForm( $field );
	}
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Special Events
	
	// onCCK_FieldBeforeRenderContent
	public static function onCCK_FieldBeforeRenderContent( $process, &$fields, &$storages, &$config = array() )
	{
		if ( !$fields[$process['name']]->state ) {
			return;
		}
		
		$app	=	JFactory::getApplication();
		$doc	=	JFactory::getDocument();
		$uri	=	JUri::getInstance();

		$domain	=	$uri->toString( array( 'scheme', 'host', 'port' ) );
		$pk		=	$config['pk'];
		if ( $process['fieldname'] && isset( $fields[$process['fieldname']] ) && $fields[$process['fieldname']]->value ) {
			$pk	=	$fields[$process['fieldname']]->value;
		}
		$itemId	=	0;
		if ( $process['fieldname2'] && isset( $fields[$process['fieldname2']] ) && $fields[$process['fieldname2']]->value ) {
			$itemId	=	$fields[$process['fieldname2']]->value;
		}
		if ( !$itemId ) {
			$itemId	=	$process['itemId'];
		}
		$link	=	JCck::callFunc_Array( 'plgCCK_Storage_Location'.$process['location'], 'getRoute', array( $pk, $process['sef'], $itemId, $config ) );

		$doc->addHeadLink( $domain.$link, 'canonical' );
		$app->cck_canonical_url	=	$link;
	}
}
?>