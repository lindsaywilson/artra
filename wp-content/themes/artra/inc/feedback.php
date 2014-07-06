<ul id="feedback">
  <?php    
	$args = array(
		'post_type' => 'feedback',
		'post_status' => 'publish'    
	  );   
	$feedback = get_posts( $args );
	foreach ( $feedback as $post ) : setup_postdata( $post ); 
		$name = get_the_title();
		$company = get_field('company');
		$state = get_field('state');
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
        <footer><?php print $name ?>, <?php print $company ?>, <?php print $state ?></footer>
      </blockquote>
    </div>
  </li>
  <?php
  endforeach; 
  wp_reset_postdata();?>
</ul>

<a href="/feedback-form" class="btn">Submit Feedback</a>