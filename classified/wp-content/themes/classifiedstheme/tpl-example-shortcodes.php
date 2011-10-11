<?php
/*
Template Name: [Example Page Styles]
*/

global $PPTFunction, $userdata; get_currentuserinfo(); // grabs the user info and puts into vars

$wpdb->hide_errors(); nocache_headers(); 

// $PPTFunction->auth_redirect_login(); <-- uncomment if you want this to be a page for members only
 
$GLOBALS['nosidebar-left'] =1; $GLOBALS['nosidebar'] =1;

get_header();  ?>



<div class="clearfix full box border_t"> 
<div class="b_half_col first_col col"> 
			
            
	<!---------- PREMIUMPRESS LAYOUT OBJECTS ---------->

    <h1><?php echo PREMIUMPRESS_SYSTEM; ?> Text Styles</h1>
    
    <div class="clearfix full box border_t"> 
    <div class="padding20">
    
    <h1>Header 1 &lt;h1&gt;</h1>
    <h2>Header 2 &lt;h2&gt;</h2>
    <h3>Header 3 &lt;h3&gt;</h3>
    <h4>Header 4 &lt;h4&gt;</h4>
    
    <p>Paragraph &lt;p&gt;</p>
    
    <p><a href="">Link Style</a> &lt;a href=''&gt;...&lt;/a&gt;</p>
    
    <div class="entry">
    
    <ul>
    <li>list item</li>
     <li>list item</li>
      <li>list item</li>
       <li>list item</li>
        <li>list item</li>
         <li>list item</li>
         
    </ul>
    
    
  <ol>
    <li>list item</li>
     <li>list item</li>
      <li>list item</li>
       <li>list item</li>
        <li>list item</li>
         <li>list item</li>
         
    </ol>
    
    </div>
    
    </div>
    </div>          
            
</div> 
			
<div class="b_half_col last_col col"> 
		
        
	<!---------- PREMIUMPRESS LAYOUT OBJECTS ---------->


    <h1><?php echo PREMIUMPRESS_SYSTEM; ?> Notification Boxes</h1>
    
    <div class="clearfix full box border_t"> 
    <div class="padding20">
    
    <div class="notification success"><p>This is some random text, this is some random text!</p></div>
    <div class="notification error"><p>This is some random text, this is some random text!</p></div>
    <div class="notification warning"><p>This is some random text, this is some random text!</p></div>
    
    <div class="notification neutral"><p>This is some random text, this is some random text!</p></div>
    <div class="notification tip"><p>This is some random text, this is some random text!</p></div>
    
    
    
    </div>
    </div>        
			
</div> 
</div>
 
 
 

	<!---------- PREMIUMPRESS LAYOUT OBJECTS ---------->


 <div class="clearfix full box border_t border_b"> 
<div class="b_half_col first_col col"> 
			
 
    <h1><?php echo PREMIUMPRESS_SYSTEM; ?> Tabbed Content</h1>
 
<xmp><ul class="tabs">         
        <li><a href="#tab1" id="icon-single-info">Tab 1</a></li>            
        <li><a href="#tab2" id="icon-single-images">Tab 2</a></li>       
        <li><a href="#tab3">Tab 3</a></li>      
</ul> 
        
    <div class="tab_container"> 
    
        <div id="tab1" class="tab_content entry"> 
            <p class="padding20"> Tab 1 Content</p>           
        </div> 
                
        <div id="tab2" class="tab_content">                
            <p class="padding20">Tab 2 content</p>
        </div>
    
        <div id="tab3" class="tab_content">                
            <p class="padding20">Tab 3 content</p>
        </div>
        
    </div></xmp>


    <ul class="tabs">         
        <li><a href="#tab1" id="icon-single-info">Tab 1</a></li>            
        <li><a href="#tab2" id="icon-single-images">Tab 2</a></li>       
        <li><a href="#tab3" >Tab 3</a></li>      
    </ul> 
        
    <div class="tab_container"> 
    
        <div id="tab1" class="tab_content entry"> 
            <p class="padding20"> Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content Tab 1 Content</p>           
        </div> 
                
        <div id="tab2" class="tab_content">                
            <p class="padding20">Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content Tab 2 content </p>
        </div>
    
        <div id="tab3" class="tab_content">                
            <p class="padding20">Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content Tab 3 content </p>
        </div>
        
    </div>


	<script type="text/javascript"> 
     
    jQuery(document).ready(function() {
     
        //Default Action
        jQuery(".tab_content").hide(); //Hide all content
        jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
        jQuery(".tab_content:first").show(); //Show first tab content
        
        //On Click Event
        jQuery("ul.tabs li").click(function() {
            jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
            jQuery(this).addClass("active"); //Add "active" class to selected tab
            jQuery(".tab_content").hide(); //Hide all tab content
            var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            jQuery(activeTab).fadeIn(); //Fade in the active content
            return false;
            
        });
     
    });
    </script>
    
    
				<h1><?php echo PREMIUMPRESS_SYSTEM; ?> Boxes</h1>
				<p> 
				<xmp><p class="rounded border inner"> ... content ...</p>
				</xmp> 
				</p> 
				<p class="rounded border inner">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. 
				</p> 
				
                
                <h1><?php echo PREMIUMPRESS_SYSTEM; ?> Multi Column Paragraphs</h1>
				
				<p> 
				<xmp><p class="multi_col"> ... content ...</p>
				</xmp> 
				</p> 
				<p class="multi_col">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 		
    




