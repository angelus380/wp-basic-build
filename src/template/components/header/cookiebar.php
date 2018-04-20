<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php

# cookiebar fields
$message       = cookiebar_translation( 'cookiebar_message' );
  if ( !empty( $message ) ) $message = 'message: "'.$message.'",';
$dismiss       = cookiebar_translation( 'cookiebar_text' );
  if ( !empty( $dismiss ) ) $dismiss = 'dismiss: "'.$dismiss.'",';
$position      = get_field( 'cookiebar_position', 'option' );
  if ( !empty( $position ) ) $position = 'position: "'.$position.'",';
$theme         = get_field( 'cookiebar_theme', 'option' );
  if ( !empty( $theme ) ) $theme = 'theme: '.$theme.',';
$banner_color  = get_field( 'cookiebar_banner_color', 'option' );
  if ( !empty( $banner_color ) ) $banner_color = 'background: "'.$banner_color.'",';
$message_color = get_field( 'cookiebar_message_color', 'option' );
  if ( !empty( $message_color ) ) $message_color = 'text: "'.$message_color.'",';
$text_color    = get_field( 'cookiebar_text_color', 'option' );
  if ( !empty( $text_color ) ) $text_color = 'text: "'.$text_color.'",';
$is_static     = get_field( 'cookiebar_is_static', 'option' );
  if ( !empty( $is_static ) ) $is_static = 'static: true,';
$show_link     = get_field( 'cookiebar_show_link', 'option' );
  if ( $show_link ) {
    $href      = get_field( 'cookiebar_url', 'option' );
      if ( !empty( $href ) ) $href = 'href: "'.esc_url( $href ).'",';
    $link      = cookiebar_translation( 'cookiebar_policy_text' );
      if ( !empty( $link ) ) $link = 'link: "'.$link.'",';
  }
  else {
    $hide_link = 'showLink: false,';
  }
$show_color    = get_field( 'cookiebar_show_color', 'option' );
  if ( $show_color ) {
    $btn_color = get_field( 'cookiebar_btn_color', 'option' );
      if ( !empty( $btn_color ) ) $btn_color = 'background: "'.$btn_color.'",';
  }
  else {
    $btn_color = 'background: "transparent",'; 
  }
$show_border   = get_field( 'cookiebar_show_border', 'option' );
  if ( $show_border ) {
    $border    = get_field( 'cookiebar_border_color', 'option' );
      if ( !empty( $border ) ) $border = 'border: "'.$border.'",';
  }

# cookiebar script
?>
<script type="text/javascript">
	
function cookiebar() {
  window.addEventListener( "load", function() {
  window.cookieconsent.initialise({
    type: 'info',
    palette: {
      popup: {
        <?php
          echo $banner_color;
          echo $message_color;
        ?>

      },
      button: {
        <?php
          echo $btn_color;
          echo $text_color;
          echo $border;
        ?>
      },
    },
    content: {
      <?php
        echo $message;
        echo $dismiss;
        echo $href;
        echo $link;
      ?>

    },
    <?php
      echo $position;
      echo $is_static;
      echo $theme;
      echo $hide_link;
    ?>

  })});

} cookiebar();

</script>