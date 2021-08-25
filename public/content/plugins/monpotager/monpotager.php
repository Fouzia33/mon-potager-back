<?php

/**
 * Plugin Name: monPotager
 */

use monPotager\Plugin;
use monPotager\Api;


require __DIR__ . '/vendor-monpotager/autoload.php';

$monPotager = new Plugin();

$api = new Api();

register_activation_hook(
   __FILE__,
   [$monPotager, 'activate']
);


register_deactivation_hook(
   __FILE__,
   [$monPotager, 'deactivate']
);

add_filter('rest_user_query', 'remove_has_published_posts_from_api_user_query', 10, 1); // Hook / Callback / Priority / Accepted arguments

function remove_has_published_posts_from_api_user_query($prepared_args)
{
    unset($prepared_args['has_published_posts']);

    return $prepared_args;
}