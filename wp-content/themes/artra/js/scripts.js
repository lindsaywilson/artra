
jQuery(document).ready(function($) {


	// GLOBAL SCRIPTS
	
	// Define Global Mobile
	window.isMobile = false;
	window.deviceHasChanged = false;
	LAYOUT.checkMobile;
	
	// Define if on mobile (based on CCS media Queries : Device < 960px wide)
	var resizeTimer;
	LAYOUT.timerResize();
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() { LAYOUT.timerResize(); }, 100);
	});
	
	// Open external links in a new window
	$('a[rel*=external]').click(function(){
		window.open($(this).attr('href'));
		return false; 
	});
	
	// Mobile Nav toggle
	// Click on Mobile Nav Toggle
	$('.menu-toggle').click(function(){
		MOBILE.toggleNav();
		return false;
	});
	
	// Mobile Menu
	$('#menu-main-menu li.menu-item-has-children').prepend('<span class="collapser"><i class="icon-down-open"></i></span>');
	$('#menu-main-menu .collapser').click( function(){
		$(this).siblings('ul').slideToggle('fast');
		$(this).children('i').toggleClass('icon-up-open').toggleClass('icon-down-open')
	});
	
	// Init flexslider
	$('#slider').flexslider({
		controlNav: false,
		directionNav: false
	});
	$('#gallery').flexslider({
		controlNav: false,
		slideshow: true,
		animation: "slide",
		animationLoop: false,
		itemWidth: 255,
		itemMargin: 20
	});
	
	
	// Init Google map
	$('.acf-map').each(function(){
		render_map( $(this) );
	});
	
	
	// Form labels fadeout
	$('.form-item label').click( function(){
		$(this).next().find('input').focus()
	});
	$('.form-item input, .form-item textarea').focus( function(){
		$(this).parents('.form-item').find('label').fadeOut('fast');
	});
	$('.form-item input, .form-item textarea').each( function(){
		if(!$(this).val() == ''){
			$(this).parents('.form-item').find('label').fadeOut('fast');
		}
	});
	$('.form-item input, .form-item textarea').blur( function(){
		if($(this).val() == ''){
			$(this).parents('.form-item').find('label').fadeIn('fast');
		}
	});
	
	
	// Feedback form labels
	if($('body').hasClass('page-id-64')){
		$('.usp-title label').text('Name, Company and State');
		$('.usp-content label').text('Feedback');
		$('.usp-images label').text('Upload your logo');
	}
	
	
	/*
	*  render_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$el (jQuery element)
	*  @return	n/a
	*/
	 
	function render_map( $el ) {
	 
		// var
		var $markers = $el.find('.marker');
	 
		// vars
		var args = {
			zoom		: 17,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
	 
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
	 
		// add a markers reference
		map.markers = [];
	 
		// add markers
		$markers.each(function(){
	 
			add_marker( $(this), map );
	 
		});
	 
		// center map
		center_map( map );
	 
	}
	 
	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/
	 
	function add_marker( $marker, map ) {
	 
		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	 
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map
		});
	 
		// add to array
		map.markers.push( marker );
	 
		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
	 
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
	 
				infowindow.open( map, marker );
	 
			});
		}
	 
	}
	 
	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/
	 
	function center_map( map ) {
	 
		// vars
		var bounds = new google.maps.LatLngBounds();
	 
		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){
	 
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
	 
			bounds.extend( latlng );
	 
		});
	 
		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}
	 
	}

	

})



	// ---------------------
	// LAYOUT
	// ---------------------
	
    var LAYOUT = {};
    LAYOUT.timerResize = function(){
        
        // Define if mobile
        this.checkMobile();

        // Display navigation if not mobile
        if(!window.isMobile){
            MOBILE.showNav();
        }
    };
	
    LAYOUT.checkMobile = function (){
        // Define if on mobile (based on CCS media Queries : Device < 800px wide)
        if ( jQuery("#page").css("position") === 'relative') {
			if( window.isMobile ){
                window.deviceHasChanged = false;
            }else{
               window.deviceHasChanged = true; 
               window.isMobile = true;
			   MOBILE.hideNav();
            }  
        }else{
            if( !window.isMobile ){
                window.deviceHasChanged = false;
            }else{
                window.deviceHasChanged = true;
                window.isMobile = false;
				MOBILE.showNav();
            }
        }
    };
	
	
	// ---------------------
	// MOBILE
	// ---------------------
	
    var MOBILE = {};
    MOBILE.toggleNav = function (){
		var nav = jQuery('.menu');
		var button = jQuery('.menu-toggle');
        if (button.hasClass('icon-menu')){
            button.addClass('icon-cancel');
			button.removeClass('icon-menu');
			nav.slideDown("fast");
        }else{
			button.addClass('icon-menu');
			button.removeClass('icon-cancel');
            nav.slideUp("fast"); 
        }
    };
    MOBILE.showNav = function (){
		jQuery('.menu').show();
        jQuery('.mobile_toggle').removeClass('icon-cancel').addClass('icon-menu');
		jQuery('#menu-main-menu ul').removeAttr('style');
    };
    MOBILE.hideNav = function (){
		jQuery('.menu').hide();
		jQuery('.menu-toggle').removeClass('icon-cancel').addClass('icon-menu');
    };