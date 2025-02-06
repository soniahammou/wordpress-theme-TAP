<?php


require_once('metaboxes/vegan.php');
require_once('options/agence.php');
require_once('inc/fields.php');
require_once('options/apparence.php');




add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
  require_once( ABSPATH . 'vendor/autoload.php' );
  \Carbon_Fields\Carbon_Fields::boot();
}

// ---------------- INITIALISATION DU THÈME ----------------

if (!function_exists('montheme_supports')) :
  function montheme_supports()
  {
    // Support de base
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    // Enregistrement des menus
    register_nav_menu('header', 'Menu principal');
    register_nav_menu('footer', 'Pied de page');
    register_nav_menu('recette', 'Notre carte');
  }
endif;
add_action('after_setup_theme', 'montheme_supports');



// ---------------- ENREGISTREMENT DES STYLES ET SCRIPTS ----------------

/**
 * Enregistre et charge les fichiers CSS nécessaires au thème.
 * @return void
 */
if (!function_exists('montheme_register_css')) {

  function montheme_register_css()
  {

    // Liste des fichiers CSS à charger
    $cssLink = [
      'global' => '/css/base/global.css',
      'normalize' => '/css/base/normalize.css',
      'footer' => '/css/layouts/footer.css',
      'header' => '/css/layouts/header.css',
      'homepage' => '/css/layouts/homepage.css',
      'slider' => '/css/layouts/slider.css',
      'recette' => '/css/layouts/recette.css',
      'horaire' => '/css/layouts/horaire.css',
      'histoire' => '/css/layouts/histoire.css',
      '404' => '/css/layouts/404.css',

    ];

    // var_dump($cssLink);

    foreach ($cssLink as $fileName => $path) {

      wp_register_style(
        $fileName,
        get_template_directory_uri() . $path
      );
      wp_enqueue_style($fileName);
    }
  }
}
add_action('wp_enqueue_scripts', 'montheme_register_css');


/**
 * Enregistre et charge les fichiers JS nécessaires au thème.
 *
 * @return void
 */

if (!function_exists('montheme_register_script')) {

  function montheme_register_script()
  {

    $scriptPath = [

      'montheme_app' => '/assets/js/app.js',
      'montheme_slider' => '/assets/js/slider.js',

    ];

    foreach ($scriptPath as $fileName => $path) {

      wp_register_script(

        $fileName,
        get_template_directory_uri() . $path,
        [],
        false,
        true
      );

      //  indiquer que ce sont des modules JS
      wp_script_add_data($fileName, 'type', 'module');

      wp_enqueue_script($fileName);
    }
  }
}
add_action('wp_enqueue_scripts', 'montheme_register_script');


// la feuille de style pour les images des colonnes wordpress
add_action('admin_enqueue_scripts', function () {
  wp_enqueue_style('admin_montheme', get_template_directory_uri() . "/css/montheme_wordpress/admin.css");
});

// ---------------- CONFIGURATION DU SLIDER ----------------

if (!function_exists('load_slider_images_url')) :
  function load_slider_images_url()
  {
    if (wp_script_is('montheme_slider', 'enqueued')) {
      wp_localize_script('montheme_slider', 'sliderData', [
        'imagePath' => get_template_directory_uri() . '/assets/homepage-slider/',
      ]);
    }
  }
endif;
add_action('wp_enqueue_scripts', 'load_slider_images_url');

// ---------------- FILTRES PERSONNALISÉS ----------------

if (!function_exists('load_as_ES6')) :
  function load_as_ES6($tag, $handle, $src)
  {
    // Vérifie si le script est app.js ou slider.js
    if (in_array($handle, ['montheme_app', 'montheme_slider'])) {

      // Ajoute l'attribut 'type="module"' à la balise <script>
      $tag = '<script src="' . $src . '" type="module"></script>';
      //var_dump($tag);

    }
    return $tag;
  }
endif;

// Applique la fonction 'load_as_ES6' aux balises <script>
add_filter('script_loader_tag', 'load_as_ES6', 10, 3);





// ---------------- ENREGISTREMENT D'une taxonomie----------------

if (!function_exists('montheme_register_recette')):

