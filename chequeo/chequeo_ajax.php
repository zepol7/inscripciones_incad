<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbChequeo.php");

require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Generar_Clave.php");
require_once("../db/DbUsuariosPerfiles.php");


$dbRegistroPersonas = new DbRegistroPersonas();
$dbChequeo = new DbChequeo();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();

$dbUsuariosPefiles = new DbUsuariosPerfiles();

$combo = new Combo_Box();

$id_usuario = $_SESSION["idUsuario"];

if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "5" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}


$tabla_dias=array();
$j=1;
for ($i = 0; $i <= 30; $i++) {

        $tabla_dias[$i][0]=$j;
        $tabla_dias[$i][1]=$j;
        $j++;
}



switch ($opcion) {
    case "1": 
        $combo = new Combo_Box();
        
        $id_academico = $_POST['id_academico'];
        
        //Busca por el registro medico de la seleccionada
        $tabla_chequeo = $dbChequeo->getListaChequeo($_POST['id_academico']);        
        
        //Se busca el registro personal del estudiante
        $tabla_registro = $dbRegistroPersonas->getRegistroPersona($_POST['id_academico']);
			       
        $id_persona = $tabla_registro['id_persona'];
        $tipo_documento = $tabla_registro['tipo_documento'];
        $documento_persona = $tabla_registro['documento_persona'];
        $lugar_documento = $tabla_registro['lugar_documento'];
        $fecha_documento = $tabla_registro['format_fecha_documento'];
        $nombre_persona = $tabla_registro['nombre_persona'];
        $apellido_persona = $tabla_registro['apellido_persona'];
        $fecha_nacimiento = $tabla_registro['format_fecha_nacimiento'];
        $lugar_nacimiento = $tabla_registro['lugar_nacimiento'];
        $tipo_sangre = $tabla_registro['tipo_sangre'];
        $tel_casa_persona = $tabla_registro['tel_casa_persona'];
        $tel_movil_persona = $tabla_registro['tel_movil_persona'];
        $email_persona = $tabla_registro['email_persona'];
        $estado_civil = $tabla_registro['estado_civil'];
        $direccion_casa = $tabla_registro['direccion_casa'];
        $ciudad_residencia = $tabla_registro['ciudad_residencia'];                        
        $barrio_residencia = $tabla_registro['barrio_residencia'];                        
        $nombre_contacto_1 = $tabla_registro['nombre_contacto_1'];
        $telefono_contacto_1 = $tabla_registro['telefono_contacto_1'];
        $parentesco_contacto_1 = $tabla_registro['parentesco_contacto_1'];
        $nombre_contacto_2 = $tabla_registro['nombre_contacto_2'];
        $telefono_contacto_2 = $tabla_registro['telefono_contacto_2'];
        $parentesco_contacto_2 = $tabla_registro['parentesco_contacto_2'];
        $nombre_contacto_3 = $tabla_registro['nombre_contacto_3'];
        $telefono_contacto_3 = $tabla_registro['telefono_contacto_3'];
        $parentesco_contacto_3 = $tabla_registro['parentesco_contacto_3'];
        $nombre_acudiente = $tabla_registro['nombre_acudiente'];
        $telefono_acudiente = $tabla_registro['telefono_acudiente'];
        $parentesco_acudiente = $tabla_registro['parentesco_acudiente'];
        $eps = $tabla_registro['eps'];
        $estrato_persona = $tabla_registro['estrato_persona'];	
        $sexo = $tabla_registro['sexo'];
        
        
        //Se verifica si ya existe registro
        if(count($tabla_chequeo)>0){
            $tipo_accion = 2; //
                
            $reg_oportunidad = $tabla_chequeo['reg_oportunidad'];
            $info_basica = $tabla_chequeo['info_basica'];
            $preguntas_perso = $tabla_chequeo['preguntas_perso'];
            $info_acudiente = $tabla_chequeo['info_acudiente'];
            $inscripcion_estudiante = $tabla_chequeo['inscripcion_estudiante'];
            $matricula_foto = $tabla_chequeo['matricula_foto'];
            $contrato_matricula = $tabla_chequeo['contrato_matricula'];
            $fotocopia_documento_estudiante = $tabla_chequeo['fotocopia_documento_estudiante'];
            $fotocopia_documento_acudiente = $tabla_chequeo['fotocopia_documento_acudiente'];
            $fotocopia_certificado_ultimo_grado = $tabla_chequeo['fotocopia_certificado_ultimo_grado'];
            $fotocopia_diploma_bachiller = $tabla_chequeo['fotocopia_diploma_bachiller'];
            $carta_bienvenida = $tabla_chequeo['carta_bienvenida'];
            $solicitud_academica = $tabla_chequeo['solicitud_academica'];
            $carta_compromiso = $tabla_chequeo['carta_compromiso'];
            $paz_salvo_estudiante = $tabla_chequeo['paz_salvo_estudiante'];
            $autorizacion_centrales_riesgo = $tabla_chequeo['autorizacion_centrales_riesgo'];
            $solicitud_credito = $tabla_chequeo['solicitud_credito'];
            $consulta_datacredito = $tabla_chequeo['consulta_datacredito'];
            $pagare_carta_instrucciones = $tabla_chequeo['pagare_carta_instrucciones'];
            $plan_pagos = $tabla_chequeo['plan_pagos'];
            $entrega_carpeta = $tabla_chequeo['entrega_carpeta'];
            $registra_info_q10 = $tabla_chequeo['registra_info_q10'];
            $matricula_estudiante_q10 = $tabla_chequeo['matricula_estudiante_q10'];
            $crear_credito_q10 = $tabla_chequeo['crear_credito_q10'];
            $foto_q10 = $tabla_chequeo['foto_q10'];
            $confirmacion_pago = $tabla_chequeo['confirmacion_pago'];
            $registra_estudiante_simat = $tabla_chequeo['registra_estudiante_simat'];
            $recibe_carpeta_items = $tabla_chequeo['recibe_carpeta_items'];
            $firma_contrato_matricula = $tabla_chequeo['firma_contrato_matricula'];
            $devuelve_carpeta = $tabla_chequeo['devuelve_carpeta'];
            $fecha_rev_comercial = $tabla_chequeo['format_fecha_rev_comercial'];
            if($fecha_rev_comercial=='01/01/1900'){$fecha_rev_comercial='';}
            $observacion_comercial = $tabla_chequeo['observacion_comercial'];
            $fecha_rev_academica = $tabla_chequeo['format_fecha_rev_academica'];
            if($fecha_rev_academica=='01/01/1900'){$fecha_rev_academica='';}
            $observacion_academica = $tabla_chequeo['observacion_academica'];
            $fecha_rev_rectoria = $tabla_chequeo['format_fecha_rev_rectoria'];
            if($fecha_rev_rectoria=='01/01/1900'){$fecha_rev_rectoria='';}
            $observacion_rectoria = $tabla_chequeo['observacion_rectoria'];


            $titulo_formulario = $lang["r_titulo_editar"];
        }
        else{
            $tipo_accion = 1; //Crear Registro
            $id_registro = $_POST['id_academico'];
            
            $reg_oportunidad = '';
            $info_basica = '';
            $preguntas_perso = '';
            $info_acudiente = '';
            $inscripcion_estudiante = '';
            $matricula_foto = '';
            $contrato_matricula = '';
            $fotocopia_documento_estudiante = '';
            $fotocopia_documento_acudiente = '';
            $fotocopia_certificado_ultimo_grado = '';
            $fotocopia_diploma_bachiller = '';
            $carta_bienvenida = '';
            $solicitud_academica = '';
            $carta_compromiso = '';
            $paz_salvo_estudiante = '';
            $autorizacion_centrales_riesgo = '';
            $solicitud_credito = '';
            $consulta_datacredito = '';
            $pagare_carta_instrucciones = '';
            $plan_pagos = '';
            $entrega_carpeta = '';
            $registra_info_q10 = '';
            $matricula_estudiante_q10 = '';
            $crear_credito_q10 = '';
            $foto_q10 = '';
            $confirmacion_pago = '';
            $registra_estudiante_simat = '';
            $recibe_carpeta_items = '';
            $firma_contrato_matricula = '';
            $devuelve_carpeta = '';
            $fecha_rev_comercial = '';
            $observacion_comercial = '';
            $fecha_rev_academica = '';
            $observacion_academica = '';
            $fecha_rev_rectoria = '';
            $observacion_rectoria = '';

            $titulo_formulario = $lang["r_titulo_crear"];
        }
        
        
        
        
        $tabla_perfiles_usuario = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        
        $ind_asesores_c = 0;
        $ind_asesores_t = 'disabled';
            
        $ind_academico_c = 0;
        $ind_academico_t = 'disabled';

        $ind_finaciera_c = 0;
        $ind_finaciera_t = 'disabled';

        $ind_rectoria_c = 0;
        $ind_rectoria_t = 'disabled';
        
        foreach($tabla_perfiles_usuario as $fila_perfiles){			

            $ind_perfil =  $fila_perfiles['id_perfil'];
            //echo $ind_perfil."<br />";
            switch ($ind_perfil) {
                case 2:
                    $ind_asesores_c = 1;
                    $ind_asesores_t = '';
                break;
                case 3:
                    $ind_academico_c = 1;
                    $ind_academico_t = '';
                break;
                case 6:
                    $ind_finaciera_c = 1;
                    $ind_finaciera_t = '';
                break;
                case 7:
                    $ind_rectoria_c = 1;
                    $ind_rectoria_t = '';
                break;
            }
        }
        
    
    ?>
    	<input type="hidden" value="<?php echo $id_academico; ?>" name="hdd_id_academica" id="hdd_id_academica" />
    	
 			
            <div class="panel panel-primary">
            <div class="panel-heading"><b>DATOS PERSONALES</b></div>
            <div class="panel-body">
                 <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="">Nombres *</label>
                        <input type="text" class="form-control" name="nombre_persona" id="nombre_persona" placeholder="Nombres" value="<?php echo $nombre_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Apellidos *</label>
                        <input type="text" class="form-control" name="apellido_persona" id="apellido_persona" placeholder="Apellidos" value="<?php echo $apellido_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Tipo de documento *</label>
                        <?php
                        $combo->getComboDb('tipo_documento', $tipo_documento, $dbListas->getListaDetalles(1), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">N&uacute;mero de Documento *</label>
                        <!-- <?php echo($estado_documento); ?> -->
                        <input type="text" class="form-control" name="documento_persona" id="documento_persona" placeholder="Documento" value="<?php echo $documento_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); buscar_persona_creada(); validar_documento_identidad();">
                        <div id='div_persona_buscar'></div>	
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Lugar de Expedici&oacute;n *</label>
                        <input type="text" class="form-control" name="lugar_documento" id="lugar_documento" placeholder="Lugar Documento" value="<?php echo $lugar_documento; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                    <div class="col-md-3 form-group">
                        <label for="">Fecha de Expedici&oacute;n  *</label>
                        <input type="text" class="form-control" name="fecha_documento" id="fecha_documento" placeholder="dd/mm/aaaa" value="<?php echo $fecha_documento;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                    </div>                   
                </div>                

                <div class="row">	            	 	
                    <div class="col-md-3 form-group">
                        <label for="">Fecha de Nacimiento  *</label>
                        <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="dd/mm/aaaa" value="<?php echo $fecha_nacimiento;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                    </div>                    
                    <div class="col-md-3 form-group">
                        <label for="">Lugar de Nacimiento *</label>
                        <input type="text" class="form-control" name="lugar_nacimiento" id="lugar_nacimiento" placeholder="Lugar Nacimiento" value="<?php echo $lugar_nacimiento; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>             
                    <div class="col-md-3 form-group">
                        <label for="">Tipo de Sangre *</label>
                        <?php
                        $combo->getComboDb('tipo_sangre', $tipo_sangre, $dbListas->getListaDetalles(7), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>                       
                    </div>                      
                    <div class="col-md-3 form-group">
                        <label for="">Estado civil *</label>
                        <?php
                        $combo->getComboDb('estado_civil', $estado_civil, $dbListas->getListaDetalles(4), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>                   
                </div>
                
                <div class="row">
                    <div class="col-md-9 form-group">
                        <label for="">Direcci&oacute;n Residencia *</label>
                        <input type="text" class="form-control" name="direccion_casa" id="direccion_casa" placeholder="Direcci&oacute;n Residencia" value="<?php echo $direccion_casa; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">                        
                        <label for="">Sexo *</label>
                        <?php
                        $combo->getComboDb('sexo', $sexo, $dbListas->getListaDetalles(2), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                </div>      
                
                
                <div class="row">
                    
                    <div class="col-md-3 form-group">                        
                        <label for="">Estrato *</label>
                        <?php
                        $combo->getComboDb('estrato_persona', $estrato_persona, $dbListas->getListaDetalles(10), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Barrio de Residencia *</label>
                        <input type="text" class="form-control" name="barrio_residencia" id="barrio_residencia" placeholder="Barrio Residencia" value="<?php echo $barrio_residencia; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Ciudad de Residencia *</label>
                        <input type="text" class="form-control" name="ciudad_residencia" id="ciudad_residencia" placeholder="Ciudad Residencia" value="<?php echo $ciudad_residencia; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                </div>                 

                <div class="row">                                        	     
                     <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Casa *</label>
                        <input type="text" class="form-control" name="tel_casa_persona" id="tel_casa_persona" placeholder="Tel&eacute;fono Casa" value="<?php echo $tel_casa_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Celular  *</label>
                        <input type="text" class="form-control" name="tel_movil_persona" id="tel_movil_persona" placeholder="Tel&eacute;fono Celular" value="<?php echo $tel_movil_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                    <div class="col-md-3 form-group">
                        <label for="">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" name="email_persona" id="email_persona" placeholder="you@example.com" value="<?php echo $email_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">EPS *</label>
                        <input type="text" class="form-control" name="eps" id="eps" placeholder="EPS" value="<?php echo $eps; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                </div>                
            </div>
        </div>	  
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>Q10 GESTION COMERCIAL</b></div>
            <div class="panel-body">                
                 <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Registrar Oportunidad</label>
                   </div>        
                    <div class="col-md-2 form-group">     
                        <?php
                        $combo->getComboDb('reg_oportunidad', $reg_oportunidad, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                     
                    <div class="col-md-4 form-group">
                        <label for="">Información básica parte de arriba</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('info_basica', $info_basica, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                   
                 </div>         
                
                
                <div class="row">    
                    
                    <div class="col-md-4 form-group">
                        <label for="">Preguntas personalizadas ¿Cómo se enteró?</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('preguntas_perso', $preguntas_perso, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>   
                    
                    
                    <div class="col-md-4 form-group">
                        <label for="">Información acudiente y codeudor</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('info_acudiente', $info_acudiente, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                     
                </div>  
            </div>
        </div>
        
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>DOCUMENTOS DE ADMISION (COMERCIAL - SECRETARIA)</b></div>
            <div class="panel-body">                
                 <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Inscripción del estudiante: </label>
                    </div>        
                    <div class="col-md-2 form-group">
                        <?php
                        $combo->getComboDb('inscripcion_estudiante', $inscripcion_estudiante, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                     
                    <div class="col-md-4 form-group">
                        <label for="">Matrícula con foto Q10:</label>
                    </div>    
                     <div class="col-md-2 form-group">
                        <?php
                        $combo->getComboDb('matricula_foto', $matricula_foto, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                   
                </div>         
                
                
                <div class="row">     
                    <div class="col-md-4 form-group">
                        <label for="">Contrato de matrícula:</label>
                    </div>
                    <div class="col-md-2 form-group">                            
                        <?php
                        $combo->getComboDb('contrato_matricula', $contrato_matricula, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                    
                    <div class="col-md-4 form-group">
                        <label for="">Fotocopia del documento del estudiante</label>
                    </div>    
                    <div class="col-md-2 form-group">
                        <?php
                        $combo->getComboDb('fotocopia_documento_estudiante', $fotocopia_documento_estudiante, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                </div>         
                
                <div class="row">                     
                    <div class="col-md-4 form-group">
                        <label for="">Fotocopia del documento del acudiante y/o codeudor</label>
                    </div> 
                    <div class="col-md-2 form-group">   
                        <?php
                        $combo->getComboDb('fotocopia_documento_acudiente', $fotocopia_documento_acudiente, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">Fotocopia del certificado del ultimo año cursado (Bachillerato)</label>
                    </div> 
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('fotocopia_certificado_ultimo_grado', $fotocopia_certificado_ultimo_grado, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                </div>         
                
                <div class="row">     
                    <div class="col-md-4 form-group">
                        <label for="">Fotocopia del diploma y acta de bachiller o certificacion 9° (Técnicos)</label>
                    </div> 
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('fotocopia_diploma_bachiller', $fotocopia_diploma_bachiller, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div> 
                     
                    <div class="col-md-4 form-group">
                        <label for="">Carta de Bienvenida</label>
                    </div> 
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('carta_bienvenida', $carta_bienvenida, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', '', 'width:120px;', $ind_asesores_c, 'form-control');
                        ?>
                    </div> 
                </div>        
                
                
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Solicitud Académica (Si aplica)</label>
                    </div> 
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('solicitud_academica', $solicitud_academica, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div> 
                     
                    <div class="col-md-4 form-group">
                        <label for="">Carta de Compromiso (Si aplica)</label>
                    </div> 
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('carta_compromiso', $carta_compromiso, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_asesores_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>  
                </div>
            </div>
        </div>
        
        
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>INFORMACION FINANCIERA</b></div>
            <div class="panel-body">                
                 <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Paz y salvo del estudiante</label>
                   </div>        
                    <div class="col-md-2 form-group">     
                        <?php
                        $combo->getComboDb('paz_salvo_estudiante', $paz_salvo_estudiante, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                     
                    <div class="col-md-4 form-group">
                        <label for="">Autorización consulta centrales de riesgo</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('autorizacion_centrales_riesgo', $autorizacion_centrales_riesgo, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                   
                 </div>         
                
                
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Solicitud de crédito (llenar toda la información,referencias llamar)</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('solicitud_credito', $solicitud_credito, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">Consulta Datacredito</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('consulta_datacredito', $consulta_datacredito, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                </div>
                
                
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Pagaré y carta de Instrucciones (se firma en blanco con huella)</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('pagare_carta_instrucciones', $pagare_carta_instrucciones, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">Plan de pagos (fecha y valor de cuotas)</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('plan_pagos', $plan_pagos, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Comercial entrega a secretaria la carpeta del estudiante ordenada con sus respectivos formatos y documentos</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('entrega_carpeta', $entrega_carpeta, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_finaciera_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>SECRETARIA ACADEMICA</b></div>
            <div class="panel-body">                
                 <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Registrar información Q10 (parte de abajo)</label>
                   </div>        
                    <div class="col-md-2 form-group">     
                        <?php
                        $combo->getComboDb('registra_info_q10', $registra_info_q10, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                     
                    <div class="col-md-4 form-group">
                        <label for="">Matricular al estudiante  Q10</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('matricula_estudiante_q10', $matricula_estudiante_q10, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                   
                 </div>         
                
                
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Crear crédito en Q10</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('crear_credito_q10', $crear_credito_q10, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                     
                
                    <div class="col-md-4 form-group">
                        <label for="">Tomar foto Q10</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('foto_q10', $foto_q10, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                     
                </div>
                
                
                
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Confirmación del pago</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('confirmacion_pago', $confirmacion_pago, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                     
                
                    <div class="col-md-4 form-group">
                        <label for="">Registrar al estudiante en SIMAT O SIET</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('registra_estudiante_simat', $registra_estudiante_simat, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_academico_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                     
                </div>
                
                
            </div>
        </div>
        
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>RECTORIA</b></div>
            <div class="panel-body">                
                 <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Recibe carpeta con todos los items anteriores</label>
                   </div>        
                    <div class="col-md-2 form-group">     
                        <?php
                        $combo->getComboDb('recibe_carpeta_items', $recibe_carpeta_items, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_rectoria_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>
                     
                    <div class="col-md-4 form-group">
                        <label for="">Firma contrato de matricula, matricula, solicitud de credito (si aplica)</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('firma_contrato_matricula', $firma_contrato_matricula, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_rectoria_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                   
                 </div>         
                
                
                <div class="row">    
                    <div class="col-md-4 form-group">
                        <label for="">Devuelve carpeta para archivo</label>
                    </div>        
                    <div class="col-md-2 form-group">    
                        <?php
                        $combo->getComboDb('devuelve_carpeta', $devuelve_carpeta, $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', 'Seleccione', '', $ind_rectoria_c, 'width:120px;', '', 'form-control');
                        ?>
                    </div>                                                        
                </div>
            </div>
        </div>
        
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>RESPONSABLES</b></div>
            <div class="panel-body">                
                <div class="row">
                   <div class="col-md-2 form-group">
                        <label for="">COMERCIAL</label>
                   </div>        
                   <div class="col-md-1 form-group">
                        <label for="">Fecha:</label>
                   </div>        
                   <div class="col-md-3 form-group">    
                        <input type="text" <?php echo($ind_asesores_t);?> class="form-control" name="fecha_rev_comercial" id="fecha_rev_comercial" placeholder="dd/mm/aaaa" value="<?php echo $fecha_rev_comercial;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                   </div>                   
                 
                
                   <div class="col-md-1 form-group">
                       <label for="">Observación:</label>
                   </div>        
                   <div class="col-md-5 form-group">    
                       <textarea <?php echo($ind_asesores_t);?> rows=5 class="form-control" name="observacion_comercial" id="observacion_comercial" placeholder="Observaciones" value="" onblur="trim_cadena(this); convertirAMayusculas(this);" > <?php echo($observacion_comercial);?></textarea>
                   </div>                                                        
               </div> 
                
               <div class="row">
                   <div class="col-md-2 form-group">
                        <label for="">SECRETARIA ACADEMICA</label>
                   </div>        
                   <div class="col-md-1 form-group">
                        <label for="">Fecha:</label>
                   </div>        
                   <div class="col-md-3 form-group">    
                        <input type="text" <?php echo($ind_academico_t);?> class="form-control" name="fecha_rev_academica" id="fecha_rev_academica" placeholder="dd/mm/aaaa" value="<?php echo $fecha_rev_academica;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                   </div>                   
                 
                
                   <div class="col-md-1 form-group">
                       <label for="">Observación:</label>
                   </div>        
                   <div class="col-md-5 form-group">    
                       <textarea rows=5 <?php echo($ind_academico_t);?> class="form-control" name="observacion_academica" id="observacion_academica" placeholder="Observaciones" value="" onblur="trim_cadena(this); convertirAMayusculas(this);" > <?php echo($observacion_academica);?></textarea>
                   </div>                                                        
               </div>  
                
               <div class="row">
                   <div class="col-md-2 form-group">
                        <label for="">RECTORIA</label>
                   </div>        
                   <div class="col-md-1 form-group">
                        <label for="">Fecha:</label>
                   </div>        
                   <div class="col-md-3 form-group">    
                        <input type="text" <?php echo($ind_rectoria_t);?> class="form-control" name="fecha_rev_rectoria" id="fecha_rev_rectoria" placeholder="dd/mm/aaaa" value="<?php echo $fecha_rev_rectoria;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                   </div>                   
                 
                
                   <div class="col-md-1 form-group">
                       <label for="">Observación:</label>
                   </div>        
                   <div class="col-md-5 form-group">    
                       <textarea rows=5 <?php echo($ind_rectoria_t);?> class="form-control" name="observacion_rectoria" id="observacion_rectoria" placeholder="Observaciones" value="" onblur="trim_cadena(this); convertirAMayusculas(this);" > <?php echo($observacion_rectoria);?></textarea>
                   </div>                                                        
               </div>   
                
                
                
                
            </div>
        </div>
        
        
        
        
        
        
        
        
        <div class="panel panel-primary">
        <div class="panel-body">
        <div class="centrar">
                <?php
            if ($tipo_accion == 2) {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!-- <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_editar_chequeo(2);">Guardar Datos</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_buscar_registro();">Cancelar</button>

                <?php
            } 
            else {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!-- <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_crear_registro" nombre="btn_crear_registro" onclick="validar_crear_editar_chequeo(1);">Guardar Nuevo</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_buscar_registro();">Cancelar</button>

                <?php
            }
            ?>
        </div>
        </div>
        </div>    

        <script id='ajax'>
            //<![CDATA[ 
            $(function(){
                $(".solo_numeros").keydown(function(event){
                    //alert(event.keyCode);
                    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                        return false;
                    }
                });
            });
            
            
            
            var valor_programa = document.getElementById('valor_programa');
            valor_programa.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            var descuento = document.getElementById('descuento');
            descuento.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            
            var valor_neto_pagar = document.getElementById('valor_neto_pagar');
            valor_neto_pagar.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            
            
            var cuota_inicial = document.getElementById('cuota_inicial');
            cuota_inicial.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            var valor_financiar = document.getElementById('valor_financiar');
            valor_financiar.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            var valor_cuota = document.getElementById('valor_cuota');
            valor_cuota.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            
            //]]>
        </script>
        
	    
    
    
    <?php
               
            
    break;
	
    case "2": 
		
        $txt_busca_id = $_POST["txt_busca_id"];		
        $tabla_registro = $dbRegistroPersonas->getPersona($txt_busca_id);
        $cantidad_registro = count($tabla_registro);
		
		
	?>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">

                    <div id="paginador" class="centrar">
                        <nav>
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>

                    <table class="table table-bordered" >
                        <thead>
                            <tr><th colspan='6' style="text-align: center;">Datos Personales</th></tr>
                            <tr>
                                <th style="width:5%;text-align:center;">Documento</th>
                                <th style="width:15%;text-align:center;">Nombre Completo</th>
                                <th style="width:10%;text-align:center;">Telefonos</th>
                                <th style="width:10%;text-align:center;">E-mail</th>
                                <th style="width:20%;text-align:center;">Direcci&oacute;n</th>
                                <th style="width:10%;text-align:center;">Ciudad</th>
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_registro);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            	
                            @$id_persona = $tabla_registro[0]['id_persona'];
                            @$nombre_completo = $tabla_registro[0]['nombre_completo'];
                            @$documento_persona = $tabla_registro[0]['documento_persona'];
                            @$fecha_nacimiento = $tabla_registro[0]['format_fecha_nacimiento'];                                
                            @$tel_casa_persona = $tabla_registro[0]['tel_casa_persona'];
                            @$tel_movil_persona = $tabla_registro[0]['tel_movil_persona'];
                            @$email_persona = $tabla_registro[0]['email_persona'];
                            @$direccion_casa = $tabla_registro[0]['direccion_casa'];
                            @$ciudad_residencia = $tabla_registro[0]['ciudad_residencia'];
                            //$tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $format_fecha_inscripcion);
                            ?>
                            <tr>    
                                <td align="left"><?php echo $documento_persona; ?></td>
                                <td align="left"><?php echo $nombre_completo; ?></td>
                                <td align="left"><?php echo $tel_casa_persona." ".$tel_movil_persona; ?></td>
                                <td align="left"><?php echo $email_persona; ?></td>                                
                                <td align="left"><?php echo $direccion_casa; ?></td>
                                <td align="left"><?php echo $ciudad_residencia; ?></td>                                
                            </tr>
                            <?php
                                
                            
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="7">No se encontraron datos<br />Desea crea un nuevo registro con este N&uacute;mero de Documento: <b><?php echo($txt_busca_id);?></b> </td>
                            </tr>
                            
                            <?php
                        }
                        ?>
                    </table>
                    
                    
                    
                <?php
                if ($cantidad_registro > 0) {

                    $tabla_inscripcion = $dbRegistroPersonas->getPersonaInscripciones($id_persona);
                    $cantidad_inscripcion = count($tabla_inscripcion);
                    
                    if ($cantidad_inscripcion > 0) {
                    ?>    
                    <table class="table table-bordered">
                        <thead>
                            <tr><th colspan='7' style="text-align: center;">Inscripciones</th></tr>
                            <tr>
                                <th style="width:5%;text-align:center;">Tipo de Inscripci&oacute;n</th>
                                <th style="width:5%;text-align:center;">Fecha de Inscripci&oacute;n</th>
                                <th style="width:10%;text-align:center;">Programa</th>
                                <th style="width:10%;text-align:center;">Jornada</th>                                
                                <th colspan="2" style="width:5%;text-align:center;">Opciones</th>
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_registro);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                        
                        foreach ($tabla_inscripcion as $fila_inscripcion) {                                	
                            
                            @$id_academica = $fila_inscripcion['id_reg_academica'];                            
                            @$nom_tipo_inscripcion = $fila_inscripcion['nom_tipo_inscripcion'];
                            @$format_fecha_inscripcion = $fila_inscripcion['format_fecha_inscripcion'];   
                            @$programa_incad = $fila_inscripcion['nom_id_programa'];
                            @$jornada_incad = $fila_inscripcion['nom_jornada'];                            
                            @$valor_programa = number_format($fila_inscripcion['valor_programa'], 0, '', '.');
                            @$descuento = number_format($fila_inscripcion['descuento'], 0, '', '.');
                            @$valor_neto_pagar = number_format($fila_inscripcion['valor_neto_pagar'], 0, '', '.');                            
                            @$id_credito = $fila_inscripcion['id_credito'];							
                            @$estado_registro = $fila_inscripcion['estado'];                            
                            if(@$id_credito == ''){@$id_credito=0;}                                 
                            @$id_forma_pago = $fila_inscripcion['id_forma_pago'];
                            @$id_entidad_financiera = $fila_inscripcion['id_entidad_financiera'];
                            
                            
                            //echo "Forma: ".$id_forma_pago. "    Entidad: ".$id_entidad_financiera."<br />";                            
                            
                            $tabla_creditp_incad = $dbRegistroPersonas->getValidarCreditoIncad($id_academica);                            
                            $credito_incad = $tabla_creditp_incad['id_formas_pago_inscripcion'];
                            

                            $ban_credito_incad = 'Sin credito';//Sin datos
                            //if($credito_incad > 0 && $id_credito > 0 ){
                            if($id_credito > 0 ){
                                $ban_credito_incad = 'Editar credito';//Editar
                            }
                            else if(($credito_incad > 0 || $id_entidad_financiera <> 68) && $id_credito <= 0){                            
                                $ban_credito_incad = 'Diligenciar credito ';//llenar Credito
                            }
							
							
                            if($estado_registro == 1) {
                                $reg_visible = "block";
                            }
                            else{
                                $reg_visible = "none";
                            }
                            

                            ?>
                            <tr>    
                                <td align="left"><?php echo $nom_tipo_inscripcion;?></td>
                                <td align="left"><?php echo $format_fecha_inscripcion; ?></td>
                                <td align="left"><?php echo $programa_incad; ?></td>
                                <td align="left"><?php echo $jornada_incad; ?></td>                                
                                <td style="cursor:pointer;" onclick="llamar_editar_lista(<?php echo($id_academica);?>)" align="center"><b> <a href="#">Editar</a> </b></td>
                                <td style="cursor:pointer;" align="center">
                                    <b> <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=1" target="_blank" >Imprimir</a> </b>
                                    
                                </td>
                            </tr>
                            
                            
                            
                            <?php
                                
                            
                        }
                        }
                        ?>
                    </table>
                    
                    <?php   
                    }
                    
                    
                }
                ?>
                    
                    
                    
                    
                </div>
            </div>
        </div>

        <script id='ajax'>
            //<![CDATA[ 
            $(function () {
                $('.paginated', 'table').each(function (i) {
                    $(this).text(i + 1);
                });

                $('table.paginated').each(function () {
                    var currentPage = 0;
                    var numPerPage = 10;
                    var $table = $(this);
                    $table.bind('repaginate', function () {
                        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
                    });
                    $table.trigger('repaginate');
                    var numRows = $table.find('tbody tr').length;
                    var numPages = Math.ceil(numRows / numPerPage);
                    var $pager = $('.pagination');
                    for (var page = 0; page < numPages; page++) {

                        $('<li><a href="#">' + (page + 1) + '</a></li>').bind('click', {
                            newPage: page
                        }, function (event) {
                            currentPage = event.data['newPage'];
                            $table.trigger('repaginate');
                            $(this).addClass('active').siblings().removeClass('active');

                        }).appendTo($pager);

                    }
                    $pager.appendTo('#paginador').find('li:first').addClass('active');
                });
            });
            //]]>
        </script>
        
        <?php
		    
		

    break;
	
	
	
	
    case "3"://

    break;
	
	
    case "4"://
        ?>
	<!-- Modal -->
	<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<?php
		@$titulo = $_POST["titulo"];
		@$funcion = $_POST["funcion"];
		?>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
				</div>
				<div class="modal-body centrar">

					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>;">Si</button>
				</div>

			</div>
		</div>
	</div>
	<?php
    break;
		
    case "5"://
            $id_usuario_crea = $_SESSION["idUsuario"];		

            @$reg_oportunidad = $_POST["reg_oportunidad"];
            @$info_basica = $_POST["info_basica"];
            @$preguntas_perso = $_POST["preguntas_perso"];
            @$info_acudiente = $_POST["info_acudiente"];
            @$inscripcion_estudiante = $_POST["inscripcion_estudiante"];
            @$matricula_foto = $_POST["matricula_foto"];
            @$contrato_matricula = $_POST["contrato_matricula"];
            @$fotocopia_documento_estudiante = $_POST["fotocopia_documento_estudiante"];
            @$fotocopia_documento_acudiente = $_POST["fotocopia_documento_acudiente"];
            @$fotocopia_certificado_ultimo_grado = $_POST["fotocopia_certificado_ultimo_grado"];
            @$fotocopia_diploma_bachiller = $_POST["fotocopia_diploma_bachiller"];
            @$carta_bienvenida = $_POST["carta_bienvenida"];
            @$solicitud_academica = $_POST["solicitud_academica"];
            @$carta_compromiso = $_POST["carta_compromiso"];
            @$paz_salvo_estudiante = $_POST["paz_salvo_estudiante"];
            @$autorizacion_centrales_riesgo = $_POST["autorizacion_centrales_riesgo"];
            @$solicitud_credito = $_POST["solicitud_credito"];
            @$consulta_datacredito = $_POST["consulta_datacredito"];
            @$pagare_carta_instrucciones = $_POST["pagare_carta_instrucciones"];
            @$plan_pagos = $_POST["plan_pagos"];
            @$entrega_carpeta = $_POST["entrega_carpeta"];
            @$registra_info_q10 = $_POST["registra_info_q10"];
            @$matricula_estudiante_q10 = $_POST["matricula_estudiante_q10"];
            @$crear_credito_q10 = $_POST["crear_credito_q10"];
            @$foto_q10 = $_POST["foto_q10"];
            @$confirmacion_pago = $_POST["confirmacion_pago"];
            @$registra_estudiante_simat = $_POST["registra_estudiante_simat"];
            @$recibe_carpeta_items = $_POST["recibe_carpeta_items"];
            @$firma_contrato_matricula = $_POST["firma_contrato_matricula"];
            @$devuelve_carpeta = $_POST["devuelve_carpeta"];
            @$fecha_rev_comercial = $_POST["fecha_rev_comercial"];
            @$observacion_comercial = $_POST["observacion_comercial"];
            @$fecha_rev_academica = $_POST["fecha_rev_academica"];
            @$observacion_academica = $_POST["observacion_academica"];
            @$fecha_rev_rectoria = $_POST["fecha_rev_rectoria"];
            @$observacion_rectoria = $_POST["observacion_rectoria"];
            
            @$hdd_id_academica = $_POST["hdd_id_academica"];        
            @$tipo_accion = $_POST["tipo_accion"];        
            

                
            $resultado = $dbChequeo->InsertUpdateRegistroChequeo($reg_oportunidad, $info_basica, $preguntas_perso, $info_acudiente, $inscripcion_estudiante, $matricula_foto, $contrato_matricula, $fotocopia_documento_estudiante, $fotocopia_documento_acudiente, $fotocopia_certificado_ultimo_grado, $fotocopia_diploma_bachiller, $carta_bienvenida, $solicitud_academica, $carta_compromiso, $paz_salvo_estudiante, $autorizacion_centrales_riesgo, $solicitud_credito, $consulta_datacredito, $pagare_carta_instrucciones, $plan_pagos, $entrega_carpeta, $registra_info_q10, $matricula_estudiante_q10, $crear_credito_q10, $foto_q10, $confirmacion_pago, $registra_estudiante_simat, $recibe_carpeta_items, $firma_contrato_matricula, $devuelve_carpeta, $fecha_rev_comercial, $observacion_comercial, $fecha_rev_academica, $observacion_academica, $fecha_rev_rectoria, $observacion_rectoria, $hdd_id_academica, $id_usuario_crea, $tipo_accion);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        
        <?php
    break;	
	
	
    case "6"://
    
    break;	
	
	
    case "7"://
    
    break;	
	
    case "8"://
   
    break;
		
    case "9"://
    
    break;	
		
		
    case "10"://
    
    break;


    case "11"://
    
    break;

    case "12"://
    
    break;
	
    case "13"://
    
    break;
    
	
	
	
	
}

?>