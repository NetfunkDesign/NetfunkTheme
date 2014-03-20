<?php

/*
Template Name: Home Page
*/

?>

<?php get_header(); ?>

<?php if(is_front_page()) { ?>

<div id="container" class="row featured featured-picks">

<!-- featured content slideshow -->

<div class="small-12 show-for-medium-up">

<?php netfunktheme_get_large_featured($per_page=6,$offset=0,$category_id=1); ?>

</div><!-- featured content slideshow -->

<div id="blackoutTrigger"></div>

<!-- featured categories -->

<div class="home-title show-for-medium-up">

<div class="row featured-releases">

<div class="large-4 left">

<h1><img alt="Welcome to Breaks Culture" src="/wp-content/themes/netfunktheme/images/breaks-culture-logo-wide.png"></img></h1>

</div>

<div class="large-8 right show-for-medium-up">

<a href="/category/releases/" class="button secondary tiny round right" style="margin-right: 40px;">More Releases</a>

<div class="page-title"><a href="/category/releases/">New Breaks Music Releases</a></div>

</div>

</div>

</div>

<div class="row featured-releases show-for-medium-up">

<div class="large-4 columns left">

<div class="small-12 columns">

<h3>Weclome to Breaks Culture</h3>

<p class="welcome-text">

A resource for Breakbeats, Electro Breaks, Nuskool, Drum n Bass, Jungle, Dubstep, Drumstep, Glitch-Hop and more. 

Search breakbeat music events world wide and source new and unreleased music for your next gig or mixset. 

If it's dope and the beat breaks, we'll blog about it!

</p>

</div>

<br />

<div class="small-12 columns">

<a href="/about/" class="button success medium radius expand">More About Us</a>

</div>

<div class="small-12 columns text-center follow-us-block">

<div class="follow-text">follow us:</div>

<a href="http://soundcloud.com/groups/breaks-culture" class="webicon large soundcloud" target="_blank" title="Listen to BreaksCulture group on Soundcloud">Listen BreaksCulture group on Soundcloud</a>

<a href="https://twitter.com/breaks_culture" class="webicon large twitter" target="_blank" title="Follow BreaksCulture on Twitter">Follow BreaksCulture on Twitter</a>

<a href="http://www.facebook.com/netfunktheme" class="webicon large facebook" target="_blank" title="Like BreaksCulture on Facebook">Like BreaksCulture on Facebook</a>

<a href="/feed/" class="webicon large rss" target="_blank" title="netfunkdesign.com RSS">netfunkdesign.com RSS</a>

</div>

</div>

<div class="large-8 columns right" style="margin-bottom: 20px;">

<?php netfunktheme_get_categories($per_page=4,$offset=0,$category_id=8,$grid_size=3,"") ?>

</div>

<h6> &nbsp; &nbsp; More New Releases </h6>

<div class="large-8 columns right" style="margin-bottom: 20px;">

<?php netfunktheme_get_categories_image($per_page=6,$offset=4,$category_id=8,$grid_size=2,"") ?>

</div>

</div>

<div class="row featured-releases show-for-small">

<div class="small-12 columns">

<h3>Weclome to Breaks Culture</h3>

<p class="welcome-text">

A resource for Breakbeats, Electro Breaks, Nuskool, Drum n Bass, Jungle, Dubstep, Drumstep, Glitch-Hop and more. 

Search breakbeat music events world wide and source new and unreleased music for your next gig or mixset. 

If it's dope and the beat breaks, we'll blog about it!

</p>

</div>

<br />

<div class="small-12 columns text-right">

<a href="/about/" class="button success small radius">More About Us</a>

</div>

</div>

<div class="show-for-small">

<div class="home-title">

<div class="page-title">

<a href="/category/releases/">New Breaks Music Releases</a>

</div>

</div>

<div class="row small-12 columns" style="margin-bottom: 20px;">

<?php netfunktheme_get_categories($per_page=4,$offset=0,$category_id=8,$grid_size=3,"") ?>

</div>

</div><!-- show-for-small -->

<div class="row">

<div class="row text-center adsense hide-for-small">

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BreaksCulture - RespoAds -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3971469745981874"
     data-ad-slot="1142330486"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>

<br />

<!-- Home Page Midway (1) Content Widgets -->

<?php if ( is_active_sidebar( 'home-midway-1-widget-area' ) ) : ?>

<div class="large-3 small-12 columns left">

<div class="home-widget home-midway-1-widget-area">

<?php if ( ! dynamic_sidebar( 'home-midway-1-widget-area' ) ) : ?>

<h4> You need to add a widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

</div>

<?php endif; ?>

<!-- Home Page Midway (2) Content Widgets -->

<?php if ( is_active_sidebar( 'home-midway-2-widget-area' ) ) : ?>

<div class="large-3 columns left">

<div class="home-widget home-midway-2-widget-area">

<?php if ( ! dynamic_sidebar( 'home-midway-2-widget-area' ) ) : ?>

<h4> You need to add a widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

</div>

<?php endif; ?>

<!-- Home Page Midway (3) Content Widgets -->

<?php if ( is_active_sidebar( 'home-midway-3-widget-area' ) ) : ?>

<div class="large-3 columns left">

<div class="home-widget home-midway-3-widget-area">

<?php if ( ! dynamic_sidebar( 'home-midway-3-widget-area' ) ) : ?>

<h4> You need to add a widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

</div>

<?php endif; ?>


<!-- Home Page Midway (4) Content Widgets -->

<?php if ( is_active_sidebar( 'home-midway-4-widget-area' ) ) : ?>

<div class="large-3 columns left">

<div class="home-widget home-midway-4-widget-area">

<?php if ( ! dynamic_sidebar( 'home-midway-4-widget-area' ) ) : ?>

<h4> You need to add a widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

</div>

<br class="clear" />

<?php endif; ?>

</div>

<!-- Home Page Bottom Content Widgets -->

<?php if ( is_active_sidebar( 'home-bottom-widget-area' ) ) : ?>

<div class="large-12">

<div class="small-12 home-widget home-bottom-widget-area">

<?php if ( ! dynamic_sidebar( 'home-bottom-widget-area' ) ) : ?>

<h4> You need to add some widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

</div>

<?php endif; ?>

</div><!-- row -->

<?php } ?> 

<?php get_footer(); ?>
