<?php
/*
Template Name: [My Account Template]
*/

/***************** DO NOT EDIT THIS FILE *************************
******************************************************************

INFORMATION:
------------

This is a core theme file, you should not need to edit 
this file directly. Code changes maybe lost during updates.

LAST UPDATED: May 25th 2011
EDITED BY: MARK FAIL
------------------------------------------------------------------

******************************************************************/

global $PPTFunction, $userdata; get_currentuserinfo(); // grabs the user info and puts into vars 

$wpdb->hide_errors(); $PPTFunction->auth_redirect_login(); nocache_headers();

/* =========================================== */
 
if($userdata->aim == ""){ $sc = get_option('auction_startbalance'); if(!is_numeric($sc)){$sc=0; } mysql_query("UPDATE $wpdb->usermeta SET meta_value=".$sc." WHERE meta_key='aim' AND user_id='".PPTCLEAN($userdata->ID)."' LIMIT 1"); $userdata->aim = $sc; }

/* =========================================== */

if(isset($_POST['action'])){ $_GET['action'] = $_POST['action']; }
if(isset($_GET['action'])){


	if($_GET['action'] == "withdraw"){
 
	
		$subject = "WIDTHDRAWL FORM";
		$headers = "From: " . strip_tags($userdata->user_email) . "\r\n";
		$headers .= "Reply-To: " . strip_tags($userdata->user_email) . "\r\n";
		$headers .= "Return-Path: " . strip_tags($userdata->user_email) . "\r\n";
 
		$message = "<p> Username : " . strip_tags($userdata->user_login) . "
					<p> Email : " . strip_tags($userdata->user_email) . "
					<p> Withdrawal Amount : " . strip_tags($_POST['amount']) . "
					<p> Method : " . strip_tags($_POST['method']) . "";
 
 		wp_mail(get_option("email"),$subject,$message,$headers);
	
	
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "success"; //ok,warn,error,info
		$GLOBALS['error_msg'] 	= "Thank you, one of our team will be in contact shortly.";
	
	
	}else{ 

		$GLOBALS['premiumpress']['language'] = get_option("language");
		$PPT->Language();
 

		require_once(ABSPATH . 'wp-admin/includes/user.php');
		require_once(ABSPATH . WPINC . '/registration.php');
		
		$_POST['form']['ID'] = $userdata->ID;
		$_POST['form']['jabber']  = $_POST['address']['country']."**";
		$_POST['form']['jabber'] .= $_POST['address']['state']."**";
		$_POST['form']['jabber'] .= $_POST['address']['address']."**";
		$_POST['form']['jabber'] .= $_POST['address']['city']."**";
		$_POST['form']['jabber'] .= $_POST['address']['zip']."**";
		$_POST['form']['jabber'] .= $_POST['address']['phone'];

		if( ( $_POST['password'] == $_POST['password_r'] ) && $_POST['password'] !=""){
			$_POST['form']['user_pass'] = $_POST['password'] ;
		}
			
		wp_update_user( $_POST['form'] );
		
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "success";
		$GLOBALS['error_msg'] 	= SPEC($GLOBALS['_LANG']['_tpl_myaccount_error1']);
		
	}
 
}

$ADD = explode("**",$userdata->jabber);

if(strlen($userdata->yim['text']) > 2 && !isset($_POST['step1']) ){

		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "tip";
		$GLOBALS['error_msg'] 	= $userdata->yim['text'];
}


	/* ================ LOAD TEMPLATE FILE =========================== */	
 
	if(file_exists(str_replace("functions/","",THEME_PATH)."/themes/".get_option('theme')."/_tpl_myaccount.php")){
		
		include(str_replace("functions/","",THEME_PATH)."/themes/".get_option('theme').'/_tpl_myaccount.php');
		
	}else{ 
	
		include("template_".strtolower(PREMIUMPRESS_SYSTEM)."/_tpl_myaccount.php");
	
	}

?>