<?php

// BO / REGLAGES / FOOD TRUCKS INFO 
/**
 * Gestion de la page Foodtruck dans le menu des reglages du BO
 */
class AgenceMenuPage
{

  // DRY : Nom de la page et du groupe d'options
  const GROUP = 'agence_options';


  // ------------------------ ENREGISTREMENT  ----------


  /**
   *  Fonction pour enregistrer les actions dans l'interface admin de WordPressn
   *
   * @return void
   */
  public static function register()
  {
    // Ajoute une entrée dans le menu d'administration de WordPress
    add_action('admin_menu', [self::class, 'addMenu']);

    // Déclare les champs à ajouter sur la page des paramètres
    add_action('admin_init', [self::class, 'registerSettings']);

    // Enregistre les scripts et styles nécessaires pour la page des paramètres
    add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
  }



  // ----------------- CALLBACKS POUR LES SCRIPTS ET STYLES  ------------

  /**
   * Fonction pour enregistrer les styles et scripts nécessaires sur la page des paramètres
   *
   * @param [type] $suffix 
   * @return void
   */
  public static function registerScripts($suffix)
  {
    // Vérifie que l'on est sur la bonne page de réglages pour charger les scripts spécifiques
    if ($suffix === 'settings_page_agence_options') {
      wp_register_style('flatpickr', "https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css", [], false);
      wp_register_script('flatpickr', "https://cdn.jsdelivr.net/npm/flatpickr", [], false, true);

      // Enregistre et charge le script personnalisé pour l'admin
      wp_enqueue_script('montheme_admin', get_template_directory_uri() . '/js/admin.js', ['flatpickr'], false, true);
      wp_enqueue_style('flatpickr');
    }
  }


  /**
   * Fonction pour enregistrer les paramètres de l'option dans WordPress
   *
   * @return void
   */
  public static function registerSettings()
  {

    // Enregistrement des paramètres dans WordPress
    register_setting(self::GROUP, 'agence_horaire');
    register_setting(self::GROUP, 'agence_date');



    // Ajoute une nouvelle section d'options pour les paramètres du food truck
    add_settings_section(
      'agence_options_section',
      'Parametres',
      function () {
        echo "Vous pouvez gérer ici les parametres liés à truck à pattes";
      },
      self::GROUP
    );


    // Ajoute un champ de saisie pour les horaires d'ouverture
    add_settings_field(
      'agence_options_horaires',
      "Horaires d'ouverture",
      function () {      // Rendu du champs 
?>
      <textarea name="agence_horaire" cols="30" rows="10" style="width : 100%" id="">
      <?= esc_html(get_option('agence_horaire')) ?>     </textarea>

    <?php
      },
      self::GROUP,
      'agence_options_section'
    );



    // Ajoute un champ pour la date d'ouverture
    add_settings_field(
      'agence_options_date',
      "Date d'ouverture",
      function () { // rendu du champs
        //esc_attr pour les attributs HTML dans les champs 
    ?>
      <input type="text" name="agence_date" value="<?= esc_attr(get_option('agence_date')) ?>" class="montheme_datepicker">

      <?php
      },
      self::GROUP,
      'agence_options_section'
    );

    self::class::placesSection();
    self::class::openDaysSection();
  }

  /**
   * Fonctions enregistrant les données des lieux de tournées dans le BO
   *
   * @return void
   */
  public static function placesSection()
  {

    // enregistrer le lieux de deplacement
    register_setting(
      self::GROUP,
      'agence_lieux',
    );

    // Ajoute une section pour les lieux de déplacement
    add_settings_section(
      'agence_options_lieux_section',
      'Parametres des lieux',
      function () {
        echo "Vous pouvez gérer ici les lieux de tournée";
      },
      self::GROUP
    );

    // Ajoute un champ pour les lieux de déplacement (avec textarea pour saisir les lieux
    for ($i = 1; $i < 4; $i++):

      add_settings_field(
        'agence_options_lieux_' . $i,
        // pour les valeur dyamiquement formater la chaine bonne pratique pour 
        sprintf("L'adresse pour le lieu n° %d", $i),
        function () use ($i) {  // Capture $i
          // Récupère les lieux enregistrés
          $lieux = get_option('agence_lieux', []);
          $lieu = isset($lieux[$i]) ? esc_html($lieux[$i]) : ''; ?>

        <textarea name="agence_lieux[<?php echo $i; ?>]" cols="20" rows="5" style="width : 100%" id="">
              <?= $lieu; ?>
    </textarea>
      <?php
        },
        self::GROUP,
        'agence_options_lieux_section'
      );



    endfor;
  }

  public static function openDaysSection()
  {
    // enregistrer le lieux de deplacement
    register_setting(
      self::GROUP,
      'agence_days',
    );

    add_settings_section(
      'agence_options_days_section',
      "Parametres des jours d'ouvertures",
      function () {
        echo "Vous pouvez gérer ici les jours ouvert de tournée";
      },
      self::GROUP
    );


    // Ajoute un champ pour les lieux de déplacement (avec textarea pour saisir les lieux
    for ($i = 1; $i < 4; $i++):
      add_settings_field(
        'agence_options_days' . $i,
        // pour les valeur dyamiquement formater la chaine bonne pratique pour 
        sprintf("Jours ouverts liés à l'emplacement n° %d", $i),
        function () use ($i) {  // Capture $i
          // Récupère les lieux enregistrés
          $days= get_option('agence_days', []);
          $day = isset($days[$i]) ? esc_html($days[$i]) : ''; ?>

        <textarea name="agence_days[<?php echo $i; ?>]" cols="20" rows="5" style="width : 100%" id="">
          <?= $day; ?>
</textarea>
    <?php
        },
        self::GROUP,
        'agence_options_days_section'
      );



    endfor;
  }




  /**
   *   Enregistre l'entrée dans le menu des réglages de WordPress
   */  public static function addMenu()
  {
    // Ajoute une entrée dans le menu "Réglages" pour afficher la page de gestion du food truck
    add_options_page("gestion du food truck", "Food Truck Infos", "manage_options", self::GROUP, [self::class, 'render']);
  }




  // -------------------------------- RENDU DE LA PAGE  ------------------------------------------------

  /**
   * Fonction qui génère le rendu de la page des options dans le back-office
   *
   * @return void
   */
  public static function render()
  {
    ?>
    <h1> Gestion du food truck </h1>

    <!-- options.php c'est l'api wordpress -->

    <form action="options.php" method="post">


      <?=
      // renvoie les valeur par defaut de register_setting : si il n'y en a pas renvoie false
      get_option('agence_horaire');
      get_option('agence_lieux'); ?>

      <?php
      // Génère les champs nécessaires pour la sécurité du formulaire: 
      // Génère les champs nonce, action et option_page pour une page de paramètres. 
      //( valation du referer : verifie si le user vient de la page agence_options, wp_nonce qui permet de valider le form)
      settings_fields(self::GROUP);

      // Génère les champs nécessaires pour la sécurité du formulaire
      do_settings_sections(self::GROUP);
      // fonction predefini qui enregistre le style de wordpress pour les boutons 
      submit_button() ?>
    </form>
<?php

  }
}
