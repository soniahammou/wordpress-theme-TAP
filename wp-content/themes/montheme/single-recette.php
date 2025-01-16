<!-- Page des custom post type " recette " -->


<?php get_header(); ?>

<main>

  <h1>Liste des recettes single-recette.php</h1>


  <?php
  /*

  // https://wpchannel.com/wordpress/tutoriels-wordpress/afficher-categories-termes-dune-taxonomie-menu-personnalise/
  $queried_object = get_queried_object();
  $taxonomy = $queried_object->taxonomy;
  $term_id = $queried_object->term_id;
  $taxonomy_name = 'recette_category';
  $term_children = get_term_children($term_id, $taxonomy_name);

  echo '<ul class="nav nav-pills">';
  foreach ($term_children as $child) {
    $term = get_term_by('id', $child, $taxonomy_name);
    echo '<li>' . $term->name . ' </li>';
  }
  echo '</ul>';
  */
  ?>

<?php if(have_posts()){
the_terms( $post->ID, 'recette_category', 'carte : ' ); 

}?>





  <?php if (have_posts()): while (have_posts()): the_post(); ?>

      <section class="recette_section">

        <!-- //TODO ajouter une condition : si l'image est presente afficher sinon masquer -->

        <?php
        $img = get_the_post_thumbnail();

        if ($img !== '') { ?>
          <div>
            <figure class="recette_section-image">
              <?php the_post_thumbnail(); ?>
            </figure>
          </div>
        <?php }  ?>

        <div class="recette_section-text">
          <h3><?php the_title(); ?></h3>
          <p> <?php the_content(); ?> </p>
        </div>


      </section>



    <?php endwhile;
  else: ?>
        <section class="recette_section">

          <div class="recette_section-text">

   <p>Pas encore de ici, mais restez avec nous : la gourmandise arrive très vite !</p>
   </div>
   </section>

  <?php endif; ?>

</main>



<?php get_footer(); 