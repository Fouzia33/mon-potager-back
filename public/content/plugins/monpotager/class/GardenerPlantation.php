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
        $ifExist = $this->database->query( "
        SELECT * FROM `gardener_plantation`");

        if ($ifExist != false) {
            $sql = "
        CREATE TABLE `gardener_plantation` (
            `id_plantation` bigint(24) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_user` bigint(24) unsigned NOT NULL,
            `id_plante` bigint(24) unsigned NOT NULL,
            `status` tinyint(24) unsigned NOT NULL,
            `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` datetime NULL
        );
        ";

            // STEP WP CUSTOMTABLE execution de la requête de création de la table
            dbDelta($sql);
        }
    }

    public function dropTable()
    {
        $sql = "DROP TABLE `gardener_plantation`";
        // ICI on va directement interagir avec la BDD
        // Pour récupérer l'équivalent d'un objet pdo, mais façon WP on va aller dans le constructeur de notre CoreModel

        $this->database->query($sql);
    }

    public function insert($id_user, $id_plante, $status = 1)
    {
        // le tableau data stocke les données à insérer dans la table
        $data = [
            'id_user' => $id_user,
            'id_plante' => $id_plante,
            'status' => $status,
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
            "status" => $status
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
}