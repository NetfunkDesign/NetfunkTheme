<?php
/* 

	Theme Name: WP-netfunktheme 
	Theme URI: http://netfunkdesign.com
	Description: netfunkdesign.com Soundcloud.com Intigration.
	Version: Beta 0.9.1
	Author: Phil Sanders
	Author URI: http://netfunkdesign.com

	License: GPL2 

	Copyright 2012 Phil Sanders  (email : philsanders79@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/* breakculture include files  */
require_once (get_template_directory() .'/includes/theme-options.php');
require_once (get_template_directory() .'/includes/plugins.php');
require_once (get_template_directory() .'/includes/widgets.php');
require_once (get_template_directory() .'/includes/shortcodes.php');

/* breakculture themes */
$file_paths = glob(get_template_directory() . '/layouts/*/*.php');

foreach ($file_paths as $file) {
    require_once($file);
}

/* NetfunkTheme Config */
if (!function_exists( 'netfunktheme_setup')){
	function netfunktheme_setup() {
		global $content_width, $options, $onoff_options;
		
		if (!isset($content_width))
			$content_width = 1000;
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		
		//add_theme_support( 'infinite-scroll', array(
		//	'container' => 'container',
		//	'footer' => 'page'));
			
		// Add support for custom backgrounds
		$args = array(
		'default-color' => '#000',
		'wp-head-callback' => '_custom_background_cb');
		add_theme_support( 'custom-background', $args );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'netfunktheme', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/".$locale.".php";
	
		if (is_readable($locale_file))
			require_once($locale_file);

		// This theme uses wp_nav_menu() in two location.	
		register_nav_menus( array(
				'primary' => __( 'Main Navigation', 'netfunktheme' ),
				'footer' => __( 'Footer Navigation', 'netfunktheme' )
		));

	}
}
add_action('after_setup_theme', 'netfunktheme_setup');

/* netfunktheme theme header */
if (!function_exists( 'netfunktheme_theme_header')){

	function netfunktheme_theme_header() {
		$args = array(
			'default-image' => get_template_directory_uri() . '/images/logo.png',
			'default-text-color' => '#000',
			'width' => 361,
			'height' => 42,
			'flex-height' => true,
			//'wp-head-callback' => 'netfunktheme_theme_header_style',
			//'admin-head-callback' => 'netfunktheme_theme_header_style',
			'admin-preview-callback' => 'netfunktheme_theme_header_image'
		);
		$args = apply_filters( 'netfunktheme_theme_header_args', $args );
	
		if ( function_exists( 'wp_get_theme' ) ) {
			add_theme_support( 'custom-header', $args );
	
		} else {
			// Compat: Versions of WordPress prior to 3.4.
			define( 'HEADER_TEXTCOLOR', $args['default-text-color'] );
			define( 'HEADER_IMAGE', $args['default-image'] );
			define( 'HEADER_IMAGE_WIDTH', $args['width'] );
			define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
			
			add_custom_image_header( $args['wp-head-callback'], 
			$args['admin-head-callback'], $args['admin-preview-callback']);
		}
	}
}


if (!function_exists('netfunktheme_custom_header')){
	function netfunktheme_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}
add_action( 'after_setup_theme', 'netfunktheme_theme_header' );


