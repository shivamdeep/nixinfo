<?php


	if(!is_array($_POST['cat'])){ die("<h1> You didnt select any category to save the products too </h1> <p> Click back and select a category.</p>"); }
	if($_POST['ebay_api'] ==""){ die("<h1> Ebay Developer API Key Missing</h1><p>You need to enter your ebay developer API key into the configuration settings</p>"); }

if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
}

	$count=0;
	$cats="";
	foreach($_POST['cat'] as $cat){			
	$cats .= $cat.",";
	}

$appid 		= $_POST['ebay_api'];  // Replace with your own AppID

// API request variables
$endpoint 	= 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$version 	= '1.0.0';  // API version supported by your application
$globalid 	= $_POST['ebay_globalid'];  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
$query 		= $_POST['keyword'];  // You will need to supply your own query
$SafeQuery 	= urlencode($query);  // Make the query URL-friendly


$pagenum = $_POST['start_page'];

///
$urlfilter="";
$i 	= '0';  // Initialize the item filter index array to 0

$filterArray =
	array(
	
	  array(
		'name' => '',
		'value' => '0',
		'paramName' => 'Currency',
		'paramValue'  => 'USD'),
		
		
	); 

  // Build item filters URL array
  function buildURLArray ($filterArray) {
    global $urlfilter;
    global $i;
    // Iterate through each filter in the array
    foreach($filterArray as $itemFilter) {
      // Iterate through each key in the filter
      foreach ($itemFilter as $key =>$value) {
        $r = '0'; //A number that increments each time the above "for" loops;
        if(is_array($value)) { //if the 'value' var content is an array
          if($value != "") { //check to make sure the content isn't empty
            foreach($value as $j => $content) {
              $urlfilter .= "&itemFilter($i).$key($j)=$content";
            }
          }
        }
        else { //this isnt an array so just print the single contents of the 'value' container, no indexing of keys needed
          if($value != "") {
            $urlfilter .= "&itemFilter($i).$key=$value";
          }
        }
        $r++;
      }
      $i++;
    }
    return "$urlfilter";
  } // End of buildURLArray function

buildURLArray($filterArray);
 
// Construct the findItemsByKeywords call 
$apicall = "$endpoint?";
$apicall .= "OPERATION-NAME=".$_POST['findby']; //
$apicall .= "&SERVICE-VERSION=$version";
$apicall .= "&SECURITY-APPNAME=$appid";
$apicall .= "&GLOBAL-ID=$globalid";
$apicall .= "&keywords=$SafeQuery";
$apicall .= "&paginationInput.entriesPerPage=10"; // items per page
$apicall .= "&paginationInput.pageNumber=$pagenum&outputSelector(0)=SellerInfo&outputSelector(1)=StoreInfo"; // page nav
$apicall .= "&sortOrder=".$_POST['sortOrder'];
if(strlen($_POST['storeName']) > 1){
	$apicall .= "&storeName=".$_POST['storeName'];
}
if(strlen($_POST['storeName']) > 1){
$apicall .= "&affiliate.networkId=9";
$apicall .= "&affiliate.trackingId=".$_POST['ebay_tracking'];
$apicall .= "&affiliate.customId=".$_POST['ebay_customid'];
} 
$apicall .= "$urlfilter";
 

// Load the call and capture the document returned by eBay API
$resp = simplexml_load_file($apicall);
 
$error = @$resp->errorMessage->error->message;
 
