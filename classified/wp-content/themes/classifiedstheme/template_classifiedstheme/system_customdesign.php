<?php

class Theme_Design {

 
	 function SYS_PAGES(){
	 
	 global $PPT, $wpdb;

		$STRING = ""; $content = "";
		$main_nav = get_pages("parent=0&sort_column=menu_order&exclude=".get_option("excluded_pages"));
 	 	$pid=1;
		foreach ($main_nav as $loopID => $p) :  
			$content .= '<li><a id="nav-'.$pid.'" href="'.get_permalink($p->ID).'" class="active"><span>'.$p->post_title.'</span></a>';
			$pid++;
			 $categories= get_pages('child_of='.$p->ID.'');
			 $catcount = count($categories);		
			 $i=1;
		
			if(count($categories) > 0){
			$content .="<div class='dropdown_1column'><div class='col_1 firstcolumn'><ul>";
			
				foreach ($categories as $cat) {		
			
				$content .= '<li><a id="nav-'.$pid.'" href="'.get_permalink($cat->ID).'" class="active"><span>';
				$content .= $cat->post_title;
				$content .= '</span></a></li>';
				$i++;	$pid++;
					
				}
				
				$content .="</ul></div></div>";		 
			}	
			
			$content .="</li>";		
			$pid++;
			endforeach; 
			 
			return $content; 	 
	 
	 }
 		 
 
 	 function LAY_NAVIGATION(){
	 
	 	$string = "";
	 
		$string = $this->SYS_CATEGORIES();
		 
		 return $string;
	 
	 }
	 
		 function SYS_CATEGORIES(){
	 
	 	global $PPT; $string = "";  $DISPLAYCATS = ""; $MAKEDISPLAY = "";  $SAVED_DISPLAY = get_option("nav_cats"); $DONECATS = array(); $addToEnd ="";
 
 			if(is_array($SAVED_DISPLAY)){
				foreach($SAVED_DISPLAY as $ThisCat){
				 if(isset($ThisCat['ID']) && $ThisCat['ID'] > 0){
						$DISPLAYCATS .= $ThisCat['ID'].",";			
				 }
				}	
			}else{
			return "";
			}
			
			if(strlen($DISPLAYCATS) == 0){ return ""; }

			if(strlen($DISPLAYCATS) > 1){$MAKEDISPLAY = "&include=".$DISPLAYCATS; }
			
	 
		 $cats = get_categories('pad_counts=1&use_desc_for_title=1&hide_empty=0&parent=0&hierarchical=0'.$MAKEDISPLAY);
		 $cats_count = count($cats);
		 
		 if(is_array($SAVED_DISPLAY)){
				$SHOWRESULTS = $PPT->multisort( $SAVED_DISPLAY , array('ORDER') );
			}else{
				$SHOWRESULTS = array();
		} 

 
		foreach($SHOWRESULTS as $ThisCat){  if( ( isset($ThisCat['ID']) && $ThisCat['ID'] > 0 && $MAKEDISPLAY != "" ) || ( $MAKEDISPLAY =="" ) ){	
		 
		 foreach ($cats as $cat) {
		 
		 if( strlen($cat->cat_name) > 1 && ($MAKEDISPLAY =="" && !in_array($cat->term_id,$DONECATS) ) || ( isset($ThisCat['ID']) && $cat->term_id == $ThisCat['ID'] ) ) {

			array_push($DONECATS, $cat->term_id); 
		 
		 	
		 	$cats_sub = get_categories('parent='.$cat->cat_ID.'&depth=1&hide_empty=0&hierarchical=0'); 
			$cats_sub_count = count($cats_sub);
			
		    if(strtolower($cat->category_nicename) != "articles"){
		 	$string .= '<li><a href="'.get_category_link( $cat->term_id ).'" title="'.$cat->category_nicename.'" class="top">';
			$string .= $cat->cat_name;
			$string .= '</a>';
			}
			
			if($cats_sub_count > 0){
			
			
				if($cats_sub_count > 8){
							
					// WORK OUT COUNT DEVIDED BY 3 COLUMNS				
					$perRow = round($cats_sub_count/3);					
					$string .= '<div class="dropdown_3columns"> <div class="col_3 firstcolumn"><h2>'.$cat->cat_name.'</h2>'; 	
					$cols=0;  $fir=0;				
					foreach ($cats_sub as $cat1) { 					
						if($cols == 0){$string .= '<div class="col_1'; if($fir ==0){$string .= 'firstcolumn'; } $string .= '"><ul class="greybox">';}
										
							$string .= '<li><a href="'.get_category_link( $cat1->term_id ).'" title="'.$cat1->category_nicename.'">';
							$string .= $cat1->cat_name;
							$string .= '</a></li>';					
						
						if( $cols == $perRow){ $string .='</ul></div>'; $cols=0; }else{ $cols++; }
								
					}                        
					$fir++;				
					$string .= '</ul><div class="col_3 firstcolumn"><p style="color:black;">'.$cat->description.'</p></div></div></div></div></li>';
				
				}else{
				
					$string .= '<div class="dropdown_1column"> <div class="col_1 firstcolumn"><ul>'; 
						foreach ($cats_sub as $cat1) { 
						$string .= '<li><a href="'.get_category_link( $cat1->term_id ).'" title="'.$cat1->category_nicename.'">';
						$string .= $cat1->cat_name;
						$string .= '</a></li>';	
						}
					$string .= '</ul></div></div></li>';	
						
				}
              	
			  
			  }
		 
		  
		 }
		 
		 
		 }}} 
		 
		 return $string;
	 
	 }	   
	 
	
	
