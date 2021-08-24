<?php

namespace monPotager;

class MetaPeriode
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
        
        add_meta_box('auvergne', 'Periode de culture Auvergne-Rhône-Alpes', [$this, 'loadAuvergne'], 'plante', 'normal');
        add_meta_box('bourgogne', 'Periode de culture Bourgogne-Franche-Comté', [$this, 'loadBourgogne'], 'plante', 'normal');
        add_meta_box('bretagne', 'Periode de culture Bretagne', [$this, 'loadBretagne'], 'plante', 'normal');
        add_meta_box('centre', 'Periode de culture Centre-Val de Loire', [$this, 'loadCentre'], 'plante', 'normal');
        add_meta_box('corse', 'Periode de culture Corse', [$this, 'loadCorse'], 'plante', 'normal');
        add_meta_box('est', 'Periode de culture Grand Est', [$this, 'loadEst'], 'plante', 'normal');
        add_meta_box('hauts', 'Periode de culture Hauts', [$this, 'loadHauts'], 'plante', 'normal');
        add_meta_box('ile', 'Periode de culture Île-de-France', [$this, 'loadIle'], 'plante', 'normal');
        add_meta_box('aquitaine', 'Periode de culture Nouvelle-Aquitaine', [$this, 'loadAquitaine'], 'plante', 'normal');
        add_meta_box('normandie', 'Periode de culture Normandie', [$this, 'loadNormandie'], 'plante', 'normal');
        add_meta_box('occitanie', 'Periode de culture Occitanie', [$this, 'loadOccitanie'], 'plante', 'normal');
        add_meta_box('loire', 'Periode de culture Pays de la Loire', [$this, 'loadLoire'], 'plante', 'normal');
        add_meta_box('azur', 'Periode de culture Provence-Alpes-Côte d’Azure', [$this, 'loadAzur'], 'plante', 'normal');

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
            delete_post_meta($post_ID, 'debut_recolte');
        }

        if (isset($_POST['end_harvest'])&& $_POST['end_harvest'] !=='') {
            update_post_meta($post_ID, 'fin_recolte', esc_html($_POST['end_harvest']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte'); 
        }
    }

        // *********** Auvergne *************** //
    

    public function loadAuvergne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function loadBourgogne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function loadBretagne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadCentre($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadCorse($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadEst($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadHauts($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadIle($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadNormandie($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadAquitaine($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadOccitanie($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadLoire($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    public function loadAzur($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
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