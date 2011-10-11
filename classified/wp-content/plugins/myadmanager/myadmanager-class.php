<?php

define ('MY_AD_MANAGER_VERSION','0.9.3');

/*****************************
Class myAds

General Functions
* getAds($regionid=1,$params="")
* getRegionOption($param,$regionid=1)
* getTransactions($params="")
* updateRecord($tablename,$params,$id)
* deleteRecord($tablename,$params,$id)
* addRecord($tablename,$params,$id)

Extra
* show_form()
* dateShift($startDate,$num_days)
* dateDiff($startDate, $endDate)
* show_footer()
* show_donate()
* replace($template, $hash, $prefix = '{', $postfix = '}') @ v0.9

@package MyAdManger
******************************/
class myAds {

var $myAds_table;
var $myRegion_table;
var $myTransac_table;

	function myAds() {
		global $wpdb;
		$this->myAds_table=$wpdb->prefix."myAdManager_ads";
		$this->myRegion_table=$wpdb->prefix."myAdManager_regions";
		$this->myTransac_table=$wpdb->prefix."myAdManager_transactions";
	}
		
	//Get Ads for a particular region
	function getAds($regionid=1,$params="") { 
		global $wpdb;
		$sql="SELECT id,ad_name,ad_alt_text,imagelink,hyperlink,start_date,end_date,active,type FROM ".$this->myAds_table." $params ;";
	
		$adresults = $wpdb->get_results( $sql );				
		
		$asql="SELECT id,end_date FROM ".$this->myAds_table." WHERE NOW()>end_date AND type=1";
		$exresults = $wpdb->get_results( $asql );
		if(count($exresults)!=0) {
			foreach($exresults as $x) {
				$wpdb->query("UPDATE ".$this->myAds_table." SET active=0 WHERE id=$x->id");			
			}
		}
		return $adresults;
	}
	//Get region individual option
	function getRegionOption($param,$regionid=1) {
		global $wpdb;
		$sql = "SELECT $param FROM ".$this->myRegion_table." WHERE id='$regionid';";
		$regionoption = $wpdb->get_results( $sql );
		foreach($regionoption as $r)
			return $r->$param;
	}
	
	function getTransactions($params="") {
		global $wpdb;
		$sql="SELECT ".$this->myTransac_table.".id,first_name,last_name,payer_email,item_name,gross,payment_date_time,ad_id,ad_name,hyperlink FROM ".$this->myTransac_table." LEFT JOIN (".$this->myAds_table.") ON (".$this->myAds_table.".id=".$this->myTransac_table.".ad_id) $params";
		$results = $wpdb->get_results( $sql );
		return $results;
	
	}
	
	//Update options
	function updateRecord($tablename,$params,$id) {
		global $wpdb;
		
		$sql = "UPDATE $tablename SET $params WHERE id=$id;";
		$wpdb->query( $sql );		
	}
	
	//delete
	function deleteRecord($tablename,$id) {
		global $wpdb;
		$sql = "DELETE FROM $tablename WHERE id='$id';";
		$wpdb->query($sql);
	}

	function addRecord($tablename,$params) {
		global $wpdb;
		$sql = "INSERT INTO $tablename VALUES ($params);";
		$wpdb->query($sql);	
	
	}
	
	/*****************************
	show_form()
	Shows form to buy ad
	
	@package MyAdManger
	******************************/
	function show_form() {
		if(get_option('myadmanager_paypal_enable') == "checked" && ((count($this->getAds(1,"WHERE NOW()<end_date AND type=1 AND active=1")))<$this->getRegionOption("ad_total")))	 {
		ob_start();
		include(dirname(__FILE__).'/form.template.html');
		$process_url = WP_MYADMANAGER_URL.'/form.php?action=process';
		
		$l .= ob_get_contents();
		
		if(get_option('myadmanager_week_enable') == "checked")
			$o = '<option value="7">'.get_option('myadmanager_name_week').' - $'.get_option('myadmanager_cost_week').'</option>';
		$o .= '<option value="30">'.get_option('myadmanager_name_month').' - $'.get_option('myadmanager_cost_month').'</option>';		
				
		ob_end_clean();
		
		$l = replace("$l", array('product_options' => "<select name='duration'>$o</select>" , 'process_url' => "$process_url", 'ad_name' => '<input type="text" name="ad_name" value="" id="ad_name">', 'ad_image_url' => '<input name="imagelink" type="text" value="http://" maxlength="90">', 'ad_image_alt' => '<input name="ad_alt_text" type="text" value="" maxlength="60">', 'ad_url' => '<input name="hyperlink" type="text" value="http://" size="20" maxlength="90">'));
		
		
		}
		else {
			//if admin disables board or if all ad-slots are full
			$l = '<div align="center" style="background-color:#dbdbdb; padding:7px; margin:10px; font-size:14px; color:000;">';
			if(get_option('myadmanager_paypal_enable') != "checked")
				$l .= 'Buy Form currently Disabled by Administrator';
			else
				$l .= 'Buy Form currently disabled because all the AdSlots are full.';
			$l .= '</div>';
		}
		
		return $l.show_footer();
		}

} //end class


/*****************************
dateShift($startDate,$num_days)
shifts current date by $num_days

dateDiff($startDate, $endDate)
returns integer difference of 2 dates

@package MyAdManger
******************************/
function dateShift($startDate,$num_days)
{   
    $my_time = strtotime ($startDate);
    $timestamp = $my_time + ($num_days * 86400); 
    $return_date = date("Y-m-d",$timestamp);
   
    return $return_date;
} 

function dateDiff($startDate, $endDate)
{
    // Parse dates for conversion
    $startArry = explode('-',$startDate);
    $endArry = explode('-',$endDate);

    // Convert dates to Julian Days
    $start_date = gregoriantojd($startArry[1], $startArry[2], $startArry[0]);
    $end_date = gregoriantojd($endArry[1], $endArry[2], $endArry[0]);

    // Return difference
    $ans = round(($end_date - $start_date), 0);
	if($ans<0)
		$ans='Expired';

	return $ans;
} 

/*****************************
replace($template, $hash, $prefix = '{', $postfix = '}')
returns replaced text

@package MyAdManger
@version 0.9
******************************/
function replace($template, $hash, $prefix = '{', $postfix = '}')
{
    $tmp = array();
    foreach($hash as $k => $v)
    {
        $tmp[$prefix . $k . $postfix] = $v;
    }
    return str_replace(array_keys($tmp), array_values($tmp), $template);
}


/*****************************
show_footer()
Shows footer

@package MyAdManger
******************************/
function show_footer() {
return '<p align="right" style="font-family:Verdana;font-size:12px;"><strong>Powered by <a href="http://www.visionmasterdesigns.com/wordpress-plugins/myadmanager/">MyADManager '.MY_AD_MANAGER_VERSION.'</a></strong></p>';
}

/*****************************
show_donate()
Shows donate form

@package MyAdManger
******************************/
function show_donate() {
echo '<div style=" width:65%;border:1px dashed #eb9320;background-color:#fafcc7;text-align:center;margin:0 auto 10px auto;padding:5px;">
If you find this plugin really useful and would like to contribute to the further development of this plugin, please do donate. <strong>Every individual donation counts....</strong> !<br />
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="325864">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>';
}

?>
