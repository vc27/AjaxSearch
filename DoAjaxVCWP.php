<?php
/**
 * File Name DoAjaxVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################




/**
 * DoAjaxVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$DoAjaxVCWP = new DoAjaxVCWP();
class DoAjaxVCWP {
	
	
	
	/**
	 * msg__default_error
	 * 
	 * @access public
	 * @var string
	 **/
	var $msg__error_default = 'Invalid ajax call';
	
	
	
	/**
	 * msg__default_error
	 * 
	 * @access public
	 * @var string
	 **/
	var $msg__error_nonce = 'Invalid nonce';
	
	
	
	/**
	 * action
	 * 
	 * @access public
	 * @var string
	 **/
	var $action = 'search-ajax';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		add_action( "wp_ajax_$this->action", array( &$this, 'do_ajax' ) );

	} // end function __construct
	
	
	
	
	
	
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
	 * set__response
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * Description:
	 * This function is used to add a new key=value
	 * pair to the response variable. The response variable
	 * is echoed at the end of the process with json_encode.
	 * Any key=value pair added to the response will be available
	 * in the jQuery response.
	 **/
	function set__response( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->response[$key] = $val;
		}
		
	} // end function set__response
	
	
	
	
	
	
	/**
	 * set__case
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__case() {
		
		if ( isset( $_REQUEST['switch_case'] ) AND ! empty( $_REQUEST['switch_case'] ) ) {
			$this->set( 'case', $_REQUEST['switch_case'] );
		}
		
	} // end function set__case
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * do_ajax
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function do_ajax() {
		
		$this->set__response( 'status', 'error' );
		$this->set__response( 'message', $this->msg__error_default );
		
		if ( $this->is_doing_ajax() ) {
			
			$this->set__response( 'message', $this->msg__error_nonce );
			
			if ( $this->have_switch_case() AND $this->have_nonce() ) {
				$this->set__case();
				$this->set( '_request', $_POST );
				
				switch ( $this->case ) {
					
					case "search-posts" :
						$this->search_posts();
						break;
					
				} // end switch ( $_POST['switch_case'] )
			
			} // end if varify
			
			header( 'Content: application/json' );
			echo json_encode( $this->response );

			die();
		
		} // end if DOING_AJAX
		
	} // end function do_ajax
	
	
	
	
	
	
	/**
	 * search_posts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function search_posts() {
		
		if ( $this->have_search() ) {
			
			
			/**
			 * Note:
			 * Globalizing is required because this is the first 
			 * instance of the $wp_query since we are technically
			 * in the admin-ajax.php file.
			 **/
			global $wp_query;
			
			
			
			/**
			 * Note:
			 * Extract $this->_request is actually extracting $_REQUEST
			 * Any variable added to the jQuery.post parameters will be 
			 * available here to use. 
			 **/
			extract( $this->_request, EXTR_SKIP );
			
			
			
			/**
			 * Note:
			 * Utilize WP_Query by what ever mean necessary in combination
			 * with the extracted $this->_request variables to do a search.
			 **/
			$wp_query = new WP_Query();
			$wp_query->query( array(
				's' => $post_title,
				'posts_per_page' => -1,
				'post_type' => 'page'
			) );
			
			if ( have_posts() ) {
				
				$this->set__response( 'status', 'success' );
				$this->set__response( 'message', '<h3>Results found</h3>' );
				
				$this->response['html'] = "<ul>";
				
				while ( have_posts() ) {
					the_post();
					
					$this->response['html'] .= "<li>" . get_the_title() . "</li>";
					
				} // end while ( have_posts() )
				
				$this->response['html'] .= "</ul>";
				
			} else {
				
				$this->set__response( 'status', 'success' );
				$this->set__response( 'message', '<h3>No posts found</h3>' );
				$this->set__response( 'html', '' );
				
			}
			
		} else {
			
			$this->set__response( 'status', 'error' );
			$this->set__response( 'message', 'put your special message here' );
			
		}
		
	} // end function search_posts
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_search
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_search() {
		
		if ( isset( $this->_request['post_title'] ) AND ! empty( $this->_request['post_title'] ) ) {
			$this->set( 'have_search', 1 );
		} else {
			$this->set( 'have_search', 0 );
		}
		
		return $this->have_search;
	
	} // end function have_search
	
	
	
	
	
	
	/**
	 * is_doing_ajax
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function is_doing_ajax() {
		
		if ( defined( 'DOING_AJAX') AND DOING_AJAX ) {
			$this->set( 'is_doing_ajax', 1 );
		} else {
			$this->set( 'is_doing_ajax', 0 );
		}
		
		return $this->is_doing_ajax;
	
	} // end function is_doing_ajax 
	
	
	
	
	
	
	/**
	 * have_switch_case
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_switch_case() {
		
		if ( isset( $_POST['switch_case'] ) AND ! empty( $_POST['switch_case'] ) ) {
			$this->set( 'have_switch_case', 1 );
		} else {
			$this->set( 'have_switch_case', 0 );
		}
		
		return $this->have_switch_case;
	
	} // end function have_switch_case
	
	
	
	
	
	
	/**
	 * have_nonce
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_nonce() {
		
		if ( isset( $_POST['nonce'] ) AND ! empty( $_POST['nonce'] ) AND wp_verify_nonce( $_POST['nonce'], $this->action ) ) {
			$this->set( 'have_nonce', 1 );
		} else {
			$this->set( 'have_nonce', 0 );
		}
		
		return $this->have_nonce;
	
	} // end function have_nonce
	
	
	
} // end class DoAjaxVCWP