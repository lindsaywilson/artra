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
      <blockquote>
      	"<?php print wp_filter_nohtml_kses($content); ?>"
        <footer><?php the_title(); ?></footer>
      </blockquote>
    </div>
  </li>
  <?php
  endforeach; 
  wp_reset_postdata();?>
</ul>

<a href="/feedback-form" class="btn">Submit Feedback</a>