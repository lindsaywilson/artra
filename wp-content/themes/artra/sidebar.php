<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package artra
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		
		<?php 
			if($id == 84){
				
				print '<h2>Contact form:</h2>';
				print do_shortcode('[contact-form-7 id="88" title="Contact"]');
				
			} else{
				
				dynamic_sidebar( 'sidebar-1' );
				
			}
		?>
        
	</div><!-- #secondary -->
