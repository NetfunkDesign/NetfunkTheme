<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title(' | ', true, 'right'); echo " - " . get_bloginfo('description'); ?></title>
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800" rel="stylesheet" type="text/css">
<link rel="icon" href="favicon-16.png?v=1.5" sizes="16x16"> 
<link rel="icon" href="favicon-32.png?v=1.5" sizes="32x32"> 
<link rel="icon" href="favicon-48.png?v=1.5" sizes="48x48">
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

<header>

  <div class="contain-to-grid sticky clearfix">

    <nav class="top-bar" data-topbar data-options="sticky_on: large">

      <ul class="title-area">

        <li class="logo-icon small-only-text-center">
          <?php 
			$header_image = get_header_image();
            if ( ! empty( $header_image ) ) { ?>
                <div id="logo" class="left"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                </a></div>
            <?php } else { ?>
                    <div id="logo2"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( 'name' ); ?></a></div><!--logo end-->
            <?php } ?>
        </li>

        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->

        <!--li class="toggle-topbar menu-icon">
          <a href="#"><span></span></a>
        </li-->

      </ul>

      <section class="top-bar-section hide-for-small">

        <!-- right nav section -->
		<?php do_action('netfunktheme_navigation_menu'); ?>

        <!-- left vav section -->
        <?php do_action ('netfunktheme_user_menu') ?>

      </section>

    </nav>
    
    <?php do_action ('netfunktheme_responsive_nav') ?>

  </div><!-- top-bar -->

</header>
