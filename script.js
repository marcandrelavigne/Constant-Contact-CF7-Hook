;(function formBlockFuncs($) {
	
	/**
	 * INITIALISE
	 * ----------
	 *
	 * @return {undefined}
	 */
	(function init() {		
		if ( $('#js-newsletter').length ) {
			newsletterHook();
		}
	})();
	
  // Ajax Hook
	function newsletterHook() {
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			$.ajax({
				url: "/wp/wp-admin/admin-ajax.php",
				type: 'POST',
			    data: {
				    firstname: $('#js-newsletter input[name="first-name"]').val(),
				    lastname: $('#js-newsletter input[name="last-name"]').val(),
				    email: $('#js-newsletter input[name="email"]').val(), 
				    company: $('#js-newsletter input[name="company"]').val(), 
				    action: 'newsletter_ajax'
				},
			  success: function(result){
          var obj = result.toString();
					console.log(obj);
		    }
			})
		}, false );
	}
	
})(jQuery);
