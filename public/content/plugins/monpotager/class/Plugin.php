<?php

namespace monPotager;

class Plugin
{

    /**
     * Constructeur de la classe Plugin
     * rajoute les hooks pour créer les taxo et CPT
     */
    public function __construct()
    {
        add_action('init', [$this, 'createPlanteCPT']);

        add_action('init', [$this, 'createPlanteTypeTaxonomy']);

        add_action('init', [$this, 'regions_Taxonomy']);

        add_action('init', [$this, 'season_Taxonomy']);

        add_action('add_meta_boxes', [$this, 'metaboxes_StartSemi']);

        add_action('save_post', [$this, 'save_metaboxes']);

        //add_action('rest_api_init', [$this, 'api_meta']);
    }

    /**
     * Rajoute un nouveau post type à wp
     * Cette fonction doit être appelée par un hook, si possible lors de l'action 'init'
     */
    public function createPlanteCPT()
    {
        register_post_type('plante', [

            'labels' => [
                'name'          => 'Plantes',
                'singular_name' => 'Plante',
                'add_new'       => 'Ajouter une plante',
                'add_new_item'  => 'Ajouter une plante',
                'not_found'     => 'Aucun plante trouvée',
                'edit_item'     => 'Modifier la plante',
            ],

            'public' => true,
            'menu_icon' => 'dashicons-carrot',
            add_theme_support('post-thumbnails'),

            //  Je veux que mes plantes apparaissent dans l'API fournis par WP
            'show_in_rest' => true,

            'supports' => [
                'title',
                'thumbnail',
                'editor',
            ],
        ]);
    }

    /**
     * Crée la taxonomie 'Ingrédient', liée au cpt Recipe
     */
    public function createPlanteTypeTaxonomy()
    {
        register_taxonomy(
            'plante_type',
            ['plante'],
            [
                'label' => 'Type de plante',
                'show_in_rest'  => true,
                'hierarchical'  => false,
                'public'        => true,
            ],
        );
    }

    public function regions_Taxonomy()
    {
        register_taxonomy(
            'regions',
            ['plante'],
            [
                'label' => 'Régions',
                'show_in_rest'  => true,
                'hierarchical'  => false,
                'public'        => true,
            ],
        );
    }

    public function season_Taxonomy()
    {
        register_taxonomy(
            'season',
            ['plante'],
            [
                'label' => 'Saisons',
                'show_in_rest'  => true,
                'hierarchical'  => false,
                'public'        => true,
            ],
        );
    }


    public function metaboxes_StartSemi()
    {

        add_meta_box('id', 'Semi', [$this, 'start_semi'], 'plante', 'side');
    }

    public function start_semi($post)
    {
        $val = get_post_meta($post->ID, 'debut_semi', true);
        $value = get_post_meta($post->ID, 'fin_semi', true);


        echo '<label for="start_semi">Début semi : </label>';
        echo '<input id="start_semi" type="text" name="start_semi" value="' . $val . '" />';
        echo '<br>';
        echo '<label for="end_semi">Fin semi : </label>';
        echo '<input id="end_semi" type="text" name="end_semi" value="' . $value . '" />';
    }


    public function save_metaboxes($post_ID)
    {


        if (isset($_POST['start_semi'])&& $_POST['start_semi'] !=='') {
            update_post_meta($post_ID, 'debut_semi', esc_html($_POST['start_semi']));
        } else {
            
            delete_post_meta($post_ID, 'debut_semi');
            
        }

        if (isset($_POST['end_semi'])&& $_POST['end_semi'] !=='') {
            update_post_meta($post_ID, 'fin_semi', esc_html($_POST['end_semi']));
        } else {
            
            delete_post_meta($post_ID, 'fin_semi');
            
        }


    }



    // public function api_meta()
    // {

    //     register_rest_field(
    //         'plante',
    //         'jours_recolte',
    //         array(
    //             'get_callback' => 'get_post_meta_for_api',
    //             'schema' => null,
    //         )
    //     );
    // }

    // public function get_post_meta_for_api($object)
    // {
    //     //get the id of the post object array
    //     $post_id = $object['id'];

    //     //return the post meta
    //     return get_post_meta($post_id);
    // }
}
