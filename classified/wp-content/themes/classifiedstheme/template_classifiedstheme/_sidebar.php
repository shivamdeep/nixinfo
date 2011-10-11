<?php

/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/
?>
<div id="sidebar" class="rightSidebar left">

<?php if(get_option('advertising_right_checkbox') =="1"){ ?><center><?php echo $PPT->Banner("right");?></center><?php } ?>  

<?php if(isset($GLOBALS['tpl-add'])){ ?>

    <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-sidebar-add"><?php echo SPEC($GLOBALS['_LANG']['_side1']) ?></h2>
        
        <div class="itemboxinner">
        
            <?php echo nl2br(stripslashes(get_option("pak_help_text"))); ?>
        
        </div>    
    
    </div> 
    
    

<?php }elseif(is_single() ||   isset($GLOBALS['premiumpress']['taxonomy']) && ( $GLOBALS['premiumpress']['taxonomy'] =="article" || $GLOBALS['premiumpress']['taxonomy'] =="faq" ) ){ ?>

<?php if($post->post_type =="article_type" || $post->post_type =="faq_type" || ( isset($GLOBALS['premiumpress']['taxonomy']) && $GLOBALS['premiumpress']['taxonomy'] == "article" || isset($GLOBALS['premiumpress']['taxonomy']) && $GLOBALS['premiumpress']['taxonomy'] =="faq" ) ){ 

	if($GLOBALS['premiumpress']['taxonomy'] == "article"){
	$tty = $GLOBALS['premiumpress']['taxonomy'];
	}else{
	$tty = $GLOBALS['premiumpress']['taxonomy'];
	}	
	if($tty == ""){ $tty="article"; }

	$taxonomy     = str_replace("_type","",$tty);
	$orderby      = 'name'; 
	$show_count   = 1;      // 1 for yes, 0 for no
	$pad_counts   = 1;      // 1 for yes, 0 for no
	$hierarchical = 1;      // 1 for yes, 0 for no
	$title        = '';
	$fcats 		  = '';
	
	$args = array(
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title,
	  'hide_empty'	=> 0
	);
 
	?>
    <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-sidebar-singleinfo"><?php echo SPEC($GLOBALS['_LANG']['_categories']) ?></h2>
        
        <div class="itemboxinner nopadding">
        
        	<ul class="category" id="Accordion">
        
			<?php 
            $cats  = get_categories( $args );
            foreach($cats as $cat){   $fcats .= $cat->cat_ID.",";
            
                        
            print '<li><a href="'.get_term_link( $cat,$cat->taxonomy  ).'" title="'.$cat->category_nicename.'">'.$cat->cat_name.'</a></li>';
        
              }
            ?>
            </ul>
    
    	</div>
    
    </div>
    
    

  <?php if(function_exists('dynamic_sidebar')){ dynamic_sidebar('Right Sidebar - Article Page'); } ?>
  
  
  <?php }else{ ?>
  
  
  
  
  
  	<?php if($GLOBALS['error'] !=1 && strlen($GLOBALS['amazon_link']) < 1  ){ ?>
      <div class="itembox">
    
        <h2 id="icon-single-contact"><?php echo SPEC($GLOBALS['_LANG']['_side3']) ?></h2>  
        
        <div class="itemboxinner contactForm">    
            
    <form action="" method="post" onsubmit="return CheckMessageData(this.message_name.value,this.message_subject.value,this.message_message.value,'Please complete all fields.');"> 
    <input type="hidden" name="action" value="sidebarcontact" />
    <input type="hidden" name="message_name" value="<?php echo the_author_meta('login'); ?>" />
    <input type="hidden" name="author_ID" value="<?php echo get_the_author_id() ?>" />
    
    <?php wp_nonce_field('ContactForm') ?>
    
    
    <fieldset style="background:transparent;"> 
                             
        <div class="full clearfix border_t box"> 
        <p class="f_half left"> 
            <label for="name"><?php echo SPEC($GLOBALS['_LANG']['_sidef1']) ?> <span class="required">*</span></label><br />
            <input type="text" name="message_from" id="message_name"  class="short" tabindex="1" /><br />
             
        </p> 
        <p class="f_half left"> 
            <label for="email"><?php echo SPEC($GLOBALS['_LANG']['_sidef2']) ?> <span class="required">*</span></label><br /> 
            <input type="text" name="message_subject" id="message_subject" class="short" tabindex="2" /><br /> 
            
        </p> 
        </div> 
 
              
        <div class="full clearfix border_t box"> 
        <p>
            <label for="comment"><?php echo SPEC($GLOBALS['_LANG']['_sidef3']) ?> <span class="required">*</span></label><br /> 
            <textarea tabindex="4" class="long" rows="4" name="message_message" id="message_message"></textarea> 
            <small><?php echo SPEC($GLOBALS['_LANG']['_sidef4']) ?></small>          
        </p>
        </div>   
        
        <?php $email_nr1 = rand("0", "9");$email_nr2 = rand("0", "9"); ?>
        <div class="full clearfix border_t box"> 
         
            <label for="name"><?php echo SPEC(str_replace("%a",$email_nr1,str_replace("%b",$email_nr2,SPEC($GLOBALS['_LANG']['_single10'])))) ?></span></label><br /> 
            <input type="text" name="code" value="" class="long" tabindex="1" /><br /> 
            <input type="hidden" name="code_value" value="<?php echo $email_nr1+$email_nr2; ?>" />
         
         </div>               
        
        <div class="full clearfix border_t box"> 
        <p class="full clearfix"> 
            <input type="submit" name="submit" id="submit" class="button blue" tabindex="15" value="<?php echo SPEC($GLOBALS['_LANG']['_sidef5']) ?>" />  
        </p> 
        </div>	
    
    </fieldset> 
    </form>
           
           
		</div>
 
	</div> 
  <?php } ?>
  
  
  
  



<?php if(get_option("display_listinginfo") =="yes"){ ?>

    <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-sidebar-singleinfo"><?php echo SPEC($GLOBALS['_LANG']['_side2']) ?></h2>
        
        <div class="itemboxinner">
        
        <a href="<?php echo get_author_posts_url( $post->post_author, $post->user_nicename ); ?>" title="<?php echo get_the_author(); ?>">
		<?php if(function_exists('userphoto') && userphoto_exists($post->post_author)){ echo userphoto($post->post_author); }else{ echo get_avatar($post->post_author,52); } ?>
        </a>
        
        <h3><?php the_author_posts_link(); ?></h3> 
            
        <p><?php the_author_meta('description'); $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = ".$post->post_author." AND post_type IN ('post') and post_status = 'publish'" ); ?></p> 
        
        <div class="full box clearfix"> 
      <p><img src="<?php echo IMAGE_PATH; ?>icon1.png" alt="send email" align="middle" /> <a href="<?php echo get_author_posts_url( $post->post_author, $post->user_nicename ); ?>" title="<?php echo get_the_author(); ?>">
		<?php echo SPEC(str_replace("%a",get_the_author(),str_replace("%b",$count,$GLOBALS['_LANG']['_side3']))) ?>
        </a></p>
        <p><img src="<?php echo IMAGE_PATH; ?>icon2.png" alt="send email" align="middle" /> <a href="<?php echo get_option("messages_url"); ?>/?u=<?php the_author(); ?>"><?php echo SPEC(str_replace("%a",get_the_author(),$GLOBALS['_LANG']['_side4'])) ?></a></p>
        </div> 
        
         <em><?php echo SPEC($GLOBALS['_LANG']['_side5']) ?> <?php the_time('l, F jS, Y') ?></em>  

        
        </div>    
    
    </div> 
    
<?php } ?>    
    
    
    <?php  if(isset($GLOBALS['mapType']) && strlen($GLOBALS['mapType']) > 2  && $GLOBALS['mapType'] !="no" && strlen($GLOBALS['map']) > 1) {  ?>
    
      <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-single-map"><?php echo SPEC($GLOBALS['_LANG']['_side7']) ?></h2>  
        
        <div class="itemboxinner">    
            
           <?php if($GLOBALS['mapType'] == "yes1"){  ?>   
            
            
            <iframe id="GoogleMap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  style="width:240px; height:230px;"
            src="http://maps.google.com/maps/api/staticmap?zoom=15&size=240x230&markers=color:red|label:Here|<?php echo $GLOBALS['map']; ?>&sensor=false&key=<?php echo get_option("google_maps_api"); ?>">
            </iframe> 
         
            
            <?php }elseif($GLOBALS['mapType'] == "yes2"){ ?>
            
   
			<div id="map_sidebar2"></div> 

            
            <?php }   ?>
 
		</div>
 
	</div>    
 
	<?php } ?>
    
    
    
    
    
   
    
    
 <?php } ?>   
     
    
<?php }else{ ?>
 

    
	


    <?php if(isset($GLOBALS['premiumpress']['catID']) && is_numeric($GLOBALS['premiumpress']['catID']) && $PPT->CountCategorySubs($GLOBALS['premiumpress']['catID']) > 0 && get_option('display_categories') =="yes" ){ ?>
    
    <div class="itembox">
    
        <h2 id="sidebar-cats-sub"><?php echo SPEC($GLOBALS['_LANG']['_subcategories']) ?></h2>
        
        <div class="itemboxinner nopadding">
        
        <?php echo $ThemeDesign->SideCategories(); ?>
        
        </div>
    
    
    </div>
        
    <?php } ?>

    
	<?php if(get_option('display_categories') =="yes" && $PPTDesign->CanDisplayElement(get_option("display_categories_pages"))  ){ ?> 
    
    
    
    <div class="itembox" style="margin-top:20px;">
    
        <h2 id="sidebar-cats"><?php echo $GLOBALS['_LANG']['_categories']; ?></h2>
        
        <div class="itemboxinner nopadding">
        
            <ul class="category" id="Accordion">
            
            <?php echo CategoryNavigation(); ?>
            
            </ul>
        
        </div>    
    
    </div>    
                       
 
    <?php  } ?> 
    
    
    
    
    
    
   <?php /*?> <?php if(is_home()){ ?>
    
     <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-sidebar-radded"><?php echo SPEC($GLOBALS['_LANG']['_side15']) ?></h2>
        
        <div class="itemboxinner nopadding">
        <ul class="homeFeaturedList">
        
        <?php
			 
		 $FeaturedListings  = query_posts('numberposts=5&order=DESC&orderby=ID&showposts=1&post_type=post');
		foreach ($FeaturedListings as $featured) : 
			  
			 echo '<li>';
			 
			 if(strlen($PPT->Image($featured->ID,"url")) > 5){ 
				echo '<a href="'.get_permalink($featured->ID).'" title="'.$featured->post_title.'"><img src="'.$PPT->Image($featured->ID,"url").'&amp;w=80" alt="'.$post->post_title.'" /></a>';
			  }

			  echo '<h3><a href="'.get_permalink($featured->ID).'" title="'.$featured->post_title.'>">'.$featured->post_title.'</a></h3>';
			  
			  echo '<div class="price">'.$PPT->Price(get_post_meta($featured->ID, "price", true),$GLOBALS['premiumpress']['currency_symbol'],$GLOBALS['premiumpress']['currency_position'],1)."</div>";  
			  
			 echo '<p>'.substr($featured->post_excerpt,0,170).'..</p>';
			  
			  
			  
			  
			  echo '</li>';
			  endforeach; wp_reset_query(); 
                
            
			 ?>
            </ul>
        </div>    
    
    </div>    
    
    <?php } ?><?php */?>
    
    
    
    
    <?php if(get_option("display_sidebar_articles") =="yes"){ ?>
    
    <div class="itembox" style="margin-top:20px;">
    
        <h2 id="icon-sidebar-article"><?php echo SPEC($GLOBALS['_LANG']['_side12']) ?></h2>
        
        <div class="itemboxinner">
        
        	<ul id="sidebar_recentarticle">
            <?php echo $PPT->Articles(get_option('display_sidebar_articles_count'),true); ?>
        	</ul>
            
        </div>    
    
    </div> 
    
    <?php } ?>

    
   
<?php } ?> 


<?php 	
	
/****************** INCLUDE WIDGET ENABLED SIDEBAR *********************/

if(function_exists('dynamic_sidebar')){ 

	if(is_single() && !isset($GLOBALS['ARTICLEPAGE']) ){
	dynamic_sidebar('Listing Page Sidebar');
	}elseif(is_single() && isset($GLOBALS['ARTICLEPAGE']) ){
	dynamic_sidebar('Article/FAQ Page Sidebar');
	}elseif(is_page()){
	dynamic_sidebar('Pages Sidebar') ;
	}else{
	dynamic_sidebar('Right Sidebar');  
	}

}

/****************** end/ INCLUDE WIDGET ENABLED SIDEBAR *********************/

?>

<?php 		
			
			if(isset($GLOBALS['premiumpress']['catID']) && is_numeric($GLOBALS['premiumpress']['catID'])){ 					
				echo $PPT->BannerZone($GLOBALS['premiumpress']['catID']); 					
			}
?>
    

  
</div>
 