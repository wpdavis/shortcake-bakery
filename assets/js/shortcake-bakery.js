(function( $ ) {

	var debounce = function(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) {
					func.apply(context, args);
				}
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if ( callNow ) {
				func.apply(context, args);
			}
		};
	};

	var responsiveElements = function() {
		// Don't use cached elements because YouTube injects new iframes
		$('.shortcake-bakery-responsive').each(function(){
			var el = $(this),
				parentWidth = el.parent().width();

			// Inside an iframe
			if ( window.self !== window.top ) {
				parentWidth = parent.innerWidth;
			}

			var trueHeight = el.data('true-height') ? el.data('true-height') : 360;
			var trueWidth = el.data('true-width') ? el.data('true-width') : 640;
			var newHeight = ( parentWidth / trueWidth ) * trueHeight;
			$(this).css('height', newHeight + 'px' ).css('width', parentWidth + 'px');
			$(this).trigger('shortcake-bakery-responsive-resize');
		});
	}

	$(document).ready(function(){
		if ( $('.shortcake-bakery-responsive').length ) {
			responsiveElements();
			$(window).on( 'resize', debounce( responsiveElements, 100 ));
		}
	});

}( jQuery ) );
