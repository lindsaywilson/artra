<?php

/**

 * The template for displaying post page.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 * @package grater

 */



get_header(); ?> 



<div id="content" class="site-content width clear">



	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">



			<h1>News</h1>


			<?php while ( have_posts() ) : the_post(); ?>



			<div id="post-<?php the_ID(); ?>" class="post clearfix">

				<p class="date"><?php echo get_the_date("M j Y");?></p>

				<div class="postwrap">

					<h2><?php the_title(); ?></h2>

					<p><?php echo excerpt(36); ?></p>

					<p class="btn"><a href="<?php the_permalink(); ?>">read more</a></p>

				</div>

	        </div>



				<?php

					// If comments are open or we have at least one comment, load up the comment template

					if ( comments_open() || '0' != get_comments_number() ) :

						comments_template();

					endif;

				?>



			<?php endwhile; // end of the loop. ?>



		<?php posts_nav_link(); ?>



		</main><!-- #main -->

	</div><!-- #primary -->



<?php get_sidebar(); ?>



</div><!-- #content -->



<?php get_footer(); ?>

