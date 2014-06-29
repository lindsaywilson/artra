<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package artra
 */
?>

	<footer id="footer" class="site-footer" role="contentinfo">
    <div class="inner width">
		<div class="widget clear">
			<?php dynamic_sidebar( 'footer' ) ?>
		</div>
        <span class="cyberstart"></span>
        <span class="copy">&copy; <?php print date('Y'); ?> ARTRA</span>
        <!-- .site-info -->
	</div>
    </footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
