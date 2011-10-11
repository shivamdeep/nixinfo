<?php
/*
Template Name: [Callback Template]
*/

/***************** DO NOT EDIT THIS FILE *************************
******************************************************************

INFORMATION:
------------

This is a core theme file, you should not need to edit 
this file directly. Code changes maybe lost during updates.

LAST UPDATED: June 26th 2011
EDITED BY: MARK FAIL
------------------------------------------------------------------

******************************************************************/

$wpdb->hide_errors(); nocache_headers();
global $PPT, $userdata; get_currentuserinfo(); // grabs the user info and puts into vars
 
/* ==================== INCLUDES ===================== */

include(TEMPLATEPATH ."/PPT/class/class_payment.php");

$PPTPayment 		= new PremiumPressTheme_Payment;

/* =================== TEST PAYPAL DATA ================== */

/*
1. check that the order ID is value
2. if valid check the status else if invalid show error

ORDER ID STRUCTURE IS: [post ID]-[user ID]-[type]-[new package ID]
*/
/*if($userdata->wp_user_level == "10" && isset($_GET['order_id'])){ 
$_POST['mc_gross'] 			= $_GET['a'];
$_POST['custom'] 			= $_GET['order_id']; 
$_POST['payment_status'] 	= "Completed";
$_POST['payment_status'] 	= "Completed";
$_POST['mc_currency']		= "USD";
}*/
 

/* =================== CALLBACK EVENTS ================== */
$order_status = "error"; // types: thankyou, pending, failed, error
 
if($PPTPayment->CheckOrderID()){

	$orderID 		=	$PPTPayment->CheckOrderID(1);
	$order_status 	= 	$PPTPayment->PaymentStatus($orderID);
	$userID 		=	$PPTPayment->CheckUserID($orderID,$userdata);
	$GLOBALS['PPTorderID'] = $orderID;
	//die("orderID: ".$orderID."<br>Status: ".$order_status."<br>UserID: ".$userID);
	// SEND EMAIL
	$emailID = get_option("email_order_after");		
			 
	if(is_numeric($emailID) && $emailID != 0){
	 
		SendMemberEmail($userID, $emailID);	 
			
	}
 

} 

// RESET SESSIONS
@session_destroy();


/* =================== START DISPLAY ================== */

if(file_exists(str_replace("functions/","",THEME_PATH)."/themes/".get_option('theme')."/_tpl_callback.php")){
		
	include(str_replace("functions/","",THEME_PATH)."/themes/".get_option('theme').'/_tpl_callback.php');
		
}else{ 
	
	include("template_".strtolower(PREMIUMPRESS_SYSTEM)."/_tpl_callback.php");
	
}

?>