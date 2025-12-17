<?php

require_once("DbConexion.php");

class DbMunicipios extends DbConexion {//Clase que hace referencia a la tabla: listas_detalle

    public function getListaMunicipiosDepartamento($codDep) {
        try {
            $sql = "SELECT * " .
                    "FROM municipios " .
                    "WHERE cod_dep=" . $codDep . " " .
                    "ORDER BY nom_mun";

           
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
