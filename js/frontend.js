/**
 * Frontend scripts
 *
 * @package WWNTBM
 */

/* global jQuery */

'use strict';

(function($) {
	$('document').ready(function() {
		$('.dropdown_trigger').on('click', function() {
			$(this).find('.sub_links').slideToggle();
			$(this).toggleClass('expanded');
		});
	});
}(jQuery));