function netfunktheme_custom_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	
	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'netfunktheme'),
	
	get_comment_author_link(),
	get_comment_date(),
	get_comment_time() );
	edit_comment_link(__('Edit', 'netfunktheme'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>

	<?php 
	if ($comment->comment_approved == '0') { 
		echo '\t\t\t\t\t<span class="unapproved">'; _e('Your trackback is awaiting moderation.', 'netfunktheme'); echo '</span>\n'; 
	} 
	?>

    <div class="comment-content">
		<?php comment_text() ?>
    </div>
    
	<?php 
}

/* netfunktheme page title */
if (!function_exists( 'netfunktheme_page_title')){ 
	function netfunktheme_page_title($title) {
		if ($title == '') {
			return 'Untitled';
		} else {
			return $title;
		}
	}
}
add_filter('the_title', 'netfunktheme_page_title');

/* netfunktheme blog name */
if (!function_exists( 'netfunktheme_title_blogname')){
	function netfunktheme_title_blogname($title) {
		return $title . esc_attr(get_bloginfo('name')); }
}
add_filter('wp_title', 'netfunktheme_title_blogname');

/* netfunktheme default navigation menu */ 
if (!function_exists( 'netfunktheme_default_navigation')){
	function netfunktheme_default_navigation(){
	?><ul id="nav">
        <li <?php if (is_front_page()) { echo " class=\"current_page_item\""; } ?>><a href="<?php echo esc_url(home_url()); ?>" class="blue" title="Home">Home</a></li>				
        <?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
	  </ul>
	<?php
	
	}
}
add_action('netfunktheme_default_navigation','netfunktheme_default_navigation',1,0);

/* netfunktheme navigation menu */ 
if (!function_exists( 'netfunktheme_navigation_menu')){
	function netfunktheme_navigation_menu(){
		$is_nav = '' ;
		$is_nav = wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' , 'menu_id' => 'nav', 'fallback_cb' => '', 'echo' => false ) );
		if ($is_nav == '') { 
			netfunktheme_default_navigation();
		 } else {
        	echo ($is_nav); 
		}
	}
}
add_action('netfunktheme_navigation_menu','netfunktheme_navigation_menu',1,0);

/* netfunktheme navigation menu */
if (!function_exists( 'netfunktheme_user_menu')){
	function netfunktheme_user_menu(){
	global $current_user;
	?>		
	
    <ul id="nav">
	<?php  
		
		if ( is_user_logged_in()) { 
			printf( __('<li><span data-tooltip class="has-tip [tip-bottom]" title="Click to view your author page"><a href="%1$s" class="user1">Welcome %2$s</a></span></li>', 'netfunktheme'), home_url() . '/?author='.$current_user->ID, $current_user->display_name ); 
	?>
        <li><a href="#" class="link" title="Click here to view the blog control panel"><i class="fa fa-desktop"></i> &nbsp; Control Panel</a>
            <ul class="user-nav-dropdown text-left">
                <?php $menu_list = do_action('netfunktheme_user_dropdown_menu'); ?>
            </ul>
        </li>

<?php } else { ?>

    <?php if (class_exists('WpPhpBB')){ ?>	
        <li><a href="<?php echo home_url() ?>/forum/ucp.php?mode=register" class="signup" title="Click here to Sign-Up">Sign-Up</a></li>
    
     <?php } else { ?>
        <li><a href="<?php echo home_url() ?>/wp-signup.php" class="signup" title="Click here to Sign-Up">Sign-Up</a></li>
     
     <?php }?>
     
     	<li><a href="<?php echo home_url() ?>/wp-login.php" class="link">Login</a></li>
	 
	<?php } ?>
    
    </ul><?php
	}	
}
add_action('netfunktheme_user_menu','netfunktheme_user_menu',1,0);


/* netfunktheme navigation menu */ 
if (!function_exists( 'netfunktheme_responsive_nav')){
	function netfunktheme_responsive_nav(){
		
	?>
    <div id="menu-responsive-select" class="small-12 columns hide-for-medium-up dropdown">
        
        <?php 
        
            // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
            // This code based on wp_nav_menu's code to get Menu ID from menu slug
        
            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'primary' ] ) ) {
                $menu = wp_get_nav_menu_object( $locations[ 'primary' ] );
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                $menu_list = '<form name="nav_jump" id="nav_jump" method="post" class="custom" action="javascript:void(0);">';
                $menu_list .= '<select onchange="location.href=nav_jump.menu_primary.options[selectedIndex].value" id="menu_primary">';
                $menu_list .= '<option value="" class="nav_title"> > Click here to browse</option>';
        
                global $post;
                
                $page_title = str_replace("<br>","",get_the_title($post->ID));
        
                //echo $page_title;
        
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    $title = str_replace("<br>","",$menu_item->title);
                    $url = $menu_item->url;
        
                    if ($url != "#")
                      $menu_list .= '<option value="'.$url.'"'.($page_title == $title ? ' selected' : '').'>&nbsp; ' . $title . '</option>';
                      //echo $page_title . " : " . $title . "";
                }
                
                $menu_list .= '</select></form>';
                
				echo $menu_list;
				
            } else {
                netfunktheme_default_navigation();
            }
 
        ?>
        
        </div>
        
      <?php
	
	}
}
add_action('netfunktheme_responsive_nav','netfunktheme_responsive_nav',1,0);


