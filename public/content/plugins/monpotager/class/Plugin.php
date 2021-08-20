<?php

namespace monPotager;
use monPotager\Meta_semi;
use monPotager\Meta_planting;

class Plugin
{
    /**
     * Constructeur de la classe Plugin
     * rajoute les hooks pour créer les taxo et CPT
     */
    public function __construct()
    {
        $mySemi = new Meta_semi();
        $myPlanting = new Meta_planting;

        add_action('init', [$this, 'createPlanteCPT']);

        add_action('init', [$this, 'createPlanteTypeTaxonomy']);

        add_action('init', [$this, 'regions_Taxonomy']);

        add_action('init', [$this, 'season_Taxonomy']);

        add_action('add_meta_boxes', [$mySemi, 'metaboxes_StartSemi']);
        add_action('save_post', [$mySemi, 'save_metaboxes']);
        add_action('rest_api_init', [$mySemi, 'api_meta']);

        add_action('add_meta_boxes', [$myPlanting, 'metaboxes_StartPlanting']);
        add_action('save_post', [$myPlanting, 'saveMetaboxesPlanting']);
        add_action('rest_api_init', [$myPlanting, 'api_metaPlanting']);
        

        //add_action('add_meta_boxes', [$this, 'metaboxes_Plantation']);



        
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


    

    


    

    // public function metaboxes_Plantation()
    // {

    //     add_meta_box('id_plantation', 'Plantation', [$this, 'start_plantation'], 'plante', 'side');
    // }

    



    
    
}
