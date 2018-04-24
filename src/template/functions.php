<?php if ( ! defined( 'ABSPATH' ) ) exit; # Exit if accessed directly

#------------------#
# PRODUCTION FILES #
#------------------#

function get_css_files() {

  wp_enqueue_style( 'roboto-font',
    'https://fonts.googleapis.com/css?family=Roboto:100,400,700', false );
  wp_enqueue_style( 'cookieconsent', 
    'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css' );
  wp_enqueue_style( 'materialize',
    'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css' );
  wp_enqueue_style( 'styles',
    get_template_directory_uri() . '/css/styles_v1.css' );

}
add_action( 'wp_enqueue_scripts', 'get_css_files' );

function get_js_files() {

	wp_enqueue_script( 'jquery', array(), null, true );
  // wp_enqueue_script( 'GSAP-TweenMax', # GSAP - ROBUST
  //   'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js' );
  wp_enqueue_script( 'GSAP-CSSPlugin', # GSAP - LIGHTWEIGHT
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/plugins/CSSPlugin.min.js' );
  wp_enqueue_script( 'GSAP-EasePack', # GSAP - LIGHTWEIGHT
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/easing/EasePack.min.js' );
  wp_enqueue_script( 'GSAP-TweenLite', # GSAP - LIGHTWEIGHT
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenLite.min.js' );
  // wp_enqueue_script( 'GSAP-TimeLineLite', # GSAP - TIMELINE LITE
  //   'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TimelineLite.min.js' );
  wp_enqueue_script( 'GSAP-TimeLineMax', # GSAP - TIMELINE MAX
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TimelineMax.min.js' );
  // wp_enqueue_script( 'GSAP-ScrollToPlugin', # GSAP - SCROLLTO
  //   'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/plugins/ScrollToPlugin.min.js' );
  wp_enqueue_script( 'fontawesome-js',
    'https://use.fontawesome.com/releases/v5.0.8/js/all.js' );
  wp_enqueue_script( 'cookieconsent-js',
    'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js' );
  wp_enqueue_script( 'materialize-js',
    'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js', array(), null, true );
  wp_enqueue_script( 'scripts',
    get_template_directory_uri() . '/js/scripts_v1.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'get_js_files' );

#-------------------#
# DEVELOPMENT FILES #
#-------------------#

function css_development_files() {

  wp_enqueue_style( 'cookieconsent',
    get_template_directory_uri() . '/vendor/cookieconsent/cookieconsent.min.css' );
  wp_enqueue_style( 'materialize',
    get_template_directory_uri() . '/vendor/materialize/materialize.min.css' );
  wp_enqueue_style( 'styles',
    get_template_directory_uri() . '/css/styles_v1.css' );

}
// add_action( 'wp_enqueue_scripts', 'css_development_files' );

function js_development_files() {

  wp_enqueue_script( 'jquery', array(), null, true );
  wp_enqueue_script( 'cookieconsent-js',
    get_template_directory_uri() . '/vendor/cookieconsent/cookieconsent.min.js', array(), null, true );
  wp_enqueue_script( 'materialize-js',
    get_template_directory_uri() . '/vendor/materialize/materialize.min.js', array(), null, true );
  wp_enqueue_script( 'scripts',
    get_template_directory_uri() . '/js/scripts_v1.js', array(), null, true );

}
// add_action( 'wp_enqueue_scripts', 'js_development_files' );

#--------------------#
# RENAME POSTS LABEL #
#--------------------#

function change_post_label() {
  global $menu;
  global $submenu;
  $label = 'Trabalhos';

  $menu[5][0] = $label;
  $submenu['edit.php'][5][0]  = $label;
}
 
//add_action( 'admin_menu', 'change_post_label' );

#--------------------#
# CREATE OPTION PAGE #
#--------------------#

function create_acf_options_page( $title, $slug, $children = false ) {

  if ( !empty( $children ) ) {
    acf_add_options_page( array(
      'page_title'  => $title,
      'menu_title'  => $title,
      'menu_slug'   => $slug,
      'capability'  => 'edit_posts',
      'redirect'    => true
    ));

    foreach ( $children as $name ) {
      acf_add_options_sub_page( array(
        'page_title'  => $name,
        'menu_title'  => $name,
        'parent_slug' => $slug,
      ));
    }
  }
  else {
    acf_add_options_page( array(
      'page_title'  => $title,
      'menu_title'  => $title,
      'menu_slug'   => $slug,
      'capability'  => 'edit_posts',
      'redirect'    => false
    ));
  }
}

if ( function_exists( 'acf_add_options_page' ) ) {

  acf_add_options_page();  
    acf_add_options_sub_page('General');
    // acf_add_options_sub_page('Header');
    // acf_add_options_sub_page('Footer');
}

#-------------------#
# CUSTOM POST TYPES #
#-------------------#

function p_args( $singular, $plural, $archive = true, $no_search = false ) {
  return array( 
    'labels'                => array( 
      'name'                => $plural,
      'singular_name'       => $singular,
      'menu_name'           => $plural,
      'all_items'           => 'Ver'.' '.$plural,
      'add_new_item'        => 'Adicionar'.' '.$singular,
      'add_new'             => 'Adicionar',
      'new_item'            => 'Adicionar'.' '.$singular,
      'edit_item'           => 'Editar'.' '.$singular,
      'update_item'         => 'Actualizar'.' '.$singular,
      'view_item'           => 'Visualizar'.' '.$singular,
      'view_items'          => 'Visualizar'.' '.$singular,
      'search_items'        => 'Pesquisar'.' '.$singular,
      'not_found'           => 'Não exitem'.' '.$plural,
      'not_found_in_trash'  => 'Não exitem'.' '.$plural,
    ),
    'public'                => true,
    'hierarchical'          => false,
    'has_archive'           => $archive,        # false to remove from archive page
    'exclude_from_search'   => $no_search,      # true to remove from search
  );
}

function create_post_type() {
 
  register_post_type( 'pilots', p_args( 'Piloto', 'Pilotos' ) );

}
//add_action( 'init', 'create_post_type' );

#-------------------#
# CUSTOM TAXONOMIES #
#-------------------#

function c_args( $singular, $plural, $rewrite = null ) {
  return array( 
    'labels'          => array( 
      'name'          => $plural,
      'singular_name' => $singular,
      'menu_name'     => $plural,
      'add_new_item'  => 'Adicionar',
      'add_new'       => 'Adicionar',
      'new_item'      => 'Adicionar'.' '.$singular,
      'edit_item'     => 'Editar'.' '.$singular,
      'update_item'   => 'Actualizar'.' '.$singular,
      'view_item'     => 'Visualizar'.' '.$singular,
      'view_items'    => 'Visualizar'.' '.$singular,
      'search_items'  => 'Pesquisar'.' '.$singular,
      'not_found'     => 'Não exitem'.' '.$plural,
    ),
    'public'          => true,
    'hierarchical'    => true,
    'query_var'       => true,
    'rewrite'         => array( 'slug' => $rewrite, 'with_front' => false ),
  );
}

function create_new_taxonomy() {

  register_taxonomy( 'pilots-cat', 'pilots', c_args( 'Categoria', 'Categorias' ) );

}
//add_action( 'init', 'create_new_taxonomy', 0 );

#----------------------#
# CREATE NEW SEPARATOR #
#----------------------#

function create_separator() {

  global $menu;

  $menu[ $position ] = array( 
    0 => '',
    1 => 'read',
    2 => 'separator3' . $position,
    3 => '',
    4 => 'wp-menu-separator',
  );

}
add_action( 'admin_init', 'create_separator' );

#---------------#
# SET SEPARATOR #
#---------------#

function set_admin_menu_separator() {

  do_action( 'admin_init', 79 );

}
add_action( 'admin_menu', 'set_admin_menu_separator' );

#------------------------#
# REORDER DASHBOARD MENU #
#------------------------#

function reorder_admin_menu( $__return_true ) {

  return array( 
   'index.php', # Dashboard
   'acf-options-general', # options
   'edit.php', # Posts
   'edit.php?post_type=page', # Page
   //'edit.php?post_type=events', # Events

   'separator1', # --Space--
   'separator2', # --Space--
   'separator3', # --Space--

   'upload.php', # Media
   'themes.php', # Appearance
   'edit-comments.php', # Comments
   'users.php', # Users
   'plugins.php', # Plugins
   'tools.php', # Tools
   'options-general.php', # Settings
 );

}
add_filter( 'custom_menu_order', 'reorder_admin_menu', 99 );
add_filter( 'menu_order', 'reorder_admin_menu', 99 );

#-----------------#
# HIDE MENU ITEMS #
#-----------------#

function hide_menu_items() {

  //remove_menu_page( 'edit.php?post_type=page' ); # pages
  remove_menu_page( 'edit-comments.php' ); # comments

}
add_action( 'admin_menu', 'hide_menu_items' );

#----------------#
# REMOVE WIDGETS #
#----------------#

function remove_dashboard_widgets() {

  // remove_action('welcome_panel', 'wp_welcome_panel'); # welcome panel
  // remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); # wordpress events and news
  // remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); # quick draft
  // remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); # at a glance
  // remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); # activity
  # remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  # remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); # recent drafts
  # remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); # recent comments

}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

#--------------------#
# CREATE NEW WIDGETS #
#--------------------#

function create_post_widget( $post_type ) { # GENERATES A POST TYPE LOOP
  global $post;
  
  echo '<ol>';

  $myposts = get_posts( array(
    'numberposts' => 5,
    'order'       => 'DSC',
    'post_type'   => $post_type
  ));
  
  foreach( $myposts as $post ) {
    setup_postdata($post);
    echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
  }

  echo '</ol>';
}

#-------------#
# SET WIDGETS #
#-------------#

function pilots_widget() {

  create_post_widget( 'activities' );

}

# add widgets to dashboard
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;

	# ADD WIDGETS HERE
	wp_add_dashboard_widget( 'activities_widget', 'Activitdades', 'activities_widget' );

}
//add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

#---------------------#
# CUSTOM POST QUERIES #
#---------------------#

function custom_query() {
  global $wp_query;
  $pages = get_option( 'posts_per_page' );
  $today = date('Y-m-d H:i:s');

  # home page - calendar
  if ( is_home() and $wp_query->is_main_query() and !is_admin() ) {
    $wp_query->set( 'post_type', array( 'atividades', 'cursos', 'comunicados', 'noticias' ) );
    $wp_query->set( 'posts_per_page', $pages );
    $wp_query->set( 'order', 'DSC' );
    $wp_query->set( 'orderby', 'meta_value' );
    $wp_query->set( 'meta_key', 'date_start' );
  }

}
//add_action( 'pre_get_posts', 'custom_query' );

#-----------------------#
# CUSTOM SEARCH QUERIES #
#-----------------------#

function search_query( $query ) {

  if ( $query->is_search and $query->is_main_query() and !is_admin() ) {
    $query->set( 'post_type', array( 'cursos', 'atividades', 'comunicados', 'noticias' ) );
    $query->set( 'posts_per_page', $pages );
    $query->set( 'order', 'DSC' );
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'date_start' );
  }

  return $query;
}
//add_filter( 'pre_get_posts', 'search_query' );

#------------------------#
# CUSTOM FUNCTIONS HERE  #
#------------------------#

# create cookiebar variables for translation
function cookiebar_translation( $row_name ) {
  $locale = get_locale();

  if ( have_rows( $row_name, 'option' ) ) :
    while ( have_rows( $row_name, 'option' ) ) : the_row();
      $lang  = get_sub_field( 'language_code' );
      $label = get_sub_field( 'label_text', false, false );

      if ( !empty( $lang ) ) {
        if ( $locale == $lang ) return $label;
      }

      else {
        return $label;
      }

    endwhile;
  endif;
}

?>