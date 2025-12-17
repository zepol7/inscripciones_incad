<?php

require_once("DbConexion.php");

class DbChequeo extends DbConexion {

    public function getListaChequeo($id_academica) {
        try {        	
        $sql = "SELECT *, 
                DATE_FORMAT(r.fecha_rev_comercial, '%d/%m/%Y') AS format_fecha_rev_comercial,
                DATE_FORMAT(r.fecha_rev_academica, '%d/%m/%Y') AS format_fecha_rev_academica,
                DATE_FORMAT(r.fecha_rev_rectoria, '%d/%m/%Y') AS format_fecha_rev_rectoria
                FROM registro_control r
                WHERE r.id_academica = ".$id_academica;
                //echo $sql;	   
                return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function InsertUpdateRegistroChequeo($reg_oportunidad, $info_basica, $preguntas_perso, $info_acudiente, $inscripcion_estudiante, $matricula_foto, $contrato_matricula, $fotocopia_documento_estudiante, $fotocopia_documento_acudiente, $fotocopia_certificado_ultimo_grado, $fotocopia_diploma_bachiller, $carta_bienvenida, $solicitud_academica, $carta_compromiso, $paz_salvo_estudiante, $autorizacion_centrales_riesgo, $solicitud_credito, $consulta_datacredito, $pagare_carta_instrucciones, $plan_pagos, $entrega_carpeta, $registra_info_q10, $matricula_estudiante_q10, $crear_credito_q10, $foto_q10, $confirmacion_pago, $registra_estudiante_simat, $recibe_carpeta_items, $firma_contrato_matricula, $devuelve_carpeta, $fecha_rev_comercial, $observacion_comercial, $fecha_rev_academica, $observacion_academica, $fecha_rev_rectoria, $observacion_rectoria, $hdd_id_academica, $id_usuario_crea, $tipo_accion) { 

        try {
            $sql = "CALL pa_crear_editar_registro_chequeo($reg_oportunidad, $info_basica, $preguntas_perso, $info_acudiente, $inscripcion_estudiante, $matricula_foto, $contrato_matricula, $fotocopia_documento_estudiante, $fotocopia_documento_acudiente, $fotocopia_certificado_ultimo_grado, $fotocopia_diploma_bachiller, $carta_bienvenida, $solicitud_academica, $carta_compromiso, $paz_salvo_estudiante, $autorizacion_centrales_riesgo, $solicitud_credito, $consulta_datacredito, $pagare_carta_instrucciones, $plan_pagos, $entrega_carpeta, $registra_info_q10, $matricula_estudiante_q10, $crear_credito_q10, $foto_q10, $confirmacion_pago, $registra_estudiante_simat, $recibe_carpeta_items, $firma_contrato_matricula, $devuelve_carpeta, STR_TO_DATE('".$fecha_rev_comercial."', '%d/%m/%Y'), '".$observacion_comercial."', STR_TO_DATE('".$fecha_rev_academica."', '%d/%m/%Y'), '".$observacion_academica."', STR_TO_DATE('".$fecha_rev_rectoria."', '%d/%m/%Y'), '".$observacion_rectoria."', $hdd_id_academica, $id_usuario_crea, $tipo_accion, @id)";          
            
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
