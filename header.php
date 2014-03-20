<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta content="width=device-width" name="viewport">
<title><?php wp_title(' | ', true, 'right'); echo " - " . get_bloginfo('description'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php //echo get_stylesheet_uri(); ?>" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800" rel="stylesheet" type="text/css">
<link rel="icon" href="favicon-16.png?v=1.5" sizes="16x16"> 
<link rel="icon" href="favicon-32.png?v=1.5" sizes="32x32"> 
<link rel="icon" href="favicon-48.png?v=1.5" sizes="48x48">
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

<header>

    <div class="row">
    
        <div class="small-12 columns" id="site-title">
        
            <?php 
			
			$header_image = get_header_image();
        
            if ( ! empty( $header_image ) ) { ?>
                <div id="logo" class="left"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                </a></div><!--logo -->
        
            <?php } else { ?>
                    <div id="logo2"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( 'name' ); ?></a></div><!--logo end-->
            <?php } ?>
        
        </div>
        
        <nav class="small-12 columns hide-for-small">
            
            <div class="large-8 left" id="menu_container" >
               <?php do_action('netfunktheme_navigation_menu'); ?>
            </div>
        
            
            <?php //wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            
            <div class="large-4 right text-right" id="menu_container" >
                <?php do_action ('netfunktheme_user_menu') ?>
            </div>
            
        </nav><!--top menu-->

        <?php do_action ('netfunktheme_responsive_nav') ?>
        
    </div> <!--row -->

</header>
