<?php
/**
 * Template Name: Page de recette
 */

 
get_header(); ?>
<h1> template-recette.php </h1>

<nav class="app-header_nav" style="background-color:<?php echo get_theme_mod('header_background'); ?>">

  <?php wp_nav_menu([
    //correspond au 1er arg de reister_nav_menu
    'theme_location' => 'recette',
    'container' => false,

  ]) ?>
</nav>


<!-- Nav de toutes les taxonomies  -->
<?php $recettes = get_terms(['taxonomy' => 'recette_category']); ?> 
<ul>
  <?php foreach ($recettes as $recette): ?>
    <li>
      <a href="<?= get_term_link($recette) ?>" class="nav-link ?= is_tax('recette_category', $recette->term_id) ? 'active' : '' ?>"><?= $recette->name ?></a>
    </li>
<?php endforeach; ?>
</ul> 


<?php 

$allterms = get_terms( array( 'parent' => 'pâtes fraiches' ) );
foreach ($allterms as $term) {
    $args = array(
        'post_type'      =>  'video_cpt',
        'post_status'    =>  'publish',
        'posts_per_page' =>  1,
        'tax_query'      => array ( array (
            'taxonomy' => 'recette_category',
            'terms'    => $term->term_id,
         ))
  ); //the fields parameter is to return just the post ids rather than the whole posts
      $video_query  = new WP_Query( $args );
      if ($video_query->have_posts()) {
         //there's videos that match this term, so do something
         echo $term->name;
      }
}
?>




















<?php
$term_name = 'Fromage'; // Nom de la catégorie
$taxonomy_name = 'recette_category'; // Nom de la taxonomie

// Récupérer l'objet terme pour "Pâtes fraîches"
$term = get_term_by('name', $term_name, $taxonomy_name);

if ($term) {
    // Récupérer les articles associés avec WP_Query
    $query = new WP_Query([
        'post_type' => 'recette', // Type de contenu personnalisé
        'tax_query' => [
            [
                'taxonomy' => $taxonomy_name, // Nom de la taxonomie
                'field'    => 'slug',
                'terms'    => $term->slug, // Slug de "Pâtes fraîches"
            ],
        ],
    ]);

    if ($query->have_posts()) {
        echo '<h2>Recettes : ' . esc_html($term->name) . '</h2>';
        echo '<div class="recettes-container">';

        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <article class="recette">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if (has_post_thumbnail()): ?>
                    <div class="thumbnail">
                        <?php the_post_thumbnail('medium'); // Affiche l'image mise en avant ?>
                    </div>
                <?php endif; ?>
                <div class="excerpt">
                    <?php the_excerpt(); // Résumé de l'article ?>
                </div>
            </article>
            <?php
        }

        echo '</div>';
        wp_reset_postdata(); // Réinitialise la requête globale
    } else {
        echo '<p>Aucune recette trouvée pour ' . esc_html($term->name) . '.</p>';
    }
} else {
    echo '<p>La catégorie "Pâtes fraîches" n’existe pas.</p>';
}
?>




<?php


// Requête pour récupérer les derniers articles
// $query = new WP_Query([
//     'post_type' => 'post', // Pour récupérer uniquement les articles
//     'posts_per_page' => 10, // Nombre d'articles à afficher
// ]);

// if ($query->have_posts()) : 
//     while ($query->have_posts()) : $query->the_post(); 
//         <h2><a href="?php the_permalink(); ">php the_title(); </a></h2>
//         <div>?php the_excerpt(); </div>
//      endwhile;
// else : 
//     echo '<p>Aucun article trouvé.</p>';
// endif;

// // Réinitialise les données de la requête
// wp_reset_postdata();

get_footer();
