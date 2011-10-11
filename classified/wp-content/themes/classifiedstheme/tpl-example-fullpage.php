<?php
/*
Template Name: [Example Full Page Layout]
*/

global $PPTFunction, $userdata; get_currentuserinfo(); // grabs the user info and puts into vars

$wpdb->hide_errors(); nocache_headers(); 

// $PPTFunction->auth_redirect_login(); <-- uncomment if you want this to be a page for members only
 
$GLOBALS['nosidebar-left'] =1; $GLOBALS['nosidebar'] =1;

get_header();  ?>

<div class="middleSidebar left">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                
    <h1><?php the_title(); ?></h1>
    
    <div class="entry">
    
    <?php the_content(); ?>     
    
    </div>		
    
    <?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>