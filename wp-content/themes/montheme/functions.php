<?php 

/**
 * Ajoute le titre au site <title> dans head
 *
 * @return void
 */
function montheme_supports()
{
  add_theme_support('title-tag');
}



/**
 * Enregistrer et charger les feuille de styles
 * @return void
 */
function montheme_register_css() {
 
  //STYLES

  $cssLink = [
    'global'=> '/css/base/global.css',
    'normalize'=> '/css/base/normalize.css',
    'footer'=> '/css/layouts/footer.css',
    'header'=> '/css/layouts/header.css',
    'homepage'=> '/css/layouts/homepage.css',
    'slider'=> '/css/layouts/slider.css',
    
    ];
    // var_dump($cssLink);
    foreach ($cssLink as $fileName => $path) {
    //fonction pour enregistrer une feuille de style sans la charger immédiatement
      wp_register_style(
        $fileName,
        get_template_directory_uri() . $path
    );
    //charge la feuille de style enregistré 
    wp_enqueue_style($fileName);

    }

//SCRIPT

$scriptPath = [

  'app'=>'/js/app.js',
  'slider'=>'/js/slider.js',

];

foreach ($scriptPath as $fileName => $path) {

// fonction pour enregistrer un script 
wp_register_script(
  $fileName,  // Identifiant unique pour le script
  get_template_directory_uri() . $path,     // L'URL du fichier JS
  [],  // Liste des dépendances (scripts qui doivent être chargés avant)
  false, // Version du script
  true // Où charger le script : true pour footer, false pour header
);

// Ajoute l'attribut 'type="module"' pour indiquer que ce sont des modules JS
wp_script_add_data($fileName, 'type', 'module');

// fonction pour charger le script
wp_enqueue_script($fileName);

}



}

// Dans functions.php
function load_slider_images_url() {
  //passe des données dynamiques comme des variables PHP a un fichier js
  wp_localize_script('slider', 'sliderData', array(
    'imagePath' => get_template_directory_uri() . '/assets/homepage-slider/'
  ));
}






/**
 *  Actions :
 *  cette fonction add_action permet d'attacher une fonction à un "hook" spécifique dans WordPress. 
 * Un "hook" est un endroit où WordPress permet d'ajouter des fonctionnalités ou d'exécuter des actions.
 */
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_css');

add_action('wp_enqueue_scripts', 'load_slider_images_url');



/**
 * Modifie la balise <script> pour ajouter le type="module" à app.js et slider.js
 */
function load_as_ES6($tag, $handle, $src) {
  // Vérifie si le script est app.js ou slider.js
  if (in_array($handle, ['app', 'slider'])) {
      // Ajoute l'attribut 'type="module"' à la balise <script>
      $tag = '<script src="' . $src . '" type="module"></script>';
      //var_dump($tag);
  }
  return $tag;
}

// Applique la fonction 'load_as_ES6' aux balises <script>
add_filter('script_loader_tag', 'load_as_ES6', 10, 3);