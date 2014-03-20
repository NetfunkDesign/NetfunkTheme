<?
/**
 * Template Name: Twitter API Confirm
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

<div class="large-9 columns">
	
<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
    
<h1 class="entry-title"><?php the_title(); ?></h1>
    
<div class="entry-content">

<?php

if (class_exists('flb_twitter_api_integration')) :
	
	//function confirm_connect($code){ global $soundcloud;

	try {
		
		// our tmhOAuth settings
		$config = array(
			'consumer_key'      => CONSUMER_KEY,
			'consumer_secret'   => CONSUMER_SECRET
		);
		
		 // create a new TwitterAvatars object
    	$twitter = new flb_twitter_api_integration(new tmhOAuth($config));											/* DEBUG LINE */
		
		if (!get_user_meta($current_user->id,'flb_twitter_token')){

			//$accessToken = $flb_twitter->flb_twitter_token($_GET['code']);
			
			/* Add Twitter Accesss Token to User Meta Data */
			add_user_meta($current_user->id, 	"flb_twitter_token", 	$params['oauth_token'], true);				/* api access token */
			add_user_meta($current_user->id, 	"flb_twitter_secret", 	$params['oauth_token_secret'], true);		/* api secret token */
			//add_user_meta($current_user->id, 	"flb_twitter_user", 	$params['oauth_token'], true);
			
		}

		// check our authentication status
    	if($twitter->isAuthed()) {

			echo "<h1>Authentication Successful</h1>";
		
    	}
   		 // did the user request authorization?
   		elseif(isset($_POST['auth'])) {

        	// start authentication process
        	$twitter->auth();
    
		}
		
		echo "<h1>Authentication Successful</h1>";
		
		echo "<p><img src=\"/wp-content/plugins/twitter-api/images/twitter-icon.png\" style=\"float: right; margin: -50px 50px 100px 10px;\">";
		
		echo "<p style=\"padding: 20px 0px 0px; font-size: 12px;\">You are now fully connected between your Twitter account and netfunkdesign.com.</p> ";

		echo "<div style=\"padding: 0px 0px 40px; font-size: 11px;\">";
			
			//echo "<strong>Account Name:</strong> " . $twitter_user->{'name'} . "<br /><br />";
		
			//echo "<strong>Email Address:</strong> " . $me [ 'email' ] . "<br /><br />";
		
			//echo "<strong>Twitter URL:</strong> <a href=\"" . $twitter_user->{'url'} . "\" target=\"_blank\">" . $twitter_user->{'url'} . "</a><br />";

		echo "</div>";
		
		echo '<div class="clearfix"></div>';
		
		echo'<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 40px -10px 10px; clear: both;"></div>';
		
		echo "<div style=\"padding: 20px 20px; font-size: 11px; text-align: center;\"><strong><a href=\"/edit-profile\">Return to your account settings</a></strong></div>";
		
		echo "</p>";
		
		//print_r($flb_twitter);				/* DEBUG LINE */
    
	} catch(Exception $e) {
		// catch any errors that may occur
   	 	$error = $e;
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
	