<?php 

 
 

global $PPT,$PPTDesign;
PremiumPress_Header(); ?>

<div id="premiumpress_box1" class="premiumpress_box premiumpress_box-100"><div class="premiumpress_boxin"><div class="header">
<h3><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/h-ico/GeneralPreferences.png" align="middle"> Display Setup</h3>							 
<ul>
	<li><a rel="premiumpress_tab1" href="#" class="active">Layout</a></li>
	<li><a rel="premiumpress_tab6" href="#">Home</a></li>
	<li><a rel="premiumpress_tab2" href="#">Search</a></li>
    <li><a rel="premiumpress_tab3" href="#">Sidebar</a></li>
    <li><a rel="premiumpress_tab4" href="#">Listing</a></li> 
 
     <li><a rel="premiumpress_tab5" href="#">Sliders</a></li>     
</ul>
</div>
<style>
select { border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; }
</style>
 

<div id="DisplayImages" style="display:none;"></div><input type="hidden" id="searchBox1" name="searchBox1" value="" />

<form method="post" name="classifiedstheme" target="_self" >
<input name="admin_page" type="hidden" value="classifiedstheme_setup" />

<input name="submitted" type="hidden" value="yes" />
<input name="setup" type="hidden" value="1" />
<input name="featured" type="hidden" value="1" />
<input name="featured1" type="hidden" value="1" />
<input name="listbox" type="hidden" value="yes" />

<div id="premiumpress_tab1" class="content">
<table class="maintable" style="background:white;">

<tr class="mainrow"><td></td><td class="forminp">

<b>Select theme layout (2 or 3 columns)</b>

<table width="100%" border="1">
  <tr>
    <td style="width:150px;"><img src="<?php echo $GLOBALS['template_url']; ?>/PPT/img/layout2.gif" /><br /><center>
    <input name="display_themecolumns" type="radio" value="2" <?php if(get_option("display_themecolumns") =="2" || get_option("display_themecolumns") =="" ){ print "checked";} ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
    <td style="width:150px;"><img src="<?php echo $GLOBALS['template_url']; ?>/PPT/img/layout3.gif" /><br /><center>
    <input name="display_themecolumns" type="radio" value="3" <?php if(get_option("display_themecolumns") =="3"){ print "checked";} ?>  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
 
    
    </td>
  </tr>
</table> 

	 
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a22.png"></td></tr>



<tr class="mainrow"><td colspan="3">
<center><a href="widgets.php"><img src="<?php echo $GLOBALS['template_url']; ?>/template_classifiedstheme/images/help1/a23.png"></a></center>
</td> <tr>



  
  <?php /***************************************** */ ?>

<tr class="mainrow"><td></td>
<td class="forminp">
<p><b>Footer Text</b></p>
<textarea name="adminArray[footer_text]" type="text" style="width:240px;height:150px;"><?php echo stripslashes(get_option("footer_text")); ?></textarea><br />
<small>This will be added to the bottom of your website.</small>
        
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a16.png"></td></tr>
  
 <?php /***************************************** */ ?> 
  







<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>

</table>
</div>

<div id="premiumpress_tab6" class="content">
<table class="maintable" style="background:white;">

 

 
 
 
 
 <tr class="mainrow"><td></td><td class="forminp">

<b>Home Page Layout (1 or 2 columns)</b>

<table width="100%" border="1">
  <tr>
    <td style="width:150px;"><img src="<?php echo $GLOBALS['template_url']; ?>/PPT/img/layout1.gif" /><br /><center>
    <input name="display_homecolumns" type="radio" value="1" <?php if(get_option("display_homecolumns") =="1" || get_option("display_homecolumns") =="" ){ print "checked";} ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
    <td style="width:150px;"><img src="<?php echo $GLOBALS['template_url']; ?>/PPT/img/layout2.gif" /><br /><center>
    <input name="display_homecolumns" type="radio" value="2" <?php if(get_option("display_homecolumns") =="2"){ print "checked";} ?>  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
 
    
    </td>
  </tr>
