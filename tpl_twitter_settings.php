<?
/**
 * Template Name: Twitter API Settings
 *
 */
 
// netfunkdesign.com sOUNDcLOUD API cONNECTION

	global $current_user, $wp_roles;
	get_currentuserinfo();

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

if (class_exists('flb_twitter_api_integration')) :
	
	//function confirm_connect($code){ global $soundcloud;

	try {
		
		/* Initialize Twitter Connect with AccessToken from User Meta */
		$flb_twitter = $flbTwitterClass->flb_twitter_connection();
		parse_str($flb_twitter['body'], $params);
		
		/* if no Twitter Token in User Meta */
		if (!get_user_meta($current_user->id,'flb_twitter_token')){

			//$accessToken = $flb_twitter->flb_twitter_token($_GET['code']);
			
			/* Add Twitter Accesss Token to User Meta Data */
			add_user_meta($current_user->id, 	"flb_twitter_token", 	$params['oauth_token'], true);				/* api access token */
			add_user_meta($current_user->id, 	"flb_twitter_secret", 	$params['oauth_token_secret'], true);		/* api secret token */
		
		}
		
		//$flb_twitter->flb_twitter_set_token(get_user_meta($current_user->id,'flb_twitter_token',true));

		echo "<h1>Settings</h1>";
		
		echo "<p><img src=\"/wp-content/plugins/twitter-api/images/twitter-icon.png\" style=\"float: right; margin: -50px 50px 100px 10px;\">";

		echo "<div style=\"width: 200px; padding: 10px 0px 0px 20px; float: left; text-align: left; font-size: 11px;\">";

		echo "<strong><a href=\"/twitter-settings\">Twitter Settings</a></strong>";

		echo "</div>";
		
		echo '<div class="clearfix"></div>';
			
		echo '<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 40px -10px 10px; clear: both;"></div>';
			
		echo "<div style=\"padding: 20px 20px; font-size: 11px; text-align: center\"><strong><a href=\"/edit-profile\">Return to your account settings</a></strong></div>";
			
		
		echo "</p>";
		
		//echo $flb_twitter['body'];				/* DEBUG LINE */
		
	} catch (Flb_Twitter_Connection_Invalid_Http_Response_Code_Exception $e) {

		exit($e->getMessage());

	}
	
endif;

?>

</div><!-- entry content -->

</div><!-- post -->

</div><!-- column -->

<? get_sidebar(); ?>

</div><!-- content -->
    
</div><!-- content -->

</div><!-- container -->

<? get_footer(); ?>
	