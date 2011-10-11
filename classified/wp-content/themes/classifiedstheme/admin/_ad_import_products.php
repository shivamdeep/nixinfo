

<?php


 
	require_once (TEMPLATEPATH ."/PPT/class/class_datafeedr.php");
		
	$PPTDatafeedr			= new PremiumPressTheme_Datafeedr;
	
	if(isset($_GET['action']) && $_GET['action'] == "datafeedr"){
	
	$dd = explode("-",$PPTDatafeedr->IMPORTPRODUCTS());
	
	$GLOBALS['error'] 		= 1;
	$GLOBALS['error_type'] 	= "ok"; //ok,warn,error,info
	$GLOBALS['error_msg'] 	= "Datafeedr Update Successful. Added (".$dd[0].") / Updated (".$dd[1].")"; 
	
	}
	
	
	if(isset($_GET['action']) && $_GET['action'] == "amazon-debug"){
	
	if(!isset($PPTImport)){
	require_once (TEMPLATEPATH ."/PPT/class/class_import.php");
	$PPTImport 		= new PremiumPressTheme_Import;
	}
	$PPTImport->AmazonAutoUpdaterTool();
	die();
	
	}
 	
	 

?>

<?php if (!defined('PREMIUMPRESS_SYSTEM')) {	header('HTTP/1.0 403 Forbidden'); exit; }  global $PPT,$PPTDesign; PremiumPress_Header(); ?>

<?php 
 

if(isset($GLOBALS['ebaysearch'])){
  
	include("importtools/_ebay_results.php");	

}elseif(isset($GLOBALS['amazonsearch'])){ 
 
	include("importtools/amazon_results.php");	

}else{


function iscurlinstalled() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	}
	else{
		return false;
	}
}

if (iscurlinstalled()){ }else{  die("The <a href='http://en.wikipedia.org/wiki/CURL' targe='_blank'>cURL</a> function used to connect to Amazon is NOT installed on your hosting account, please contact your hosting provider to enable this."); }

?>




<div id="premiumpress_box1" class="premiumpress_box premiumpress_box-100"><div class="premiumpress_boxin"><div class="header">
<h3><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/h-ico/refresh.png" align="middle"> Import Tools</h3>	 <a class="premiumpress_button" href="javascript:void(0);" onclick="PPHelpMe()">Help Me</a> 						 
<ul>
	
	<li><a rel="premiumpress_tab1" href="#" class="active">Amazon</a></li>
    <li><a rel="premiumpress_tab2" href="#">Ebay</a></li>
    <?php if(strtolower(constant('PREMIUMPRESS_SYSTEM')) == "shopperpress" ){ ?>
    <li><a rel="premiumpress_tab3" href="#">Datafeedr</a></li>
    <?php } ?>
    <li><a rel="premiumpress_tab4" href="#">Affiliate ID's</a></li>
    
</ul>
</div>

<style>
select { border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; }
</style>

<div id="premiumpress_tab1" class="content">