	function SideCategories(){
	
		$SHOWCATCOUNT = get_option("display_categories_count");
		 
		$SHOW_SUBCATS = get_option("display_50_subcategories");
	
			if(is_home()){ 
	
				$Maincategories = get_categories('orderby='.get_option("display_homecats_orderby").'&pad_counts=1&use_desc_for_title=1&hide_empty=0&hierarchical=0&child_of=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'])); 
					
			}elseif( isset($GLOBALS['premiumpress']['catID']) ){
			
			
				$arg= array();
				$arg['child_of'] = $GLOBALS['premiumpress']['catID'];
				$arg['hide_empty'] = false;
				$arg['pad_counts'] = 1;
				$arg['exclude'] = str_replace("-","",$GLOBALS['premiumpress']['excluded_articles']);
				$Maincategories = get_categories( $arg );
	 
				//$Maincategories = get_categories('orderby='.get_option("display_homecats_orderby").'pad_counts=1&use_desc_for_title=1&hierarchical=0&hide_empty=1&child_of='.$GLOBALS['premiumpress']['catID'].'&exclude='.); 
	  
			} 
	 
	
			if(isset($Maincategories)){
	
			$catlist=""; 
			$Maincatcount = count($Maincategories);	
	 
	
			if($Maincatcount > 0){ $catlist .= '<div class="sideCategories"><ul>';}
	 
				foreach ($Maincategories as $Maincat) { if(strlen($Maincat->name) > 1){ 
		 
		 
					if(is_home() && $Maincat->parent ==0){		
							
						$catlist .= '<li><span><a href="'.get_category_link( $Maincat->term_id ).'" title="'.$Maincat->category_nicename.'" style="font-size:16px; color:#454444;"><b>';
						$catlist .= $Maincat->name;
						if($SHOWCATCOUNT =="yes"){ $catlist .= " (".$Maincat->count.')</b></a></span>'; }else{ $catlist .= '</b></a></span>'; }
						//$catlist .= '</span></a>';		
	
							if($SHOW_SUBCATS == "yes"){
							
								$categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'])); 
								$catcount = count($categories);	
								
							 	$stopShow=0;
								$currentcat=get_query_var('cat');	
								if(count($categories) > 0){
								$catlist .= '<div style="margin-left:10px; margin-bottom:30px;">';
									foreach ($categories as $cat) { if($stopShow < 3){
										$catlist .= '<a href="'.get_category_link( $cat->term_id ).'" title="'.$cat->cat_name.'" class="sm">';
										$catlist .= $cat->cat_name;
										//if(get_option("display_categories_count") =="yes"){ $catlist .= " (".$cat->count.")"; }
										$catlist .= '</a> ';
										} $stopShow++;
									}
									$catlist .= '</div>';
								}	 
								
							}
						
						 $catlist .= '</li>';
						
					} elseif(!is_home() && isset($GLOBALS['premiumpress']['catID']) && $Maincat->category_parent == $GLOBALS['premiumpress']['catID']){
			
						$catlist .= '<li><span><a href="'.get_category_link( $Maincat->term_id ).'" title="'.$Maincat->category_nicename.'" style="font-size:16px; color:#454444;"><b>';
						$catlist .= $Maincat->name;
						if($SHOWCATCOUNT =="yes"){ $catlist .= " (".$Maincat->count.')</b></a></span>'; }else{ $catlist .= '</b></a></span>'; }
						//$catlist .= '</span></a>';
						
							if($SHOW_SUBCATS == "yes"){
							
								$categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'])); 
								$catcount = count($categories);	
								
							 
								$currentcat=get_query_var('cat');	
								if(count($categories) > 0){
								$catlist .= '<div style="margin-left:10px; margin-bottom:30px;">';
									foreach ($categories as $cat) {
										$catlist .= '<a href="'.get_category_link( $cat->term_id ).'" class="sm">';
										$catlist .= $cat->cat_name;
										//if(get_option("display_categories_count") =="yes"){ $catlist .= " (".$cat->count.")"; }
										$catlist .= '</a> ';
									}
									$catlist .= '</div>';
								}	 
								
							}					
						
						
						
						
						$catlist .= '</li>';
			
					}
				}
			}
		
	
			if($Maincatcount > 0){ $catlist .= '</ul><div class="clearfix"></div></div>'; }
	
			echo $catlist;
	
			}	
		 
	
	}	
	
	
	
	
	
	
	
	
	
	
	function SINGLE_CUSTOMFIELDS($post,$FieldValues){

	global $wpdb,$PPT;$row=1;

	if($FieldValues ==""){ 
		$FieldValues = get_option("customfielddata");
	}

	if(is_array($FieldValues)){ 

		foreach($FieldValues as $key => $field){

			if(isset($field['show']) && $field['enable'] == 1 ){ 				 
			
			$imgArray = array('jpg','gif','png');

			$value = $PPT->GetListingCustom($post->ID,$field['key'] );
 
			if(is_array($value) || strlen($value) < 1){   }else{			
		
				print "<div class='full clearfix border_t box'><p class='f_half left'><br />"; 
				print "<b>".$field['name']."</b></p><p class='f_half left'><br />";
		
				switch($field['type']){
				 case "textarea": {			
					print "<br />".nl2br(stripslashes($value));
				 } break;
				 case "list": {
					print  $value;
				 } break;
				 default: {
					
					$pos = strpos($value, 'http://'); 					
					if($field['key'] == "skype"){
						print "<a href='skype:".$value."?add'>" .  $value ."</a>";
					}elseif ($pos === false) {
						print  $value;
					}elseif(in_array(substr($value,-3),$imgArray)){
						print "<img src='".strip_tags($value)."' style='max-width:250px;margin-left:20px;'>";
					}else{
						print "<a href='".$value."' target='_blank'";
						if($GLOBALS['premiumpress']['nofollow'] =="yes"){ print 'rel="nofollow"'; }
						print ">" .  $value ."</a>";				
					} 
					
				 }
		
				}
				$row++;
				print "</p></div>";
				
				}

				} 
			}
		}
	
	}	
		
		
		
		 function SINGLE_IMAGEGALLERY($images){	
	 
	 global $PPT;
	 
	 if($images == ""){ return; } 
	 
	 
		$imgBits = explode("/",get_permalink());	
		$tt = count($imgBits)-2; $it=0;
		
		while($tt > 0){  
			$imagePath .= $imgBits[$it]."/";
			$tt--;$it++;		 
		 }
			 
		 $string = "";
		 $image_array = explode(",",$images); 
	
			foreach($image_array as $image){  $image = trim($image); if(strlen($image) > 2){ 
			 
				switch(substr($image,-3)){
						
					case "pdf": {
							$class="";
							$pic1 = "".$imagePath."wp-content/themes/".strtolower(PREMIUMPRESS_SYSTEM)."/PPT/img/icon-pdf.gif";
							
					} break;
							
					case "": {
							
					} break;	
							
					default: {
							$pic1 = $image;
							$class='class="lightbox"';
					}			
						
				}
				
				$string .= '<a '.$class.' href="'.$PPT->ImageCheck($image,"full").'" width="100%" height="100%" rel="group"><img class="small" src="'.$PPT->ImageCheck($pic1,"t").'&amp;w=150" alt="img"  /></a>';
				
				
				
			} }	
			
			return $string;
	 
	 }
	 
	 
	 
