<?php 
/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/
if(!isset($GLOBALS['nosidebar'])){ get_sidebar(); } ?>
 
    </div> <!-- end CONTENT -->

</div> <!-- end SIDEBAR -->


</div>
 
 <div id="menudrop" style="border-bottom:1px solid #fff;">
        
        <div style="width:970px; margin:0 auto;">
          
            <div class="full"> 
            
            <?php if(has_nav_menu('PPT-CUSTOM-MENU-PAGES')){ wp_nav_menu( array( 'theme_location' => 'PPT-CUSTOM-MENU-PAGES', 'depth'=>'1', 'before'=>'',  'after'=>'', 'menu_class' => 'menu' ) ); }else{ ?>
            
                <ul class="menu">  
                        
                    <?php echo $ThemeDesign->LAY_NAVIGATION(); ?>         
                     
                </ul> 
                
             <?php } ?>   
             
            </div> 
            
            </div>
            
        </div>

    <div id="footer" class="clearfix full">
    
        <div class="w_960" style="margin:0 auto;"> 
        
            <div class="b_third_col col first_col" style="padding-left:15px;"> 
             <?php echo stripslashes(get_option("footer_text")); ?>
            </div> 
                            
            <?php $ArticleData = $PPT->Articles(10); if(strlen($ArticleData) > 5){ ?>
            <div class="b_third_col col"> 
                <h2 class="dotted adtitle">McCurtain County Sponsors</h2>         
                <!--<h3><?php //echo SPEC($GLOBALS['_LANG']['_rarticles']) ?></h3>-->                
                <ul class="recentarticles"><?php  if ( function_exists('myadmanager_show') ) myadmanager_show(); //echo $ArticleData; ?></ul>
            </div> 
            <?php } ?> 
                            
            <div class="b_third_col col last_col">                
               <br />
                <?php echo $PPT->Banner("footer");  ?>             
            </div> 
            
            
        <div class="clearfix"></div>
                        
        <div id="copyright" class="full">
            <p>&copy; <?php echo date("Y"); ?> <?php echo get_option("copyright"); ?> <?php $PPT->Copyright(); ?></p>
        </div> 
                        
    
    </div> 
        
 

</div>
 
 
<?php wp_footer(); ?>

 
</body>
</html>