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
			the_content();
			
			
			// Feedback form page
			// Output Feedback Form
			if($id == 64){
				if (function_exists('user_submitted_posts')) user_submitted_posts();
			}
			
			// Feedback Page
			// Get all feedback posts by category
			if($id == 69):
		?>
				
			<ul id="feedback">
			<?php
            
            $args = array( 'category' => 3 );
            
            $feedback = get_posts( $args );
            foreach ( $feedback as $post ) : setup_postdata( $post ); 
			$content = get_the_content();
			?>
                <li class="clear">
                	<div class="feedback-image">
                	<?php
						if ( has_post_thumbnail() ) {
						  the_post_thumbnail();
						}
					?>
                    </div>
                    <div class="feedback-content">
                        <div class="feedback">"<?php print wp_filter_nohtml_kses($content); ?>"</div>
                        <div class="author"><?php the_title(); ?></div>
                    </div>
                </li>
            <?php endforeach; 
            wp_reset_postdata();?>
            
            </ul>	
            
            <a href="/feedback-form" class="btn">Submit Feedback</a>
				
		<?php
			endif;		

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
