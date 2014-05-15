<?php
/*
 theme default index
*/

// netfunktheme default options


if ( ! isset( $netfunk_general_options['splash_height'] ) )
	$netfunk_general_options['splash_height'] = '400';
	

if ( ! isset( $theme_options['show_welcome_message'] ) )
	$theme_options['show_welcome_message'] = 'yes';
if ( ! array_key_exists( $theme_options['show_welcome_message'], $onoff_options ) )
	$theme_options['show_welcome_message'] = 'yes';

if ( ! isset( $theme_options['show_featured_content'] ) )
	$theme_options['show_featured_content'] = 'yes';
if ( ! array_key_exists( $theme_options['show_welcome_message'], $onoff_options ) )
	$theme_options['show_featured_content'] = 'yes';
//show_posts_on_home
if ( ! isset( $theme_options['show_posts_on_home'] ) )
	$theme_options['show_posts_on_home'] = 'yes';
if ( ! array_key_exists( $theme_options['show_posts_on_home'], $onoff_options ) )
	$theme_options['show_posts_on_home'] = 'yes';

if ( ! isset( $theme_options['show_front_page_bottom_content'] ) )
	$theme_options['show_front_page_bottom_content'] = 'yes';
if ( ! array_key_exists( $theme_options['show_front_page_bottom_content'], $onoff_options ) )
	$theme_options['show_front_page_bottom_content'] = 'yes';

if ( ! isset( $theme_options['show_front_page_sidebar'] ) )
	$theme_options['show_front_page_sidebar'] = 'yes';
if ( ! array_key_exists( $theme_options['show_front_page_sidebar'], $onoff_options ) )
	$theme_options['show_front_page_sidebar'] = 'yes';

if ( ! isset( $theme_options['show_front_page_primary_sidebar'] ) )
	$theme_options['show_front_page_primary_sidebar'] = 'yes';
if ( ! array_key_exists( $theme_options['show_front_page_primary_sidebar'], $onoff_options ) )
	$theme_options['show_front_page_primary_sidebar'] = 'yes';

if ( ! isset( $theme_options['show_front_page_secondary_sidebar'] ) )
	$theme_options['show_front_page_secondary_sidebar'] = 'no';
if ( ! array_key_exists( $theme_options['show_front_page_secondary_sidebar'], $onoff_options ) )
	$theme_options['show_front_page_secondary_sidebar'] = 'no';

if ( ! isset( $theme_options['welcome_title'] ) )
$theme_options['welcome_title'] = '<span style="color: #30b0c4">Netfunk</span><i>Theme...</i>';

if ( ! isset( $theme_options['welcome_text'] ) )
$theme_options['welcome_text'] = 'Responsive, Foundation 5, HTML5 "Smart" theme by NetfunkDesign. Provides custom widgets for the front page and other dynamic content areas to offer a customizable layout suitable for both business and multimedia websites a like. ';

if ( ! isset( $theme_options['more_about_title'] ) )
$theme_options['more_about_title'] = 'More About NetfunkTheme';

if ( ! isset( $theme_options['more_about_uri'] ) )
$theme_options['more_about_uri'] = '/about/';


?>

<?php get_header(); ?>

<div id="container">

<?php 

if (!isset($_GET['action'])):
	$category_id = (isset($category_id) ? $category_id : 0);
	netfunktheme_get_large_featured($netfunk_general_options['show_num_features'],$offset=0,$category_id,$netfunk_general_options['splash_height']); 

endif;

?>

<div id="blackoutTrigger"></div>