<?php if(get_option("affiliates_20_ID") == ""){ ?>


<table class="maintable" style="background:white;">
<tr class="mainrow"><td></td><td class="forminp" valign="top">

            <div class="msg msg-info">
             <p>You have NOT yet set your Amazon affiliate ID, enter your ID below.</p>
            </div>
            <form method="post" name="ShopperPress" target="_self">
            <input name="submitted" type="hidden" value="yes" />
            # <input name="adminArray[affiliates_20_ID]" type="text" style="width:100px" value="<?php echo get_option("affiliates_20_ID"); ?>" />
            <input class="premiumpress_button" type="submit" value="Save" />
            </form>
</td></tr></table>
<?php }else{ ?>

            <form method="post" target="_self" <?php if(isset($GLOBALS['startsearch'])){ ?>style="display:none;"<?php } ?>>			
            <input type="hidden" name="feed" value="1">
            
            
            
             
             
            
            <table class="maintable" style="background:white;">
            
            
            <tr class="mainrow"><td></td><td class="forminp" valign="top">
            
            <p><b>Search Keyword</b></p>
            <input name="amazon[keyword]" class="txt" type="text" style="width: 260px; font-size:14px; background:#D9F9D8;">
            <br><small>Enter a keyword above to search the Amazon website for related products. Use quotations for more accurate results, eg. "golf bag"</small><br />
             
             
           <p><b>Amazon Store</b></p>
             
            <select name="amazon[country]" style="font-size:14px; width:260px;">
            <option value="com" selected>United States (.com Store)</option>
            <option value="ca">Canada (.ca Store)</option>
            <option value="co.uk">United Kingdom (.co.uk Store)</option>
            <option value="fr">France (.fr Store)</option>
            <option value="de">Germany (.de Store)</option>
            <option value="jp">Japan (.jp Store)</option>
            </select>
           
            </td><td class="forminp">
            
            <p><b>Search Category</b> (SearchIndex) </p>
            <select name="amazon[keyword_cat]" style="font-size:14px; width:260px;">
            <option value="All" selected>All Categories (see notes below)</option>
            <option>Apparel</option>
            <option>Automotive</option>
            <option>Baby</option>
            <option>Beauty</option>
            <option>Blended</option>
            <option>Books</option>
            <option>Classical</option>
            <option>DigitalMusic</option>
            <option>DVD</option>
            <option>Electronics</option>
            <option>ForeignBooks</option>
            <option>GourmetFood</option>
            <option>Grocery</option>
            <option>HealthPersonalCare</option>
            <option>HomeGarden</option>
            <option>HomeImprovement</option>
            <option>Industrial</option>
            <option>Jewelry</option>
            <option>KindleStore</option>
            <option>Kitchen</option>
            <option>Magazines</option>
            <option>Merchants</option>
            <option>Miscellaneous</option>
            <option>MP3Downloads</option>
            <option>Music</option>
            <option>MusicalInstruments</option>
            <option>MusicTracks</option>
            <option>OfficeProducts</option>
            <option>OutdoorLiving</option>
            <option>PCHardware</option>
            <option>PetSupplies</option>
            <option>Photo</option>
            <option>Shoes</option>
            <option>SilverMerchant</option>
            <option>Software</option>
            <option>SoftwareVideoGames</option>
            <option>SportingGoods</option>
            <option>Tools</option>
            <option>Toys</option>
            <option>VHS</option>
            <option>Video</option>
            <option>VideoGames</option>
            <option>Watches</option>
            <option>Wireless</option>
            <option>WirelessAccessories</option>
            </select>
            <br />
                        <small>If you select the 'All categories' above Amazon will only show you a maximum of 5 pages. For better search results select a more accurate category for your product searches.</small>
            
  
                         <p><b>Order By</b></p>
            <select name="amazon[Sort]" style="font-size:14px; width:260px;">
            <option value=""></option>
            <option value="price">Price (low - high)</option>
            <option value="-price">Price (high - low)</option>
            <option value="inverseprice">Inverse Price</option>
            <option value="sale-flag">On Sale</option>
            <option value="salesrank">Bestselling</option>
            <option value="pmrank">Featured items</option>
            <option value="relevancerank">Relevance Rank</option>
            <option value="reviewrank">reviewrank</option>
            <option value="titlerank">Alphabetical: A to Z</option>
              <option value="-titlerank">Alphabetical: Z to A</option>
              <option value="-launch-date">Newest arrivals</option>
               </select><br />
               
               <div style="background-color:yellow">Different sort options apply to different categories</div>
              <small>Note, you can not order by 'All Category Searches'. category search also have mixed sort options.  <a href="http://docs.amazonwebservices.com/AWSECommerceService/2010-06-01/DG/index.html?APPNDX_SortValuesArticle.html" target="_blank">See valid Sort</a></small>
            
                    </td>
                </tr>
            
            
                <tr class="mainrow"><td></td><td class="forminp" valign="top">
            
            <p><b> Add Imported Products:</b></p>
            <select name="cat[]2" multiple="multiple" size="5" style="font-size:14px; height:310px;">
              <option value="0">-----------------------------------</option>
              <?php
              
                $Maincategories= get_categories('use_desc_for_title=1&hide_empty=0&hierarchical=0');
                $Maincatcount = count($Maincategories);		
                foreach ($Maincategories as $Maincat) {				  
                    if($Maincat->parent ==0){
                    
                        if(!isset($a)){
                        print '<option type="checkbox" value="'.$Maincat->cat_ID.'" selected="selected" >' . $Maincat->cat_name.""; $a=1; 
                        }else{
                        print '<option type="checkbox" value="'.$Maincat->cat_ID.'">' . $Maincat->cat_name."";
                        }		
                        
            
                        $currentcat=get_query_var('cat');
                        $categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0');
                        $catcount = count($categories);	                       			
                        if(count($categories) > 0){				 
                            foreach ($categories as $cat) {					
                                print '<option name="cat[]" type="checkbox" value="'.$cat->cat_ID.'"> -- ' . $cat->cat_name . "";
                            
                            }			
                        }		
                    }
                    
                }
             
            ?>
            </select>
            <p><b>Amazon Browse Node <br /> <div style="background-color:yellow">(cannot be used with All Category Searches)</div></b></p>
            <input name="amazon[node]" type="text" style="width: 150px;" class="txt"><br />
            <small>Use the Browse Node parameter to narrow your search to a specific category of products in the Amazon catalog. The Browse Node parameter may contain the ID of any Amazon browse node. <a href="http://docs.amazonwebservices.com/AWSEcommerceService/2005-03-23/ApiReference/USBrowseNodesArticle.html" target="_blank">Click here to see the full list</a></small>
            
            
            
            </td><td class="forminp" valign="top">
            
            <p><b> Optional Search Criteria</b></p>
            <input type="hidden" name="amazon[start_page]" value="1">
            
            <div style="background:#efefef; border:1px solid #ddd; padding:8px; font-weight:Bold;">
            
 
            </select>
            
            <table width="100%"  border="0"><tr><td valign="top">
            
            <p>Min Price</p>
            <input name="amazon[minprice]" type="text" style="width: 150px;" class="txt"> <br />
            <small>Enter  the minimum price of items found in search results</small>
            <p>Condition</p>
            <select name="amazon[condition]" style="width: 150px;">
            <option>All</option>
            <option>New</option>
            <option>Used</option>
            <option>Refurbished</option>
            <option>Collectible</option>
            </select>
            <br />
            <small>Select the condition of all items found in search's</small>
            
            
            <p>Merchant ID</p>
            <input name="amazon[merchantid]" type="text" style="width: 150px;" class="txt"> <br />
            <small>Enter a merchant ID for locating individual dealers..</small>
            
            
            </td><td valign="top">
            
            <p>Max Price</p>
            <input name="amazon[maxprice]" type="text" style="width: 150px;" class="txt"> <br />
            <small>Enter  the maximum price of items found in search results</small>
            
            <p>Brand</p>
            <input name="amazon[brand]" type="text" style="width: 150px;" class="txt"> <br />
            <small>Enter a brand name above, eg "Sony"</small>
            
            <p>Import Product Reviews </p>
            <select name="amazon_reviews" style="width: 150px;">
            <option value="yes">Yes</option>
            <option value="no">No</option>
            </select>
            <br />
            <small>Select if you wish to import available product reviews for each item</small>
            
            </td></tr></table>
            
            </div>
            
            <tr></table>
            
             
            
            <h3 class="title"><a href="javascript:void(0);" onClick="toggleLayer('am_3');" style="text-decoration:none; color:#333;"><img src="<?php echo $GLOBALS['template_url']; ?>/images/add.png" align="middle"> Search and Replace </a></h3>
            <table class="maintable"  style="background:white;padding:10px; display:none;" id="am_3">
            <td colspan="3"><p>Here you can enter a word and it will be replaced with another word if it matches within the title or body of the item.</p></td>
            <tr><td width="50%"><b>Search for</b></td><td width="50%"><b>Replace with</b></td></tr>
            <tr>
            <td><input name="searchfor[0]" size="50"></td><td><input name="replacewith[0]" size="50"></td>
            </tr><tr><td><input name="searchfor[1]" size="50"></td>
            <td><input name="replacewith[1]" size="50"></td></tr></table>
            </table>
            
            <center><p><input class="premiumpress_button" type="submit" value="Start Search" style="color:white;" /> OR <a href="javascript:void(0);" onClick="toggleLayer('SSB');" style="text-decoration:underline;">Setup a scheduled search</a></p></center>
            
            
            
            <div style="background:#efefef; border:1px solid #ddd; padding:8px; font-weight:Bold; display:none;" id="SSB">
            <center>
            <p><b>Create Schedule Name</b></p>
            <input name="schedule[name]" type="text" class="txt" style="width: 180px; font-size:14px;">
            <select name="schedule[time]" class="txt" style="width: 180px; font-size:14px; border:1px solid #666;">
            <option value="hourly">Search Every Hourly</option>
            <option value="twicedaily">Search Twice Daily</option>
            <option value="daily">Search Once Daily</option>
            </select>
            <br /><small>Create a name for your scheduled search and select the amount of time between each search interval.</small>
            </center>
            </div>
             
             
             
            
            
             
            </form> 
            



<form method="post" name="ShopperPress" target="_self">
<input name="submitted" type="hidden" value="yes" />
<table class="maintable">

  	<tr class="mainrow">
		<td class="forminp">
        
        
        <p><b>Amazon Auto Updater - <a href="admin.php?page=import_products&action=amazon-debug">Click here to debug</a></b></p>
        
        <select  class="input" name="adminArray[enabled_amazon_updater]" style="font-size:14px; width:350px;">
        <option value="yes">Enable this tool</option>
        <option value="no" <?php if(get_option('enabled_amazon_updater') == "no"){ print "selected='selected'"; } ?>>Disable</option>
        </select>
        
        <br  /> 
        <small>This tool will runs in the background every hour using the Wordpress cron system to check and update only Amazon product prices which maybe out of date or incorrect. Amazon only allow 10 products per query so the system will check 10 products per hour (240 per day) therefore you may need to allow 24 hours or more for bigger websites.</small>
        
        
        </td>
		<td class="forminp">
        
        
        
        <p><b>Amazon Checkout Store</b></p>
 <?php
 $S1C = get_option('enabled_amazon_updater_country');
 ?>
<select name="adminArray[enabled_amazon_updater_country]" style="font-size:14px; width:350px;">
<option value="com" <?php if($S1C == "com"){ print "selected='selected'"; } ?>>United States (.com Store)</option>
<option value="ca" <?php if($S1C == "ca"){ print "selected='selected'"; } ?>>Canada (.ca Store)</option>
<option value="co.uk" <?php if($S1C == "co.uk"){ print "selected='selected'"; } ?>>United Kingdom (.co.uk Store)</option>
<option value="fr" <?php if($S1C == "fr"){ print "selected='selected'"; } ?>>France (.fr Store)</option>
<option value="de" <?php if($S1C == "de"){ print "selected='selected'"; } ?>>Germany (.de Store)</option>
<option value="jp" <?php if($S1C == "jp"){ print "selected='selected'"; } ?>>Japan (.jp Store)</option>
</select>

<br />

<small>Amazon checkout allows the user to add Amazon products to their basket and then checkout at Amazon. The store you select above will be used to determine where the user will be sent to checkout. Note, only products that are imported from that store will work. For example, you cannot import Amazon products from amazon.co.uk and checkout at amazon.com.</small>
 
        
        </td>
	</tr>






	 <tr>
	<td colspan="3"><p><input class="premiumpress_button" type="submit" value="Update Settings" style="color:white;"/></p></td>
	</tr>
</table>

</form>




            <?php
            
            $ASS 	= get_option("AmazonSavedSearch_Data");
            if(is_array($ASS) && count($ASS) > 0){
            
            ?>
            
            <div id="premiumpress_box1" class="premiumpress_box premiumpress_box-100" style="margin-top:40px;">
            <div class="premiumpress_boxin"><div class="header">
            <h3><img src="<?php echo $GLOBALS['template_url']; ?>/images/premiumpress/h-ico/smiley.png" align="middle"> My Scheduled Searches</h3>
            </div><div id="premiumpress_tab1" class="content">
            <table cellspacing="0"><thead>
            
            <td class="tc">Search Title</td>
            <th>Status</th>
            <td class="tc">Last Run</td>
            <td class="tc">Total Imported</td>
            <td class="tc">Actions</td></tr></thead><tfoot><tr><td colspan="6"></td></tr></tfoot><tbody>
            
            <?php
            $i= 0;
            foreach($ASS as $key => $value){ 
            ?> 
            <tr class="first">
            <td class="tc"><b><?php echo $value['name']; ?></b></td>
            <td class="tc"><?php echo strip_tags($value['status']); ?> <br><small>Keyword used <?php echo str_replace("\\","",$value['keyword']); ?></small></td>
            <td><?php echo $value['last']; ?> <br><small>Search setup to run <?php echo $value['time']; ?>, now on page <?php echo $value['start_page']; ?></small></td>
            <td class="tc"><?php echo $value['total']; ?></td>
            <td class="tc">
            
            <ul class="actions">
            <li><a href="admin.php?page=import_products&runnow=<?php echo $i; ?>">Run Now</a> | </li>
            
            <li><a href="admin.php?page=import_products&delf=<?php echo $i; ?>">Delete</a></li>
            
            </ul></td>
            </tr>
            <?php $i++; }  ?>
            
            </td></tr></tbody>
             
            
            </table>
            </div>
            </div>
            <div class="clearfix"></div> </div> 
            <?php } ?>


<?php } ?>


 
</div>




































