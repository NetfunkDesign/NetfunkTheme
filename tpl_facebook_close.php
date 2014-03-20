<?
/**
 * Template Name: Facebook API Disconnect
 * Descripion: FloridaBreaks.org / Facebook API Connection Confirmation
 */

	global $current_user, $wp_roles;
	get_currentuserinfo();

	delete_user_meta($current_user->id, "flb_facebook_token");
	delete_user_meta($current_user->id, "flb_facebook_secret");

	// calling the header.php
	get_header();

?>

	<div id="main" class="clearfix">

	<div id="container" class="clearfix">
	
    <div id="content" class="section">

	<?php 
             
	// action hook for placing content above #container
	arras_above_content();
	
	?>
    
    <div id="post-<?php the_ID(); ?>" <?php arras_single_post_class() ?>>
    
    <?
	
	// creating the post header
	arras_postheader();
	
	?>

<?php

		echo "<h1>Connection Status:</h1>";
		
		echo "<p><img src=\"/wp-content/plugins/facebook-api/images/facebook-icon.png\" style=\"float: right; margin: -50px 50px 100px 10px;\">";
		
		echo "<div style=\"padding: 0px 0px 60px; font-size: 11px;\">";
		
		echo "Connection is closed.";
		
		echo "</div>";
		
		if (class_exists('flb_facebook_api_integration')){ 
				
			$flbFacebookClass = new flb_facebook_api_integration();
			$facebook = $flbFacebookClass->flb_facebook_connection();

			$params = array(
			  'scope' => 'read_stream, friends_likes, user_website, user_status, user_photos',
			  'redirect_uri' => 'http://www.netfunkdesign.com/facebook-auth',
			  'display' => 'page'
			);
			
			$flb_facebook_connect = $facebook->getLoginUrl($params);
			echo '<div style="padding: 4px; font-wight: 600;">Did you logout by mistake?</div><a href="'.$flb_facebook_connect.'" style="padding: 0px; margin: 0px 0px 100px 0px; border: none;">'
			.'<img src="/wp-content/plugins/facebook-api/images/btn-facebook-connect-large.gif" class="facebook_connect" border="0"/></a>';

		}
		
		echo '<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 40px -10px 10px; clear: both;"></div>';
		
		echo "<div style=\"padding: 20px 20px; font-size: 11px;\"><strong><a href=\"/edit-profile\">Return to your account settings</a></strong></div>";
		
		echo "</p>";

?>

	</div><!-- #POST -->

<?php  arras_below_content(); ?>

	</div><!-- #content -->
        
<?php get_sidebar(); ?>

<?php get_footer(); ?>
	