<div class="content">

    <div class="row">

        <?php if ( isset($theme_options['show_welcome_message']) && $theme_options['show_welcome_message'] == 'yes' ){ ?>

            <div class="small-12 large-<?php echo (isset($theme_options['show_featured_content']) && $theme_options['show_featured_content'] == 'yes' ? '4' : '12') ?> left welcome-message">

                <div class="small-12 columns">
                    <h1><?php echo ( isset($theme_options['welcome_title']) ? $theme_options['welcome_title'] : '' ) ?></h1>
                    <p class="welcome-text">
                        <?php echo ( isset($theme_options['welcome_text']) ? $theme_options['welcome_text'] : '' ) ?>
                    </p>
                </div>

                <?php if (isset($theme_options['more_about_title']) && isset($theme_options['more_about_uri'])){ ?>
                    <div class="small-12 columns">
                        <a href="<?php echo home_url() . $theme_options['more_about_uri'] ?>" class="button success medium radius"><?php echo (isset($theme_options['more_about_title']) ? $theme_options['more_about_title'] : ''); ?></a>
                    </div>
				<?php } ?>

				<?php if (isset($theme_options['show_social_icons']) && isset($theme_options['show_social_icons'])){ ?>
                    <div class="small-12 columns follow-us-block">
                        <div class="follow-text"><strong>Keep up with us:</strong></div>
                        <br />
                        <a href="http://soundcloud.com/groups/breaks-culture" class="webicon large soundcloud" target="_blank" title="Listen to BreaksCulture group on Soundcloud">Listen BreaksCulture group on Soundcloud</a>
                        <a href="https://twitter.com/breaks_culture" class="webicon large twitter" target="_blank" title="Follow BreaksCulture on Twitter">Follow BreaksCulture on Twitter</a>
                        <a href="http://www.facebook.com/netfunktheme" class="webicon large facebook" target="_blank" title="Like BreaksCulture on Facebook">Like BreaksCulture on Facebook</a>
                        <a href="/feed/" class="webicon large rss" target="_blank" title="netfunkdesign.com RSS">netfunkdesign.com RSS</a>
                    </div>
                <?php } ?>

            </div><!-- welcome message -->

        <?php } ?>

        <?php if ( isset($theme_options['show_featured_content']) && $theme_options['show_featured_content'] == 'yes'){ ?>

            <div class="small-12 large-<?php echo (isset($theme_options['show_welcome_message']) && $theme_options['show_welcome_message'] == 'yes' ? '8' : '12') ?> right featured-content">
                <div class="small-12" data-equalizer>
                <?php if ( is_active_sidebar( 'home-primary-widget-area' ) ) : ?>
                    <?php if ( ! dynamic_sidebar( 'home-primary-widget-area' ) ) : ?>
                        <h4> You need to add some widgets... </h4>
                     <?php endif; // end primary widget area ?>
                    <br class="clear" />
                <?php else: ?>
                	<div class="small-12 columns">
						<h2 class="widget-title">Featured Content Area</h2>
                    	<h4> You may want to add one of our featured content widgets here</h4> 
                    	<p class="first-text">You might also wish to remove the area all togeather. This area and the welcome message  share the content width. Removing one or the other makes the other one take over the full width of the area. </p>
                    	<a href="<?php echo home_url().'/wp-admin/widgets.php' ?>">Add Widgets</a> | <a href="<?php echo home_url() .'/wp-admin/admin.php?page=theme_frontpage#featured-contet' ?>">Modify Settings</a>
                    </div>
                    <div class="small-12 columns">
                    	<br class="clear"/>
                        <br />
                        <a href="#docs" class="button radius">NetfunkTheme Docs</a>
                    </div>
                    <br class="clear" />
				<?php endif; ?>
                </div>
            </div><!-- featured content -->

        <?php } ?>

    </div>
</div><!-- content -->

<!-- Page Bottom Content -->