<div id="premiumpress_tab2" class="content">
<form method="post" target="_self" <?php if(isset($GLOBALS['startsearch'])){ ?>style="display:none;"<?php } ?>>			
<input type="hidden" name="ebay" value="1" />
<input type="hidden" name="start_page" value="1" />

<table class="maintable" style="background:white;">


  <tr class="mainrow"><td></td><td class="forminp" valign="top">
            
<p><b>Search Keyword</b></p>
<input name="keyword" type="text"  style="width: 260px; background:#D9F9D8"><br />
<small>Enter a keyword above to search the eBay store for related products. Use quotations for more accurate results, eg. "golf bag"</small>
              
              
 </td><td class="forminp">


<p><b>Search eBay Store</b></p>
        <select  class="input" name="ebay_globalid" style="width: 260px; font-size:14px;" >
        <option value="EBAY-US" selected>eBay USA</option>
        <option value="EBAY-SG">eBay Singapore</option>
        <option value="EBAY-PL">eBay Poland</option>
        <option value="EBAY-PH">eBay Philippines</option>
        <option value="EBAY-NLBE">eBay Belgium (Dutch)</option>
        <option value="EBAY-NL">eBay Netherlands</option>
        <option value="EBAY-MY">eBay Malaysia</option>
        <option value="EBAY-MOTOR">eBay Motors</option>
        <option value="EBAY-IT">eBay Italy</option>
        <option value="EBAY-IN">eBay India</option>
        <option value="EBAY-IE">eBay Ireland</option>
        <option value="EBAY-HK">eBay Hong Kong</option>
        <option value="EBAY-GB">eBay UK</option>
        <option value="EBAY-FRCA">eBay Canada (French)</option>
        <option value="EBAY-FRBE">eBay Belgium (French)</option>
        <option value="EBAY-FR">eBay France</option>
        
        <option value="EBAY-ES">eBay Spain</option>
        <option value="EBAY-ENCA">eBay Canada (English)</option>
        <option value="EBAY-CH">eBay Switzerland</option>
        <option value="EBAY-DE">eBay Germany</option>
        <option value="EBAY-AU">eBay Australia</option>
        <option value="EBAY-AT">eBay Austria</option>    
 
        </select><br />
        
        
 <small>Select the eBay store you would like to search through.</small>
          
