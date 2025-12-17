<?php

require_once("DbConexion.php");

class DbDepartamentos extends DbConexion {//Clase que hace referencia a la tabla: listas_detalle

    public function getListaDepartamentosActivos() {
        try {
            $sql = "SELECT *" .
                    "FROM departamentos " .
                    "WHERE activo=1";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
