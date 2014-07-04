
<?php
 
/*
*  View array data (for debugging)
*/
//var_dump( get_field('gallery_images') );
 
/*
*  Create the Markup for a slider
*  This example will create the Markup for Flexslider (http://www.woothemes.com/flexslider/)
*/

$title = get_field('gallery_title');
$images = get_field('gallery_images'); 

if($title): ?>

<div class="title-block">
	<div class="width">
    	<h3><?php print $title ?></h3>
    </div>
</div>

<?php
endif;


if( $images ): ?>

<div id="gallery-images">
    <div class="width">
        <div id="gallery" class="flexslider">
            <ul class="slides">
                <?php foreach( $images as $image ): ?>
                    <li>
                    	<?php if($image['caption']): ?>
                       	<a href="<?php print $image['caption'] ?>">
                        <?php endif; ?>
                        	<img src="<?php echo $image['url']; ?>" />
                        <?php if($image['caption']): ?>
                       	</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php endif; ?>