</td></tr>

 

 
 
	<tr class="mainrow">
		<td class="titledesc" valign="top">
        
        
  <p><b> Add Imported Products:</b></p>
            <select name="cat[]" multiple size="5" style="font-size:14px; height:310px; width:350px; ">
            <option value="0">-----------------------------------</option>
            <?php
                $i=1;
                $Maincategories= get_categories('use_desc_for_title=1&hide_empty=0&hierarchical=0');
                $Maincatcount = count($Maincategories);		
                foreach ($Maincategories as $Maincat) {		 
                    if($Maincat->parent ==0){
                    
                        if($i ==1){
                        print '<option type="checkbox" value="'.$Maincat->cat_ID.'"  selected=selected>' . $Maincat->cat_name."";
                        }else{
                        print '<option type="checkbox" value="'.$Maincat->cat_ID.'">' . $Maincat->cat_name."";
                        }		
                        
            
                        $currentcat=get_query_var('cat');
                        $categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0');
                        $catcount = count($categories);		
                        $i=1;				
                        if(count($categories) > 0){				 
                            foreach ($categories as $cat) {					
                                print '<option name="cat[]" type="checkbox" value="'.$cat->cat_ID.'"> -- ' . $cat->cat_name . "";
                            
                            }			
                        }		
                    }
                    $i++;	
                }
             
            ?>
            </select>
		 
		<br />
			<small>Select one or more categories to import these products into.</small>              
       
