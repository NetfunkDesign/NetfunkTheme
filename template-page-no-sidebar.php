<?php

/*
Template Name: Page (No Sidebar)
*/

?>

<?php get_header(); ?>

<div id="subhead_container" class="page">
    
    <div id="container" class="row">
    
		<div class="large-12 columns">

			<?php the_post(); ?>
            
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-content">
            
            <?php 
            
            if ( has_post_thumbnail() ) {
            
            the_post_thumbnail();
            
            } 
            
            ?>
            
            <?php the_content(); ?>
            
            <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'netfunktheme' ) . '&after=</div>') ?>

            </div>
            
            </div>

        </div>

	</div> <!--end container-->

</div> <!--end container outside-->

<?php get_footer(); ?>
