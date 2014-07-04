<?php

$thumb_id = get_post_thumbnail_id();
if($thumb_id == ''){
	$thumb_url = get_template_directory_uri().'/images/feature_image.jpg';
} else{
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];	
}

while ( have_posts() ) : the_post();
	$content = get_the_content();
endwhile;
if($content == ''){
	$content = 'The smart choice in kitchens and cabinetry in Western Australia… Do it once. Do it right';
}
$trimmed_content = wp_trim_words( $content, 50 );

?>


<meta property="og:site_name" content="Artra">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<!--<meta property="fb:app_id" content="1504289089786438">-->
<meta property="og:title" content="<?php the_title() ?> - Artra">
<meta property="og:description" content="<?php print $trimmed_content; ?>">
<meta property="og:url" content="<?php print 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>">
<meta property="og:image" content="<?php print $thumb_url ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1920">
<meta property="og:image:height" content="300">