</table> 

	 
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c6.png"></td></tr>
 
 
 
 
 
 
 
 
   <?php /***************************************** */ ?>

<tr class="mainrow"><td></td>
<td class="forminp">
<p><b>Home Page Text</b></p>
<textarea name="adminArray[homepage_text]" type="text" style="width:240px;height:150px;"><?php echo stripslashes(get_option("homepage_text")); ?></textarea><br />
<small>This will be added to front page of your webiste.</small>
        
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a16.png"></td></tr>
  
 <?php /***************************************** */ ?> 
  

 
 
 
 
 

<tr class="mainrow"><td></td><td class="forminp">

        <b>Home Page Image</b>
        
        <p style="width: 240px;"><input type="checkbox" class="checkbox" name="display_featured_image_enable" value="1" <?php if(get_option("display_featured_image_enable") =="1"){ print "checked";} ?> /> Enable Featured Image</p><br />
        <small>Add your own image to the front page</small>
       <?php if(get_option("display_featured_image_enable") =="1"){ ?> 
        
        <b>Featured Image URL</b><br />
        
        <input name="adminArray[display_featured_image_url]" type="text" style="width: 240px;  font-size:14px;" value="<?php echo get_option("display_featured_image_url"); ?>" /><br />
		<small>Enter the full URL for the image you would like to display.</small>
        
        
        <br /><b>Featured Image Link URL</b><br />
        
		<input name="adminArray[display_featured_image_link]" type="text" style="width: 240px;  font-size:14px;" value="<?php echo get_option("display_featured_image_link"); ?>" /><br />
		<small>Enter the link you would like to have when someone clicks on the image.</small>

		<?php } ?>
	 
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a0.png"></td></tr>

<?php /***************************************** */ ?>

<tr class="mainrow"><td></td><td class="forminp">

<p><b>Categories Box</b></p>
<select name="adminArray[display_homecats]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_homecats") =="yes"){ print "selected";} ?>>Show</option>
				<option value="no" <?php if(get_option("display_homecats") =="no"){ print "selected";} ?>>Hide</option>
		  </select><br />
			<small>Show/Hide the home page categories area.</small> 

</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c2.png"></td></tr>
    
    
<?php /***************************************** */ ?>

