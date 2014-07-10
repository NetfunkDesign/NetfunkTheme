<?php

/* 

this action 'page' is used by the theme plugin system to create system pages on the fly.
Removing the need to create individual pages when using netfunktheme theme plugins and layout featues.

*/

//$netfunktheme_action_page_options = '';

?>

<?php get_header(); ?>

<div id="container">

  <div class="content">

    <div class="row">

	  <div class="large-12 small-12 columns">

		<br />

        <div class="large-6 small-12 columns left">
    
            <h1><?php netfunktheme_action_page_title(); ?></h1>
    
        </div>

		<br class="clear" />

		<?php //netfunktheme_breadcrumbs() /* experimental */ ?>
    
        <div class="large-9 columns">
    
		<?php 
          // place holder for additional action page footer information via 
          do_action('netfunktheme_action_page_header'); 
        
        ?>

            <div class="entry-content">
                        
            <?php 
                        
              if ( has_post_thumbnail() ) {
                //the_post_thumbnail();
              } 
            
            ?>
                    
			<?php the_content(); ?>
                
                <br class="clear" />

            </div>
            
			<?php 
                // place holder for additional action page footer information via 
                do_action('netfunktheme_action_page_footer'); 
            ?>
    
        </div>
        
			 <?php
              // place holder for action page sidebar content   
              do_action('netfunktheme_action_page_sidebar'); 
            ?>

	  </div>

    </div>

  </div>

</div>

<?php get_footer(); ?>