function HomePageCategories($STYLEHOME){


		/* ============== HOME PAGE CATEGORY SEARCH =====================*/
		if($STYLEHOME == 2){ $POSTCOUNT = 6; }else{ $POSTCOUNT = 8; }
	
		$i=1; $icon=1; 
		
		$DISPLAYSUBCATS = get_option('display_50_subcategories');
	
		$Maincategories= get_categories('&orderby='.get_option("display_homecats_orderby").'&pad_counts=1&use_desc_for_title=1&hide_empty=0&hierarchical=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles']));
		$Maincatcount = count($Maincategories);	 
		
		foreach ($Maincategories as $Maincat) { 
			
			if(strlen($Maincat->name) > 1){
	
				if($Maincat->parent ==0){
				if($i%2!=0){echo "<div class=\"catcol".($i==1?" first":"")."\">";}
				
				echo "<ul>";
				$categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'])); 
				$catcount = count($categories);	 ?>

                        <li class="maincat"><a href="<?php echo get_category_link( $Maincat->term_id ); ?>" title="<?php echo $Maincat->name; ?>"><?php echo $Maincat->name; ?> 
                        <?php if(get_option("display_categories_count") =="yes"){ echo " (".$Maincat->count.")"; } ?></a></li>
        
                        <?php if($DISPLAYSUBCATS == "yes"){ 	
                        $currentcat=get_query_var('cat');	
                        if(count($categories) > 0){
							foreach ($categories as $cat) {
							    echo '<li class="cat-item"><a href="'.get_category_link( $cat->term_id ).'">';
                                echo $cat->cat_name." (".($cat->category_count?$cat->count-1:$cat->count).") ".'</a></li>';
                            }
						}	 } 
                        ?> 

	<?php  
			echo "</ul>";

			if($i%2==0){echo "</div>";} 
			
		$icon++; $i++; 
			
			} 
			
		}
	} 
	if($i%2==0){echo "</div>";}
	/* ============== end HOME PAGE CATEGORY SEARCH =====================*/

} 
	 
	 
	 
	 
	 
	
 
}	