</div> 
			
<div class="b_half_col last_col col"> 

  <h1><?php echo PREMIUMPRESS_SYSTEM; ?> Buttons</h1>
 
<p> 
				<xmp><a href="URL" class="button black">Button</a>
<a href="URL" class="button orange">Button</a>
<a href="URL" class="button blue">Button</a>
				</xmp> 
				</p> 
				<p> 
					<a href="http://themetation.com" class="button black">Button</a> <a href="http://themetation.com" class="button orange">Button</a> <a href="http://themetation.com" class="button blue">Button</a> 
				</p> 
				<p> 
				<xmp><a href="URL" class="button black button_long">Button</a>
<a href="URL" class="button orange button_long">Button</a>
<a href="URL" class="button blue button_long">Button</a>
				</xmp> 
				</p> 
				<p> 
					<a href="http://themetation.com" class="button black button_long">Button</a> <a href="http://themetation.com" class="button orange button_long">Button</a> <a href="http://themetation.com" class="button blue button_long">Button</a> 
				</p> 
				







 








<h1><?php echo PREMIUMPRESS_SYSTEM; ?> Page Navigation</h1>
 




				<div class="c_50">

				

					<div class="c_50_left">



						<h5>01</h5>

						<ul class="pagination paginationD paginationD01">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>

						

					</div>

				

					<div class="c_50_right">

					

						<h5>06</h5>

						<ul class="pagination paginationD paginationD06">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>						

					

					</div>

				

				</div>

								

				<div class="c_50">

				

					<div class="c_50_left">



						<h5>02</h5>

						<ul class="pagination paginationD paginationD02">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>

						

					</div>

				

					<div class="c_50_right">

					

						<h5>07</h5>

						<ul class="pagination paginationD paginationD07">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>						

					

					</div>
                    
                    
                    
                    
                    
                    
                    
                    

				

				</div>

				

				<div class="c_50">

				

					<div class="c_50_left">



						<h5>03</h5>

						<ul class="pagination paginationD paginationD03">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>

						

					</div>

				

					<div class="c_50_right">

					

						<h5>08</h5>

						<ul class="pagination paginationD paginationD08">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>						

					

					</div>
                    
                    
<div class="c_50">

				

					<div class="c_50_left">



						<h5>04</h5>

						<ul class="pagination paginationD paginationD04">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>

						

					</div>

				

					<div class="c_50_right">

					

						<h5>09</h5>

						<ul class="pagination paginationD paginationD09">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>						

					

					</div>

				

				</div>

			

				<div class="c_50">

				

					<div class="c_50_left">



						<h5>05</h5>

						<ul class="pagination paginationD paginationD05">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>

						

					</div>

				

					<div class="c_50_right">

					

						<h5>10</h5>

						<ul class="pagination paginationD paginationD10">

							<li><a href="#" class="first">First</a></li>

							<li><a href="#" class="previous">Previous</a></li>

							<li><a href="#">1</a></li>

							<li><a href="#">2</a></li>

							<li><a href="#" class="current">3</a></li>

							<li><a href="#">4</a></li>

							<li><a href="#">5</a></li>

							<li><a href="#" class="next">Next</a></li>

							<li><a href="#" class="last">Last</a></li>

						</ul>						

					

					</div>
 
                    
                    
                  </div>  

				

				</div>





</div> 
</div>
<!---------- PREMIUMPRESS LAYOUT OBJECTS ---------->



