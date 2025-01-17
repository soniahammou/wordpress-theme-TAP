<?php
/*
Template Name: Contact
*/
?>


<?php
get_header();
?>

<section class="homepage_about">

  <div class="homepage__about__text ">

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <h2><?php the_title(); ?></h2>
        <?php the_content() ?>

      <?php endwhile;
    else: ?>
      <p>Aucun article :</p>
    <?php endif; ?>
    <div class="btn_homepage__about">
      <button a href="#" class="btn"> Commmander en ligne </button>
    </div>
  </div>

</section>

<?php get_footer(); 