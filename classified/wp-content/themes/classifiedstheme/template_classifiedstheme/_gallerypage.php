<?php
 
get_header();

// Load the total number of search results found
if(isset($post->ID) && $post->ID != "" && !isset($_GET['s']) ){
	$allsearch = &new WP_Query($query_string);
}else{
	$allsearch = &new WP_Query($query_string."&showposts=-1");
}
 ?>

<div class="middleSidebar left"> 


	<h1 class="categoryTitle"><?php if(isset($_GET['s'])){ ?> <?php echo "Search: ".strip_tags($_GET['s']); ?> <?php }else{ echo $GLOBALS['premiumpress']['catName']; } ?></h1>
 
    <?php /*------------------------- ORDER BY BOX DISPLAY ----------------------------*/ ?>   
    
	<?php if($allsearch->post_count > 0 && $post->post_type  !="article_type" && $post->post_type  !="faq_type" ){ echo $PPTDesign->GL_ORDERBY(); } ?>	
    
    <br /><div class="clearfix"></div>
    
    <em><?php echo $allsearch->post_count; ?> <?php echo SPEC($GLOBALS['_LANG']['_gal1']) ?></em>    
    
	
    <?php /*------------------------- CUSTOM CATEGORY TEXT AND IMAGE ----------------------------*/ ?>   
        
        <?php if(strlen($GLOBALS['catText']) > 1){ ?>
        
        <div class="customCatText" style="padding:10px; padding-left:0px;">
        
        <?php if(strlen($GLOBALS['catImage']) > 2){ ?><img src="<?php echo $GLOBALS['catImage']; ?>" style="float:left; padding-right:20px;" /><?php } ?>
                
        <?php echo $GLOBALS['catText']; ?>
        
        </div>
            
    <?php } ?>        
        
    <div class="clearfix"></div>
        
        
          	
    <?php /*------------------------- DISPLAY GALLERY BLOCK ----------------------------*/ ?>
        
    <div id="SearchContent">  <br /> <div class="clearfix"></div> 
         
	<?php $PPTDesign->GALLERYBLOCK(); ?>
 
	<?php /*NO RESULTS FOUND*/
    
    if(count($posts) == 0 && !is_home()){ ?>
   
    <p><?php echo SPEC($GLOBALS['_LANG']['_gal3']) ?></p>
    
    <p><?php wp_tag_cloud('smallest=15&largest=40&number=50&orderby=count'); ?></p>
    
    <?php } ?> 
    
    </div>
    
    
    <?php /*------------------------- PAGE NAVIGATION BLOCK ----------------------------*/ ?>   
 
    <div class="clearfix"> </div><br />
    
	<?php if($allsearch->post_count > 0){ ?>
    
        <ul class="pagination paginationD paginationD10"> 
           
            <?php echo $PPTFunction->PageNavigation(); ?>
             			 
        </ul>
        
	<?php } ?>
 
	<div class="clearfix"> </div><br />
 
	<?php /*------------------------- LEFT ADVERTING BLOCK FOR 2 COLUMN LAYOUTS ----------------------------*/ ?>    

    
	<?php if($GLOBALS['premiumpress']['display_themecolumns'] !="3"){ if(get_option("advertising_left_checkbox") =="1"){ echo "<br /><br />".$PPT->Banner("left"); } } ?>
 
    

</div>

<?php get_footer(); ?>