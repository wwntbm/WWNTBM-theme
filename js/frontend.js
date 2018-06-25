/**
 * Frontend scripts
 *
 * @package WWNTBM
 */

/* global jQuery */

'use strict';

(function($) {
	$('.dropdown_trigger').on('click', function() {
		$(this).next('.sub_links').slideToggle();
	});
}(jQuery));
