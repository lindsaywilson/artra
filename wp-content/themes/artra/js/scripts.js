
jQuery(document).ready(function($) {

	
	// Open external links in a new window
	$('a[rel*=external]').click(function(){
		window.open($(this).attr('href'));
		return false; 
	});

	
	// SlimMenu
	$('#menu-main-menu').slimmenu({
		resizeWidth: '800',
		animSpeed: 100
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

