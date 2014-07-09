    
    </div><!--wrapper end-->
    
<!--footer-->

<footer>

    <div class="row">

		 <div id="footer-logo" class="small-12 columns">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/logo1.png" alt="" border="0"/>
            
            </a>

        </div>

        <div id="footer-nav">
        
            <div id="nav-inner" class="small-12 columns show-for-small">
            
            <?php $is_nav = '' ; ?>
                        
            <?php $is_nav = wp_nav_menu( array( 'container_class' => 'footer-nav', 'theme_location' => 'footer' , 'menu_id' => 'footer-nav', 'fallback_cb' => '', 'echo' => false ) ); ?>
            
            <?php  if ($is_nav == '') { ?>
            
            <ul id="footer-nav">
            
            <!-- li <?php //if (is_front_page()) { echo " class=\"current_page_item\""; } ?>><a href="<?php //echo esc_url(home_url()); ?>" title="Home">Home</a></li -->				
            
            <?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
            
            </ul>
            <?php 
            
            } else 
            echo($is_nav); 
            
            ?>
            
            </div><!-- #nav-inner -->
        
        </div><!-- #footer-nav -->

        <div class="small-12 columns hide-for-small">

            <div id="footer-bar1" class="small-12 columns">

                <?php get_sidebar( 'footer' ) ?>

            </div><!--footer 1 end-->

        </div><!--footer widget end-->

        <!--div id="footer_info" class="text-center">

            <div class="icon-group">

                <a href="http://soundcloud.com/groups/breaks-culture" class="webicon soundcloud small" target="_blank" title="Lsten to BreaksCulture group on Soundcloud">Listen BreaksCulture group on Soundcloud</a>

                <a href="https://twitter.com/breaks_culture" class="webicon twitter small" target="_blank" title="Follow BreaksCulture on Twitter">Follow BreaksCulture on Twitter</a>

                <a href="http://www.facebook.com/netfunktheme" class="webicon facebook small" target="_blank" title="Like BreaksCulture on Facebook">Like BreaksCulture on Facebook</a>

                <a href="/feed/" class="webicon rss small" target="_blank" title="netfunkdesign.com RSS">netfunkdesign.com RSS</a>

         </div-->
		
        <br class="clear"/>
       
        <br />

        <div class="small-12 columns copyright text-center">
            
        	<p><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'netfunktheme' ), '&copy; 2008-', date('Y'), esc_html(get_bloginfo('name')) ); ?></p>
       
        </div>

      </div>
    
    </div>

</footer><!--end footer-->

<?php wp_footer(); ?>

</body>

</html>