
<?php get_header(); ?>

<!--container-->

<div id="container" class="row">

<div id="blackoutTrigger"></div>

	<div style="padding: 20px;"></div>

	<div class="large-12">

        <div class="row content"><!--container-->
    
    		<div class="content">
    
    		<?php netfunktheme_breadcrumbs() ?>
    
            <div class="large-9 columns left">

			<?php the_post(); ?>
            
            <h1 class="page-title"><?php _e( 'Tag Archives:', 'netfunktheme' ) ?> <span><?php single_tag_title() ?></span></h1>
            
            <?php rewind_posts(); ?>
            
            <?php get_template_part( 'template/nav', 'above' ); ?>
            
            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part( 'entry' ); ?>
            
            <?php endwhile; ?>
            
            <?php get_template_part( 'template/nav', 'below' ); ?>
            
            </div>
            
        	<?php get_sidebar(); ?>
            
            </div>
            
        </div><!--container-->
        
    </div>

</div><!--container-->

<?php get_footer(); ?>