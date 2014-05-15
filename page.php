<?php 

/*
 	netfunktheme pages
*/

// netfunktheme default options

//posts_splash_type
if ( ! isset( $netfunk_page_options['page_splash_type'] ) )
	$netfunk_page_options['page_splash_type'] = '0';
if ( ! array_key_exists( $netfunk_page_options['page_splash_type'], $post_splash_options ) )
	$netfunk_page_options['page_splash_type'] = '0';
//show_page_comments
if ( ! isset( $netfunk_page_options['show_page_comments'] ) )
	$netfunk_page_options['show_page_comments'] = 'yes';
if ( ! array_key_exists( $netfunk_page_options['show_page_comments'], $onoff_options ) )
	$netfunk_page_options['show_page_comments'] = 'yes';
//show_page_author 
if ( ! isset( $netfunk_page_options['show_page_author'] ) )
	$netfunk_page_options['show_page_author'] = 'yes';
if ( ! array_key_exists( $netfunk_page_options['show_page_author'], $onoff_options ) )
	$netfunk_page_options['show_page_author'] = 'yes';

if ( ! isset( $netfunk_page_options['show_page_bottom_content'] ) )
	$netfunk_page_options['show_page_bottom_content'] = 'yes';
if ( ! array_key_exists( $netfunk_page_options['show_page_bottom_content'], $onoff_options ) )
	$netfunk_page_options['show_page_bottom_content'] = 'yes';

if ( ! isset( $netfunk_page_options['show_pages_sidebar'] ) )
	$netfunk_page_options['show_pages_sidebar'] = 'yes';
if ( ! array_key_exists( $netfunk_page_options['show_pages_sidebar'], $onoff_options ) )
	$netfunk_page_options['show_pages_sidebar'] = 'yes';

if ( ! isset( $netfunk_page_options['show_page_primary_sidebar'] ) )
	$netfunk_page_options['show_page_primary_sidebar'] = 'no';
if ( ! array_key_exists( $netfunk_page_options['show_page_primary_sidebar'], $onoff_options ) )
	$netfunk_page_options['show_page_primary_sidebar'] = 'no';

if ( ! isset( $netfunk_page_options['show_page_secondary_sidebar'] ) )
	$netfunk_page_options['show_page_secondary_sidebar'] = 'yes';
if ( ! array_key_exists( $netfunk_page_options['show_page_secondary_sidebar'], $onoff_options ) )
	$netfunk_page_options['show_page_secondary_sidebar'] = 'yes';

?>

<?php get_header(); ?>

<div id="container">

<?php if (isset($netfunk_page_options['page_splash_type']) && $netfunk_page_options['page_splash_type'] != '2') { ?>

	<?php 
    
    if (!isset($_GET['action'])):
    
        echo '<div class="slideshow large-12 show-for-medium-up">';
        netfunktheme_get_pages_splash($netfunk_general_options['show_num_features'],$offset=0,get_the_ID(),$netfunk_general_options['splash_height']); 
        echo '</div>';
    
    endif;
    
    ?>

<?php } ?>

<div id="blackoutTrigger"></div>