// Check to see if the response was loaded, else print an error
 if (strlen($error) < 5) {
 
	$results = '';
	
	
	?>
     
 
    <div id="ShopperPressAlert"tyle="font-size:16px; font-weight:bold;"></div>
    <div style="width:100%; height:400px; border:2px solid #ddd; overflow:auto; background:#fff;">
    
    
    <?php

    if(isset($resp->searchResult->item)){ foreach($resp->searchResult->item as $item) {
	
	//die(print_r($resp->searchResult->item));
 
		$ID    		= $item->itemId;
        $pic   		= $item->galleryURL;
        $link  		= $item->viewItemURL;
        $title 		= $item->title;
		$subtitle   = $item->subtitle;
  		$location	= $item->location;
		$postcode 	= $item->postalCode;
		$cat_name 	= $item->primaryCategory->categoryName;

		$price = $item->sellingStatus->currentPrice;
		$type = $item->listingInfo->listingType;
		
		 
		$startTime = $item->listingInfo->startTime;

		$shippingType = $item->shippingInfo->shippingType;
		$shipping_to = $item->shippingInfo->shipToLocations;
		$shipping_cost = $item->shippingInfo->shippingServiceCost;
		
		$listing_endtime = explode(":",$item->listingInfo->endTime);
		
		$endTime = substr($listing_endtime[0],0,-3);
		
		$storename = $item->storeInfo->storeName;
		
		$feedbackStar = $item->storeInfo->feedbackRatingStar;
		
		$sellerUsername = $item->storeInfo->sellerUserName;
		
		

	?>
    
    <div style="clear:both; border-bottom:1px dashed #666;">
    
    <img src="<?php echo $pic; ?>" style="float:left; margin-left:20px; padding-right:20px;  height:80px; width:80px; padding-bottom:50px;">
    <h3><?php echo $title; ?></h3>
    <p><?php echo $subtitle; ?></p>
    <p>Price: <?php echo $price; ?> / Type: <?php echo $type; ?> 
    
 	 
     <?php if(strlen($storename) > 2){ echo " / Store Name: ".$storename; } ?>
     ID: <?php echo $ID; ?> </p>
    
    
    <p>
    <small>Auction Ends: <?php echo $endTime; ?> Location: <?php echo $location; ?> </small>
    </p>
    
    
    
    <p>[<a href='javascript:void(0);' onClick="addEbayProduct('<?php echo $cats; ?>','<?php echo $_POST['ebay_globalid']; ?>','<?php echo $ID; ?>','<?php echo $_POST['ebay_api']; ?>','<?php echo $_POST['ebay_tracking']; ?>','<?php echo $_POST['ebay_customid']; ?>');">Add Product</a>] [ <a href="<?php echo $link; ?>" target="_blank">View Product</a>]</p>
    
    </div>
    
    <?php } } //Shipping To: ".$shipping_to." Cost: ".$shipping_cost." ?>
    
    
    
    </div>
    
    
    
    <?php
 
	 
}
// If there was no response, print an error
else {
	echo "<h1>".$error."</h1>";
}
?> 

 
    <div style="background:#eee; border:1px solid #ddd; padding:10px; margin-top:10px; font-size:16px;">
    <div style="float:left; width:<?php if($_POST['start_page'] > 1){ ?>78%<?php }else{ ?>90%<?php } ?>; text-align:left"> <a href="admin.php?page=import_products">[New Search]</a></div>
    <div style="float:left; text-align:right;"> 
    <?php if($_POST['start_page'] > 1){ ?><a href="javascript:void(0);" onClick="gobackpage(<?php echo $_POST['start_page']; ?>)">Previous Page</a> - <?php } ?>   <a href="#" onClick="document.subform.submit();">Next Page</a> </div>
    
	<div style="clear:both;"></div></div>

    <script>
	
	function gobackpage(page){

	document.getElementById('start_page').value = page -1;
	document.subform.submit();
	
	}
	
	</script> 
        
    <form method="post" target="_self" id="subform" name="subform">			
    <input type="hidden" name="feed" value="1">

    <?php
 
	foreach($_POST as $key=>$val){
	
		if(is_array($val)){
		
			foreach($val as $key=>$val1){
				 print '<input type="hidden" name="'.$key.'" value="'.$val1.'">';			 
			}
		
		
		}else{

			if($key == "start_page"){	
				if($val ==""){ $val=2; }else{ $val++; }	
				print '<input type="hidden" name="'.$key.'" value="'.$val.'" id="start_page">';	
			}else{	
				print '<input type="hidden" name="'.$key.'" value="'.$val.'">';
			}
		}

	}
	
	foreach($_POST['cat'] as $cat){			
		print '<input type="hidden" name="cat[]" value="'.$cat.'">';	
	}
 
	
	?>
	
    </form>
     