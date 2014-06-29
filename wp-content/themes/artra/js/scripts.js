
jQuery(document).ready(function($) {
	
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
		$('.usp-images label').text('Upload a photo or your companies logo');
	}
	

})