<?php if(get_option("display_homecats") =="yes"){ ?>
    
    <tr class="mainrow"><td></td><td class="forminp">
    
    <p><b>Order Categories By </b></p>
    <select name="adminArray[display_homecats_orderby]" style="width: 240px;  font-size:14px;">
    
                    <option value="id" <?php if(get_option("display_homecats_orderby") =="id"){ print "selected";} ?>>ID (Ascending Order)</option>
                    <option value="id&order=desc" <?php if(get_option("display_homecats_orderby") =="id&order=desc"){ print "selected";} ?>>ID (Descending Order)</option>
                    
                    <option value="name" <?php if(get_option("display_homecats_orderby") =="name"){ print "selected";} ?>>Name (Ascending Order)</option>
                    <option value="name&order=desc" <?php if(get_option("display_homecats_orderby") =="name&order=desc"){ print "selected";} ?>>Name (Descending Order)</option>
                    
                    <option value="slug" <?php if(get_option("display_homecats_orderby") =="slug"){ print "selected";} ?>>Slug (Ascending Order)</option>
                    <option value="slug&order=desc" <?php if(get_option("display_homecats_orderby") =="slug&order=desc"){ print "selected";} ?>>Slug (Descending Order)</option>
    
                    <option value="count" <?php if(get_option("display_homecats_orderby") =="count"){ print "selected";} ?>>Count (Ascending Order)</option>
                    <option value="count&order=desc" <?php if(get_option("display_homecats_orderby") =="count&order=desc"){ print "selected";} ?>>Count (Descending Order)</option>
    
                    <option value="group" <?php if(get_option("display_homecats_orderby") =="group"){ print "selected";} ?>>Group (Ascending Order)</option>
                    <option value="group&order=desc" <?php if(get_option("display_homecats_orderby") =="group&order=desc"){ print "selected";} ?>>Group (Descending Order)</option>
                       
                                    
          </select><br />
                <small>select in what order to display the categories.</small> 
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a2.png"></td></tr>
    
        
    <?php /***************************************** */ ?>
        
        <tr class="mainrow">
             <td></td>
            <td class="forminp">
            <p><b>Display Sub Categories</b></p>			
                <select name="adminArray[display_50_subcategories]" style="width: 240px;  font-size:14px;">
                    <option value="yes" <?php if(get_option("display_50_subcategories") =="yes"){ print "selected";} ?>>Show</option>
                    <option value="no" <?php if(get_option("display_50_subcategories") =="no"){ print "selected";} ?>>Hide</option>
                </select><br />
                <small>Show/Hide the list of sub categories under the main category link.</small> 
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a3.png"></td></tr>
         
 
 
 
         
<?php } ?>

 



        <tr class="mainrow">
             <td></td>
            <td class="forminp">
            <p><b>New Listings Tab</b></p>			
                <select name="adminArray[display_tabs_new]" style="width: 240px;  font-size:14px;">
                    <option value="yes" <?php if(get_option("display_tabs_new") =="yes"){ print "selected";} ?>>Show</option>
                    <option value="no" <?php if(get_option("display_tabs_new") =="no"){ print "selected";} ?>>Hide</option>
                </select><br />
                <small>Show/Hide the new listings tab on the home page.</small> 
                
                Display <input name="adminArray[display_tabs_new_num]" type="text" style="width: 40px;" maxlength="3" value="<?php echo get_option("display_tabs_new_num"); ?>" /> Classifieds
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c1.png"></td></tr>
         

 
         <tr class="mainrow">
             <td></td>
            <td class="forminp">
            <p><b>Popular Listings Tab</b></p>			
                <select name="adminArray[display_tabs_pop]" style="width: 240px;  font-size:14px;">
                    <option value="yes" <?php if(get_option("display_tabs_pop") =="yes"){ print "selected";} ?>>Show</option>
                    <option value="no" <?php if(get_option("display_tabs_pop") =="no"){ print "selected";} ?>>Hide</option>
                </select><br />
                <small>Show/Hide the popular listings tab on the home page.</small> <br />
                
                 Display <input name="adminArray[display_tabs_pop_num]" type="text" style="width: 40px;" maxlength="3" value="<?php echo get_option("display_tabs_pop_num"); ?>" /> Classifieds
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c3.png"></td></tr>
    
    
    
        <tr class="mainrow">
             <td></td>
            <td class="forminp">
            <p><b>Random Listings Tab</b></p>			
                <select name="adminArray[display_tabs_rnd]" style="width: 240px;  font-size:14px;">
                    <option value="yes" <?php if(get_option("display_tabs_rnd") =="yes"){ print "selected";} ?>>Show</option>
                    <option value="no" <?php if(get_option("display_tabs_rnd") =="no"){ print "selected";} ?>>Hide</option>
                </select><br />
                <small>Show/Hide the random listings tab on the home page.</small> <br />
                
                 Display <input name="adminArray[display_tabs_rnd_num]" type="text" style="width: 40px;" maxlength="3" value="<?php echo get_option("display_tabs_rnd_num"); ?>" /> Classifieds
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c4.png"></td></tr>     
  
  
  
  
  
  


        <tr class="mainrow">
             <td></td>
            <td class="forminp">
            <p><b>Image Scroller</b></p>			
                <select name="adminArray[display_home_scroller]" style="width: 240px;  font-size:14px;">
                    <option value="yes" <?php if(get_option("display_home_scroller") =="yes"){ print "selected";} ?>>Show</option>
                    <option value="no" <?php if(get_option("display_home_scroller") =="no"){ print "selected";} ?>>Hide</option>
                </select><br />
                <small>Show/Hide the new home page scroller which shows all 'featured' classifieds.</small> 
                
       
                
    </td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/c5.png"></td></tr>  
  
  
  
  
  
  	<tr class="mainrow">
		<td class="titledesc" valign="top">Home Page Icons <br.<br> <small>Enter your own image link to replace the existing icon with your own one. Icons are displayed in the order they are shown on your website, ie.1,2,3,4...</small></td>
		<td class="forminp">
        
        
  <table width="100%" border="1">
  
  
  	<tr>
    <td><img src="<?php if(get_option("home_icon_1") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h1.png <?php }else{ echo get_option("home_icon_1"); } ?>" /></td>
    <td><input name="adminArray[home_icon_1]" type="text" value="<?php echo get_option("home_icon_1"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
   	<tr>
    <td><img src="<?php if(get_option("home_icon_2") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h2.png <?php }else{ echo get_option("home_icon_2"); } ?>" /></td>
    <td><input name="adminArray[home_icon_2]" type="text" value="<?php echo get_option("home_icon_2"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
      	<tr>
    <td><img src="<?php if(get_option("home_icon_3") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h3.png <?php }else{ echo get_option("home_icon_3"); } ?>" /></td>
    <td><input name="adminArray[home_icon_3]" type="text" value="<?php echo get_option("home_icon_3"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
    <tr>
    <td><img src="<?php if(get_option("home_icon_4") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h4.png <?php }else{ echo get_option("home_icon_4"); } ?>" /></td>
    <td><input name="adminArray[home_icon_4]" type="text" value="<?php echo get_option("home_icon_4"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
    <tr>
    <td><img src="<?php if(get_option("home_icon_5") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h5.png <?php }else{ echo get_option("home_icon_5"); } ?>" /></td>
    <td><input name="adminArray[home_icon_5]" type="text" value="<?php echo get_option("home_icon_5"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>   
    
    
    
      	<tr>
    <td><img src="<?php if(get_option("home_icon_6") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h6.png <?php }else{ echo get_option("home_icon_6"); } ?>" /></td>
    <td><input name="adminArray[home_icon_6]" type="text" value="<?php echo get_option("home_icon_6"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
   	<tr>
    <td><img src="<?php if(get_option("home_icon_7") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h7.png <?php }else{ echo get_option("home_icon_7"); } ?>" /></td>
    <td><input name="adminArray[home_icon_7]" type="text" value="<?php echo get_option("home_icon_7"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
      	<tr>
    <td><img src="<?php if(get_option("home_icon_8") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h8.png <?php }else{ echo get_option("home_icon_8"); } ?>" /></td>
    <td><input name="adminArray[home_icon_8]" type="text" value="<?php echo get_option("home_icon_8"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
    <tr>
    <td><img src="<?php if(get_option("home_icon_9") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h9.png <?php }else{ echo get_option("home_icon_9"); } ?>" /></td>
    <td><input name="adminArray[home_icon_9]" type="text" value="<?php echo get_option("home_icon_9"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
    <tr>
    <td><img src="<?php if(get_option("home_icon_10") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h10.png <?php }else{ echo get_option("home_icon_10"); } ?>" /></td>
    <td><input name="adminArray[home_icon_10]" type="text" value="<?php echo get_option("home_icon_10"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>   
    
    
      
      	<tr>
    <td><img src="<?php if(get_option("home_icon_11") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h11.png <?php }else{ echo get_option("home_icon_11"); } ?>" /></td>
    <td><input name="adminArray[home_icon_11]" type="text" value="<?php echo get_option("home_icon_11"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
    
   	<tr>
    <td><img src="<?php if(get_option("home_icon_12") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h12.png <?php }else{ echo get_option("home_icon_12"); } ?>" /></td>
    <td><input name="adminArray[home_icon_12]" type="text" value="<?php echo get_option("home_icon_12"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
      

   	<tr>
    <td><img src="<?php if(get_option("home_icon_13") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h13.png <?php }else{ echo get_option("home_icon_13"); } ?>" /></td>
    <td><input name="adminArray[home_icon_13]" type="text" value="<?php echo get_option("home_icon_13"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_14") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h14.png <?php }else{ echo get_option("home_icon_14"); } ?>" /></td>
    <td><input name="adminArray[home_icon_14]" type="text" value="<?php echo get_option("home_icon_14"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_15") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h15.png <?php }else{ echo get_option("home_icon_15"); } ?>" /></td>
    <td><input name="adminArray[home_icon_15]" type="text" value="<?php echo get_option("home_icon_15"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_16") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h16.png <?php }else{ echo get_option("home_icon_16"); } ?>" /></td>
    <td><input name="adminArray[home_icon_16]" type="text" value="<?php echo get_option("home_icon_16"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_17") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h17.png <?php }else{ echo get_option("home_icon_17"); } ?>" /></td>
    <td><input name="adminArray[home_icon_17]" type="text" value="<?php echo get_option("home_icon_17"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_18") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h18.png <?php }else{ echo get_option("home_icon_18"); } ?>" /></td>
    <td><input name="adminArray[home_icon_18]" type="text" value="<?php echo get_option("home_icon_18"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_19") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h19.png <?php }else{ echo get_option("home_icon_19"); } ?>" /></td>
    <td><input name="adminArray[home_icon_19]" type="text" value="<?php echo get_option("home_icon_19"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>
       	<tr>
    <td><img src="<?php if(get_option("home_icon_20") == ""){ echo $GLOBALS['template_url']."/template_classifiedstheme/images/"; ?>h20.png <?php }else{ echo get_option("home_icon_20"); } ?>" /></td>
    <td><input name="adminArray[home_icon_20]" type="text" value="<?php echo get_option("home_icon_20"); ?>" style="width: 400px;  font-size:14px;" /></td>
  	</tr>    
    
	</table>
    
    
  
  

  
 

 

 

