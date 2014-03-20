<?
/**
 * Template Name: Facebook API Confirm
 * Descripion: FloridaBreaks.org / Facebook API Connection Confirmation
 */

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
    
<span typeof="v:Breadcrumb"><a href="edit-profile" rel="v:url" property="v:title">Member Settings</a></span> &nbsp; <span typeof="v:Breadcrumb"><a href="/facebook-settings" rel="v:url" property="v:title">Facebook - Settings</a></span>  &nbsp; <span typeof="v:Breadcrumb" class="current">Authentication</span>

</div>

<div class="large-9 columns">
	
<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>

<div class="entry-content">

<?php

if (class_exists('flb_facebook_api_integration')) :

	try {

		$flbFacebookClass = new flb_facebook_api_integration();
		$facebook = $flbFacebookClass->flb_facebook_connection();

		// Get User ID
		$user = $facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if ($user) {

		  try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		  }
		  
		  echo "<h1>Authentication Successful</h1>";
		
			echo "<p><img src=\"/wp-content/plugins/facebook-api/images/facebook-icon.png\" style=\"float: right; margin: -50px 50px 20px 10px;\">";
			
			echo "<p style=\"padding: 20px 0px 0px; font-size: 12px;\">You are now fully connected between your facebook account and floridabreaks.org.</p> ";

			echo "<div style=\"padding: 0px 0px 40px; font-size: 11px;\">";
			
			echo "<strong>Account Name:</strong> " . $user_profile [ 'name' ] . "<br /><br />";
			
			//echo "<strong>Email Address:</strong> " . $user_profile [ 'email' ] . "<br /><br />";
			
			echo "<strong>Facebook URL:</strong> <a href=\"" . $user_profile [ 'link' ] . "\" target=\"_blank\">" . $user_profile [ 'link' ] . "</a><br />";
	
			echo "</div>";

			echo'<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 20px -10px 20px; clear: both;"></div>';

			echo "<p style=\"padding: 0px 0px 0px; font-size: 12px;\"><strong>Facebook Integration Settings:</strong></p> ";

			echo "<div style=\"width: 200px; padding: 10px 0px 0px 20px; float: left; text-align: left; font-size: 11px;\">";

			echo "<strong><a href=\"/facebook-settings\">Facebook Settings</a></strong>";

			echo "</div>";

			echo "<div style=\" margin: -20px 50px 0px 0px; float: right; text-align: right;\">";

				$params = array('next' => 'http://netfunkdesign.com/facebook-close');
				$flb_facebook_disconnect = $facebook->getLogoutUrl($params); 
				echo '<div style="padding: 4px; font-wight: 600;">Did you connect here by mistake?</div><a href="'.$flb_facebook_disconnect.'" style="padding: 0px; margin: 0px 0px 100px 0px; border: none; border: 0px;">'
				.'<img src="/wp-content/plugins/facebook-api/images/btn-facebook-disconnect-large.gif" class="facebook_disconnect" border="0"/></a>';
			
			echo "</div>";
			
			echo '<div class="clearfix"></div>';
			
			echo '<div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 40px -10px 10px; clear: both;"></div>';
			
			echo "<div style=\"padding: 20px 20px; font-size: 11px; text-align: center\"><strong><a href=\"/edit-profile\">Return to your account settings</a></strong></div>";
			
			echo "</p>";
			
			//print_r ( $user_profile );		/* DEBUG LINE */
		
		}
		
		else { 
			
			echo '<meta http-equiv="refresh" content="2;url=/facebook-confirm/">'; 
			
			echo "<div style=\"padding: 20px 0px; font-size: 12px;\">";
			
			echo 'One moment please....'; 
			
			echo "</div>";
			
		}

	} catch (Flb_Facebook_Connection_Invalid_Http_Response_Code_Exception $e) {

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
	