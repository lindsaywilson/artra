
<?php

$title = get_field('promo_area_title');
$content = get_field('promo_area_content'); 
$image = get_field('promo_area_image'); 

if($title || $content || $image): ?>

<div id="promo-area">
	<div class="width clear <?php print ($content != '' || $title != '' ? 'content' : ''); ?> <?php print ($image ? 'image' : ''); ?>">
    
    	<?php if($title || $content): ?>
        	<div class="promo-text">
            	
                <?php if($title): ?>
                    <h1><?php print $title ?></h1>
                <?php endif; ?>
                
                <?php if($content): 
                        print $content;
                endif; ?>
                
            </div>
        <?php endif; ?>
        
        <?php if($image): ?>
        	<div class="promo-image">
            	<img src="<?php print $image['url']; ?>" />
            </div>
        <?php endif; ?>

    </div>
</div>

<?php endif; ?>