<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>
</table>

 

 
 
</div>            










<div id="premiumpress_tab2" class="content">
<table class="maintable" style="background:white;">
 



    
    
<tr class="mainrow"><td></td><td class="forminp">

		<p><b>Search Display Style</b></p>
		<select name="adminArray[display_liststyle]" style="width: 240px;  font-size:14px;">
          <option value="list" <?php if(get_option("display_liststyle") =="list"){ print "selected";} ?> >List View</option>
          <option value="gal" <?php if(get_option("display_liststyle") =="gal"){ print "selected";} ?>>Gallery View</option>
        </select>
          <br />
          <small>Select your display view. </small>
          
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a11.png"></td></tr>

  <?php /***************************************** */ ?> 


 

<tr class="mainrow"><td></td><td class="forminp">

		<p><b>Show Comments</b></p>
		<select name="adminArray[display_search_comments]" style="width: 240px;  font-size:14px;">
          <option value="yes" <?php if(get_option("display_search_comments") =="yes"){ print "selected";} ?> >Yes</option>
          <option value="no" <?php if(get_option("display_search_comments") =="no"){ print "selected";} ?>>No</option>
        </select>
          <br />
          <small>Show/Hide the comments box on the search pages. </small>
          
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a12.png"></td></tr>     


 
 
 
 
