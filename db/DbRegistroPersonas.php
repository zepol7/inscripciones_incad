<?php

require_once("DbConexion.php");

class DbRegistroPersonas extends DbConexion {
    
    
    public function getListaFormasPago($id_inscripcion) {
        try {
            $sql = "SELECT * FROM listas_detalle l
                    INNER JOIN personas_formas_pago p ON p.id_forma_pago = l.id_detalle
                    WHERE p.id_inscripcion = $id_inscripcion";
            				
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getListaReferido($id_inscripcion) {
        try {
            $sql = "SELECT * FROM listas_detalle l
                    INNER JOIN personas_conoce_incad p ON p.id_conoce = l.id_detalle
                    WHERE p.id_inscripcion = $id_inscripcion";
            				
            return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
	/**
     PARAMETROS:
	 $fecha_nacimiento - Fecha de nacimiento de una persona.
	 $fecha_control - Fecha actual o fecha a consultar.
	 EJEMPLO:
	 tiempo_transcurrido('22/06/1977', '04/05/2009');
    */
    public function CalcularEdadPersona($fecha_nacimiento, $fecha_actual){

            $fecha_nacimiento = "STR_TO_DATE('".$fecha_nacimiento."', '%d/%m/%Y')";		
            $fecha_actual = "STR_TO_DATE('".$fecha_actual."', '%d/%m/%Y')";


       try {
       $sql="SELECT DATEDIFF($fecha_actual, $fecha_nacimiento) AS dias, 
                  ROUND(DATEDIFF($fecha_actual, $fecha_nacimiento) / 30.4375, 2) AS meses,
                  ROUND(DATEDIFF($fecha_actual, $fecha_nacimiento) / 30.4375, 0) AS meses_exacto, 
                  FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) AS anios,						
                    CASE
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) > 45 THEN 'Mayor 45'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) >= 38 THEN '38 - 45'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) >= 30 THEN '30 - 37'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) >= 23 THEN '23 - 29'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) >= 18 THEN '18 - 22'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) >= 14 THEN '14 - 17'
                        WHEN FLOOR(DATEDIFF($fecha_actual, $fecha_nacimiento) / 365.25) < 14 THEN 'Menor 14'
                    END AS grupo_edad ";
       //echo $sql;
                    return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
	
	
    public function InsertRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea) { 

        try {
            $sql = "CALL pa_crear_editar_regitro_personas($tipo_documento, '".$documento_persona."', '".$lugar_documento."', STR_TO_DATE('".$fecha_documento."', '%d/%m/%Y'), '".$nombre_persona."', '".$apellido_persona."', STR_TO_DATE('".$fecha_nacimiento."', '%d/%m/%Y'), '".$lugar_nacimiento."', $tipo_sangre, '".$tel_casa_persona."', '".$tel_movil_persona."', '".$email_persona."', $estado_civil, '".$direccion_casa."', '".$barrio_residencia."', '".$ciudad_residencia."', '".$nombre_contacto_1."', '".$telefono_contacto_1."', '".$parentesco_contacto_1."', '".$nombre_contacto_2."', '".$telefono_contacto_2."', '".$parentesco_contacto_2."', '".$nombre_contacto_3."', '".$telefono_contacto_3."', '".$parentesco_contacto_3."', '".$nombre_acudiente."', '".$telefono_acudiente."', '".$parentesco_acudiente."', '".$eps."', $tipo_inscripcion, STR_TO_DATE('".$fecha_inscripcion."', '%d/%m/%Y'), '".$id_ultimo_estudio."', '".$institucion_estudio."', '".$programa_incad."', '".$jornada_incad."', $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, '".$id_entidad_financiera."', $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, '".$fecha_mensula_pago."', '".$referido_por."', '".$estrato_persona."', '".$programa_tecnico."', '".$practica_laboral."', $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, 1, 0, 0, @id)";         
            //echo $sql;    
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];   
            
            //$array_forma_pago, $array_conoce_incad
            
            if ($id_registro_creado > 0) {
                
                /*$array_forma_pago = explode(",", $array_forma_pago);
                foreach ($array_forma_pago as $fila_formas_pago) {
                    $sql_insert = "INSERT INTO personas_formas_pago 
                                  (id_inscripcion, id_forma_pago, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_creado . ", " . $fila_formas_pago . ", " . $id_usuario_crea . ", NOW())";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }*/
                
                
                $array_conoce_incad = explode(",", $array_conoce_incad);
                foreach ($array_conoce_incad as $fila_conoce_incad) {
                    $sql_insert = "INSERT INTO personas_conoce_incad 
                                  (id_inscripcion, id_conoce, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_creado . ", " . $fila_conoce_incad . ", " . $id_usuario_crea . ", NOW())";
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }                               
            }
            
            
            return $id_registro_creado;
        } catch (Exception $e) {
            return -2;
        }
    }


    public function UpdateRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, $hdd_id_persona, $hdd_id_academica) {

        try {
            $sql = "CALL pa_crear_editar_regitro_personas($tipo_documento, '".$documento_persona."', '".$lugar_documento."', STR_TO_DATE('".$fecha_documento."', '%d/%m/%Y'), '".$nombre_persona."', '".$apellido_persona."', STR_TO_DATE('".$fecha_nacimiento."', '%d/%m/%Y'), '".$lugar_nacimiento."', $tipo_sangre, '".$tel_casa_persona."', '".$tel_movil_persona."', '".$email_persona."', $estado_civil, '".$direccion_casa."', '".$barrio_residencia."', '".$ciudad_residencia."', '".$nombre_contacto_1."', '".$telefono_contacto_1."', '".$parentesco_contacto_1."', '".$nombre_contacto_2."', '".$telefono_contacto_2."', '".$parentesco_contacto_2."', '".$nombre_contacto_3."', '".$telefono_contacto_3."', '".$parentesco_contacto_3."', '".$nombre_acudiente."', '".$telefono_acudiente."', '".$parentesco_acudiente."', '".$eps."', $tipo_inscripcion, STR_TO_DATE('".$fecha_inscripcion."', '%d/%m/%Y'), '".$id_ultimo_estudio."', '".$institucion_estudio."', '".$programa_incad."', '".$jornada_incad."', $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, '".$id_entidad_financiera."', $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, '".$fecha_mensula_pago."', '".$referido_por."', '".$estrato_persona."', '".$programa_tecnico."', '".$practica_laboral."', $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, 2, $hdd_id_persona, $hdd_id_academica, @id)";
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_editado = $arrResultado["@id"];                       
            
            if ($id_registro_editado > 0) {                
                
                /*$sql_delete_formas = "DELETE FROM personas_formas_pago WHERE id_inscripcion = " . $id_registro_editado . "";
                $arrCampos_delete_formas[0] = "@id";
                $this->ejecutarSentencia($sql_delete_formas, $arrCampos_delete_formas);*/
                
                $sql_delete_conoce = "DELETE FROM personas_conoce_incad WHERE id_inscripcion = " . $id_registro_editado . "";
                $arrCampos_delete_conoce[0] = "@id";
                $this->ejecutarSentencia($sql_delete_conoce, $arrCampos_delete_conoce);
                
                
                /*$array_forma_pago = explode(",", $array_forma_pago);
                foreach ($array_forma_pago as $fila_formas_pago) {
                    $sql_insert = "INSERT INTO personas_formas_pago 
                                  (id_inscripcion, id_forma_pago, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_editado . ", " . $fila_formas_pago . ", " . $id_usuario_crea . ", NOW())";
                    
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }*/
                
                $array_conoce_incad = explode(",", $array_conoce_incad);
                foreach ($array_conoce_incad as $fila_conoce_incad) {
                    $sql_insert = "INSERT INTO personas_conoce_incad 
                                  (id_inscripcion, id_conoce, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_editado . ", " . $fila_conoce_incad . ", " . $id_usuario_crea . ", NOW())";
					//echo $sql_insert."<br />";			   
                    
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }                               
            }                        
            
            return $id_registro_editado;
        } catch (Exception $e) {
            return -2;
        }
    }	
    
    public function AddRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, $hdd_id_persona, $hdd_id_academica) {

        try {
            $sql = "CALL pa_crear_editar_regitro_personas($tipo_documento, '".$documento_persona."', '".$lugar_documento."', STR_TO_DATE('".$fecha_documento."', '%d/%m/%Y'), '".$nombre_persona."', '".$apellido_persona."', STR_TO_DATE('".$fecha_nacimiento."', '%d/%m/%Y'), '".$lugar_nacimiento."', $tipo_sangre, '".$tel_casa_persona."', '".$tel_movil_persona."', '".$email_persona."', $estado_civil, '".$direccion_casa."', '".$barrio_residencia."', '".$ciudad_residencia."', '".$nombre_contacto_1."', '".$telefono_contacto_1."', '".$parentesco_contacto_1."', '".$nombre_contacto_2."', '".$telefono_contacto_2."', '".$parentesco_contacto_2."', '".$nombre_contacto_3."', '".$telefono_contacto_3."', '".$parentesco_contacto_3."', '".$nombre_acudiente."', '".$telefono_acudiente."', '".$parentesco_acudiente."', '".$eps."', $tipo_inscripcion, STR_TO_DATE('".$fecha_inscripcion."', '%d/%m/%Y'), '".$id_ultimo_estudio."', '".$institucion_estudio."', '".$programa_incad."', '".$jornada_incad."', $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, '".$id_entidad_financiera."', $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, '".$fecha_mensula_pago."', '".$referido_por."', '".$estrato_persona."', '".$programa_tecnico."', '".$practica_laboral."', $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, 3, $hdd_id_persona, $hdd_id_academica, @id)";
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_editado = $arrResultado["@id"];                       
            
            if ($id_registro_editado > 0) {                
                
                /*$sql_delete_formas = "DELETE FROM personas_formas_pago WHERE id_inscripcion = " . $id_registro_editado . "";
                $arrCampos_delete_formas[0] = "@id";
                $this->ejecutarSentencia($sql_delete_formas, $arrCampos_delete_formas);*/
                
                $sql_delete_conoce = "DELETE FROM personas_conoce_incad WHERE id_inscripcion = " . $id_registro_editado . "";
                $arrCampos_delete_conoce[0] = "@id";
                $this->ejecutarSentencia($sql_delete_conoce, $arrCampos_delete_conoce);
                
                
                /*$array_forma_pago = explode(",", $array_forma_pago);
                foreach ($array_forma_pago as $fila_formas_pago) {
                    $sql_insert = "INSERT INTO personas_formas_pago 
                                  (id_inscripcion, id_forma_pago, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_editado . ", " . $fila_formas_pago . ", " . $id_usuario_crea . ", NOW())";
                    
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }*/
                
                $array_conoce_incad = explode(",", $array_conoce_incad);
                foreach ($array_conoce_incad as $fila_conoce_incad) {
                    $sql_insert = "INSERT INTO personas_conoce_incad 
                                  (id_inscripcion, id_conoce, id_usuario_crea, fecha_crea)
                                   VALUES (" . $id_registro_editado . ", " . $fila_conoce_incad . ", " . $id_usuario_crea . ", NOW())";
                    
                    $arrCampos[0] = "@id";
                    $this->ejecutarSentencia($sql_insert, $arrCampos);
                }                               
            }
            
            
            
            return $id_registro_editado;
        } catch (Exception $e) {
            return -2;
        }
    }	
    
    
    
    public function InsertRegistroPersonaCredito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, $documento_deudor, $nombre_deudor, $apellido_deudor, $fecha_nacimiento_deudor, $edad_deudor, $direccion_residencia_deudor, $barrio_residencia_deudor, $ciudad_residencia_deudor, $tel_casa_deudor, $tel_movil_deudor, $email_deudor, $actividad_economica_deudor, $ingreso_mensual_deudor, $nombre_empresa_deudor, $direccion_empresa_deudor, $telefono_empresa_deudor, $tipo_vehiculo_deudor, $placa_vehiculo_deudor, $marca_vehiculo_deudor, $modelo_vehiculo_deudor, $nom_ref_familiar_uno_deudor, $tel_ref_familiar_uno_deudor, $nom_ref_familiar_dos_deudor, $tel_ref_familiar_dos_deudor, $nom_ref_personal_uno_deudor, $tel_ref_personal_uno_deudor, $nom_ref_personal_dos_deudor, $tel_ref_personal_dos_deudor, $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, $documento_codeudor, $nombre_codeudor, $apellido_codeudor, $fecha_nacimiento_codeudor, $edad_codeudor, $direccion_residencia_codeudor, $barrio_residencia_codeudor, $ciudad_residencia_codeudor, $tel_casa_codeudor, $tel_movil_codeudor, $email_codeudor, $actividad_economica_codeudor, $ingreso_mensual_codeudor, $nombre_empresa_codeudor, $direccion_empresa_codeudor, $telefono_empresa_codeudor, $tipo_vehiculo_codeudor, $placa_vehiculo_codeudor, $marca_vehiculo_codeudor, $modelo_vehiculo_codeudor, $nom_ref_familiar_uno_codeudor, $tel_ref_familiar_uno_codeudor, $nom_ref_familiar_dos_codeudor, $tel_ref_familiar_dos_codeudor, $nom_ref_personal_uno_codeudor, $tel_ref_personal_uno_codeudor, $nom_ref_personal_dos_codeudor, $tel_ref_personal_dos_codeudor, $noti_direccion_codeudor, $noti_correo_codeudor, $hdd_id_persona, $hdd_id_academica, $hdd_id_credito, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_regitro_credito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, '".$documento_deudor."', '".$nombre_deudor."', '".$apellido_deudor."', STR_TO_DATE('".$fecha_nacimiento_deudor."', '%d/%m/%Y'), $edad_deudor, '".$direccion_residencia_deudor."', '".$barrio_residencia_deudor."', '".$ciudad_residencia_deudor."', '".$tel_casa_deudor."', '".$tel_movil_deudor."', '".$email_deudor."', '".$actividad_economica_deudor."', $ingreso_mensual_deudor, '".$nombre_empresa_deudor."', '".$direccion_empresa_deudor."', '".$telefono_empresa_deudor."', '".$tipo_vehiculo_deudor."', '".$placa_vehiculo_deudor."', '".$marca_vehiculo_deudor."', '".$modelo_vehiculo_deudor."', '".$nom_ref_familiar_uno_deudor."', '".$tel_ref_familiar_uno_deudor."', '".$nom_ref_familiar_dos_deudor."', '".$tel_ref_familiar_dos_deudor."', '".$nom_ref_personal_uno_deudor."', '".$tel_ref_personal_uno_deudor."', '".$nom_ref_personal_dos_deudor."', '".$tel_ref_personal_dos_deudor."', $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, '".$documento_codeudor."', '".$nombre_codeudor."', '".$apellido_codeudor."', STR_TO_DATE('".$fecha_nacimiento_codeudor."', '%d/%m/%Y'), $edad_codeudor, '".$direccion_residencia_codeudor."', '".$barrio_residencia_codeudor."', '".$ciudad_residencia_codeudor."', '".$tel_casa_codeudor."', '".$tel_movil_codeudor."', '".$email_codeudor."', '".$actividad_economica_codeudor."', $ingreso_mensual_codeudor, '".$nombre_empresa_codeudor."', '".$direccion_empresa_codeudor."', '".$telefono_empresa_codeudor."', '".$tipo_vehiculo_codeudor."', '".$placa_vehiculo_codeudor."', '".$marca_vehiculo_codeudor."', '".$modelo_vehiculo_codeudor."', '".$nom_ref_familiar_uno_codeudor."', '".$tel_ref_familiar_uno_codeudor."', '".$nom_ref_familiar_dos_codeudor."', '".$tel_ref_familiar_dos_codeudor."', '".$nom_ref_personal_uno_codeudor."', '".$tel_ref_personal_uno_codeudor."', '".$nom_ref_personal_dos_codeudor."', '".$tel_ref_personal_dos_codeudor."', $noti_direccion_codeudor, $noti_correo_codeudor, $id_usuario_crea,  1, 0, $hdd_id_academica, $hdd_id_persona, @id)";  
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];            
            return $id_registro_creado;
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    public function UpdateRegistroPersonaCredito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, $documento_deudor, $nombre_deudor, $apellido_deudor, $fecha_nacimiento_deudor, $edad_deudor, $direccion_residencia_deudor, $barrio_residencia_deudor, $ciudad_residencia_deudor, $tel_casa_deudor, $tel_movil_deudor, $email_deudor, $actividad_economica_deudor, $ingreso_mensual_deudor, $nombre_empresa_deudor, $direccion_empresa_deudor, $telefono_empresa_deudor, $tipo_vehiculo_deudor, $placa_vehiculo_deudor, $marca_vehiculo_deudor, $modelo_vehiculo_deudor, $nom_ref_familiar_uno_deudor, $tel_ref_familiar_uno_deudor, $nom_ref_familiar_dos_deudor, $tel_ref_familiar_dos_deudor, $nom_ref_personal_uno_deudor, $tel_ref_personal_uno_deudor, $nom_ref_personal_dos_deudor, $tel_ref_personal_dos_deudor, $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, $documento_codeudor, $nombre_codeudor, $apellido_codeudor, $fecha_nacimiento_codeudor, $edad_codeudor, $direccion_residencia_codeudor, $barrio_residencia_codeudor, $ciudad_residencia_codeudor, $tel_casa_codeudor, $tel_movil_codeudor, $email_codeudor, $actividad_economica_codeudor, $ingreso_mensual_codeudor, $nombre_empresa_codeudor, $direccion_empresa_codeudor, $telefono_empresa_codeudor, $tipo_vehiculo_codeudor, $placa_vehiculo_codeudor, $marca_vehiculo_codeudor, $modelo_vehiculo_codeudor, $nom_ref_familiar_uno_codeudor, $tel_ref_familiar_uno_codeudor, $nom_ref_familiar_dos_codeudor, $tel_ref_familiar_dos_codeudor, $nom_ref_personal_uno_codeudor, $tel_ref_personal_uno_codeudor, $nom_ref_personal_dos_codeudor, $tel_ref_personal_dos_codeudor, $noti_direccion_codeudor, $noti_correo_codeudor, $hdd_id_persona, $hdd_id_academica, $hdd_id_credito, $id_usuario_crea) {

        try {
            $sql = "CALL pa_crear_editar_regitro_credito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, '".$documento_deudor."', '".$nombre_deudor."', '".$apellido_deudor."', STR_TO_DATE('".$fecha_nacimiento_deudor."', '%d/%m/%Y'), $edad_deudor, '".$direccion_residencia_deudor."', '".$barrio_residencia_deudor."', '".$ciudad_residencia_deudor."', '".$tel_casa_deudor."', '".$tel_movil_deudor."', '".$email_deudor."', '".$actividad_economica_deudor."', $ingreso_mensual_deudor, '".$nombre_empresa_deudor."', '".$direccion_empresa_deudor."', '".$telefono_empresa_deudor."', '".$tipo_vehiculo_deudor."', '".$placa_vehiculo_deudor."', '".$marca_vehiculo_deudor."', '".$modelo_vehiculo_deudor."', '".$nom_ref_familiar_uno_deudor."', '".$tel_ref_familiar_uno_deudor."', '".$nom_ref_familiar_dos_deudor."', '".$tel_ref_familiar_dos_deudor."', '".$nom_ref_personal_uno_deudor."', '".$tel_ref_personal_uno_deudor."', '".$nom_ref_personal_dos_deudor."', '".$tel_ref_personal_dos_deudor."', $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, '".$documento_codeudor."', '".$nombre_codeudor."', '".$apellido_codeudor."', STR_TO_DATE('".$fecha_nacimiento_codeudor."', '%d/%m/%Y'), $edad_codeudor, '".$direccion_residencia_codeudor."', '".$barrio_residencia_codeudor."', '".$ciudad_residencia_codeudor."', '".$tel_casa_codeudor."', '".$tel_movil_codeudor."', '".$email_codeudor."', '".$actividad_economica_codeudor."', $ingreso_mensual_codeudor, '".$nombre_empresa_codeudor."', '".$direccion_empresa_codeudor."', '".$telefono_empresa_codeudor."', '".$tipo_vehiculo_codeudor."', '".$placa_vehiculo_codeudor."', '".$marca_vehiculo_codeudor."', '".$modelo_vehiculo_codeudor."', '".$nom_ref_familiar_uno_codeudor."', '".$tel_ref_familiar_uno_codeudor."', '".$nom_ref_familiar_dos_codeudor."', '".$tel_ref_familiar_dos_codeudor."', '".$nom_ref_personal_uno_codeudor."', '".$tel_ref_personal_uno_codeudor."', '".$nom_ref_personal_dos_codeudor."', '".$tel_ref_personal_dos_codeudor."', $noti_direccion_codeudor, $noti_correo_codeudor, $id_usuario_crea,  2, $hdd_id_credito, $hdd_id_academica, $hdd_id_persona, @id)";
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_editado = $arrResultado["@id"];           
            return $id_registro_editado;
        } catch (Exception $e) {
            return -2;
        }
    }
    
		
	
    public function getBuscarRegistroPersona($num_documento) {
        try {        	
             $sql = "SELECT *, CONCAT(nombre_persona, ' ', apellido_persona) AS nombre_completo " . 
                    "FROM personas p  " .
                    "INNER JOIN personas_encuesta pm ON pm.id_persona = p.id_persona  " .
                    "WHERE p.documento_persona= '".$num_documento."'";
				   
                    return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }	
    
    
    public function getPersona($num_documento) {
        try {        	
        $sql = "SELECT *, CONCAT(p.nombre_persona, ' ', p.apellido_persona) AS nombre_completo, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS format_fecha_nacimiento, 
                CONCAT(p.tel_casa_persona, ' - ', p.tel_movil_persona) AS telefonos          
                FROM personas p                
                WHERE p.documento_persona='" . $num_documento . "' ";
                //echo $sql;	   
                return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getExistePersona($num_documento) {
        try {        	
        $sql = "SELECT count(*) as cantidad
                FROM personas p                
                WHERE p.documento_persona='" . $num_documento . "' ";               
                return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    public function getBuscarPersona($text_buscar) {
        try {        	
        $sql = "SELECT *, CONCAT(p.nombre_persona, ' ', p.apellido_persona) AS nombre_completo, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS format_fecha_nacimiento, 
                CONCAT(p.tel_casa_persona, ' - ', p.tel_movil_persona) AS telefonos          
                FROM personas p                
                WHERE p.documento_persona LIKE '%" . $text_buscar . "%' 
                OR CONCAT(p.nombre_persona, ' ', p.apellido_persona) LIKE '%" . $text_buscar . "%'  ";
                return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    
    
    public function getPersonaInscripciones($id_persona) {
        try {        	
        $sql = "SELECT *, pa.id_academica AS id_reg_academica, 
                DATE_FORMAT(pa.fecha_inscripcion, '%d/%m/%Y') AS format_fecha_inscripcion,
                ins.nombre_detalle AS nom_tipo_inscripcion,
                jor.nombre_lista_editable_detalle AS nom_jornada,
                pro.nombre_lista_editable_detalle AS nom_id_programa
                FROM personas_academica pa
                LEFT JOIN personas_credito pc ON pc.id_academica = pa.id_academica
                LEFT JOIN listas_detalle ins ON ins.id_detalle = pa.tipo_inscripcion
                
                LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                
                LEFT JOIN listas_editable_detalle pro ON pro.id_listas_editable_detalle = pa.id_programa                

                WHERE pa.id_persona =" . $id_persona . " 
                ORDER BY pa.estado DESC, pa.fecha_inscripcion ASC ";
                //echo $sql;	   
                return $this->getDatos($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getPersonaAcademica($id_persona, $id_academica) {
        try {        	
        $sql = "SELECT p.*, pa.*, 
                CONCAT(p.nombre_persona, ' ', p.apellido_persona) AS nombre_completo, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS format_fecha_nacimiento,
                CONCAT(p.tel_casa_persona, ' - ', p.tel_movil_persona) AS telefonos,
                DATE_FORMAT(pa.fecha_inscripcion, '%d/%m/%Y') AS format_fecha_inscripcion,
                ins.nombre_detalle AS nom_tipo_inscripcion,
                td.nombre_detalle AS nom_tipo_documento,
                pro.nombre_lista_editable_detalle AS nom_id_programa,                
                DATE_FORMAT(pa.fecha_hv, '%d/%m/%Y') AS format_fecha_hv
                


                FROM personas p 
                LEFT JOIN personas_academica pa ON pa.id_persona = p.id_persona
                LEFT JOIN listas_detalle ins ON ins.id_detalle = pa.tipo_inscripcion
                LEFT JOIN listas_detalle td ON td.id_detalle = p.tipo_documento
                LEFT JOIN listas_editable_detalle pro ON pro.id_listas_editable_detalle = pa.id_programa
                WHERE pa.id_persona =" . $id_persona . " AND pa.id_academica = ".$id_academica;
                //echo $sql;	   
                //return $this->getDatos($sql);
                return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
		
    public function getRegistroPersona($idRegistro, $fecha_ini="0", $fecha_fin="0") {
        try {
			
            $condicion="";

            if($idRegistro==0){				
                    $condicion=" WHERE pa.fecha_inscripcion BETWEEN  STR_TO_DATE('".$fecha_ini."', '%d/%m/%Y %H:%i') AND STR_TO_DATE('".$fecha_fin."', '%d/%m/%Y %H:%i') AND pa.estado = 1";
            }
            else{
                    $condicion=" WHERE pa.id_academica=" . $idRegistro;
            }
			
			
            $sql = "SELECT p.*, pa.*, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS format_fecha_nacimiento, DATE_FORMAT(pa.fecha_inscripcion, '%d/%m/%Y')  AS format_fecha_inscripcion, DATE_FORMAT(p.fecha_documento, '%d/%m/%Y') AS format_fecha_documento,
                   MONTH(pa.fecha_inscripcion) AS mes_inscripcion, YEAR(pa.fecha_inscripcion) AS anio_inscripcion,
                   td.nombre_detalle AS nom_tipo_documento, ts.nombre_detalle AS nom_tipo_sangre, te.nombre_detalle AS nom_estado_civil,
                   ins.nombre_detalle AS nom_tipo_inscripcion, est.nombre_detalle AS nom_estrato_persona,
                   pro.nombre_detalle AS nom_programa_tecnico, pra.nombre_detalle AS nom_practica_laboral,
                   sex.nombre_detalle AS nom_sexo,
                   
                   jor.nombre_lista_editable_detalle AS nom_jornada,
                   neg.nombre_lista_editable_detalle AS nom_unidad_negocio,
                   cal.nombre_lista_editable_detalle AS nom_calendario_academico,
                   prog.nombre_lista_editable_detalle AS nom_id_programa,
                   
                   prog.resolucion_programa as nom_resolucion_programa,
                   
                   jor.fecha_inicio AS nom_fecha_inicio,
                   jor.fecha_terminacion AS nom_fecha_terminacion,

                   
                   peri.nombre_detalle AS nom_periodicidad_pago, 
                   
                   matri.nombre_detalle AS nom_tipo_matriculado, 
                   
                   estu.nombre_lista_editable_detalle AS nom_id_ultimo_estudio,
                   fpag.nombre_lista_editable_detalle AS nom_id_forma_pago,
                   enfi.nombre_lista_editable_detalle AS nom_id_entidad_financiera,
                   
                   
                   CONCAT(promo.nombre_usuario, ' ', promo.apellido_usuario) AS nom_promotor,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 33 AND id_inscripcion = pa.id_academica) / 33,0) AS conoce_red_social,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 34 AND id_inscripcion = pa.id_academica) / 34,0) AS conoce_fachada,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 35 AND id_inscripcion = pa.id_academica) / 35,0) AS conoce_volante,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 36 AND id_inscripcion = pa.id_academica) / 36,0) AS conoce_radio,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 37 AND id_inscripcion = pa.id_academica) / 37,0) AS conoce_referido,
                    IFNULL((SELECT id_conoce FROM personas_conoce_incad WHERE id_conoce = 52 AND id_inscripcion = pa.id_academica) / 52,0) AS conoce_rematricula

						

                   FROM personas p  
                   INNER JOIN personas_academica pa ON pa.id_persona = p.id_persona 
                   LEFT JOIN listas_detalle td ON td.id_detalle = p.tipo_documento
                   LEFT JOIN listas_detalle ts ON ts.id_detalle = p.tipo_sangre
                   LEFT JOIN listas_detalle te ON te.id_detalle = p.estado_civil
                   LEFT JOIN listas_detalle ins ON ins.id_detalle = pa.tipo_inscripcion                 
                   LEFT JOIN listas_detalle est ON est.id_detalle = p.estrato_persona
                   
                   LEFT JOIN listas_detalle pro ON pro.id_detalle = pa.programa_tecnico
                   LEFT JOIN listas_detalle pra ON pra.id_detalle = pa.practica_laboral
                   LEFT JOIN listas_detalle sex ON sex.id_detalle = p.sexo
                   
                   LEFT JOIN listas_editable_detalle jor ON jor.id_listas_editable_detalle = pa.jornada
                   LEFT JOIN listas_editable_detalle neg ON neg.id_listas_editable_detalle = pa.unidad_negocio
                   LEFT JOIN listas_editable_detalle cal ON cal.id_listas_editable_detalle = pa.calendario_academico
                   LEFT JOIN listas_editable_detalle prog ON prog.id_listas_editable_detalle = pa.id_programa                  
                   
                   LEFT JOIN listas_detalle peri ON peri.id_detalle = pa.periodicidad_pago
                   
                   LEFT JOIN listas_detalle matri ON matri.id_detalle = pa.estado_matriculado

                   LEFT JOIN listas_editable_detalle estu ON estu.id_listas_editable_detalle = pa.id_ultimo_estudio
                   LEFT JOIN listas_editable_detalle fpag ON fpag.id_listas_editable_detalle = pa.id_forma_pago
                   LEFT JOIN listas_editable_detalle enfi ON enfi.id_listas_editable_detalle = pa.id_entidad_financiera

                   

                   
                   LEFT JOIN usuarios promo ON promo.id_usuario = pa.id_promotor

                   " . $condicion;
            //echo $sql;	   
			
			if($idRegistro==0){				
				return $this->getDatos($sql);
			}
			else{
				return $this->getUnDato($sql);
			}
			
			
            
			
			
			
			
			
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    
    
    
    public function getPersonaID($idRegistro) {
        try {
            $sql = "SELECT p.*, DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') AS format_fecha_nacimiento, DATE_FORMAT(p.fecha_documento, '%d/%m/%Y') AS format_fecha_documento  " . 
                   "FROM personas p  " .
                   "WHERE p.id_persona=" . $idRegistro;
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function getValidarCreditoIncad($idInscripcion) {
        try {
            $sql = "SELECT * FROM personas_formas_pago WHERE id_inscripcion = $idInscripcion AND id_forma_pago = 32";
            //echo $sql."<br />";	   
            return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }	
    
	
	/*Para Creditos*/
	
	public function getCredito($id_credito) {
        try {        	
        $sql = "SELECT *, 
                vd.nombre_detalle AS nom_tipo_vehiculo_deudor,
                vc.nombre_detalle AS nom_tipo_vehiculo_codeudor,
                tdd.nombre_detalle AS nom_tipo_documento_deudor,
                tdc.nombre_detalle AS nom_tipo_documento_codeudor,                
                DATE_FORMAT(pc.fecha_nacimiento_deudor, '%d/%m/%Y') AS format_fecha_nacimiento_deudor,
		DATE_FORMAT(pc.fecha_nacimiento_codeudor, '%d/%m/%Y') AS format_fecha_nacimiento_codeudor                
                FROM personas_credito pc     
                LEFT JOIN listas_detalle vd ON vd.id_detalle = pc.tipo_vehiculo_deudor
                LEFT JOIN listas_detalle vc ON vc.id_detalle = pc.tipo_vehiculo_codeudor
                LEFT JOIN listas_detalle tdd ON tdd.id_detalle = pc.tipo_documento_deudor
                LEFT JOIN listas_detalle tdc ON tdc.id_detalle = pc.tipo_documento_codeudor
                WHERE pc.id_credito =" . $id_credito . " ";
                //echo $sql;	   
                return $this->getUnDato($sql);
        } catch (Exception $e) {
            return array();
        }
    }
    
    
    public function ObtenerNumeroPagare($id_credito) {
        try {
            $sql = "CALL pa_crear_actualizar_numero_pagare($id_credito, @id)";
            //echo $sql;
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $num_pagare = $arrResultado["@id"];           
            return $num_pagare;
        } catch (Exception $e) {
            return -2;
        }
    }
	
	
    public function EliminarRegistro($id_registro) {
        try {
			$resultado = 0;
            $sql = "UPDATE personas_academica
					SET estado = 0
					WHERE id_academica = $id_registro";
			
			//echo $sql;	
					
            $arrCampos[0] = "@id";
            if($arrResultado = $this->ejecutarSentencia($sql, $arrCampos)){
				$resultado = 1;
			}
			
			return $resultado;
            
        } catch (Exception $e) {
            return -2;
        }
    }
	
    public function ActivarRegistro($id_registro) {
        try {
            $resultado = 0;
            $sql = "UPDATE personas_academica
                    SET estado = 1
                    WHERE id_academica = $id_registro";
					
            $arrCampos[0] = "@id";
            if($arrResultado = $this->ejecutarSentencia($sql, $arrCampos)){
                $resultado = 1;
            }
			
            return $resultado;
            
        } catch (Exception $e) {
            return -2;
        }
    }
	
    
    /**Para registro virtual**/
    
    
    public function InsertRegistroVirtualPersona($tipo_documento, $documento_persona, $nombre_persona, $apellido_persona, $email_persona, $clave_verificacion, $id_usuario_crea) { 

        try {
            $sql = "CALL pa_crear_editar_registro_virtual($tipo_documento, '".$documento_persona."', '".$nombre_persona."', '".$apellido_persona."', '".$email_persona."', '".$clave_verificacion."', $id_usuario_crea, 1, 0, @id)";          
                          
            //echo $sql;    
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];   
            
            
            return $id_registro_creado;
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    public function EditarRegistroVirtualPersona($tipo_documento, $documento_persona, $nombre_persona, $apellido_persona, $email_persona, $clave_verificacion, $id_persona, $band_email, $id_usuario_crea) { 

        try {
            $sql = "CALL pa_crear_editar_registro_virtual($tipo_documento, '".$documento_persona."', '".$nombre_persona."', '".$apellido_persona."', '".$email_persona."', '".$clave_verificacion."', $id_usuario_crea, 2, $id_persona, @id)";          
                          
            //echo $sql;    
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_creado = $arrResultado["@id"];   
            
            
            return $id_registro_creado;
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    
    public function UpdateRegistroVirtualPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $estrato_persona, $sexo, $id_usuario_crea, $hdd_id_persona) {

        try {
            $sql = "CALL pa_editar_inscripcion_virtual($tipo_documento, '".$documento_persona."', '".$lugar_documento."', STR_TO_DATE('".$fecha_documento."', '%d/%m/%Y'), '".$nombre_persona."', '".$apellido_persona."', STR_TO_DATE('".$fecha_nacimiento."', '%d/%m/%Y'), '".$lugar_nacimiento."', $tipo_sangre, '".$tel_casa_persona."', '".$tel_movil_persona."', '".$email_persona."', $estado_civil, '".$direccion_casa."', '".$barrio_residencia."', '".$ciudad_residencia."', '".$nombre_contacto_1."', '".$telefono_contacto_1."', '".$parentesco_contacto_1."', '".$nombre_contacto_2."', '".$telefono_contacto_2."', '".$parentesco_contacto_2."', '".$nombre_contacto_3."', '".$telefono_contacto_3."', '".$parentesco_contacto_3."', '".$nombre_acudiente."', '".$telefono_acudiente."', '".$parentesco_acudiente."', '".$eps."', $estrato_persona, $sexo, $id_usuario_crea, $hdd_id_persona, @id)";
            $arrCampos[0] = "@id";
            $arrResultado = $this->ejecutarSentencia($sql, $arrCampos);
            $id_registro_editado = $arrResultado["@id"];                       
            
            return $id_registro_editado;
        } catch (Exception $e) {
            return -2;
        }
    }
    
    
    
    
    
		
		

}

?>
