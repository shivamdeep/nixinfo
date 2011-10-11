<?php
global $wpdb;

$table_name_ads = $wpdb->prefix."myAdManager_ads";
$table_name_regions = $wpdb->prefix."myAdManager_regions";
$table_name_transactions = $wpdb->prefix."myAdManager_transactions";

$cur_version = 0.42;

$installed_ver = get_option("myAdManager_db_version");

   if($installed_ver != $cur_version) {
	$sql = "CREATE TABLE " . $table_name_regions . " (
	  id int NOT NULL AUTO_INCREMENT,
	  region_name VARCHAR(255) NOT NULL,
	  ad_h int NOT NULL,
	  ad_v int NOT NULL,
	  ad_total int NOT NULL,
	  height INT NOT NULL,
	  width INT NOT NULL,
	  margin VARCHAR(255) NOT NULL,
	  PRIMARY KEY(id)
	);";

	$sql = $sql."CREATE TABLE ".$table_name_transactions." (
	  id int NOT NULL AUTO_INCREMENT,
	  first_name VARCHAR(255) NOT NULL,
	  last_name VARCHAR(255),
	  country VARCHAR(255) NOT NULL,
	  payer_email VARCHAR(255) NOT NULL,
	  verify_sign VARCHAR(255) NOT NULL,
	  item_name VARCHAR(255) NOT NULL,
	  gross float NOT NULL,
	  payment_date_time VARCHAR(255) NOT NULL,
	  payment_status VARCHAR(255) NOT NULL,
	  ad_id INT NOT NULL,
	  PRIMARY KEY(id)
	  );";
	  
	  $sql = $sql."CREATE TABLE " . $table_name_ads . " (
	  id int NOT NULL AUTO_INCREMENT,
	  region_id int NOT NULL,
	  cd_id int NOT NULL,
	  ad_name VARCHAR(255) NOT NULL,
	  ad_alt_text VARCHAR(255),
	  imagelink VARCHAR(255) NOT NULL,
	  hyperlink VARCHAR(255) NOT NULL,
	  start_date DATE NOT NULL,
	  end_date DATE NOT NULL,
	  active int NOT NULL DEFAULT 1,
	  type int NOT NULL DEFAULT 0,
	  PRIMARY KEY(id)
	);";	
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      
	  $dbresults = $wpdb->get_results("SHOW TABLES LIKE 'myAdManger'",ARRAY_N);
	  
	  if($dbresults) {
		$sql =  'ALTER TABLE '.$table_name_regions.' CHANGE `margin` `margin` VARCHAR( 255 ) NOT NULL';
	  }
	  
	  dbDelta($sql);

	  $insert = 'INSERT INTO '.$table_name_regions.' VALUES (1,"my ad",2,2,4,270,270,"3,3,2,0");';
	  $wpdb->query($insert);
	  
  	  $update = "UPDATE ".$table_name_regions." SET margin = '3,3,2,0' WHERE id = 1";
	  $wpdb->query($update);

	update_option("myAdManager_db_version",$cur_version);
	update_option("myadmanager_name_week",'125x125 AD Space - 1 week');
	update_option("myadmanager_name_month",'125x125 AD Space - 1 month');
	update_option("myadmanager_week_enable","checked");
	update_option("myadmanager_paypal_email_msg","Thanks for buying adspace here.");
	update_option("myadmanager_widget_title","Advertisement");
}

update_option("myAdManager_version",MY_AD_MANAGER_VERSION);


?>