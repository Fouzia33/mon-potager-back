<?php
namespace monPotager;

class Plugin {

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

        
        //add_action( 'create_term', 'my_create', 10, 3 );
    }

    public function activate()
    {
        //! Les roles doivent etre déclrarés lors de l'ACTIVATION DU PLUGIN
        $this->registerGardenerRole();
        //$this->createPlanteCPT();

    }

    public function deactivate(){
         //! Les roles doivent etre supprimés lors de la DESACTIVATIONDU PLUGIN
        remove_role('gardener');
    }

    //! ROLES
    public function registerGardenerRole()
    {
        // add_role https://developer.wordpress.org/reference/functions/add_role/
        add_role(
            //identifiant
            'gardener',
            //libellé
            'Jardinier',
            //Liste des autorisations
            [
                'delete_gardeners' => false,
                'delete_others_gardeners' => false,
                'delete_private_gardeners' => false,
                'delete_published_gardeners' => false,
                'edit_gardeners' => true,
                'edit_others_gardeners' => false,
                'edit_private_gardeners' => false,
                'edit_published_gardeners' => true,
                'publish_gardeners' => true,
                'read_private_gardeners' => false,

            ]
        );

        // je cible un role :
        // $developerRole = get_role('developer');
        // $developerRole->add_cap('edit_customers');


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

}