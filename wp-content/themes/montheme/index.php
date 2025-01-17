<?php get_header() ?>

<?php wp_title(); ?>


<main>
  <section class="homepage-slider">
    <button class="btn slider__btn" type="button" aria-label="Précédent">&lt;</button>
    <button class="btn slider__btn" type="button" aria-label="Suivant">&gt;</button>
  </section>

  <!-- SECTION A PROPOS -->
  <section class="homepage_about">

    <figure class="homepage_about_logo">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pate-fraiche.webp">
    </figure>

    <div class="homepage__about__text ">
      <h2> L'art de la pates fraiches ! </h2>

      <p> Maela, vous invite à découvrir la culture fait maison, où chaque plat est préparé avec des ingrédients frais et de saison.</p>

      <p>Dégustez nos pâtes fraîches accompagnées de sauces maison, mais aussi une variété de plats cuisinés, de soupes réconfortantes, de paninis savoureux et de desserts maison. </p>

      <p>Truck à Pâtes, se déplace également pour vos événements : inaugurations, mariages, et toutes occasions spéciales. </p>


      <div class="btn_homepage__about">
        <button a href="#" class="btn"> en savoir plus</button>
      </div>
    </div>

  </section>

  <!-- SECTION HOARAIRES -->
  <section class="homepage_horaire">

    <div class="homepage_horaire_title">
      <h2 class="homepage__about__text-title">Nos Horaires & Lieux de Régal </h2>
      <p> <?= get_option('agence_horaire'); ?></p>
    </div>

    <div class="homepage_horaire__places">
      <h3> Lundi et Vendredi <h3>
          <p>Parking P. Burneleau</p> <p> Rue de la Camamine, 85150, La Mothe-Achardn </p>
    </div>
    <div class="homepage_horaire__places">
      <h3> Lundi et Vendredi <h3>
          <p>Parking P. Burneleau</p> <p> Rue de la Camamine, 85150, La Mothe-Achardn </p>
    </div>
    <div class="homepage_horaire__places">
      <h3> Lundi et Vendredi <h3>
          <p>Parking P. Burneleau</p> <p>  Rue de la Camamine, 85150, La Mothe-Achardn </p>
    </div>

  </section>



</main>


<?php get_footer();
