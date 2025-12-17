<?php

require_once("DbConexion.php");

class DbBacterias extends DbConexion {
    public function getListabacteriasActivas() {
        try {
            $sql = "SELECT *
                    FROM bacterias
                    WHERE ind_activo = 1
                    ORDER BY orden_bact;";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
}
