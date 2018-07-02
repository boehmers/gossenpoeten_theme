<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gossenpoeten_theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8&appId=1462055033817868";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<div id="page" class="site">

    <header id="masthead" class="site-header" role="banner">
        <div class="col-xs-9 musicMenu" style="text-align: right;">
            <ul class="social-network social-circle">
                <li>
                    <a class="icoSpotify" title="Spotify" style="display: inline-block;"
                    href="http://bit.ly/poetenNahAnSpotify" target="_blank">
                        <i class="fa fa-spotify"></i></a>
                </li>
                <li>
                    <a class="icoAmazon" title="Amazon" style="display: inline-block;"
                    href="http://bit.ly/poetenNahAnAmazon" target="_blank">
                        <i class="fa fa-amazon"></i></a>
                </li>
                <li>
                    <a class="icoItunes" title="iTunes" style="display: inline-block;"
                    href="http://bit.ly/poetenNahAmApfel" target="_blank">
                        <i class="fa fa-apple"></i></a>
                </li>
            </ul>
        </div>
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img class="header-image" src="<?php echo get_template_directory_uri(); ?>/images/gossenpoeten-logo.png"/>
        </a>
        <nav role="navigation" id="navbar-main">
            <div class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-responsive-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <?php gossenpoeten_theme_the_custom_logo(); ?>

                    </div>

                    <div class="navbar-collapse collapse navbar-responsive-collapse">
                        <?php
                        $args = array(
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => 'nav navbar-nav',
                            'walker' => new Bootstrap_Walker_Nav_Menu()
                        );
                        if (has_nav_menu('primary')) {
                            wp_nav_menu($args);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </nav>
    </header><!-- #masthead -->

    <div id="content" class="site-content" style="width: 100%">
        <div class="container">