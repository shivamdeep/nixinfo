<?php 
/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/ 

$STYLEHOME = get_option("display_homecolumns"); if(get_option("display_homecolumns") =="1"){ $GLOBALS['nosidebar']=1;  }  $GLOBALS['nosidebar-left']=1;


function IconCSS(){

	$ICON1 = get_option("home_icon_1");
	$ICON2 = get_option("home_icon_2");
	$ICON3 = get_option("home_icon_3");
	$ICON4 = get_option("home_icon_4");
	$ICON5 = get_option("home_icon_5");
	$ICON6 = get_option("home_icon_6");
	$ICON7 = get_option("home_icon_7");
	$ICON8 = get_option("home_icon_8");
	$ICON9 = get_option("home_icon_9");
	$ICON10 = get_option("home_icon_10");
	$ICON11 = get_option("home_icon_11");
	$ICON12 = get_option("home_icon_12");
	$ICON13 = get_option("home_icon_13");
	$ICON14 = get_option("home_icon_14");
	$ICON15 = get_option("home_icon_15");
	$ICON16 = get_option("home_icon_16");
	$ICON17 = get_option("home_icon_17");
	$ICON18 = get_option("home_icon_18");
	$ICON19 = get_option("home_icon_19");
	$ICON20 = get_option("home_icon_20");
	
	?>
    
    <style type='text/css'>
	
	<?php if(strlen($ICON1) > 1){ ?>#icon1 { background:url(<?php echo $ICON1; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON2) > 1){ ?>#icon2 { background:url(<?php echo $ICON2; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON3) > 1){ ?>#icon3 { background:url(<?php echo $ICON3; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON4) > 1){ ?>#icon4 { background:url(<?php echo $ICON4; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON5) > 1){ ?>#icon5 { background:url(<?php echo $ICON5; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON6) > 1){ ?>#icon6 { background:url(<?php echo $ICON6; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON7) > 1){ ?>#icon7 { background:url(<?php echo $ICON7; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON8) > 1){ ?>#icon8 { background:url(<?php echo $ICON8; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON9) > 1){ ?>#icon9 { background:url(<?php echo $ICON9; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON10) > 1){ ?>#icon10 { background:url(<?php echo $ICON10; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON11) > 1){ ?>#icon11 { background:url(<?php echo $ICON11; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON12) > 1){ ?>#icon12 { background:url(<?php echo $ICON12; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON13) > 1){ ?>#icon13 { background:url(<?php echo $ICON13; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON14) > 1){ ?>#icon14 { background:url(<?php echo $ICON14; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON15) > 1){ ?>#icon15 { background:url(<?php echo $ICON15; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON16) > 1){ ?>#icon16 { background:url(<?php echo $ICON16; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON17) > 1){ ?>#icon17 { background:url(<?php echo $ICON17; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON18) > 1){ ?>#icon18 { background:url(<?php echo $ICON18; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON19) > 1){ ?>#icon19 { background:url(<?php echo $ICON19; ?>) no-repeat 3px 1px; } <?php } ?>
	<?php if(strlen($ICON20) > 1){ ?>#icon20 { background:url(<?php echo $ICON20; ?>) no-repeat 3px 1px; } <?php } ?>

	</style>
    
    <?php

}

function extraCSS(){
print "<style type='text/css'>.middleSidebar {width: 63%;}.rightSidebar {width: 35.5%; }</style>";
}





// Load the icon CSS
add_filter('wp_head','IconCSS');

// Load extra CSS for 2 column layouts
if($STYLEHOME == 2){
add_filter('wp_head','extraCSS');
} 



get_header(); ?>

   <?php if(get_option("display_home_scroller") =="yes"){ ?>



<div id="style<?php echo $STYLEHOME; ?>_wrapper"><div id="style<?php echo $STYLEHOME; ?>" class="style<?php echo $STYLEHOME; ?>">
<h2>Featured Listings</h2>

<div class="previous_button"></div><div class="container"><ul>

    <?php
	$postslist = query_posts('meta_key=featured&posts_per_page=12');	 
	foreach ($postslist as $post ){  ?>
	<li>
	<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>">
		<img src="<?php echo $PPT->Image($post,"url"); ?>&amp;w=120&amp;h=90" width="120" height="90" style="cursor:pointer;" alt="<?php echo $post->post_title ?>" />
	</a>
	<div><?php echo $post->post_title ?> <br /> <em class="price"><?php echo $PPT->Price(get_post_meta($post->ID, "price", true),$GLOBALS['premiumpress']['currency_symbol'],$GLOBALS['premiumpress']['currency_position'],1); ?></em> </div>
	</li>
	<?php }  ?>	

</ul></div><div class="next_button"></div></div>
</div>

<script src="<?php echo PPT_PATH; ?>js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="<?php echo PPT_PATH; ?>js/jquery.jcarousellite_1.0.1.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(function() {    jQuery(".style<?php echo $STYLEHOME ; ?>").jCarouselLite({        btnNext: ".next_button",        btnPrev: ".previous_button",		visible: <?php if($STYLEHOME == 2){ echo 4;}else{ echo 5;} ?>,		scroll: 1, auto:2000 }); });
</script>
<div class="clearfix"></div>


<?php } ?> 



<div <?php if( $STYLEHOME =="2"){ ?>class="middleSidebar left"<?php } ?>>



<?php /*--------------------------------------------------------------------- */ ?>

    
<?php if(get_option("PPT_slider") =="s2" ){  $GLOBALS['s2'] =1;echo $PPTDesign->SLIDER(2); } ?>
    
<?php echo stripslashes(get_option("homepage_text")); ?>

<?php 

/*--------------------------------------------------------------------- */ 


//if(get_option("display_featured_image_enable") =="1"){ print "<a href='".get_option("display_featured_image_link")."'><img src='".get_option("display_featured_image_url")."'  /></a>"; } ?>

 

<?php  if($STYLEHOME == 2){ $POSTCOUNT = 6; }else{ $POSTCOUNT = 8; } ?>


<?php if(get_option("display_homecats") =="yes"){ ?>
<div class="custom_cat">
<div class="shadowblock">
	<h2 class="dotted"><?php echo SPEC($GLOBALS['_LANG']['_homepage1']) ?></h2>
    <div class="directory"><?php echo $ThemeDesign->HomePageCategories($STYLEHOME); ?><div class="clr"></div></div>
</div>
</div> 
<?php } ?>
<div id="homeTabs">

	<ul class="tabs1">
		<?php if(get_option("display_tabs_new") =="yes"){ ?><li><a href="#tab-1"><?php echo SPEC($GLOBALS['_LANG']['_homepage2']) ?></a></li><?php } ?> 
		<?php if(get_option("display_tabs_pop") =="yes"){ ?><li><a href="#tab-2"><?php echo SPEC($GLOBALS['_LANG']['_homepage3']) ?></a></li><?php } ?> 
		<?php if(get_option("display_tabs_rnd") =="yes"){ ?><li><a href="#tab-3"><?php echo SPEC($GLOBALS['_LANG']['_homepage4']) ?></a></li><?php } ?> 
	</ul>
    
       
	<?php if(get_option("display_tabs_new") =="yes"){ ?><div id="tab-1" class="tab_content"><ul><?php echo homepage_list(1,get_option("display_tabs_new_num")); ?></ul><div class="clearfix"></div></div><?php } ?> 
	<?php if(get_option("display_tabs_pop") =="yes"){ ?><div id="tab-2" class="tab_content"><ul><?php echo homepage_list(2,get_option("display_tabs_pop_num")); ?></ul><div class="clearfix"></div></div><?php } ?> 
	<?php if(get_option("display_tabs_rnd") =="yes"){ ?><div id="tab-3" class="tab_content"><ul><?php echo homepage_list(3,get_option("display_tabs_rnd_num")); ?></ul><div class="clearfix"></div></div><?php } ?> 
<div class="clearfix"></div>
</div>

 <script type="text/javascript"> 
 
jQuery(document).ready(function() {
 
	//Default Action
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs1 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	jQuery("ul.tabs1 li").click(function() {
		jQuery("ul.tabs1 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
		
	});
 
});
</script>
 
























 




























    



 
 


	 
 
 


</div> 


 
<?php get_footer(); ?> 