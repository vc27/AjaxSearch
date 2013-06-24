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
	
	class AjaxSettingsVCWP {		
		
		
		/**
		 * location
		 * 
		 * @access public
		 * @var string
		 **/
		var $location = '/addons';
		
		
		
		/**
		 * action
		 * 
		 * @access public
		 * @var string
		 **/
		var $action = 'search-ajax';
		
		
		
		/**
		 * object_name
		 * 
		 * @access public
		 * @var string
		 **/
		var $object_name = 'searchAjax';
		
		
	}; // end class AjaxSettingsVCWP
	$AjaxSettingsVCWP = new AjaxSettingsVCWP();
	
	
	
	// Widget Classes
	require_once( "AjaxSearchVCWP.php" );
	require_once( "DoAjaxVCWP.php" );
	
	define( 'AjaxSearch_INIT', true );
	
	
	
} // end if ( ! defined('AjaxSearch_INIT') )