<p>My Ebay API ID</p>
			<input name="ebay_api" type="text" value="<?php echo get_option("ebay_api"); ?>" style="width: 280px;"><br />
			<small>You get this ID from your <A href="https://developer.ebay.com/join/default.aspx" target="_blank">Ebay developer account</A>. Eg: MarkAnth-921e-44b0-81ce-642804e36157</small> 
		 
       
       
        </td>
        
        
         
            </td><td class="forminp" valign="top">
            
            <p><b> Optional Search Criteria</b></p>
            <input type="hidden" name="amazon[start_page]" value="1">
            
            <div style="background:#efefef; border:1px solid #ddd; padding:8px; font-weight:Bold; width:400px;">
            
        <p>Find Products By</p>
			<select class="input" name="findby" style="width: 340px; font-size:14px;">
            <option value="findItemsIneBayStores">  Items In eBay Stores ( search a specific store )</option>
            <option value="findItemsByKeywords"  selected> Items By Keywords </option>            
            <option value="findItemsByProduct"> Items By Product ( enter product ID, such as an ISBN, UPC, EAN, or ePID )</option>              
            </select>            
            <br />
			<small>Select how the results are ordered.</small> 
        
        <p>Ebay Store Name</p>
			<input name="storeName" type="text" value="" style="width: 240px; font-size:14px;"><br />
			<small>Note: Store names are case sensitive. Also, if the store name contains an ampersand (&), you must use the & character entity (& amp;) in its place.</small>

        
        <p>Sort By</p>
			<select class="input" name="sortOrder" style="width: 240px; font-size:14px;">
            <option value="BestMatch" selected> Best Match </option>
            <option value="CurrentPriceHighest"> Current Price (Highest) </option>            
            <option value="PricePlusShippingHighest"> Price Plus Shipping (Highest) </option>
            <option value="PricePlusShippingLowest"> Price Plus Shipping (Lowest) </option>
            <option value="EndTimeSoonest"> End Time (Soonest) </option>            
            <option value="StartTimeNewest"> Start Time (Newest) </option>       
            </select>            
            <br />
			<small>Select how the results are ordered.</small>
            
                   
        
        
            </div>

		</td>
	</tr>
