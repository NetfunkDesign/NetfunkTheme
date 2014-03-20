<?php

/*
Template Name: Home Page
*/

?>

<?php get_header(); ?>

<div id="container" class="featured featured-picks">

<div class="small-12 show-for-medium-up featured-slideshow">

<?php netfunktheme_get_large_featured($per_page=6,$offset=0,$category_id=1); ?>

</div><!-- featured content slideshow -->

<div id="blackoutTrigger"></div><!-- menu blackout -->

<div class="small-12 text-center adsense-split">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- BreaksCulture - RespoAds -->
    <ins class="adsbygoogle netfunktheme-respoads"
         style="display:inline-block"
         data-ad-client="ca-pub-3971469745981874"
         data-ad-slot="1142330486"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div><!-- googe adsense -->

<div class="row show-for-medium-up">
    <div class="small-12 columns featured-releases">
    	<div class="large-4 left">
        	&nbsp;
        </div>
        <div class="large-8 right show-for-medium-up">
            <a href="/category/releases/" class="button secondary tiny round right" style="margin-top: 20px;">More Releases</a>
        	<h2 class="page-title">New Breaks Music Releases</h2>
        </div>
    </div>
</div>

<div class="row show-for-medium-up featured-releases">
    <div class="large-4 columns left">
        <div class="small-12 columns">
            <h3>Welcome to Breaks Culture</h3>
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
            <br />
            <br />
            <div class="follow-text"><strong>Keep up with us:</strong></div>
            <br />
            <a href="http://soundcloud.com/groups/breaks-culture" class="webicon large soundcloud" target="_blank" title="Listen to BreaksCulture group on Soundcloud">Listen BreaksCulture group on Soundcloud</a>
            <a href="https://twitter.com/breaks_culture" class="webicon large twitter" target="_blank" title="Follow BreaksCulture on Twitter">Follow BreaksCulture on Twitter</a>
            <a href="http://www.facebook.com/netfunktheme" class="webicon large facebook" target="_blank" title="Like BreaksCulture on Facebook">Like BreaksCulture on Facebook</a>
            <a href="/feed/" class="webicon large rss" target="_blank" title="netfunkdesign.com RSS">netfunkdesign.com RSS</a>
        </div>
    </div>
    
    <div class="large-8 columns right" style="margin-bottom: 20px;">
    	<?php netfunktheme_get_categories($per_page=4,$offset=0,$category_id=8,$grid_size=3,"") ?>
    </div><!-- featured categories -->
    
    <h6> &nbsp; &nbsp; <strong>More New Releases</strong> </h6>
    
    <div class="large-8 columns right" style="margin-bottom: 20px;">
    	<?php netfunktheme_get_categories_image($per_page=6,$offset=4,$category_id=8,$grid_size=2,"") ?>
    </div><!-- more featured categories -->

</div>

<div class="row featured-releases show-for-small">
    <div class="small-12 columns">
    
    <h3>Welcome to Breaks Culture</h3>
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

<div class="small-12 columns show-for-small">

    <h2 class="page-title">New Breaks Music Releases</h2>
    
    <div class="row small-12 columns">
    
    	<?php netfunktheme_get_categories($per_page=4,$offset=0,$category_id=8,$grid_size=3,"") ?>
    
    </div>

</div><!-- show-for-small -->

<!-- Page Bottom Content -->

<?php if ( is_active_sidebar( 'home-bottom-widget-area' ) ) : ?>

<div class="home-bottom-content">

<?php if ( ! dynamic_sidebar( 'home-bottom-widget-area' ) ) : ?>

<h4> You need to add some widgets... </h4>

<?php endif; // end primary widget area ?>

<br class="clear" />

</div>

<?php endif; ?>

</div>

<?php get_footer(); ?>