<h1><?php echo PREMIUMPRESS_SYSTEM; ?> General Layout Classes</h1>

 

			 
			
			<p>Below are a few general classes that you will be using in the layout. </p> 
			<ul> 
				<li><strong>.full</strong> - To have 100 width.</li> 
				<li><strong>.col</strong> - Use this to float a div with 10px margin on both side. Mostly used in layout more than 1 column.</li> 
				<li><strong>.box</strong> - To have a 10px bottom margin.</li> 
				<li><strong>.first_col</strong> - The first floated component with no margin left.</li> 
				<li><strong>.last_col</strong> - The last floated component with no margin left.</li> 
			</ul> 
			<strong>.clearfix</strong><br /> 
			<p>When there is a float element within a div, you will need to use the class <strong>"clearfix"</strong> for the container of the floated element. For example:</p> 
			
<xmp class="box"><div class="clearfix full">
	<div class="col first_col"></div>
	<div class="col last_col"></div>
</div>
</xmp> 
			
			<div class="clearfix full box border_t border_b"> 
			<div class="b_half_col first_col col"> 
			<h4>Layout Options - 960PX</h4> 
			<ul> 
				<li>1 column layout - 960px</li> 
				<li>2 columns layout - 640px + 300px</li> 
				<li>2 columns layout ( even ) - 470px + 470px</li> 
				<li>3 columns layout - 300px + 300px + 300px</li> 
				<li>4 columns layout - 225px + 225px + 225px + 225px</li> 
			</ul> 
			
			<h5>Concept</h5> 
			<ul> 
				<li><strong>w_960</strong> - define the max width layout as 960px.</li> 
				<li><strong>.b1</strong> - 640px, normally we use for content area.</li> 
				<li><strong>.b1 .b1</strong> - 310px, this use to split the .b1 into 2 columns.</li> 
				<li><strong>.b1 .b1 .b1</strong> - 145px, this is to spliy the splited columns into extra columns </li> 
				<li><strong>.b2</strong> - 300px, nor mally we use of sidebar area.</li> 
				<li><strong>.b2 .b2</strong> - 140px, split the b2 into 2 columns.</li> 
				<li><strong>.b_half_col</strong> - 470px, split the entire 960px layout into 2 columns</li> 
				<li><strong>.b_third_col</strong> - 300px, split the entire 960px layout into 3 columns</li> 
				<li><strong>.b_fourth_col</strong> - 225px, split the entire 960px layout into 4 columns</li> 
			</ul> 
			</div> 
			
			<div class="b_half_col last_col col"> 
			<h4>Layout Options - 800PX</h4> 
			<ul> 
				<li>1 column layout - 800px</li> 
				<li>2 columns layout - 200px + 580px</li> 
				<li>3 columns layout - 200px + 280px + 280px</li> 
 
			</ul> 
			
			<h5>Concept</h5> 
			<ul> 
				<li><strong>w_800</strong> - define the max width layout as 800px.</li> 
				<li><strong>.m1</strong> - 200px, normally we use for sidebar area.</li> 
				<li><strong>.m2</strong> - 580px, nor mally we use of content area.</li> 
				<li><strong>.m2 .m2</strong> - 280px, split the m2 into 2 columns.</li> 
				<li><strong>.m_half_col</strong> - 380px, split the entire 800px layout into 2 columns</li> 
			</ul> 
			
		</div> 
		</div> 
		
		<div class="full clearfix box"> 
			<h4>Fluid Layout</h4> 
			<ul> 
				<li><strong>.f1</strong> - 25%</li> 
				<li><strong>.f2</strong> - 67%</li> 
				<li><strong>.f3</strong> - 33%</li> 
				<li><strong>.f4</strong> - 75%</li> 
				<li><strong>.f_half</strong> - 50%</li> 
			</ul> 
			
			<h5>Concept</h5> 
			<p>Just keep in mind that the total of f for a complete row will be 5 if you are using column in different width. For example, f1 + f4, f2 + f3.</p> 
			
			<p>The usage for a fluid layout is slightly different. We will have an extra div within the column to control the padding or margin. You will notice that we have an extra class named <strong>gut</strong> which consists 20px right margin. This will break the layout.</p> 
<xmp class="box"><div class="full clearfix box border_b">
	<div class="f1 left">
		<div class="gut"></div>
	</div>
	<div class="f4 left">
		<div class="gut"></div>
	</div>
			
</div>
</xmp>			
			
		</div> 

