<tr>    
</table>

 

 


 <p><input class="premiumpress_button" type="submit" value="Start Search" style="color:white;" /></p>
</form>
</div>
<div id="premiumpress_tab3" class="content">
<table style="margin-bottom: 20px;"></table>
 <div style="display:visible; background:white; border:1px solid #ccc; border-top:0px;" id="i_0">

<table width="100%"  border="0">
  <tr>
    <td style="width:270px; padding:5px;"><a href="http://shopperpress.com/link/data-feedr/" target="_blank"><img src="<?php echo $GLOBALS['template_url']; ?>/images/datafeedr.jpg" style="border:1px solid #999;margin-left:10px;"></a></td>
    <td>

<h1>Instant Stores Using Datafeedr</h1>
<h3>Datafeedr allows you to instantly generate thousands of store products which you earn big $$$ for each sale!</h3>
<p>Whether you're selling your own products or selling affiliate products, integrating a datafeedr product list can help generate extra revenue each month! </p>
<p>ShopperPress makes it quick and easy to integrate Datafeedr, simply signup with Datafeedr, create a product list, download the file and import it below!</p>
<p><a href="http://shopperpress.com/link/data-feedr/" target="_blank">Signup Now with Datafeedr and start earning an extra income right away!</a></p>

</td> </tr></table>



