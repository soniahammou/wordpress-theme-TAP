<?php
/*
Template Name: Contact
*/
?>


<?php
get_header();
?>

<section class="contact">

  <div class="contact_content ">

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <h2 class="contact_content--color"><?php the_title(); ?></h2>

      <div class="contact_content_paragraph--color">
        <?php if(get_the_content()): ?>
          <?=get_the_content()?>

        <?php else: ?>
          <p> Contactez nous pour plus d'informations </p>

            <?php  endif; ?>
            <p><?= carbon_get_theme_option('numero_telephone'); ?> </p>

      </div>

      <?php endwhile; ?>
  <?php  else: ?>
      <p> Contactez nous pour plus d'informations</p>
    <?php endif; ?>


    <a href="<?= carbon_get_theme_option('Contact'); ?>"target="_blank">
      <button class="btn btn--white-color "> Commmander en ligne </button>
  </a>
  </div>

</section>

<?php get_footer(); 