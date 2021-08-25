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
            '/inscription', // the endpoint that will be put after the name of the api
            [
                'methods' => 'post', // the method used
                'callback' => [$this, 'inscription']
            ]
        );

        register_rest_route(
            'monpotager/v1',
            '/plante-save', 
            [
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
        $password = $request->get_param('password');
        $userName = $request->get_param('username');

        // Create new user
        $userCreateResult = wp_create_user(
            $userName,
            $password,
            $email
        );

        // Verification that the user has been created
        if (is_int($userCreateResult)) {

            $user = new WP_User($userCreateResult);

            // Remove role
            $user->remove_role('subscriber');
            // Add role
            $user->add_role('gardener');

            // values that will be returned by the api 
            return [
                'success' => true,
                'userId' => $userCreateResult,
                'username' => $userName,
                'email' => $email,
                'role' => 'gardener'
            ];
        } else {  // if the user was not created, the error occurred
            return [
                'success'=> false,
                'error' => $userCreateResult
            ];
        }
    }
}