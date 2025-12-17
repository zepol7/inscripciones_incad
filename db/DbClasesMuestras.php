<?php

require_once("DbConexion.php");

class DbClasesMuestras extends DbConexion {

    public function getListaClasesMuestras() {
        try {
            
            $sql = "SELECT * FROM clases_muestras";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
?>

