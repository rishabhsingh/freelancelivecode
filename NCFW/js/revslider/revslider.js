
// Function Start
$(window).load(function(){

'use strict';

/* ==============================================
REV SLIDER FULL WIDTH
=============================================== */

	var revapi;

	   revapi = jQuery('.tp-banner').revolution(
		{
			delay:9000,
			startwidth:1170,
			startheight:610,
			hideThumbs:10,
			fullWidth:"on",
			forceFullWidth:"on"
		});

/* ==============================================
REV SLIDER FULL SCREEN
=============================================== */

	var revapi;

	   revapi = jQuery('.tp-banner-fs').revolution(
		{
			delay:9000,
			startwidth:1170,
			startheight:610,
			hideThumbs:10,
			fullWidth:"off",
			fullScreen:"on",
			fullScreenOffsetContainer: ""
		});

/* ==============================================
NAVIGATION MENU - STICKY
=============================================== */

		$("#navigation-sticky").sticky({ topSpacing: 0 });

});// End Function