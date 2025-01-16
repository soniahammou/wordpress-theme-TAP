<?php

class VeganMetaBox
{
    // Déclaration des constantes utilisées dans la classe
    const META_KEY = 'montheme_vegan'; // Clé pour identifier la métadonnée (dans la base de données)
    const NONCE = '_montheme_vegan_nonce'; // Clé utilisée pour sécuriser la métabox avec un nonce

    // Méthode statique pour enregistrer les hooks nécessaires (liaison avec WordPress)
    public static function register()
    {
        // Hook pour ajouter la métabox au panneau d'édition d'article
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        // Hook déclenché lors de la sauvegarde d'un article pour gérer la métadonnée
        add_action('save_post', [self::class, 'save']);
    }

    // ---------------- LES MÉTADONNÉES ----------------

    /**
     * Méthode pour ajouter la métabox à l'écran d'édition d'article
     * 
     * @param string $postType Type de contenu en cours d'édition (ex : 'post' pour les articles)
     * @param WP_Post $post L'objet de l'article en cours d'édition
     */
    public static function add($postType, $post)
    {
        // Vérifie que le type de contenu est un article +custom post type "recette" et que l'utilisateur a le droit de publier
        if ($postType === 'recette'|| 'post' && current_user_can('publish_posts', $post)) {

            // Ajoute une métaboxdans la colonne latérale de l'interface d'édition
            add_meta_box(
                self::META_KEY, 
                'Vegetarien',
                [self::class, 'render'], 
                ['recette', 'post'], 
                'side' // Position de la métabox (dans la colonne latérale)
            );
        }
    }

    /**
     * Méthode pour afficher le contenu HTML de la métabox
     * 
     * @param WP_Post $post L'objet de l'article en cours d'édition
     */
    public static function render($post)
    {
        // Récupère la valeur actuelle de la métadonnée pour cet article
        $value = get_post_meta($post->ID, self::META_KEY, true);
        
        // Génére un champ nonce pour sécuriser la requête (éviter les attaques CSRF)
        wp_nonce_field(self::NONCE, self::NONCE);
?>
        <!-- Champ caché pour enregistrer la valeur "0" si la case n'est pas cochée -->
        <input type="hidden" value="0" name="<?= self::META_KEY ?>">

        <!-- Case à cocher pour indiquer si le prdouit est vegan -->
        <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?php checked($value, '1') ?>>
        <label for="montheme_vegan">Ce produit est vegan ?</label>
<?php
    }

    /**
     * Méthode pour traiter et enregistrer les données de la métabox lors de la sauvegarde d'un article
     * 
     * @param int $post ID de l'article en cours de sauvegarde
     * @return void
     */
    public static function save($post)
    {
      
        if (
            array_key_exists(self::META_KEY, $_POST) &&
            current_user_can('publish_posts', $post) &&
            wp_verify_nonce($_POST[self::NONCE], self::NONCE)
        ) {
            // Si la valeur soumise est "0", on supprime la métadonnée de la base de données
            if ($_POST[self::META_KEY] === '0') {
                delete_post_meta($post, self::META_KEY);
            } else {
                // Sinon, on met à jour (ou crée) la métadonnée avec la valeur "1"
                update_post_meta($post, self::META_KEY, 1);
            }
        }

          //var_dump(wp_verify_nonce($_POST[self::NONCE], self::NONCE));
       // die();

    }
}
