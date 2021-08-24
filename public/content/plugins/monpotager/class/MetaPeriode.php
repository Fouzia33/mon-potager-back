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

        const colors = [
            'Légume'     => '#067106',
            'Fruit'      => '#0E5671',
            'Arôme'      => '#719C0F'];

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

        

        add_meta_box('colors_type', 'Couleurs de type', [$this, 'loadcolor'], 'plante', 'side');

    }

       // *********** Auvergne *************** //
    

    public function loadAuvergne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_auvergne',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_auvergne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_auvergne',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_auvergne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_auvergne',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_auvergne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_auvergne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeAuvergne($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_auvergne'])&& $_POST['start_semi_auvergne'] !=='') {
            update_post_meta($post_ID, 'debut_semi_auvergne', esc_html($_POST['start_semi_auvergne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_auvergne');
        }

        if (isset($_POST['end_semi'])&& $_POST['end_semi_auvergne'] !=='') {
            update_post_meta($post_ID, 'fin_semi_auvergne', esc_html($_POST['end_semi_auvergne']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_auvergne'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_auvergne'])&& $_POST['start_plant_auvergne'] !=='') {
            update_post_meta($post_ID, 'debut_plant_auvergne', esc_html($_POST['start_plant_auvergne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_auvergne');
        }

        if (isset($_POST['end_plant_auvergne'])&& $_POST['end_plant_auvergne'] !=='') {
            update_post_meta($post_ID, 'fin_plant_auvergne', esc_html($_POST['end_plant_auvergne']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_auvergne'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_auvergne'])&& $_POST['start_harvest_auvergne'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_auvergne', esc_html($_POST['start_harvest_auvergne']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_auvergne');
        }

        if (isset($_POST['end_harvest_auvergne'])&& $_POST['end_harvest_auvergne'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_auvergne', esc_html($_POST['end_harvest_auvergne']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_auvergne'); 
        }
    }

    // *********** Bourgogne-Franche-Comté *************** //

    public function loadBourgogne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_bretagne',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_bourgogne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_bourgogne',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_bourgogne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_bourgogne',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_bourgogne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_bourgogne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeBourgogne($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_bourgogne'])&& $_POST['start_semi_bourgogne'] !=='') {
            update_post_meta($post_ID, 'debut_semi_bourgogne', esc_html($_POST['start_semi_bourgogne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_bourgogne');
        }

        if (isset($_POST['end_semi'])&& $_POST['end_semi_bourgogne'] !=='') {
            update_post_meta($post_ID, 'fin_semi_bourgogne', esc_html($_POST['end_semi_bourgogne']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_bourgogne'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_bourgogne'])&& $_POST['start_plant_bourgogne'] !=='') {
            update_post_meta($post_ID, 'debut_plant_bourgogne', esc_html($_POST['start_plant_bourgogne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_bourgogne');
        }

        if (isset($_POST['end_plant_bourgogne'])&& $_POST['end_plant_bourgogne'] !=='') {
            update_post_meta($post_ID, 'fin_plant_bourgogne', esc_html($_POST['end_plant_bourgogne']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_bourgogne'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_bourgogne'])&& $_POST['start_harvest_bourgogne'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_bourgogne', esc_html($_POST['start_harvest_bourgogne']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_bourgogne');
        }

        if (isset($_POST['end_harvest_bourgogne'])&& $_POST['end_harvest_bourgogne'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_bourgogne', esc_html($_POST['end_harvest_bourgogne']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_bourgogne'); 
        }
    }

        // *********** Bretagne *************** //


    public function loadBretagne($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_bretagne',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_bretagne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_bretagne',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_bretagne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_bretagne',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_bretagne',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_bretagne">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }
    
    public function save_metaboxeBretagne($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_bretagne'])&& $_POST['start_semi_bretagne'] !=='') {
            update_post_meta($post_ID, 'debut_semi_bretagne', esc_html($_POST['start_semi_bretagne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_bretagne');
        }

        if (isset($_POST['end_semi_bretagne'])&& $_POST['end_semi_bretagne'] !=='') {
            update_post_meta($post_ID, 'fin_semi_bretagne', esc_html($_POST['end_semi_bretagne']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_bretagne'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_bretagne'])&& $_POST['start_plant_bretagne'] !=='') {
            update_post_meta($post_ID, 'debut_plant_bretagne', esc_html($_POST['start_plant_bretagne']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_bretagne');
        }

        if (isset($_POST['end_plant_bretagne'])&& $_POST['end_plant_bretagne'] !=='') {
            update_post_meta($post_ID, 'fin_plant_bretagne', esc_html($_POST['end_plant_bretagne']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_bretagne'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_bretagne'])&& $_POST['start_harvest_bretagne'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_bretagne', esc_html($_POST['start_harvest_bretagne']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_bretagne');
        }

        if (isset($_POST['end_harvest_bretagne'])&& $_POST['end_harvest_bretagne'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_bretagne', esc_html($_POST['end_harvest_bretagne']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_bretagne'); 
        }
    }

        // *********** Centre-Val de Loire *************** //

    public function loadCentre($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_corse',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_centre">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_centre',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_centre">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_centre',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_centre">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_centre',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_centre">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_centre',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_centre">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_centre',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_centre">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeCentre($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_centre'])&& $_POST['start_semi_centre'] !=='') {
            update_post_meta($post_ID, 'debut_semi_centre', esc_html($_POST['start_semi_centre']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_centre');
        }

        if (isset($_POST['end_semi_centre'])&& $_POST['end_semi_centre'] !=='') {
            update_post_meta($post_ID, 'fin_semi_centre', esc_html($_POST['end_semi_centre']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_centre'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_centre'])&& $_POST['start_plant_centre'] !=='') {
            update_post_meta($post_ID, 'debut_plant_centre', esc_html($_POST['start_plant_centre']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_centre');
        }

        if (isset($_POST['end_plant_centre'])&& $_POST['end_plant_centre'] !=='') {
            update_post_meta($post_ID, 'fin_plant_centre', esc_html($_POST['end_plant_centre']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_centre'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_centre'])&& $_POST['start_harvest_centre'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_centre', esc_html($_POST['start_harvest_centre']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_centre');
        }

        if (isset($_POST['end_harvest_centre'])&& $_POST['end_harvest_centre'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_centre', esc_html($_POST['end_harvest_centre']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_centre'); 
        }
    }

        // *********** Corse *************** //

    public function loadCorse($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_corse',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_corse">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_corse',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_corse">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_corse',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_corse">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_corse',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_corse">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_corse',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_corse">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_corse',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_corse">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeCorse($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_corse'])&& $_POST['start_semi_corse'] !=='') {
            update_post_meta($post_ID, 'debut_semi_corse', esc_html($_POST['start_semi_corse']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_corse');
        }

        if (isset($_POST['end_semi_corse'])&& $_POST['end_semi_corse'] !=='') {
            update_post_meta($post_ID, 'fin_semi_corse', esc_html($_POST['end_semi_corse']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_corse'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_corse'])&& $_POST['start_plant_corse'] !=='') {
            update_post_meta($post_ID, 'debut_plant_corse', esc_html($_POST['start_plant_corse']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_corse');
        }

        if (isset($_POST['end_plant_corse'])&& $_POST['end_plant_corse'] !=='') {
            update_post_meta($post_ID, 'fin_plant_corse', esc_html($_POST['end_plant_corse']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_corse'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_corse'])&& $_POST['start_harvest_corse'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_corse', esc_html($_POST['start_harvest_corse']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_corse');
        }

        if (isset($_POST['end_harvest_corse'])&& $_POST['end_harvest_corse'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_corse', esc_html($_POST['end_harvest_corse']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_corse'); 
        }
    }

        // *********** Grand Est *************** //

    public function loadEst($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_est',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_est">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_est',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_est">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_est',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_est">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_est',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_est">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_est',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_est">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_est',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_est">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeEst($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_est'])&& $_POST['start_semi_est'] !=='') {
            update_post_meta($post_ID, 'debut_semi_est', esc_html($_POST['start_semi_est']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_est');
        }

        if (isset($_POST['end_semi_est'])&& $_POST['end_semi_est'] !=='') {
            update_post_meta($post_ID, 'fin_semi_est', esc_html($_POST['end_semi_est']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_est'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_est'])&& $_POST['start_plant_est'] !=='') {
            update_post_meta($post_ID, 'debut_plant_est', esc_html($_POST['start_plant_est']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_est');
        }

        if (isset($_POST['end_plant_est'])&& $_POST['end_plant_est'] !=='') {
            update_post_meta($post_ID, 'fin_plant_est', esc_html($_POST['end_plant_est']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_est'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_est'])&& $_POST['start_harvest_est'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_est', esc_html($_POST['start_harvest_est']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_est');
        }

        if (isset($_POST['end_harvest_est'])&& $_POST['end_harvest_est'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_est', esc_html($_POST['end_harvest_est']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_est'); 
        }
    }
        // *********** Hauts-de-France *************** //

    public function loadHauts($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_hauts',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_hauts',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_hauts',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_hauts',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_hauts',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_hauts',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_hauts">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeHauts($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_hauts'])&& $_POST['start_semi_hauts'] !=='') {
            update_post_meta($post_ID, 'debut_semi_hauts', esc_html($_POST['start_semi_hauts']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_hauts');
        }

        if (isset($_POST['end_semi_hauts'])&& $_POST['end_semi_hauts'] !=='') {
            update_post_meta($post_ID, 'fin_semi_hauts', esc_html($_POST['end_semi_hauts']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_hauts'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_hauts'])&& $_POST['start_plant_hauts'] !=='') {
            update_post_meta($post_ID, 'debut_plant_hauts', esc_html($_POST['start_plant_hauts']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_hauts');
        }

        if (isset($_POST['end_plant_hauts'])&& $_POST['end_plant_hauts'] !=='') {
            update_post_meta($post_ID, 'fin_plant_hauts', esc_html($_POST['end_plant_hauts']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_hauts'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_hauts'])&& $_POST['start_harvest_hauts'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_hauts', esc_html($_POST['start_harvest_hauts']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_hauts');
        }

        if (isset($_POST['end_harvest_hauts'])&& $_POST['end_harvest_hauts'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_hauts', esc_html($_POST['end_harvest_hauts']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_hauts'); 
        }
    }

        // *********** Île-de-France *************** //

    public function loadIle($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_ile',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_ile">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_ile',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_ile">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_ile',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_ile">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_ile',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_ile">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_ile',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_ile">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_ile',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_ile">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeIle($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_ile'])&& $_POST['start_semi_ile'] !=='') {
            update_post_meta($post_ID, 'debut_semi_ile', esc_html($_POST['start_semi_ile']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_ile');
        }

        if (isset($_POST['end_semi_ile'])&& $_POST['end_semi_ile'] !=='') {
            update_post_meta($post_ID, 'fin_semi_ile', esc_html($_POST['end_semi_ile']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_ile'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_ile'])&& $_POST['start_plant_ile'] !=='') {
            update_post_meta($post_ID, 'debut_plant_ile', esc_html($_POST['start_plant_ile']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_ile');
        }

        if (isset($_POST['end_plant_ile'])&& $_POST['end_plant_ile'] !=='') {
            update_post_meta($post_ID, 'fin_plant_ile', esc_html($_POST['end_plant_ile']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_ile'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_ile'])&& $_POST['start_harvest_ile'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_ile', esc_html($_POST['start_harvest_ile']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_ile');
        }

        if (isset($_POST['end_harvest_ile'])&& $_POST['end_harvest_ile'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_ile', esc_html($_POST['end_harvest_ile']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_ile'); 
        }
    }

        // *********** Normandie *************** //

    public function loadNormandie($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_normandie',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_normandie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_normandie',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_normandie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_normandie',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_normandie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_normandie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
        
    }

    public function save_metaboxeNormandie($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_normandie'])&& $_POST['start_semi_normandie'] !=='') {
            update_post_meta($post_ID, 'debut_semi_normandie', esc_html($_POST['start_semi_normandie']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_normandie');
        }

        if (isset($_POST['end_semi_normandie'])&& $_POST['end_semi_normandie'] !=='') {
            update_post_meta($post_ID, 'fin_semi_normandie', esc_html($_POST['end_semi_normandie']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_normandie'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_normandie'])&& $_POST['start_plant_normandie'] !=='') {
            update_post_meta($post_ID, 'debut_plant_normandie', esc_html($_POST['start_plant_normandie']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_normandie');
        }

        if (isset($_POST['end_plant_normandie'])&& $_POST['end_plant_normandie'] !=='') {
            update_post_meta($post_ID, 'fin_plant_normandie', esc_html($_POST['end_plant_normandie']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_normandie'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_normandie'])&& $_POST['start_harvest_normandie'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_normandie', esc_html($_POST['start_harvest_normandie']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_normandie');
        }

        if (isset($_POST['end_harvest_normandie'])&& $_POST['end_harvest_normandie'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_normandie', esc_html($_POST['end_harvest_normandie']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_normandie'); 
        }
    }

        // *********** Nouvelle-Aquitaine *************** //
    
    public function loadAquitaine($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_aquitaine',true);

        echo '<label for="dispo_meta">Indiquez la periode de test - Début : </label>';
        echo '<select name="start_semi_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_aquitaine',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_aquitaine',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_aquitaine',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_aquitaine',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_aquitaine',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_aquitaine">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeAquitaine($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_aquitaine'])&& $_POST['start_semi_aquitaine'] !=='') {
            update_post_meta($post_ID, 'debut_semi_aquitaine', esc_html($_POST['start_semi_aquitaine']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_aquitaine');
        }

        if (isset($_POST['end_semi_aquitaine'])&& $_POST['end_semi_aquitaine'] !=='') {
            update_post_meta($post_ID, 'fin_semi_aquitaine', esc_html($_POST['end_semi_aquitaine']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_aquitaine'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_aquitaine'])&& $_POST['start_plant_aquitaine'] !=='') {
            update_post_meta($post_ID, 'debut_plant_aquitaine', esc_html($_POST['start_plant_aquitaine']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_aquitaine');
        }

        if (isset($_POST['end_plant_aquitaine'])&& $_POST['end_plant_aquitaine'] !=='') {
            update_post_meta($post_ID, 'fin_plant_aquitaine', esc_html($_POST['end_plant_aquitaine']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_aquitaine'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_aquitaine'])&& $_POST['start_harvest_aquitaine'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_aquitaine', esc_html($_POST['start_harvest_aquitaine']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_aquitaine');
        }

        if (isset($_POST['end_harvest_aquitaine'])&& $_POST['end_harvest_aquitaine'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_aquitaine', esc_html($_POST['end_harvest_aquitaine']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_aquitaine'); 
        }
    }

        // *********** Occitanie *************** //

    public function loadOccitanie($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_occitanie',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_occitanie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_occitanie',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_occitanie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_occitanie',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_occitanie',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_occitanie">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeOccitanie($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_occitanie'])&& $_POST['start_semi_occitanie'] !=='') {
            update_post_meta($post_ID, 'debut_semi_occitanie', esc_html($_POST['start_semi_occitanie']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_occitanie');
        }

        if (isset($_POST['end_semi_occitanie'])&& $_POST['end_semi_occitanie'] !=='') {
            update_post_meta($post_ID, 'fin_semi_occitanie', esc_html($_POST['end_semi_occitanie']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_occitanie'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_occitanie'])&& $_POST['start_plant_occitanie'] !=='') {
            update_post_meta($post_ID, 'debut_plant_occitanie', esc_html($_POST['start_plant_occitanie']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_occitanie');
        }

        if (isset($_POST['end_plant_occitanie'])&& $_POST['end_plant_occitanie'] !=='') {
            update_post_meta($post_ID, 'fin_plant_occitanie', esc_html($_POST['end_plant_occitanie']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_occitanie'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_occitanie'])&& $_POST['start_harvest_occitanie'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_occitanie', esc_html($_POST['start_harvest_occitanie']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_occitanie');
        }

        if (isset($_POST['end_harvest_occitanie'])&& $_POST['end_harvest_occitanie'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_occitanie', esc_html($_POST['end_harvest_occitanie']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_occitanie'); 
        }
    }

        // *********** Pays de la Loire *************** //

    public function loadLoire($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_loire',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_ loire">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_loire',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_loire">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_loire',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_loire">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_loire',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_loire">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_loire',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_loire">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_loire',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_loire">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    

    public function save_metaboxeLoire($post_ID)
    {

        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_loire'])&& $_POST['start_semi_loire'] !=='') {
            update_post_meta($post_ID, 'debut_semi_loire', esc_html($_POST['start_semi_loire']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_loire');
        }

        if (isset($_POST['end_semi_loire'])&& $_POST['end_semi_loire'] !=='') {
            update_post_meta($post_ID, 'fin_semi_loire', esc_html($_POST['end_semi_loire']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_loire'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_loire'])&& $_POST['start_plant_loire'] !=='') {
            update_post_meta($post_ID, 'debut_plant_loire', esc_html($_POST['start_plant_loire']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_loire');
        }

        if (isset($_POST['end_plant_loire'])&& $_POST['end_plant_loire'] !=='') {
            update_post_meta($post_ID, 'fin_plant_loire', esc_html($_POST['end_plant_loire']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_loire'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_loire'])&& $_POST['start_harvest_loire'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_loire', esc_html($_POST['start_harvest_loire']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_loire');
        }

        if (isset($_POST['end_harvest_loire'])&& $_POST['end_harvest_loire'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_loire', esc_html($_POST['end_harvest_loire']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_loire'); 
        }
    }

        // *********** Provence-Alpes-Côte d’Azur *************** //

    public function loadAzur($post)
    {
        // *************** START SEMIS ****************** //
        $valueMonthBeginsSemis = get_post_meta($post->ID,'start_semi_azur',true);

        echo '<label for="dispo_meta">Indiquez la periode de semis - Début : </label>';
        echo '<select name="start_semi_azur">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
        }
        echo '</select>';


        // *************** END SEMIS ****************** //
        $valueMonthEndsSemis = get_post_meta($post->ID,'end_semi_azur',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_semi_azur">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsSemis, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *************** START PLANTATION *************** //
        $valueMonthBeginsPlants = get_post_meta($post->ID,'start_plant_azur',true);

        echo '<label for="dispo_meta">Indiquez la periode de plantation - Début : </label>';
        echo '<select name="start_plant_azur">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthBeginsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';


        // *************** END PLANTATION *************** //
        $valueMonthEndsPlants = get_post_meta($post->ID,'end_plant_azur',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_plant_azur">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsPlants, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select><br><br>';



        // *********** START HARVEST *************** //
        $valueMonthBeginsHarvest = get_post_meta($post->ID,'debut_recolte_azur',true);

        echo '<label for="dispo_meta">Indiquez la periode de récolte - Début : </label>';
        echo '<select name="start_harvest_azur">';
        foreach(self::calendrier as $month => $TabValue){
            if ($TabValue === $valueMonthBeginsHarvest) {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'" selected>'.$month.'</option>';
            } else {
                echo '<option ' . selected($TabValue, $valueMonthBeginsHarvest, false) . ' value="'.$TabValue.'">'.$month.'</option>';
            }
        }
        echo '</select>';


        // *********** END HARVEST *************** //
        $valueMonthEndsHarveset = get_post_meta($post->ID,'end_harvest_azur',true);

        echo '<label for="dispo_meta"> Fin : </label>';
        echo '<select name="end_harvest_azur">';
        foreach(self::calendrier as $month => $TabValue){
            echo '<option ' . selected($TabValue, $valueMonthEndsHarveset, false) . ' value="'.$TabValue.'">'.$month.'</option>';
        }
        echo '</select>';
    }

    public function save_metaboxeAzur($post_ID)
    {
        // *********** SEMIS ************ //
        if (isset($_POST['start_semi_azur'])&& $_POST['start_semi_azur'] !=='') {
            update_post_meta($post_ID, 'debut_semi_azur', esc_html($_POST['start_semi_azur']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_azur');
        }

        if (isset($_POST['end_semi_azur'])&& $_POST['end_semi_azur'] !=='') {
            update_post_meta($post_ID, 'fin_semi_azur', esc_html($_POST['end_semi_azur']));
        } else {
            delete_post_meta($post_ID, 'fin_semi_azur'); 
        }

        
        // *********** PLANTATION ************ //
        if (isset($_POST['start_plant_azur'])&& $_POST['start_plant_azur'] !=='') {
            update_post_meta($post_ID, 'debut_plant_azur', esc_html($_POST['start_plant_azur']));
        } else { 
            delete_post_meta($post_ID, 'debut_semi_azur');
        }

        if (isset($_POST['end_plant_azur'])&& $_POST['end_plant_azur'] !=='') {
            update_post_meta($post_ID, 'fin_plant_azur', esc_html($_POST['end_plant_azur']));
        } else {
            delete_post_meta($post_ID, 'fin_plant_azur'); 
        }

        // *********** RECOLTE *************** //

        if (isset($_POST['start_harvest_azur'])&& $_POST['start_harvest_azur'] !=='') {
            update_post_meta($post_ID, 'debut_recolte_azur', esc_html($_POST['start_harvest_azur']));
        } else { 
            delete_post_meta($post_ID, 'debut_recolte_azur');
        }

        if (isset($_POST['end_harvest_azur'])&& $_POST['end_harvest_azur'] !=='') {
            update_post_meta($post_ID, 'fin_recolte_azur', esc_html($_POST['end_harvest_azur']));
        } else {
            delete_post_meta($post_ID, 'fin_recolte_azur'); 
        }
    }

    public function loadcolor($post)
    {
         // *************** START SEMIS ****************** //
         $valueMonthBeginsSemis = get_post_meta($post->ID,'colorsType',true);

         echo '<label for="dispo_meta">Indiquez le type pour la couleur affiché sur le calendrier </label>';
         echo '<select name="nameColors">';
         foreach(self::colors as $month => $TabValue){
             echo '<option'.selected($TabValue, $valueMonthBeginsSemis, false) .' value="'.$TabValue.'" >'.$month.'</option>';
         }
         echo '</select>';
    }
}