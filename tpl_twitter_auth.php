<?
/**
 * Template Name: Twitter API Auth
 *
 */
 
// netfunkdesign.com sOUNDcLOUD API cONNECTION

	get_currentuserinfo();
	global $current_user, $wp_roles;


if (class_exists('TwitterApp')) :
	
	if ($_REQUEST['action'] == "delete_token"){

			delete_user_meta($current_user->id, "flb_twitter_token");
			delete_user_meta($current_user->id, "flb_twitter_secret");
			delete_user_meta($current_user->id, "flb_twitter_authstate");
			
			setcookie('access_token', '', 0);
			setcookie('access_token_secret', '', 0);
			
			header ("location: /twitter-close");
	
	} else {

		try {
			
			/* Initialize Twitter Connect with AccessToken from User Meta */
			$response = $flbTwitterClass->flb_twitter_connection();
			parse_str($response['body'], $params);
	
			/*
			echo "<h1>Authentication Successful</h1>";
			echo "<p><img src=\"/wp-content/plugins/twitter-api/images/twitter-icon.png\" style=\"float: right; margin-right: 100px;\">";
			echo "Athentication:" 	. 	$params['oauth_callback_confirmed'] 	. '<br/>';
			echo "Auth Token:" 		. 	$params['oauth_token'] 					. '<br/>';
			echo "Secrete Key:" 	. 	$params['oauth_token_secret'] 			. '<br/>';
			echo "</p>";
			*/
			
			header ("location: https://api.twitter.com/oauth/authorize?oauth_token=".$params['oauth_token']."");
	
			
		} catch (Flb_Twitter_Connection_Invalid_Http_Response_Code_Exception $e) {
	
			exit($e->getMessage());
	
		}
	
	}
	
endif;
	