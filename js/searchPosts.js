jQuery(document).ready(function($) {
	
	searchPosts.init({
		responseElement : '#display-search-results',
		targetElement : 'form.search-posts-form',
		displayErrorMsg : 0
	});
	
});



/**
 * searchPosts
 **/
var searchPosts = {
	
	
	
	/**
	 * params
	 **/
	responseElement : '#display-search-results',
	targetElement : 'form.search-posts-form',
	displayErrorMsg : 0,
	
	
	
	/**
	 * init
	 * 
	 * version 1.0
	 * updated 00.00.13
	 **/
	init : function( params ) {
		
		searchPosts.setParams( params );
		
		jQuery(searchPosts.targetElement).validate({
			submitHandler : function(form) {
				
				jQuery.post( searchAjax.ajaxurl, {
					action : searchAjax.action,
					nonce : searchAjax.nonce,
					switch_case : jQuery(form).attr('data-switch_case'),
					post_title : jQuery( 'input[name="post_title"]', form ).val()
				}, 
				function( response ) {
					// console.log(response);
					
					if ( 'success' == response.status ) {
						
						jQuery(searchPosts.responseElement).html( response.message + response.html);
						
					} else if ( 'error' == response.status ) {
						
						jQuery(searchPosts.responseElement).html(response.message);
						
					}
					
				}, 'json' );
				
				return false;
				
			}, // end submitHandler : function
			
			
			
			/**
			 * Handles the display of errors if needed.
			 * see: http://jqueryvalidation.org/validate
			 **/
			invalidHandler: function(form, validator) {

				if ( searchPosts.displayErrorMsg == 1 && validator.numberOfInvalids() ) {
					var errors = validator.numberOfInvalids();
					var message;
					if ( errors == 1 ) {
						message = 'You missed 1 field. It has been highlighted';
					} else {
						message = 'You missed ' + errors + ' fields. They have been highlighted';
					}
					
					alert(message);
					
				}
			} // end invalidHandler
		
		}); // end form.validate
		
	}, // end init : function
	
	
	
	// ##################################################
	/**
	 * Setters
	 **/
	// ##################################################
	
	
	
	/**
	 * setParams
	 * 
	 * version 1.0
	 * updated 00.00.13
	 **/
	setParams : function( params ) {
		
		if ( typeof params != 'undefined' ) {
			if ( typeof params.responseElement != 'undefined' ) {
				searchPosts.responseElement = params.responseElement;
			}

			if ( typeof params.targetElement != 'undefined' ) {
				searchPosts.targetElement = params.targetElement;
			}

			if ( typeof params.displayErrorMsg != 'undefined' ) {
				searchPosts.displayErrorMsg = params.displayErrorMsg;
			}
		}
		
	}  // end setParams : function
	
}; // end var searchPosts