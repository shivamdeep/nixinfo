<?php
require_once(dirname(__FILE__).'/paypal.class.php'); 
require_once(dirname(__FILE__).'/myadmanager-class.php' );
require_once("../../../wp-blog-header.php");

$p = new paypal_class; 
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
            
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

if (empty($_GET['action'])) $_GET['action'] = 'error'; 

$user_email = get_option("myadmanager_paypal_add");

switch ($_GET['action']) {
    
   case 'process':
		$ads = new myAds();
		if(isset($_POST['Submit']) && ($_POST['paypal'] == 'Y')) {
		$ad_name = mysql_real_escape_string($_POST['ad_name']);
		$imagelink=$_POST['imagelink'];
		$ad_alt_text=mysql_real_escape_string($_POST['ad_alt_text']);
		$hyperlink=$_POST['hyperlink'];
		$duration=$_POST['duration'];
		
		if($ad_alt_text=="")
			$ad_alt_text = $ad_name;
		
		if($duration == "7") {
			$amt = get_option("myadmanager_cost_week");
			$itemname = get_option("myadmanager_name_week");
		}
		else if ($duration == "30") {
			$amt = get_option("myadmanager_cost_month");
			$itemname = get_option("myadmanager_name_month");
		}

		$paypal_return_page = get_option("myadmanager_paypal_return_page");
		if($paypal_return_page == "")
			$paypal_return_page = $this_script."?action=ipn";	
		
		$ad_text = $ad_name.",".$ad_alt_text.",".$imagelink.",".$hyperlink.",".$duration;
		
		ob_start();
	    include(dirname(__FILE__).'/confirm-order.template.html');
	    $l = ob_get_contents();
		
		$l = replace("$l", array('blog_name' => get_option('blogname') ,'ad_name' => $ad_name,'ad_image_url' => $imagelink,'ad_url' => $hyperlink,'ad_image_alt' => $ad_alt_text, 'package' => $itemname." - $".$amt,'total_amount' => "$$amt", 'preview_ad_image' => '<a href="'.$hyperlink.'"><img src="'.$imagelink.'" alt="'.$ad_alt_text.'" width="125" height="125" border="0" /></a>'));		
		
		$l .= show_footer();
		
    	ob_end_clean();
	
		echo $l;
		
		$p->add_field('business',$user_email );
		$p->add_field('return', $this_script.'?action=success');
		$p->add_field('cancel_return', $this_script.'?action=cancel');
		$p->add_field('notify_url', $paypal_return_page);
		$p->add_field('item_name', $itemname);
		$p->add_field('no_shipping', '0');
		$p->add_field('custom',  $ad_text);
		$p->add_field('amount',$amt);
		$p->submit_paypal_post(); 
	//	$p->dump_fields();
		}
      break;
      
   case 'success':  
      echo "<html><head><title>Success ! </title></head><body><h3>Thank you for your order. Your ad will be added shortly !</h3>";
      break;
      
   case 'cancel': 
      echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
      echo "</body></html>";
      
      break;
      
   case 'ipn':
      if ($p->validate_ipn()) {
        $ads = new myAds();
		
		$first_name = $p->ipn_data['first_name'];
		$last_name = $p->ipn_data['last_name'];
		$cn = $p->ipn_data['residence_country'];
		$payer_email = $p->ipn_data['payer_email'];
		$verify_sign = $p->ipn_data['verify_sign'];
		$item_name =$p->ipn_data['item_name'];
		$gross = ($p->ipn_data['payment_gross'])-($p->ipn['payment_fee']);
		$payment_date_time = $p->ipn_data['payment_date'];
		$payment_status = $p->ipn_data['payment_status'];
		
		$custom = $p->ipn_data['custom'];
		$pieces = explode(",", $custom);
					
		$today = date("Y-m-d");
    	$end = dateShift($today,$pieces[4]);
		
		$ads->addRecord("$ads->myAds_table","NULL,'1','1','$pieces[0]','$pieces[1]','$pieces[2]','$pieces[3]','$today','$end','1','1'");
		
		$last_id = $wpdb->insert_id;
		
		$ads->addRecord("$ads->myTransac_table","NULL,'$first_name','$last_name','$cn','$payer_email','$verify_sign','$item_name','$gross','$payment_date_time','$payment_status','$last_id'");
		
		 $emailowner = get_option("myadmanager_paypal_add");
		 
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = $emailowner;    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nFor More Details:\n\n\nLog on to your MyADManager Administrative Panel\n\n ".get_option("siteurl")."/wp-admin\n\n\nPowered by <a href=\"http://www.visionmasterdesigns.com\">myAdManager ".MY_AD_MANAGER_VERSION."</a>";
		 
		 $headers = 'From: '.$p->ipn_data['payer_email'].'\r\n';				
		 $headers .= "To: ".$emailowner."\r\n";
		 
         mail($to, $subject, $body, $headers);
		
         $subject = 'Thanks for Buying AD-Space at '.get_option("blogname");
         $to = $p->ipn_data['payer_email'];    //  your email
         $body =  get_option("myadmanager_paypal_email_msg");
		 $body .= "\n\nDetails : \n\nImageLink - $pieces[2]\n\nHyperLink - $pieces[3]\n\nYour Ad Starts on $today and will end on$end\n\n\nPowered by <a href=\"http://www.visionmasterdesigns.com\">myAdManager ".MY_AD_MANAGER_VERSION."</a>";
		 		 
		 $headers = 'From: '.$emailowner.'\r\n';				
		 $headers .= "To: ".$p->ipn_data['payer_email']."\r\n";

		 mail($to, $subject, $body, $headers);
		 
		 
		 
		 
      }
      break;

	  case 'error':
	  echo '<h2>You are not allowed here.</h2>';
	  break;
	  
	  case 'show':
	  break;
}
?>
