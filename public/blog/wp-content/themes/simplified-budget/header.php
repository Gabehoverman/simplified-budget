<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>
<div
<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?></a>
	<?php
	astra_header_before();

	// astra_header();

    /** Begin Header */

    ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="../jjs/app.js" defer></script>

    <!-- Libs CSS -->
    <link rel="stylesheet" href="./fonts/feather/feather.min.css">
    <link rel="stylesheet" href="./libs/highlight.js/styles/vs2015.css">
    <link rel="stylesheet" href="..'/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="../libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../libs/flatpickr/dist/flatpickr.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../css/theme.min.css" id="stylesheetLight">

    <link rel="stylesheet" href="../css/theme-dark.min.css" id="stylesheetDark">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">

  </head>

  <div class="navbar-container " style="min-height: 72px;">
    <nav class="navbar navbar-expand-lg justify-content-between navbar-light border-bottom-0 bg-white position-fixed"
        data-sticky="top">
        <div class="container">
            <div class="col flex-fill px-0 d-flex justify-content-between">
                <a class="navbar-brand mr-0 fade-page" href="{{ route('web') }}">
                    <img src="{{ asset('/img/logo2-01.png') }}" width="125px" alt="Leap">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        class="injected-svg icon navbar-toggler-open" data-src="assets/img/icons/interface/menu.svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M3 17C3 17.5523 3.44772 18 4 18H20C20.5523 18 21 17.5523 21 17V17C21 16.4477 20.5523 16 20 16H4C3.44772 16 3 16.4477 3 17V17ZM3 12C3 12.5523 3.44772 13 4 13H20C20.5523 13 21 12.5523 21 12V12C21 11.4477 20.5523 11 20 11H4C3.44772 11 3 11.4477 3 12V12ZM4 6C3.44772 6 3 6.44772 3 7V7C3 7.55228 3.44772 8 4 8H20C20.5523 8 21 7.55228 21 7V7C21 6.44772 20.5523 6 20 6H4Z"
                            fill="#212529"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        class="injected-svg icon navbar-toggler-close"
                        data-src="assets/img/icons/interface/cross.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M16.2426 6.34311L6.34309 16.2426C5.95257 16.6331 5.95257 17.2663 6.34309 17.6568C6.73362 18.0473 7.36678 18.0473 7.75731 17.6568L17.6568 7.75732C18.0473 7.36679 18.0473 6.73363 17.6568 6.34311C17.2663 5.95258 16.6331 5.95258 16.2426 6.34311Z"
                            fill="#212529"></path>
                        <path
                            d="M17.6568 16.2426L7.75734 6.34309C7.36681 5.95257 6.73365 5.95257 6.34313 6.34309C5.9526 6.73362 5.9526 7.36678 6.34313 7.75731L16.2426 17.6568C16.6331 18.0473 17.2663 18.0473 17.6568 17.6568C18.0474 17.2663 18.0474 16.6331 17.6568 16.2426Z"
                            fill="#212529"></path>
                    </svg>
                </button>
            </div>
            <div class="collapse navbar-collapse nav-fill px-0 px-lg-2 flex-fill">
                <div class="py-2 py-lg-0">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a href="{{ route('web') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('web.about') }}" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('web.features') }}" class="nav-link">Our Features</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('web.pricing') }}" class="nav-link">Our Pricing</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('web') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('login') }}" class="nav-link">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="collapse navbar-collapse justify-content-end col flex-fill px-0"><a
                    href="{{ route('register') }}"
                    class="btn btn-primary ml-lg-3">Sign Up</a>
            </div>
        </div>
    </nav>
</div>


  <?php

	astra_header_after();

	astra_content_before();
	?>
	<div id="content" class="site-content">
		<div class="ast-container">
		<?php astra_content_top(); ?>
