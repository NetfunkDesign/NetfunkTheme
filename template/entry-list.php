
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ){ ?>

        <div class="large-2 column left">
    
        <?php 
			
			echo '<a href="';
			
			the_permalink();
			
			
			echo '" title="';
            
            printf( __('Read %s', 'netfunktheme'), the_title_attribute('echo=0') );
            
            echo '" rel="bookmark">';
			
			if ( has_post_thumbnail() ) {
    
                the_post_thumbnail('medium');
                
            } 
			
			echo '</a>';
		?>
        
        </div>
        
        <?php } ?>
        
        <div class="large-<?php echo ( has_post_thumbnail() ? '10' : '12' ) ?> column <?php echo ( has_post_thumbnail() ? 'right' : '' ) ?>">

            <h5 class="entry-title paneltitle">
    
            <?php 
    
                echo '<a href="';
                
                the_permalink();
                
                echo '" rel="bookmark">';
    
                the_title();
                
                echo '</a>';
                
                ?>
                
             </h5>
			
			<?php get_template_part( 'template/entry', 'meta' );
			
			$content = get_the_content(); 
			
			?>
			
			<p>
			
            <?php
            
			echo wp_trim_words(netfunktheme_content_strip_objects($content),30, '... ');
            
			echo '<br /><br />';
			
			echo '<a href="';
		
			the_permalink();
			
			echo '" class="button success tiny radius right">';
			
			echo 'Read More';
			
			echo '</a>';

        	?>
        
         </p>

        </div>
        
        <br clear="all" />

    </div><!-- post -->
	
    <hr />
