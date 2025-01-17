<?php

/**
 * Gestion de la PERSONNALISATION DU THEME
 */
add_action('customize_register', function (WP_Customize_Manager $manager) {

  // ajoute une nouvelle section dans apparence
  $manager->add_section('montheme_apparence', [
    'title' => "Personnalisation de l'apparence",
  ]);

  //mofidication de la nav 
  $manager->add_setting('montheme_second_header_background', [
    'default' => "#FA6625",
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color' // evite les injection
  ]);


  $manager->add_control(
    new WP_Customize_Color_Control(
      $manager,
      'montheme_second_header_background',
      [
        'section' => 'montheme_apparence',
        'label' => "couleur de l'entete"
      ]
    )
  );


  // modif du header
  $manager->add_setting('header_background', [
    'default' => "#ffffff",
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color' // evite les injection
  ]);

  $manager->add_control(
    new WP_Customize_Color_Control(
      $manager,
      'header_background',
      [
        'section' => 'montheme_apparence',
        'label' => "couleur de la navigation"
      ],
    )
  );


  // modification du logo
  $manager->add_setting('montheme_logo_nav', [
    'default' => get_template_directory_uri() . '/assets/img/logo.png',
    'transport' => 'postMessage',
    'sanitize_callback' => 'ic_sanitize_image',
  ]);

  $manager->add_control(
    new WP_Customize_Image_Control(
      $manager,
      'montheme_logo_nav',
      [
        'section' => 'montheme_apparence',
        'label' => "Logo"
      ],
    )
  );



  //  // methode de selction de couleur "manuelle"
  //   $manager->add_control('secondary_header_background',[
  //     'section'=> 'montheme_apparence',
  //     'setting'=>'header_background',
  //     'label'=> "couleur de l'entete 2 "
  //   ]);


  // modif du footer
  $manager->add_setting('montheme_footer_background', [
    'default' => "#ffffff",
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color' // evite les injection
  ]);

  $manager->add_control(
    new WP_Customize_Color_Control(
      $manager,
      'montheme_footer_background',
      [
        'section' => 'montheme_apparence',
        'label' => "couleur du pied de page"
      ],
    )
  );
});

add_action('customize_preview_init', function () {
  wp_enqueue_script('montheme_apparence', get_template_directory_uri() . '/js/apparence.js', ['jquery', 'customize-preview'], '', true);
});
