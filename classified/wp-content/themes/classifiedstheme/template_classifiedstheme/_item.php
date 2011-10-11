<?php
/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/
?>
<div class="itembox <?php if($i%2){ print "even"; } ?> <?php if(get_post_meta($post->ID, "featured", true) == "yes"){?>hightlighted<?php }else{ ?><?php } ?>">
    
     
 
        <div class="itemboxinner">    
    
            <div class="post clearfix"> 
                                          
                <div class="thumbnail-large"> 
                
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php echo $PPT->Image($post->ID,"url"); ?>&amp;w=180&amp;h=128" class="listImage" alt="<?php the_title(); ?>" />
                    </a> 
                    
                 	<div class="info">
                    
						<?php echo $PPT->Price(get_post_meta($post->ID, "price", true),$GLOBALS['premiumpress']['currency_symbol'],$GLOBALS['premiumpress']['currency_position'],1);  ?>
                <?php if(function_exists('wp_gdsr_render_article')){ wp_gdsr_render_article(5);}  ?> 
               		</div>   
                    
                </div> 
                
               
                <div class="text"> 
                
                	<h1 class="noIcon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                
                    <?php the_excerpt(); ?>
                    
                    <div class="tags clearfix"> <?php the_tags( '', '', ''); ?></div>
                
                    <div class="meta clearfix"> 
					
                           <a href="<?php the_permalink(); ?>"><?php echo $GLOBALS['_LANG']['_mored']; ?></a> 
            		 
            				<?php if(get_option("display_search_comments") =="yes"){ comments_popup_link($GLOBALS['_LANG']['_nocomments'], $GLOBALS['_LANG']['_1comment'], '% '.$GLOBALS['_LANG']['_comments']); } ?>
                            
                            
                    
                    </div> 
                    
                </div>
            
            </div> 
     
    
        </div>
    
</div>