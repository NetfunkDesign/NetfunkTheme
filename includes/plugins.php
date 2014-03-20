<?php 

/* 

netfunktheme theme plugins system 

*/


add_action( 'admin_init', 'theme_plugin_options_init' );
add_action( 'admin_menu', 'theme_plugin_options_add_page' );

$request_action = (!empty($_REQUEST['action']) ? $_REQUEST['action'] : '');


// register theme plugin settings
function theme_plugin_options_init(){

	register_setting( 'netfunktheme_plugin_options', 'netfunktheme_theme_plugin_options', 'theme_plugin_options_validate' );

}


// add plugin submenu to netfunktheme theme menu
function theme_plugin_options_add_page() {

	add_submenu_page('theme_settings',__( 'NetfunkTheme Theme Plugins' ),__('Plugins' ),'edit_theme_options','theme_plugins', 'theme_plugins_options_page' );

}

// missing plugin admin notices 

add_action( 'admin_notices', 'theme_plugin_notices' );

function theme_plugin_notices(){
	
     global $current_screen;
	 
     if ( $current_screen->parent_base == 'theme_plugins' )
          echo '<div><p>Warning - changing settings on these pages may cause problems with your website\'s design!</p></div>';
}



/* theme plugin shortcode generator */

if (!function_exists( 'netfunktheme_member_profile_shortcode')){


	// netfunktheme_theme_plugin_shortcode ( $shortcode , $function ) 
	
	// netfunktheme_theme_plugin_shortcode ( 'netfunktheme_member_edit_page', 'netfunktheme_edit_profile_page' ) 
	
	// shortcode would be '[netfunktheme_member_edit_page]'
	

	function netfunktheme_theme_plugin_shortcode ( $shortcode, $function ) {
		
		add_shortcode ($shortcode, $function);

	}
}

add_action( 'netfunktheme_theme_plugin_shortcode', 'netfunktheme_theme_plugin_shortcode' );









// validate theme plugin options
	
function theme_plugin_options_validate( $input ) {
	
	$options = get_option( 'netfunktheme_theme_plugin_options' );

	if (isset($input)){

		foreach ( $input as $plugin ){

			if (isset($input['action']) && $input['action'] != 'delete-selected'){

				// activate plugin
				
				if (isset($input['action']) && $input['action'] == 'activate-selected')
					
					$activate = 1;
				
				// deactivate plugin
				
				else if (isset($input['action']) && $input['action'] == 'deactivate-selected')
				
					$activate = 0;
		
				// plugin options
				
				if ( $plugin != 'action')
					$options[$plugin] = wp_filter_nohtml_kses( $activate );

			} else {
				
				// delete plugin
				remove_plugin($plugin);

			}

		}
	}
	
	return $options;

}




/* remove plugin */

function remove_plugin($plugin) {

	$options = get_option( 'netfunktheme_theme_plugin_options' );
	
	$plugin_file = get_template_directory() . '/plugins/'.$plugin.'/';

	// does plugin exist?
	if (is_dir($plugin_file)) {

		$objects = scandir($plugin_file);
		
		// delete files recursivly 
		
		foreach ($objects as $object) {

			if ($object != "." && $object != "..") {
			
				if (filetype($plugin_file."/".$object) == "dir") remove_plugin($plugin_file."/".$object); else unlink($plugin_file."/".$object);

			}

		}
		
		reset($objects);

		rmdir($plugin_file);
		 

		// purge plugins settings 
		
		/*
		
		foreach ($options as $input => $value){
		
			if ( $input != $plugin)
				$options[$input] = $value;
			
		}
		
		// update option array
		
		update_option('netfunktheme_theme_plugin_options', $options);
		
		//return $options;
		
		*/


	}
   
}




/* 

plugin file headers must contain a plugin name, 
description, version, authr, author url and plugin url. 

*/