<tr>
<td colspan="4"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>

</table>
</div>


<div id="premiumpress_tab3" class="content">
<table class="maintable" style="background:white;">



<?php /***************************************** */ ?> 
 


 	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b>Display Recent Articles</b></p>						
			<select name="adminArray[display_sidebar_articles]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_sidebar_articles") =="yes"){ print "selected";} ?>>Show</option>
				<option value="no" <?php if(get_option("display_sidebar_articles") =="no"){ print "selected";} ?>>Hide</option>
			</select><br /><small>Show/Hide the sidebar articles box.</small> <br />
			<input name="adminArray[display_sidebar_articles_count]" value="<?php echo get_option("display_sidebar_articles_count"); ?>" class="txt" style="width:50px; font-size:14px;" type="text"> # Articles


</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a7.png"></td></tr>
    
 <?php /***************************************** */ ?> 
 

   
 
	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b>Display Categories</b></p>			
				
			<select name="adminArray[display_categories]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_categories") =="yes"){ print "selected";} ?>>Show</option>
                <?php if(get_option("display_themecolumns") =="3"){ ?><option value="yesleft" <?php if(get_option("display_categories") =="yesleft"){ print "selected";} ?>>Show - Left Sidebar</option><?php } ?>
				<option value="no" <?php if(get_option("display_categories") =="no"){ print "selected";} ?>>Hide</option>
                
			</select><br />
            
            <p><b>Display on which pages</b></p>
 
            <select name="adminArray[display_categories_pages]" style="width: 240px;  font-size:14px;">
				<option value="0" <?php if(get_option("display_categories_pages") =="0"){ print "selected";} ?>>All Pages</option>
				<option value="no-single" <?php if(get_option("display_categories_pages") =="no-single"){ print "selected";} ?>>All BUT Single Pages</option>
                <option value="no-home" <?php if(get_option("display_categories_pages") =="no-home"){ print "selected";} ?>>All BUT Home Page</option>
                <option value="no-page" <?php if(get_option("display_categories_pages") =="no-page"){ print "selected";} ?>>All BUT Pages</option>
                <option value="no-listing" <?php if(get_option("display_categories_pages") =="no-listing"){ print "selected";} ?>>All BUT Listing Page</option>
			</select><br />
			<small>Show/Hide the category box on the right menu.</small>  

