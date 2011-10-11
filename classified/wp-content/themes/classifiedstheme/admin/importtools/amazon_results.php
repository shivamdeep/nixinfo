<?php

global $PPT;

	if ( get_magic_quotes_gpc() ) {
		$_POST      = array_map( 'stripslashes_deep', $_POST );
	}

	if(!is_array($_POST['cat']) || $_POST['cat'][0] =="0"){ die("<h1> You didnt select any category to save the products too </h1> <p> Click back and select a category.</p>"); }

	$count=0;
	$cats="";
	foreach($_POST['cat'] as $cat){			
	$cats .= $cat.",";
	}			
	
	$_POST['amazon']['keyword'] = str_replace('*','"',$_POST['amazon']['keyword']);

	$obj = new AmazonProductAPI();			
	try
    {
		$result = $obj->searchProducts($_POST['amazon']['keyword'],$_POST['amazon']['keyword_cat'],$_POST['amazon']);	

	}
    catch(Exception $e)
    {

        echo $e->getMessage();
		exit();		
    }
	
	$TotalResults = str_replace("!ad","",$result->Items->TotalResults);
	$TotalPages	  = str_replace("!ad","",$result->Items->TotalPages);
	 
	 
					
	$_POST['amazon']['keyword'] = str_replace('"',"*",$_POST['amazon']['keyword']);
	?>
    
    <script>
	
	function gobackpage(page){

	document.getElementById('start_page').value = page -1;
	document.subform.submit();
	
	}
	
	</script>   
       
    <div id="ShopperPressAlert"tyle="font-size:16px; font-weight:bold;"></div>

	<div style="background:#efefef; border:1px solid #ddd; padding:9px; font-size:18px;border-bottom:0px;">
		<?php  if(isset($TotalResults)){ print "<b>".number_format($TotalResults)."</b> results for '".str_replace('*','"',$_POST['amazon']['keyword'])."' in <b>".number_format($TotalPages)."</b> pages.";  } ?>
	</div>
    <div style="width:100%; height:400px; border:2px solid #ddd; overflow:auto; background:#fff;">
    
    <?php 

	foreach($result->Items->Item as $val){
	
	//die(print_r($val));
	 
	//$data['totalReviews'] 	= $val->CustomerReviews->TotalReviews;
	$data['image'] 			= $val->LargeImage->URL;
	$data['thumbnail']		= $val->MediumImage->URL;
	$data['desc']			= $val->EditorialReviews->EditorialReview->Content;
	$data['title'] 			= $val->ItemAttributes->Title;
	$data['asin'] 			= $val->ASIN;
	$data['url'] 			= $val->DetailPageURL;
	$data['old_price'] 		= "";
	$data['price']			= $val->ItemAttributes->ListPrice->Amount;
	$data['CurrencyCode']	= $val->ItemAttributes->ListPrice->CurrencyCode;
	
	if($data['price'] == ""){
		$data['price'] = $val->OfferSummary->LowestNewPrice->Amount;
	}
	
	if(isset($val->Offers->Offer->OfferListing->Price->Amount) && strlen($val->Offers->Offer->OfferListing->Price->Amount) > 1){
	
			$data['old_price'] = $data['price'];
			$data['price'] 	=  $val->Offers->Offer->OfferListing->Price->Amount;	
	}	
 
	// Load price options
	if($_POST['amazon']['country'] == "jp"){
	
	}else{
		$data['old_price'] = number_format(substr($data['old_price'],0, -2)).".".substr($data['old_price'],-2);
 		$data['price'] = number_format(substr($data['price'],0, -2)).".".substr($data['price'],-2);
	}	
	 
 	if(strlen($data['old_price']) < 3){ $data['old_price']=""; }
			
	$AFFLINK = "http://www.amazon.".$_POST['amazon']['country']."/o/ASIN/%asin%/%amazon_id%";
	$AFFLINK = str_replace("%asin%",$data['asin'],$AFFLINK);
	$AFFLINK = str_replace("%amazon_id%",'YOURUSERID',$AFFLINK);
	
	
	?>   
    
    <div style="clear:both; border-bottom:1px dashed #666; display:visible" id="A<?php echo $data['asin']; ?>">
    
    <img src="<?php echo $data['thumbnail']; ?>" style="float:left; margin-left:20px; padding-right:20px;  height:80px; width:80px; padding-bottom:50px;"/>
    
    <h3><?php echo $data['title']; ?></h3>
    
    <p><?php echo strip_tags(substr($data['desc'],0,250)); ?>...</p>
    <p>Price: <?php echo $data['CurrencyCode'].$data['price']; ?> <?php if(isset($data['old_price']) && strlen($data['old_price']) > 1 && $data['old_price'] != $data['price']){ print "WAS <strike>".$data['CurrencyCode'].$data['old_price']."</strike>"; } ?>  <!--ASIN: <?php echo $data['asin']; ?>-->
    
    <!-- Customer Reviews: <?php if($data['totalReviews'] == ""){ echo 0; }else{ echo $data['totalReviews']; } ?>-->
    
    </p>
    <?php if($data['price'] != "Too low to display" && $data['price'] != ""){ ?>
    
    <p><a href='javascript:void(0);' onClick="getElementById('ShopperPressAlert').innerHTML='waiting for confirmation...'; jQuery('#A<?php echo $data['asin']; ?>').hide(); addAmazonProduct('<?php echo $cats; ?>','<?php echo $_POST['amazon']['country']; ?>','<?php echo $data['asin']; ?>');" style="padding:4px; background:#eeffdb; border:1px solid #c7e0ab;">add product</a> - [ <a href="<?php echo $data['url']; ?>" target="_blank">View Item</a> ]</p>
    
    <?php }else{ ?>
    
    <p style="padding:10px; background:#ff806f; color:#fff;">This product is unavailable due to Amazon pricing options.</p>
    <?php } ?>
    <div style="clear:both;"></div>
    </div>
    
    <?php } ?>
    
    </div>
    <div style="background:#eee; border:1px solid #ddd; padding:10px; margin-top:10px; font-size:16px;">
    
    <div style="float:left; width:<?php if($_POST['amazon']['start_page'] > 1){ ?>78%<?php }else{ ?>90%<?php } ?>; text-align:left"> <a href="admin.php?page=import_products">[New Search]</a></div>
    <div style="float:left; text-align:right;"> 
    <?php if($_POST['amazon']['start_page'] > 1){ ?><a href="javascript:void(0);" onClick="gobackpage(<?php echo $_POST['amazon']['start_page']; ?>)">Previous Page</a> - <?php } ?>   <a href="#" onClick="document.subform.submit();">Next Page</a> </div>
    
    
    <div style="clear:both;"></div></div>
    

    
    <form method="post" target="_self" id="subform" name="subform">			
    <input type="hidden" name="feed" value="1">

    <?php
	
	foreach($_POST['cat'] as $cat){			
		print '<input type="hidden" name="cat[]" value="'.$cat.'">';	
	}
	
	foreach($_POST as $key=>$val){
	if(!is_array($val)){
	print '<input type="hidden" name="'.$key.'" value="'.$val.'">';
	}	
	}
	
	foreach($_POST['amazon'] as $key=>$val){
	
		if(is_array($val)){
		
			foreach($val as $key=>$val1){
				 print '<input type="hidden" name="'.$key.'" value="'.$val1.'">';			 
			}
		
		
		}else{
		
			if($key == "start_page"){	
				if($val ==""){ $val=2; }else{ $val++; }	
				print '<input type="hidden" name="amazon['.$key.']" value="'.$val.'" id="start_page">';	
			}else{	
				print '<input type="hidden" name="amazon['.$key.']" value="'.$val.'">';
			}
		}
	
	}
	
	?>
	</form>