/* netfunktheme user menu dropdown menu panel */
if (!function_exists( 'netfunktheme_user_dropdown_menu')){
	function netfunktheme_user_dropdown_menu(){
	if (!function_exists( 'netfunktheme_member_edit_link')){ ?>
        <li><a href="<?php echo home_url() ?>/wp-admin/profile.php" class="members">Profile Settings
        <!--div>Edit your profile, upload a user image, manage personal <br />preferences.</div--></a></li>
	<?php } ?>
    <li><a href="<?php echo home_url() ?>/wp-admin/" class="blog">Blog Control Panel
    <!--div>Make Posts, Upload Media, <br />Manage Blog Specific Settings.</div--></a></li>
    <?php if (class_exists('WpPhpBB')) {  
        $admin_url = wpbb_get_admin_link(); // currently logged in ?>	
        <li><a href="<?php echo home_url() ?>/forum/ucp.php" class="forum">Forum Control Panel<div>Manage Forum posts, Private Messages, Forum Profile, <br />Forum Specific Settings.</div></a></li>
        <?php if ( !empty( $admin_url ) )  ?>
        <li><a href="<? echo $admin_url ?>">phpBB Administration</a></li>
    <?php } ?>
    <li><a href="<?php echo home_url() ?>/wp-login.php?action=logout&redirect_to=<?php echo home_url() ?>" class="signup" title="Click here to Log-Out">Logout</a></li>
<?php }	
}
add_action('netfunktheme_user_dropdown_menu','netfunktheme_user_dropdown_menu',1,0);

/* netfunktheme comment reply javascript */
if (!function_exists( 'netfunktheme_comment_reply_js')){

	function netfunktheme_comment_reply_js() {
		if(get_option('thread_comments')) { 
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('comment_form_before', 'netfunktheme_comment_reply_js');

/* netfunktheme comment form defaults */
if (!function_exists( 'netfunktheme_comment_form_defaults')){
	function netfunktheme_comment_form_defaults( $args ) {
		$req = get_option( 'require_name_email' );
		$required_text = sprintf( ' ' . __('Required fields are marked %s', 'netfunktheme'), '<span class="required">*</span>' );
		$args['comment_notes_before'] = '<p class="comment-notes">' . __('Your email is kept private.', 'netfunktheme') . ( $req ? $required_text : '' ) . '</p>';
		$args['title_reply'] = __('Post a Comment', 'netfunktheme');
		$args['title_reply_to'] = __('Post a Reply to %s', 'netfunktheme');
		return $args;
	}
}
add_filter('comment_form_defaults', 'netfunktheme_comment_form_defaults');


/* netfunktheme page numbers */
function netfunktheme_get_page_number() {
	if (get_query_var('paged')) {
		print ' | ' . __( 'Page ' , 'netfunktheme') . get_query_var('paged');
	}
}

/* netfunktheme category lists */
function netfunktheme_catz($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;
	return trim(join( $glue, $cats ));
}

/* netfunktheme tags */
function netfunktheme_tag_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );

	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	
	if ( empty($tags) )
		return false;
	
	return trim(join( $glue, $tags ));
}

/* netfunktheme custom comments  */
function netfunktheme_custom_comments($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	
?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    <div class="comment-author vcard"><?php netfunktheme_commenter_link() ?></div>
    <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s', 'netfunktheme' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e('Permalink to this comment', 'netfunktheme' ); ?>"><?php _e('Permalink', 'netfunktheme' ); ?></a>

	<?php edit_comment_link(__('Edit', 'netfunktheme'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
	<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your comment is awaiting moderation.', 'netfunktheme'); echo '</span>\n'; } ?>
	
    <div class="comment-content">
		<?php comment_text() ?>
	</div>

	<?php

	if ($args['type'] == 'all' || get_comment_type() == 'comment') :
	
		comment_reply_link(array_merge($args, array(
		'reply_text' => __('Reply','netfunktheme'),
		'login_text' => __('Login to reply.', 'netfunktheme'),
		'depth' => $depth,
		'before' => '<div class="comment-reply-link">',
		'after' => '</div>'
		)));
	endif;
}


/* netfunktheme commenter link */
function netfunktheme_commenter_link() {

	$commenter = get_comment_author_link();

	if ( preg_match( '/<a[^>]* class=[^>]+>/', $commenter ) ) {
		$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
	} 
	else {
		$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
	}
	
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}


/* text widget filter */
function exam_plug_text_replace($text) {
 
 $open = '<div class="small-12 columns">';
 $close = '</div>';
 
 return  $open . $text . $close;
 
}
//add_filter('widget_text', 'exam_plug_text_replace');



/* netfunktheme breadcrumbs */
function netfunktheme_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = '%s'; // text for a category page
	$text['search']   = 'Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' '; // delimiter between crumbs
	$before         = '<span class="current show-for-medium-up">'; // tag before the current crumb
	$after          = '</span> &nbsp; '; // tag after the current crumb

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_front_page()) {
		
		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
	
	} else {
		
		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} 

/* "SMART" Stuff  

# What we mean by "smart" is that we attempt to take information 
# from the post content and format it in a more exciting way and 
# without much need for shortcodes or additional programming.

# If the post contains any number of the objects indcluding: 
# images, urls, video links, soundcloud or audio urls; we attempt 
# to manage content acordingy, formattnig and re-arranging,
# the page in a unified and ultimatly more expressive way.

# note: we hope to add smart "icons" for content previews
# to display any contained content from the post.

*/

/* netfunktheme "smart" capture page image */
function netfunktheme_catch_page_image($content) {
  global $page, $pages;
  $splash_img = '';
  ob_start();
  ob_end_clean();

  if ( has_post_thumbnail() ) {
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'full');
    $splash_img = $image_url[0];
  } else {
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    if (isset($matches [1][0]))
      $splash_img = $matches [1][0];
    if (empty($splash_img)) //Defines a default image
      $splash_img = get_stylesheet_directory_uri() . "/images/default-splash.jpg";
  }
  return $splash_img;
}

/* netfunktheme "smart" capture post image */
function netfunktheme_catch_post_image($post="") {

  global $post, $posts;
  $splash_img = '';
  ob_start();
  ob_end_clean();

  if ( has_post_thumbnail() ) {
    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $splash_img = $image_url[0];
  } else {
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1][0]))
      $splash_img = $matches [1][0];
    if (empty($splash_img)) //Defines a default image
      $splash_img = get_stylesheet_directory_uri() . "/images/default-splash.jpg";
  }
  return $splash_img;
}