<div class="home-bottom-content">

	<div class="row">

		<div class="large-<?php echo (isset($theme_options['show_front_page_sidebar']) && $theme_options['show_front_page_sidebar'] == 'yes' ? '9' : '12')?> small-12 columns">
        
		<?php if (isset($theme_options['show_posts_on_home']) && $theme_options['show_posts_on_home'] == 'yes'){ ?>

            <h2 class="widget-title">Recent Posts</h2>
            <div class="small-12">

            <?php if(!is_front_page()) { ?>
            <h1><?php if ( is_category() ) {
                    single_cat_title();
                } elseif (is_tag() ) {
                    echo (__( 'Archives for ', 'netfunktheme' )); single_tag_title();
                } elseif (is_archive() ) {
                    echo (__( 'Archives for ', 'netfunktheme' )); single_month_title();
                } else {
                    wp_title(' | ', 'after', true);
            } ?></h1>
            <?php } ?>
        
            <?php get_template_part( 'nav', 'above' ); ?>
          
            <?php while ( have_posts() ) : the_post() ?>
                <?php get_template_part( 'entry' ); ?>
                <?php comments_template(); ?>
            <?php endwhile; ?>
        
            <?php get_template_part( 'nav', 'below' ); ?>
            
            </div>
            <hr />

    	<?php } ?>

		<?php if (isset($theme_options['show_front_page_bottom_content']) && $theme_options['show_front_page_bottom_content'] == 'yes') { ?>

            <?php if ( is_active_sidebar( 'home-bottom-widget-area' ) ) : ?>
                <?php if ( ! dynamic_sidebar( 'home-bottom-widget-area' ) ) : ?>
                <h4> You need to add some widgets... </h4>
                <?php endif; // end below content widget area ?>
                <br class="clear" />
            <?php else: ?>
                <h2 class="widget-title">Page bottom Content Area</h2>
                <h4> You can add Widgets to the bottom of pages or disable this area completely.</h4>
                <a href="<?php echo home_url().'/wp-admin/widgets.php' ?>">Add Widgets</a> | <a href="<?php echo home_url() .'/wp-admin/admin.php?page=theme_frontpage#page-bottom' ?>">Modify Front Page Settings</a>
            	<br class="clear"/>
                <br />
                <hr />
                <h2 class="widget-title">Recommended Plugins</h2>
                <p> We have worked hard to make NetfunkTheme compatible with a lot of popular plugins. Here are a few plugins we highly recommended, to help you manage your content better.</p>
                <div class="small-12">
                	<h4 style="color: #BBB">A few suggestions</h4>
                    <br />
                    <ul class="large-5 columns left">
                    	<li><i class="fa fa-plus-circle"></i> &nbsp; Jetpack</li>
                        <li><i class="fa fa-plus-circle"></i> &nbsp; Dynamic Widgets</li>
                        <li><i class="fa fa-plus-circle"></i> &nbsp; Link Manager</li>
                    </ul>
                    <ul class="large-5 columns left">
                    	<li><i class="fa fa-plus-circle"></i> &nbsp; Contact Form 7</li>
                        <li><i class="fa fa-plus-circle"></i> &nbsp; Advanced Most Recent Posts Mod</li>
                        <li><i class="fa fa-plus-circle"></i> &nbsp; Soundcloud Connect by Netfunk</li>
                    </ul>
                    <br class="clear" />
                </div>
                <br />
                <a href="<?php echo home_url().'/wp-admin/widgets.php' ?>">Go To Plugins Settings</a> 
                <br class="clear"/>
                <br />
                <hr />
                <div class="small-12 columns">
                	<div class="panel radius">To get ride of this conent add some widgets or disable Page Bottom content in <a href="<?php echo home_url() .'/wp-admin/admin.php?page=theme_frontpage#page-bottom' ?>">Theme settings</a></div>
				</div>
			<?php endif; ?>

        <?php } ?>

		</div>

        <?php if ( isset($theme_options['show_front_page_sidebar']) && $theme_options['show_front_page_sidebar'] == 'yes' ){
        
		if ( (isset($theme_options['show_front_page_primary_sidebar']) && $theme_options['show_front_page_primary_sidebar'] == 'yes') or (isset($theme_options['show_front_page_secondary_sidebar']) && $theme_options['show_front_page_secondary_sidebar'] == 'yes') )
		
			get_sidebar(); 
		
		} ?>
        
        <!--pre>
        <?php print_r ($theme_options) /* debug line */ ?>
        </pre-->

    </div><!-- row -->
    
</div><!-- below content -->

</div> <!-- container -->


<?php get_footer(); ?>