/* ============================= PREMIUM PRESS REGISTER WIDGETS ========================= */
 

if ( function_exists('register_sidebar') ){


register_sidebar(array('name'=>'Right Sidebar',
	'before_widget' => '<div class="itembox topper">',
	'after_widget' 	=> '</div></div>',
	'before_title' 	=> '<h2>',
	'after_title' 	=> '</h2><div class="itemboxinner widget">',
));

register_sidebar(array('name'=>'Left Sidebar (3 Column Layouts Only)',
	'before_widget' => '<div class="itembox topper">',
	'after_widget' 	=> '</div></div>',
	'before_title' 	=> '<h2>',
	'after_title' 	=> '</h2><div class="itemboxinner widget">',
));

register_sidebar(array('name'=>'Listing Page Sidebar',
	'before_widget' => '<div class="itembox topper">',
	'after_widget' 	=> '</div></div>',
	'before_title' 	=> '<h2>',
	'after_title' 	=> '</h2><div class="itemboxinner widget">',
));

register_sidebar(array('name'=>'Pages Sidebar',
	'before_widget' => '<div class="itembox topper">',
	'after_widget' 	=> '</div></div>',
	'before_title' 	=> '<h2>',
	'after_title' 	=> '</h2><div class="itemboxinner widget">',
));

register_sidebar(array('name'=>'Article/FAQ Page Sidebar',
	'before_widget' => '<div class="itembox topper">',
	'after_widget' 	=> '</div></div>',
	'before_title' 	=> '<h2>',
	'after_title' 	=> '</h2><div class="itemboxinner widget">',
));
  
} 
 
 
 
 
  
	function CategoryNavigation($type=0){
	
			$catlist="";
			$TabsCat = get_option("display_tabbed_cats");
	 		$catCount = get_option("display_categories_count");
			$catCount1 = get_option("display_categories_count_inner");
			$Maincategories= get_categories('pad_counts=1&use_desc_for_title=1&hide_empty=0&hierarchical=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'].",".$GLOBALS['premiumpress']['excluded_articles']));
			
			$Maincatcount = count($Maincategories);	 
	
			$i=1;
			foreach ($Maincategories as $Maincat) { if(strlen($Maincat->name) > 1){ 
	 
			if($Maincat->parent ==0){
			
	
					$categories= get_categories('child_of='.$Maincat->cat_ID.'&amp;depth=1&hide_empty=0&exclude='.str_replace("-","",$GLOBALS['premiumpress']['excluded_articles']).",".str_replace("-","",$GLOBALS['premiumpress']['excluded_articles'])); 
					$catcount = count($categories);	
					
					if($TabsCat =="yes"){
						if($catcount ==0){ 
							$ThisLink = get_category_link( $Maincat->term_id );   $class="";
						}else{
							$ThisLink = "javascript:toggleLayer('DropList".$i."')";   $class="AA";
						}
					}else{
						$ThisLink = get_category_link( $Maincat->term_id );   $class="";
					}
	
					$ThisClass = ($i == count($Maincategories) - 1) ? '' : ''; //last
					$catlist .= '<li class="'.$ThisClass.$class.'">  <a href="'.$ThisLink.'" title="'.$Maincat->category_nicename.'">';
					$catlist .= $Maincat->name;
					if($catCount =="yes"){ $catlist .= " (".$Maincat->count.")"; }
					$catlist .= '</a>';
								 
			
					// do sub cats
					$currentcat=get_query_var('cat');				

					if(count($categories) > 0){
					$catlist .="<ul id='DropList".$i."' style='display:none;'>";
					if($class == "AA"){ 
						$catlist .= "<li class='sub'><a href='".get_category_link( $Maincat->term_id )."'>".$Maincat->name;
						if($catCount1 =="yes"){ $catlist .= " (".$Maincat->count.")"; }
						$catlist .=  "</a></li>"; 
					}
						foreach ($categories as $cat) {		
					
							$catlist .= '<li class="sub '.$ThisClass.'"> <a href="'.get_category_link( $cat->term_id ).'">';
							$catlist .= $cat->cat_name;
							if($catCount1 =="yes"){ $catlist .= " (".$cat->count.")"; }
							$catlist .= '</a></li>';
							 
							$i++;		
						}
					 $catlist .="</ul>";
					}
		
				$catlist .= '</li>';
				$i++;
			} 
	 } }
	return $catlist;
	
	}


 
	
	