/* netfunktheme "smart" content stipper */
function netfunktheme_content_strip_objects( $postOutput ) {
   $postOutput = preg_replace('/<a[^>]+./','', $postOutput);
   $postOutput = preg_replace('/<img[^>]+./','', $postOutput);
   $postOutput = preg_replace('/<iframe[^>]+./','', $postOutput);
   $postOutput = preg_replace('/\[soundcloud[^\]]+./','', $postOutput);
   return $postOutput;
}

/* netfunktheme "smart" image stipper */
function netfunktheme_remove_image( $content ) {
   $postOutput = preg_replace('/<img[^>]+./','', $content);
   return $postOutput;
}

/* netfunktheme "smart" length */
function netfunktheme_get_words($text, $limit) {
	$array = explode(" ", $text, $limit+1);
	if (count($array) > $limit) {
		unset($array[$limit]);
	}
	return implode(" ", $array);
}


/* netfunktheme "smart" featured content */

/* netfunk splash image shortcode */

//add_shortcode( 'myshortcode', 'my_shortcode_handler' );  ~ helper comment

function splash_img_callback( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'top' => 'top',
		'align' => 'center',
	), $atts ) );
	
	return '<span class="splash '.$top.' '.$align.'">' . $content . '</span>';

}
add_shortcode( 'splash', 'splash_img_callback' );

