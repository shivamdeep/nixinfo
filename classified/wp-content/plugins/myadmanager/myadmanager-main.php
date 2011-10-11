<?php
/*
Plugin Name: MyAdManager
Plugin URI: http://www.visionmasterdesigns.com/wordpress-plugins/myadmanager/
Description: Manages 125x125 ads automatically. Also allows the ability to add new ads and make them live on the confirmation of payment from paypal.
Author: Michael
Version: 0.9.3
Author URI: http://www.visionmasterdesigns.com
*/

/*
Copyright 2008 Michael Benedict Arul. Vision Master Designs

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once(dirname(__FILE__).'/myadmanager-class.php' );
define('WP_MYADMANAGER_URL', get_option('siteurl') . '/wp-content/plugins/myadmanager');
define('WP_ABS_MYADMANAGER_URL', ABSPATH. '/wp-content/plugins/myadmanager');

add_action('admin_menu', 'myadmanager_add_pages');
add_action( 'init', 'myadmanager_startWidget' );

/*****************************
myadmanager_startWidget() @ v0.9.1
Adds a simple widget.

@package MyAdManger
******************************/
function myadmanager_startWidget()
{
	if ( function_exists( 'register_sidebar_widget' ) )
	{
		function widget_myadmanager( $args )
		{
			$before_widget = '';
			$before_title = '';
			$after_title = '';
			$after_widget = '';

			if ( is_array( $args ) )
			{
				if ( array_key_exists( 'before_widget', $args ) )
				{
					$before_widget = $args['before_widget'];
				}
				if ( array_key_exists( 'before_title', $args ) )
				{
					$before_title = $args['before_title'];
				}
				if ( array_key_exists( 'after_title', $args ) )
				{
					$after_title = $args['after_title'];
				}
				if ( array_key_exists( 'after_widget', $args ) )
				{
					$after_widget = $args['after_widget'];
				}
				$title = get_option("myadmanager_widget_title");
				echo $before_widget;
				echo $before_title. "$title" . $after_title;
				if ( function_exists('myadmanager_show' ) )
					myadmanager_show();			
				echo $after_widget;
			}
		}
		
		register_sidebar_widget( 'MyADManager', 'widget_myadmanager' );
	}
	
	function widget_myadmanager_control( )
	{
		if ( $_POST['myadmanager-widget-submit'] ) {
			update_option("myadmanager_widget_title",stripslashes($_POST['myadmanager-widget-title']));
		}
		echo '<p style="text-align:left;"><label for="get_recent_comments-title">Title:</label> <input style="width: 200px;" id="myadmanager-widget-title" name="myadmanager-widget-title" type="text" value="'.get_option("myadmanager_widget_title").'" />
		<br />Please Enter the title of this Widget.</p>';
		echo '<input type="hidden" id="myadmanager-widget-submit" name="myadmanager-widget-submit" value="1" />';
	}
	register_widget_control( 'MyADManager', 'widget_myadmanager_control', 210, 100 );
}

/*****************************
myadmanager_add_pages()
Add Pages, to wordpress admin

@package MyAdManger
******************************/
function myadmanager_add_pages() {
  add_menu_page('MyAdManager', 'MyAdManager', 8, __FILE__, 'myadmanager_manage_page');
  add_submenu_page(__FILE__, 'MyAdManager Options', 'MyAdManager Options', 8, 'options', 'myadmanager_options_page');
  add_submenu_page(__FILE__, 'Transaction Log', 'Transaction Log', 8, 'transacs', 'myadmanager_transac_page');
}