<!-- START LAYOUT WRAPPER, YOU CAN CHANGE THE FULL WIDTH CLASS --> 
 
		<div class="full clearfix box border_b"> 
			<div class="f1 left"> 
				<strong>class = .left .f1</strong> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p><strong>class = .gut</strong><br/ >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
		
			<div class="f4 left"> 
				<strong>class = .left .f4</strong> 
				<div class="gut"> 
					<h3>Content Area - <strong>75% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
				</div> 
			</div> 
			
		</div> 
		
		<div class="full clearfix box border_b"> 
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor.</p> 
				</div> 
			</div> 
		
			<div class="f4 left"> 
				<div class="gut"> 
					<h3>Content Area - <strong>75% - 20px</strong></h3> 
					<div class="f1 left"> 
						<div class="gut"><p><strong>25% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
						</div> 
					</div> 
					<div class="f4 left"> 
						<div class="gut"><p><strong>75% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem.</p> 
						</div> 
					</div> 
					
				</div> 
			</div> 
			
		</div> 
		
		<div class="full clearfix box border_b"> 
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor.</p> 
				</div> 
			</div> 
		
			<div class="f4 left"> 
				<div class="gut"> 
					<h3>Content Area - <strong>75% - 20px</strong></h3> 
					<div class="f_half left"> 
						<div class="gut"><p><strong>50% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
						</div> 
					</div> 
					<div class="f_half left"> 
						<div class="gut"><p><strong>50% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem.</p> 
						</div> 
					</div> 
					
				</div> 
			</div> 
			
		</div> 
		
		<div class="full clearfix box border_b"> 
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor.</p> 
				</div> 
			</div> 
		
			<div class="f4 left"> 
				<div class="gut"> 
					<h3>Content Area - <strong>75% - 20px</strong></h3> 
					<div class="f2 left"> 
						<div class="gut"><p><strong>67% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem.</p> 
						</div> 
					</div> 
					<div class="f3 left"> 
						<div class="gut"><p><strong>33% - 20px</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
						</div> 
					</div> 
					
				</div> 
			</div> 
			
		</div> 
 
		
		<!-- CONTENT AREA --> 
		<div class="full clearfix box border_b"> 
			<div class="f3 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>33% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
		
			<div class="f2 left"> 
				<div class="gut"> 
					<h3>Content Area - <strong>67% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
				</div> 
			</div> 
			
		</div> 
		
		<!-- CONTENT AREA --> 
		<div class="full clearfix box border_b"> 
			<div class="f_half left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>50% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
		
			<div class="f_half left"> 
				<div class="gut"> 
					<h3>Content Area - <strong>50% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
				</div> 
			</div> 
			
		</div> 
		
		<!-- CONTENT AREA --> 
		<div class="full clearfix box border_b"> 
			<div class="f3 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>33% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
		
			<div class="f3 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>33% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
			
			<div class="f3 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>33% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
			
		</div> 
 
		<!-- CONTENT AREA --> 
		<div class="full clearfix box border_b"> 
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
		
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
			
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
			
			<div class="f1 left"> 
				<div class="gut"> 
					<h3>Sidebar - <strong>25% - 20px</strong></h3> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu.</p> 
				</div> 
			</div> 
			
	 
        
        
        
        
        
        
        
        
        
        

				<h3>Form &amp; Elements - <strong>640PX</strong></h3> 
				
				<!-- FORM --> 
				<h4>Form</h4> 
				<form action=""> 
					<fieldset> 
						<legend>Legend</legend> 
						
						<div class="full clearfix border_t box"> 
							<p class="f_half left"> 
								<label for="name">Name <span class="required">*</span></label><br /> 
								<input type="text" name="name" id="name" class="short" tabindex="1" /><br /> 
								<small>input description</small> 
							</p> 
							
							<p class="f_half left"> 
								<label for="email">Email <span class="required">*</span></label><br /> 
								<input type="text" name="email" id="email" class="short" tabindex="2" /><br /> 
								<small>input description</small> 
							</p> 
						</div> 
						
						<div class="full clearfix border_t box"> 
							<p> 
								<label for="url">URL</label><br /> 
								<input type="text" name="url" id="url" class="long" tabindex="3" /><br /> 
								<small>input description</small> 
							</p> 
						</div> 
						
						<div class="full clearfix border_t box"> 
							<p class="f_half left"> 
								<label for="comment">Comment <span class="required">*</span></label><br /> 
								<textarea tabindex="4" class="short" rows="4" name="comment" id="comment"></textarea><br /> 
								<small>input description</small> 
							</p> 
							
							<p class="f_half left"> 
								<label for="comment2">Comment 2 <span class="required">*</span></label><br /> 
								<textarea tabindex="5" class="short" rows="4" name="comment2" id="comment2"></textarea><br /> 
								<small>input description</small> 
							</p> 
						</div> 
						
						<div class="full clearfix border_t box"> 
							<p class="left f_half"> 
								<strong>Gender</strong><br /> 
								<label for="male"><input type="radio" id="male" name="gender" class="radio" tabindex="6">Male</label><br /> 
								<label for="female"><input type="radio" id="female" name="gender" class="radio" tabindex="7">Female</label> 
							</p> 
							
							<p class="left f_half left"> 
								<strong>Interests</strong><br /> 
								<label for="design"><input type="checkbox" id="design" name="interests" class="radio" tabindex="8">Design</label><br /> 
								<label for="coding"><input type="checkbox" id="coding" name="interests" class="radio" tabindex="9">Coding</label><br /> 
								<label for="reading"><input type="checkbox" id="reading" name="interests" class="radio" tabindex="10">Reading</label><br /> 
								<label for="sleeping"><input type="checkbox" id="sleeping" name="interests" class="radio" tabindex="11">Sleeping</label><br /> 
							</p> 
						</div> 
						
						<div class="full clearfix border_t box"> 
							<p> 
								<label for="url">Others</label><br /> 
								<input type="text" name="others" id="others" class="long" tabindex="12" /><br /> 
								<small>input description</small> 
							</p> 
						</div> 
						
						<div class="full clearfix border_t box"> 
							<p class="f_half left"> 
								<label for="location">Location <span class="required">*</span></label><br /> 
								<select id="location" name="location" class="short" tabindex="13"> 
									<option selected="selected">Select Location</option> 
									<option value="locA">Location A</option> 
									<option value="locB">Location B</option> 
									<option value="locC">Location C</option> 
									<option value="locD">Location D</option> 
								</select> 
							</p> 
							
							<p class="f_half left"> 
								<label for="location2">Location <span class="required">*</span></label><br /> 
								<select id="location2" name="location2" class="short" tabindex="14"> 
									<option selected="selected">Select Location</option> 
									<option value="locA">Location A</option> 
									<option value="locB">Location B</option> 
									<option value="locC">Location C</option> 
									<option value="locD">Location D</option> 
								</select> 
							</p>						</div> 
 
						
						<div class="full clearfix border_t box"> 
							<p class="full clearfix"> 
								<input type="submit" name="submit" id="submit" class="button blue" tabindex="15" value="submit" /> 
							</p> 
						</div> 
	
					</fieldset> 
				</form> 
				
			 
				
			</div> 
			
	 
     
     
     
     
  		<!-- CONTENT AREA --> 
		<div  class="clearfix full border_b box border_t"> 
		
			<center class="border_b box inner"><h2>This sample page demonstrates a tiny fraction of what you get.</h2></center> 
			
			<!-- 3 Columns news box --> 
			<div class="box clearfix full border_b"> 
				<div class="b_third_col col first_col"> 
					<p><strong>A Box</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				<div class="b_third_col col"> 
					<p><strong>A Box</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
				<div class="b_third_col col last_col"> 
					<p><strong>A Box</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero.</p> 
				</div> 
			</div> 
			
			<!-- left content --> 
	 
				<div class="append border_r clearfix"> 
					<h3>A Sample Article</h3> 
					<p><img src="<?php echo $GLOBALS['template_url']; ?>/thumbs/article.jpg" alt="my image" class="alignleft frame rounded" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas.</p> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas.</p> 
					<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p></blockquote> 
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem. Quisque vel nisl libero, vitae consequat arcu. Maecenas pharetra mauris eget sapien blandit venenatis. Integer adipiscing, magna volutpat pharetra ultrices, tellus eros commodo tellus, id molestie libero lorem eu augue. Fusce eu erat lectus. Suspendisse et elit non neque pretium vulputate. Ut dapibus felis et dui pellentesque egestas. </p> 
					
					<div class="f_half left"> 
						<div class="gut"><p><strong>A box</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
						</div> 
					</div> 
					<div class="f_half left"> 
						<div class="gut"><p><strong>A box</strong><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eros lectus, sollicitudin at vestibulum sit amet, elementum et libero. Mauris neque purus, consectetur eget vulputate quis, dapibus ac tortor. Vestibulum libero ante, porttitor eget ullamcorper id, imperdiet vel libero. Fusce nec turpis metus, nec venenatis lorem.</p> 
						</div> 
					</div> 
 
				</div> 
	 
     
     
     
     
     
	   
        
        
        
        
        
        
        
        
        
        
		
		
	<!-- END LAYOUT WRAPPER -->	
	</div> 

<?php get_footer(); ?>