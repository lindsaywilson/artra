<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package artra
 */
?>

	</div><!-- #content -->

	<footer id="footer" class="site-footer" role="contentinfo">
    <div class="inner width">
		<div class="widget">
			<?php if ( dynamic_sidebar( 'footer' ) ) : ?>
            <?php endif; // end footer widget area ?>
		</div><!-- .site-info -->
	</div>
    </footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
