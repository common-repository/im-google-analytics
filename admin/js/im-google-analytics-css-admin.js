(function( $ ) {
	'use strict';
	 
	$( window ).load(function() {
	
		//hide all the 'tab-content'
		$('.inmomentum-nav-tab-content').hide();
		
		//show 'tab-content' that is default
		$('.inmomentum-nav-tab-content[inmomentum-nav-tab-content=' + $('.nav-tab.nav-tab-active').attr('inmomentum-nav-tab-for') + ']').show();

		$('.nav-tab').click(function(){

			//hide all the 'tab-content'
			$('.inmomentum-nav-tab-content').hide();

			//manage the 'active-tab' class
			$('.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');

			//show 'tab-content' for the pressed tab
			$('.inmomentum-nav-tab-content[inmomentum-nav-tab-content=' + $(this).attr('inmomentum-nav-tab-for') + ']').show();

		});

	});

})( jQuery );
