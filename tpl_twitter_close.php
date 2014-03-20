<?
/**
 * Template Name: Twitter API Disconnect
 * Descripion: FloridaBreaks.org / Twitter API Disconnection Confirmation
 */

	global $current_user, $wp_roles;
	get_currentuserinfo();

	delete_user_meta($current_user->id, "flb_twitter_token");
	delete_user_meta($current_user->id, "flb_twitter_secret");
	delete_user_meta($current_user->id, "flb_twitter_authstate");

	// calling the header.php
	get_header();

?>

<div id="container" class="row">

<br />

<br />

<div id="blackoutTrigger"></div>

<div class="content row">

<div class="content row">

<h2><?php the_title(); ?></h2>

<div class="breadcrumbs">
    
<span typeof="v:Breadcrumb"><a href="edit-profile" rel="v:url" property="v:title">Member Settings</a></span>  &nbsp; <span typeof="v:Breadcrumb" class="current">Twitter - Settings</span>

</div>

<div class="large-9 columns">
	
<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>

<div class="entry-content">

<?php

		echo "<h1>Connection Status:</h1>";
		
		echo "<p><img src=\"/wp-content/plugins/twitter-api/images/twitter-icon.png\" style=\"float: right; margin: -50px 50px 100px 10px;\">";
		
		echo "<div style=\"padding: 0px 0px 60px; font-size: 11px;\">";
		
		echo "Connection is closed.";
		
		echo "</div>";
		
		if (class_exists('TwitterApp')){ 
				
			if (!get_user_meta($current_user->id,'flb_twitter_token'))
				
				echo '<div style="padding: 50px 225px 0px 0px;">';
				
				do_action('twitter_connect_button');
				
				echo '<div style="padding: 4px; font-wight: 600; float: right;">Did you logout by mistake?</div>';
				
				echo "</div>";
		
		}
		
		echo '<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 40px -10px 10px; clear: both;"></div>';
		
		echo "<div style=\"padding: 20px 20px; font-size: 11px; text-align: center\"><strong><a href=\"/edit-profile\">Return to your account settings</a></strong></div>";
		
		echo "</p>";

?>

</div><!-- entry content -->

</div><!-- post -->

</div><!-- column -->

<? get_sidebar(); ?>

</div><!-- content -->
    
</div><!-- content -->

</div><!-- container -->

<? get_footer(); ?>
	