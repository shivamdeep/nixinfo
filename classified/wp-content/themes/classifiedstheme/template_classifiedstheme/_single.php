<?php 

/**************** CLAIM LISTING RESULTS *******************/

if(isset($GLOBALS['claimlisting_result'])){
 
	if($GLOBALS['claimlisting_result']){
	
	$GLOBALS['error'] 		= 1;
	$GLOBALS['error_type'] 	= "success";
	$GLOBALS['error_msg'] 	= "This listing has successfully been updated and is now listed under your account.";
	}else{
	$GLOBALS['error'] 		= 1;
	$GLOBALS['error_type'] 	= "error";
	$GLOBALS['error_msg'] 	= "This listing could not be claimed because the email addresss on file does not match the one on your account.";
	
	}

}
$GLOBALS['user_info'] 		= get_userdata($post->post_author);
$GLOBALS['claim_email'] 	= get_post_meta($post->ID, 'email', true);
/**************** CLAIM LISTING RESULTS *******************/


get_header();

// SETUP GLOBAL VALUES FROM CUSTOM DATA
$GLOBALS['images'] 		= get_post_meta($post->ID, 'images', true);
$GLOBALS['map'] 		= get_post_meta($post->ID, "map_location", true);

// GET THE WEBSITE LINK
$link 				= get_post_meta($post->ID, "link", true);
$url 				= get_post_meta($post->ID, "customurl", true);
if($url ==""){$url 		= get_post_meta($post->ID, "url", true);}
if($link == ""){ $link=$url; }
$pos = strpos($url, 'http://'); if ($pos === false && $url != "") {		$url = "http://".$url;		}

// CHECK IF THIS IS AN AMAON ITEM
$GLOBALS['amazon_link'] 			= get_post_meta($post->ID, "amazon_link", true);



if (have_posts()) : while (have_posts()) : the_post();  ?>

<div class="col b1 first_col"> 



<?php echo $PPTDesign->GL_ALERT($GLOBALS['error_msg'],$GLOBALS['error_type']); ?>
 

    <div class="append clearfix" id="SinglePageTop"> 
    
        <div class="thumbnail-large"> 
     
           <img src="<?php echo $PPT->Image($post->ID,"url"); ?>&amp;w=180&amp;h=128" width="180" height="128" alt="<?php the_title(); ?>" />
           
            <div class="info"><?php if(function_exists('wp_gdsr_render_article')){ wp_gdsr_render_article(5);}  ?></div>
           
        </div>     <br />
        
        <h1><?php the_title(); ?> </h1> 
        
        <div class="price"><?php echo $PPT->Price(get_post_meta($post->ID, "price", true),$GLOBALS['premiumpress']['currency_symbol'],$GLOBALS['premiumpress']['currency_position'],1);  ?></div>
        
        <div class="excerpt"><?php the_excerpt(); ?></div>
       
        <?php if(get_option("display_social") =="yes"){ ?>
        
          	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=premiumpress"></script>
			 <div class="addthis_toolbox">
				<div class="hover_effect">
					<div><a class="addthis_button_email"> &nbsp;</a></div>
					<div><a class="addthis_button_print"> &nbsp;</a></div>
					<div><a class="addthis_button_twitter">&nbsp;</a></div>
					<div><a class="addthis_button_facebook">&nbsp;</a></div>
					<div><a class="addthis_button_myspace">&nbsp;</a></div>
					<div><a class="addthis_button_digg">&nbsp;</a></div>
					<div><a class="addthis_button_expanded">&nbsp;</a></div>
					<div style="clear:both; float:none;"></div> 
				</div>
			</div>
         <?php } ?>
            
       
        </div> 
         
 
 
<form action="" method="post" name="ClaimListing" id="ClaimListing">
<input type="hidden" name="action" value="claimlisting" /> 
<input type="hidden" name="postID" value="<?php echo $post->ID; ?>" /> 
</form>       

		   
    
		<div class="clearfix"></div>

        <ul class="tabs"> 
        
            <li><a href="#info" id="icon-single-info"><?php echo SPEC($GLOBALS['_LANG']['_single3']) ?></a></li> 
            
            <?php if(strlen($GLOBALS['images']) > 4){ ?><li><a href="#gallery" id="icon-single-images"><?php echo SPEC($GLOBALS['_LANG']['_single4']) ?></a></li><?php } ?>
            
            <?php if(get_option("display_single_comments") =="yes"){ ?><li><a href="#comments" id="icon-single-comment">
			<?php  comments_number($GLOBALS['_LANG']['_nocomments'], $GLOBALS['_LANG']['_1comment'], '% '.$GLOBALS['_LANG']['_comments']); ?></a></li>			
            <?php  } ?> 
            
        </ul> 
    
    
    <div class="tab_container"> 
    
      <div id="info" class="tab_content entry">
      
      
          <?php if(strlen($GLOBALS['amazon_link']) > 1){ ?>		  
          <a href="<?php echo $PPT->AffiliateLink($GLOBALS['amazon_link'] ,$post->ID) ?>" rel="nofollow" target="_blank"><img src="<?php echo IMAGE_PATH; ?>amazon.gif" style="float:right" alt="buy now"/></a>
          <?php } ?>
      
         <?php the_content(); ?>
          
          <p><?php the_tags('Tags:'); ?></p> 
          
          <?php $ThemeDesign->SINGLE_CUSTOMFIELDS($post,$CustomFields); ?>         
          
      </div> 
        
        
        <div id="gallery" class="tab_content">                
                     
            <h2><?php echo SPEC($GLOBALS['_LANG']['_single6']) ?></h2>
        
            <?php echo $ThemeDesign->SINGLE_IMAGEGALLERY($GLOBALS['images']); ?>
    
    	</div>
         
        
        <div id="comments" class="tab_content">                
    
    		<?php comments_template();  ?>
    
    	</div> 
         
    </div>    
          

</div>  
		
			
 <?php get_sidebar(); ?>	
 
 <?php endwhile; else :  endif; ?>
 


<div class="clearfix"></div>  


<?php get_footer(); ?>