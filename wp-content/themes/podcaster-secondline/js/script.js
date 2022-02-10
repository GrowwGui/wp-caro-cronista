/*  

[TABLE OF CONTENTS]

01. Main Navigation
02. FitVids
03. Mobile Navigation
04. FlexSlider
05. Scroll to Top
06. prettyPhoto
07. Fixed Navigation
08. One Page Navigation
09. Comments Scroll
10. Media Player
11. Match Height

*/




jQuery(document).ready(function($) {
	 'use strict';

	
	
/*
============= 01. Main Navigation  =============
*/
	 jQuery('.secondline-themes-one-page-nav-off nav#site-navigation ul.sf-menu').superfish({
			 	popUpSelector: 'ul.sub-menu,.sf-mega', 	// within menu context
	 			delay:      	200,                	// one second delay on mouseout
	 			speed:      	0,               		// faster \ speed
		 		speedOut:    	200,             		// speed of the closing animation
				animation: 		{opacity: 'show'},		// animation out
				animationOut: 	{opacity: 'hide'},		// adnimation in
		 		cssArrows:     	true,              		// set to false
			 	autoArrows:  	true,                    // disable generation of arrow mark-up
		 		disableHI:      true,
	 });
	 
	 
	 
/*
============= 02. . FitVids  =============
*/
	 $("#content-slt, #blog-post-title-meta-container .single-player-container-secondline.embed-player-single-slt .single-video-secondline").fitVids();
	 
	 
/*
============= 03. Mobile Navigation  =============
*/
	 	
   	$('ul.mobile-menu-slt').slimmenu({
   	    resizeWidth: '1024',
   	    collapserTitle: 'Menu',
   	    easingEffect:'easeInOutQuint',
   	    animSpeed:350,
   	    indentChildren: false,
   		childrenIndenter: '- '
   	});
	
	
	$('.mobile-menu-icon-slt').click(function(e){
		e.preventDefault();
		$('#main-nav-mobile').slideToggle(350);
		$("#masthead-slt").toggleClass("active-mobile-icon-slt");
	});
	



/*
============= 04. FlexSlider  =============
*/	
    $('.secondline-themes-gallery').flexslider({
		animation: "fade",      
		slideDirection: "horizontal", 
		slideshow: false,   
		smoothHeight: false,
		slideshowSpeed: 7000,  
		animationSpeed: 1000,        
		directionNav: true,             
		controlNav: true,
		prevText: "",   
		nextText: "",
    });


/*
============= 05. Scroll to Top  =============
*/
  	// browser window scroll (in pixels) after which the "back to top" link is shown
  	var offset = 150,
  	
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
  	offset_opacity = 1200,
  	
	//duration of the top scrolling animation (in ms)
  	scroll_top_duration = 700;
	
	
	/* Scroll to link inside page */
	$('a.scroll-to-link').click(function(){
	  $('html, body').animate({
	    scrollTop: $( $.attr(this, 'href') ).offset().top - slt_top_offset
	  }, 400);
	  return false;
	});


/*
============= 06. prettyPhoto  =============
*/

  	$(".secondline-elements-slider-background a[data-rel^='prettyPhoto'], #page-title-slt-post-page a[data-rel^='prettyPhoto'], .secondline-themes-default-blog-overlay a[data-rel^='prettyPhoto'], .secondline-themes-image-grid a[data-rel^='prettyPhoto'], .secondline-themes-feaured-image a[data-rel^='prettyPhoto']").prettyPhoto({
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
  			hook: 'data-rel',
			opacity: 0.7,
  			show_title: false, /* true/false */
  			deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
  			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
  			custom_markup: '',
			default_width: 1100,
			default_height: 619,
  			social_tools: '' /* html or false to disable */
  	});
	
	
  	$("a.lightbox, .lightbox a").prettyPhoto({
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
  			hook: 'class',
			opacity: 0.7,
  			show_title: false, /* true/false */
  			deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
  			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
  			custom_markup: '',
			default_width: 1100,
			default_height: 619,
  			social_tools: '' /* html or false to disable */
  	});



/*
============= 07. Fixed Navigation  =============
*/	
	
	var slt_top_offset = $('header#masthead-slt').height();  // get height of fixed navbar
	
	var slt_top_offset_sidebar = $('#secondline-fixed-nav').height() + 30 ; 
	
	
	$('#secondline-fixed-nav').scrollToFixed({ minWidth: 1024 });
	
	$(window).resize(function() {
	   var width_secondline = $(document).width();
	      if (width_secondline > 1023) {
				/* STICKY HEADER CLASS */
				$(window).on('load scroll resize orientationchange', function () {
					
				    var scroll = $(window).scrollTop();
				    if (scroll >=  slt_top_offset - 1  ) {
				        $("#secondline-fixed-nav").addClass("secondline-fixed-scrolled");
				    } else {
				        $("#secondline-fixed-nav").removeClass("secondline-fixed-scrolled");
				    }
				});
			} else {
				$('#secondline-fixed-nav').trigger('detach.ScrollToFixed');
			}
		
	}).resize();
	


/*
============= 08. One Page Navigation  =============
*/
	var $nav = $('.secondline-themes-one-page-nav #site-navigation');
	var $nav2 = $('.secondline-themes-one-page-nav #main-nav-mobile');
	$nav.onePageNav({
	    currentClass: 'current-menu-item',
	    scrollSpeed: 650,
		scrollOffset: slt_top_offset,
	    scrollThreshold: 0.5,
		filter: ':not(.external)',
	    easing: 'swing',
	});
	
	$nav2.on('click', 'a', function(e) {
		var currentPos = $(this).parent().prevAll().length;
		$nav.find('li').eq(currentPos).children('a').trigger('click');
		e.preventDefault();
	});


	
/*
============= 09. Comments Scroll  =============
*/		
	$("#page-title-slt-post-page .blog-meta-comments").click(function(){
	    $('html, body').animate({scrollTop: $("#comments").offset().top - 140}, 600);
	});
		
	// Meta seperator fix //	
	$('body .secondline-post-meta').each(function() {			
		$(this).find('span:visible:last').addClass('secondline-visible-last');
	});
	
	
/*
============= 10. Media Player  =============
*/	


/* REMOVED FOR WP 4.9 */
	

    
	
/*
============= 11. Match Height  =============
*/		
	
	$(function() {
		$(".single-column-slt .secondline-themes-feaured-image img").addClass("match-height-slt");		
		$(".single-column-slt .secondline-blog-content").addClass("match-height-slt");
		$(".single-column-slt.secondline_elements_post_list_disable_match .secondline-themes-feaured-image img").removeClass("match-height-slt");
		$(".single-column-slt.secondline_elements_post_list_disable_match .secondline-blog-content").removeClass("match-height-slt");
		if (window.innerWidth > 767) {
		  $('.match-height-slt').matchHeight();
		  $('body .grid-columns-slt.fitRows-secondline .secondline-blog-content').matchHeight({byRow: true,});
        };
	});
	
});