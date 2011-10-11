 <?php

if(!function_exists("selfURL1")){ function selfURL1() {
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = "http".$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
			: (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port;
	}
}

if(!function_exists("FilterPath")){

	function FilterPath(){
		$path=dirname(realpath($_SERVER['SCRIPT_FILENAME']));
		$path_parts = pathinfo($path);
		return $path;
	}
}

if(function_exists("get_option")){ 

	// DELETE DEFAULT LINKS
	if(isset($_POST['RESETME']) && $_POST['RESETME'] =="yes"){

		mysql_query("DELETE FROM ".$wpdb->links."");
		mysql_query("DELETE FROM ".$wpdb->posts."");
		mysql_query("DELETE FROM ".$wpdb->postmeta."");
		mysql_query("DELETE FROM ".$wpdb->terms."");
		mysql_query("DELETE FROM ".$wpdb->term_taxonomy."");
		mysql_query("DELETE FROM ".$wpdb->term_relationships."");
		mysql_query("DELETE FROM wp_shopperpress_orders");
		mysql_query("DELETE FROM ".$wpdb->comments."");
		mysql_query("DELETE FROM ".$wpdb->commentmeta."");
	}
 

// CATEGORY SETUP
 

$pages_array = "";
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'My Account';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$my_post['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$pages_array .= $page1_id.",";
update_post_meta($page1_id , '_wp_page_template', 'tpl-myaccount.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Articles';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$ARTID = $page1_id;
update_post_meta($page1_id , '_wp_page_template', 'tpl-articles.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Contact';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
update_post_meta($page1_id , '_wp_page_template', 'tpl-contact.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Callback';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$pages_array .= $page1_id.",";
update_post_meta($page1_id , '_wp_page_template', 'tpl-callback.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Manage';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$pages_array .= $page1_id.",";
update_post_meta($page1_id , '_wp_page_template', 'tpl-edit.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Messages';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$pages_array .= $page1_id.",";
update_post_meta($page1_id , '_wp_page_template', 'tpl-messages.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Submit';
$page1['post_content'] = '';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
$page1_id = wp_insert_post( $page1 );
$pages_array .= $page1_id.",";
update_post_meta($page1_id , '_wp_page_template', 'tpl-add.php');
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Privacy';
$page1['post_content'] = 'Enter your privacy information here.';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
wp_insert_post( $page1 );
// CREATE PAGES
$page1 = array();
$page1['post_title'] = 'Terms';
$page1['post_content'] = 'Enter your terms and conditions here.';
$page1['post_status'] = 'publish';
$page1['post_type'] = 'page';
$page1['post_author'] = 1;
$page1['post_category'] = array($CATID);
wp_insert_post( $page1 );

wp_delete_term( $CATID+1, 'category' );


update_option("theme","classifiedstheme-default");
update_option("language","language_english");

// PAGE VALES
update_option("submit_url", 	selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."submit/");
update_option("manage_url", 	selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."manage/");
update_option("dashboard_url",	selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."my-account/");

update_option("sitemap_url", 	selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."sitemap.xml");
update_option("parivacy_url", 	selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."privacy/");
update_option("tc_url", 		selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."terms/");

// HIDDEN PAGES
update_option("excluded_pages",$pages_array);
update_option("article_cats","-".$CATID);


// IMAGE STORAGE PATHS
update_option("imagestorage_link",selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."wp-content/themes/classifiedstheme/thumbs/");
update_option("imagestorage_path",str_replace("wp-admin","wp-content/themes/classifiedstheme/thumbs/",str_replace("\\","/",FilterPath())));

// POST PRUN SETTINGS
update_option("post_prun","no");
update_option("prun_period","30");

update_option("display_submit","1");

update_option("shop_image_cache","no");

update_option("advertising_top_checkbox", "1");
update_option("advertising_top_adsense", '<a href="http://www.'.''.'premiumpress.com/?source=free-classifieds"><img src="http://www.premiumpress.com/banner/468x60_1.gif" alt="premium wordpress themes" /></a>');
	
update_option("advertising_left_checkbox", "1");
update_option("advertising_left_adsense", '<div style="padding-left:0px;"><a href="http://www.premiumpress.com/?source=free-directorypress">
<img src="http://www.premiumpress.com/banner/125x125.gif" alt="premium wordpress themes" /></a></div>');




update_option("homepage_featured_title","Featured Listings");
 

update_option("display_categories_count","yes");
update_option("display_featuredbox","1");

 
update_option("copyright","Type anything you want here.. even say thank you Mark Fail for the great theme!");
 

update_option("currency_code","$");

mysql_query("INSERT INTO `".$wpdb->posts."` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(48, 1, '2009-12-15 14:59:46', '2009-12-15 14:59:46', 'Irvine, 5th December 2009. As the eagerly awaited Aston Martin Rapide four-door sports car goes through final engineering and testing phases before being launched in early quarter two 2010, Aston Martin confirms US pricing.\r\n\r\nThe price of the Rapide will start from $199,950 in the US which features an impressive level of standard specification including: Bang &amp; Olufsen Beosound audio system tailored specifically for Rapide, heated memory seats, dual cast brakes and Adaptive Damping System.\r\n\r\nThe Rapide is Aston Martin''s first production four-door sports car encapsulating the practicality of a car with extra doors and fusing it with the trademark sports car dynamics synonymous with modern Aston Martins.\r\n\r\nCustomer deliveries will commence in spring 2010, and it will be the first sports car to be hand-built at the Aston Martin Rapide Plant (AMRP) in Graz, Austria. The new 17,000 m2 building has been designed to reflect the quality levels established in Gaydon since 2003 permitting the fusion of modern technology, advanced manufacturing processes and handbuilt craftsmanship. Each Rapide will take approximately 220 man hours to build and will benefit from timeless craft skills just like the existing range: DBS, DB9, V12 and V8 Vantage do at Gaydon.\r\n\r\nIt is anticipated that +- 2,000 Rapides will be built in the first year attracting a high proportion of new customers to the brand. Core to this trend is the mix of huge attention to detail throughout the car, ample accommodation for up to four adults and the spacious trunk while maintaining Rapide''s elegant beauty and sports car profile.\r\n\r\nThe Rapide is on sale now available to order from the Aston Martin dealership network across North America.', '2011 Aston Martin Rapide', 'The Rapide is on sale now available to order from the Aston Martin dealership network across North America.', 'publish', 'open', 'open', '', '2011-aston-martin-rapide', '', '', '2009-12-15 15:08:55', '2009-12-15 15:08:55', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=48', 0, 'post', '', 0),

(52, 1, '2009-12-15 15:19:51', '2009-12-15 15:19:51', '<strong>LOS ANGELES, Dec. 3, 2009</strong> ?In 2010, a revolutionary new Tucson joins the rapidly evolving Hyundai product line. The sleek crossover from Hyundai, with its athletic European design, strikes a stark contrast from its predecessor and improves in every functional area, from its roomier cabin with extra cargo space to its leap in fuel economy and technology. Tucson features the company''s \"Fluidic Sculpture\" design language and is the first vehicle in Hyundai''s 24/7 version 2.0 product initiative (seven all-new models by the end of 2011).\r\n\r\n<span>The all-new Tucson is the first Hyundai CUV (Crossover Utility Vehicle) to be designed and engineered in Europe at Hyundai''s Frankfurt-based design and technical centers. </span>It features precedent-setting engineering including advanced weight saving technology and the eco-efficient Theta II 2.4-liter four-cylinder engine delivering up to 31 mpg on the highway. True to Hyundai form, the Tucson applies life-saving safety technologies as standard equipment while offering, for the first time, Downhill Brake Control (DBC) and Hillstart Assist Control (HAC). Likewise, to keep its passengers informed and comfortable Tucson integrates Hyundai''s first panoramic sunroof, touch-screen navigation and a Bluetooth<sup>?/sup> hands-free phone system.\r\n\r\n<strong>EUROPEAN DESIGN </strong>\r\n\r\nKey attributes of Hyundai''s Fluidic Sculpture design philosophy are the athleticism and sophistication that Tucson demonstrates through its flowing lines, full surfaces and muscular presence. This athletic design language is highlighted by bold, dynamic graphic elements such as the new Hyundai family hexagonal front grille, aggressive lower air intake, sculptured hood creases, swept back headlights, sleek greenhouse and wraparound taillights. Chrome grille accents and door handles lend sophistication to the top-of-the-line Tucson Limited.\r\n\r\nConceived in a global collaboration among Hyundai''s U.S., Korean and European advanced product groups, with design execution led by the Frankfurt studio, the new Tucson was developed as an urban cruiser. It is tough and compact for life in the city, yet sleek and agile for out-of-town travel.\r\n\r\nThe Tucson combines dynamic, sculpted, performance-oriented styling with thoughtful everyday utility to create a vehicle that will change the way consumers, especially younger car buyers, think about compact crossovers.\r\n\r\nWith an overall length of 173.2 inches, a width of 71.7 inches and a height of 66.3 inches (with roof rails), Tucson has a great stance and road presence. The design team fused a light, elegant and sporty upper body with belt lines flowing off both the front and rear wheel arches, to a tough, planted lower body so that it is assertive in the way it sits on the road.\r\n\r\nThe profile of Tucson features a sports car-like theme with a double-zigzag treatment for the wheel arches that wrap around the available Euroflange 18-inch alloy wheels. The concave sills have a wedge-shaped profile that extends rearward and wraps around into the rear bumper, a first of its kind design in a vehicle of this type. The profile is further enhanced by modern silver roof rails.', '2010 Hyundai Tucson', 'With high-mounted taillights, multi-surfaced glass and a sculpted bumper, the rear of Tucson also incorporates dynamic design elements.', 'publish', 'open', 'open', '', '2010-hyundai-tucson', '', '', '2009-12-15 15:19:51', '2009-12-15 15:19:51', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=52', 0, 'post', '', 0),
(53, 1, '2009-12-15 15:14:07', '2009-12-15 15:14:07', '<strong>LOS ANGELES, Dec. 3, 2009</strong> In 2010, a revolutionary new Tucson joins the rapidly evolving Hyundai product line. The sleek crossover from Hyundai, with its athletic European design, strikes a stark contrast from its predecessor and improves in every functional area, from its roomier cabin with extra cargo space to its leap in fuel economy and technology. Tucson features the company''s \"Fluidic Sculpture\" design language and is the first vehicle in Hyundai''s 24/7 version 2.0 product initiative (seven all-new models by the end of 2011).\n\n<span>The all-new Tucson is the first Hyundai CUV (Crossover Utility Vehicle) to be designed and engineered in Europe at Hyundai''s Frankfurt-based design and technical centers. </span>It features precedent-setting engineering including advanced weight saving technology and the eco-efficient Theta II 2.4-liter four-cylinder engine delivering up to 31 mpg on the highway. True to Hyundai form, the Tucson applies life-saving safety technologies as standard equipment while offering, for the first time, Downhill Brake Control (DBC) and Hillstart Assist Control (HAC). Likewise, to keep its passengers informed and comfortable Tucson integrates Hyundai''s first panoramic sunroof, touch-screen navigation and a Bluetooth hands-free phone system.\n\n<strong>EUROPEAN DESIGN </strong>\n\nKey attributes of Hyundai''s Fluidic Sculpture design philosophy are the athleticism and sophistication that Tucson demonstrates through its flowing lines, full surfaces and muscular presence. This athletic design language is highlighted by bold, dynamic graphic elements such as the new Hyundai family hexagonal front grille, aggressive lower air intake, sculptured hood creases, swept back headlights, sleek greenhouse and wraparound taillights. Chrome grille accents and door handles lend sophistication to the top-of-the-line Tucson Limited.\n\nConceived in a global collaboration among Hyundai''s U.S., Korean and European advanced product groups, with design execution led by the Frankfurt studio, the new Tucson was developed as an urban cruiser. It is tough and compact for life in the city, yet sleek and agile for out-of-town travel.\n\nThe Tucson combines dynamic, sculpted, performance-oriented styling with thoughtful everyday utility to create a vehicle that will change the way consumers, especially younger car buyers, think about compact crossovers.\n\nWith an overall length of 173.2 inches, a width of 71.7 inches and a height of 66.3 inches (with roof rails), Tucson has a great stance and road presence. The design team fused a light, elegant and sporty upper body with belt lines flowing off both the front and rear wheel arches, to a tough, planted lower body so that it is assertive in the way it sits on the road.\n\nThe profile of Tucson features a sports car-like theme with a double-zigzag treatment for the wheel arches that wrap around the available Euroflange 18-inch alloy wheels. The concave sills have a wedge-shaped profile that extends rearward and wraps around into the rear bumper, a first of its kind design in a vehicle of this type. The profile is further enhanced by modern silver roof rails.', '2010 Hyundai Tucson', 'With high-mounted taillights, multi-surfaced glass and a sculpted bumper, the rear of Tucson also incorporates dynamic design elements.', 'inherit', 'open', 'open', '', '52-revision', '', '', '2009-12-15 15:14:07', '2009-12-15 15:14:07', '', 52, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=53', 0, 'revision', '', 0),


(54, 1, '2009-12-15 15:43:56', '2009-12-15 15:43:56', '<strong>LOS ANGELES, Dec. 3, 2009</strong> ?In 2010, a revolutionary new Tucson joins the rapidly evolving Hyundai product line. The sleek crossover from Hyundai, with its athletic European design, strikes a stark contrast from its predecessor and improves in every functional area, from its roomier cabin with extra cargo space to its leap in fuel economy and technology. Tucson features the company''s \"Fluidic Sculpture\" design language and is the first vehicle in Hyundai''s 24/7 version 2.0 product initiative (seven all-new models by the end of 2011).\n\n<span>The all-new Tucson is the first Hyundai CUV (Crossover Utility Vehicle) to be designed and engineered in Europe at Hyundai''s Frankfurt-based design and technical centers. </span>It features precedent-setting engineering including advanced weight saving technology and the eco-efficient Theta II 2.4-liter four-cylinder engine delivering up to 31 mpg on the highway. True to Hyundai form, the Tucson applies life-saving safety technologies as standard equipment while offering, for the first time, Downhill Brake Control (DBC) and Hillstart Assist Control (HAC). Likewise, to keep its passengers informed and comfortable Tucson integrates Hyundai''s first panoramic sunroof, touch-screen navigation and a Bluetooth<sup>?/sup> hands-free phone system.\n\n<strong>EUROPEAN DESIGN </strong>\n\nKey attributes of Hyundai''s Fluidic Sculpture design philosophy are the athleticism and sophistication that Tucson demonstrates through its flowing lines, full surfaces and muscular presence. This athletic design language is highlighted by bold, dynamic graphic elements such as the new Hyundai family hexagonal front grille, aggressive lower air intake, sculptured hood creases, swept back headlights, sleek greenhouse and wraparound taillights. Chrome grille accents and door handles lend sophistication to the top-of-the-line Tucson Limited.\n\nConceived in a global collaboration among Hyundai''s U.S., Korean and European advanced product groups, with design execution led by the Frankfurt studio, the new Tucson was developed as an urban cruiser. It is tough and compact for life in the city, yet sleek and agile for out-of-town travel.\n\nThe Tucson combines dynamic, sculpted, performance-oriented styling with thoughtful everyday utility to create a vehicle that will change the way consumers, especially younger car buyers, think about compact crossovers.\n\nWith an overall length of 173.2 inches, a width of 71.7 inches and a height of 66.3 inches (with roof rails), Tucson has a great stance and road presence. The design team fused a light, elegant and sporty upper body with belt lines flowing off both the front and rear wheel arches, to a tough, planted lower body so that it is assertive in the way it sits on the road.\n\nThe profile of Tucson features a sports car-like theme with a double-zigzag treatment for the wheel arches that wrap around the available Euroflange 18-inch alloy wheels. The concave sills have a wedge-shaped profile that extends rearward and wraps around into the rear bumper, a first of its kind design in a vehicle of this type. The profile is further enhanced by modern silver roof rails.', '2010 Hyundai Tucson', 'With high-mounted taillights, multi-surfaced glass and a sculpted bumper, the rear of Tucson also incorporates dynamic design elements.', 'inherit', 'open', 'open', '', '52-autosave', '', '', '2009-12-15 15:43:56', '2009-12-15 15:43:56', '', 52, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=54', 0, 'revision', '', 0),
(50, 1, '2009-12-15 15:10:00', '2009-12-15 15:10:00', 'Irvine, 5th December 2009. As the eagerly awaited Aston Martin Rapide four-door sports car goes through final engineering and testing phases before being launched in early quarter two 2010, Aston Martin confirms US pricing.\n\nThe price of the Rapide will start from $199,950 in the US which features an impressive level of standard specification including: Bang &amp; Olufsen Beosound audio system tailored specifically for Rapide, heated memory seats, dual cast brakes and Adaptive Damping System.\n\nThe Rapide is Aston Martin''s first production four-door sports car encapsulating the practicality of a car with extra doors and fusing it with the trademark sports car dynamics synonymous with modern Aston Martins.\n\nCustomer deliveries will commence in spring 2010, and it will be the first sports car to be hand-built at the Aston Martin Rapide Plant (AMRP) in Graz, Austria. The new 17,000 m2 building has been designed to reflect the quality levels established in Gaydon since 2003 permitting the fusion of modern technology, advanced manufacturing processes and handbuilt craftsmanship. Each Rapide will take approximately 220 man hours to build and will benefit from timeless craft skills just like the existing range: DBS, DB9, V12 and V8 Vantage do at Gaydon.\n\nIt is anticipated that +- 2,000 Rapides will be built in the first year attracting a high proportion of new customers to the brand. Core to this trend is the mix of huge attention to detail throughout the car, ample accommodation for up to four adults and the spacious trunk while maintaining Rapide''s elegant beauty and sports car profile.\n\nThe Rapide is on sale now available to order from the Aston Martin dealership network across North America.', '2011 Aston Martin Rapide', 'The Rapide is on sale now available to order from the Aston Martin dealership network across North America.', 'inherit', 'open', 'open', '', '48-autosave', '', '', '2009-12-15 15:10:00', '2009-12-15 15:10:00', '', 48, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=50', 0, 'revision', '', 0),
(49, 1, '2009-12-15 14:58:44', '2009-12-15 14:58:44', 'Irvine, 5th December 2009. As the eagerly awaited Aston Martin Rapide four-door sports car goes through final engineering and testing phases before being launched in early quarter two 2010, Aston Martin confirms US pricing.\n\nThe price of the Rapide will start from $199,950 in the US which features an impressive level of standard specification including: Bang &amp; Olufsen Beosound audio system tailored specifically for Rapide, heated memory seats, dual cast brakes and Adaptive Damping System.\n\nThe Rapide is Aston Martin''s first production four-door sports car encapsulating the practicality of a car with extra doors and fusing it with the trademark sports car dynamics synonymous with modern Aston Martins.\n\nCustomer deliveries will commence in spring 2010, and it will be the first sports car to be hand-built at the Aston Martin Rapide Plant (AMRP) in Graz, Austria. The new 17,000 m2 building has been designed to reflect the quality levels established in Gaydon since 2003 permitting the fusion of modern technology, advanced manufacturing processes and handbuilt craftsmanship. Each Rapide will take approximately 220 man hours to build and will benefit from timeless craft skills just like the existing range: DBS, DB9, V12 and V8 Vantage do at Gaydon.\n\nIt is anticipated that +/- 2,000 Rapides will be built in the first year attracting a high proportion of new customers to the brand. Core to this trend is the mix of huge attention to detail throughout the car, ample accommodation for up to four adults and the spacious trunk while maintaining Rapide''s elegant beauty and sports car profile.\n\nThe Rapide is on sale now available to order from the Aston Martin dealership network across North America.', '2011 Aston Martin Rapide', 'Aston Martin Announces Rapide Pricing for the United States', 'inherit', 'open', 'open', '', '48-revision', '', '', '2009-12-15 14:58:44', '2009-12-15 14:58:44', '', 48, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=49', 0, 'revision', '', 0),
(51, 1, '2009-12-15 14:59:46', '2009-12-15 14:59:46', 'Irvine, 5th December 2009. As the eagerly awaited Aston Martin Rapide four-door sports car goes through final engineering and testing phases before being launched in early quarter two 2010, Aston Martin confirms US pricing.\r\n\r\nThe price of the Rapide will start from $199,950 in the US which features an impressive level of standard specification including: Bang &amp; Olufsen Beosound audio system tailored specifically for Rapide, heated memory seats, dual cast brakes and Adaptive Damping System.\r\n\r\nThe Rapide is Aston Martin''s first production four-door sports car encapsulating the practicality of a car with extra doors and fusing it with the trademark sports car dynamics synonymous with modern Aston Martins.\r\n\r\nCustomer deliveries will commence in spring 2010, and it will be the first sports car to be hand-built at the Aston Martin Rapide Plant (AMRP) in Graz, Austria. The new 17,000 m2 building has been designed to reflect the quality levels established in Gaydon since 2003 permitting the fusion of modern technology, advanced manufacturing processes and handbuilt craftsmanship. Each Rapide will take approximately 220 man hours to build and will benefit from timeless craft skills just like the existing range: DBS, DB9, V12 and V8 Vantage do at Gaydon.\r\n\r\nIt is anticipated that +/- 2,000 Rapides will be built in the first year attracting a high proportion of new customers to the brand. Core to this trend is the mix of huge attention to detail throughout the car, ample accommodation for up to four adults and the spacious trunk while maintaining Rapide''s elegant beauty and sports car profile.\r\n\r\nThe Rapide is on sale now available to order from the Aston Martin dealership network across North America.', '2011 Aston Martin Rapide', 'Aston Martin Announces Rapide Pricing for the United States', 'inherit', 'open', 'open', '', '48-revision-2', '', '', '2009-12-15 14:59:46', '2009-12-15 14:59:46', '', 48, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=51', 0, 'revision', '', 0),

(66, 1, '2009-12-15 15:56:12', '2009-12-15 15:56:12', 'Chevrolet Lumina SS Elected \"Sports Saloon of The Year\" by CAR Middle East\n<div>Dubai, United Arab Emirates ?Leading UAE based magazine                    and one of the world''s most established and authoritative                    motoring titles, CAR Middle East, has named the Chevrolet                    Lumina SS as \"Best Sports Saloon\" for 2007. The ''Car of the                    Year (COTY)'' awards were launched this year to coincide with                    the 9th Middle East International Motor Show.</div>\n<div>According to Shahzad Sheikh, Editor of CAR Middle East,                    \"The Chevrolet Lumina SS has a 6.0-Litre V8 Corvette engine                    under the bonnet. Need I say more? This all new-car from ''down                    under'' is a fantastic reinterpretation of the cult Lumina SS.                    No other car offers this level of practicality, performance,                    and potential tail-sliding fun for the money.\"</div>\n<div>This is the first time the influential Middle East                    edition of CAR magazine has presented awards in the region and                    Sheikh added that: ''The Lumina SS edged ahead of some fierce                    competition to deservedly take the ultimate sports saloon                    award and perfectly demonstrates GM''s renewed commitment to                    giving us the cars we really want to drive. Well done!\" A jury                    of six regional automotive experts carefully picked the                    winners from 125 cars in total judging on quality, innovation,                    engineering, style and relevance to the Middle East market to                    crown the winners.</div>\n<div>The Lumina SS powered by a 6.0-litre V8 engine now                    delivers standard power of 360hp (net) at 5700 rpm and torque                    of 530 Nm as measured under the international ECE standard.                    Bigger 18\" alloy wheels improve handling and longitudinal grip                    for easier acceleration and shorter stopping distance. The                    bodyshell of the Lumina has been engineered to be extremely                    stiff and this aids stability. It has high lateral stiffness                    for handling through three lateral ball joints per side with                    improved longitudinal compliance. A rubber isolated suspension                    frame isolates the body from road bumps and drive train                    vibrations.</div>\n<div>An Electronic Stability Program (ESP) system has been                    incorporated in the Lumina SS to boost safety and ensure the                    balance of power and performance is in perfect harmony. ESP                    technology reduces the risk of an accident by preventing the                    vehicle from skidding in an emergency by specifically slowing                    down individual wheels.</div>\n<div>Driven by its athletic exterior look and authoritative                    stance, the Lumina SS looks awesome from any angle. Stylish                    wheel arches immediately set the tone for the superbly crafted                    external architecture on the Lumina, offering dynamic form,                    balance and great proportions with a hint of latent                    muscularity and tautness that sets this car apart from any                    other.</div>\n<div>In the interior, the design philosophy is one of a                    cocooned space with a serpentine plan view of the instrument                    panel that enhances the feeling of spaciousness while ensuring                    that the centre stack controls are of easy reach to the                    driver, adding to the all round feeling of comfort and                    ease.</div>\n<div>\"The short front overhangs, the wheelbase, the wheels out                    at the corners and the muscular track all point to the Lumina                    SS as an absolutely well proportioned vehicle,\" concluded                    Hossein Hassani marketing manager for Chevrolet in the Middle                    East. \"Add to this muscular powerplant and an interior that                    exudes luxury and class and you have a car that is beautiful,                    meaningful and certainly worthy of the prestige of CAR Middle                    East''s award.\"</div>', '2009 Chevy Lumina SS ', 'Chevrolet is the largest division of General Motors. Founded in 1911, Chevrolet fulfils the transportation needs of millions of people daily around the world ?one out of every 13 vehicles sold around the world today is a Chevrolet.', 'inherit', 'open', 'open', '', '57-autosave', '', '', '2009-12-15 15:56:12', '2009-12-15 15:56:12', '', 57, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=66', 0, 'revision', '', 0),
(55, 1, '2009-12-15 15:25:46', '2009-12-15 15:25:46', 'The Toyota Land Cruiser has built a formidable reputation                    around the world for its ability to take even the most extreme                    conditions in its stride. From arid deserts to polar wastes,                    Land Cruiser has demonstrated its unrivalled toughness and                    durability in a heritage that spans six decades.\r\n\r\nThis background of achievement makes the launch of an                    all-new Land Cruiser a particularly significant event and                    Toyota has wasted no effort to ensure its new model builds on                    the pedigree of its ancestors. It is equipped with a raft of                    new and advanced handling and driver assistance systems that                    take its off-road capabilities to new heights. At the same                    time, it has been engineered for greater poise, comfort and                    performance when driving on-road.\r\n\r\nIn the UK new Land Cruiser is offered as a five-door model                    powered by a revised 171bhp 3.0-litre D-4D engine, matched to                    a five-speed automatic transmission. Three equipment grades                    are offered ?LC3, LC4 and LC5 ?with seven seats fitted as                    standard on all but the entry level version (on which third                    row seats are an option). Customer orders are being taken now                    with first deliveries from early December. On-the-road prices                    range from ?9,795 to ?4,795.\r\n\r\nDesign and Construction\r\nThe new Land Cruiser is only                    slightly larger than its predecessor, which helps maintain its                    off-road agility. The styling combines the model''s                    traditionally robust looks with styling cues that were first                    introduced on the larger Land Cruiser V8.\r\n\r\nIntelligent interior packaging provides more space inside                    the cabin, with Toyota EasyFlat third row seats that can be                    raised of folded flat at the touch of a button (LC4 and LC5                    models). The usable loadspace has been significantly increased                    and a new rear glass hatch allows items to be loaded without                    having to open the full side-hinged tailgate ?ideal for tight                    parking places.\r\n\r\nToyota has retained the body-on-frame construction that has                    always been an integral part of Land Cruiser''s exceptional                    off-road ability. Careful attention to the suspension design                    and NVH measures ensure high standards of on-road ride,                    handling and comfort are maintained.\r\n\r\nTechnology for on and off-road performance\r\nNew Land                    Cruiser introduces a series of advanced but user friendly                    features that help the driver tackle even the most challenging                    routes. These include: -\r\n\r\n* Electrically modulated Kinetic Dynamic Suspension System                    (KDSS), which minimises body roll and gives positive steering                    on-road, and increases wheel articulation off-road.\r\n*                    Full-time All-wheel drive with Torsen limited slip                    differential.\r\n* Multi-Terrain Select (MTS), with four                    driver-selectable modes to tailor vehicle settings for                    different off-road conditions.\r\n* Multi-Terrain Monitor, a                    world-first system of front and side view cameras that give                    the driver a real-time view of areas immediately around the                    vehicle that can''t be seen from the wheel.\r\n* Crawl Control,                    which controls the engine and brakes to maintain a slow, safe                    speed when driving off-road or wading, so the driver only                    needs to concentrate on steering. This operates in both                    forward and reverse gears.\r\n* Active Traction Control                    (A-TRC), Multi-Terrain ABS and Vehicle Stability Control (VSC)                    are fitted as standard on all models.\r\n\r\nEquipment highlights\r\nThere is nothing spartan about life                    on board the new Land Cruiser. 17-inch alloys, roof rails, fog                    lamps, climate control, cruise control, Bluetooth and Smart                    Entry and Start system are all part of the LC3 specification.\r\n\r\nLC4 models add triple-zone climate control, 18-inch wheels,                    powered folding third row seats, leather upholstery,                    electrically adjustable heated front seats, dusk-sensing                    headlights, auto-dimming rear-view mirrors, rear parking                    monitor, 17-speaker JBL premium audio package and a hard disc                    drive (HDD) navigation system with a 10GB sound library.', '2010 Toyota Land Cruiser ', 'At the top of the range the LC5 models come with Adaptive Variable Suspension with Active height Control, sunroof, Crawl Control, Multi-terrain Monitor, Steering Angle Display, Multi-terrain Select and a rear seat entertainment system for DVD playback and gaming', 'publish', 'open', 'open', '', '2010-toyota-land-cruiser', '', '', '2009-12-15 15:25:46', '2009-12-15 15:25:46', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=55', 0, 'post', '', 0),
(56, 1, '2009-12-15 15:23:04', '2009-12-15 15:23:04', 'The Toyota Land Cruiser has built a formidable reputation                    around the world for its ability to take even the most extreme                    conditions in its stride. From arid deserts to polar wastes,                    Land Cruiser has demonstrated its unrivalled toughness and                    durability in a heritage that spans six decades.\n\nThis background of achievement makes the launch of an                    all-new Land Cruiser a particularly significant event and                    Toyota has wasted no effort to ensure its new model builds on                    the pedigree of its ancestors. It is equipped with a raft of                    new and advanced handling and driver assistance systems that                    take its off-road capabilities to new heights. At the same                    time, it has been engineered for greater poise, comfort and                    performance when driving on-road.\n\nIn the UK new Land Cruiser is offered as a five-door model                    powered by a revised 171bhp 3.0-litre D-4D engine, matched to                    a five-speed automatic transmission. Three equipment grades                    are offered ?LC3, LC4 and LC5 ?with seven seats fitted as                    standard on all but the entry level version (on which third                    row seats are an option). Customer orders are being taken now                    with first deliveries from early December. On-the-road prices                    range from ?9,795 to ?4,795.\n\nDesign and Construction\nThe new Land Cruiser is only                    slightly larger than its predecessor, which helps maintain its                    off-road agility. The styling combines the model''s                    traditionally robust looks with styling cues that were first                    introduced on the larger Land Cruiser V8.\n\nIntelligent interior packaging provides more space inside                    the cabin, with Toyota EasyFlat third row seats that can be                    raised of folded flat at the touch of a button (LC4 and LC5                    models). The usable loadspace has been significantly increased                    and a new rear glass hatch allows items to be loaded without                    having to open the full side-hinged tailgate ?ideal for tight                    parking places.\n\nToyota has retained the body-on-frame construction that has                    always been an integral part of Land Cruiser''s exceptional                    off-road ability. Careful attention to the suspension design                    and NVH measures ensure high standards of on-road ride,                    handling and comfort are maintained.\n\nTechnology for on and off-road performance\nNew Land                    Cruiser introduces a series of advanced but user friendly                    features that help the driver tackle even the most challenging                    routes. These include: -\n\n* Electrically modulated Kinetic Dynamic Suspension System                    (KDSS), which minimises body roll and gives positive steering                    on-road, and increases wheel articulation off-road.\n*                    Full-time All-wheel drive with Torsen limited slip                    differential.\n* Multi-Terrain Select (MTS), with four                    driver-selectable modes to tailor vehicle settings for                    different off-road conditions.\n* Multi-Terrain Monitor, a                    world-first system of front and side view cameras that give                    the driver a real-time view of areas immediately around the                    vehicle that can''t be seen from the wheel.\n* Crawl Control,                    which controls the engine and brakes to maintain a slow, safe                    speed when driving off-road or wading, so the driver only                    needs to concentrate on steering. This operates in both                    forward and reverse gears.\n* Active Traction Control                    (A-TRC), Multi-Terrain ABS and Vehicle Stability Control (VSC)                    are fitted as standard on all models.\n\nEquipment highlights\nThere is nothing spartan about life                    on board the new Land Cruiser. 17-inch alloys, roof rails, fog                    lamps, climate control, cruise control, Bluetooth and Smart                    Entry and Start system are all part of the LC3 specification.\n\nLC4 models add triple-zone climate control, 18-inch wheels,                    powered folding third row seats, leather upholstery,                    electrically adjustable heated front seats, dusk-sensing                    headlights, auto-dimming rear-view mirrors, rear parking                    monitor, 17-speaker JBL premium audio package and a hard disc                    drive (HDD) navigation system with a 10GB sound library.', '2010 Toyota Land Cruiser ', 'At the top of the range the LC5 models come with Adaptive Variable Suspension with Active height Control, sunroof, Crawl Control, Multi-terrain Monitor, Steering Angle Display, Multi-terrain Select and a rear seat entertainment system for DVD playback and gaming', 'inherit', 'open', 'open', '', '55-revision', '', '', '2009-12-15 15:23:04', '2009-12-15 15:23:04', '', 55, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=56', 0, 'revision', '', 0),
(57, 1, '2009-12-15 15:31:29', '2009-12-15 15:31:29', 'Chevrolet Lumina SS Elected \"Sports                    Saloon of The Year\" by CAR Middle East\r\n<div>Dubai, United Arab Emirates ?Leading UAE based magazine                    and one of the world''s most established and authoritative                    motoring titles, CAR Middle East, has named the Chevrolet                    Lumina SS as \"Best Sports Saloon\" for 2007. The ''Car of the                    Year (COTY)'' awards were launched this year to coincide with                    the 9th Middle East International Motor Show.</div>\r\n<div>According to Shahzad Sheikh, Editor of CAR Middle East,                    \"The Chevrolet Lumina SS has a 6.0-Litre V8 Corvette engine                    under the bonnet. Need I say more? This all new-car from ''down                    under'' is a fantastic reinterpretation of the cult Lumina SS.                    No other car offers this level of practicality, performance,                    and potential tail-sliding fun for the money.\"</div>\r\n<div>This is the first time the influential Middle East                    edition of CAR magazine has presented awards in the region and                    Sheikh added that: ''The Lumina SS edged ahead of some fierce                    competition to deservedly take the ultimate sports saloon                    award and perfectly demonstrates GM''s renewed commitment to                    giving us the cars we really want to drive. Well done!\" A jury                    of six regional automotive experts carefully picked the                    winners from 125 cars in total judging on quality, innovation,                    engineering, style and relevance to the Middle East market to                    crown the winners.</div>\r\n<div></div>\r\n<div>The Lumina SS powered by a 6.0-litre V8 engine now                    delivers standard power of 360hp (net) at 5700 rpm and torque                    of 530 Nm as measured under the international ECE standard.                    Bigger 18\" alloy wheels improve handling and longitudinal grip                    for easier acceleration and shorter stopping distance. The                    bodyshell of the Lumina has been engineered to be extremely                    stiff and this aids stability. It has high lateral stiffness                    for handling through three lateral ball joints per side with                    improved longitudinal compliance. A rubber isolated suspension                    frame isolates the body from road bumps and drive train                    vibrations.</div>\r\n<div></div>\r\n<div>An Electronic Stability Program (ESP) system has been                    incorporated in the Lumina SS to boost safety and ensure the                    balance of power and performance is in perfect harmony. ESP                    technology reduces the risk of an accident by preventing the                    vehicle from skidding in an emergency by specifically slowing                    down individual wheels.</div>\r\n<div>Driven by its athletic exterior look and authoritative                    stance, the Lumina SS looks awesome from any angle. Stylish                    wheel arches immediately set the tone for the superbly crafted                    external architecture on the Lumina, offering dynamic form,                    balance and great proportions with a hint of latent                    muscularity and tautness that sets this car apart from any                    other.</div>\r\n<div>In the interior, the design philosophy is one of a                    cocooned space with a serpentine plan view of the instrument                    panel that enhances the feeling of spaciousness while ensuring                    that the centre stack controls are of easy reach to the                    driver, adding to the all round feeling of comfort and                    ease.</div>\r\n<div></div>\r\n<div>\"The short front overhangs, the wheelbase, the wheels out                    at the corners and the muscular track all point to the Lumina                    SS as an absolutely well proportioned vehicle,\" concluded                    Hossein Hassani marketing manager for Chevrolet in the Middle                    East. \"Add to this muscular powerplant and an interior that                    exudes luxury and class and you have a car that is beautiful,                    meaningful and certainly worthy of the prestige of CAR Middle                    East''s award.\"</div>', '2009 Chevy Lumina SS ', 'Chevrolet is the largest division of General Motors. Founded in 1911, Chevrolet fulfils the transportation needs of millions of people daily around the world ?one out of every 13 vehicles sold around the world today is a Chevrolet.', 'publish', 'open', 'open', '', '2009-chevy-lumina-ss', '', '', '2009-12-15 15:55:08', '2009-12-15 15:55:08', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=57', 0, 'post', '', 0),
(58, 1, '2009-12-15 15:27:11', '2009-12-15 15:27:11', 'Chevrolet Lumina SS Elected \"Sports                    Saloon of The Year\" by CAR Middle East\n<div>Dubai, United Arab Emirates ?Leading UAE based magazine                    and one of the world''s most established and authoritative                    motoring titles, CAR Middle East, has named the Chevrolet                    Lumina SS as \"Best Sports Saloon\" for 2007. The ''Car of the                    Year (COTY)'' awards were launched this year to coincide with                    the 9th Middle East International Motor Show.</div>\n<div>According to Shahzad Sheikh, Editor of CAR Middle East,                    \"The Chevrolet Lumina SS has a 6.0-Litre V8 Corvette engine                    under the bonnet. Need I say more? This all new-car from ''down                    under'' is a fantastic reinterpretation of the cult Lumina SS.                    No other car offers this level of practicality, performance,                    and potential tail-sliding fun for the money.\"</div>\n<div>This is the first time the influential Middle East                    edition of CAR magazine has presented awards in the region and                    Sheikh added that: ''The Lumina SS edged ahead of some fierce                    competition to deservedly take the ultimate sports saloon                    award and perfectly demonstrates GM''s renewed commitment to                    giving us the cars we really want to drive. Well done!\" A jury                    of six regional automotive experts carefully picked the                    winners from 125 cars in total judging on quality, innovation,                    engineering, style and relevance to the Middle East market to                    crown the winners.</div>\n<div>The Lumina SS powered by a 6.0-litre V8 engine now                    delivers standard power of 360hp (net) at 5700 rpm and torque                    of 530 Nm as measured under the international ECE standard.                    Bigger 18\" alloy wheels improve handling and longitudinal grip                    for easier acceleration and shorter stopping distance. The                    bodyshell of the Lumina has been engineered to be extremely                    stiff and this aids stability. It has high lateral stiffness                    for handling through three lateral ball joints per side with                    improved longitudinal compliance. A rubber isolated suspension                    frame isolates the body from road bumps and drive train                    vibrations.</div>\n<div>An Electronic Stability Program (ESP) system has been                    incorporated in the Lumina SS to boost safety and ensure the                    balance of power and performance is in perfect harmony. ESP                    technology reduces the risk of an accident by preventing the                    vehicle from skidding in an emergency by specifically slowing                    down individual wheels.</div>\n<div>Driven by its athletic exterior look and authoritative                    stance, the Lumina SS looks awesome from any angle. Stylish                    wheel arches immediately set the tone for the superbly crafted                    external architecture on the Lumina, offering dynamic form,                    balance and great proportions with a hint of latent                    muscularity and tautness that sets this car apart from any                    other.</div>\n<div>In the interior, the design philosophy is one of a                    cocooned space with a serpentine plan view of the instrument                    panel that enhances the feeling of spaciousness while ensuring                    that the centre stack controls are of easy reach to the                    driver, adding to the all round feeling of comfort and                    ease.</div>\n<div>\"The short front overhangs, the wheelbase, the wheels out                    at the corners and the muscular track all point to the Lumina                    SS as an absolutely well proportioned vehicle,\" concluded                    Hossein Hassani marketing manager for Chevrolet in the Middle                    East. \"Add to this muscular powerplant and an interior that                    exudes luxury and class and you have a car that is beautiful,                    meaningful and certainly worthy of the prestige of CAR Middle                    East''s award.\"</div>\n<div>Chevrolet is the largest division of General Motors.                    Founded in 1911, Chevrolet fulfils the transportation needs of                    millions of people daily around the world ?one out of every                    13 vehicles sold around the world today is a Chevrolet.</div>', '2009 Chevy Lumina SS ', '', 'inherit', 'open', 'open', '', '57-revision', '', '', '2009-12-15 15:27:11', '2009-12-15 15:27:11', '', 57, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=58', 0, 'revision', '', 0)");


mysql_query("INSERT INTO `".$wpdb->posts."` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(59, 1, '2009-12-15 15:33:29', '2009-12-15 15:33:29', 'The MINI Coup?Concept is an expression of MINI design and the great  			ability of the brand''s designers to fill the elementary values of  			the brand with new life, using the options of modern drivetrain and  			suspension technology, and developing fascinating perspectives for  			the future of the brand on this basis.\r\n\r\nPresenting the concept of an uncompromisingly sporting two-seater to  			be seen for the first time at the Frankfurt Motor Show (17?7  			September 2009), MINI is unveiling an unusually attractive vision of  			how the model family may well develop in future. The source of  			inspiration is once again the fundamental motive so characteristic  			of every MINI: driving pleasure. The MINI Coup?Concept therefore  			represents the ideal of a car destined in every respect to offer a  			thrilling experience and make every journey a truly unique thrill.\r\n\r\nThe MINI Coup?Concept brings together a wide range of features for  			a truly sporting and ambitious style of motoring. Limited to two  			seats and following a philosophy of consistent lightweight  			construction, the car clearly meets all the requirements made of a  			particularly active and dynamic coup? Compact dimensions, perfect  			axle load distribution and a low centre of gravity offer ideal  			conditions for enhancing the agility typical of MINI to a level  			never seen before.\r\n\r\nThrough its design alone, the MINI Coup?Concept brings out all the  			thrill of individual mobility and the focus on pure driving  			pleasure. Powerful proportions and dynamic design language evoke a  			sense of desire and strong appeal, the MINI Coup?Concept offering a  			particularly undiluted expression of the brand through its sporting  			and unconventional stance on the road.\r\n\r\nThe MINI Coup?Concept: an invitation to enjoy spontaneous mobility.\r\n\r\nWith the growing model portfolio, the popularity of the MINI brand  			has also grown consistently in recent years. The MINI has moved  			beyond the restraints of urban mobility, opening up additional  			options and winning over new target groups. And MINI allows you to  			enjoy spontaneous mobility, sporting and agile handling and  			unmistakable style on virtually every occasion.\r\n\r\nThe current models in the range already meet the most varied  			demands. As individual characters in their own right, the MINI, MINI  			Clubman and MINI Convertible all offer a unique rendition of the  			driving experience so typical of the brand. And now the MINI Coup? 			Concept brings out driving pleasure in its most concentrated form,  			extreme lightweight technology making this two-seater particularly  			agile and unusually efficient. At the same time the low roofline,  			the precisely defined spoiler edge at the rear and other aerodynamic  			features enhance the car''s performance to an even higher standard.  			So that in its design and in the use of high-performance drivetrain  			technology, the MINI Coup?Concept offers ideal conditions as a  			compact sports car in the premium segment.', '2009 MINI Coupe Concept ', 'MINI is celebrating a great birthday: Exactly fifty years ago, on 26 August 1959, the classic Mini was presented to the public for the first time, a unique story of success starting out and today giving MINI the perfect opportunity to look ahead without losing sight of the brand''s great tradition.', 'publish', 'open', 'open', '', '2009-mini-coupe-concept', '', '', '2009-12-15 15:33:29', '2009-12-15 15:33:29', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=59', 0, 'post', '', 0),
(60, 1, '2009-12-15 15:32:41', '2009-12-15 15:32:41', 'The MINI Coup?Concept is an expression of MINI design and the great  			ability of the brand''s designers to fill the elementary values of  			the brand with new life, using the options of modern drivetrain and  			suspension technology, and developing fascinating perspectives for  			the future of the brand on this basis.\n\nPresenting the concept of an uncompromisingly sporting two-seater to  			be seen for the first time at the Frankfurt Motor Show (17?7  			September 2009), MINI is unveiling an unusually attractive vision of  			how the model family may well develop in future. The source of  			inspiration is once again the fundamental motive so characteristic  			of every MINI: driving pleasure. The MINI Coup?Concept therefore  			represents the ideal of a car destined in every respect to offer a  			thrilling experience and make every journey a truly unique thrill.\n\nThe MINI Coup?Concept brings together a wide range of features for  			a truly sporting and ambitious style of motoring. Limited to two  			seats and following a philosophy of consistent lightweight  			construction, the car clearly meets all the requirements made of a  			particularly active and dynamic coup? Compact dimensions, perfect  			axle load distribution and a low centre of gravity offer ideal  			conditions for enhancing the agility typical of MINI to a level  			never seen before.\n\nThrough its design alone, the MINI Coup?Concept brings out all the  			thrill of individual mobility and the focus on pure driving  			pleasure. Powerful proportions and dynamic design language evoke a  			sense of desire and strong appeal, the MINI Coup?Concept offering a  			particularly undiluted expression of the brand through its sporting  			and unconventional stance on the road.\n\nThe MINI Coup?Concept: an invitation to enjoy spontaneous mobility.\n\nWith the growing model portfolio, the popularity of the MINI brand  			has also grown consistently in recent years. The MINI has moved  			beyond the restraints of urban mobility, opening up additional  			options and winning over new target groups. And MINI allows you to  			enjoy spontaneous mobility, sporting and agile handling and  			unmistakable style on virtually every occasion.\n\nThe current models in the range already meet the most varied  			demands. As individual characters in their own right, the MINI, MINI  			Clubman and MINI Convertible all offer a unique rendition of the  			driving experience so typical of the brand. And now the MINI Coup? 			Concept brings out driving pleasure in its most concentrated form,  			extreme lightweight technology making this two-seater particularly  			agile and unusually efficient. At the same time the low roofline,  			the precisely defined spoiler edge at the rear and other aerodynamic  			features enhance the car''s performance to an even higher standard.  			So that in its design and in the use of high-performance drivetrain  			technology, the MINI Coup?Concept offers ideal conditions as a  			compact sports car in the premium segment.', '2009 MINI Coupe Concept ', 'MINI is celebrating a great birthday: Exactly fifty years ago, on 26 August 1959, the classic Mini was presented to the public for the first time, a unique story of success starting out and today giving MINI the perfect opportunity to look ahead without losing sight of the brand''s great tradition.', 'inherit', 'open', 'open', '', '59-revision', '', '', '2009-12-15 15:32:41', '2009-12-15 15:32:41', '', 59, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=60', 0, 'revision', '', 0),
(61, 1, '2009-12-15 15:37:47', '2009-12-15 15:37:47', 'The MINI Coup?Concept is an expression of MINI design and the great  			ability of the brand''s designers to fill the elementary values of  			the brand with new life, using the options of modern drivetrain and  			suspension technology, and developing fascinating perspectives for  			the future of the brand on this basis.\n\nPresenting the concept of an uncompromisingly sporting two-seater to  			be seen for the first time at the Frankfurt Motor Show (17?7  			September 2009), MINI is unveiling an unusually attractive vision of  			how the model family may well develop in future. The source of  			inspiration is once again the fundamental motive so characteristic  			of every MINI: driving pleasure. The MINI Coup?Concept therefore  			represents the ideal of a car destined in every respect to offer a  			thrilling experience and make every journey a truly unique thrill.\n\nThe MINI Coup?Concept brings together a wide range of features for  			a truly sporting and ambitious style of motoring. Limited to two  			seats and following a philosophy of consistent lightweight  			construction, the car clearly meets all the requirements made of a  			particularly active and dynamic coup? Compact dimensions, perfect  			axle load distribution and a low centre of gravity offer ideal  			conditions for enhancing the agility typical of MINI to a level  			never seen before.\n\nThrough its design alone, the MINI Coup?Concept brings out all the  			thrill of individual mobility and the focus on pure driving  			pleasure. Powerful proportions and dynamic design language evoke a  			sense of desire and strong appeal, the MINI Coup?Concept offering a  			particularly undiluted expression of the brand through its sporting  			and unconventional stance on the road.\n\nThe MINI Coup?Concept: an invitation to enjoy spontaneous mobility.\n\nWith the growing model portfolio, the popularity of the MINI brand  			has also grown consistently in recent years. The MINI has moved  			beyond the restraints of urban mobility, opening up additional  			options and winning over new target groups. And MINI allows you to  			enjoy spontaneous mobility, sporting and agile handling and  			unmistakable style on virtually every occasion.\n\nThe current models in the range already meet the most varied  			demands. As individual characters in their own right, the MINI, MINI  			Clubman and MINI Convertible all offer a unique rendition of the  			driving experience so typical of the brand. And now the MINI Coup? 			Concept brings out driving pleasure in its most concentrated form,  			extreme lightweight technology making this two-seater particularly  			agile and unusually efficient. At the same time the low roofline,  			the precisely defined spoiler edge at the rear and other aerodynamic  			features enhance the car''s performance to an even higher standard.  			So that in its design and in the use of high-performance drivetrain  			technology, the MINI Coup?Concept offers ideal conditions as a  			compact sports car in the premium segment.', '2009 MINI Coupe Concept ', 'MINI is celebrating a great birthday: Exactly fifty years ago, on 26 August 1959, the classic Mini was presented to the public for the first time, a unique story of success starting out and today giving MINI the perfect opportunity to look ahead without losing sight of the brand''s great tradition.', 'inherit', 'open', 'open', '', '59-autosave', '', '', '2009-12-15 15:37:47', '2009-12-15 15:37:47', '', 59, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=61', 0, 'revision', '', 0),
(62, 1, '2009-12-15 15:45:33', '2009-12-15 15:45:33', 'The recently-launched Handling GTE option for the Ferrari 599 GTB Fiorano is now  also available as a Ferrari Genuine Accessories package for dealer fitment, with  two options available according to the customer''s specific requirements and age  of vehicle.\r\n\r\nThe options are:\r\n\r\nModel Year Ferrari Genuine Accessories available Fitted price (from) *\r\n\r\nPre-2008: Handling, Exhaust and Aesthetic kits ?7,213\r\n\r\nPost-2008: Handling, Performance, Exhaust and Aesthetic kits ?9,703\r\n\r\n* Final price will depend on specific kits required and model year of car. All  prices are excluding VAT.\r\n\r\nTo demonstrate the enhancements offered by this exciting addition to the Ferrari  Genuine Accessories range, the attached video and images of a 599 GTB Fiorano  fitted with the HGTE package should convince existing owners to consider  upgrading their cars to this new specification. The video and images are  available free of copyright for editorial use only.\r\n\r\nThe full specification of each kit is detailed below:\r\n\r\n1) Handling, includes:\r\n\r\n* Lower suspension (10mm)\r\n* New magnetorheologically controlled suspension calibration for the Manettino  SPORT and RACE configurations\r\n* More rigid suspension springs (front + 17%, rear + 15%)\r\n* More rigid rear anti-roll bars (diameter increased to 25mm)\r\n* HGTE specific tyres with improved compound (8% more grip)\r\n* 3-piece modular rims with reduced weight (forged spokes) and special new  design\r\n\r\n2) Performance (only available for post-2008 cars, from engine no. 122779),  includes:\r\n\r\n* New exhausts silencers with two-tone finish tailpipes\r\n* Enhanced F1 gearshift actuation, with response times reduced to 85ms\r\n* New accelerator logic with modified mapping for improved throttle response\r\n\r\nN.B. The Performance kit cannot be installed on cars with manual gearboxes.\r\n\r\n3) Exhaust, includes:\r\n\r\n* New exhausts silencers with two-tone finish tailpipes\r\n\r\nThe Exhaust kit is designed for:\r\n\r\n* vehicles that cannot receive the software updates listed in the Performance  kit since the engine was produced before assembly number 122779 (pre-2008)\r\n* all cars with manual gearboxes\r\n* clients who are only interested in modifying the styling and sound of their  own cars\r\n\r\nN.B. The Exhaust kit is included in the Performance kit, for cars post-2008.\r\n\r\n4) Aesthetic, includes:\r\n\r\n* New design front grille with a special chromatic treatment\r\n* Burnished finish to Prancing Horse symbols on the front grill and rear boot  lid', '2009 FERRARI 599 GTB Fiorano ', 'FERRARI 599 GTB FIORANO ?HANDLING GTE PACKAGE NOW AVAILABLE AS A FERRARI GENUINE PARTS ACCESSORY PACKAGE. IMAGES AND VIDEO ALSO AVAILABLE', 'publish', 'open', 'open', '', '2009-ferrari-599-gtb-fiorano', '', '', '2009-12-15 15:45:33', '2009-12-15 15:45:33', '', 0, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=62', 0, 'post', '', 0),
(63, 1, '2009-12-15 15:45:03', '2009-12-15 15:45:03', 'The recently-launched Handling GTE option for the Ferrari 599 GTB Fiorano is now  also available as a Ferrari Genuine Accessories package for dealer fitment, with  two options available according to the customer''s specific requirements and age  of vehicle.\n\nThe options are:\n\nModel Year Ferrari Genuine Accessories available Fitted price (from) *\n\nPre-2008: Handling, Exhaust and Aesthetic kits ?7,213\n\nPost-2008: Handling, Performance, Exhaust and Aesthetic kits ?9,703\n\n* Final price will depend on specific kits required and model year of car. All  prices are excluding VAT.\n\nTo demonstrate the enhancements offered by this exciting addition to the Ferrari  Genuine Accessories range, the attached video and images of a 599 GTB Fiorano  fitted with the HGTE package should convince existing owners to consider  upgrading their cars to this new specification. The video and images are  available free of copyright for editorial use only.\n\nThe full specification of each kit is detailed below:\n\n1) Handling, includes:\n\n* Lower suspension (10mm)\n* New magnetorheologically controlled suspension calibration for the Manettino  SPORT and RACE configurations\n* More rigid suspension springs (front + 17%, rear + 15%)\n* More rigid rear anti-roll bars (diameter increased to 25mm)\n* HGTE specific tyres with improved compound (8% more grip)\n* 3-piece modular rims with reduced weight (forged spokes) and special new  design\n\n2) Performance (only available for post-2008 cars, from engine no. 122779),  includes:\n\n* New exhausts silencers with two-tone finish tailpipes\n* Enhanced F1 gearshift actuation, with response times reduced to 85ms\n* New accelerator logic with modified mapping for improved throttle response\n\nN.B. The Performance kit cannot be installed on cars with manual gearboxes.\n\n3) Exhaust, includes:\n\n* New exhausts silencers with two-tone finish tailpipes\n\nThe Exhaust kit is designed for:\n\n* vehicles that cannot receive the software updates listed in the Performance  kit since the engine was produced before assembly number 122779 (pre-2008)\n* all cars with manual gearboxes\n* clients who are only interested in modifying the styling and sound of their  own cars\n\nN.B. The Exhaust kit is included in the Performance kit, for cars post-2008.\n\n4) Aesthetic, includes:\n\n* New design front grille with a special chromatic treatment\n* Burnished finish to Prancing Horse symbols on the front grill and rear boot  lid', '2009 FERRARI 599 GTB Fiorano ', 'FERRARI 599 GTB FIORANO ?HANDLING GTE PACKAGE NOW AVAILABLE AS A FERRARI GENUINE PARTS ACCESSORY PACKAGE. IMAGES AND VIDEO ALSO AVAILABLE', 'inherit', 'open', 'open', '', '62-revision', '', '', '2009-12-15 15:45:03', '2009-12-15 15:45:03', '', 62, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=63', 0, 'revision', '', 0),
(64, 1, '2009-12-15 15:46:36', '2009-12-15 15:46:36', 'The recently-launched Handling GTE option for the Ferrari 599 GTB Fiorano is now  also available as a Ferrari Genuine Accessories package for dealer fitment, with  two options available according to the customer''s specific requirements and age  of vehicle.\n\nThe options are:\n\nModel Year Ferrari Genuine Accessories available Fitted price (from) *\n\nPre-2008: Handling, Exhaust and Aesthetic kits ?7,213\n\nPost-2008: Handling, Performance, Exhaust and Aesthetic kits ?9,703\n\n* Final price will depend on specific kits required and model year of car. All  prices are excluding VAT.\n\nTo demonstrate the enhancements offered by this exciting addition to the Ferrari  Genuine Accessories range, the attached video and images of a 599 GTB Fiorano  fitted with the HGTE package should convince existing owners to consider  upgrading their cars to this new specification. The video and images are  available free of copyright for editorial use only.\n\nThe full specification of each kit is detailed below:\n\n1) Handling, includes:\n\n* Lower suspension (10mm)\n* New magnetorheologically controlled suspension calibration for the Manettino  SPORT and RACE configurations\n* More rigid suspension springs (front + 17%, rear + 15%)\n* More rigid rear anti-roll bars (diameter increased to 25mm)\n* HGTE specific tyres with improved compound (8% more grip)\n* 3-piece modular rims with reduced weight (forged spokes) and special new  design\n\n2) Performance (only available for post-2008 cars, from engine no. 122779),  includes:\n\n* New exhausts silencers with two-tone finish tailpipes\n* Enhanced F1 gearshift actuation, with response times reduced to 85ms\n* New accelerator logic with modified mapping for improved throttle response\n\nN.B. The Performance kit cannot be installed on cars with manual gearboxes.\n\n3) Exhaust, includes:\n\n* New exhausts silencers with two-tone finish tailpipes\n\nThe Exhaust kit is designed for:\n\n* vehicles that cannot receive the software updates listed in the Performance  kit since the engine was produced before assembly number 122779 (pre-2008)\n* all cars with manual gearboxes\n* clients who are only interested in modifying the styling and sound of their  own cars\n\nN.B. The Exhaust kit is included in the Performance kit, for cars post-2008.\n\n4) Aesthetic, includes:\n\n* New design front grille with a special chromatic treatment\n* Burnished finish to Prancing Horse symbols on the front grill and rear boot  lid', '2009 FERRARI 599 GTB Fiorano ', 'FERRARI 599 GTB FIORANO ?HANDLING GTE PACKAGE NOW AVAILABLE AS A FERRARI GENUINE PARTS ACCESSORY PACKAGE. IMAGES AND VIDEO ALSO AVAILABLE', 'inherit', 'open', 'open', '', '62-autosave', '', '', '2009-12-15 15:46:36', '2009-12-15 15:46:36', '', 62, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=64', 0, 'revision', '', 0),
(65, 1, '2009-12-15 15:31:29', '2009-12-15 15:31:29', 'Chevrolet Lumina SS Elected \"Sports                    Saloon of The Year\" by CAR Middle East\r\n<div>Dubai, United Arab Emirates ?Leading UAE based magazine                    and one of the world''s most established and authoritative                    motoring titles, CAR Middle East, has named the Chevrolet                    Lumina SS as \"Best Sports Saloon\" for 2007. The ''Car of the                    Year (COTY)'' awards were launched this year to coincide with                    the 9th Middle East International Motor Show.</div>\r\n<div>According to Shahzad Sheikh, Editor of CAR Middle East,                    \"The Chevrolet Lumina SS has a 6.0-Litre V8 Corvette engine                    under the bonnet. Need I say more? This all new-car from ''down                    under'' is a fantastic reinterpretation of the cult Lumina SS.                    No other car offers this level of practicality, performance,                    and potential tail-sliding fun for the money.\"</div>\r\n<div>This is the first time the influential Middle East                    edition of CAR magazine has presented awards in the region and                    Sheikh added that: ''The Lumina SS edged ahead of some fierce                    competition to deservedly take the ultimate sports saloon                    award and perfectly demonstrates GM''s renewed commitment to                    giving us the cars we really want to drive. Well done!\" A jury                    of six regional automotive experts carefully picked the                    winners from 125 cars in total judging on quality, innovation,                    engineering, style and relevance to the Middle East market to                    crown the winners.</div>\r\n<div>The Lumina SS powered by a 6.0-litre V8 engine now                    delivers standard power of 360hp (net) at 5700 rpm and torque                    of 530 Nm as measured under the international ECE standard.                    Bigger 18\" alloy wheels improve handling and longitudinal grip                    for easier acceleration and shorter stopping distance. The                    bodyshell of the Lumina has been engineered to be extremely                    stiff and this aids stability. It has high lateral stiffness                    for handling through three lateral ball joints per side with                    improved longitudinal compliance. A rubber isolated suspension                    frame isolates the body from road bumps and drive train                    vibrations.</div>\r\n<div>An Electronic Stability Program (ESP) system has been                    incorporated in the Lumina SS to boost safety and ensure the                    balance of power and performance is in perfect harmony. ESP                    technology reduces the risk of an accident by preventing the                    vehicle from skidding in an emergency by specifically slowing                    down individual wheels.</div>\r\n<div>Driven by its athletic exterior look and authoritative                    stance, the Lumina SS looks awesome from any angle. Stylish                    wheel arches immediately set the tone for the superbly crafted                    external architecture on the Lumina, offering dynamic form,                    balance and great proportions with a hint of latent                    muscularity and tautness that sets this car apart from any                    other.</div>\r\n<div>In the interior, the design philosophy is one of a                    cocooned space with a serpentine plan view of the instrument                    panel that enhances the feeling of spaciousness while ensuring                    that the centre stack controls are of easy reach to the                    driver, adding to the all round feeling of comfort and                    ease.</div>\r\n<div>\"The short front overhangs, the wheelbase, the wheels out                    at the corners and the muscular track all point to the Lumina                    SS as an absolutely well proportioned vehicle,\" concluded                    Hossein Hassani marketing manager for Chevrolet in the Middle                    East. \"Add to this muscular powerplant and an interior that                    exudes luxury and class and you have a car that is beautiful,                    meaningful and certainly worthy of the prestige of CAR Middle                    East''s award.\"</div>\r\n<div>Chevrolet is the largest division of General Motors.                    Founded in 1911, Chevrolet fulfils the transportation needs of                    millions of people daily around the world ?one out of every                    13 vehicles sold around the world today is a Chevrolet.</div>', '2009 Chevy Lumina SS ', '', 'inherit', 'open', 'open', '', '57-revision-2', '', '', '2009-12-15 15:31:29', '2009-12-15 15:31:29', '', 57, 'http://localhost/XXX/CLASSIFIEDTHEME/?p=65', 0, 'revision', '', 0)");




mysql_query("INSERT INTO `".$wpdb->terms."` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'buy and sell', 'buy-and-sell', 0),
(2, 'Blogroll', 'blogroll', 0),
(4, 'classified', 'classified', 0),
(5, 'templates', 'templates', 0),
(10, 'computers', 'computers', 0),
(12, 'home appliances', 'home-appliances', 0),
(13, 'cameras', 'cameras', 0),
(34, 'bar/ food/ hospitality', 'bar-food-hospitality', 0),
(15, 'baby items', 'baby-items', 0),
(16, 'jewellery', 'jewellery', 0),
(32, 'Jobs', 'jobs', 0),
(33, 'office mgr/ receptionist', 'office-mgr-receptionist', 0),
(22, 'hobbies', 'hobbies', 0),
(23, 'furniture', 'furniture', 0),
(29, 'clothing', 'clothing', 0),
(30, 'accessories', 'accessories', 0),
(31, 'other', 'other', 0),
(35, 'non profit sector', 'non-profit-sector', 0),
(37, 'hair stylist/ salon', 'hair-stylist-salon', 0),
(38, 'accounting/ mgmt', 'accounting-mgmt', 0),
(39, 'construction/ trades', 'construction-trades', 0),
(41, 'cleaning/ housekeeper', 'cleaning-housekeeper', 0),
(42, 'programmers/ computer', 'programmers-computer', 0),
(43, 'customer service', 'customer-service', 0),
(45, 'general labour', 'general-labour', 0),
(47, 'services', 'services', 0),
(49, 'moving/ storage', 'moving-storage', 0),
(50, 'entertainment', 'entertainment', 0),
(51, 'fitness/ personal trainer', 'fitness-personal-trainer', 0),
(52, 'financial/ legal', 'financial-legal', 0),
(54, 'wedding', 'wedding', 0),
(55, 'cleaners/ cleaning', 'cleaners-cleaning', 0),
(56, 'computer', 'computer', 0),
(57, 'painters/ painting', 'painters-painting', 0),
(60, 'tutors/ languages', 'tutors-languages', 0),
(61, 'housing', 'housing', 0),
(62, 'apartment for rent', 'apartment-for-rent', 0),
(63, 'house for rent', 'house-for-rent', 0),
(64, 'room rental/ roommates', 'room-rental-roommates', 0),
(65, 'commercial', 'commercial', 0),
(66, 'housing for sale', 'housing-for-sale', 0),
(67, 'vacation rentals', 'vacation-rentals', 0),
(68, 'short term rentals', 'short-term-rentals', 0),
(69, 'real estate services', 'real-estate-services', 0),
(70, 'personals', 'personals', 0),
(71, 'long lost relationships', 'long-lost-relationships', 0),
(72, 'just friends', 'just-friends', 0),
(73, 'casual encounters', 'casual-encounters', 0),
(74, 'women seeking men', 'women-seeking-men', 0),
(75, 'women seeking women', 'women-seeking-women', 0),
(76, 'men seeking women', 'men-seeking-women', 0),
(77, 'men seeking men', 'men-seeking-men', 0),
(78, 'missed connections', 'missed-connections', 0),
(80, 'cars &amp; vehicles', 'cars-vehicles', 0),
(81, 'cars', 'cars', 0),
(82, 'motorcycles', 'motorcycles', 0),
(83, 'parts/ accessories', 'parts-accessories', 0),
(84, 'automotive services', 'automotive-services', 0),
(85, 'SUVs/ trucks/ vans', 'SUVs-trucks-vans', 0)");

mysql_query("INSERT INTO `".$wpdb->term_relationships."` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 2, 0),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0),
(49, 1, 0),
(53, 1, 0),
(58, 1, 0),
(57, 81, 0),
(52, 82, 0),
(60, 1, 0),
(48, 82, 0),
(62, 81, 0),
(63, 1, 0),
(61, 1, 0),
(59, 82, 0),
(59, 81, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(57, 82, 0),
(50, 1, 0),
(66, 1, 0),
(65, 1, 0),
(64, 1, 0),
(52, 81, 0),
(51, 1, 0),
(56, 1, 0),
(55, 86, 0),
(55, 81, 0),
(54, 1, 0),
(48, 81, 0),
(27, 1, 0),
(28, 1, 0),
(29, 14, 0),
(30, 0, 0),
(31, 0, 0),
(32, 0, 0),
(33, 0, 0),
(34, 0, 0),
(35, 0, 0),
(36, 0, 0),
(37, 0, 0),
(38, 0, 0),
(39, 0, 0),
(40, 0, 0),
(41, 0, 0),
(42, 0, 0),
(43, 16, 0),
(62, 82, 0),
(45, 1, 0),
(46, 1, 0),
(47, 1, 0)");

mysql_query("INSERT INTO `".$wpdb->term_taxonomy."` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 0),
(2, 2, 'link_category', '', 0, 7),
(4, 4, 'post_tag', '', 0, 0),
(5, 5, 'post_tag', '', 0, 0),
(11, 10, 'category', 'computers', 1, 1),
(35, 34, 'category', 'bar-food-hospitality', 32, 1),
(13, 12, 'category', 'home-appliances', 1, 1),
(14, 13, 'category', 'cameras', 1, 1),
(10, 0, 'category', '', 0, 1),
(16, 15, 'category', 'baby-items', 1, 0),
(17, 16, 'category', 'jewellery', 1, 2),
(33, 32, 'category', '', 0, 0),
(34, 33, 'category', 'office-mgr-receptionist', 32, 1),
(23, 22, 'category', 'hobbies', 1, 1),
(24, 23, 'category', 'furniture', 1, 1),
(30, 29, 'category', 'clothing', 1, 1),
(31, 30, 'category', 'accessories', 1, 1),
(32, 31, 'category', 'other', 1, 1),
(36, 35, 'category', 'non-profit-sector', 32, 1),
(38, 37, 'category', 'hair-stylist-salon', 32, 1),
(39, 38, 'category', 'accounting-mgmt', 32, 1),
(40, 39, 'category', 'construction-trades', 32, 1),
(42, 41, 'category', 'cleaning-housekeeper', 32, 1),
(43, 42, 'category', 'programmers-computer', 32, 1),
(44, 43, 'category', 'customer-service', 32, 1),
(46, 45, 'category', 'general-labour', 32, 1),
(48, 47, 'category', '', 0, 0),
(50, 49, 'category', 'moving-storage', 47, 1),
(51, 50, 'category', 'entertainment', 47, 1),
(52, 51, 'category', 'fitness-personal-trainer', 47, 1),
(53, 52, 'category', 'financial-legal', 47, 1),
(55, 54, 'category', 'wedding', 47, 1),
(56, 55, 'category', 'cleaners-cleaning', 47, 1),
(57, 56, 'category', 'computer', 47, 1),
(58, 57, 'category', 'painters-painting', 47, 1),
(61, 60, 'category', 'tutors-languages', 47, 1),
(62, 61, 'category', 'other', 0, 0),
(63, 62, 'category', 'apartment-for-rent', 61, 1),
(64, 63, 'category', 'house-for-rent', 61, 1),
(65, 64, 'category', 'room-rental-roommates', 61, 1),
(66, 65, 'category', 'commercial', 61, 1),
(67, 66, 'category', 'housing-for-sale', 61, 0),
(68, 67, 'category', 'vacation-rentals', 61, 1),
(69, 68, 'category', 'short-term-rentals', 61, 1),
(70, 69, 'category', 'real-estate-services', 61, 1),
(71, 70, 'category', 'other', 0, 0),
(72, 71, 'category', 'long-lost-relationships', 70, 1),
(73, 72, 'category', 'just-friends', 70, 1),
(74, 73, 'category', 'casual-encounters', 70, 1),
(75, 74, 'category', 'women-seeking-men', 70, 1),
(76, 75, 'category', 'women-seeking-women', 70, 1),
(77, 76, 'category', 'men-seeking-women', 70, 1),
(78, 77, 'category', 'men-seeking-men', 70, 1),
(79, 78, 'category', 'missed-connections', 70, 1),
(81, 80, 'category', '', 0, 6),
(82, 81, 'category', 'cars', 80, 5),
(83, 82, 'category', 'motorcycles', 80, 0),
(84, 83, 'category', 'parts-accessories', 80, 0),
(85, 84, 'category', 'automotive-services', 80, 1),
(86, 85, 'category', 'SUVs-trucks-vans', 80, 1)");

mysql_query("INSERT INTO `".$wpdb->postmeta."` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(98, 48, 'price', '199950'),
(13, 10, '_wp_page_template', 'default'),
(105, 52, 'price', '149000'),
(104, 52, 'location', 'United States'),
(101, 52, 'featured_image', 'demo2_featured.jpg'),
(95, 48, 'location', 'United States'),
(92, 48, 'featured_image', 'demo1_featured.jpg'),
(91, 48, 'image', 'demo1a.jpg'),
(89, 48, 'hits', '1'),
(90, 48, 'images', 'demo1a.jpg,demo1b.jpg,demo1c.jpg,demo1d.jpg,demo1e.jpg'),
(106, 52, 'hits', '0'),
(103, 52, 'images', 'demo2a.jpg,demo2b.jpg,demo2c.jpg,demo2d.jpg'),
(102, 52, 'image', 'demo2a.jpg'),
(49, 27, '_edit_lock', '1260878120'),
(50, 27, '_edit_last', '1'),
(51, 27, '_wp_page_template', 'tpl-add.php'),
(86, 45, '_wp_page_template', 'tpl-contactUs.php'),
(111, 55, 'hits', '0'),
(112, 55, 'price', '69795'),
(113, 55, 'featured_image', 'demo3_featured.jpg'),
(114, 55, 'image', 'demo3a.jpg'),
(115, 55, 'images', 'demo3a.jpg,demo3b.jpg,demo3c.jpg,demo3d.jpg'),
(116, 55, 'location', 'United States'),
(120, 57, 'location', 'United States'),
(119, 57, 'hits', '0'),
(121, 57, 'price', '10955'),
(124, 57, 'image', 'demo4a.jpg'),
(125, 57, 'images', 'demo4a.jpg,demo4b.jpg,demo4c.jpg,demo4d.jpg'),
(126, 57, 'featured_image', 'demo4_featured.jpg'),
(131, 59, 'featured_image', 'demo5_featured.jpg'),
(132, 59, 'hits', '0'),
(133, 59, 'image', 'demo5a.jpg'),
(134, 59, 'images', 'demo5a.jpg,demo5b.jpg,demo5c.jpg,demo5d.jpg'),
(135, 59, 'price', '8560'),
(136, 59, 'location', 'United Kingdom'),
(141, 62, 'hits', '0'),
(142, 62, 'location', 'United States'),
(143, 62, 'image', 'demo6a.jpg'),
(144, 62, 'images', 'demo6a.jpg,demo6b.jpg,demo6c.jpg,demo6d.jpg'),
(145, 62, 'price', '950000'),
(146, 62, 'featured_image', 'demo6_featured.jpg')");


add_post_meta(48,"featured","yes");
add_post_meta(52,"featured","yes");
add_post_meta(55,"featured","yes");
add_post_meta(57,"featured","yes");
add_post_meta(59,"featured","yes");
//add_post_meta(62,"featured","yes"); 

$pack = array (
	'1' => array (
		'enable' => '1',
		'name' => '<b>Free Listing</b> <br> Package',
		'price' => '0',
	),
	'2' => array (
		'enable' => '1',
		'name' => '<b>Basic Listing</b> <br> Package',
		'price' => '10',
		'expire' => '30',
		'rec' => '0',
		'a1' => '1',
		'a2' => '0',
		'a3' => '0',
	),
	'3' => array (
		'enable' => '1',
		'name' => '<b>Silver Listing</b> <br> Package',
		'price' => '25',
		'expire' => '30',
		'rec' => '0',
		'a1' => '1',
		'a2' => '1',
		'a3' => '0',
	),
	'4' => array (
		'enable' => '1',
		'name' => '<b>Gold Listing</b> <br> Package',
		'price' => '50',
		'expire' => '30',
		'rec' => '0',
		'a1' => '1',
		'a2' => '1',
		'a3' => '1',
		'a4' => '1',
	),
);

update_option("packages",$pack);	
update_option("pak_text","<h3>Introduce your package with a 'punchy' headline here!</h3><p>You can edit this description via the admin area and add <b>HTML code</b> also to make it look better.");	


/* ================ EXAMPLE ARTICLE ===================== */

// ADD NEW PRODUCTS
$my_post = array();
$my_post['post_title'] 		= "Example Website Article 1";
$my_post['post_content'] 	= "<h1>This is an example h1 title</h1> <h2>This is an example h2 title</h2> <h3>This is an example h3 title</h3> <br> <p>This is an example paragraph of text added via the admin area.</p> <p>This is an example paragraph of text added via the admin area.</p> <p>This is an example paragraph of text added via the admin area.</p> <ul><li>example list item 1</li><li>example list item 2</li><li>example list item 3</li><li>example list item 4</li><li>example list item 5</li></ul> <p>This is an example paragraph with a link in it, click here to the <a href='http://www.premiumpress.com' title='premium wordpress themes'>premium wordpress themes website.</a></p>";
$my_post['post_excerpt'] 	= "This is an example article that you can create for your website just like any normal Wordpress blog post. You can use the 'image' custom field to attach a prewview picture also!";
$my_post['post_status'] 	= "publish";
$my_post['post_type'] 		= "article_type";
$my_post['post_category'] 	= array($ARTID);
$my_post['tags_input'] 		= "article,blog";
$POSTID 					= wp_insert_post( $my_post );
add_post_meta($POSTID, "type", "article");	
add_post_meta($POSTID, "image", "article.jpg");	

$my_post = array();
$my_post['post_title'] 		= "Example Website Article 2";
$my_post['post_content'] 	= "<h1>This is an example h1 title</h1> <h2>This is an example h2 title</h2> <h3>This is an example h3 title</h3> <br> <p>This is an example paragraph of text added via the admin area.</p> <p>This is an example paragraph of text added via the admin area.</p> <p>This is an example paragraph of text added via the admin area.</p> <ul><li>example list item 1</li><li>example list item 2</li><li>example list item 3</li><li>example list item 4</li><li>example list item 5</li></ul> <p>This is an example paragraph with a link in it, click here to the <a href='http://www.premiumpress.com' title='premium wordpress themes'>premium wordpress themes website.</a></p>";
$my_post['post_excerpt'] 	= "This is an example article that you can create for your website just like any normal Wordpress blog post. You can use the 'image' custom field to attach a prewview picture also!";
$my_post['post_status'] 	= "publish";
$my_post['post_category'] 	= array($ARTID);
$my_post['post_type'] 		= "article_type";
$my_post['tags_input'] 		= "example tag,blog tag";
$POSTID 					= wp_insert_post( $my_post );
add_post_meta($POSTID, "type", "article");	
add_post_meta($POSTID, "image", "article.jpg");	

}




update_option("footer_text","<h3>Welcome to our website!</h3><p><strong>Your introduction goes here!</strong><br />You can customize and edit this text via the admin area to create your own introduction text for your website.</p><p>You can customize and edit this text via the admin area to create your own introduction text for your website.</p>  ");	


update_option("display_home_scroller","yes");
update_option("display_homecolumns","1");
update_option("display_homecats","yes");
update_option("display_50_subcategories","yes");
update_option("display_tabs_rnd","yes");
update_option("display_tabs_pop","yes");
update_option("display_tabs_new","yes");


// ENABLE PAYPAL TEST
$cb = selfURL1().str_replace("wp-admin/","",str_replace("admin.php?page=setup","",str_replace("themes.php?activated=true","",$_SERVER['REQUEST_URI'])))."callback/";

update_option("gateway_paypal","yes");
update_option("paypal_email","example@paypal.com");
update_option("paypal_return",$cb);
update_option("paypal_cancel",$cb);
update_option("paypal_notify",$cb);
update_option("paypal_currency","USD");

?>