/* netfunktheme splash image disaply */
function netfunktheme_get_pages_splash($per_page=4,$offset=0,$page_id,$height=400){

	global $page, $pages;

?>

<div class="slideshow-wrapper"<?php echo ' style="height:' . $height .'px; min-height:' . $height .'px;" ' ?>>

	<!--div class="preloader"></div-->

    	<ul data-orbit data-options="animation:slide;animation_speed:800;pause_on_hover:true;resume_on_mouseout:true;slide_number:false;animation_speed:500;navigation_arrows:true;bullets:false;variable_height:true;">
     
        <?php

        $mypages = get_pages();
    
		$n = 1;
	
        foreach ( $mypages as $page ) : 

            $image = netfunktheme_catch_page_image( $page->post_content );

			if ($page_id == $page->ID){
		
        ?>
        
            <li data-orbit-slide="headline-<?php echo $n ?>" style="background-image: url('<?php echo $image ?>')">

				<div class="orbit-caption">

					<div class="row">

						<div class="large-12 column">

                            <?php edit_post_link( __( '<i class="fa fa-pencil"></i> &nbsp; Edit This Page', 'netfunktheme' ), '<div class="button secondary round tiny edit-link" style="margin-top: 20px;">', '</div>' ) ?>

							<h2><?php echo $page->post_title ?></h2>

                        </div>
                    
                    </div>

                </div>


            </li>

      	<?php 
        
			}
		
			$n ++;
		
        endforeach; 
        
        ?>
    
    </ul>

</div>

<?php

}


/* netfunktheme "smart" featured content */
function netfunktheme_get_large_featured($per_page=4,$offset=0,$category_id=0,$height=400){

	global $post, $posts, $page, $pages;

?>

<div class="slideshow-wrapper"<?php echo ' style="height:' . $height .'px; min-height:' . $height .'px; overflow: hidden;" ' ?>>

	<div class="preloader"></div>

    	<ul data-orbit data-options="animation:slide;animation_speed:800;pause_on_hover:true;resume_on_mouseout:true;slide_number:false;animation_speed:500;navigation_arrows:true;bullets:false;variable_height:true;">
     
      <?php
    
        $args = array( 'posts_per_page' => $per_page, 'offset'=> $offset, 'category' => $category_id ); // FEATURED CATEGORY - HARD CODED
        
        $myposts = get_posts( $args );
    
		$n = 1;
	
        foreach ( $myposts as $post ) : 
		
			setup_postdata( $post ); 
            
            $image = netfunktheme_catch_post_image();
        
            $content = get_the_content();
        
      ?>
        
            <li data-orbit-slide="headline-<?php echo $n ?>" style="background-image: url('<?php echo $image ?>')">
        
                <!--img src="<?php //echo $image ?>" style="opacity: 0;"/-->
    
                <div class="orbit-caption">

					<div class="row">

						<div class="large-12">

                            <h2><?php the_title() ?></h2>
            
                            <p><?php echo wp_trim_words(netfunktheme_content_strip_objects($content),30, '...') ?></p>
        
                            <a href="<?php the_permalink(); ?>" class="button small radius">Read More</a>
    
                        </div>
                    
                    </div>

                </div>

            </li>

      <?php 
        
			$n ++;
		
        endforeach; 
        
        wp_reset_postdata();
        
        ?>
    
    </ul>

</div>

<?php

}


/* netfunktheme author page info */
function netfunktheme_author_page_info() {
	$user_id = get_the_author_meta( 'ID' );
	if ( get_the_author_meta( 'description' ) || get_the_author_meta( 'netfunktheme_about' ) ) { 
		$user_description1 = ( get_the_author_meta('netfunktheme_about') != '' ? get_the_author_meta('netfunktheme_about') : get_the_author_meta('description') );
		$user_description2 = ( get_the_author_meta('netfunktheme_more_about') != '' ? get_the_author_meta('netfunktheme_more_about') : '' );
	?>
    	<div class="large-3 small-12 left author-avatar">
		<?php
            /* Author Image */
			do_action('netfunktheme_author_image', $atts = array('user_id'=>$user_id,'size'=>240));
        ?>
        </div>
        <br class="clear" /> 
        <br />
        <br />
        <div class="author-description">
            <h4><?php printf( __( 'About %s', 'netfunktheme' ), get_the_author() ); ?></h4>
			<div class="panel radius">
            <p><?php echo $user_description1 ?></p>
            <?php echo ($user_description2 != '' ? '<p>'.$user_description2.'</p>' : '') ?>
            <?php if (get_page_by_title('Contact Us') || get_page_by_title('Contact') || get_page_by_title('contact')){  ?>
                <br />
                <a href="<?php echo home_url() . '/contact/' ?>" class="button small radius success right">
                <?php printf( __( ' Contact %s', 'netfunktheme' ), get_the_author() ); ?>
                </a>
            <?php } ?>
			<br class="clear" />
			</div>
        </div>
    <?php
	}
}
add_action('netfunktheme_author_page_info', 'netfunktheme_author_page_info',1,0);

