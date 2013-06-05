<?php
/**
 * File Name AjaxSearchVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * AjaxSearchVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$AjaxSearchVCWP = new AjaxSearchVCWP();
class AjaxSearchVCWP {
	
	
	
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
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		// uri for enque scripts
		$this->set( 'template_directory', get_stylesheet_directory_uri() . "/addons/AjaxSearch" );

		// hook method after_setup_theme
		add_action( 'init', array( &$this, 'init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function init() {
		
		// register styles and scripts
		$this->register_style_and_scripts();
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Register Styles and Scripts
	 *
	 * @version 1.6
	 * @updated 02.11.13
	 **/
	function register_style_and_scripts() {
		
		/**
		 * JS
		 **/
		
		// http://jqueryvalidation.org/documentation/
		wp_register_script( 'jquery-validate', "$this->template_directory/js/jquery.validate.js", array( 'jquery') );
		
		// javascript class for handling validation and ajax
		wp_register_script( 'search-posts', "$this->template_directory/js/searchPosts.js", array( 'jquery-validate' ) );
		
	} // end function register_style_and_scripts
	
	
	
	
	
	
	/**
	 * Enqueue Scripts
	 *
	 * @version 1.4
	 * @updated 11.18.12
	 **/
	function wp_enqueue_scripts() {
		
		// Adds a javascript object to be used by searchPosts class
		wp_localize_script( 'search-posts', $this->object_name, array(
			'home_url' => home_url(),
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'action' => $this->action,
			) );
		
		wp_enqueue_script( 'search-posts' );
		
	} // function wp_enqueue_scripts
	
	
	
} // end class AjaxSearchVCWP