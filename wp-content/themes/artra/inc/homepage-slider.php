
<?php
 
/*
*  View array data (for debugging)
*/
//var_dump( get_field('header_slideshow_images') );
 
/*
*  Create the Markup for a slider
*  This example will create the Markup for Flexslider (http://www.woothemes.com/flexslider/)
*/
 
$images = get_field('header_slideshow_images');
 
if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li style="background-image:url(<?php echo $image['url']; ?>)">
                    <div class="width"><span class="caption"><?php echo $image['caption']; ?></span></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>