function validate_theme_plugin($file){

	$slug = basename($file, ".php");
	$plugin = file_get_contents( $file );
	
	// plugin name
	
	$title = 'Plugin Name:';
	$title_pattern = preg_quote($title, '/');
	$title_pattern = "/^.*$title_pattern.*\$/m";
	
	// plugin description
	
	$description = 'Plugin Description:';
	$description_pattern = preg_quote($description, '/');
	$description_pattern = "/^.*$description_pattern.*\$/m";
	
	// plugin version
	
	$version = 'Plugin Version:';
	$version_pattern = preg_quote($version, '/');
	$version_pattern = "/^.*$version_pattern.*\$/m";
	
	// plugin description
	
	$author = 'Plugin Author:';
	$author_pattern = preg_quote($author, '/');
	$author_pattern = "/^.*$author_pattern.*\$/m";
	
	// plugin author website
	
	$author_url = 'Plugin Author URL:';
	$author_url_pattern = preg_quote($author_url, '/');
	$author_url_pattern = "/^.*$author_url_pattern.*\$/m";
	
	// plugin website
	
	$plugin_url = 'Plugin URL:';
	$plugin_url_pattern = preg_quote($plugin_url, '/');
	$plugin_url_pattern = "/^.*$plugin_url_pattern.*\$/m";

	// plugin arguments array

	$plugin_args = array();
	

	// validate plugin config header

	if ( 
	
		preg_match_all( $title_pattern, $plugin, $plugin_name ) /* check name */ 
			
		&& preg_match_all( $description_pattern, $plugin, $plugin_description )  /* check description */
				
		&& preg_match_all( $version_pattern, $plugin, $plugin_version ) /* check version  */
				
		&& preg_match_all( $author_pattern, $plugin, $plugin_author )  /* check author */
				
		&& preg_match_all( $author_url_pattern, $plugin, $plugin_author_url )  /* check author url */
				
		&& preg_match_all( $plugin_url_pattern, $plugin, $plugin_url ) /* check plugin url  */ ) {
		
		// sanitize plugin args
		
		$plugin_name = str_replace('Plugin Name:','',implode("\n", $plugin_name[0]));
		$plugin_description = str_replace('Plugin Description:','',implode("\n", $plugin_description[0]));
		$plugin_version = str_replace('Plugin Version:','',implode("\n", $plugin_version[0]));
		$plugin_author = str_replace('Plugin Author:','',implode("\n", $plugin_author[0]));
		$plugin_author_url = str_replace('Plugin Author URL:','',implode("\n", $plugin_author_url[0]));
		$plugin_url = str_replace('Plugin URL:','',implode("\n", $plugin_url[0]));
		

		// build plugin arguments
		
		array_push($plugin_args,$slug,$plugin_name,$plugin_description,$plugin_version,$plugin_author,$plugin_author_url,$plugin_url);
		
		return $plugin_args;
		
	}

}




/* display valid plugins list */
				
//get validated theme plugins 

function get_valid_theme_plugins(){

	settings_fields( 'netfunktheme_plugin_options' ); 
	
	$options = get_option( 'netfunktheme_theme_plugin_options' );
	
	$folder_paths = glob (get_template_directory() . '/plugins/*/*.php');

	foreach ( $folder_paths as $file ) {

		if ($args = validate_theme_plugin($file)){
		
			// 0 - plugin slug
			// 1 - plugin name
			// 2 - plugin description
			// 3 - plugin version
			// 4 - plugin author
			// 5 - plugin author url 
			// 6 - plugin url 
			// 7 - plugin active
		
			echo '<tr id="plugin-name" class="'.(isset($options[$args[0]]) && $options[$args[0]] == 1 ? 'active' : 'inactive').'">'
			
				.'<th scope="row"> <input type="checkbox" name="netfunktheme_theme_plugin_options['.$args[0].']" id="netfunktheme_theme_plugin_options['.$args[0].']" value="1"> </th>'
				
				.'<td class="plugin-title"> <strong>' . $args[1] . '</strong> '
				
					.'<div class="row-actions visible">'

						.'<span class="'.(isset($options[$args[0]]) && $options[$args[0]] == 1 ? 'deactivate' : 'activate').'"> <a title="'.(isset($options[$args[0]]) && $options[$args[0]] == 1 ? 'Deactivate' : 'Activate').' this plugin" href="'. $_SERVER['PHP_SELF'] . '?page=theme_plugins&action='.(isset($options[$args[0]]) && $options[$args[0]] == 1 ? 'deactivate' : 'activate').'&plugin='.$args[0].'"> '.(isset($options[$args[0]]) && $options[$args[0]] == 1 ? 'Deactivate' : 'Activate').' </a> </span>'
						
						.' | '
						
						.'<span class="delete"> <a class="edit" title="Delete this plugin" href="#"> Delete </a> </span>'
					
					.'</div>'
				
				.'</td>'
			
				.'<td class="column-description desc"> <div class="plugin-description"> <p>' . $args[2] . '</p> </div> <div class="plugin-version-author-uri"> <p> Version ' . $args[3] . ' | By <a href="'.$args[5].'" target="_blank">'.$args[4].'</a> | <a href="'.$args[6].'" target="_blank">Visit plugin site</a> </p> </div> </td>'
			 
			  .'</tr>';

		}
		
	}
	
}


/* theme plugins options page */

