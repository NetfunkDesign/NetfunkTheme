<?
/**
 * Template Name: Facebook API Auth
 * Description: FloridaBreaks.org / Facebook API Authentication
 */ 

	global $current_user, $wp_roles;
	get_currentuserinfo();

if (class_exists('flb_facebook_api_integration')) :

	try {

		$flbFacebookClass = new flb_facebook_api_integration();
		$facebook = $flbFacebookClass->flb_facebook_connection();

		// Get the current access token
		$token = $facebook->getAccessToken();
		$secret = $facebook->getApiSecret();

		/* if no Twitter Token in User Meta */
		if (!get_user_meta($current_user->id,'flb_facebook_token')){
			
			/* Add Twitter Accesss Token to User Meta Data */
			add_user_meta($current_user->id, 	"flb_facebook_token", 	$token, true);			/* api access token */
			add_user_meta($current_user->id, 	"flb_facebook_secret", 	$secret, true);			/* api secret key */
			
			echo '<meta http-equiv="refresh" content="1;url=/facebook-confirm/">';

		}	

	} catch (Flb_Twitter_Connection_Invalid_Http_Response_Code_Exception $e) {

		exit($e->getMessage());

	}

endif;
	