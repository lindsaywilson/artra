<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package artra
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0,">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'artra' ); ?></a>

	<header id="masthead" class="site-header width" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" /></a></h1>
		</div>
        <div id="social">
        	<a class="facebook" href="" title="facebook"></a>
            <a class="gplus" href="" title="gplus"></a>
            <a class="twitter" href="" title="twitter"></a>
        </div>
        <div id="ph" class="icon-phone-squared">0488 441 910</div>

	</header><!-- #masthead -->
    
    <nav id="site-navigation" class="main-navigation" role="navigation">
    <div class="inner width clear">
		<button class="menu-toggle"><?php _e( 'Primary Menu', 'artra' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</div>
    </nav><!-- #site-navigation -->
    
    <?php 
	
	if(is_front_page()): 
		
		print do_shortcode('[flexslider]');
		
	else:
		
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url = $thumb_url_array[0];	
	?>
    
    	<div id="header-image" style="background-image:url(<?php print $thumb_url; ?>);"></div>
    
    <?php endif; ?>
 
	<div id="content" class="site-content width clear">
