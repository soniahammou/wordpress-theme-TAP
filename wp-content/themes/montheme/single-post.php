<?php get_header(); ?>



<h1> page d'article : (single-post.php)  </h1>

<nav class="app-header_nav" style="background-color:<?php echo get_theme_mod('header_background'); ?>">

  <?php wp_nav_menu([
    'theme_location' => 'recette',
    'container' => false,

  ]) ?>
</nav>

<!-- Nav de toutes les taxonomies  -->
<?php $recettes = get_terms(['taxonomy' => 'recette_category']); ?>
<ul>
  <?php foreach ($recettes as $recette): ?>
    <li>
      <a href="<?= get_term_link($recette) ?>" class="nav-link <?= is_tax('recette_category', $recette->term_id) ? 'active' : '' ?>"><?= $recette->name ?></a>
    </li>
  <?php endforeach; ?>
</ul>




<?php

//------------------------------------------------  La boucle ------------------------------------------------
// est ce qu'il y a des articles 
if (have_posts()): 
  //tant qu'il  a des artcles
  while (have_posts()) : the_post();
  ?>
    <p> <?php the_content() ?> </p>

  <?php endwhile; ?>

<?php else: echo " aucun article" ?>
<?php endif;



//------------------------------------------------  META DONNEE  ------------------------------------------------

// TODO: vegan friendly a la place de article sponsorisé ? 
if (get_post_meta(get_the_ID(), VeganMetaBox::META_KEY, true) === '1'): ?>

  <p> article sponsorisé </p>
<?php endif ?>


<?php get_footer(); 