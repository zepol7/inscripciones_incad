<?php

require_once("DbConexion.php");

class DbLaboratorios extends DbConexion {

    public function getListaLaboratoriosLimit() {
        try {
            $sql = "SELECT *
                    FROM laboratorios
                    ORDER BY nombre_lab
                    LIMIT 50;";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
