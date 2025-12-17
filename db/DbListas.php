<?php

require_once("DbConexion.php");

class DbListas extends DbConexion {//Clase que hace referencia a la tabla: listas_detalle

    public function getListaDetalles($idLista) {
        try {
            $sql = "SELECT id_detalle, codigo_detalle, nombre_detalle, orden " .
                    "FROM listas_detalle " .
                    "WHERE id_lista=" . $idLista . " " .
                    "ORDER BY orden";
			

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }

    //Esta funcion me retorna los valores desde id_detalle 3 hasta ide_detalle 10
    public function getTipodocumento() {
        try {
            $sql = "SELECT *, nombre_detalle FROM listas_detalle 
                    WHERE id_detalle BETWEEN 3 AND 10;";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    //Esta funcion retorna los valores con id_lista = 6 
    public function getListaEtnia() {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 6";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    //Esta funcion retorna los valores con id_lista = 5 
    public function getListaZona() {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 5";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    //Esta funcion retorna los valores con id_lista = 5 
    public function getListaTipoSangre($idTipoSangre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = $idTipoSangre";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    //Esta funcion retorna los valores con id_lista = 1 
    public function getListaRh($idLista) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = $idLista";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    //Esta funcion retorna los valores con id_lista = 1 
    public function getTipoSexo() {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 1";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    //Esta funcion retorna los valores con id_lista = 1 
    public function getListaDesplazado() {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 10";

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
    public function getDetalle($id_detalle) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_detalle = $id_detalle";

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    /*Lista editasbles*/
    
     public function getListaDetallesEditabel($idLista) {
        try {
            $sql = "SELECT id_listas_editable_detalle, codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable=" . $idLista . " " .
                    "AND estado_lista_editable_detalle = 1 " .
                    "ORDER BY CAST(codigo_lista_editable_detalle AS SIGNED) DESC, estado_lista_editable_detalle ";            

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaDetallesEditabelTodos($idLista) {
        try {
            $sql = "SELECT id_listas_editable_detalle, codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable=" . $idLista . " " .
                    "ORDER BY CAST(codigo_lista_editable_detalle AS SIGNED), estado_lista_editable_detalle ";            		

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaProgramasProductiva($idLista) {
        try {
            $sql = "SELECT id_listas_editable_detalle, codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable=" . $idLista . " " .
                    "AND estado_lista_editable_detalle = 1 " .
                    "AND etapa_productiva = 1 " .
                    "ORDER BY CAST(codigo_lista_editable_detalle AS SIGNED), estado_lista_editable_detalle ";            		

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaProgramasProductivaTodos($idLista) {
        try {
            $sql = "SELECT id_listas_editable_detalle, codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable=" . $idLista . " " .
                    "AND etapa_productiva = 1 " .
                    "ORDER BY CAST(codigo_lista_editable_detalle AS SIGNED), estado_lista_editable_detalle ";            		

            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaTodosProgramas() {
        try {
            $sql = "SELECT * FROM listas_editable_detalle l WHERE l.id_lista_editable=4 and l.estado_lista_editable_detalle = 1";
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaTodosProgramasNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=4 
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE UPPER('%".$nombre."%')
                    LIMIT 1";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaJornadasNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=3
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE '%".$nombre."%'
                    LIMIT 1";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaFormasPagoNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=8
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE '%".$nombre."%'
                    LIMIT 1";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaEntidadFinanciera($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=7
                    AND upper(l.nombre_lista_editable_detalle) LIKE upper('%".$nombre."%')
                    LIMIT 1";            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaSiNo($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 11
                    AND upper(nombre_detalle) LIKE UPPER('%".$nombre."%')
                    LIMIT 1";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaUltimoEstudio($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=6
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE '%".$nombre."%'
                    LIMIT 1";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaSexoNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 2
                    AND nombre_detalle LIKE '%".$nombre."%'
                    LIMIT 1";
                       
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaUnidadNegocioNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=1
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE '%".$nombre."%'
                    LIMIT 1";
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaCalendarioNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_editable_detalle l 
                    WHERE l.id_lista_editable=2
                    and l.estado_lista_editable_detalle = 1
                    AND l.nombre_lista_editable_detalle LIKE '".$nombre."'
                    LIMIT 1";
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaPeriodicidadPagoNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 12
                    AND nombre_detalle LIKE '".$nombre."'
                    LIMIT 1";
                       
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaTipoSangreNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 7
                    AND nombre_detalle LIKE '".$nombre."'
                    LIMIT 1";
                       
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaEstadoCivilNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 4
                    AND nombre_detalle LIKE '".$nombre."'
                    LIMIT 1";
                       
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaEstratoNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 10
                    AND nombre_detalle LIKE '".$nombre."'
                    LIMIT 1";
                       
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaTipoDocumentoNombre($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 1
                    AND nombre_detalle LIKE '".$nombre."'
                    LIMIT 1";                
            
            #echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function getListaTipoInscripcion($nombre) {
        try {
            $sql = "SELECT * 
                    FROM listas_detalle
                    WHERE id_lista = 5
                    AND nombre_detalle LIKE '%".$nombre."%'
                    LIMIT 1";                
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    
    
    
    public function getListaModulos($id_programa) {
        try {
            $sql = "SELECT * from lista_modulos_programa WHERE id_lista_modulo = ".$id_programa;
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaFormasPago() {
        try {
            $sql = "SELECT * from listas_editable_detalle WHERE id_lista_editable = 10 and estado_lista_editable_detalle = 1 order by codigo_lista_editable_detalle";
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaDetallesEditabelTotal($idLista) {
        try {
            $sql = "SELECT id_listas_editable_detalle, codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable=" . $idLista . " " .                    
                    "ORDER BY estado_lista_editable_detalle desc, fecha_crea desc";            		
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaEstadoCertificacion() {
        try {
            $sql = "SELECT codigo_lista_editable_detalle, nombre_lista_editable_detalle, estado_lista_editable_detalle " .
                    "FROM listas_editable_detalle " .
                    "WHERE id_lista_editable= 5 " .                    
                    "ORDER BY CAST(codigo_lista_editable_detalle AS SIGNED), estado_lista_editable_detalle ";            		
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
     public function getItemListaEditable($id_lista) {
        try {
           $sql = "SELECT * FROM listas_editable where id_lista_editable = ".$id_lista;            		
           
           //echo $sql;

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaEditable() {
        try {
            $sql = "SELECT id_lista_editable, nombre_lista_editable FROM listas_editable ";            		
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getItemListaDetalleEditable($id_lista_detalle) {
        try {
           $sql = "SELECT *, DATE_FORMAT(fecha_inicio, '%d/%m/%Y') AS format_fecha_inicio, DATE_FORMAT(fecha_terminacion, '%d/%m/%Y') AS format_fecha_terminacion FROM listas_editable_detalle where id_listas_editable_detalle = ".$id_lista_detalle." order by CAST(codigo_lista_editable_detalle AS SIGNED)";            		
           return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaModulos_Programa($id_programa) {
        try {
            $sql = "SELECT l.* from listas_editable_detalle AS l
                    INNER JOIN lista_modulos_programa m ON m.id_lista_modulo = l.id_listas_editable_detalle
                    WHERE m.id_lista_programa = ".$id_programa."
                    ORDER BY nombre_lista_editable_detalle asc
                    ";            		
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function InsertItemLista($txt_codigo, $txt_nombre, $cmb_estado, $cmb_lista_editable, $id_listas_detalle, $txt_abreviatura, $cmb_productiva, $resolucion_programa, $fecha_inicio, $fecha_terminacion, $programas_modulos, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_lista_item('".$txt_codigo."', '".$txt_nombre."', '".$cmb_estado."', '".$cmb_lista_editable."', '".$id_listas_detalle."', '".$txt_abreviatura."', '".$cmb_productiva."', '".$resolucion_programa."', STR_TO_DATE('".$fecha_inicio."', '%d/%m/%Y'), STR_TO_DATE('".$fecha_terminacion."', '%d/%m/%Y'), $id_usuario_crea, 1, @id)";  
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];                
            
            if ($id_registro_creado > 0 && $cmb_lista_editable == 9) {
                $array_programas_modulos = explode(",", $programas_modulos);
                foreach ($array_programas_modulos as $fila_programas) {
                    $sql_insert = "INSERT INTO lista_modulos_programa 
                                    (id_lista_programa, id_lista_modulo)
                                    VALUES (". $fila_programas .", ". $id_registro_creado .")";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }
            }
            
            
            return $id_registro_creado;                          
        } catch (Exception $e) {
            return -2;
        }
    }
    
    public function EditarItemLista($txt_codigo, $txt_nombre, $cmb_estado, $cmb_lista_editable, $id_listas_detalle, $txt_abreviatura, $cmb_productiva, $resolucion_programa, $fecha_inicio, $fecha_terminacion, $programas_modulos, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_lista_item('".$txt_codigo."', '".$txt_nombre."', '".$cmb_estado."', '".$cmb_lista_editable."', '".$id_listas_detalle."', '".$txt_abreviatura."', '".$cmb_productiva."', '".$resolucion_programa."', STR_TO_DATE('".$fecha_inicio."', '%d/%m/%Y'), STR_TO_DATE('".$fecha_terminacion."', '%d/%m/%Y'), $id_usuario_crea, 2, @id)";  
            echo $sql;            
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];        
            
            
            if ($id_registro_creado > 0 && $cmb_lista_editable == 9) {
                
                $sql_delete = "DELETE FROM lista_modulos_programa WHERE id_lista_modulo = " . $id_registro_creado . "";
                $arrCampos_delete[0] = "@id";
                $this->ejecutarSentencia($sql_delete, $arrCampos_delete);
                
                $array_programas_modulos = explode(",", $programas_modulos);
                foreach ($array_programas_modulos as $fila_programas) {
                    $sql_insert = "INSERT INTO lista_modulos_programa 
                                    (id_lista_programa, id_lista_modulo)
                                    VALUES (". $fila_programas .", ". $id_registro_creado .")";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }
            }
            
            
            return $id_registro_creado;                       
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    
    
    public function getDetallePrograma($id_lista) {
        try {
           $sql = "SELECT * FROM detalle_programa WHERE id_programa = ".$id_lista;            		
           
           //echo $sql;

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function InsertEditarDetallePrograma($descripcion, $precio, $duracion, $horario, $forma_pago, $requisitos, $id_programa, $id_detalle, $tipo_accion, $id_usuario_crea) {

        try {            
            $sql = "CALL pa_crear_editar_detalle_programa('".$descripcion."', '".$precio."', '".$duracion."', '".$horario."', '".$forma_pago."', '".$requisitos."', $id_programa, $id_detalle, $id_usuario_crea, $tipo_accion, @id)";  
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];            
            return $id_registro_creado;                          
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    
    

}

?>
