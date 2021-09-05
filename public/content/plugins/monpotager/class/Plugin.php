<?php

namespace monPotager;

use monPotager\GardenerPlantationl;
use WP_REST_Request; //! A ENLEVER
use WP_Query;

class Plugin
{

    const regions = [
        'Auvergne-Rhône-Alpes'       => '_auvergne',
        'Bourgogne-Franche-Comté'    => '_bourgogne',
        'Bretagne'                   => '_bretagne',
        'Centre-Val de Loire'        => '_centre',
        'Corse'                      => '_corse',
        'Grand Est'                  => '_est',
        'Hauts-de-France'            => '_hauts',
        'Île-de-France'              => '_ile',
        'Normandie'                  => '_normandie',
        'Nouvelle-Aquitaine'         => '_aquitaine',
        'Occitanie'                  => '_occitanie',
        'Pays de la Loire'           => '_loire',
        'Provence-Alpes-Côte d’Azur' => '_azur',
    ];

    /**
     * Constructeur de la classe Plugin
     * rajoute les hooks pour créer les taxo et CPT
     */
    public function __construct()
    {
        $metaPeriod = new MetaPeriod();
        $userPlanting = new User_planting;
        $event = new Event();

        add_action('init', [$this, 'createPlanteCPT']);

        add_action('init', [$this, 'createPlanteTypeTaxonomy']);

        add_action('init', [$this, 'createPlanteRegionsTaxonomy']);

        add_action('add_meta_boxes', [$metaPeriod, 'metaboxesloadSemi']);
        add_action('save_post', [$metaPeriod, 'save_metaboxe']);

        add_action('rest_api_init', [$this, 'api_meta']);

        add_action('add_meta_boxes', [$userPlanting, 'user_Metaboxes_Planting']);
        add_action('save_post', [$userPlanting, 'saveUserMetaboxesDaysPlantation']);

        add_action('save_post', [$this, 'recoverAllDatas']);
        //add_action('rest_api_init', [$event, 'initialize']);
    }

    public function recoverAllDatas()
    {

         $idRegionSelected = 'aquitaine';

        $args = array(
            'post_type' => 'plante',
            'posts_per_page' => -1,
        );

        $post_query = new WP_Query($args);
        //var_dump($post_query);

        //var_dump($post_query->posts);exit;
        foreach ($post_query->posts as $post) {
            $planteId = 159; // Stock l'id du post
            $planteTitle = $post->post_title; // Stock le titre du post

            $periodeMetaBox = get_post_meta(159); // Récupère les metabox (les periodes) du post
           
           //var_dump($periodeMetaBox);exit;
            $termsRegions = get_terms(array(
                'taxonomy' => 'regions'
            ));
            //var_dump($termsRegions);exit;
            foreach ($termsRegions as $region) {
                if ($region->term_id == $idRegionSelected) {
                    $regionSelectedName = $region->name;
                    $regionSelectedSlug = $region->slug;
                }
                
            }
        }


        foreach (self::regions as $region => $value) { // Boucle sur le tableau des régions
           // if ($region === $regionSelectedName) {
                $debut_semi = $periodeMetaBox['debut_semi' . $value]; // Stocke la valeur des periodes
                $debut_plant = $periodeMetaBox['debut_plant' . $value];
                $debut_recolte = $periodeMetaBox['debut_recolte' . $value];
                $semis = substr($debut_semi[0], 5, 2); // Filtre pour ne garder que le mois
                //var_dump($semis);exit;
                $plantations = substr($debut_plant[0], 5, 2);
                $recoltes = substr($debut_recolte[0], 5, 2);

                if(isset($regionSelected) || isset($idRegionSelected)) {
                    //return 'Error: Aucune région séléctionnée pour la plante';
                }

                $listPeriodeRegions[$planteTitle]['id'] = $planteId; // Place l'id de la plante dans le tableau
                // var_dump($listPeriodeRegions);exit;
                if ($semis !== false) {
                    $listPeriodeRegions[$planteTitle]['debut_semi'][$region] = $semis; // Stock la donnée dans un tableau
                    //var_dump($listPeriodeRegions);exit;
                } else {
                    $listPeriodeRegions[$planteTitle]['debut_semi'][$region] = null;
                }

                if ($plantations !== false) {
                    $listPeriodeRegions[$planteTitle]['debut_plant'][$region] = $plantations;
                } else {
                    $listPeriodeRegions[$planteTitle]['debut_plant'][$region] = null;
                }

                if ($recoltes !== false) {
                    $listPeriodeRegions[$planteTitle]['debut_recolte'][$region] = $recoltes;
                } else {
                    $listPeriodeRegions[$planteTitle]['debut_recolte'][$region] = null;
                }
            //}

            $ActualMonth = date('m');
            //var_dump($ActualMonth);exit;
            if($ActualMonth === 12) {
                $nextMonth = '01';
            } else {
                $nextMonthInt = $ActualMonth + 1;
                //var_dump($nextMonthInt);exit;
                $nextMonth = strval($nextMonthInt);  // INT --> String
                //var_dump($nextMonth);exit;
            }
            setlocale (LC_TIME, 'fr_FR.utf8'); 
            $fullDate = date('Y-'.$nextMonth.'-d');
            $test = strtotime($fullDate);
            $monthReturn = strftime("%B",strtotime($fullDate));
            //var_dump($test);exit;
    
            $listEvent = [];
    
            $listEvent['selectedRegion'] = array('id' => 9,
                                                'name' => 'fraise');
            
            $listEvent['selectedPeriod']['startDate'] = $monthReturn;
            //var_dump($listPeriodeRegions);exit;
            foreach($listPeriodeRegions as $plante => $data) {
                $regionSemi = array_keys($data['debut_semi'], $nextMonth);
                $regionPlant = array_keys($data['debut_plant'], $nextMonth);
                $regionRecolte = array_keys($data['debut_recolte'], $nextMonth);
                //var_dump($regionPlant);exit;
                $arrayPlant = array('id' => $data['id'],
                                   'name' => $plante);
                //var_dump($arrayPlant);exit;
                if($regionSemi) {
                    $listEvent['semis'][] = $arrayPlant;
                }
    
                if($regionPlant) {
                    $listEvent['plantation'][] = $arrayPlant;
                }
    
                if($regionRecolte) {
                    $listEvent['recolte'][] = $arrayPlant;
                }
            }
            var_dump($listEvent) ;


        }


        
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
                'excerpt'
            ],

        ]);
    }

    /**
     * Crée la taxonomie 'Ingrédient', liée au cpt Recipe
     */
    public function createPlanteRegionsTaxonomy()
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

    public function api_meta()
    {
        register_rest_field(
            'plante',
            'periode_regions',
            array(
                'get_callback' => [$this, 'get_post_meta_for_api'],
                'schema' => null,
                'posts_per_page' => -1
            )
        );
    }

    public function get_post_meta_for_api($object)
    {
        $post_id = $object['id'];


        return get_post_meta($post_id);
    }
}
