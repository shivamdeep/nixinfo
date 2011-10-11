<?php
/*
LAST UPDATED: 27th March 2011
EDITED BY: MARK FAIL
*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?></title>    
 
<?php wp_head(); ?> 
 
</head> 

<body <?php ppt_body_class(); ?>>

<div class="maintop">

<div id="header" class="full">        
        
            <div id="hpages">
            
                <ul>                	
                     
                 <?php echo $PPT->Pages(); ?>
                    
                <li><b><a href="<?php echo $GLOBALS['bloginfo_url']; ?>/" title="<?php bloginfo('name'); ?>"><?php echo SPEC($GLOBALS['_LANG']['_home']) ?></a></b></li>
                
                </ul>
            
            </div>
            
            <div class="clearfix"></div>
        
            <?php /*?><div class="f_half left" id="logo"> 
            
             <a href="<?php echo $GLOBALS['bloginfo_url']; ?>/" title="<?php bloginfo('name'); ?>">
             
			 	<img src="<?php echo $PPT->Logo(); ?>" alt="<?php bloginfo('name'); ?>" />
                
			 </a>
            
            </div>   <?php */?>     
        
            <div class="left padding5" id="banner"> 
            
           	 <?php echo $PPT->Banner("top"); ?>
             
            </div>        
        
        <div class="clearfix"></div>
        
        </div> 
		
        <div id="menudrop">
        
        <div style="width:970px; margin:0 auto;">
          
            <div class="full"> 
            
            <?php if(has_nav_menu('PPT-CUSTOM-MENU-PAGES')){ wp_nav_menu( array( 'theme_location' => 'PPT-CUSTOM-MENU-PAGES', 'depth'=>'1', 'before'=>'',  'after'=>'', 'menu_class' => 'menu' ) ); }else{ ?>
            
                <ul class="menu">  
                     <li><a href="http://webplanet.in/classified">Home</a></li>
                    <?php echo $ThemeDesign->LAY_NAVIGATION(); ?>         
                     
                </ul> 
                
             <?php } ?>   
             <div style="float:right; margin: 9px 5px 0 0;">
                <a href="<?php echo get_option('submit_url'); ?>" class="btnDownload_02"><strong><?php echo SPEC($GLOBALS['_LANG']['_side13']) ?></strong></a> 
                </div>
            </div> 
            
            </div>
            
        </div>

</div>

 
	<div class="wrapper w_960"> 
        

        <?php /*?><div class="full">
    
        
        <div id="submenubar"> 

       
            <form method="get"  action="<?php echo $GLOBALS['bloginfo_url']; ?>/" name="searchBox" id="searchBox">
              <table width="100%" border="0" id="SearchForm">
              <tr>
                <td><input type="text" value="<?php echo SPEC($GLOBALS['_LANG']['_head1']) ?>" name="s" id="s" onfocus="this.value='';"/></td>
                <td><select id="catsearch" name="cat"><option value="">---------</option><?php echo $PPT->CategoryList(); ?></select></td>
                <td><div class="searchBtn" onclick="document.searchBox.submit();"> &nbsp;</div> </td>
                <td ><?php if(get_option("display_advanced_search") ==1){ ?><div id="sadvanced"><a href="javascript:void();" onClick="jQuery('#AdvancedSearchBox').show();"><small><?php echo SPEC($GLOBALS['_LANG']['_head2']) ?></small></a></div><?php } ?></td>
              </tr>
            </table>
            </form>
     
             
            <ul class="submenu_account">            
            <?php  if ( $user_ID ){ ?>
            <li><a href="<?php echo wp_logout_url(); ?>" title="<?php echo SPEC($GLOBALS['_LANG']['_head3']) ?>"><?php echo SPEC($GLOBALS['_LANG']['_head3']) ?></a></li>
            <li><a href="<?php echo $GLOBALS['premiumpress']['dashboard_url']; ?>" title="<?php echo SPEC($GLOBALS['_LANG']['_head4']) ?>"><?php echo SPEC($GLOBALS['_LANG']['_head4']) ?></a></li>
            <li><b><?php echo $current_user->user_login; ?></b></li>
            <?php  }else{ ?>
            
            <li><a href="<?php echo $GLOBALS['bloginfo_url']; ?>/wp-login.php" title="<?php echo SPEC($GLOBALS['_LANG']['_head5']) ?>"><?php echo SPEC($GLOBALS['_LANG']['_head5']) ?></a> |  <a href="<?php echo $GLOBALS['bloginfo_url']; ?>/wp-login.php?action=register" title="<?php echo SPEC($GLOBALS['_LANG']['_head6']) ?>"><?php echo SPEC($GLOBALS['_LANG']['_head6']) ?></a></li>
            
            <?php } ?>
            </ul> 
        
         	<a href="<?php echo $GLOBALS['premiumpress']['submit_url']; ?>" id="submitButton" title="add classifieds"><img src="<?php echo $GLOBALS['template_url']; ?>/template_classifiedstheme/images/submitlisting.png" alt="add classifieds" /></a>
         
        </div>
        
        
        </div><?php */?>
        
 
		<div id="page" class="clearfix full">
        
        
        <?php if(get_option("display_advanced_search") ==1 ){  PPT_AdvancedSearch('preset-default');  } ?>
 
  
		<?php if(get_option("PPT_slider") =="s1"  && is_home() && !isset($_GET['s']) && !isset($_GET['search-class']) ){ echo $PPTDesign->SLIDER(); } ?> 
         
         
        
        <div id="content">


		<?php
 
            if(file_exists(str_replace("functions/","",THEME_PATH)."/themes/".$GLOBALS['premiumpress']['theme']."/_sidebar1.php") && !isset($GLOBALS['nosidebar']) && !isset($GLOBALS['nosidebar-left']) ){
            
                include(str_replace("functions/","",THEME_PATH)."/themes/".$GLOBALS['premiumpress']['theme']."/_sidebar1.php");
            
            }elseif($GLOBALS['premiumpress']['display_themecolumns'] =="3" && !isset($GLOBALS['nosidebar']) && !isset($GLOBALS['nosidebar-left']) ){
			
				include("_sidebar1.php");
			
			
			}
        
        ?>