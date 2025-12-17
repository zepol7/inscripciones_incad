<?php

require_once("DbConexion.php");

class DbUsuariosLaboratorios extends DbConexion {

    public function getListalaboratoriosActivosUsuario($idUsuario) {
        try {
            $sql = "SELECT UL.*, LB.*, D.nom_dep, M.nom_mun
                    FROM usuarios_laboratorios UL
                    INNER JOIN laboratorios LB ON LB.cod_lab = UL.cod_lab
                    INNER JOIN departamentos D ON D.cod_dep = LB.cod_dep
                    INNER JOIN municipios M ON M.cod_mun_dane = LB.cod_mun
                    WHERE UL.id_usuario = $idUsuario
                    AND UL.ind_activo = 1
                    ORDER BY UL.fecha_crea;";
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

    public function getLaboratorioActivo($codLab) {
        try {
            $sql = "SELECT LB.*, D.nom_dep, M.nom_mun
FROM laboratorios LB
INNER JOIN departamentos D ON D.cod_dep = LB.cod_dep
INNER JOIN municipios M ON M.cod_mun_dane = LB.cod_mun
WHERE LB.cod_lab = $codLab;";

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }

}
