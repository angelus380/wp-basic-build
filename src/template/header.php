<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php

# site infor
$site_name        = get_field( 'site_name', false );
$site_description = get_field( 'site_description', false );
$site_img         = get_field( 'site_img', false );
$site_color       = get_field( 'site_color' );

# site info fallback
if ( empty( $site_name ) )
  $site_name = get_bloginfo( 'name' );

if ( empty( $site_description ) )
  $site_description = get_bloginfo( 'description' );

if ( empty( $site_img ) )
  $site_img = get_template_directory_uri().'/screenshot.png'; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width" >
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

  <meta property="og:title" content="<?php echo $site_name; ?>" />
  <meta name="description" content="<?php echo $site_description; ?>" />
  <meta property="og:description" content="<?php echo $site_description; ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo get_permalink(); ?>" />
  <meta property="og:image" content="<?php echo $site_img; ?>"/>

	<title><?php echo $site_name; ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>