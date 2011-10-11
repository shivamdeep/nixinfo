<?php


class PremiumPressTheme_Datafeedr {

	function IMPORTPRODUCTS(){
	
	global $PPT,$wpdb; $AddtoCats = array(); $AddCounter=0; $UpdateCounter=0; $sc=array();
	
	
	// FIRST SETUP THE CATEGORIES MAKING IMPORT EASIER
	$RUN_QUERY1 = "SELECT ".$wpdb->prefix."dfr_shop_cats.*  FROM ".$wpdb->prefix."dfr_shop_cats ORDER BY parent ASC"; 
	$result = mysql_query($RUN_QUERY1, $wpdb->dbh);
	
	while ($cats = mysql_fetch_array($result)) {
	
		if($cats['parent'] == 0){
		
			$catzID = $this->wp_create_category1($cats['name']);
			
			$sc[$cats['id']]['ncat'] = $catzID;
		
		}else{
		
			$this->wp_create_category1($cats['name'], $sc[$cats['parent']]['ncat']);
		
		}
		 
		
	}
 
	
	
		$RUN_QUERY = "SELECT ".$wpdb->prefix."dfr_shop_products.*, ".$wpdb->prefix."dfr_shop_cats.name AS categoryName FROM ".$wpdb->prefix."dfr_shop_products INNER JOIN ".$wpdb->prefix."dfr_shop_cats ON (".$wpdb->prefix."dfr_shop_cats.id = ".$wpdb->prefix."dfr_shop_products.cat_id )";
		
	 		 
		$result = mysql_query($RUN_QUERY, $wpdb->dbh);
		while ($product = mysql_fetch_array($result)) {
		
		
		// CHECK FOR DUPLICATE ENTIRES
		$SQL = "SELECT ".$wpdb->prefix."postmeta.post_id AS POSTID FROM $wpdb->postmeta
		WHERE $wpdb->postmeta.meta_value = ('".$product['id']."') AND $wpdb->postmeta.meta_key = 'datafeedr_productID'
		LIMIT 1";
			 
		$result1 = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);						
		$array = mysql_fetch_assoc($result1);
		
		
			// SETUP THE CATEGORY		
			$catzID = $this->wp_create_category1($product['categoryName']);						
			array_push($AddtoCats,$catzID);		
			
			// SETUP MAIN DAATA
			$my_post = array();
			$my_post['post_title'] 		= $product['name'];
			$my_post['post_content'] 	= $product['description'];
			$my_post['post_excerpt'] 	= "";
			$my_post['post_author'] 	= 1;
			$my_post['post_status'] 	= "publish";
			$my_post['post_category'] 	= $AddtoCats;
			if(strlen($product['tags']) > 1){ 
			$my_post['tags_input'] = explode(str_replace(" ",",",str_replace("-","",str_replace("/","",str_replace("&","",$product['tags'])))),",");
			}
			
			// BUILD CUSTOM FIELDS
			$customFields = array(
			"price" 				=> $product['price'],
			"featured" 				=> "no",
			"image" 				=> $product['image'],
			"buy_link" 				=> $product['url'],
			"hits" 					=> 0,
			"datafeedr_productID" 	=> $product['id'],
			"datafeedr_network" 	=> $product['network'],
			"datafeedr_merchant"	=> $product['merchant'],
			"datafeedr_merchant_id" => $product['merchant_id']			
			);
			
			
			
			if(empty($array['POSTID'])) {
			 
			$POSTID = wp_insert_post( $my_post );
			foreach($customFields as $key=>$val){ add_post_meta($POSTID,$key,$val); }
			$AddCounter++;
			
			}else{
			
			$my_post['ID'] 	= $array['POSTID'];
			wp_update_post( $my_post );
			foreach($customFields as $key=>$val){ update_post_meta($array['POSTID'],$key,$val); }
			
			 $UpdateCounter++;
				  
			} 
			
		}
		
		return $AddCounter."-".$UpdateCounter;
	
	
	}

function COUNTPRODUCTS(){

	global $PPT,$wpdb; $AddtoCats = array(); $AddCounter=0; $UpdateCounter=0;


		// CHECK FOR DUPLICATE ENTIRES
		$SQL = "SELECT COUNT(".$wpdb->prefix."dfr_shop_products.id) AS total FROM ".$wpdb->prefix."dfr_shop_products";
			  
		$result1 = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);						
		$array = mysql_fetch_assoc($result1);
		
		return $array['total'];
		
}	
	
	
	function category_exists1($cat_name, $parent = 0) {
		$id = term_exists($cat_name, 'category', $parent);
		if ( is_array($id) )
			$id = $id['term_id'];
		return $id;
	}	
	
	function wp_create_category1( $cat_name, $parent = 0 ) {
	if ( $id = category_exists1($cat_name) )
		return $id;

	return wp_insert_category1( array('cat_name' => $cat_name, 'category_parent' => $parent) );
	}

	function wp_insert_category1($catarr, $wp_error = false) {
	
	$cat_defaults = array('cat_ID' => 0, 'cat_name' => '', 'category_description' => '', 'category_nicename' => '', 'category_parent' => '');
	$catarr = wp_parse_args($catarr, $cat_defaults);
	extract($catarr, EXTR_SKIP);

	if ( trim( $cat_name ) == '' ) {
		if ( ! $wp_error )
			return 0;
		else
			return new WP_Error( 'cat_name', __('You did not enter a category name.') );
	}

	$cat_ID = (int) $cat_ID;

	// Are we updating or creating?
	if ( !empty ($cat_ID) )
		$update = true;
	else
		$update = false;

	$name = $cat_name;
	$description = $category_description;
	$slug = $category_nicename;
	$parent = $category_parent;

	$parent = (int) $parent;
	if ( $parent < 0 )
		$parent = 0;

	if ( empty($parent) || !category_exists1( $parent ) || ($cat_ID && cat_is_ancestor_of($cat_ID, $parent) ) )
		$parent = 0;

	$args = compact('name', 'slug', 'parent', 'description');

	if ( $update )
		$cat_ID = wp_update_term($cat_ID, 'category', $args);
	else
		$cat_ID = wp_insert_term($cat_name, 'category', $args);

	if ( is_wp_error($cat_ID) ) {
		if ( $wp_error )
			return $cat_ID;
		else
			return 0;
	}

	return $cat_ID['term_id'];
	}	
	
	

}

?>