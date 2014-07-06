<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package artra
 */
 $id = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(!is_front_page()): ?>
    <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    <?php endif; ?>

	<div class="entry-content">
		<?php 
			
			// Contact Page
			// Render Phone Number
			if($id == 84){
				$ph = get_field('phone_number');
				if( !empty($ph) ):
				?>
				<h2>Phone: <?php print $ph ?></h2>
				<?php endif;
			} ?>
			
            <div class="the-content">
            	<div class="inner">
					<?php the_content(); ?>
                </div>
            </div>
			
            <?php
			// Contact Page
			// Render Google Map
			if($id == 84){
				include get_template_directory(). '/inc/googlemap.php';
			}
			
			// Feedback form page
			// Output Feedback Form
			if($id == 64){
				//if (function_exists('user_submitted_posts')) user_submitted_posts();
				echo do_shortcode('[sf_form]');
			}
			
			// Feedback Page
			// Get all feedback posts by category
			if($id == 69){
				include get_template_directory(). '/inc/feedback.php';
			}	

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'artra' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'artra' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
