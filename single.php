<?php 

/*
 	netfunktheme single post
*/

?>

<?php get_header(); ?>

<!--container-->

<div id="container">

<?php 

	if ( have_posts() ): 
	 
	 while ( have_posts() ): 
	 
	 the_post();
 
?>

<?php

	/* Posts Page Spash Image display
	
	# 	0 = Splash Img | Hide Thumbnail
	# 	1 = Splash Img + Show Thumbnail 
	# 	2 = No Splash | Hide Thumbnail 
	# 	3 = No Splash + Show Thumbnail 
	
	*/
	 
	 // determine if we are using splash images
	 $splash_image = netfunktheme_catch_post_image();
	 
	 if ( $splash_image != '' ){ // skip if no image
	 
		 if (isset($netfunk_post_options['posts_splash_type'])) {
			 
			if ($netfunk_post_options['posts_splash_type'] <= 2) {
				// clear splash img
				$splash_image = '';
			}
		
		}
	
	}
	 
?>

	<?php if ( $splash_image != '' ) { // we have image - show splash page image style ?>

     <div class="large-12 featured-entry hide-for-small">

        <div class="featured-image-bg" style="background-image: url('<?php echo $splash_image ?>'); ">

            <div class="row">
            
            <h3>
			
				<?php the_title(); ?>

                <?php  echo '<small>' . get_template_part( 'template/entry', 'meta' ) . '</small>'; ?>
             
             </h3>
            
            </div>

        </div>

    </div>
    
    <?php } ?>

	<div class="content content-pad">

    <div class="row">

	<div class="large-<?php echo (isset($netfunk_post_options['show_posts_sidebar']) && $netfunk_post_options['show_posts_sidebar'] == 'yes' ? '9' : '12')?> small-12 columns">
    
    
		<?php if ( $splash_image == '' ) { // no splash page style ?>
        
    
            <div class="large-12">
            
            	<h3> <?php the_title(); ?>  </h3>
                
                 <?php  get_template_part( 'template/entry', 'meta' ); ?>

            </div>
        
        
        <?php } ?>

		<h2 class="show-for-small"> <?php echo the_title(); ?> </h2>

    	<?php 
            
			if ( (isset($netfunk_post_options['show_nav_above']) && $netfunk_post_options['show_nav_above'] == 'yes') or (!isset($netfunk_post_options['show_nav_above'])) ) {

				get_template_part( 'template/nav', 'above-single' );
			
			}

		?>

        <hr />
       
		<?php  /* show bredcrumbs (not yet used) */  //netfunktheme_breadcrumbs();  ?>
		
		<?php  get_template_part( 'entry' );  ?>

 
         <br class="clear" />

		<?php 
                
            if ( (isset($netfunk_post_options['show_post_footer_meta']) && $netfunk_post_options['show_post_footer_meta'] == 'yes') or (!isset($netfunk_post_options['show_post_footer_meta'])) ) {

                get_template_part( 'template/entry-footer-single', get_post_format() );
            
            }
        
        ?>
 
        <?php 
					
			if ( (isset($netfunk_post_options['show_post_author']) && $netfunk_post_options['show_post_author'] == 'yes') or (!isset($netfunk_post_options['show_post_author']))) {

				do_action( 'netfunktheme_about_the_author');
			
			}
		
		?>
        
        <br class="clear" />
        
        <div class="small-12">

            <div class="entry-comments">

                 <?php 
					
					if ( (isset($netfunk_post_options['show_post_comments']) && $netfunk_post_options['show_post_comments'] == 'yes') or (!isset($netfunk_post_options['show_post_comments'])) ) {
					
						comments_template( '', true ); 
					
					}
				
				?>
        
            </div>
    
        </div>
        
        <br />

        <div class="small-12 columns">   

		 <?php 
        
            if ( (isset($netfunk_post_options['show_nav_below']) && $netfunk_post_options['show_nav_below'] == 'yes') or (!isset($netfunk_post_options['show_nav_below'])) ) {

                get_template_part( 'template/nav', 'below-single' );
            
            }
        
        ?>

         </div>
        

		<?php if ( is_active_sidebar( 'home-bottom-widget-area' ) ) : ?>
		
			<?php if ( (isset($netfunk_post_options['show_post_bottom_content']) && $netfunk_post_options['show_post_bottom_content'] == 'yes') or (!isset($netfunk_post_options['show_post_bottom_content']))) { ?>
    
                <!-- Page Bottom Content -->

				<?php if ( ! dynamic_sidebar( 'home-bottom-widget-area' ) ) : ?>
                
                    <h4> You need to add some widgets... </h4>
                
                <?php endif; // end primary widget area ?>
                
                <br class="clear" />


            <?php } ?>
        
        <?php endif; ?>

    </div>

	<?php 
        
	   if ( (isset($netfunk_post_options['show_posts_sidebar']) && $netfunk_post_options['show_posts_sidebar'] == 'yes') or (!isset($netfunk_post_options['show_posts_sidebar'])) ){
			get_sidebar(); 
		} 
	
	?>

</div>

</div>

<?php endwhile; ?>
 
 		<!--pre>
        <?php print_r ($netfunk_post_options) /* debug line */ ?>
        </pre-->

<?php endif; ?>

</div><!--container-->

<?php get_footer(); ?>