function myadmanager_transac_page() {
global $wpdb;
$ads = new myAds();
if($_POST['hidden_form_transactions']=='Y') {
	
		if($_POST['delete']) {
		foreach($_POST['transactions'] as $i) {
			$ads->deleteRecord("$ads->myTransac_table",$i);
		}
		echo '<div class="updated" style="color:red;"><p><strong>Deleted</strong></p></div>';				
		}
}

$transacs = $ads->getTransactions("ORDER BY id DESC");
echo "<div class=\"wrap\"><h2>" . __( 'Transaction Log', 'mt_trans_domain' ) . "</h2>";
?>
<form name="form_transactions" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="hidden_form_transactions" value="Y">
<?php
echo '<table width="100%" class="widefat"><thead><th scope="col">id</th><th scope="col">First Name</th><th scope="col" >Last Name</th><th scope="col" width="200" >Email</th><th scope="col" >Item Name</th><th scope="col" >Amount</th><th scope="col">Payment Date</th><th scope="col">Ad Name</th><th scope="col">Website</th><th scope="col">Action</th></thead>';
if(count($transacs)==0)
echo "<tr><td colspan=\"10\" align=\"center\"><strong>No Logs Collected Yet</strong></td></tr>";
foreach($transacs as $t) {
echo "<tr>
	<td>$t->id</td>
	<td>$t->first_name</td>
	<td>$t->last_name</td>
	<td>$t->payer_email</td>
	<td>$t->item_name</td>
	<td>$ $t->gross</td>
	<td>$t->payment_date_time</td>
	<td>$t->ad_name</td>
	<td>$t->hyperlink</td>
	<td><input type=\"checkbox\" name=\"transactions[]\" id=\"transactions[]\" value=\"$t->id\" /></td>
</tr>";
}
echo "</table>";
?>
<p class="submit">
<input type="submit" name="delete" value="Delete Transactions" />
</p>
</form>
<?php show_donate(); ?>
<?php echo show_footer(); ?>
<?php
}

/*****************************
myadmanager_options_page()
Basic Options are defined here

@package MyAdManger
******************************/
function myadmanager_options_page() {
	global $wpdb;
	$ads = new myAds();
    // variables for the field and option names 
    $hidden_field_name_form1 = 'mt_submit_hidden1';

    // Read in existing option value from database
	$ads_v = $ads->getRegionOption("ad_v");
	$ads_h = $ads->getRegionOption("ad_h");
	$e_margin = $ads->getRegionOption("margin");	
	$e_margin_array = explode(',',$e_margin);
	$paypal_add = get_option("myadmanager_paypal_add");
	$paypal_return_page = get_option("myadmanager_paypal_return_page");
	$cost_week = get_option("myadmanager_cost_week");
	$cost_month = get_option("myadmanager_cost_month");	
	$name_week = get_option("myadmanager_name_week");
	$name_month = get_option("myadmanager_name_month");
	$paypal_enable = get_option("myadmanager_paypal_enable");
	$week_option = get_option("myadmanager_week_enable");
	$paypal_email_msg = get_option("myadmanager_paypal_email_msg");

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name_form1 ] == 'Y' ) {
        // Read their posted value
        
		$paypal_enable = $_POST['paypal_enable'];
		$week_option = $_POST['week_option'];
		$ads_h = $_POST["ads_h"];
        $ads_v = $_POST["ads_v"];
		$e_margin = $_POST["e_margin"];
			$e_margin_array = explode(',',$e_margin);
		$ad_total=$ads_v*$ads_h;
		$width=($ads_h*125)+(($e_margin_array[1]+$e_margin_array[3])*($ads_h));
		$height=($ads_v*125)+(($e_margin_array[0]+$e_margin_array[2])*($ads_v));
		
		$cost_month = $_POST['cost_month'];
		$name_month = $_POST['name_month'];
		
       // Save the posted value in the database
	   $ads->updateRecord("$ads->myRegion_table","ad_h=$ads_h,ad_v=$ads_v,ad_total=$ad_total,height=$height,width=$width,margin='$e_margin'",1);
	   	
		if ($paypal_enable != "checked" || get_option("myadmanager_paypal_enable") == "checked") {
			if ($paypal_enable == "checked") {
				$paypal_add = $_POST['paypal_add'];
				$paypal_return_page = $_POST['paypal_return_page'];
				$paypal_email_msg= $_POST['paypal_email_msg'];
				update_option("myadmanager_paypal_add",$paypal_add);		
				update_option("myadmanager_paypal_return_page",$paypal_return_page);
				update_option("myadmanager_paypal_email_msg",$paypal_email_msg);
			}
					
		}
		if ($week_option != "checked" || get_option("myadmanager_week_enable") == "checked") {
			if ($week_option == "checked") {
				$name_week = $_POST['name_week'];
				$cost_week = $_POST['cost_week'];
				update_option("myadmanager_cost_week",$cost_week);
				update_option("myadmanager_name_week",$name_week);
			}
		}
		
   		update_option("myadmanager_cost_month",$cost_month);
		update_option("myadmanager_name_month",$name_month);
		update_option("myadmanager_week_enable",$week_option);
		update_option("myadmanager_paypal_enable",$paypal_enable);

?>
<div class="updated"><p><strong><?php _e('Settings Updated.', 'mt_trans_domain' ); ?></strong></p></div>
<?php
    }
	    echo '<div class="wrap">';
    ?>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name_form1; ?>" value="Y">