</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a8.png"></td></tr>
    
 <?php /***************************************** */ ?> 



 	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b>Display Tabbed Categories</b></p>			
			<select name="adminArray[display_tabbed_cats]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_tabbed_cats") =="yes"){ print "selected";} ?>>Yes</option>
				<option value="no" <?php if(get_option("display_tabbed_cats") =="no"){ print "selected";} ?>>No</option>
			</select><br />
			<small>Turn on/off the tabbed categories in the right menu.</small> 
             
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a9.png"></td></tr>




    
 <?php /***************************************** */ ?> 
 

	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b>Display Categories Count (Inner Section)</b></p>			
			<select name="adminArray[display_categories_count_inner]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_categories_count_inner") =="yes"){ print "selected";} ?>>Show</option>
				<option value="no" <?php if(get_option("display_categories_count_inner") =="no"){ print "selected";} ?>>Hide</option>
			</select><br />
			<small>Show/Hide the category count showing how many items are within each category on the inner page sections.</small>  


</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a10.png"></td></tr>
  
  

    


<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>

</table>

 

</div>




 

<div id="premiumpress_tab4" class="content">
<table class="maintable" style="background:white;">

 
 
 
  	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b>Display Listing Information</b></p>			
			<select name="adminArray[display_listinginfo]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_listinginfo") =="yes"){ print "selected";} ?>>Yes</option>
				<option value="no" <?php if(get_option("display_listinginfo") =="no"){ print "selected";} ?>>No</option>
			</select><br />
			<small>Turn on/off the listing info box display on the listing page.</small> 
             
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a24.png"></td></tr>

 
 
 
 	<tr class="mainrow">
		 <td></td>
		<td class="forminp">
		<p><b> Display Comments Box</b></p>			
				
			
			<select name="adminArray[display_single_comments]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_single_comments") =="yes"){ print "selected";} ?>>Show</option>
				<option value="no" <?php if(get_option("display_single_comments") =="no"){ print "selected";} ?>>Hide</option>
			</select><br />
			<small>Show/Hide the members comments box area at the bottom of the page.</small> 
            
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a20.png"></td></tr>    
 
    
     <?php /***************************************** */ ?> 
     
