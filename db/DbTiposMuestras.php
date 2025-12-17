<?php

require_once("DbConexion.php");

class DbTiposMuestras extends DbConexion {

    public function getListaTiposMuestras($idClase) {
        try {

            $sql = "SELECT * FROM tipos_muestras WHERE id_clase_muestra =" . $idClase;

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
