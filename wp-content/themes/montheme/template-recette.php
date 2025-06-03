<?php
/**
 * Template Name: Page de recette
 */

 
get_header(); ?>


<section class="carte" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/notre-carte.png');">

<div class="carte_content">
  <h1> <?= carbon_get_theme_option('titre_banniere_notre_carte'); ?></h1>

  <?= carbon_get_theme_option('description_banniere_notre_carte'); ?>
</div>


</section>


<nav class="app-header_nav app-header_nav--width" style="background-color:<?php echo get_theme_mod('header_background'); ?>">

  <?php wp_nav_menu([
    //correspond au 1er arg de reister_nav_menu
    'theme_location' => 'recette',
    'container' => false,

  ]) ?>
</nav>


<?php 

?>














<?php
get_footer();
