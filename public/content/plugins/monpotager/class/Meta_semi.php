<?php

namespace monPotager;

class Meta_semi
{
    const calendrier = [
        'Janvier'   => '2021-01-01',
        'Février'   => '2021-02-01',
        'Mars'      => '2021-03-01',
        'Avril'     => '2021-04-01',
        'Mai'       => '2021-05-01',
        'Juin'      => '2021-06-01',
        'Juillet'   => '2021-07-01', 
        'Aout'      => '2021-08-01',
        'Septembre' => '2021-09-01',
        'Octobre'   => '2021-10-01',
        'Novembre'  => '2021-11-01',
        'Décembre'  => '2021-12-01' ];

    public function metaboxesloadSemi()
    {
        add_meta_box('start_semi', 'Periode de culture', [$this, 'loadSemi'], 'plante', 'side');
    }
    
    public function loadSemi($post)
    {
        // *********** SEMIS ************ //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';

        // *********** PLANTATION ************ //


        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';

        // *********** RECOLTE *************** //

        $valueMonthBeginsHarvest = get_post_meta($post->ID,'start_harvest',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';

    }


    public function save_metaboxes($post_ID)
    {

        // *********** SEMIS ************ //
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

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant'])&& $_POST['start_plant'] !=='') {
            update_post_meta($post_ID, 'debut_plant', esc_html($_POST['start_plant']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi');
        }

        if (isset($_POST['end_plant'])&& $_POST['end_plant'] !=='') {
            update_post_meta($post_ID, 'fin_plant', esc_html($_POST['end_plant']));
        } else {
            delete_post_meta($post_ID, 'fin_plant'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest'])&& $_POST['start_harvest'] !=='') {
            update_post_meta($post_ID, 'debut_recolte', esc_html($_POST['start_harvest']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi');
        }

        if (isset($_POST['end_harvest'])&& $_POST['end_harvest'] !=='') {
            update_post_meta($post_ID, 'fin_recolte', esc_html($_POST['end_harvest']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte'); 
        }
    }

    public function api_meta()
    {
        register_rest_field(
            'plante',
            'Periodes',
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