<?php get_header(); ?>

<div id="container" class="row">

<div id="blackoutTrigger"></div>
    
<!--content-->
    
<div class="row content">
        
	<?php if ( is_day() ) : ?>
       
    <h1 class="page-title"><?php printf( __( 'Daily Archives: %s', 'netfunktheme' ), '<span>' . get_the_time(get_option('date_format')) . '</span>' ) ?></h1>
   
    <?php elseif ( is_month() ) : ?>
   
    <h1 class="page-title"><?php printf( __( 'Monthly Archives: %s', 'netfunktheme' ), '<span>' . get_the_time('F Y') . '</span>' ) ?></h1>
   
    <?php elseif ( is_year() ) : ?>
   
    <h1 class="page-title"><?php printf( __( 'Yearly Archives: %s', 'netfunktheme' ), '<span>' . get_the_time('Y') . '</span>' ) ?></h1>
   
    <?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
   
    <h1 class="page-title"><?php _e('netfunkdesign.com Archives', 'netfunktheme' ); ?></h1>

    <?php endif; ?>

    <?php netfunktheme_breadcrumbs() ?>

    <div class="large-9 columns">

        <?php the_post(); ?>

        <?php rewind_posts(); ?>
       
        <?php get_template_part( 'template/nav', 'above' ); ?>
       
        <?php while ( have_posts() ) : the_post(); ?>
       
        <?php  get_template_part( 'template/entry-list', get_post_format() ); ?>
       
        <?php endwhile; ?>
       
        <?php get_template_part( 'template/nav', 'below' ); ?>
    
    </div>

<?php get_sidebar(); ?>

</div><!--content-->

</div>

<?php get_footer(); ?>
