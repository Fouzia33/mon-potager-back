<?php

namespace monPotager;

class Meta_semi
{
    


    public function metaboxes_StartSemi()
    {

        add_meta_box('id_semi', 'Semi', [$this, 'start_semi'], 'plante', 'side');
    }
    
    public function start_semi($post)
    {
        $val = get_post_meta($post->ID, 'debut_semi', true);
        $value = get_post_meta($post->ID, 'fin_semi', true);


        echo '<label for="start_semi">Début semi : </label>';
        echo '<input id="start_semi" type="text" name="start_semi" value="' . $val . '" />';
        echo '<br>';
        echo '<label for="end_semi">Fin semi : </label>';
        echo '<input id="end_semi" type="text" name="end_semi" value="' . $value . '" />';
    }


    public function save_metaboxes($post_ID)
    {


        if (isset($_POST['start_semi'])&& $_POST['start_semi'] !=='') {
            update_post_meta($post_ID, 'debut_semi', esc_html($_POST['start_semi']));
        } else {
            
            delete_post_meta($post_ID, 'debut_semi');
            
        }

        if (isset($_POST['end_semi'])&& $_POST['end_semi'] !=='') {
            update_post_meta($post_ID, 'fin_semi', esc_html($_POST['end_semi']));
        } else {
            
            delete_post_meta($post_ID, 'fin_semi');
            
        }


    }

    public function api_meta()
    {

        register_rest_field(
            'plante',
            'semi',
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