<tr class="mainrow"><td></td><td class="forminp">

		<p><b>Display Social Booking Tools</b></p>			
			<select name="adminArray[display_social]" style="width: 240px;  font-size:14px;">
				<option value="yes" <?php if(get_option("display_social") =="yes"){ print "selected";} ?>>Show</option>
				<option value="no" <?php if(get_option("display_social") =="no"){ print "selected";} ?>>Hide</option>
			</select><br />
			<small>Show/Hide the social booking tools powered by <a href="http://www.addthis.com" target="_blank">Add This</a></small>  


</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a18.png"></td></tr>     
     
     
      <?php /***************************************** */ ?> 
    

<tr class="mainrow"> <td></td><td class="forminp">

		<p><b> Google Maps Box</b></p>			
				
			
			<select name="adminArray[display_googlemaps]" style="width: 240px;  font-size:14px;">
				<option value="yes1" <?php if(get_option("display_googlemaps") =="yes1"){ print "selected";} ?>>Show - IFrame Map</option>
				<option value="yes2" <?php if(get_option("display_googlemaps") =="yes2"){ print "selected";} ?>>Show - Interactive Map</option>
                <option value="no" <?php if(get_option("display_googlemaps") =="no"){ print "selected";} ?>>Hide Google Maps</option>
			</select><br />
			<small><b>Remember</b>Google maps will only display for listings that have a map_location custom field value entered. The interative map requires long/Lat coordinates and isnt recommended for unexperienced users.</small>
            
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a19.png"></td></tr>    
    
    
      <?php /***************************************** */ ?> 
     
    
  
<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>  

</table>
</div>






<div id="premiumpress_tab5" class="content">

<table class="maintable" style="background:white;">


<?php /***************************************** */ ?> 


<tr class="mainrow"> <td></td><td class="forminp">

		<p><b> Enable Slider </b></p>			
				
			
			<select name="adminArray[PPT_slider]" style="width: 240px;  font-size:14px;">
				<option value="off" <?php if(get_option("PPT_slider") =="off"){ print "selected";} ?>>Disable All Sliders</option> 
                <option value="s1" <?php if(get_option("PPT_slider") =="s1"){ print "selected";} ?>>Featured Content Slider (Full Width)</option> 
                <option value="s2" <?php if(get_option("PPT_slider") =="s2"){ print "selected";} ?>>Half Content Slider (Full Width)</option> 
			</select><br />
			<small>Here you can choose which slider to enable on your website.</small>
            
            <br />
            
            <select name="adminArray[PPT_slider_items]" style="width: 240px;  font-size:14px;">
				<option value="manual" <?php if(get_option("PPT_slider_items") =="manual"){ print "selected";} ?>>Manually Configure Slides</option> 
                <option value="featured" <?php if(get_option("PPT_slider_items") =="featured"){ print "selected";} ?>>Use Featured Posts</option>  
			</select><br />
            
            
</td><td class="forminp"><img src="<?php echo IMAGE_PATH; ?>/help1/a21.png"></td></tr>  


<?php /***************************************** */ ?> 

<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="<?php _e('Save changes','cp')?>" style="color:white;" /></p></td>
</tr>  
</table>


</form>	





<div id="PPT-sliderbox"></div>
<div id="PPT-sliderboxAdd" style="margin-left:20px;display:none">
 
 
  
 
 <form method="post" target="_self" >
