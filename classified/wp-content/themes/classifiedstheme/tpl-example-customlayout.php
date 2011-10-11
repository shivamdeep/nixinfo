<?php
/*
Template Name: [Example Custom Layout]
*/

global $PPTFunction, $userdata; get_currentuserinfo(); // grabs the user info and puts into vars

$wpdb->hide_errors(); nocache_headers(); 




  ?>

 
<!DOCTYPE html> 
 
<html lang="en"> 
<head> 
	<meta charset="utf-8"/> 
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>    

	
	<!-- LINK TO EXTERNAL CSS FILES --> 
	<link rel="stylesheet" type="text/css" href="<?php echo PPT_PATH; ?>css/css.premiumpress.css" media="screen" />

	<?php wp_head(); ?> 
	
</head> 
 
<body> 
	<!-- START LAYOUT WRAPPER, YOU CAN CHANGE THE FULL WIDTH CLASS --> 
	<div class="wrapper w_960"> 
	 
		<!-- HEADER FOR LOGO AND INFO --> 
		<div id="header" class="full box">
        
        <h1><a href="<?php echo $GLOBALS['bloginfo_url']; ?>/" title="CSS Layout">CSS Layout - Fixed Layout 960PX</a></h1>
        
        </div> 
		
		<!-- MENU --> 
        <div id="menudrop">
          
            <div class="full"> 
            
            	<?php if(has_nav_menu('PPT-CUSTOM-MENU-PAGES')){ wp_nav_menu( array( 'theme_location' => 'PPT-CUSTOM-MENU-PAGES', 'depth'=>'1', 'before'=>'',  'after'=>'', 'menu_class' => 'menu' ) ); }else{ ?>
            
                <ul class="menu">           
                 
                 <li><a href="<?php echo $GLOBALS['bloginfo_url']; ?>/" title="<?php bloginfo('name'); ?>"><?php echo SPEC($GLOBALS['_LANG']['_home']) ?></a></li> 
                        
                    <?php echo $ThemeDesign->LAY_NAVIGATION(); ?>            
                     
                </ul> 
                
                <?php } ?>
                
            </div> 
        </div>
        
		
		<!-- CONTENT AREA --> 
		<div id="page" class="clearfix full border_t box"> 
		
			<div id="content" class="col b1 first_col"> 
				<h3>Left Content Area - <strong>640PX</strong></h3> 
				<p><strong>class = .col .b1 .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
			</div> 
			
			<div id="sidebar" class="col b2 last_col"> 
				<h3>Sidebar Heading - <strong>300PX</strong></h3> 
				<p><strong>class = .col .b2 .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem.</p> 
			</div> 
			
		</div> 
		
		<!-- MORE BOXES WITHIN CONTENT --> 
		<div class="box clearfix full border_t"> 
			<div class="first_col b1 col"> 
				
				<h3>Split Column Within Content Area - <strong>640PX</strong></h3> 
				<p><strong>class = .col .b1 .first_col</strong><br/ ></p> 
				<div class="col b1 first_col"> 
					<h5>First Column - <strong>310PX</strong></h5> 
					<p><strong>class = .col .b1 .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				<div class="col b1 last_col"> 
					<h5>Second Column - <strong>310PX</strong></h5> 
					<p><strong>class = .col .b1 .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				
			</div> 
			
			<div class="last_col b2 col"> 
				
				<h3>Split Column Within Sidebar</h3> 
				
				<div class="col b2 first_col"> 
					<h5><strong>140PX</strong></h5> 
					<p><strong>class = .col .b2 .first_col</strong><br/ >Lorem ipsum dolor sit amet, <a href="http://google.com" title="URL">consectetur adipiscing</a> elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				<div class="col b2 last_col"> 
					<h5><strong>140PX</strong></h5> 
					<p><strong>class = .col .b2 .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				
			</div> 
 
		</div> 
		
		<!-- EVEN MORE BOXES WITHIN CONTENT --> 
		<div class="box clearfix full border_t"> 
			<div class="first_col b1 col"> 
				
				<h3>Split Column Within Content Area - More</h3> 
				
				<div class="col b1 first_col"> 
					<div class="first_col col b1"><p><strong>145PX</strong><br /><strong>class = .col .b1 .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p></div> 
					<div class="last_col col b1"><p><strong>145PX</strong><br /><strong>class = .col .b1 .lastt_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p></div> 
					
				</div> 
				<div class="col b1 last_col"> 
					<div class="first_col col b1"><p><strong>145PX</strong><br /><strong>class = .col .b1 .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p></div> 
					<div class="last_col col b1"><p><strong>145PX</strong><br /><strong>class = .col .b1 .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p></div> 
				</div> 
				
			</div> 
			
			<div class="last_col b2 col"> 
				
				<h3>Split Column Within Sidebar</h3> 
				
				<div class="col b2 first_col"> 
					<h5><strong>140PX</strong></h5> 
					<p>Lorem ipsum dolor sit amet, <a href="http://google.com" title="URL">consectetur adipiscing</a> elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				<div class="col b2 last_col"> 
					<h5><strong>140PX</strong></h5> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				
			</div> 
 
		</div> 
		
		<!-- COLUMNS IN FULL WIDTH LAYOUT--> 
		<div class="box clearfix full border_t"> 
			<h3>2 Columns in Full Width - <strong>960PX</strong></h3> 
			<div class="b_half_col col first_col"> 
				<p><strong>470PX</strong><br /><strong>class = .col .b_half_col .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_half_col col last_col"> 
				<p><strong>470PX</strong><br /><strong>class = .col .b_half_col .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
		</div> 
		
		<div class="box clearfix full border_t"> 
			<h3>3 Columns in Full Width - <strong>960PX</strong></h3> 
			<div class="b_third_col col first_col"> 
				<p><strong>300PX</strong><br /><strong>class = .col .b_third_col .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_third_col col"> 
				<p><strong>300PX</strong><br /><strong>class = .col .b_third_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_third_col col last_col"> 
				<p><strong>300PX</strong><br /><strong>class = .col .b_third_col .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
		</div> 
		
		<div class="box clearfix full border_t"> 
			<h3>4 Columns in Full Width - <strong>960PX</strong></h3> 
			<div class="b_fourth_col col first_col"> 
				<p><strong>225PX</strong><br /><strong>class = .col .b_fourth_col .first_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_fourth_col col"> 
				<p><strong>225PX</strong><br /><strong>class = .col .b_fourth_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_fourth_col col"> 
				<p><strong>225PX</strong><br /><strong>class = .col .b_fourth_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
			<div class="b_fourth_col col last_col"> 
				<p><strong>225PX</strong><br /><strong>class = .col .b_fourth_col .last_col</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
			</div> 
		</div> 
 
		
		
		
	</div> 
    
 <?php wp_footer(); ?> 
</body> 
</html>