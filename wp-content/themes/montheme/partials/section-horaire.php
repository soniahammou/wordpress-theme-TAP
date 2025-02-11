

      <!-- SECTION HOARAIRES // recuperation avec l'API de wordpress-->
      <section class="homepage_horaire" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/fond.png');">

        <div class="homepage_horaire_title">
          <h2 class="homepage__about__text-title">Nos Horaires & Lieux de Régal </h2>
          <p> <?= get_option('agence_horaire'); ?>
          </p>
        </div>

        <?php 

    $lieux = carbon_get_theme_option('lieux_repetitifs');

      if ($lieux):
        foreach ($lieux as $lieu):?>

          <div class="homepage_horaire__places">
            <h3 class="homepage_horaire__title--color"> <?php echo esc_html($lieu['days_options']); ?> </h3>
            <p class="homepage_horaire__paragraph--bold"> <?php echo esc_html($lieu['parking_name']); ?> </p>
            <p> <?php echo wpautop($lieu['lieu_adresse']); ?> </p>
          </div>

      <?php  endforeach; ?>
     <?php else: ?>
        <p> Aucun lieu enregistré.</p>
     <?php endif; ?>
        
    

        <div class="about_btn">
           <a href="<?= carbon_get_theme_option('lien_de_commande'); ?>"target="_blank">
            <button class="btn btn--white-color"> Commander en ligne </button>
            </a>

        </div>

      </section>

