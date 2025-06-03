 <?php /* echo 'taxonomy';*/ ?>

 <?php get_header(); ?>

 <section class="carte" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/notre-carte.png');">

<div class="carte_content">
  <h1> <?= carbon_get_theme_option('titre_banniere_notre_carte'); ?></h1>

  <?= carbon_get_theme_option('description_banniere_notre_carte'); ?>
</div>


</section>
 <main>

   <nav class="app-header_nav app-header_nav--width" style="background-color:<?php echo get_theme_mod('header_background'); ?>">

     <?php wp_nav_menu([
        //correspond au 1er arg de reister_nav_menu
        'theme_location' => 'recette',
        'container' => false,
      ]) ?>

   </nav>


   <?php /*if(have_posts()){
the_terms( $post->ID, 'recette_category', 'carte : ' ); 

}*/ ?>





   <?php if (have_posts()): while (have_posts()): the_post(); ?>

       <section class="recette_section">

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



 <?php get_footer(); ?>