function montheme_register_recette()
{
  //TODO: lors de l'enregistrement boucle de chargement sans rechargement de page
  register_taxonomy('recette_category', 'post', [
    'labels' => [
      'name' => 'Categorie de recette',
      'singular_name'     => 'plat',
      'plural_name'       => 'plats',
      'search_items'      => 'Rechercher les plats',
      'all_items'         => 'Tous les plats',
      'edit_item'         => 'Editer le plat',
      'update_item'       => 'Mettre à jour le plat',
      'add_new_item'      => 'Ajouter une nouvelle catégoire de plat',
      'new_item_name'     => 'Nom de la catégorie culinaire',
      'menu_name'         => 'Catégorie de plats',
    ],

    'show_in_rest' => true,
    'hierarchical' => true,
    'show_admin_column' => true,

  ]);
}
endif;

add_action('init', 'montheme_register_recette');

// ---------------- custom post type ----------------

/**
 * 
 * Enregistrement d'un CPT recette
 *
 * @return void
 */
if (!function_exists('montheme_types')):

function montheme_types()
{
  register_post_type('recette', [
    'label' => 'recette',
    'labels' => [
      'name' => 'Liste des plats',
      'add_new_item' => 'Ajouter un plat',
      'not_found' => 'aucun plat trouvé',
      'search_items' => 'Rechercher un plat',
      'menu_name' => 'La carte',

    ],
    'public' => true,
    'menu_position' => 3,
    'menu_icon' => 'dashicons-food',
    'supports' => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true,
    'has_archive' => true,
    'taxonomies' => ['recette_category'],
  ]);
}
endif;

add_action('init', 'montheme_types');


// ajoute un filtre sur les colome des CUSTOM POST recette 
add_filter(
  'manage_recette_posts_custom_column',
  function ($column, $postId) {
    // var_dump(func_get_args());

    // ajout d'une colonne d'image
    if ($column === ('thumbnail')) {
      the_post_thumbnail('small', $postId);
    }

    // ajout d'une colonne pour les metadonnée custom-fields
    if ($column === 'custom-fields') {
      if (!empty(get_post_meta($postId, VeganMetaBox::META_KEY, true))) {
        $class = 'oui';
      } else {
        $class = 'non';
      }
      echo "<div>"  .  esc_html($class) . "</div>";
    }
  },
  10,
  2
);

// Personnalisation des colonnes dans le BO 
add_filter(
  'manage_recette_posts_columns',
  function ($columns) {
    return [
      'cb' => $columns['cb'],
      'title' => $columns['title'],
      'thumbnail' => 'Miniature',
      'date' => $columns['date'],
      'taxonomy-recette_category' => $columns['taxonomy-recette_category'],
      'custom-fields' => 'Options vegan',

    ];
  }
);


// ---------------- SUPPRESSION DE FONCTIONNALITÉS INUTILES ----------------
if (!function_exists('montheme_cleanup')):

function montheme_cleanup()
{
  // Suppression des emojis
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_print_styles', 'print_emoji_styles');


  // Supprime le lien vers Windows Live Editor Manifest
  remove_action('wp_head', 'wlwmanifest_link');

  // Supprime le lien RSD + XML
  remove_action('wp_head', 'rsd_link');

  // Supprime la meta generator
  remove_action('wp_head', 'wp_generator');

  // Supprime les extra feed rss
  remove_action('wp_head', 'feed_links_extra', 3);

  // Supprime les feeds des Posts et des Commentaires
  remove_action('wp_head', 'feed_links', 2);
}
endif;

add_action('init', 'montheme_cleanup');

// ---------------- MÉTADONNÉES  ----------------
VeganMetaBox::register();

// ---------------- FILTREs  ----------------


// ajout d'une nouvelle column
add_filter('manage_post_posts_columns', function ($columns) {

  $newColumns = [];
  foreach ($columns as $k => $v) {

    if ($k === 'date') {
      $newColumns['vegetarien'] = 'Produit végatirien ?';
    }
    $newColumns[$k] = $v;
  }
  // var_dump($newColumns);
  return $newColumns;
});

// affiche la valeur de notre metabox;
add_filter('manage_post_posts_custom_column', function ($column, $postId) {
  if ($column === 'vegetarien') {
    if (!empty(get_post_meta($postId, VeganMetaBox::META_KEY, true))) {
      $class = 'yes';
    } else {
      $class = 'no';
    }
    echo "<div>"  . esc_html($class) . "</div>";
  }
}, 10, 2);


// ---------------- Personnalisation  ----------------

AgenceMenuPage::register();
