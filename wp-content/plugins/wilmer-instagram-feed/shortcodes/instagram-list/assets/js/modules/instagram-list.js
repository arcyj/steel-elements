(function ($) {
	'use strict';
	
	var instagramList = {};
	mkdf.modules.instagramList = instagramList;


	instagramList.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load', mkdfOnWindowLoad());
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfElementorInstagramList();
	}

    /**
     * Elementor
     */
	function mkdfElementorInstagramList() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_instagram_list.default', function () {
				mkdf.modules.common.mkdfOwlSlider();
			});
		});
	}
	
})(jQuery);