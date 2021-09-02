<?php

namespace monPotager;

use WP_REST_Request;
use WP_Query;

class Event
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
     * @var string
     */
    protected $baseURI;

    public function __construct()
    {
        // registration of our custom api
        add_action('rest_api_init', [$this, 'initialize']);

    }


    public function initialize()
    {
        // retrieve a folder name from a file path
        $this->baseURI = dirname($_SERVER['SCRIPT_NAME']);

        // Create new API route
        register_rest_route(
            'monpotager/v1', // name of an API
            '/event', // the endpoint that will be put after the name of the api
            [
                'methods' => 'get', // the method used
                'callback' => [$this, 'recoverAllDatas']
            ]
        );
    }

    public function recoverAllDatas()
    {
        $args = array(
            'post_type' => 'plante',
            'posts_per_page'=> -1, 
        );
    
        $post_query = new WP_Query($args);
        //var_dump($post_query->posts);exit;
        foreach($post_query->posts as $post) {
            $id = $post->ID;
            $planteTitle = $post->post_title;
            $periodeMetaBox = get_post_meta($id);

            foreach(self::regions as $region => $value) {

                $debut_semi = $periodeMetaBox['debut_semi' . $value];
                $debut_plant = $periodeMetaBox['debut_plant' . $value];
                $debut_recolte = $periodeMetaBox['debut_recolte' . $value];

                $semis = substr($debut_semi[0], 5, 2);
                $plantations = substr($debut_plant[0], 5, 2);
                $recoltes = substr($debut_recolte[0], 5, 2);

                if($semis !== '') {
                    $listPeriodeRegions[$planteTitle]['debut_semi'][$region] = $semis;
                }

                if ($plantations !== '') {
                    $listPeriodeRegions[$planteTitle]['debut_plant'][$region] = $plantations;
                }

                if ($recoltes !== '') {
                    $listPeriodeRegions[$planteTitle]['debut_recolte'][$region] = $recoltes;
                }
                 
            }
        }

        $region = 'Auvergne-Rhône-Alpes';

        $this->sendEvent($listPeriodeRegions, $region);
    }

    public function sendEvent($liste, $region)
    {
        $ActualMonth = date('m');
        if($ActualMonth === 12) {
            $nextMonth = '01';
        } else {
            $nextMonthInt = $ActualMonth + 1;
            $nextMonth = strval($nextMonthInt);
        }

        foreach($liste as $plante => $data) {
            var_dump($data);
            $regionSemi = array_keys($data['debut_semi'], $nextMonth);
            $regionPlant = array_keys($data['debut_plant'], $nextMonth);
            $regionRecolte = array_keys($data['debut_recolte'], $nextMonth);


            var_dump($region);
        }

        //var_dump($liste);
    }



}