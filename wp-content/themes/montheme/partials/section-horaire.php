

      <!-- SECTION HOARAIRES // recuperation avec l'API de wordpress-->
      <section class="homepage_horaire" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/fond.png');">

        <div class="homepage_horaire_title">
          <h2 class="homepage__about__text-title">Nos Horaires & Lieux de Régal </h2>
          <p> <?= get_option('agence_horaire'); ?>
          </p>
        </div>

        <?php for ($i = 1; $i < 4; $i++):
          $lieux = get_option('agence_lieux');
          $lieu = isset($lieux[$i]) ? esc_html($lieux[$i]) : 'Aucun lieu enregistré.';

          $days = get_option('agence_days');
          $day = isset($days[$i]) ? esc_html($days[$i]) : 'Aucun jour enregistré.';

        ?>
          <div class="homepage_horaire__places">
            <h3> <?php echo nl2br($day); ?> <h3>
                <p> <?php echo nl2br($lieu); ?> </p>
          </div>
        <?php endfor; ?>

      </section>




      <?php

      // recuperation avec carbon 
      $lieux = carbon_get_theme_option('lieux_repetitifs');

      if ($lieux) {
        foreach ($lieux as $lieu) {
          echo '<h3>' . esc_html($lieu['days_options']) . '</h3>';
          echo '<p>' . esc_html($lieu['lieu_adresse']) . '</p>';
        }
      } else {
        echo 'Aucun lieu enregistré.';
      }



      ?>
