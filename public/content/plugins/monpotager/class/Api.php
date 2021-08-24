<?php

namespace monPotager;


use WP_REST_Request;
use WP_User;

class Api
{

    /**
     * @var string
     */
    protected $baseURI;

    public function __construct()
    {
        // STEP API enregistrement de notre api custom
        add_action('rest_api_init', [$this, 'initialize']);
    }

    public function initialize()
    {
        // DOC PHP récupération du nom d'un dossier depuis un chemain de fichier https://www.php.net/dirname
        $this->baseURI = dirname($_SERVER['SCRIPT_NAME']);


        // STEP WP création d'une route d'API
        // DOC WP création d'une route d'API https://developer.wordpress.org/reference/functions/register_rest_route/

        register_rest_route(
            'monpotager/v1', // le nom de notre API
            '/inscription', // la route qui se mettra après le nom de notre api
            [
                // WARNING WP route api "methods" avec un S !
                'methods' => 'post',
                'callback' => [$this, 'inscription']
            ]
        );

        register_rest_route(
            'monpotager/v1', // le nom de notre API
            '/plante-save', // la route qui se mettra après le nom de notre api
            [
                // WARNING WP route api "methods" avec un S !
                'methods' => 'post',
                'callback' => [$this, 'planteSave']
            ]
        );
    }

    public function planteSave(WP_REST_Request $request) {
        $id_user = $request->get_param('id_user');
        $id_plante = $request->get_param('id_plante');
        $status = $request->get_param('status');

        $user = wp_get_current_user();

        //if (in_array('gardener', (array) $user->roles)) {
            $gardenerPlantation = new GardenerPlantation();
            $gardenerPlantation->insert($id_user, $id_plante, $status);

            return [
                'status' => 'sucess',
            ];
        //} else  {
            // return [
            //     'status' => 'failed',
            // ];
        //}

        
    }

    public function inscription(WP_REST_Request $request)
    {
        $email = $request->get_param('email');
        // équivalent à filter_input(INPUT_POST, 'password')
        $password = $request->get_param('password');

        $userName = $request->get_param('username');

        // Création d'un nouvel utilisateur
        // DOC WP creation d'un utilisateur : https://developer.wordpress.org/reference/functions/wp_create_user/
        $userCreateResult = wp_create_user(
            $userName,
            $password,
            $email
        );

        // Vérification est ce que l'utilisateur a bien été créé
        if (is_int($userCreateResult)) {
            // STEP WP modification des rôles d'un utilisateur
            $user = new WP_User($userCreateResult);

            // Remove role
            $user->remove_role('subscriber');
            // Add role
            $user->add_role('gardener');

            // STEP WP API valeurs qui seront retournées par l'api (données utilisable par le front)
            return [
                'success' => true,
                'userId' => $userCreateResult,
                'username' => $userName,
                'email' => $email,
                'role' => 'gardener'
            ];
        } else {
            // l'utilisateur n'a pas été créé, il y a eu une erreur
            // Lorsque
            return [
                'success'=> false,
                'error' => $userCreateResult
            ];
        }
    }
}