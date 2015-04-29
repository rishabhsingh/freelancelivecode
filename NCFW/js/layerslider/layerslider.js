
// Function Start
$(window).load(function(){

'use strict';

/* ==============================================
LAYER SLIDER
=============================================== */

	jQuery("#layerslider").layerSlider({
			responsive: true,
			responsiveUnder: 1280,
			layersContainer: 1280,
			skin: 'fullwidth',
			skinsPath: 'css/layerslider/skins/',
		});

/* ==============================================
NAVIGATION MENU - STICKY
=============================================== */

		$("#navigation-sticky").sticky({ topSpacing: 0 });

});// End Function