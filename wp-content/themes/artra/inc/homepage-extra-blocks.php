

<?php

 



if( have_rows('extra_content_blocks') ):

 



    while ( have_rows('extra_content_blocks') ) : the_row(); 

	

	$title = get_sub_field('title');

	$content = get_sub_field('content'); 

	$image = get_sub_field('image'); 

	$background = get_sub_field('background_color'); 
	
	$align = get_sub_field('image_alignment'); 
	

	?>

 



<div class="extra-block <?php print $align ?>" style="background-color:<?php print $background; ?>">

	<?php if($title): ?>

    <div class="title-block">

        <div class="width">

            <h3><?php print $title ?></h3>

        </div>

    </div>

    <?php endif; ?>

	<div class="width clear <?php print ($content != '' ? 'with-content' : ''); ?> <?php print ($image ? 'with-image' : ''); ?>" >

  

    	<?php if($title || $content): ?>

        	<div class="content">

                <?php 

					if($content){ 

                        print $content;

					}

				?>  

            </div>

        <?php endif; ?>

        

        <?php if($image): ?>

        	<div class="image">

            	<img src="<?php print $image['url']; ?>" />

            </div>

        <?php endif; ?>



    </div>

</div>



<?php 



    endwhile;



endif;

 

?>







