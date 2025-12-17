<?php

require_once("DbConexion.php");

class DbCertificacion extends DbConexion {
    
    public function getListaEstudiantes($jornada, $id_programa, $calendario_academico, $txt_busca_estudiante, $estado_capacitacion, $estado_productividad, $estado_hoja_vida, $estado_academica, $estado_cartera) {
        try {
            
            $condicion = "pa.estado = 1";
            
            //, $estado_productividad, $estado_hoja_vida, $estado_academica, $estado_cartera
            if($jornada!=0){
                $condicion=$condicion." AND pa.jornada = $jornada ";
            }
            if($id_programa!=0){
                $condicion=$condicion." AND pa.id_programa = $id_programa ";
            }
            if($calendario_academico!=0){
                $condicion=$condicion." AND pa.calendario_academico = $calendario_academico ";
            }
            if($txt_busca_estudiante <> "0"){
                $condicion=$condicion." AND ( CONCAT(p.nombre_persona, ' ', p.apellido_persona) LIKE '%" . $txt_busca_estudiante . "%' OR p.documento_persona LIKE '%" . $txt_busca_estudiante . "%') ";        
            }
            
            
            if($estado_capacitacion!= -1){
                $condicion=$condicion." AND pa.estado_capacita = $estado_capacitacion ";
            }            
            if($estado_productividad!= 0){
                $condicion=$condicion." AND pa.estado_productividad = $estado_productividad ";
            }            
            if($estado_hoja_vida == 47){
                $condicion=$condicion." AND pa.ruta_archivo_hv is null ";
            }
            else if($estado_hoja_vida == 46){
                $condicion=$condicion." AND pa.ruta_archivo_hv <> '' ";
            }
            
            if($estado_academica!= -1){
                $condicion=$condicion." AND pa.estado_coor_acade = $estado_academica ";
            }
            
            if($estado_cartera!= -1){
                $condicion=$condicion." AND pa.estado_cartera = $estado_cartera ";
            }
            
            
            $sql = "SELECT p.*, pa.*, e.*, 
                    ee.id_estudiante_empresa, ee.fecha_envio, ee.id_estado, ee.fecha_ini, ee.fecha_fin,
                    td.nombre_detalle AS nom_tipo_documento,
                    pro.nombre_detalle AS nom_programa_tecnico, pra.nombre_detalle AS nom_practica_laboral, sex.nombre_detalle AS nom_sexo,
                    jor.nombre_lista_editable_detalle AS nom_jornada,
                    neg.nombre_lista_editable_detalle AS nom_unidad_negocio,
                    cal.nombre_lista_editable_detalle AS nom_calendario_academico,
                    prog.nombre_lista_editable_detalle AS nom_id_programa,
                    lpro.nombre_detalle AS nom_estado_productividad,
                    esta_cer.nombre_lista_editable_detalle AS nom_estado_certificacion,
                    DATE_FORMAT(ee.fecha_ini, '%d/%m/%Y') AS format_fecha_ini, 
                    DATE_FORMAT(ee.fecha_fin, '%d/%m/%Y') AS format_fecha_fin

                    FROM personas p
                    INNER JOIN personas_academica pa ON pa.id_persona = p.id_persona
                    LEFT JOIN listas_detalle td ON td.id_detalle = p.tipo_documento
                    LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                    LEFT JOIN listas_editable_detalle neg ON neg.id_listas_editable_detalle = pa.unidad_negocio
                    LEFT JOIN listas_editable_detalle cal ON cal.id_listas_editable_detalle = pa.calendario_academico
                    LEFT JOIN listas_editable_detalle prog ON prog.id_listas_editable_detalle = pa.id_programa    
                    
                    LEFT JOIN listas_detalle pro ON pro.id_detalle = pa.programa_tecnico
                    LEFT JOIN listas_detalle pra ON pra.id_detalle = pa.practica_laboral
                    LEFT JOIN listas_detalle sex ON sex.id_detalle = p.sexo
                    
                    LEFT JOIN listas_detalle lpro ON lpro.id_detalle = pa.estado_productividad
                    
                    LEFT JOIN listas_editable_detalle esta_cer ON esta_cer.id_lista_editable = 5 AND esta_cer.codigo_lista_editable_detalle = pa.estado_certificacion
                    
                    LEFT JOIN estudiantes_empresas ee ON ee.id_academica = pa.id_academica AND ee.id_estado = 2
                    LEFT JOIN empresas e ON e.id_empresa = ee.id_empresa


                    WHERE $condicion  ORDER BY p.apellido_persona";
            //echo $sql;
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaEstudiantesCertificacion($jornada, $id_programa, $calendario_academico, $txt_busca_estudiante, $cert_carta, $cert_contrato, $cert_calificacion, $cert_certificacion, $cert_pasantia, $cert_solicitud_academica, $cert_laboral) {
        try {
            
            $condicion = " pa.estado = 1 AND (ee.id_estado = 2 or ee.id_estado IS NULL) AND pa.estado_coor_acade = 2 AND pa.estado_cartera = 2 ";
            
            //, $estado_productividad, $estado_hoja_vida, $estado_academica, $estado_cartera
            if($jornada!=0){
                $condicion=$condicion." AND pa.jornada = $jornada ";
            }
            if($id_programa!=0){
                $condicion=$condicion." AND pa.id_programa = $id_programa ";
            }
            if($calendario_academico!=0){
                $condicion=$condicion." AND pa.calendario_academico = $calendario_academico ";
            }
            if($txt_busca_estudiante <> "0"){
                $condicion=$condicion." AND ( CONCAT(p.nombre_persona, ' ', p.apellido_persona) LIKE '%" . $txt_busca_estudiante . "%' OR p.documento_persona LIKE '%" . $txt_busca_estudiante . "%') ";        
            }     
            
            if($cert_carta!=-1){
                $condicion=$condicion." AND pa.cert_carta = $cert_carta ";
            }
            if($cert_contrato!=-1){
                $condicion=$condicion." AND pa.cert_contrato = $cert_contrato ";
            }
            if($cert_calificacion!=-1){
                $condicion=$condicion." AND pa.cert_calificacion = $cert_calificacion ";
            }
            if($cert_certificacion!=-1){
                $condicion=$condicion." AND pa.cert_certificacion = $cert_certificacion ";
            }
            if($cert_pasantia!=-1){
                $condicion=$condicion." AND pa.cert_pasantia = $cert_pasantia ";
            }
            if($cert_solicitud_academica!=-1){
                $condicion=$condicion." AND pa.cert_solicitud_academica = $cert_solicitud_academica ";
            }
            if($cert_laboral!=-1){
                $condicion=$condicion." AND pa.cert_laboral = $cert_laboral ";
            }
            
            $sql = "SELECT p.*, pa.*, e.*, tipo_certi.nombre_detalle AS nombre_etapa_productividad,
                
                    td.nombre_detalle AS nom_tipo_documento,
                    pro.nombre_detalle AS nom_programa_tecnico, pra.nombre_detalle AS nom_practica_laboral, sex.nombre_detalle AS nom_sexo,
                    jor.nombre_lista_editable_detalle AS nom_jornada,
                    neg.nombre_lista_editable_detalle AS nom_unidad_negocio,
                    cal.nombre_lista_editable_detalle AS nom_calendario_academico,
                    prog.nombre_lista_editable_detalle AS nom_id_programa,
                    lpro.nombre_detalle AS nom_estado_productividad,
                    esta_cer.nombre_lista_editable_detalle AS nom_estado_certificacion,
                    ee.*
                    
                    FROM personas p
                    INNER JOIN personas_academica pa ON pa.id_persona = p.id_persona
                    LEFT JOIN estudiantes_empresas ee ON ee.id_academica = pa.id_academica
                    LEFT JOIN empresas e ON e.id_empresa = ee.id_empresa
                    LEFT JOIN listas_detalle tipo_certi ON tipo_certi.id_detalle = pa.estado_productividad
                    LEFT JOIN listas_detalle td ON td.id_detalle = p.tipo_documento
                    LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                    LEFT JOIN listas_editable_detalle neg ON neg.id_listas_editable_detalle = pa.unidad_negocio
                    LEFT JOIN listas_editable_detalle cal ON cal.id_listas_editable_detalle = pa.calendario_academico
                    LEFT JOIN listas_editable_detalle prog ON prog.id_listas_editable_detalle = pa.id_programa    
                    
                    LEFT JOIN listas_detalle pro ON pro.id_detalle = pa.programa_tecnico
                    LEFT JOIN listas_detalle pra ON pra.id_detalle = pa.practica_laboral
                    LEFT JOIN listas_detalle sex ON sex.id_detalle = p.sexo
                    
                    LEFT JOIN listas_detalle lpro ON lpro.id_detalle = pa.estado_productividad
                    
                    LEFT JOIN listas_editable_detalle esta_cer ON esta_cer.id_lista_editable = 5 AND esta_cer.codigo_lista_editable_detalle = pa.estado_certificacion

                    WHERE $condicion  ORDER BY p.apellido_persona ";
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function UpdateCapacitaRegistro($id_academica, $val_resultado) {
        try {
            $sql_update = "UPDATE personas_academica SET estado_capacita = $val_resultado, fecha_estado_capacita = NOW() WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            
            //echo $sql_update;
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function UpdateEtapaProductiva($id_academica, $tipo_productiva) {
        try {
            $sql_update = "UPDATE personas_academica SET estado_productividad = $tipo_productiva, fecha_estado_productiva = NOW() WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function Agregar_Observacion_Hv($id_academica, $observaciones_profesor) {
        try {
            $sql_update = "UPDATE personas_academica SET observacion_profesor = '".$observaciones_profesor."' WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function Cambiar_Estados_Validacion($id_academica, $estado, $campo) {
        try {
            $sql_update = "UPDATE personas_academica SET ".$campo." = '".$estado."' WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function Adjuntar_Hv($id_academica, $nombre_arch, $fecha_hv) {
        try {
            $sql_update = "UPDATE personas_academica SET ruta_archivo_hv = '".$nombre_arch."', fecha_hv = STR_TO_DATE('".$fecha_hv."', '%d/%m/%Y') WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function Validar_Coo_Academica($id_academica, $observacion_coor_acade, $estado_academica) {
        try {
            $sql_update = "UPDATE personas_academica SET observacion_coor_acade = '".$observacion_coor_acade."', estado_coor_acade = '".$estado_academica."' WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    public function Validar_Cartera($id_academica, $observacion_cartera, $estado_cartera) {
        try {
            $sql_update = "UPDATE personas_academica SET observacion_cartera = '".$observacion_cartera."', estado_cartera = '".$estado_cartera."' WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function Enviar_HV_Empresa($id_academica, $id_empresa, $id_usuario) {
        try {
            $sql_insert = " INSERT INTO estudiantes_empresas
                            (id_academica, id_empresa, fecha_envio, id_usuario_crea, fecha_crea)	
                            VALUES 
                            ($id_academica, $id_empresa, DATE(NOW()), $id_usuario, NOW())";
            
            //echo $sql_insert;
            $arrCampos_insert[0] = "@id";
            $this->ejecutarSentencia($sql_insert, $arrCampos_insert);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function Enviar_Seguimiento_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa, $observaciones_seguimiento, $id_usuario) {
        try {
            $sql_insert = " INSERT INTO segumiento_empresa_estudiante
                            (id_academica, id_empresa, id_estudiante_empresa, observacion_seguimiento, fecha_seguimiento, id_usuario_crea, fecha_crea)	
                            VALUES 
                            ($id_academica, $id_empresa, $id_estudiante_empresa, '".$observaciones_seguimiento."', NOW(), $id_usuario, NOW())";
            $arrCampos_insert[0] = "@id";
            $this->ejecutarSentencia($sql_insert, $arrCampos_insert);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function Ver_Seguimiento_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa) {
        try {
            
            $sql = "SELECT * FROM segumiento_empresa_estudiante
                    WHERE id_empresa = $id_empresa
                    AND id_academica = $id_academica
                    AND id_estudiante_empresa  = $id_estudiante_empresa
                    ORDER BY fecha_seguimiento DESC ";
            
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    public function Vincular_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa, $fecha_ini_contrato, $fecha_fin_contrato, $id_usuario) {
        try {
            
            if($fecha_ini_contrato == ""){
                $fecha_ini_contrato="STR_TO_DATE(NULL, '%d/%m/%Y')";
            }
            else{
                $fecha_ini_contrato="STR_TO_DATE('".$fecha_ini_contrato."', '%d/%m/%Y')";
            }
            if($fecha_fin_contrato == ""){
                $fecha_fin_contrato="STR_TO_DATE(NULL, '%d/%m/%Y')";
            }
            else{                
                $fecha_fin_contrato="STR_TO_DATE('".$fecha_fin_contrato."', '%d/%m/%Y')";
            }
            
            $sql_update_academica = "UPDATE estudiantes_empresas SET id_estado = 1, id_usuario_edita = '".$id_usuario."', fecha_edita = NOW() WHERE id_academica = ".$id_academica;
            $arrCampos_update_academica[0] = "@id";
            if ($this->ejecutarSentencia($sql_update_academica, $arrCampos_update_academica)){
                
                $sql_update_academica_empresa = "UPDATE estudiantes_empresas SET id_estado = 2, fecha_ini= $fecha_ini_contrato, fecha_fin=$fecha_fin_contrato , id_usuario_edita = '".$id_usuario."', fecha_edita = NOW() WHERE id_estudiante_empresa = ".$id_estudiante_empresa;
                //echo $sql_update_academica_empresa;
                $arrCampos_update_academica_empresa[0] = "@id";
                
                if ($this->ejecutarSentencia($sql_update_academica_empresa, $arrCampos_update_academica_empresa)){
                    return 1;
                }else{
                    return -1;
                }
            }
            else{
                return -1;
            }
            
            
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function get_Empresa_Estudiante($id_estudiante_empresa){
        
         try {        	
             $sql = "SELECT *, DATE_FORMAT(ee.fecha_ini, '%d/%m/%Y') AS format_fecha_ini, DATE_FORMAT(ee.fecha_fin, '%d/%m/%Y') AS format_fecha_fin FROM estudiantes_empresas ee WHERE ee.id_estudiante_empresa = $id_estudiante_empresa";
				   
             return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
        
    }
    
    
    
    public function getListaEstudiantesActivos($txt_busca_estudiante) {
        try {
            
            $condicion = "pa.estado = 1";
            
            $condicion=$condicion." AND ( CONCAT(p.nombre_persona, ' ', p.apellido_persona) LIKE '%" . $txt_busca_estudiante . "%' OR p.documento_persona LIKE '%" . $txt_busca_estudiante . "%') ";        
            $condicion=$condicion." AND pa.estado_capacita = 1 ";
            //$condicion=$condicion." AND pa.ruta_archivo_hv <> '' ";
            $condicion=$condicion." AND pa.estado_coor_acade = 2 ";
            $condicion=$condicion." AND pa.estado_cartera = 2 ";
            
            $sql = "SELECT p.*, pa.*,
                    jor.nombre_lista_editable_detalle AS nom_jornada,
                    neg.nombre_lista_editable_detalle AS nom_unidad_negocio,
                    cal.nombre_lista_editable_detalle AS nom_calendario_academico,
                    prog.nombre_lista_editable_detalle AS nom_id_programa
                    
                    FROM personas p
                    INNER JOIN personas_academica pa ON pa.id_persona = p.id_persona
                    
                    LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                    LEFT JOIN listas_editable_detalle neg ON neg.id_listas_editable_detalle = pa.unidad_negocio
                    LEFT JOIN listas_editable_detalle cal ON cal.id_listas_editable_detalle = pa.calendario_academico
                    LEFT JOIN listas_editable_detalle prog ON prog.id_listas_editable_detalle = pa.id_programa
                    
                    WHERE $condicion  ";
            
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaEmpresasActivas($txt_busca_empresa) {
        try {
            
            $sql = "SELECT * FROM empresas e
                    WHERE (e.nombre_empresa LIKE '%" . $txt_busca_empresa . "%' OR e.nit_empresa LIKE '%" . $txt_busca_empresa . "%') ";
            
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    public function getListaEstudiantesEmpresas($id_academica, $id_empresa) {
        try {
            
            $condicion = "pa.estado = 1";
            
            
            if($id_academica>0){
                $condicion=$condicion." AND pa.id_academica = $id_academica ";
            }
            
            if($id_empresa>0){
                $condicion=$condicion." AND e.id_empresa = $id_empresa ";
            }
            
            
            if($id_academica==0 and $id_empresa == 0){
                $condicion=$condicion." AND pa.id_academica = -1 ";
                $condicion=$condicion." AND e.id_empresa = -1 ";
            }
            
            
            
            
            $condicion=$condicion." AND pa.estado_capacita = 1 ";
            //$condicion=$condicion." AND pa.ruta_archivo_hv <> '' ";
            $condicion=$condicion." AND pa.estado_coor_acade = 2 ";
            $condicion=$condicion." AND pa.estado_cartera = 2 ";
            
            $sql = "SELECT e.*, p.*, pa.*,
                    jor.nombre_lista_editable_detalle AS nom_jornada,
                    neg.nombre_lista_editable_detalle AS nom_unidad_negocio,
                    cal.nombre_lista_editable_detalle AS nom_calendario_academico,
                    prog.nombre_lista_editable_detalle AS nom_id_programa,
                    ee.*

                    FROM personas p
                    INNER JOIN personas_academica pa ON pa.id_persona = p.id_persona

                    LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                    LEFT JOIN listas_editable_detalle neg ON neg.id_listas_editable_detalle = pa.unidad_negocio
                    LEFT JOIN listas_editable_detalle cal ON cal.id_listas_editable_detalle = pa.calendario_academico
                    LEFT JOIN listas_editable_detalle prog ON prog.id_listas_editable_detalle = pa.id_programa

                    INNER JOIN estudiantes_empresas ee ON ee.id_academica = pa.id_academica
                    INNER JOIN empresas e ON e.id_empresa = ee.id_empresa

                    WHERE $condicion  ";
            
            
            //echo $sql;
            
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function UpdateEstadoCertifica($id_academica, $val_resultado, $id_tipo) {
        try {
            
        switch ($id_tipo) {
            case "1":                
                $sql_update = "UPDATE personas_academica SET cert_carta = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "2":
                $sql_update = "UPDATE personas_academica SET cert_contrato = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "3":
                $sql_update = "UPDATE personas_academica SET cert_calificacion = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "4":
                $sql_update = "UPDATE personas_academica SET cert_certificacion = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "5":
                $sql_update = "UPDATE personas_academica SET cert_pasantia = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "6":
                $sql_update = "UPDATE personas_academica SET cert_solicitud_academica = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "7":
                $sql_update = "UPDATE personas_academica SET cert_laboral = $val_resultado WHERE id_academica = $id_academica";
            break;
            case "8":
                $sql_update = "UPDATE personas_academica SET estado_grado = $val_resultado WHERE id_academica = $id_academica";
            break;
        }
        
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function UpdateEstadoCertificacion($id_academica, $observacion_estado_certificacion, $estado_certificacion) {
        try {
            $sql_update = "UPDATE personas_academica SET observacion_estado_certificacion = '".$observacion_estado_certificacion."', estado_certificacion = '".$estado_certificacion."' WHERE id_academica = $id_academica";
            $arrCampos_update[0] = "@id";
            $this->ejecutarSentencia($sql_update, $arrCampos_update);
            return 1;
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    
    
    
    
}
