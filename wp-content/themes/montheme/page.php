<?php

?>


<?php
get_header();
?>

<section>

  <!-- <div class="homepage__about__text "> -->

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <?php the_content() ?>

      <?php endwhile;
    else: ?>
      <p>Aucun article :</p>
    <?php endif; ?>
    <!-- <div class="btn_homepage__about">
      <button a href="#" class="btn"> Commmander en ligne </button>
    </div>
  </div> -->

</section>

<?php get_footer(); 