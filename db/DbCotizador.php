<?php

require_once("DbConexion.php");

class DbCotizador extends DbConexion {//Clase que hace referencia a la tabla: listas_detalle

 
    
    public function getDetallePrograma($id_programa) {
        try {
            $sql = "SELECT * FROM detalle_programa where id_programa = $id_programa";

            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function InsertEditCotizador($fecha_cotizador, $nombre_completo, $tel_casa_persona, $tel_movil_persona, $id_programa, $email_persona, $observaciones_cotiza, $tipo_accion, $id_cotizador, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_cotizador(STR_TO_DATE('".$fecha_cotizador."', '%d/%m/%Y %H:%i:%s'), '".$nombre_completo."', '".$tel_casa_persona."', '".$tel_movil_persona."', $id_programa, '".$email_persona."', '".$observaciones_cotiza."', $tipo_accion, $id_usuario_crea, $id_cotizador, @id)";  
            //echo $sql;            
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];            
            return $id_registro_creado;                          
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    public function getListaCotizador() {
        try {
            $sql = "SELECT c.*, l.nombre_lista_editable_detalle AS nombre_programa
                    FROM cotizador_programas AS c
                    INNER JOIN listas_editable_detalle AS l ON l.id_listas_editable_detalle = c.id_programa
                    ORDER BY c.fecha_cotizador DESC ";
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaCotizadorBuscar($txt_busca_id, $fecha_cotizador_desde, $fecha_cotizador_hasta) {
        try {
            
            if($txt_busca_id!='' and $fecha_cotizador_desde != '' and  $fecha_cotizador_hasta != '' ){
                $sql = "SELECT c.*, l.nombre_lista_editable_detalle AS nombre_programa
                        FROM cotizador_programas AS c
                        INNER JOIN listas_editable_detalle AS l ON l.id_listas_editable_detalle = c.id_programa
                        WHERE (c.nombre_completo LIKE '%".$txt_busca_id."%' 
                               or c.tel_casa_persona LIKE '%".$txt_busca_id."%'
                               or c.tel_movil_persona LIKE '%".$txt_busca_id."%')
                        AND c.fecha_cotizador between STR_TO_DATE('".$fecha_cotizador_desde."', '%d/%m/%Y') and STR_TO_DATE('".$fecha_cotizador_hasta."', '%d/%m/%Y')
                        ORDER BY c.fecha_cotizador DESC  " ;
            }
            else if($txt_busca_id!='' and ($fecha_cotizador_desde == '' or  $fecha_cotizador_hasta == '') ){
                $sql = "SELECT c.*, l.nombre_lista_editable_detalle AS nombre_programa
                        FROM cotizador_programas AS c
                        INNER JOIN listas_editable_detalle AS l ON l.id_listas_editable_detalle = c.id_programa
                        WHERE (c.nombre_completo LIKE '%".$txt_busca_id."%' 
                               or c.tel_casa_persona LIKE '%".$txt_busca_id."%'
                               or c.tel_movil_persona LIKE '%".$txt_busca_id."%') 
                        ORDER BY c.fecha_cotizador DESC ";
            } 
            else if($txt_busca_id == '' and ($fecha_cotizador_desde != '' and  $fecha_cotizador_hasta != '') ){
                $sql = "SELECT c.*, l.nombre_lista_editable_detalle AS nombre_programa
                        FROM cotizador_programas AS c
                        INNER JOIN listas_editable_detalle AS l ON l.id_listas_editable_detalle = c.id_programa
                        WHERE c.fecha_cotizador between STR_TO_DATE('".$fecha_cotizador_desde."', '%d/%m/%Y') and STR_TO_DATE('".$fecha_cotizador_hasta."', '%d/%m/%Y') 
                        ORDER BY c.fecha_cotizador DESC  " ;
            }
            
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    
    public function getCotizador($id_cotizador) {
        try {
            $sql = "SELECT c.*, l.nombre_lista_editable_detalle AS nombre_programa, d.*, DATE_FORMAT(c.fecha_cotizador, '%d/%m/%Y') as format_fecha_cotizador
                    FROM cotizador_programas AS c
                    INNER JOIN listas_editable_detalle AS l ON l.id_listas_editable_detalle = c.id_programa
                    INNER JOIN detalle_programa AS d ON d.id_programa = c.id_programa
                    WHERE c.id_cotizador = ".$id_cotizador;
            //echo $sql;
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    

}

?>
