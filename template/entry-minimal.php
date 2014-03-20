
<div class="large-2 small-12 left home-block" style="margin-bottom: 20px;">

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php 
    
		global $authordata;
	
        echo '<a href="';
        
		the_permalink();
        
		echo '" title="';
        
		printf( __('%s', 'netfunktheme'), the_title_attribute('echo=0') );
        
		echo '" rel="bookmark" style="">';
		
		$image = netfunktheme_catch_post_image();
		
		?>

        <div class="home-block-img" style="background: url('<?php echo $image ?>')"></div>

		<div class="home-block-title">
        
		<?php the_title(); ?>
        
		</div>
		
        <div>
        
        <strong>by:</strong> 
        
		<?php the_author(); ?>
        
        <br />

		<strong>On:</strong> 
        
        <?php the_time( get_option( 'date_format' ) ); ?>
		
        </div>
        
        <button class="button success tiny radius right">Read More</button>
        
		<?php echo '</a>'; ?>

    </div>

</div> 