<div class="content">

    <div class="row">

        <div class="small-12 columns">
            
            <? 
                // place holder for additional page header 
                do_action('netfunktheme_page_top'); 
            ?>
            
            <?php //netfunktheme_breadcrumbs() ?>
        	
            <?php if ( (isset($netfunk_page_options['show_page_splash']) && $netfunk_page_options['show_page_splash'] == 'no') ) { ?>
            
                <div class="large-9 columns hide-for-small">
                
                    <?php edit_post_link( __( '<i class="fa fa-pencil"></i> &nbsp; Edit This Page', 'netfunktheme' ), '<div class="button secondary round tiny right edit-link" style="margin-top: 10px;">', '</div>' ) ?>
    
                    <h1 class="page-title"><?php the_title(); ?></h1>
                
                </div>
            
            <?php }  ?>
            
            <h3 class="page-title show-for-small"><?php the_title(); ?></h3>

            <div class="large-<?php echo (isset($netfunk_page_options['show_pages_sidebar']) && $netfunk_page_options['show_pages_sidebar'] == 'yes' ? '9' : '12')?> small-12 columns">

                <!--hr /-->
                
                <br />

                <?php the_post(); ?>
                
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="entry-content">

                        <?php 

							/* Posts Page Spash Image display
						
							# 	0 = Splash Img | Hide Thumbnail
							# 	1 = Splash Img + Show Thumbnail 
							# 	2 = No Splash 
						
							*/
						
							if (isset($netfunk_page_options['page_splash_type']) && $netfunk_page_options['page_splash_type'] == 0) {
								// Splash Image 
								// do not display thumbnail image
							} else if (isset($netfunk_page_options['page_splash_type']) && $netfunk_page_options['page_splash_type'] == 1) {
								// Splash Image 
								// show thumbnail 
								if ( has_post_thumbnail() ) { 
								  the_post_thumbnail('thumbnail', array('class' => 'right'));
								}
						
							} else if (isset($netfunk_page_options['page_splash_type']) && $netfunk_page_options['page_splash_type'] == 2) {
								// so splash 
								// no thumbnail
							} else if (isset($netfunk_page_options['page_splash_type']) && $netfunk_page_options['page_splash_type'] == 3) {
								// so splash 
								// show thumbnail
								if ( has_post_thumbnail() ) { 
								  the_post_thumbnail('thumbnail', array('class' => 'right'));
								}
							
							} else if (!isset($netfunk_page_options['page_splash_type'])){
								// option not yet set. falls back to defaut: 'yes'
								// Splash Image 
								// do not show thumbnail
							}
						
						?>	

                        <?php 
						
							$content = get_the_content();
							$content = apply_filters('the_content', $content );
						
						?>
                        
                        <?php echo $content; ?>
        
                        <br class="clear" />
                        
                        <?php wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'netfunktheme' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) ); ?>

                    </div>
                
                </div>
                
                <?php 
					
					if (isset($netfunk_page_options['show_page_author']) && $netfunk_page_options['show_page_author'] == 'yes') {
		
						do_action( 'netfunktheme_about_the_author');
					
					} 
				
				?>


                <br class="clear" />
                
                <?php if (isset($netfunk_page_options['show_page_comments']) && $netfunk_page_options['show_page_comments'] == 'yes') {
                    
                        comments_template( '', true ); 
                    
                    }
				
				?>


                <?php if (isset($netfunk_page_options['show_page_bottom_content']) && $netfunk_page_options['show_page_bottom_content'] == 'yes') { ?>

                    <?php if (!isset($_GET['action'])){ ?>
                    
                        <!-- Page Bottom Content -->
                    
                        <?php if ( is_active_sidebar( 'home-bottom-widget-area' ) ) : ?>

                            <?php if ( ! dynamic_sidebar( 'home-bottom-widget-area' ) ) : ?>
                            
                                <h4> You need to add some widgets... </h4>
                            
                            <?php endif; // end primary widget area ?>
                            
                            <br class="clear" />
 
                        <?php else: ?>
            
                            <h2 class="widget-title">Page bottom Content Area</h2>
                            <h4> You can add Widgets to the bottom of pages or disable this area completely.</h4>
                            <a href="<?php echo home_url().'/wp-admin/widgets.php' ?>">Add Widgets</a> | <a href="<?php echo home_url() .'/wp-admin/admin.php?page=theme_pages' ?>">Modify Content Page Settings</a>
                       
                        <?php endif; ?>
                    
                    <?php } ?>
                
                <?php } ?>

                <? 
					// place holder for additional action page footer information 
					do_action('netfunktheme_page_bottom'); 
                ?>
    
            </div>
        
            <?php if (isset($netfunk_page_options['show_pages_sidebar']) && $netfunk_page_options['show_pages_sidebar'] == 'yes'){
                
                get_sidebar(); 
            
            } ?>
    
        </div>
        
    </div><!--row-->

</div><!--content-->

</div><!--container-->

<?php get_footer(); ?>
