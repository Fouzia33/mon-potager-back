<?php

namespace monPotager;

class GardenerPlantation
{
    protected $database;

    public function __construct()
    {
        // $wpdb https://developer.wordpress.org/reference/classes/wpdb/
        global $wpdb;
        $this->database = $wpdb;
    }

    protected function executePreparedStatement($sql, $parameters = [])
    {
        if (empty($parameters)) {
            return $this->database->get_results($sql);
        } else {
            $preparedStatement = $this->database->prepare(
                $sql,
                $parameters
            );
            return $this->database->get_results($preparedStatement);
        }
    }

    public function createTable()
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        //$sql = "SELECT * FROM `gardener_plantation`";
        //$ifExist = $this->database->query( "
        //SELECT * FROM `gardener_plantation`");

        
            $sql = "
        CREATE TABLE `gardener_plantation` (
            `id_plantation` bigint(24) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_user` bigint(24) unsigned NOT NULL,
            `id_plante` bigint(24) unsigned NOT NULL,
            `status` tinyint(24) unsigned NOT NULL,
            `calendarId` VARCHAR(32) NOT NULL,
            `title` VARCHAR(32) NOT NULL,
            `start` VARCHAR(32) NOT NULL,
            `end` VARCHAR(32) NOT NULL,
            `category` VARCHAR(32) NOT NULL,
            `color` VARCHAR(32) NOT NULL,
            `bgColor` VARCHAR(32) NOT NULL,
            `dragBgColor` VARCHAR(32) NOT NULL,
            `borderColor` VARCHAR(32) NOT NULL,
            `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` datetime NULL
        );
        ";

            // STEP WP CUSTOMTABLE execution de la requête de création de la table
            dbDelta($sql);
        
    }

    public function dropTable()
    {
        $sql = "DROP TABLE `gardener_plantation`";
        // ICI on va directement interagir avec la BDD
        // Pour récupérer l'équivalent d'un objet pdo, mais façon WP on va aller dans le constructeur de notre CoreModel

        $this->database->query($sql);
    }

    public function insert($id_user, $id_plante, $status = 1, $calendarId, $title, $start, $end, $category, $color, $bgColor , $dragBgColor,$borderColor)
    {
        // le tableau data stocke les données à insérer dans la table
        $data = [
            'id_user' => $id_user,
            'id_plante' => $id_plante,
            'status' => $status,
            'calendarId' =>$calendarId,
            'title '=> $title,
            'start' => $start,
            'end' => $end,
            'category' => $category,
            'color' => $color,
            'bgColor' => $bgColor,
            'dragBgColor' => $dragBgColor,
            'borderColor' => $borderColor,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->database->insert(
            'gardener_plantation',
            $data
        );
    }

    public function delete($id_user, $id_plantation)
    {
        $where = [
            "id_user" => $id_user,
            "id_plantation" => $id_plantation
        ];

        $this->database->delete(
            'gardener_plantation',
            $where
        );
    }

    public function update($id_user, $id_plantation, $id_plante, $status = 1)
    {
        $data = [
            "id_plante" => $id_plante,
            "status" => $status,
            "updated_at" => date('Y-m-d H-i-s')
        ];

        $where = [
            "id_user" => $id_user,
            "id_plantation" => $id_plantation
        ];

        $this->database->update(
            'gardener_plantation',
            $data,
            $where
        );
    }

    public function getPlantationsByUserId($id_user)
    {
        $sql = "
            SELECT 
                *
            FROM `gardener_plantation`
            WHERE
                `id_user` = %d
        ";

        $rows = $this->executePreparedStatement(
            $sql,
            [
                $id_user
            ]
        );


        $results = [];

        foreach ($rows as $values) {
            $results[] =  $values;
        }
        //var_dump($results);exit;
        return $results;
    }
}