/* netfunktheme author avatar */
function netfunktheme_author_avatar($atts){
	
	extract( shortcode_atts( array(
		'user_id' => '0',
		'size' => '96'
	), $atts ) );
	
	$default = '/images/avatar.jpg';
	echo get_avatar( $atts['user_id'], $atts['size'], $default );

}
add_action('netfunktheme_author_image','netfunktheme_author_avatar',1,1);

/* netfunktheme about the author panel */
function netfunktheme_about_the_author (){
	$user_id = get_the_author_meta( 'ID' );
    $user_description1 = ( get_the_author_meta('netfunktheme_about') ? get_the_author_meta('netfunktheme_about') : get_the_author_meta('description') );
	?>
    <hr />
    <div class="small-12 hide-for-small">
        <div class="netfunktheme_author_info">
        <h3>About The Author</h3>
        <div class="small-12 columns">
            <div class="large-2 small-12 columns left center-for-small netfunktheme_author_avatar">
            <?php do_action('netfunktheme_author_image', $atts = array('user_id'=>$user_id,'size'=>150));  ?>
            </div><!-- .author-avatar -->
            <div class="large-10 small-12 columns right author-description netfunktheme_about_card">
                <h6><?php printf( __( '%s', 'netfunktheme' ), get_the_author() ); ?></h6>
                <p><?php echo $user_description1 ?></p>
                <?php if (get_page_by_title('Contact Us') || get_page_by_title('Contact') || get_page_by_title('contact')){  ?>
                    <a href="<?php echo home_url() . '/contact/' ?>">
                    <?php printf( __( ' Contact %s', 'netfunktheme' ), get_the_author() ); ?>
                    </a>
                <?php } ?>
                <a href="<?php echo home_url() . '/author/'.get_the_author_meta('user_nicename',$user_id) ?>" class="button small radius success right">More About the Author</a>
            </div><!-- .author-description	-->
            <br class="clear" />
        </div>
        </div><!-- .author-info -->
        <br class="clear" />
    </div>
<?php
}
add_action('netfunktheme_about_the_author','netfunktheme_about_the_author',1,0);

/* register netfunktheme javascript  */
function  netfunktheme_register_js() {
	if (!is_admin()) {
		wp_register_script('foundation-script', get_template_directory_uri() . '/foundation5/js/foundation.min.js', array('jquery'), 'jquery', '', false);
		wp_register_script('foundation-orbit-script', get_template_directory_uri() . '/foundation5/js/foundation/foundation.orbit.js', array('jquery'), 'jquery', '', false);
		wp_register_script('foundation-equalizer-script', get_template_directory_uri() . '/foundation5/js/foundation/foundation.equalizer.js', array('jquery'), 'jquery', '', false);
		wp_register_script('foundation-reveal-script', get_template_directory_uri() . '/foundation5/js/foundation/foundation.reveal.js', array('jquery'), 'jquery', '', false);
		wp_register_script('foundation-tooltip-script', get_template_directory_uri() . '/foundation5/js/foundation/foundation.tooltip.js', array('jquery'), 'jquery', '', false);
		wp_register_script('modernizr-script', get_template_directory_uri() . '/foundation5/js/vendor/modernizr.js', array('jquery'), 'jquery', '', false);
		wp_register_script('fastclick-script', get_template_directory_uri() . '/foundation5/js/vendor/fastclick.js', array('jquery'), 'jquery', '', false);
		wp_enqueue_script('jquery');
		wp_enqueue_script('foundation-script');
		wp_enqueue_script('foundation-orbit-script');
		wp_enqueue_script('foundation-equalizer-script');
		wp_enqueue_script('foundation-reveal-script');
		wp_enqueue_script('foundation-tooltip-script');
		wp_enqueue_script('modernizr-script');
		wp_enqueue_script('fastclick-script');
	}
}
add_action('wp_enqueue_scripts', 'netfunktheme_register_js');

