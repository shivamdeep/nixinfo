<?php
/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/
?>
<div class="f_half left">

	<div class="gut">
		
        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></h3>
		
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		  <img src="<?php echo $PPT->Image($post->ID,"url"); ?>&amp;w=250" alt="<?php the_title(); ?>" class="galleryImage" title="<?php the_title(); ?>"/>
		  </a>
        
        <p><?php the_excerpt(); ?></p>     
    
    </div>

</div>

<?php if($i%2){ ?><div class="clearfix"></div><?php } ?> 