<?php echo "<h2>" . __( 'Primary Settings', 'mt_trans_domain' ) . "</h2>";    ?>
<table class="form-table">
<tr><th scope="row" width="15%"><?php _e("No of Horizontal Ads :", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="ads_h" value="<?php echo $ads_h; ?>" size="5"><br />
How many ads to display horizontally</td>
</tr>
<tr><th scope="row">
<?php _e("No of Vertical Ads :", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="ads_v" value="<?php echo $ads_v; ?>" size="5"><br />
How many ads to display vertically</td>
</tr>
<tr><th scope="row">
<?php _e("Margin around Each AD :", 'mt_trans_domain' ); ?> </th><td>
<input type="e_margin" name="e_margin" value="<?php echo $e_margin; ?>" size="5"><br />
Margin around Each AD. Eg: <?php echo $e_margin; ?> = <strong><?php echo $e_margin_array[0]; ?>px top, <?php echo $e_margin_array[1]; ?>px right, <?php echo $e_margin_array[2]; ?>px bottom, <?php echo $e_margin_array[3]; ?>px left</strong>.</td>
</tr>
<tr><th scope="row">
<?php _e("Item Name for 1month :", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="name_month" value="<?php echo $name_month; ?>" size="20"><br />
Enter the text, which will be displayed in your Buy AD form
</td>
</tr>
<tr><th scope="row">
<?php _e("Cost per AD for 1month :", 'mt_trans_domain' ); ?> </th><td>
<strong>$</strong> <input type="text" name="cost_month" value="<?php echo $cost_month; ?>" size="5"><br />
Enter the amount per ad for a period of <strong>1 month</strong>.<br />
</td>
</tr>
<tr><th scope="row"><?php _e("Enable 7day Payment Option :", 'mt_trans_domain' ); ?></th><td>
<input type="checkbox" name="week_option" value="checked" <?php echo $week_option; ?>><br />
If you enable this, you can sell your ads for a period of 7 days as well.<br />
<?php if($week_option == "checked") { ?>
<span style="color:#259819">7 Day Options are <strong>ENABLED</strong><br />
<?php } else { echo '<span style="color:#FF0000">7 Day Options are <strong>DISABLED</strong></span>'; } ?>
</td>
</tr>
<?php if($week_option == "checked") { ?>
<tr><th scope="row">
<?php _e("Item Name for 1week :", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="name_week" value="<?php echo $name_week; ?>" size="20"><br />
Enter the text, which will be displayed in your Buy AD form.<br />
</td>
</tr>
<tr><th scope="row">
<?php _e("Cost per AD for 1week :", 'mt_trans_domain' ); ?> </th><td>
<strong>$</strong> <input type="text" name="cost_week" value="<?php echo $cost_week; ?>" size="5"><br />
Enter the amount per ad for a period of <strong>1 week</strong>.<br />
</td>
</tr>
<?php } ?>
</table>

<?php echo "<h2>" . __( 'Buy AD form Settings', 'mt_trans_domain' ) . "</h2>";    ?>
<table class="form-table">
<tr><th scope="row"><?php _e("Enable Paypal payment form :", 'mt_trans_domain' ); ?></th><td>
<input type="checkbox" name="paypal_enable" value="checked" <?php echo $paypal_enable; ?>><br />
If you enable this, MyAdManager will automatically manage your ads.<br />
New ads will be added automatically on realization of payment from PayPal.<br />
<?php if($paypal_enable == "checked") { ?>
<span style="color:#259819">Buy AD Form is <strong>ENABLED</strong><br />
To include the Buy AD Form, just add <strong>[myadmanager_show_form]</strong> in any of your wordpress post or page.</span>
</td>
</tr>
<tr><th scope="row" width="15%"><?php _e("Your Paypal email address:", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="paypal_add" value="<?php echo $paypal_add; ?>" size="20"><br />
Enter your paypal email address where you wish to recieve payments.</td>
</tr>
<tr><th scope="row" width="15%"><?php _e("Return Page after Successful Payment:", 'mt_trans_domain' ); ?> </th><td>
<input type="text" name="paypal_return_page" value="<?php echo $paypal_return_page; ?>" size="20"><br />
This is where the customer will land on, after successful payment. If no page is specified here, a defaut Thank you message will be displayed.<br />
<?php if($paypal_return_page == "") { ?>
<span style="color:#FF0000">Currently, there is no return address specified, so the default <strong>Thank You message</strong> will be displayed on realization of successful payment from paypal.</span>
<?php } else { ?>
<span style="color:#259819">Customer will be redirected to <strong><?php echo $paypal_return_page ?></strong> after successful payment. </span>
<?php } ?>
</td></tr>
<tr><th scope="row" width="15%"><?php _e("Email Message to your Customer after Successful Payment:", 'mt_trans_domain' ); ?> </th><td>
  <textarea name="paypal_email_msg" cols="60" rows="5"><?php echo $paypal_email_msg; ?></textarea>
  <br />
Enter the message you wish your customer to recieve when he has bought the ad.
<?php } else { echo '<span style="color:#FF0000">Buy AD Form is <strong>DISABLED</strong></span>'; } ?>
</td>
</tr>
</table>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>
</form>
<?php show_donate(); ?>
<?php echo show_footer(); ?>
</div>

<?php
 }

/*****************************
myadmanager_manage_page()
Ads are managed from this function.
+Managing ads i.e Delete, Activate and De-Activate
+Adding New Ads

@package MyAdManger
******************************/
function myadmanager_manage_page() {

//define globals
$ads = new myAds();
global $wpdb;

/* START FORM VARS TO EDIT/DELETE/UPDATE ADS */
	$hidden_manage_form = 'form_manage_ads';

    if( $_POST[$hidden_manage_form] == 'Y' ) {

		if($_POST['Active']) {
		foreach($_POST['ads'] as $i) {
			$ads->updateRecord("$ads->myAds_table","active=1",$i);
		}
		echo '<div class="updated"><p><strong>Activated</strong></p></div>';				
		}
		if($_POST['Inactive']) {
		foreach($_POST['ads'] as $i) {
			$ads->updateRecord("$ads->myAds_table","active=0",$i);
		}
		echo '<div class="updated"><p><strong>De-Activated</strong></p></div>';
		}
        
		if($_POST['Delete']) {
		foreach($_POST['ads'] as $i) {
			$ads->deleteRecord("$ads->myAds_table",$i);
		}
		echo '<div class="updated" style="color:red;"><p><strong>Deleted</strong></p></div>';
		}
		
}
/* END FORM VARS TO EDIT/DELETE/UPDATE ADS */

/* START FORM VARS TO ADD ADS */
	$hidden_manage_form_ad_add = 'form_add_ads';

    if( $_POST[$hidden_manage_form_ad_add] == 'Y' ) {
		$ad_name=mysql_real_escape_string($_POST['ad_name']);
		$ad_alt_text=$_POST['ad_alt_text'];
		$imagelink=$_POST['imagelink'];
		$hyperlink=$_POST['hyperlink'];
		$duration=$_POST['duration'];
		$type=$_POST['type'];
	
		$today = date("Y-m-d");
		$end = dateShift($today,$duration);
		
		if($type==1 && ((count($ads->getAds(1,"WHERE NOW()<end_date AND type=1 AND active=1")))>=$ads->getRegionOption("ad_total")))
				echo '<div class="updated" style="color:red;"><p><strong>You can`t Add more Ads outside, since your slots are full</strong></p></div>';
		else {
		$sql = "INSERT INTO ".$ads->myAds_table." VALUES (NULL,'1','1','$ad_name','$ad_alt_text','$imagelink','$hyperlink','$today','$end','1','$type');";
		if($wpdb->query ( $sql ))
			echo '<div class="updated"><p><strong>Ad Added</strong></p></div>';
		else
			echo '<div class="updated" style="color:red;"><p><strong>Ad Not Added</strong></p></div>';	
		}
	}
/* END FORM VARS TO ADD ADS */
	
echo "<div class=\"wrap\"><h2>" . __( 'Manage Ads', 'mt_trans_domain' ) . "</h2>";
?>

<form name="form_manage_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_manage_form; ?>" value="Y">

<table width="750" class="widefat"><thead><th scope="col">id</th><th scope="col" >Ad Name</th><th scope="col" width="300" >Link</th><th scope="col" >Start date</th><th scope="col" >End Date</th><th scope="col">Days Left</th><th scope="col">Active</th><th scope="col">Type of Ad</th><th scope="col">Actions</th></thead>
<?php
$showadsarray = $ads->getAds(1,"ORDER BY type,id DESC");
if(count($showadsarray) == 0)
echo "<tr><td colspan=\"8\" align=\"center\"><strong>No Ads to Display</strong></td></tr>";
else {
foreach($showadsarray as $showads) {

if($showads->type==0) {
	$type = "Home";
	}

if($showads->type ==1) {
	$type = "Outside";
	}

if($showads->active==0) {
	$style = 'style="background-color:#efefef;"';
	$active = "No";
	}

if($showads->active ==1) {
	$style = '""';
	$active = "Yes";
	}
	
$d = dateDiff(date("Y-m-d"),$showads->end_date);
echo "<tr id=$showads->id $style>
	<td>$showads->id</td>
	<td>$showads->ad_name</td>
	<td><a href=\"$showads->hyperlink\" rel=\"nofollow\"><img src=\"$showads->imagelink\" alt=\"$showads->ad_alt_text\" width=\"125\" height=\"125\"></a></td>
	<td>$showads->start_date</td>
	<td>$showads->end_date</td>
	<td>$d</td>
	<td>$active</td>
	<td>$type</td>
	<td><input type=\"checkbox\" name=\"ads[]\" id=\"ads[]\" value=\"$showads->id\" /></td>
</tr>";
}
}


?>
</table>
<p class="submit">
<input type="submit" name="Delete" value="Delete Ads" />
<input type="submit" name="Active" value="Activate Ads"/>
<input type="submit" name="Inactive" value="De-Activate Ads" />
</p>
</form><br /><br />

<h2><?php  _e( 'Add Ad', 'mt_trans_domain' );?></h2>
<form name="form_manage_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_manage_form_ad_add; ?>" value="Y">
<table class="form-table">
<tr>
<td width="15%"><?php _e("AD-Name:", 'mt_trans_domain' ); ?> </td><td><input type="text" name="ad_name" value="" size="20"><br />
Enter the advertisement name.</td>
</tr>
<tr>
<td width="15%"><?php _e("ALT for AD-Image:", 'mt_trans_domain' ); ?> </td><td><input type="text" name="ad_alt_text" value="" size="20"><br />
Enter the image alt text.</td>
</tr>
<tr>
<td><?php _e("URL of AD-Image:", 'mt_trans_domain' ); ?> </td><td><input type="text" name="imagelink" value="http://" size="20"><br />
Enter the url to the image. The image has to be 125x125 px, if not it will be resized</td>
</tr>
<tr>
<td><?php _e("Target URL:", 'mt_trans_domain' ); ?> </td><td><input type="text" name="hyperlink" value="http://" size="20"><br />
Enter the link you want the image to point to.</td>
</tr>
<tr>
<td><?php _e("Duration:", 'mt_trans_domain' ); ?> </td><td><select name="duration"><option value="7">A week</option><option value="30">A Month</option></select><br />
Select the duration for the ad to be active.<br />
<em>Home Ads don`t have any duration, they will always be available whenever required.</em></td>
</tr>
<tr>
<td><?php _e("Type of Ad:", 'mt_trans_domain' ); ?> </td><td><select name="type"><option value="0">Home</option><option value="1">Outside</option></select><br />
Enter the type of ad it is.<br />
Home : Your website's own ads. Internal Ads.<br />
Outside : External Ads.</td>
</tr>
</table>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Add Ad', 'mt_trans_domain' ) ?>" />
</p>

</form>
<?php show_donate(); ?>
<?php echo show_footer(); ?>
</div>
<?php
}

/*****************************
myadmanager_show()
Displays ads in the template

@package MyAdManger
******************************/
function myadmanager_show() {
$ads = new myAds();

$width=$ads->getRegionOption("width");
$max = $ads->getRegionOption("ad_total");

$adsarray = $ads->getAds(1,"WHERE NOW()<end_date AND type=1 AND active=1 ORDER BY RAND() LIMIT $max");

$limit = $max - count($adsarray);
?>
<!-- MyAdManager Plugin Starts !-->
<div class="groupads" style="width:<?php echo $width; ?>px;">
<?php
foreach( $adsarray as $ad ) {
if($ad->ad_alt_text = "")
	$ad->ad_alt_text = $ad->ad_name;

echo "<div class='myadmanager_ads'><a href=\"$ad->hyperlink\" title=\"$ad->ad_alt_text\" rel=\"nofollow\"><img src=\"$ad->imagelink\" alt=\"$ad->ad_alt_text\" width=\"125\" height=\"125\"></a></div>";
}

$adsarray = $ads->getAds(1,"WHERE type=0 AND active=1 ORDER BY id DESC LIMIT $limit");
foreach( $adsarray as $ad ) {
echo "<div class='myadmanager_ads'><a href=\"$ad->hyperlink\" title=\"$ad->ad_alt_text\" rel=\"nofollow\"><img src=\"$ad->imagelink\" alt=\"$ad->ad_alt_text\" width=\"125\" height=\"125\"></a></div>";
} ?>
<div style="clear:both;"></div>
</div>
<!-- MyAdManager Plugin Ends !-->

<?php
}

/*****************************
myadmanager_add_css_styles()
Adds the CSS file to the head section of the blog

@package MyAdManger
******************************/
function myadmanager_add_css_styles() {
$ads = new myAds();

$margin = $ads->getRegionOption("margin");
$margin_array = explode(',',$margin);

echo'<!-- MyAdManager Header Starts !-->';
echo '<link rel="stylesheet" href="'.WP_MYADMANAGER_URL.'/myadmanager.css" type="text/css" media="screen" />';
echo "<style type=\"text/css\">
.myadmanager_ads {float: left; height:125px; width:125px; margin:$margin_array[0]px $margin_array[1]px $margin_array[2]px $margin_array[3]px;}
</style>";
echo'<!-- MyAdManager Header Ends !-->';
}

/*****************************
_install()
For creating tables in the database. Basic Installer

@package MyAdManger
******************************/
function _install() {
require_once(dirname(__FILE__).'/install.php');
}
register_activation_hook(__FILE__,'_install');
	

/*****************************
myadmanager_show_form()
[myadmanager_show_form] will display the form in any page

@package MyAdManger
******************************/
function myadmanager_show_form() {
$ads = new myAds();
return $ads->show_form();
}

add_shortcode('myadmanager_show_form', 'myadmanager_show_form');
add_action('wp_head','myadmanager_add_css_styles');

?>