/* netfunktheme custom javascript (header) */
if (!function_exists( 'netfunktheme_custom_javascript_top')){
	function netfunktheme_custom_javascript_top() {
		global $script_options;
		if (isset($script_options['javascript_top']))
		echo '<script type="text/javascript">'
		. $script_options['javascript_top']
		. '</script>';
	}
}
add_action('wp_head', 'netfunktheme_custom_javascript_top');

/* netfunktheme custom javascript (footer) */
if (!function_exists( 'netfunktheme_custom_javascript_bottom')){
	function netfunktheme_custom_javascript_bottom() {
		global $script_options;
		if (isset($script_options['javascript_bottom']))
		echo '<script type="text/javascript">'
		. $script_options['javascript_bottom']
		. '</script>';
	}
}
add_action('wp_footer', 'netfunktheme_custom_javascript_bottom');

/* register netfunktheme css  */
function netfunktheme_theme_styles() {
	wp_register_style( 'normalize', get_template_directory_uri() . '/foundation5/css/normalize.css' );
	wp_register_style( 'superfish', get_template_directory_uri() . '/css/superfish.css' );
	wp_register_style( 'foundation', get_template_directory_uri(). '/foundation5/css/foundation.css' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_register_style( 'web-icons', get_template_directory_uri() . '/css/webicons.css' );
	wp_register_style( 'web-fonts', get_template_directory_uri() . '/css/fonts/stylesheet.css' );
	wp_register_style( 'theme-css', get_template_directory_uri() . '/style.css' );
	
	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'superfish' );
	wp_enqueue_style( 'foundation' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'web-icons' );
	wp_enqueue_style( 'web-fonts' );
	wp_enqueue_style( 'theme-css' );
	
}
add_action('wp_print_styles', 'netfunktheme_theme_styles');

/* netfunktheme cutom css action */
if (!function_exists( 'netfunktheme_custom_css')){
	function netfunktheme_custom_css() {
		global $script_options;
		if (isset($script_options['custom_css']))
		echo '<style type="text/css">'
		. $script_options['custom_css']
		. '</style>';
	}
}
add_action('wp_head', 'netfunktheme_custom_css');


/* register netfunktheme widgets (widgets.php) */
function netfunktheme_widgets_addon() {
	register_widget('Netfunk_Featured_Pages');
	register_widget('Netfunk_Labels_Info');
	register_widget('Netfunk_Homepage_Categories');
	register_widget('Netfunk_Categories_Widget');
}
add_action('widgets_init', 'netfunktheme_widgets_addon', 1);

/* register netfunktheme sidebars */
function netfunktheme_widgets_init() {
	
	// LEFT SIDEBAR
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'netfunktheme' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'netfunktheme' ),
		'before_widget' => '<li id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',));
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'netfunktheme' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'netfunktheme' ),
		'before_widget' => '<li id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',));
	register_sidebar( array(
		'name' => __( 'Action Page Sidebar', 'netfunktheme' ),
		'id' => 'action-widget-area',
		'description' => __( 'Action pages widget area', 'netfunktheme' ),
		'before_widget' => '<li id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',));
	
	// CONTENT SIDEBARS
	register_sidebar( array(
		'name' => __( 'Front Page Content Widgets', 'netfunktheme' ),
		'id' => 'home-primary-widget-area',
		'description' => __( 'Front page content widget area.', 'netfunktheme' ),
		'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="home-title"><div class="row"><h2 class="widget-title">',
		'after_title' => '</h2></div></div>',));
	register_sidebar( array(
		'name' => __( 'Page Bottom Content Widgets', 'netfunktheme' ),
		'id' => 'home-bottom-widget-area',
		'description' => __( 'Bottom of page content widget area', 'netfunktheme' ),
		'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',));
	
	
	// FOOTER SIDEBARS
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'netfunktheme' ),
		'id' => 'footer-widget-area',
		'description' => __( 'Footer widget area', 'netfunktheme' ),
		'before_widget' => '<li id="%1$s" class="small-4 left widget-content %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',));
}
add_action( 'widgets_init', 'netfunktheme_widgets_init' );



// EOF