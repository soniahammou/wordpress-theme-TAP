<?php ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Truck a pates">
  <meta name="description" content="Truck a pates">

  <?php wp_head() ?>


</head>

<?php wp_body_open();

?>

<header class="app-header">

  <section class="app-header_button-section" style="background-color:<?php echo get_theme_mod('montheme_second_header_background'); ?>">
    <button a href="#" class="btn app-header_button"> Reserver pour un evenement </button>
    <button a href="#" class="btn app-header_button"> Commander </button>

  </section>
  <nav class="app-header_nav" style="background-color:<?php echo get_theme_mod('header_background'); ?>">
    <figure id="app-header_logo">
      <a href="<?= home_url(); ?>">

        <?php
        if (get_theme_mod('montheme_logo_nav')){
          $link =  get_theme_mod('montheme_logo_nav');

        }else{
          $link = get_template_directory_uri() . '/assets/img/logo.png';
        } 
        
        // var_dump($link);
        ?>



        <img src="<?= $link ?>" alt="logo-truck-a-pates"></a></figure>
    <?php wp_nav_menu([
      'theme_location' => 'header',
      'container' => false,

    ]) ?>
  </nav>

</header>