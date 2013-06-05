<?php
/**
 * File Name initiate-AjaxSearch.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
#################################################################################################### */


if ( ! defined('AjaxSearch_INIT') ) {
	
	// Widget Classes
	require_once( "AjaxSearchVCWP.php" );
	require_once( "DoAjaxVCWP.php" );
	
	define( 'AjaxSearch_INIT', true );
	
} // end if ( ! defined('AjaxSearch_INIT') )