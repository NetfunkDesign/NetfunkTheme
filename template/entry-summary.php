<?php

echo '<div class="entry-title">';

	echo '<h5>';

	echo '<a href="';
	
	the_permalink();
	
	echo '" rel="bookmark">';

	the_title();
	
	echo '</a>';
	
	echo '</h5>';
	
	echo '</div>';

	get_template_part( 'template/entry', 'meta' );

?>

<div class="entry-summary">

<?php the_excerpt( sprintf(__( 'continue reading %s', 'netfunktheme' ), '<span class="meta-nav">&rarr;</span>' )  ); ?>

<?php if(is_search()) {

wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'netfunktheme' ) . '&after=</div>');

}

?>

</div> 