<input name="admin_slider" type="hidden" value="slider" />

 
 <input type="hidden" id="ppsedit" value="0">
 <table width="100%" border="0">
  <tr>
  
    <td valign="top"><b>Slider Title</b> <br /> <input type="text" name="s1" id="pps1"  style="width: 200px;  font-size:14px;" class="txt" /> </td>
    <td><b>Title Description</b> <small>(max. 10 words)</small> <br /> <textarea name="s3" id="pps3" style="width: 200px;  font-size:14px; height:70px;" class="txt"></textarea> </td>
    <td><b>Main Description</b> <small>(max. 250 words)</small> <br /> <textarea name="s4" id="pps4" style="width: 200px;  font-size:14px; height:70px;" class="txt"></textarea></td>
  </tr>
  
  <tr>
    <td><b>Slider Image</b> <br/> <input type="text" name="s2" id="pps2"  style="width: 200px;  font-size:14px;" class="txt" />
     <p><a href='javascript:void(0);' onClick="toggleLayer('DisplayImages'); add_image_next(0,'<?php echo get_option("imagestorage_path"); ?>','<?php echo get_option("imagestorage_link"); ?>','pps2');"><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/led-ico/find.png" align="middle"> View Uploaded Images</a> <br/><br/><a href="admin.php?page=images" target="_blank"><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/led-ico/monitor.png" align="middle"> Upload Image </a>	</p>	
    </td>
    <td valign="top"><b>Slider Clickable Link</b> <br /> <input type="text" name="s5" id="pps5"  style="width: 200px;  font-size:14px;" class="txt" value="http://" /> </td>
    <td valign="top"><b>Display Order</b><br /><select id="pps6" name="s6" style="width: 100px;  font-size:14px;"><?php $i=1; while($i<20){ echo '<option>'.$i.'</option>'; $i++; } ?></select></td>
  </tr>

<tr>
<td colspan="3"><p><input class="premiumpress_button" type="submit" value="Create New Slide" style="color:white;" /></p></td>
</tr>
</table>

</form> 
 
 </div>
 
 
<div id="addBtn1" style="display:visible"><a href="javascript:void();" onClick="jQuery('#PPT-sliderboxAdd').show();jQuery('#addBtn1').hide();" class="premiumpress_button" style=" float:right; margin-right:10px;" >Add Slider Item</a></div>

<h2 style="margin-left:10px;">Website Slider Items</h2>
<p style="margin-left:10px;">Here you can setup and create new items for your website slider.</p> 

     
 <?php  $sliderData = get_option("slider_array");   if(is_array($sliderData) && count($sliderData) > 0 ){  ?>


  
					  
					      <table id="ct"><thead><tr id="ct_sort">
                          
                          <th width="90" class="first">Title</th>
                          <th width="100">Short Description</th>
                          <th width="40"class="last">Display Order</th> 
                          <th width="40"class="last">Actions</th>
                          
                          </tr></thead><tbody>
                          <?php 
						  
						  $sortedSlider = $PPTDesign->array_sort($sliderData, 'order', SORT_ASC);
						  
						  $i=-1; foreach($sortedSlider as $hh => $slide){   ?>                          
                          
                          
                          <tr id="srow<?php echo $i; ?>">
                          
                          <td width="90" class="first"><?php echo $slide['s1']; ?></td>
					      <td width="80"><?php echo $slide['s3']; ?></td>   
                           <td width="50"><?php echo $slide['order']; ?></td>                          
                          <td width="80" class="last">
                          
                          <a href='#' Onclick="EditsliderItem('<?php echo $hh; ?>');jQuery('#PPT-sliderbox').show();" style="padding:5px; background:#dcffe1; border:1px solid #57b564; color:green;"><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/led-ico/find.png" align="middle"> Edit &nbsp;&nbsp;</a> 
                          
                          - <a href='#' Onclick="DeleteSliderItem('<?php echo $hh; ?>');jQuery('#PPT-sliderbox').show();jQuery('#srow<?php echo $i; ?>').hide();" style="padding:5px; background:#ffb9ba; border:1px solid #bd2e2f; color:red;"><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/led-ico/delete.png" align="middle"> Delete&nbsp;</a></td>
                          
                          </tr>
                          
                          
                          <?php $i++; } ?>
                          
                          
                         </tbody> </table>
                         
<br />
<form method="post" target="_self" >
<input name="admin_slider" type="hidden" value="reset" />
<input class="premiumpress_button" type="submit" value="Reset Slider (Delete All Slides)" style="color:white;" />
</form>                    
<?php } ?>


 

</div>
 
 
 </div>