<?php

namespace monPotager;

class Meta_harvest
{

    public function metaboxes_StartHarvest()
    {
        add_meta_box('id_harvest', 'Récolte', [$this, 'start_harvest'], 'plante', 'side');

    }

    public function start_harvest($post)
    {

        $val = get_post_meta($post->ID, 'debut_recolte', true);
        $value = get_post_meta($post->ID, 'fin_recolte', true);


        echo '<label for="start_harvest">Début récolte : </label>';
        echo '<input id="start_harvest" type="text" name="start_harvest" value="' . $val . '" />';
        echo '<br>';
        echo '<label for="end_harvest">Fin récolte : </label>';
        echo '<input id="end_harvest" type="text" name="end_harvest" value="' . $value . '" />';

    }


    public function saveMetaboxesHarvest($post_ID)
    {

        if (isset($_POST['start_harvest']) && $_POST['start_harvest'] !== '') {
            update_post_meta($post_ID, 'debut_recolte', esc_html($_POST['start_harvest']));
        } else {

            delete_post_meta($post_ID, 'debut_recolte');
        }

        if (isset($_POST['end_harvest']) && $_POST['end_harvest'] !== '') {
            update_post_meta($post_ID, 'fin_recolte', esc_html($_POST['end_harvest']));
        } else {

            delete_post_meta($post_ID, 'fin_recolte');
        }

    }

    
    



}