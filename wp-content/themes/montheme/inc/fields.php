            <?php
            // BO / OPTION DU THEME : avec carbon fields
            use Carbon_Fields\Block;
            use Carbon_Fields\Container as Carbon_FieldsContainer;
            use Carbon_Fields\Field\Field;




            /**
             * Action d'enregistrer des champs depuis le BO pour la section horaires
             */
            add_action('carbon_fields_register_fields', function () {

              Carbon_FieldsContainer::make('theme_options', 'Option du theme')

                ->add_tab(__('Commande en ligne'), array(
                  Field::make('text', 'lien_de_commande', 'Lien pour passer commande en ligne'),

                ))

                ->add_tab(__('Contact'), array(
                  Field::make('text', 'numero_telephone', 'Votre numéro de téléphone'),

                ))
                ->add_tab(__('Reseaux Sociaux'), array(
                  Field::make('text', 'facebook_url', 'URL facebook'),
                  Field::make('text', 'instagram_url', 'URL instagram'),
                ))

                ->add_tab(__('Lieux de tournée'), array(
                  Field::make('complex', 'lieux_repetitifs', __('Liste des lieux'))
                    ->add_fields(array(
                      Field::make('text', 'days_options', __('Jour de tournées')),
                      Field::make('text', 'parking_name', __('Nom du parking')),
                      Field::make('textarea', 'lieu_adresse', __('Adresse du lieu')),
                    ))
                    ->set_max(10) // Limite à 10 répétitions (optionnel)
                    ->set_min(1)  // Minimum 1 répétition (optionnel)
                ));




              // Action pour enregistrer des blocs pour les Gestion du 1er block
              Block::make(__('Section-1'))

                ->add_fields(array(
                  Field::make('text', 'heading', __('Block Heading')),
                  Field::make('image', 'image', __('Block Image')),
                  Field::make('rich_text', 'content', __('Block Content')),
                  Field::make('text', 'link_btn', __('Lien du bouton')),
                  Field::make('text', 'btn_content', __('Contenu du bouton')),

                ))
                ->set_render_callback(function ($fields) { ?>

                <section class="about">
                  <div class="about__image  about__image--align-right">
                    <figure class="about__image-figure">
                      <?php echo wp_get_attachment_image($fields['image'], 'full');  ?>
                    </figure>
                  </div>


                  <div class="about__content about__content--align-left">
                    <div class="about__content-text">
                      <h2><?php echo esc_html($fields['heading']); ?></h2>
                      <p> <?php echo apply_filters('the_content', $fields['content']); ?></p>



                      <?php if(!empty($fields['link_btn']) && !empty($fields['btn_content'])): ?>
                      <div class="about_btn">
                        <a href="<?php echo esc_url($fields['link_btn']) ?>">
                          <button class="btn">
                            <?= esc_html($fields['btn_content']) ?>
                          </button>
                        </a>

                      </div>
                    <?php endif; ?>

                    </div>
                </section>

              <?php  });








              /***
               * Bloc pour la page Notre histoire - presentation
               */
              Block::make(__('Notre-histoire_presentation'))

                ->add_fields(array(
                  Field::make('text', 'heading', __('Block Heading')),
                  Field::make('image', 'image', __('Block Image')),
                  Field::make('rich_text', 'content', __('Block Content')),
                ))
                ->set_render_callback(function ($fields) { ?>



                <section class="about">

                  <div class="about__image about__image--align-right">
                    <figure class="about__image-figure about__image-figure--scale">
                      <?php echo wp_get_attachment_image($fields['image'], 'full');  ?>
                    </figure>
                  </div>


                  <div class="about__content about__content--align-left">

                    <div class="about__content-text">
                      <h2><?php echo esc_html($fields['heading']); ?></h2>
                      <p> <?php echo apply_filters('the_content', $fields['content']); ?></p>

                    </div>
                </section>




              <?php  });


              /**
               * BLoc pour la page notre histoire : evenement 
               */
              Block::make(__('Notre-histoire-evenement'))

                ->add_fields(array(
                  Field::make('text', 'heading', __('Saisir le titre')),
                  Field::make('image', 'image', __('Importer une image')),
                  Field::make('rich_text', 'content', __('Ecrire le paragraphe')),
                  Field::make('text', 'link_btn', __('Lien du bouton')),
                  Field::make('text', 'btn_content', __('Contenu du bouton')),
                ))
                ->set_render_callback(function ($fields) { ?>



                <section class="about">

                  <div class="about__content">
                    <div class="about__content-text">
                      <h2><?php echo esc_html($fields['heading']); ?></h2>
                      <p> <?php echo apply_filters('the_content', $fields['content']); ?></p>
                    

                    <?php if(!empty($fields['link_btn']) && !empty($fields['btn_content'])): ?>
                  <div class="about_btn">
                        <a href="<?php echo esc_url($fields['link_btn']) ?>">
                          <button class="btn">
                            <?= esc_html($fields['btn_content']) ?>
                          </button>
                        </a>

                  </div>
                      <?php endif; ?>
                      </div>

                  </div>

                  <div class="about__image">
                    <figure class="about__image-figure about__image-figure--scale-event">
                      <?php echo wp_get_attachment_image($fields['image'], 'full');  ?>
                    </figure>
                  </div>
                </section>




              <?php  });





                /**
               * BLoc pour la page notre histoire : horaires 
               */              
              Block::make(__('Notre-histoire-horaires'))

                ->add_fields(array(
                  Field::make('text', 'heading', __('Block Heading')),
                  Field::make('rich_text', 'content', __('Block Content')),
                  Field::make('text', 'link_btn', __('Lien du bouton')),
                  Field::make('text', 'btn_content', __('Contenu du bouton')),
                ))
                ->set_render_callback(function ($fields) { ?>



                <section class="about--background_image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/meatball.png');">

          
                  <div class="about__content--width">
                    <div class="about__content-text--align">
                      <h2><?php echo esc_html($fields['heading']); ?></h2>
                      <p> <?php echo apply_filters('the_content', $fields['content']); ?></p>
                    </div>
              



                  <?php if(!empty($fields['link_btn']) && !empty($fields['btn_content'])): ?>
                  <div class="about_btn--position">


                        <a href="<?php echo esc_url($fields['link_btn']) ?>">
                          <button class="btn btn--white-color">
                            <?= esc_html($fields['btn_content']) ?>
                          </button>
    
                        </a>

                      </div>
                      <?php endif; ?>
                      </div>

                </section>




            <?php  });



            });