function theme_plugins_options_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	
	<div class="wrap">
	
	
		<div id="icon-themes" class="icon32"></div>  
		
		
		<?php echo "<h2>" . wp_get_theme() . __( ' Plugins', 'netfunktheme' ) . "</h2>"; ?>
		
		<br />

		<?php theme_nav() ?>
		

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'netfunktheme' ); ?></strong></p></div>

        	<hr style=" border: solid #DDD 1px;"/>

		<?php endif; ?>
		

		<form method="post" action="options.php">

		<h3 class="netfunk title">NetfunkTheme Plugins</h3>

		<div class="panel radius">

            <span class="fa fa-plus-square hide-for-small show-for-large-up" style="z-index: 1; color: #CCC; position: absolute; left: 100%; margin-left: -200px; font-size: 150px; "></span>
        
        	<div class="large-8 medium-12 small-12">
        
                <h3>More Plugins?.. What are these?</h3>
                
                <p><strong class="label">NetfunkTheme</strong> plugins are designed to add extened support for popular WP-Plugins, content services including Facebook, Twitter, Soundlcoud, Beatport, Instagram as well as advanced style and layout options. 
                
                 These plugins are design to merge flawlessly and look amazing with all NetfunkTheme products. </p>
            
            </div>
            
            <hr />
            
            <div class="large-8 medium-12 small-12">
            
                <h4>Where do I get more Netfunk Plugins?</h4>
                
                <p>This theme comes with only a few plugins, though more may be purchased for a reasonable price. 
                
                If you would like the full suite of <strong>Netfunk Plugins</strong> you may also purchase the <a href="http://www.netfunkdesign.com" target="_blank">Expanded Theme Package</a> at our website.
        
                <br />
                
                <br />
                
                    <a href="http://www.netfunkdesign.com" target="_blank" class="aligncenter button-primary">Visit NetfunkDesign.com</a>
                
                
                </p>
            
            </div>
        
        </div>

		<h3 class="title">Installed Plugins</h3>

		<div class="panel radius">

		<h3> <i class="fa fa-wrench"></i> &nbsp; Enable or disable plugins below to expand, or simplify your horizons. </h3>

		<br />
		<hr />

		<div class="tablenav top">

			<div class="actions bulkactions">
	
				<select name="netfunktheme_theme_plugin_options[action]" id="netfunktheme_theme_plugin_options[action]">
				
					<option selected="selected" value="-1"> Bulk Actions </option>
					
					<option value="activate-selected"> Activate </option>
					
					<option value="deactivate-selected"> Deactivate </option>
					
					<option value="delete-selected"> Delete </option>
					
					<!--option value="update-selected"> Update </option-->

				</select>
				
				<input id="doaction" class="button action" type="submit" value="Apply" name="">
		
			</div>

		</div>
        
		<br />
		
		<table class="wp-list-table widefat plugins" cellspacing="0">
	 
		 <thead>
	  
		  <tr>
	 
			<th id="cb" class="manage-column column-cb check-column" style="" scope="col"> <input type="checkbox" name="checkall" id="checkall" value="1"> </th>
	 
			<th id="name" class="manage-column column-name" style="" scope="col"> Plugin </th>
	 
			<th id="description" class="manage-column column-description" style="" scope="col"> Description </th>
	
		  </tr>
	  
		</thead>
		
		<tbody id="the-list">
		  
		  <?php 
		
			get_valid_theme_plugins();

		 ?>
		  
		  </tbody>
		  
		  <tfoot>
		  
		  <tr>
		
			<th id="cb" class="manage-column column-cb check-column" style="" scope="col"> <input type="checkbox" name="checkall" id="checkall" value="1"> </th>
		
			<th id="name" class="manage-column column-name" style="" scope="col"> Plugin </th>
		
			<th id="description" class="manage-column column-description" style="" scope="col"> Description </th>
		
		  </tr>
	  
		</tfoot>
	 
		</table>
        
        </div>

		<br />

		<hr style=" border: solid #DDD 1px;"/>
		
		<br />
		
		<!--h3>Save settings </h3>

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php //_e( 'Save Options', 'netfunktheme' ); ?>" />
		</p-->

	</form>

	</div>

	<?php

	/* Debug  */
				
		//$options = get_option( 'netfunktheme_theme_plugin_options' );
					
		//echo '<pre>';
		//echo '<h6>debug</h6>';
		//print_r ($options);
		//echo '</pre>';

}


/* activate theme plugin */

if ( $request_action == 'activate' && !empty( $_REQUEST['plugin'] ) ) {

	$options = get_option( 'netfunktheme_theme_plugin_options' );

	$plugin = $_REQUEST['plugin'];
	
	$options[$plugin] = wp_filter_nohtml_kses( 1 );

	update_option('netfunktheme_theme_plugin_options', $options); //update option array

}


/* deactivate theme plugin */

if ( $request_action == 'deactivate' && !empty( $_REQUEST['plugin'] ) ) {

	$options = get_option( 'netfunktheme_theme_plugin_options' );

	$plugin = $_REQUEST['plugin'];
	
	$options[$plugin] = wp_filter_nohtml_kses( 0 );

	update_option('netfunktheme_theme_plugin_options', $options); //update option array

}


/* include valid theme plugin files */

$folder_paths = glob (get_template_directory() . '/plugins/*/*.php');
		
$active_plugins = get_option( 'netfunktheme_theme_plugin_options' );

foreach ($folder_paths as $file) {
	
	// check for active plugins 
	
	if ($args = validate_theme_plugin($file)){
		
		if (isset($active_plugins[$args[0]]) && $active_plugins[$args[0]] == 1)
			require_once($file);
	
	}

}




