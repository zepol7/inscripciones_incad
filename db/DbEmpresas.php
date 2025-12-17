<?php

require_once("DbConexion.php");

class DbEmpresas extends DbConexion {
    
    public function getListaEmpresasBuscar($txt_buscar) {
        try {
            $txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT * " .
                    "FROM empresas e " .
                    "WHERE e.nombre_empresa LIKE '%" . $txt_buscar . "%' " .
                    "OR e.nit_empresa LIKE '%" . $txt_buscar . "%' " .
                    "ORDER BY e.nombre_empresa";
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaEmpresasProgramaBuscar($txt_buscar) {
        try {
            $txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT e.*, le.nombre_lista_editable_detalle as nombre_programa FROM empresas e " .                   
                   "LEFT JOIN empresa_programas ep ON ep.id_empresa = e.id_empresa " .
                   "LEFT JOIN listas_editable_detalle le ON le.id_listas_editable_detalle = ep.id_programas " .
                   "WHERE e.nombre_empresa LIKE '%" . $txt_buscar . "%' " .
                   "OR e.nit_empresa LIKE '%" . $txt_buscar . "%' ";
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getEmpresa($id_empresa) {
        try {
            $sql = "SELECT * FROM empresas WHERE id_empresa = ". $id_empresa;
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getBuscarNit($txt_buscar, $id_empresa) {
        try {
            if ($id_empresa == '') {
                $sql = "SELECT * " .
                        "FROM empresas e " .
                        "WHERE e.nit_empresa LIKE '" . $txt_buscar . "'";
            } else if ($id_empresa != '') {//Validar para editar usuario
                $sql = "SELECT * " .
                        "FROM empresas e " .
                        "WHERE (u.nit_empresa LIKE '" . $txt_buscar . "') " .
                        "AND id <> " . $id_empresa;
            }
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaProgramas() {
        try {
            $sql = "SELECT * FROM listas_editable_detalle l WHERE l.id_lista_editable=4 AND l.etapa_productiva=1";
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
     public function getListaProgramasEmpresas($id_empresa) {
        try {
            $sql = "SELECT * FROM empresa_programas e
                    INNER JOIN listas_editable_detalle l ON l.id_listas_editable_detalle = e.id_programas
                    WHERE e.id_empresa = ".$id_empresa;			
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaUsuariosBuscar($txt_buscar) {
        try {
            $txt_buscar = str_replace(" ", "%", $txt_buscar);
            $sql = "SELECT * " .
                    "FROM usuarios u " .
                    "WHERE CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) LIKE '%" . $txt_buscar . "%' " .
                    "OR u.login_usuario LIKE '%" . $txt_buscar . "%' " .
                    "OR u.numero_documento LIKE '%" . $txt_buscar . "%' " .
                    "ORDER BY u.nombre_usuario, u.apellido_usuario";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

    
    

    public function getBuscarDocumento($txt_buscar, $id_usuario) {
        try {
            if ($id_usuario == '') {//Validar para crear usuario
                $sql = "SELECT * " .
                        "FROM usuarios u " .
                        "WHERE u.numero_documento LIKE '" . $txt_buscar . "'";
            } else if ($id_usuario != '') {//Validar para editar usuario
                $sql = "SELECT * " .
                        "FROM usuarios u " .
                        "WHERE (u.numero_documento LIKE '" . $txt_buscar . "') " .
                        "AND id_usuario <> " . $id_usuario;
            }
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

    public function InsertEmpresa($nit_empresa, $nombre_empresa, $direccion_empresa, $nombre_contacto, $nombre_contacto2, $telefono1_contacto, $telefono2_contacto, $email_contacto, $email_contacto2, $observaciones_empresa, $programas_empresas, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_empresa('".$nit_empresa."', '".$nombre_empresa."', '".$direccion_empresa."', '".$nombre_contacto."', '".$nombre_contacto2."',
					         '".$telefono1_contacto."', '".$telefono2_contacto."', '".$email_contacto."', '".$email_contacto2."', '".$observaciones_empresa."', 1, $id_usuario_crea, 0, @id)";
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_empresa_creada = $arrResultado["@id"];

            if ($id_empresa_creada > 0) {
                $array_programas_empresas = explode(",", $programas_empresas);
                foreach ($array_programas_empresas as $fila_programas) {
                    $sql_insert = "INSERT INTO empresa_programas 
                                    (id_empresa, id_programas, id_usuario_crea, fecha_crea)
                                    VALUES (". $id_empresa_creada.", ".$fila_programas.", ".$id_usuario_crea.", NOW())";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }
            }
            return $id_empresa_creada;
        } catch (Exception $e) {
            return -2;
        }
    }

    public function UpdateEmpresa($nit_empresa, $nombre_empresa, $direccion_empresa, $nombre_contacto, $nombre_contacto2, $telefono1_contacto, $telefono2_contacto, $email_contacto, $email_contacto2, $observaciones_empresa, $programas_empresas, $hdd_id_empresa, $id_usuario_crea) {
        try {

            strlen($txt_email) >= 1 ? $txt_email = "'" . $txt_email . "'" : $txt_email = "NULL";
            strlen($txt_telefono) >= 1 ? $txt_telefono = "'" . $txt_telefono . "'" : $txt_telefono = "NULL";

            $sql_delete = "DELETE FROM empresa_programas WHERE id_empresa = " . $hdd_id_empresa . "";
            $arrCampos_delete[0] = "@id";
            $this->ejecutarSentencia($sql_delete, $arrCampos_delete);

            $array_programas_empresas = explode(",", $programas_empresas);
                foreach ($array_programas_empresas as $fila_programas) {
                    $sql_insert = "INSERT INTO empresa_programas 
                                    (id_empresa, id_programas, id_usuario_crea, fecha_crea)
                                    VALUES (". $hdd_id_empresa.", ".$fila_programas.", ".$id_usuario_crea.", NOW())";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }

            
            $sql = "CALL pa_crear_editar_empresa('".$nit_empresa."', '".$nombre_empresa."', '".$direccion_empresa."', '".$nombre_contacto."', '".$nombre_contacto2."', 
					         '".$telefono1_contacto."', '".$telefono2_contacto."', '".$email_contacto."', '".$email_contacto2."', '".$observaciones_empresa."', 2, $id_usuario_crea, $hdd_id_empresa, @id)";
            
            echo $sql;
            
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_resultado = $arrResultado["@id"];

            //$id_resultado = 1;

            return $id_resultado;
        } catch (Exception $e) {
            return -2;
        }
    }

   

}

?>
