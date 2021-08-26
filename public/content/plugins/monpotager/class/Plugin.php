<?php

namespace monPotager;
use monPotager\GardenerPlantationl;

class Plugin
{
    /**
     * Constructeur de la classe Plugin
     * rajoute les hooks pour créer les taxo et CPT
     */
    public function __construct()
    {
        $maSemi = new MetaPeriode();
        $userPlanting = new User_planting;

        add_action('init', [$this, 'createPlanteCPT']);

        add_action('init', [$this, 'createPlanteTypeTaxonomy']);

        add_action('init', [$this, 'season_Taxonomy']);

        add_action('add_meta_boxes', [$maSemi, 'metaboxesloadSemi']);

        add_action('save_post', [$maSemi, 'save_metaboxeAuvergne']);
        add_action('save_post', [$maSemi, 'save_metaboxeBourgogne']);
        add_action('save_post', [$maSemi, 'save_metaboxeBretagne']);
        add_action('save_post', [$maSemi, 'save_metaboxeCentre']);
        add_action('save_post', [$maSemi, 'save_metaboxeCorse']);
        add_action('save_post', [$maSemi, 'save_metaboxeEst']);
        add_action('save_post', [$maSemi, 'save_metaboxeHauts']);
        add_action('save_post', [$maSemi, 'save_metaboxeIle']);
        add_action('save_post', [$maSemi, 'save_metaboxeNormandie']);
        add_action('save_post', [$maSemi, 'save_metaboxeAquitaine']);
        add_action('save_post', [$maSemi, 'save_metaboxeOccitanie']);
        add_action('save_post', [$maSemi, 'save_metaboxeLoire']);
        add_action('save_post', [$maSemi, 'save_metaboxeAzur']);

        add_action('rest_api_init', [$this, 'api_meta']);

        add_action('add_meta_boxes', [$userPlanting, 'user_Metaboxes_Planting']);
        add_action('save_post', [$userPlanting, 'saveUserMetaboxesDaysPlantation']);


    }

    public function activate()
    {
        $this->registerGardenerRole();

        $gardenerplant = new GardenerPlantation;
        $gardenerplant->createTable();
    }

    public function deactivate()
    {
        remove_role('gardener');

        $gardenerplant = new GardenerPlantation;
        $gardenerplant->dropTable();
    }

    public function registerGardenerRole()
    {
        add_role(
            'gardener',
            'Jardinier'
        );
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


    public function api_meta()
    {

        register_rest_field(
            'plante',
            'periode_regions',
            array(
                'get_callback' => [$this,'get_post_meta_for_api'],
                'schema' => null,
            )
        );
    }

    public function get_post_meta_for_api($object)
    {
        
        $post_id = $object['id'];
        //var_dump(get_post_meta($post_id));die;
        
        return get_post_meta($post_id);
    }   
}
