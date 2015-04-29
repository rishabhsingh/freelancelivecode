$(window).load(function(){

	'use strict';

/* ==============================================
PAGE LOADER
============================================== */
	
	$(".mid").delay(0).fadeOut();
	$(".outter").delay(0).fadeOut();
	$("#pageloader").delay(300).fadeOut("slow");

/* ==============================================
FIT VIDEOS
============================================== */
	
    $(".fit-vids").fitVids();

/* ==============================================
NAVIGATION DROP DOWN MENU
=============================================== */	

	$('.nav-toggle').hover(function() {
	    $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(250);
	    }, function() {
	    $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(250)
 	});

/* ==============================================
HOME PAGE IMAGE SLIDER (SUPER SLIDES)
=============================================== */

 	$('#fullscreen , .p-section').superslides({
	 	play: 12000,
	    animation: 'fade',
	    inherit_height_from: window,
    });

/* ==============================================
PROJECT 01 HOME (SUPER SLIDES)
=============================================== */

 	$('#project').superslides({
	 	play: 8000,
	    animation: 'fade',
	    inherit_width_from: window,
		inherit_height_from: '.home_project',
    });

/* ==============================================
FLEX SLIDER FOR HOME TEXTS V1
=============================================== */	
		
    $('.v1 .text-slider').flexslider({
        animation: "slide",
		selector: "ul.home-texts li.slide",
		controlNav: false,
		directionNav: true,
		touch: true, 
		slideshowSpeed: 5000,  
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
FLEX SLIDER FOR HOME TEXTS V2
=============================================== */	
		
    $('.v2 .text-slider').flexslider({
        animation: "fade",
		selector: "ul.home-texts li.slide",
		controlNav: false,
		directionNav: true,
		animationSpeed: 500,
		slideshowSpeed: 5000,  
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
MAGNIFIC POPUP
=============================================== */	
	
	//for single image
	$('.mp-image').magnificPopup({type:'image'});
	//for videos and maps
	$('.mp-video, mp-map').magnificPopup({type:'iframe'});

	//iframe scripts
	$.extend(true, $.magnificPopup.defaults, {  
	    iframe: {
	        patterns: {
	        	//youtube videos
	        	youtube: {
	        		index: 'youtube.com/', 
	        		id: 'v=', 
	        		src: 'http://www.youtube.com/embed/%id%?autoplay=1' 
	        	},
	        	//vimeo videos
	        	vimeo: {
	        		index: 'vimeo.com/',
	        		id: '/',
	        		src: 'http://player.vimeo.com/video/%id%?autoplay=1'
	        	},
	        	//google maps
	        	gmaps: {
	        		index: '//maps.google.',
	        		src: '%id%&output=embed'
	        	}
	        }
	    }
	});

	//for image gallery
	$('.mp-gallery').each(function() { // the containers for all your galleries
	    $(this).magnificPopup({
	        delegate: 'a', // the selector for gallery item
	        type: 'image',
	        gallery: {
	          enabled:true
	        }
	    });
	}); 

/* ==============================================
PRETTY PHOTO
=============================================== */

	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
    	theme: "light_square",
    	default_width: 700,
		default_height: 400,
	});

/* ==============================================
Fit Videos
=============================================== */

     $(".fitvid").fitVids();

/* ==============================================
CUSTOM IMAGE SLIDER
=============================================== */	
		
    $('.custom_slider').flexslider({
        animation: "fade",
		selector: ".image_slider .slide",
		controlNav: true,
		directionNav: true,
		animationSpeed: 500,
		slideshowSpeed: 5000,
		pauseOnHover: true, 
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
FLEX SLIDER FOR PORTFOLIO VERSION
=============================================== */	
		
    $('.inner-portfolio .text-slider').flexslider({
        animation: "fade",
		selector: "ul.texts li.slide",
		controlNav: false,
		directionNav: true,
		slideshowSpeed: 5000,  
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
FLEX SLIDER FOR PORTFOLIO VERSION
=============================================== */	
		
    $('.inner-portfolio .circle-image-slider').flexslider({
        animation: "fade",
		selector: "ul.circle-slider li.slide",
		controlNav: false,
		directionNav: true,
		slideshowSpeed: 5000,  
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
CAROUSEL SLIDER FOR HOME BOXES (V1)
=============================================== */	

    $(".home-boxes").owlCarousel({
    	items : 3,
    	// Responsive Settings
    	itemsDesktop : [1169,3],
		itemsDesktopSmall : [979,2],
		itemsTablet : [600,1],
		itemsTabletSmall : false,
		itemsMobile : [560,1],
		// End Responsive Settings
    	slideSpeed : 400
    });

/* ==============================================
CAROUSEL SLIDER FOR TEAM BOXES
=============================================== */	

    $(".team-boxes").owlCarousel({
    	items : 4,
    	// Responsive Settings
    	itemsDesktop : [1169,4],
		itemsDesktopSmall : [1024,3],
		itemsTablet : [640,2],
		itemsTabletSmall : false,
		itemsMobile : [560,1],
		// End Responsive Settings
    	slideSpeed : 400
    });

/* ==============================================
CAROUSEL SLIDER FOR CLIENTS
=============================================== */	

    $(".clients").owlCarousel({
    	items : 3,
    	// Responsive Settings
    	itemsDesktop : [1169,3],
		itemsDesktopSmall : [979,3],
		itemsTablet : [768,2],
		itemsTabletSmall : false,
		itemsMobile : [479,1],
		// End Responsive Settings
		mouseDrag : false,
		pagination : true,
		navigation : false,
		touchDrag : true,
    	slideSpeed : 400
    });

/* ==============================================
CAROUSEL SLIDER FOR CLIENT LOGOS
=============================================== */	

    $(".logos").owlCarousel({
    	items : 5,
    	// Responsive Settings
    	itemsDesktop : [1169,5],
		itemsDesktopSmall : [979,4],
		itemsTablet : [768,3],
		itemsTabletSmall : false,
		itemsMobile : [479,2],
		// End Responsive Settings
		autoPlay : 8000,
    	slideSpeed : 400
    });

/* ==============================================
FEATURED WORKS SLIDER
=============================================== */	

    $("#featured-works .works").owlCarousel({
    	items : 4,
    	// Responsive Settings
    	itemsDesktop : [1169,4],
		itemsDesktopSmall : [1100,3],
		itemsTablet : [960,2],
		itemsMobile : [640,1],
		// End Responsive Settings
		pagination : false,
		navigation : true,
		mouseDrag : false,
    	stopOnHover : true,
    	slideSpeed : 700,
    	paginationSpeed : 900,
    	rewindSpeed : 1100
    });

/* ==============================================
SERVİCES SLIDER
=============================================== */	

    $("#services .service-boxes").owlCarousel({
    	items : 4,
    	// Responsive Settings
    	itemsDesktop : [1169,4],
		itemsDesktopSmall : [979,3],
		itemsTablet : [768,2],
		itemsTabletSmall : false,
		itemsMobile : [479,1],
		// End Responsive Settings
		pagination : false,
		navigation : true,
		mouseDrag : true,
    });

/* ==============================================
VIDEO PLAYER
=============================================== */	

	$(".player").mb_YTPlayer();

/* ==============================================
FLEX SLIDER FOR TESTIMONIALS
=============================================== */	
		
    $('.testimonials').flexslider({
        animation: "fade",
		selector: "ul.text-slider li.text",
		controlNav: false,
		directionNav: true ,
		slideshowSpeed: 5000,  
		direction: "vertical",
        start: function(slider){
        	$('body').removeClass('loading'); 
        }
     });

/* ==============================================
SOFT SCROLL EFFECT FOR NAVIGATION LINKS
=============================================== */	

	$('.scroll').bind('click', function(event) {
		var $anchor = $(this);
		var headerH = $('#navigation, #navigation-sticky').outerHeight();
		$('html, body').stop().animate({
		scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
		}, 1200, 'easeInOutExpo');
		event.preventDefault();
	});

/* ==============================================
NAVIGATION SECTION CHANGEABLE BACKGROUND SCRIPT
=============================================== */

	var menu = $('#navigation');
    $(window).scroll(function () {
        var y = $(this).scrollTop();
        var homeH = $('#home').outerHeight();
        var headerH = $('#navigation').outerHeight();
        var z = $('#home').offset().top + homeH - headerH;
        if (y >= z) {
            menu.removeClass('first-nav').addClass('second-nav');
        }
        else{
            menu.removeClass('second-nav').addClass('first-nav');
        }
    });

/* ==============================================
BACK TO TOP BUTTON
=============================================== */	
	
	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

/* ==============================================
CONTACT FORM
=============================================== */	

  //submission scripts
  $('form#contact-form').submit( function(){
		//statements to validate the form	
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var email = document.getElementById('email');
		if (!filter.test(email.value)) {
			$('.email-missing').fadeIn("slow");
		} else {$('.email-missing').fadeOut("slow");}
		if (document.cform.name.value == "") {
			$('.name-missing').fadeIn("slow");
		} else {$('.name-missing').fadeOut("slow");}	
		if (document.cform.subject.value == "") {
			$('.subject-missing').fadeIn("slow");
		} else {$('.subject-missing').fadeOut("slow");}	
		if (document.cform.message.value == "") {
			$('.message-missing').fadeIn("slow");
		} else {$('.message-missing').fadeOut("slow");}		
		if ((document.cform.name.value == "") || (!filter.test(email.value)) || (document.cform.message.value == "")){
			return false;
		} 
		
		if ((document.cform.name.value != "") && (filter.test(email.value)) && (document.cform.message.value != "")) {

			$('.mail-message').removeClass('not-visible-message').addClass('visible-message');
					
			//show the loading bar
			$('.loader').append($('.bar'));
			$('.bar').css({display:'block'});
			
			//stay on the page
			return false;
		} 
  });



/* ==============================================
WHAT WE DO EFFECTS
=============================================== */

	var $containerFirst = $('.w-items');

		$containerFirst.isotope({
			resizable: false, 
			//masonry: { columnWidth: $containerFirst.width() / 5 },
			itemSelector : '.w-item' ,
			hiddenStyle: { opacity: 0, },
			visibleStyle: { opacity: 1,},
			transformsEnabled: false,
		});

	    var $optionSets = $('#w-options .w-option-set'),
	          $optionLinks = $optionSets.find('a');

	          // Your First Selected Item
	          $containerFirst.isotope({ filter: '.movie' });

	    $optionLinks.click(function(){
	        var $this = $(this);

	        // don't proceed if already selected
	        if ( $this.hasClass('selected') ) {
	          return false;
	        }
	        var $optionSet = $this.parents('.w-option-set');
	        $optionSet.find('.selected').removeClass('selected');
	        $this.addClass('selected');

	        // make option object dynamically, i.e. { filter: '.my-filter-class' }
	        var options = {},
	            key = $optionSet.attr('data-option-key'),
	            value = $this.attr('data-option-value');
	        // parse 'false' as false boolean
	        value = value === 'false' ? false : value;
	        options[ key ] = value;
	        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	          // changes in layout modes need extra logic
	          changeLayoutMode( $this, options )
	        } else {
	          // otherwise, apply new options
	          $containerFirst.isotope( options );
	        }
	        
	        return false;
	    });


/* ==============================================
PORTFOLIO ITEMS
=============================================== */

		var $container = $('.portfolio-items');

			$container.isotope({
				//masonry: { columnWidth: $container.width() / 5 },
				itemSelector : '.item' ,
			});
		      
		    var $optionSets = $('#options .option-set'),
		          $optionLinks = $optionSets.find('a');

		    $optionLinks.click(function(){
		        var $this = $(this);

		        // don't proceed if already selected
		        if ( $this.hasClass('selected') ) {
		          return false;
		        }
		        var $optionSet = $this.parents('.option-set');
		        $optionSet.find('.selected').removeClass('selected');
		        $this.addClass('selected');
		  
		        // make option object dynamically, i.e. { filter: '.my-filter-class' }
		        var options = {},
		            key = $optionSet.attr('data-option-key'),
		            value = $this.attr('data-option-value');
		        // parse 'false' as false boolean
		        value = value === 'false' ? false : value;
		        options[ key ] = value;
		        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
		          // changes in layout modes need extra logic
		          changeLayoutMode( $this, options )
		        } else {
		          // otherwise, apply new options
		          $container.isotope( options );
		        }
		        
		        return false;
		    });

/* ==============================================
NAVIGATION SECTION CHANGEABLE BACKGROUND SCRIPT
=============================================== */

    $('body').scrollspy({ 
		target: '.nav-menu',
		offset: 95
	})

 }); // END FUNCTION

/* ==============================================
PARALLAX CALLING
=============================================== */

	( function ( $ ) {
		'use strict';
		$(document).ready(function(){
		$(window).bind('load', function () {
				parallaxInit();						  
			});
			function parallaxInit() {
				testMobile = isMobile.any();
				if (testMobile == null)
				{
					//Parallax Classes
					$('body.parallax .image1').parallax("50%", 0.5);
					$('body.parallax .image2').parallax("50%", 0.5);
					$('body.parallax .image3').parallax("50%", 0.5);
					$('body.parallax .image4').parallax("50%", 0.5);
					$('body.parallax .image5').parallax("50%", 0.5);
					$('body.parallax .image6').parallax("50%", 0.5);
					$('body.parallax .image7').parallax("100%", 0.5);
					$('body.parallax .image8').parallax("100%", 0.5);
					$('body.parallax .image9').parallax("100%", 0.5);
					$('body.parallax .image10').parallax("100%", 0.5);
					$('body.parallax .image11').parallax("100%", 0.5);
					$('body.parallax .image-bg').parallax("50%", 0.5);
					$('body.parallax .parallax').parallax("-50%", 0.3);
					$('body.parallax .parallax1').parallax("50%", 0.5);
					$('body.parallax .parallax2').parallax("50%", 0.5);
					$('body.parallax .parallax3').parallax("50%", 0.5);
					$('body.parallax .parallax4').parallax("50%", 0.5);
					$('body.parallax .parallax5').parallax("50%", 0.5);
					$('body.parallax .parallax6').parallax("50%", 0.5);
					$('body.parallax .parallax7').parallax("50%", 0.5);
				}
			}	
			parallaxInit();	 
		});	
		//Mobile Detect
		var testMobile;
		var isMobile = {
		    Android: function() {
		        return navigator.userAgent.match(/Android/i);
		    },
		    BlackBerry: function() {
		        return navigator.userAgent.match(/BlackBerry/i);
		    },
		    iOS: function() {
		        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		    },
		    Opera: function() {
		        return navigator.userAgent.match(/Opera Mini/i);
		    },
		    Windows: function() {
		        return navigator.userAgent.match(/IEMobile/i);
		    },
		    any: function() {
		        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		    }
		};
	}( jQuery ));

/* ==============================================
COUNT FACTORS
=============================================== */	
  
	jQuery(function() {
		
		$(".fact").appear(function(){
			$('.fact').each(function(){
		       	dataperc = $(this).attr('data-perc'),
				$(this).find('.factor').delay(6000).countTo({
			        from: 0,
			        to: dataperc,
			        speed: 3000,
			        refreshInterval: 50,
	            
        		});  
			});
		});
	});
 
(function($) {
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);

/* ==============================================
ANIMATED SKILL BARS
=============================================== */

	jQuery('.progress-bar').appear(function(){
		datavl = $(this).attr('data-value'),
		$(this).animate({ "width" : datavl + "%"}, '300');
	}); 

/* ==============================================
MOBILE BACKGROUND FOR VIDEO BACKGROUNDS
=============================================== */

$(window).load(function(){
	'use strict';
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$('.mbYTP_wrapper').addClass('mobile-bg');
		$('section , div').addClass('b-scroll');
		$('.animated').addClass('visible');
	}
	else{
		if (jQuery.browser.mozilla) {}
		else if (jQuery.browser.safari) {}
		else{
			// Select to link
			$('a.ex-link').click(function(){
				var Exlink = this.getAttribute('href');		
				// Fade In Page Loader
		  		$('#pageloader').fadeIn(350, function(){		  
				    document.location.href = Exlink;
			  	});
			  return false;
			});
		}

		//ANIMATED ITEMS
	    $('.animated').appear(function() {
		    var elem = $(this);
		    var animation = elem.data('animation');
		    if ( !elem.hasClass('visible') ) {
		       	var animationDelay = elem.data('animation-delay');
		        if ( animationDelay ) {
		            setTimeout(function(){
		                elem.addClass( animation + " visible" );
		            }, animationDelay);
		        } else {
		            elem.addClass( animation + " visible" );
		        }
		    }
		});

	}

}); 

/* ==============================================
MOBILE NAV BUTTON
=============================================== */	

	$( ".mobile-nav-button" ).click(function() {
		$( ".nav-inner div.nav-menu" ).slideToggle( "medium", function() {
		// Animation complete.
		});
	});

	$('.nav-inner div.nav-menu ul.nav li a').click(function () {
		if ($(window).width() < 1000) {
			$(".nav-menu").slideToggle("2000")
		}
	});
