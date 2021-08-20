<?php

namespace monPotager;

class User_semi
{
    public function user_Metaboxes_Semi()
    {

    add_meta_box('id_user_semi', 'Période Semi', [$this, 'user_days_semi'], 'plante', 'side');

    }

    public function user_days_semi($post)
    {

        
        $value = get_post_meta($post->ID, 'nb_jours_periode_semi', true);


        echo '<label for="user_periode_semi">Nombre de jours période semi : </label>';
        echo '<input id="user_periode_semi" type="text" name="user_periode_semi" value="' . $value . '" />';
        
    }

    public function saveUserMetaboxesPeriodeSemi($post_ID)
    {

        if (isset($_POST['user_periode_semi'])&& $_POST['user_periode_semi'] !=='') {
            update_post_meta($post_ID, 'nb_jours_periode_semi', esc_html($_POST['user_periode_semi']));
        } else {
            
            delete_post_meta($post_ID, 'nb_jours_periode_semi');
            
        }

    }




}