function homepage_list($type=1,$num=6){

		if($num == ""){ $num=6; }
 
		global $wpdb, $PPT;	$String=""; $i=1; $extra=""; 

		if($type ==1){
			$orderbythis ="$wpdb->posts.ID DESC";
		}elseif($type ==2){
			$orderbythis ="$wpdb->postmeta.meta_value DESC";
			$extra="AND $wpdb->postmeta.meta_key='hits'";
		}else{
			$orderbythis ="RAND()";
		}
		
		$SQL = "SELECT $wpdb->posts.*, $wpdb->postmeta.*
				FROM $wpdb->posts
				INNER JOIN $wpdb->postmeta ON ($wpdb->postmeta.post_id = $wpdb->posts.ID ".$extra.")
				WHERE $wpdb->posts.post_status='publish' AND $wpdb->posts.post_type = 'post'
				GROUP BY $wpdb->posts.ID ORDER BY ".$orderbythis." LIMIT ".$num;

		$last_posts = (array)$wpdb->get_results($SQL);

		if(is_array($last_posts) && !empty($last_posts)){

		 
			foreach ($last_posts as $post) {
				
					$String .= '<li>
					
					
					<div style="float:left; margin-right:10px;">
					<a href="'.get_permalink($post->ID).'"><img src="'.$PPT->Image($post->ID,"url").'&amp;w=151&amp;h=106" alt="'.$post->post_title.'"/></a>
					</div>
					<div style="float:left; width:395px;">
					<h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3> 
					
					<span class="price">'.$PPT->Price(get_post_meta($post->ID, "price", true),$GLOBALS['premiumpress']['currency_symbol'],$GLOBALS['premiumpress']['currency_position'],1).'</span>
					
					<div style="width:100%; clear:both;">'.$post->post_excerpt.'</div>
					</div>
					
					
					</li>';
					$i++;
				
			}
		 
		}

return $String;

}

?>