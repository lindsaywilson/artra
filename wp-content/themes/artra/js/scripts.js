
jQuery(document).ready(function($) {
	
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

})