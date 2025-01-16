    <?php
    get_header();
    ?>


    <main>
      <section class="homepage-slider">
        <button class="btn slider__btn" type="button" aria-label="Précédent">&lt;</button>
        <button class="btn slider__btn" type="button" aria-label="Suivant">&gt;</button>
      </section>

      <!-- SECTION A PROPOS -->
      <?php
      if (have_posts()): while (have_posts()): the_post();

          the_content()
      ?>
        <?php endwhile;
      else: ?>
        <p>Aucun article :</p>
      <?php endif; ?>



      <!-- SECTION HOARAIRES // recuperation avec l'API de wordpress-->

      <?php get_template_part('partials/section', 'horaire'); ?>


    


    </main>

    <?php get_footer();