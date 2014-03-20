<?php
/**
 * Template Name: Edit Profile Page
 *
 */
 

 
 
	/* Get user info. */
	global $current_user, $wp_roles;
	get_currentuserinfo();

	/* Load the registration file. */
	//require_once( ABSPATH . WPINC . '/registration.php' );
	
	require_once( ABSPATH . 'wp-admin/includes' . '/file.php' );
	
	require_once( ABSPATH . 'wp-admin/includes' . '/template.php' ); // this is only for the selected() function

	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

		/* Update user password. */
		if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
			if ( $_POST['pass1'] == $_POST['pass2'] )
				wp_update_user( array( 'ID' => $current_user->id, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
			else
				$error = __('The passwords you entered do not match.  Your password was not updated.', 'netfunktheme');
		}

		/* Update user information. */
		
		update_usermeta( $current_user->id, 'first_name', esc_attr( $_POST['first_name'] ) );
		
		update_usermeta( $current_user->id, 'last_name', esc_attr( $_POST['last_name'] ) );
		
		if ( !empty( $_POST['nickname'] ) )
			update_usermeta( $current_user->id, 'nickname', esc_attr( $_POST['nickname'] ) );
		
		update_usermeta( $current_user->id, 'display_name', esc_attr( $_POST['display_name'] ) );
		
		if ( !empty( $_POST['user_email'] ) )
			update_usermeta( $current_user->id, 'user_email', esc_attr( $_POST['user_email'] ) );
		
		if(strpos($_POST['website'], 'ttp://') || empty( $_POST['website'] ))
			update_usermeta( $current_user->id, 'website', esc_attr( $_POST['website'] ) );
		else
			update_usermeta( $current_user->id, 'website', 'http://' . esc_attr( $_POST['website'] ) );
		
		update_usermeta( $current_user->id, '_aim', esc_attr( $_POST['_aim'] ) );
		
		update_usermeta( $current_user->id, '_yim', esc_attr( $_POST['_yim'] ) );
		
		update_usermeta( $current_user->id, '_jabber', esc_attr( $_POST['_jabber'] ) );
		
		update_usermeta( $current_user->id, '_soundcloud', esc_attr( $_POST['_soundcloud'] ) );
		
		update_usermeta( $current_user->id, '_youtube', esc_attr( $_POST['_youtube'] ) );
		
		update_usermeta( $current_user->id, 'description', esc_attr( $_POST['description'] ) );
		
		// Extra Profile Information
		
		update_usermeta( $current_user->id, 'facebook', esc_attr( $_POST['facebook'] ) );
		
		update_usermeta( $current_user->id, 'twitter', esc_attr( $_POST['twitter'] ) );	
		
		update_usermeta( $current_user->id, 'birth', esc_attr( $_POST['birth'] ) );	
		
		update_usermeta( $current_user->id, 'hobbies', $_POST['hobbies'] );	
		
		//update_usermeta( $current_user->id, 'agree', esc_attr( $_POST['agree'] ) );	
		
		
		// Udate Avatar Mod
		
		if ( !wp_verify_nonce( $_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce' ) )			//security
			
			return;
		
		if ( !empty( $_FILES['simple-local-avatar']['name'] ) )

		{
			$mimes = array(

				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif' => 'image/gif',
				'png' => 'image/png',
				'bmp' => 'image/bmp',
				'tif|tiff' => 'image/tiff'

			);

			$avatar = wp_handle_upload( $_FILES['simple-local-avatar'], array( 'mimes' => $mimes, 'test_form' => false ) );

			if ( empty($avatar['file']) )	// handle failures
			{	
				switch ( $avatar['error'] ) {
					case 'File type does not meet security guidelines. Try another.' :
						add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error",__("Please upload a valid image file for the avatar.","simple-local-avatars"));') );				
						break;

					default :
						add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error","<strong>".__("There was an error uploading the avatar:","simple-local-avatars")."</strong> ' . esc_attr( $avatar['error'] ) . '");') );
				}

				return;

			}

			avatar_delete( $current_user->id );	// delete old images if successful

			update_usermeta( $current_user->id, 'simple_local_avatar', array( 'full' => $avatar['url'] ) );		// save user information (overwriting old)

		}

		elseif ( isset($_POST['simple-local-avatar-erase']) && $_POST['simple-local-avatar-erase'] == 1 )

			avatar_delete( $current_user->id );
		
		
		
		/* Redirect so the page will show updated info. */
		if ( !$error ) {
			wp_redirect( get_permalink() );
			exit;
		}
	}
	
    get_header();


?>


<!--container-->

<div id="container" class="row">

<br />

<br />

<div id="blackoutTrigger"></div>

	<!--content-->

	<div class="content row">

	<div class="large-9 columns">

		
		<? the_post(); ?>
        
            
		<div id="post-<?php the_ID(); ?>">


			<h1><?php _e( 'Edit Profile','netfunktheme' ); ?></h1>

			<?php if ( !is_user_logged_in() ) : ?>


				<div class="large-12 alert-box alert" data-alert>
				
                	<?php _e('You must be logged in to edit your profile.', 'netfunktheme'); ?>
				
                </div><!-- .warning -->


			<?php else : ?>


				<?php if ( $error ) echo '<p class="error">' . $error . '</p>'; ?>

				<form method="post" id="edituser" class="user-forms custom" action="<?php the_permalink(); ?>">

                <!-- AVATAR MOD -->

				<hr />
                

				<h3><?php _e( 'Avatar','simple-local-avatars' ); ?></h3>


                <div class="row">

				
					<?php $options = get_option('simple_local_avatars_caps');
 
                      if ( empty($options['simple_local_avatars_caps']) || current_user_can('upload_files') ) {

							do_action( 'simple_local_avatar_notices' ); 
							wp_nonce_field( 'simple_local_avatar_nonce', '_simple_local_avatar_nonce', false ); 

					?>

                    <div class="large-3 columns">
                        
                        <?php do_action('netfunktheme_author_image', $atts = array('user_id'=>$current_user->id,'size'=>100)); ?>
                        
                        <br />
                        
                        <br />
                        
                        <label for="simple-local-avatar" class="left inline"><?php _e('Upload Avatar','netfunktheme'); ?></label>
                        
                        <input type="file" name="simple-local-avatar" id="simple-local-avatar" />
                        
                    </div>
                    

                    <div class="large-9 columns">

							<div class="row">

                                <div class="large-12 columns">

									<p>
                                   
                                   	  Replace the local avatar by uploading a new avatar, or erase the local avatar (falling back to a gravatar) by checking the delete option.
                                    
                                    <p>
                            
                            	</div>
                            
                            </div>

							<div class="row">

                                <div class="large-12 columns">
                                    
                                    <div class="panel radius notice">
                                    
                                        <strong>NOTICE:</strong> Avatar images are edited here 
                                     
                                        as well as your <strong><a href="/forum/ucp.php?i=profile&amp;mode=avatar">forum</a></strong> user profile. You should upload avatars for both 
                                     
                                        profiles to ensure branding visibility. In this respect you may have 2 different 
                                     
                                        avatar images =) 
                                        
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                            <div class="row">

                                
                                <div class="large-8 columns">
    
                                	<input name="updateuser" type="submit" id="updateuser" class="button small blue radius expand" value="<?php _e('Save Avatar', 'netfunktheme'); ?>" />
    
                                </div>
                                
                                
                                
                                <div class="large-4 columns">
                                
                                <br />
                                
                                <?php
            
									if ( empty( $current_user->simple_local_avatar ) )
										echo '<span class="description">' . __('No local avatar is set. Use the upload field to add a local avatar.','simple-local-avatars') . '</span>';
				
									else 
				
										echo '<label for="simple-local-avatar-erase" class="right inline pull-5">'. 
											__('Delete local avatar','simple-local-avatars').'</label>'
											.'<input type="checkbox" name="simple-local-avatar-erase" value="1" /> ';		
								?>
                                
                                </div>

                            </div>
                        
                    </div>
                    
               		<?php 
					
					
						} else {

							echo '<div class="large-12 columns">';
							
							if ( empty( $current_user->simple_local_avatar ) )
								echo '<span class="description">' . __('No local avatar is set. Set up your avatar at Gravatar.com.','simple-local-avatars') . '</span>';
	
							else 
								echo '<span class="description">' . __('You do not have media management permissions. To change your local avatar, contact the blog administrator.','simple-local-avatars') . '</span>';
						
							echo '</div>';
						}
	
					?>
                        
                        
                        

                </div>

                <script type="text/javascript">
            
                    var form = document.getElementById('edituser');
            
                    form.encoding = 'multipart/form-data';
            
                    form.setAttribute('enctype', 'multipart/form-data');
            
                </script>

                
                <hr />
                
                
                
				<h3>Name:</h3>

                <div class="row"><!-- real name -->
                
                    <div class="large-12">
                        
                        <div class="large-3 columns left">
                            <label for="first_name"><?php _e('First Name', 'netfunktheme'); ?></label>
                        </div>
                        
                        <div class="large-4 pull-5 columns right">
                            <input class="text-input" name="first_name" type="text" id="first_name" value="<?php the_author_meta( 'first_name', $current_user->id ); ?>" />
                        </div>
                    
                    </div>
                
                </div>
                
                    
                <div class="row"><!-- real name -->
                    
                    <div class="large-12">
                    
                        <div class="large-3 columns left">
                        	<label for="last_name"><?php _e('Last Name', 'netfunktheme'); ?></label>
 						</div>
                        
                        <div class="large-4 pull-5 columns right">
                        	<input class="text-input" name="last_name" type="text" id="last_name" value="<?php the_author_meta( 'last_name', $current_user->id ); ?>" />
                    	</div>
                    
                    </div>
              
              	</div>   
                    
                    
                  <div class="row">  <!-- nickname -->
                    
                        <div class="large-12">
                        
                        	<div class="large-3 columns left">
                        		<label for="nickname" class="left inline"><?php _e('Nickname <span class="round alert label">(required)</span>', 'netfunktheme'); ?></label>
 							</div>

							<div class="large-4 pull-5 columns right">
                            	<input class="text-input" name="nickname" type="text" id="nickname" value="<?php the_author_meta( 'nickname', $current_user->id ); ?>" />
                        	</div>
                        
                        </div>
                    
                   </div>
                    
                   <div class="row"><!-- choose display name -->
                    
                        <div class="large-12">
                        
                        	<div class="large-3 columns left">
                        		<label for="display_name" class="left inline"><?php _e('Display Name', 'netfunktheme'); ?></label>
 							</div>
                        
                           
                        	<div class="large-4 pull-5 columns right">
                            <select name="display_name" id="display_name">
                        
                            <?php
                                $public_display = array();
                                $public_display['display_nickname']  = $current_user->nickname;
                                $public_display['display_username']  = $current_user->user_login;
                                if ( !empty($current_user->first_name) )
                                    $public_display['display_firstname'] = $current_user->first_name;
                                if ( !empty($current_user->last_name) )
                                    $public_display['display_lastname'] = $current_user->last_name;
                                if ( !empty($current_user->first_name) && !empty($current_user->last_name) ) {
                                    $public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
                                    $public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
                                }
                                if ( !in_array( $current_user->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
                                    $public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;
                                $public_display = array_map( 'trim', $public_display );
                                foreach ( $public_display as $id => $item ) {
                            ?>
                            
                                <option id="<?php echo $id; ?>" value="<?php echo esc_attr($item); ?>"<?php selected( $current_user->display_name, $item ); ?>><?php echo $item; ?></option>
                            
                            <?php
                            
                                }
                            
                            ?>
                            
                            </select>
                            </div>
                        
                        </div>
                    
                    </div>


                <hr />
                
                
                <h2>Contact Info:</h2>



                <div class="row"><!-- email -->
                
                    <div class="large-12">

						<div class="large-3 columns left">
                            <label for="user_email class="left inline""><?php _e('E-mail <span class="round alert label">(required)</span>', 'netfunktheme'); ?></label>
                            
                        </div>
                        
                        <div class="large-4 pull-5 columns right">
                            <input class="text-input" name="user_email" type="text" id="user_email" value="<?php the_author_meta( 'user_email', $current_user->id ); ?>" />
                            
                        </div>
                
                	</div>
                
                </div>
                
                
                <div class="row"><!-- website -->
                
                    <div class="large-12">        

                        <div class="large-3 columns left">
                            <label for="website" class="left inline"><?php _e('Website', 'netfunktheme'); ?></label>
                            
                        </div>
                        
                        <div class="large-4 pull-5 columns right">
                            <input class="text-input" name="website" type="text" id="website" value="<?php the_author_meta( 'website', $current_user->id ); ?>" />
                            
                        </div>

                 	</div>
                
                </div>
                
               <hr />
                
                
                
                
                <h3>Password:</h3>
                
                
                <div class="row"><!-- password -->
                
                    <div class="large-12">
                    
                        <div class="large-3 columns left">
                            <label for="pass1" class="left inline"><?php _e('New Password', 'netfunktheme'); ?></label>
                            
                        </div>
                        
                        <div class="large-4 pull-5 columns right">
                            <input class="text-input" name="pass1" type="password" id="pass1" autocomplete="off" />
                            
                        </div>

				 </div>
                
                </div>


				 <div class="row"><!-- password -->
                
                    <div class="large-12">

                        <div class="large-3 columns left">
                            <label for="pass2" class="left inline"><?php _e('Confirm Password', 'netfunktheme'); ?></label>
                            
                        </div>
                        
                        <div class="large-4 pull-5 columns right">
                            <input class="text-input" name="pass2" type="password" id="pass2" autocomplete="off" />
                            
                        </div>

                    </div>
                
                </div>
                
                
                
                <hr />
                


				<!--p class="form-submit">
					<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update Profile', 'netfunktheme'); ?>" />
				<div style="clear:both"></div>
                </p--><!-- .form-submit -->
                
                <!--div style="border-top:1px #323232 dashed; height: 0px; display:block; margin: 10px -10px 20px; clear: both;"></div-->
                

				<h3>About Yourself:</h3>
				
                <div class="row"><!-- about -->
                
                    <div class="large-12">
                
                        <div class="large-3 columns left">
                        	<label for="description"><?php _e('Biographical Info', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-7 pull-2 columns right">
                            <textarea class="text-input" name="description" id="description" rows="8" cols="50"><?php echo the_author_meta( 'description', $current_user->id ); ?></textarea>
                            
                        </div>
    
                    </div>
                
                </div>
               
               
               <hr />



               <h3>Social Network:</h3>
				
                
                
                
                <?php if (class_exists('bc_soundcloud_integration')):?>
                 
                <div class="row"><!-- soundcloud -->
                
                    <div class="large-12">
                
                        <div class="large-2 columns left">
                        	<label for="_soundcloud" class="left inline"><?php _e('Soundcloud', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-5 pull-5 columns right">
                           
					
							<?php	
							
								if (!get_user_meta($current_user->id,'soundcloud_token'))
									do_action('soundcloud_auth_link_mini');
									
								else 
									do_action('soundcloud_disconnect_link_mini');
								
							?>	
								
                            
                        </div>
    
                    </div>
                
                </div>
                
                
                <?php endif; ?>
                
                
                <?php if (class_exists('flb_twitter_api_integration')): ?>
                
                <div class="row"><!-- twitter -->
                
                    <div class="large-12">
                
                        <div class="large-2 columns left">
                        	<label for="twitter" class="left inline"><?php _e('Twitter', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-5 pull-5 columns right">
                            <?php 
					
								if (!get_user_meta($current_user->id,'flb_twitter_token'))
									do_action('twitter_auth_link');
								
								else 
									do_action('twitter_disconnect_link');
								
								
							 ?>	
							
                        </div>
    
                    </div>
                
                </div>
                
             <?php endif; ?>
                
                
 			<?php if (class_exists('flb_facebook_api_integration')):  ?>
 
 
				<div class="row"><!-- twitter -->
                
                    <div class="large-12">
                
                        <div class="large-2 columns left">
                        	<label for="facebook" class="left inline"><?php _e('Facebook', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-5 pull-5 columns right">
                            
							<?php 
						
								$flbFacebookClass = new flb_facebook_api_integration();
					
								echo $flbFacebookClass->facebook_auth_link_mini();

							?>

                        </div>
    
                    </div>
                
                </div>
                
                
                <?php endif; ?>
                
                
                <div class="row"><!-- aim -->
                
                    <div class="large-12">
                
                        <div class="large-4 columns left">
                        	<label for="_aim" class="left inline"><?php _e('AIM', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-3 pull-5 columns right">
                            <input class="text-input" name="_aim" type="text" id="_aim" value="<?php the_author_meta( '_aim', $current_user->id ); ?>" />
                            
                        </div>
    
                    </div>
                
                </div>

                
                <div class="row"><!-- yim -->
                
                    <div class="large-12">
                
                        <div class="large-4 columns left">
                        	<label for="_yim" class="left inline"><?php _e('Yahoo IM', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-3 pull-5 columns right">
                            <input class="text-input" name="_yim" type="text" id="_yim" value="<?php the_author_meta( '_yim', $current_user->id ); ?>" />
                            
                        </div>
    
                    </div>
                
                </div>


				<div class="row"><!-- jabber -->
                
                    <div class="large-12">
                
                        <div class="large-4 columns left">
                        	<label for="_jabber" class="left inline"><?php _e('Jabber / Google Talk', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-3 pull-5 columns right">
                            <input class="text-input" name="_jabber" type="text" id="_jabber" value="<?php the_author_meta( '_jabber', $current_user->id ); ?>" />
                            
                        </div>
    
                    </div>
                
                </div>


				<div class="row"><!-- youtube -->
                
                    <div class="large-12">
                
                        <div class="large-4 columns left">
                        	<label for="_youtube" class="left inline"><?php _e('Youtube', 'netfunktheme'); ?></label>
                        
                        </div>
                        
                        <div class="large-3 pull-5 columns right">
                            <input class="text-input" name="_youtube" type="text" id="_youtube" value="<?php the_author_meta( '_youtube', $current_user->id ); ?>" />
                            
                        </div>
    
                    </div>
                
                </div>    
                
                
               <hr />


				<h3>More About You:</h3>
				
				
				<!--p class="form-birth">
					<label for="birth"><?php _e('Year of birth', 'netfunktheme'); ?></label>
					<?php
						for($i=1900; $i<=2000; $i++)
							$years[]=$i;
						
						echo '<select name="birth">';
							echo '<option value="">' . __("Select Year", 'netfunktheme' ) . '</option>';
							foreach($years as $year){
								$the_year = get_the_author_meta( 'birth', $current_user->id );
								if($year == $the_year ) $selected = 'selected="slelected"';
								else $selected = '';
								echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
							}
						echo '</select>';
					?>
				</p --><!-- .form-birth -->
				
				<div class="row"><!-- interests -->

                    <div class="large-8 push-4">
				
                        <p><?php _e('What are your interests? What brings you here?', 'netfunktheme'); ?></p>
                        
                        <?php
                            $hobbies = get_the_author_meta( 'hobbies', $current_user->id );
                        ?>
                        
                        <ul class="inline-list">
                        
                            <li><label class="left inline"><input value="producing"        	name="hobbies[]" <?php if (is_array($hobbies)) { 		if (in_array("producing",       $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Music Production',           		'netfunktheme'); ?></label></li>
                        
                            <li><label class="left inline"><input value="mixing" 			name="hobbies[]" <?php if (is_array($hobbies)) { 		if (in_array("mixing", 			$hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Djing / Mixing', 					'netfunktheme'); ?></label></li>
                        
                            <li><label class="left inline"><input value="promoting"        	name="hobbies[]" <?php if (is_array($hobbies)) { 		if (in_array("promoting",       $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Promoting Music / Events',         'netfunktheme'); ?></label></li>
                        
                        </ul>
                    
				
               		</div> 

				</div> 


				<hr />


				<div class="row">

                    <div class="large-8 push-2 text-center">
				
						<?php echo $referer; ?>
                    
                        <input name="updateuser" type="submit" id="updateuser" class="button expand radius blue" value="<?php _e('Update Profile', 'netfunktheme'); ?>" />
                    
                        <?php wp_nonce_field( 'update-user' ) ?>
                    
                        <input name="action" type="hidden" id="action" value="update-user" />

                	</div>
                    
                
                </div>

				</form><!-- #edituser -->
                

			<?php endif; ?>
            

<!-- EDIT PROFILE ENDS HERE -->

		
<?php
        
	if ( get_post_custom_values('comments') ) 
		comments_template(); // Add a key/value of "comments" to enable comments on pages!
	
	// calling the widget area 'page-bottom'
	//get_sidebar('page-bottom');
        
?>

        </div>
        
        </div>

		<?php get_sidebar(); ?>

		</div><!-- #End Entry-Background -->

	<!--.post -->

</div><!-- #content -->



<?php get_footer(); ?>