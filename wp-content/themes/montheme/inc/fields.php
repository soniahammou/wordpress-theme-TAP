            <?php
// BO / OPTION DU THEME : avec carbon fields
            use Carbon_Fields\Block;
            use Carbon_Fields\Container as Carbon_FieldsContainer;
            use Carbon_Fields\Field\Field;




            /**
             * Action d'enregistrer des champs dans la barrre de BO 
             */
            add_action('carbon_fields_register_fields', function () {

              Carbon_FieldsContainer::make('theme_options', 'Option du theme')

                ->add_tab(__('Commande en ligne'), array(
                  Field::make('text', 'lien_de_commande', 'Lien pour passer commande en ligne'),

                ))

                ->add_tab(__('Reseaux Sociaux'), array(
                  Field::make('text', 'facebook_url', 'URL facebook'),
                  Field::make('text', 'instagram_url', 'URL instagram'),
                ))

                ->add_tab(__('Lieux de tournée'), array(
                  Field::make('complex', 'lieux_repetitifs', __('Liste des lieux'))
                    ->add_fields(array(
                      Field::make('text', 'days_options', __('Jour de tournées')),
                      Field::make('textarea', 'lieu_adresse', __('Adresse du lieu')),
                    ))
                    ->set_max(10) // Limite à 10 répétitions (optionnel)
                    ->set_min(1)  // Minimum 1 répétition (optionnel)
                ));

              // Gestion du 1er block
              Block::make(__('Section-1'))

                ->add_fields(array(
                  Field::make('text', 'heading', __('Block Heading')),
                  Field::make('image', 'image', __('Block Image')),
                  Field::make('rich_text', 'content', __('Block Content')),
                  Field::make('text', 'link_btn', __('Lien du bouton')),
                  Field::make('text', 'btn_content', __('Contenu du bouton')),

                ))
                ->set_render_callback(function ($fields) { ?>
                
                <section class="homepage_about">

                <div class="homepage_about_image">
                  <figure class="homepage_about_logo">
                    <?php echo wp_get_attachment_image($fields['image'], 'full');  ?>
                  </figure>
                </div>

            
                  <div class="homepage_about_content ">

                  <div class="homepage__about__text">
                    <h2><?php echo esc_html($fields['heading']); ?></h2>
                    <p> <?php echo apply_filters('the_content', $fields['content']); ?></p>
                

                    <div class="btn_homepage__about">
                    <a href="<?php echo esc_url($fields['link_btn'])?>"> 
                    <button class="btn">  
                       <?=esc_html($fields['btn_content'])?>
                    </button>
                    </a>

                    </div>


                  </div>
                </section>

              <?php  });


     
            });