<?php if(defined('DATAFEEDR_PLUGIN_VERSION')){ ?>

<div style="height:40px; margin-bottom:10px; background:#efefef; border:1px solid #ddd;padding:10px;margin:20px;">

    <div class="msg msg-info" style="float:right; width:150px;"><p>
	<span id="show_wp0"><a href="#" onclick="jQuery('#table_wp0').show();jQuery('#hide_wp0').show();jQuery('#show_wp0').hide();" style="font-weight:bold; text-decoration:underline">Show Details</a></span>
	<span id="hide_wp0" style="display:none;"><a href="#" onclick="jQuery('#table_wp0').hide();jQuery('#show_wp0').show();jQuery('#hide_wp0').hide();" style="font-weight:bold; text-decoration:underline">Hide Details</a></span> </p></div> 
    
    <b style="font-size:18px;">General Configuration</b> <br> 
    
    <small style="font-size:12px;">Here you can configure your Datafeedr integration.</small>

</div>

 


<div style="display:none;" id="table_wp0">

    <div style="margin-left:20px; background:#efefef; padding:10px; margin-right:20px; margin-bottom:20px;">
    
    <h2>Datafeedr Integration Overview</h2>
    
    <p>Importing your Datafeedr products into your website is easy!</p>
    
    <p>Using the Datafeedr plugin you can ensure your products are constantly updated and well managed, our theme then takes any product you import using the Datafeedr plugin and turns them into store products or posts.</p>
    
    <p>You currently have <b><?php echo $PPTDatafeedr->COUNTPRODUCTS(1); ?></b> Datafeedr products in your database. </p>
    
    <p><a href="admin.php?page=import_products&action=datafeedr">click here to import and/or update your Datafeedr imported store products.</a></p>
    
    
    </div>


</div>

<?php }else{ ?>

  <div style="height:40px; margin-bottom:10px; background:#efefef; border:1px solid #ddd;padding:10px;margin:20px;">

    <div class="msg msg-error" style="float:right; width:150px;"><p>
	<span id="show_wp0"><a href="http://shopperpress.com/link/data-feedr/" target="_blank" style="font-weight:bold; text-decoration:underline">Missing Plugin</a></span>
    </div>
 
    
    <b style="font-size:18px;">Datafeedr Plugin <u>NOT</u> Detected</b> <br> 
    
    <small style="font-size:12px;">You must install the datafeedr plugin to use the Datafeedr features. <a href="http://shopperpress.com/link/data-feedr/" target="_blank">Click here to download</a> </small>

</div>
 
<?php } ?> 




 
 
 
 
 
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 







</div>
<div id="premiumpress_tab4" class="content">
<div style="padding:10px;">
<div class="msg msg-info">
<p>The Affiliate ID section allows you to store all of your affiliate details and tracking code to be use with your products and website links.</p>
</div>
</div>
<form method="post" name="ShopperPress">
<input name="submitted" type="hidden" value="yes" />

<table class="maintable" style="background:white;">

<tr class="mainrow">
<td class="titledesc">Select Affiliate Network</td>
<td class="forminp">

<select style="font-size:16px; width:250px;" onChange="toggleLayer('a_'+this.value);">
<option value="All" selected>-- Select Network --</option>
<option value="1">ShareASale </option>
<option value="2">Affiliate Future</option>
<option value="3">LinkShare</option>
<option value="4">RegNow</option>
<option value="5">Commission Junction</option>
<option value="6">Webgains</option>

<option value="7">ClickBank</option>
<option value="8">TradeDoubler</option>
<option value="9">Bridaluxe</option>
<option value="10">Link Connector</option>

<option value="11">NetShops</option>
<option value="12">Buy.at</option>
<option value="13">PepperJam</option>
<option value="14">Google Affiliate Network</option>
<option value="15">Affiliate Window</option>
<option value="16">Commission Monster</option>

<option value="17">Market Health</option>
<option value="18">Affilinet</option>
<option value="19">OneNetworkDirect</option>
<option value="20">Amazon</option>

<option value="21">TickeFeedr</option>
<option value="25">Ebay</option>
</select>

</td></tr>
 

		<tr class="mainrow" style="display:none" id="a_1">			 
			<td class="titledesc"> ShareASale </td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_1_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_1_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_1_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_1_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_2">					 
			<td class="titledesc">Affiliate Future</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_2_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_2_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_2_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_2_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_3">
			<td class="titledesc">LinkShare</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_3_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_3_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_3_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_3_TRACK"); ?>" /></td>

		<tr class="mainrow"  style="display:none" id="a_4">
			<td class="titledesc">RegNow</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_4_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_4_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_4_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_4_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow"  style="display:none" id="a_5">
			<td class="titledesc">Commission Junction</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_5_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_5_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_5_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_5_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_6">
			<td class="titledesc">Webgains</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_6_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_6_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_6_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_6_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_7">			 
			<td class="titledesc">ClickBank</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_7_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_7_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_7_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_7_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_8">
			<td class="titledesc">TradeDoubler</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_8_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_8_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_8_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_8_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_9">			 
			<td class="titledesc">Bridaluxe</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_9_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_9_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_9_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_9_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_10">	
			<td class="titledesc">Link Connector</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_10_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_10_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_10_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_10_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_11"> 
			<td class="titledesc">NetShops</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_11_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_11_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_11_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_11_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_12">
			<td class="titledesc">Buy.at </td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_12_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_12_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_12_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_12_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_13">
			<td class="titledesc">PepperJam	</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_13_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_13_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_13_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_13_TRACK"); ?>" /></td>
		</tr>
		
		<tr class="mainrow" style="display:none" id="a_14">
			<td class="titledesc">Google Affiliate Network</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_14_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_14_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_14_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_14_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_15">
			<td class="titledesc">Affiliate Window</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_15_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_15_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_15_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_15_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_16">
			<td class="titledesc" style="display:none" id="a_1">Commission Monster</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_16_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_16_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_16_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_16_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_17">
			<td class="titledesc">Market Health</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_17_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_17_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_17_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_17_TRACK"); ?>" /></td>
		</tr>
 
		<tr class="mainrow" style="display:none" id="a_18">
			<td class="titledesc">Affilinet</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_18_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_18_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_18_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_18_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_19">			
			<td class="titledesc">OneNetworkDirect </td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_19_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_19_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_19_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_19_TRACK"); ?>" /></td>
		</tr>
        
        		<tr class="mainrow" style="display:none" id="a_21">			
			<td class="titledesc">TickeFeedr </td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_21_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_21_ID"); ?>" /><br />Tracking ID<input name="adminArray[affiliates_21_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_21_TRACK"); ?>" /></td>
		</tr>

		<tr class="mainrow" style="display:none" id="a_20">		
			<td class="titledesc">Amazon</td>
			<td class="forminp">Affiliate ID<input name="adminArray[affiliates_20_ID]" type="text" style="width:100%" value="<?php echo get_option("affiliates_20_ID"); ?>" /><br />
            <!--Tracking ID<input name="adminArray[affiliates_20_TRACK]" type="text" style="width:100%" value="<?php echo get_option("affiliates_20_TRACK"); ?>" />--></td>
		</tr>
 
 	<tr class="mainrow"  style="display:none" id="a_25">
		<td class="titledesc"></td>
		<td class="forminp">
        <p><b>Ebay Affiliate Tracking ID</b></p>
			<input name="ebay_tracking" type="text" value="<?php echo get_option("ebay_tracking"); ?>" style="width: 500px;"><br />
			<p><b>Ebay Affiliate Custom ID</b></p>
			<input name="ebay_customid" type="text" value="<?php echo get_option("ebay_customid"); ?>" style="width: 500px;"><br />
		 
		</td>
	</tr>
    
  

</table>


 


 
<p><input class="premiumpress_button" type="submit" value="Save Settings" style="color:white;" /></p>

</form>

 
</div>



<div id="premiumpress_tab5" class="content">
 

 
</div>            
	
<div id="premiumpress_tab6" class="content">tab 6</div>            
					 
                        
</div>
</div>
<div class="clearfix"></div> 

<?php } ?>