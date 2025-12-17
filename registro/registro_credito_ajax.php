<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Generar_Clave.php");

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();

$combo = new Combo_Box();

$id_usuario = $_SESSION["idUsuario"];

if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "5" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}



$tabla_curso=array();
$j=1;
for ($i = 0; $i <= 10; $i++) {
    
	$tabla_curso[$i][0]=$j;
	$tabla_curso[$i][1]=$j;
	$j++;
}

switch ($opcion) {
    case "1": //Crear Registro
    
    	$combo = new Combo_Box();
        
        $id_credito = $_POST['id_credito'];
        $id_academica = $_POST['id_academica'];
        $id_persona = $_POST['id_persona'];       
        
        $tabla_persona_academica = $dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        
        @$nombre_completo = $tabla_persona_academica['nombre_completo'];
        @$nombre_persona = $tabla_persona_academica['nombre_persona'];
        @$apellido_persona = $tabla_persona_academica['apellido_persona'];
        @$documento_persona = $tabla_persona_academica['documento_persona'];  
        @$tipo_documento = $tabla_persona_academica['tipo_documento'];
        @$nom_tipo_documento = $tabla_persona_academica['nom_tipo_documento'];       
        @$fecha_nacimiento = $tabla_persona_academica['format_fecha_nacimiento'];
        @$date_fecha_nacimiento = $tabla_persona_academica['fecha_nacimiento'];
        @$tel_casa_persona = $tabla_persona_academica['tel_casa_persona'];
        @$tel_movil_persona = $tabla_persona_academica['tel_movil_persona'];
        @$email_persona = $tabla_persona_academica['email_persona'];
        @$direccion_casa = $tabla_persona_academica['direccion_casa'];
        @$barrio_residencia = $tabla_persona_academica['barrio_residencia'];
        @$ciudad_residencia = $tabla_persona_academica['ciudad_residencia'];        
        
        @$nom_tipo_inscripcion = $tabla_persona_academica['nom_tipo_inscripcion'];
        @$format_fecha_inscripcion = $tabla_persona_academica['format_fecha_inscripcion'];   
        @$programa_incad = $tabla_persona_academica['nom_id_programa'];
        @$jornada_incad = $tabla_persona_academica['jornada_incad'];
        @$valor_programa = number_format($tabla_persona_academica['valor_programa'], 0, '', '.'); 
        @$descuento = number_format($tabla_persona_academica['descuento'], 0, '', '.'); 
        @$valor_neto_pagar = number_format($tabla_persona_academica['valor_neto_pagar'], 0, '', '.');         
        @$valor_financiar = number_format($tabla_persona_academica['valor_financiar'], 0, '', '.'); 
        @$num_cuotas = $tabla_persona_academica['num_cuotas'];
        @$valor_cuota = number_format($tabla_persona_academica['valor_cuota'], 0, '', '.'); 
		
        @$persona_noti_direccion = $tabla_persona_academica['persona_noti_direccion'];		
        if($persona_noti_direccion == 1){$checked_persona_noti_direccion = 'checked';}else{$checked_persona_noti_direccion = '';}		
        @$persona_noti_correo = $tabla_persona_academica['persona_noti_correo'];
        if($persona_noti_correo == 1){$checked_persona_noti_correo = 'checked';}else{$checked_persona_noti_correo = '';}
        
        
        $tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $format_fecha_inscripcion);
        $edad_anios = $tabla_edad_persona['anios'];
        
        $tipo_accion = 1; //Crear Registro
        
        
        if($edad_anios >= 18){            
            $tipo_documento_deudor = $tipo_documento;
            $documento_deudor = $documento_persona;
            $nombre_deudor = $nombre_persona;
            $apellido_deudor = $apellido_persona;
            $fecha_nacimiento_deudor = $fecha_nacimiento;
            $edad_deudor = $edad_anios;
            $direccion_residencia_deudor = $direccion_casa;
            $barrio_residencia_deudor = $barrio_residencia;
            $ciudad_residencia_deudor = $ciudad_residencia;
            $tel_casa_deudor = $tel_casa_persona;
            $tel_movil_deudor = $tel_movil_persona;
            $email_deudor = $email_persona;            
        }else{
            $tipo_documento_deudor = '';
            $documento_deudor = '';
            $nombre_deudor = '';
            $apellido_deudor = '';
            $fecha_nacimiento_deudor = '';
            $edad_deudor = '';
            $direccion_residencia_deudor = '';
            $barrio_residencia_deudor = '';
            $ciudad_residencia_deudor = '';
            $tel_casa_deudor = '';
            $tel_movil_deudor = '';
            $email_deudor = '';
        }
        

        
        
        $actividad_economica_deudor = '';
        $ingreso_mensual_deudor = '';
        $nombre_empresa_deudor = '';
        $direccion_empresa_deudor = '';
        $telefono_empresa_deudor = '';
        $tipo_vehiculo_deudor = '';        
        $placa_vehiculo_deudor = '';
        $marca_vehiculo_deudor = '';
        $modelo_vehiculo_deudor = '';
        $nom_ref_familiar_uno_deudor = '';
        $tel_ref_familiar_uno_deudor = '';
        $nom_ref_familiar_dos_deudor = '';
        $tel_ref_familiar_dos_deudor = '';
        $nom_ref_personal_uno_deudor = '';
        $tel_ref_personal_uno_deudor = '';
        $nom_ref_personal_dos_deudor = '';
        $tel_ref_personal_dos_deudor = '';
        $noti_direccion_deudor = '';
        $noti_correo_deudor = '';
        $checked_noti_direccion_deudor = '';
        $checked_noti_correo_deudor = '';
        $tipo_documento_codeudor = '';
        $documento_codeudor = '';
        $nombre_codeudor = '';
        $apellido_codeudor = '';
        $fecha_nacimiento_codeudor = '';
        $edad_codeudor = '';
        $direccion_residencia_codeudor = '';
        $barrio_residencia_codeudor = '';
        $ciudad_residencia_codeudor = '';
        $tel_casa_codeudor = '';
        $tel_movil_codeudor = '';
        $email_codeudor = '';
        $actividad_economica_codeudor = '';
        $ingreso_mensual_codeudor = '';
        $nombre_empresa_codeudor = '';
        $direccion_empresa_codeudor = '';
        $telefono_empresa_codeudor = '';       
        $tipo_vehiculo_codeudor = '';	
        $placa_vehiculo_codeudor = '';
        $marca_vehiculo_codeudor = '';
        $modelo_vehiculo_codeudor = '';
        $nom_ref_familiar_uno_codeudor = '';
        $tel_ref_familiar_uno_codeudor = '';
        $nom_ref_familiar_dos_codeudor = '';
        $tel_ref_familiar_dos_codeudor = '';
        $nom_ref_personal_uno_codeudor = '';
        $tel_ref_personal_uno_codeudor = '';
        $nom_ref_personal_dos_codeudor = '';
        $tel_ref_personal_dos_codeudor = '';
        $noti_direccion_codeudor = '';
        $noti_correo_codeudor = '';
        $checked_noti_direccion_codeudor = '';
        $checked_noti_correo_codeudor = '';
        
		
        if ($id_credito > 0) {
            $tipo_accion = 2; //Editar usuario				
                 
            //Busca por el registro medico de la seleccionada
            $tabla_credito = $dbRegistroPersonas->getCredito($id_credito);

            $id_credito = $tabla_credito['id_credito'];

            $tipo_documento_deudor= $tabla_credito['tipo_documento_deudor'];
            $documento_deudor= $tabla_credito['documento_deudor'];
            $nombre_deudor= $tabla_credito['nombre_deudor'];
            $apellido_deudor= $tabla_credito['apellido_deudor'];
            $fecha_nacimiento_deudor= $tabla_credito['format_fecha_nacimiento_deudor'];
            $edad_deudor= $tabla_credito['edad_deudor'];
            $direccion_residencia_deudor= $tabla_credito['direccion_residencia_deudor'];
            $barrio_residencia_deudor= $tabla_credito['barrio_residencia_deudor'];
            $ciudad_residencia_deudor= $tabla_credito['ciudad_residencia_deudor'];
            $tel_casa_deudor= $tabla_credito['tel_casa_deudor'];
            $tel_movil_deudor= $tabla_credito['tel_movil_deudor'];
            $email_deudor= $tabla_credito['email_deudor'];
            $actividad_economica_deudor= $tabla_credito['actividad_economica_deudor'];
            $ingreso_mensual_deudor = number_format($tabla_credito['ingreso_mensual_deudor'], 0, '', '.'); 				
            $nombre_empresa_deudor= $tabla_credito['nombre_empresa_deudor'];
            $direccion_empresa_deudor= $tabla_credito['direccion_empresa_deudor'];
            $telefono_empresa_deudor= $tabla_credito['telefono_empresa_deudor'];
            $tipo_vehiculo_deudor= $tabla_credito['tipo_vehiculo_deudor'];
            $placa_vehiculo_deudor= $tabla_credito['placa_vehiculo_deudor'];
            $marca_vehiculo_deudor= $tabla_credito['marca_vehiculo_deudor'];
            $modelo_vehiculo_deudor= $tabla_credito['modelo_vehiculo_deudor'];
            $nom_ref_familiar_uno_deudor= $tabla_credito['nom_ref_familiar_uno_deudor'];
            $tel_ref_familiar_uno_deudor= $tabla_credito['tel_ref_familiar_uno_deudor'];
            $nom_ref_familiar_dos_deudor= $tabla_credito['nom_ref_familiar_dos_deudor'];
            $tel_ref_familiar_dos_deudor= $tabla_credito['tel_ref_familiar_dos_deudor'];
            $nom_ref_personal_uno_deudor= $tabla_credito['nom_ref_personal_uno_deudor'];
            $tel_ref_personal_uno_deudor= $tabla_credito['tel_ref_personal_uno_deudor'];
            $nom_ref_personal_dos_deudor= $tabla_credito['nom_ref_personal_dos_deudor'];
            $tel_ref_personal_dos_deudor= $tabla_credito['tel_ref_personal_dos_deudor'];
			
            $noti_direccion_deudor= $tabla_credito['noti_direccion_deudor'];
            if($noti_direccion_deudor == 1){$checked_noti_direccion_deudor = 'checked';}
            $noti_correo_deudor= $tabla_credito['noti_correo_deudor'];
            if($noti_correo_deudor == 1){$checked_noti_correo_deudor = 'checked';}
			
            $tipo_documento_codeudor= $tabla_credito['tipo_documento_codeudor'];
            $documento_codeudor= $tabla_credito['documento_codeudor'];
            $nombre_codeudor= $tabla_credito['nombre_codeudor'];
            $apellido_codeudor= $tabla_credito['apellido_codeudor'];
            $fecha_nacimiento_codeudor= $tabla_credito['format_fecha_nacimiento_codeudor'];
            $edad_codeudor= $tabla_credito['edad_codeudor'];
            $direccion_residencia_codeudor= $tabla_credito['direccion_residencia_codeudor'];
            $barrio_residencia_codeudor= $tabla_credito['barrio_residencia_codeudor'];
            $ciudad_residencia_codeudor= $tabla_credito['ciudad_residencia_codeudor'];
            $tel_casa_codeudor= $tabla_credito['tel_casa_codeudor'];
            $tel_movil_codeudor= $tabla_credito['tel_movil_codeudor'];
            $email_codeudor= $tabla_credito['email_codeudor'];
            $actividad_economica_codeudor= $tabla_credito['actividad_economica_codeudor'];				
            $ingreso_mensual_codeudor = number_format($tabla_credito['ingreso_mensual_codeudor'], 0, '', '.'); 				
            $nombre_empresa_codeudor= $tabla_credito['nombre_empresa_codeudor'];
            $direccion_empresa_codeudor= $tabla_credito['direccion_empresa_codeudor'];
            $telefono_empresa_codeudor= $tabla_credito['telefono_empresa_codeudor'];
            $tipo_vehiculo_codeudor= $tabla_credito['tipo_vehiculo_codeudor'];
            $placa_vehiculo_codeudor= $tabla_credito['placa_vehiculo_codeudor'];
            $marca_vehiculo_codeudor= $tabla_credito['marca_vehiculo_codeudor'];
            $modelo_vehiculo_codeudor= $tabla_credito['modelo_vehiculo_codeudor'];
            $nom_ref_familiar_uno_codeudor= $tabla_credito['nom_ref_familiar_uno_codeudor'];
            $tel_ref_familiar_uno_codeudor= $tabla_credito['tel_ref_familiar_uno_codeudor'];
            $nom_ref_familiar_dos_codeudor= $tabla_credito['nom_ref_familiar_dos_codeudor'];
            $tel_ref_familiar_dos_codeudor= $tabla_credito['tel_ref_familiar_dos_codeudor'];
            $nom_ref_personal_uno_codeudor= $tabla_credito['nom_ref_personal_uno_codeudor'];
            $tel_ref_personal_uno_codeudor= $tabla_credito['tel_ref_personal_uno_codeudor'];
            $nom_ref_personal_dos_codeudor= $tabla_credito['nom_ref_personal_dos_codeudor'];
            $tel_ref_personal_dos_codeudor= $tabla_credito['tel_ref_personal_dos_codeudor'];
            $noti_direccion_codeudor= $tabla_credito['noti_direccion_codeudor'];
            if($noti_direccion_codeudor == 1){$checked_noti_direccion_codeudor = 'checked';}
            $noti_correo_codeudor= $tabla_credito['noti_correo_codeudor'];
            if($noti_correo_codeudor == 1){$checked_noti_correo_codeudor = 'checked';}

            $titulo_formulario = $lang["r_titulo_editar"];
        }
    
    
    ?>
    	<input type="hidden" value="<?php echo $id_persona; ?>" name="hdd_id_persona" id="hdd_id_persona" />
    	<input type="hidden" value="<?php echo $id_academica; ?>" name="hdd_id_academica" id="hdd_id_academica" />
        <input type="hidden" value="<?php echo $id_credito; ?>" name="hdd_id_credito" id="hdd_id_credito" />
    	
            
        
            <div class="panel panel-primary">
            <div class="panel-heading"><b>INFORMACI&Oacute;N DEL CR&Eacute;DITO</b></div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Programa Acad&eacute;mico INCAD: </label>
                        <span><?php echo $programa_incad; ?></span>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Fecha: </label>
                        <span><?php echo $format_fecha_inscripcion; ?></span>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-4 form-group">
                        <label for="">Valor del Programa *</label>
                        <span><?php echo $valor_programa; ?></span>
                    </div>                    
                    
                    <div class="col-md-4 form-group">
                        <label for="">Descuento *</label>
                        <span><?php echo $descuento; ?></span>
                    </div>                    
                    
                    <div class="col-md-4 form-group">
                        <label for="">Valor Neto a Pagar *</label>
                        <span><?php echo $valor_neto_pagar; ?></span>                        
                    </div>
                    
                </div>  
                
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Valor a Financiar *</label>
                        <span><?php echo $valor_financiar; ?></span>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">N&uacute;meros de cuotas *</label>
                        <span><?php echo $num_cuotas; ?></span>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">Valor cuotas *</label>
                        <span><?php echo $valor_cuota; ?></span>                       
                    </div>
                </div>      
                
            </div>
        </div>	  
        
        
        
        <div class="panel panel-primary">
        <div class="panel-heading"><b>INFORMACI&Oacute;N DEL ESTUDIANTE</b></div>
            <div class="panel-body">
                 <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="">Nombres: </label>
                        <span><?php echo $nombre_persona; ?></span>                        
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Apellidos: </label>
                        <span><?php echo $apellido_persona; ?></span>                       
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Tipo de documento: </label>
                        <span><?php echo $nom_tipo_documento; ?></span>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">N&uacute;mero de Documento: </label>
                        <span><?php echo $documento_persona; ?></span>                        
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Fecha de Nacimiento: </label>
                        <span><?php echo $fecha_nacimiento; ?></span>                        
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Edad: </label>
                        <span><?php echo $edad_anios; ?></span>                        
                    </div>
                                    
                </div>                

                
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Direcci&oacute;n Residencia: </label>
                        <span><?php echo $direccion_casa; ?></span>                        
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Barrio de Residencia: </label>
                        <span><?php echo $barrio_residencia; ?></span>                        
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Ciudad de Residencia: </label>
                        <span><?php echo $ciudad_residencia; ?></span>                        
                    </div>
                </div>               

                <div class="row">                    
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Casa: </label>
                        <span><?php echo $tel_casa_persona; ?></span>                        
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Celular: </label>
                        <span><?php echo $tel_movil_persona; ?></span>                        
                    </div>	                    
                    <div class="col-md-4 form-group">
                        <label for="">Correo electr&oacute;nico: </label>
                        <span><?php echo $email_persona; ?></span>
                        
                    </div>
                </div>
                
                <div class="row">                    
                   <div class="col-md-12 form-group">
                        <label for="">Envio Notificaciones:</label>                        
                   </div>  
                   <div class="col-md-2 form-check-inline">
                        <label id="label_persona_noti_direccion" class="form-check-label" for="">                        
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="persona_noti_direccion" id="persona_noti_direccion" <?php echo($checked_persona_noti_direccion);?> value="1" > 
                        Direcci&oacute;n
                        </label>
                    </div> 
                   <div class="col-md-2 form-check-inline">
                        <label id="label_persona_noti_correo" class="form-check-label" for="">
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="persona_noti_correo" id="persona_noti_correo" <?php echo($checked_persona_noti_correo);?> value="1" > 
                        Correo
                        </label>
                    </div>  
                </div>
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading"><b>INFORMACI&Oacute;N DEL DEUDOR</b></div>
            <div class="panel-body">
                 <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="">Nombres *</label>
                        <input type="text" class="form-control" name="nombre_deudor" id="nombre_deudor" placeholder="Nombres" value="<?php echo $nombre_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Apellidos *</label>
                        <input type="text" class="form-control" name="apellido_deudor" id="apellido_deudor" placeholder="Apellidos" value="<?php echo $apellido_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Tipo de documento *</label>
                        <?php
                        $combo->getComboDb('tipo_documento_deudor', $tipo_documento_deudor, $dbListas->getListaDetalles(1), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">N&uacute;mero de Documento *</label>
                        <input type="text" class="form-control" name="documento_deudor" id="documento_deudor" placeholder="Documento" value="<?php echo $documento_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); ">
                    </div>					
					<div class="col-md-3 form-group">
                        <label for="">Fecha de Nacimiento  *</label>
                        <input type="text" class="form-control" name="fecha_nacimiento_deudor" id="fecha_nacimiento_deudor" placeholder="dd/mm/aaaa" value="<?php echo $fecha_nacimiento_deudor;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3'); calcular_edad_hoy('div_edad_deudor', 'fecha_nacimiento_deudor', 'edad_deudor')">
                    </div>
					<div class="col-md-3 form-group" id='div_edad_deudor'>
                        <label for="">Edad</label><br />
						<label class="custom-control-label"><?php echo($edad_deudor); ?> A&ntilde;os</label>
						<input type="hidden" name="edad_deudor" id="edad_deudor"  value="<?php echo($edad_deudor); ?>"  >
                    </div>
					
                </div>                
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Direcci&oacute;n Residencia *</label>
                        <input type="text" class="form-control" name="direccion_residencia_deudor" id="direccion_residencia_deudor" placeholder="Direcci&oacute;n Residencia" value="<?php echo $direccion_residencia_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Barrio de Residencia *</label>
                        <input type="text" class="form-control" name="barrio_residencia_deudor" id="barrio_residencia_deudor" placeholder="Barrio Residencia" value="<?php echo $barrio_residencia_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Ciudad de Residencia *</label>
                        <input type="text" class="form-control" name="ciudad_residencia_deudor" id="ciudad_residencia_deudor" placeholder="Ciudad Residencia" value="<?php echo $ciudad_residencia_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                </div>               

                <div class="row">                    
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Casa *</label>
                        <input type="text" class="form-control" name="tel_casa_deudor" id="tel_casa_deudor" placeholder="Tel&eacute;fono Casa" value="<?php echo $tel_casa_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Celular  *</label>
                        <input type="text" class="form-control" name="tel_movil_deudor" id="tel_movil_deudor" placeholder="Tel&eacute;fono Celular" value="<?php echo $tel_movil_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>	                    
                    <div class="col-md-3 form-group">
                        <label for="">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" name="email_deudor" id="email_deudor" placeholder="you@example.com" value="<?php echo $email_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                </div>
				
				<div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Actividad Econ&oacute;mica *</label>
                        <input type="text" class="form-control" name="actividad_economica_deudor" id="actividad_economica_deudor" placeholder="Actividad Econ&oacute;mica" value="<?php echo $actividad_economica_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
					<div class="col-md-3 form-group">
                        <label for="">Ingreso al Mes *</label>
                        <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="solo_numeros input-group-addon form-control" name="ingreso_mensual_deudor" id="ingreso_mensual_deudor" placeholder="Ingreso Mensual" value="<?php echo $ingreso_mensual_deudor; ?>" onblur="trim_cadena(this);" />
                        </div>
                    </div>					
					
                    <div class="col-md-4 form-group">
                        <label for="">Nombre Empresa *</label>
                        <input type="text" class="form-control" name="nombre_empresa_deudor" id="nombre_empresa_deudor" placeholder="Nombre Empresa" value="<?php echo $nombre_empresa_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    
                </div>
				
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="">Direcci&oacute;n Empresa *</label>
                        <input type="text" class="form-control" name="direccion_empresa_deudor" id="direccion_empresa_deudor" placeholder="Direcci&oacute;n" value="<?php echo $direccion_empresa_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
					
                    <div class="col-md-4 form-group">
                        <label for="">Tel&eacute;fono Laboral *</label>
                        <input type="text" class="form-control" name="telefono_empresa_deudor" id="telefono_empresa_deudor" placeholder="Tel&eacute;fono Laboral" value="<?php echo $telefono_empresa_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    </div>
				
				
                   <div class="row">                                       
                   <div class="col-md-3 form-group">
                        <label for="">Tipo Veh&iacute;culo *</label>
                        <?php
                        $combo->getComboDb('tipo_vehiculo_deudor', $tipo_vehiculo_deudor, $dbListas->getListaDetalles(9), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>                       
                    </div>					
                    <div class="col-md-3 form-group">
                        <label for="">Placa *</label>
                        <input type="text" class="form-control" name="placa_vehiculo_deudor" id="placa_vehiculo_deudor" placeholder="Placa" value="<?php echo $placa_vehiculo_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
					<div class="col-md-3 form-group">
                        <label for="">Marca *</label>
                        <input type="text" class="form-control" name="marca_vehiculo_deudor" id="marca_vehiculo_deudor" placeholder="Marca" value="<?php echo $marca_vehiculo_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
					<div class="col-md-3 form-group">
                        <label for="">Modelo *</label>
                        <input type="text" class="form-control" name="modelo_vehiculo_deudor" id="modelo_vehiculo_deudor" placeholder="Modelo" value="<?php echo $modelo_vehiculo_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                    </div>
				
                    <div class="row">                                                          
                        <div class="col-md-3 form-group">
                        <label for="">Ref. Familiar 1 *</label>
                        <input type="text" class="form-control" name="nom_ref_familiar_uno_deudor" id="nom_ref_familiar_uno_deudor" placeholder="Ref Familiar" value="<?php echo $nom_ref_familiar_uno_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_familiar_uno_deudor" id="tel_ref_familiar_uno_deudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_familiar_uno_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
					
					
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Familiar 2 *</label>
                        <input type="text" class="form-control" name="nom_ref_familiar_dos_deudor" id="nom_ref_familiar_dos_deudor" placeholder="Ref Familiar" value="<?php echo $nom_ref_familiar_dos_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_familiar_dos_deudor" id="tel_ref_familiar_dos_deudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_familiar_dos_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                    </div>
				
				
                    <div class="row">                                                          
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Personal 1 *</label>
                        <input type="text" class="form-control" name="nom_ref_personal_uno_deudor" id="nom_ref_personal_uno_deudor" placeholder="Ref Personal" value="<?php echo $nom_ref_personal_uno_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_personal_uno_deudor" id="tel_ref_personal_uno_deudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_personal_uno_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
					
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Personal 2 *</label>
                        <input type="text" class="form-control" name="nom_ref_personal_dos_deudor" id="nom_ref_personal_dos_deudor" placeholder="Ref Personal" value="<?php echo $nom_ref_personal_dos_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_personal_dos_deudor" id="tel_ref_personal_dos_deudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_personal_dos_deudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                </div>
				
				
                <div class="row">                    
                   <div class="col-md-12 form-group">
                        <label for="">Envio Notificaciones:</label>                        
                   </div>  
                   <div class="col-md-2 form-check-inline">
                        <label id="label_noti_direccion_deudor" class="form-check-label" for="">                        
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="noti_direccion_deudor" id="noti_direccion_deudor" <?php echo($checked_noti_direccion_deudor);?> value="1" > 
                        Direcci&oacute;n
                        </label>
                    </div> 
                   <div class="col-md-2 form-check-inline">
                        <label id="label_noti_correo_deudor" class="form-check-label" for="">
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="noti_correo_deudor" id="noti_correo_deudor" <?php echo($checked_noti_correo_deudor);?> value="1" > 
                        Correo
                        </label>
                    </div>  
                </div>
				
            </div>
        </div>	
		
		
        <div class="panel panel-primary">
            <div class="panel-heading"><b>INFORMACI&Oacute;N DEL CODEUDOR</b>&nbsp;&nbsp;&nbsp;
                <br />
               <b>Codeudor Sin Informaci&oacute;n</b> 
               <input style="height: 20px; width: 30px;" type="checkbox" class="form-check-input" name="verificar_codeudor" id="noti_direccion_deudor" value="1"  onclick="validar_sin_info(this);">
                
            
            </div>
            <div class="panel-body">
                 <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="">Nombres *</label>
                        <input type="text" class="form-control" name="nombre_codeudor" id="nombre_codeudor" placeholder="Nombres" value="<?php echo $nombre_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Apellidos *</label>
                        <input type="text" class="form-control" name="apellido_codeudor" id="apellido_codeudor" placeholder="Apellidos" value="<?php echo $apellido_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Tipo de documento *</label>
                        <?php
                        $combo->getComboDb('tipo_documento_codeudor', $tipo_documento_codeudor, $dbListas->getListaDetalles(1), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">N&uacute;mero de Documento *</label>
                        <input type="text" class="form-control" name="documento_codeudor" id="documento_codeudor" placeholder="Documento" value="<?php echo $documento_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); ">
                    </div>					
                    <div class="col-md-3 form-group">
                        <label for="">Fecha de Nacimiento  *</label>
                        <input type="text" class="form-control" name="fecha_nacimiento_codeudor" id="fecha_nacimiento_codeudor" placeholder="dd/mm/aaaa" value="<?php echo $fecha_nacimiento_codeudor;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3'); calcular_edad_hoy('div_edad_codeudor', 'fecha_nacimiento_codeudor', 'edad_codeudor') ">
                    </div>      
					<div class="col-md-3 form-group" id='div_edad_codeudor'>
                        <label for="">Edad</label>
						<label class="custom-control-label"><?php echo($edad_codeudor); ?> A&ntilde;os</label>
						<input type="hidden" name="edad_codeudor" id="edad_codeudor"  value="<?php echo($edad_codeudor); ?>"  >
                         
                    </div>					
                </div>                
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Direcci&oacute;n Residencia *</label>
                        <input type="text" class="form-control" name="direccion_residencia_codeudor" id="direccion_residencia_codeudor" placeholder="Direcci&oacute;n Residencia" value="<?php echo $direccion_residencia_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Barrio de Residencia *</label>
                        <input type="text" class="form-control" name="barrio_residencia_codeudor" id="barrio_residencia_codeudor" placeholder="Barrio Residencia" value="<?php echo $barrio_residencia_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Ciudad de Residencia *</label>
                        <input type="text" class="form-control" name="ciudad_residencia_codeudor" id="ciudad_residencia_codeudor" placeholder="Ciudad Residencia" value="<?php echo $ciudad_residencia_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                </div>               

                <div class="row">                    
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Casa *</label>
                        <input type="text" class="form-control" name="tel_casa_codeudor" id="tel_casa_codeudor" placeholder="Tel&eacute;fono Casa" value="<?php echo $tel_casa_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono Celular  *</label>
                        <input type="text" class="form-control" name="tel_movil_codeudor" id="tel_movil_codeudor" placeholder="Tel&eacute;fono Celular" value="<?php echo $tel_movil_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>	                    
                    <div class="col-md-3 form-group">
                        <label for="">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" name="email_codeudor" id="email_codeudor" placeholder="you@example.com" value="<?php echo $email_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                </div>
				
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Actividad Econ&oacute;mica *</label>
                        <input type="text" class="form-control" name="actividad_economica_codeudor" id="actividad_economica_codeudor" placeholder="Actividad Econ&oacute;mica" value="<?php echo $actividad_economica_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">Ingreso al Mes *</label>
                        <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="solo_numeros input-group-addon form-control" name="ingreso_mensual_codeudor" id="ingreso_mensual_codeudor" placeholder="Ingreso Mensual" value="<?php echo $ingreso_mensual_codeudor; ?>" onblur="trim_cadena(this);" />
                        </div>
                    </div>					
					
                    <div class="col-md-4 form-group">
                        <label for="">Nombre Empresa *</label>
                        <input type="text" class="form-control" name="nombre_empresa_codeudor" id="nombre_empresa_codeudor" placeholder="Nombre Empresa" value="<?php echo $nombre_empresa_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                    
                </div>
				
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Direcci&oacute;n Empresa *</label>
                        <input type="text" class="form-control" name="direccion_empresa_codeudor" id="direccion_empresa_codeudor" placeholder="Direcci&oacute;n" value="<?php echo $direccion_empresa_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
					
					<div class="col-md-4 form-group">
                        <label for="">Tel&eacute;fono Laboral *</label>
                        <input type="text" class="form-control" name="telefono_empresa_codeudor" id="telefono_empresa_codeudor" placeholder="Tel&eacute;fono Laboral" value="<?php echo $telefono_empresa_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    </div>
				
				
                <div class="row">                                       
                   <div class="col-md-3 form-group">
                        <label for="">Tipo Veh&iacute;culo *</label>
                        <?php
                        $combo->getComboDb('tipo_vehiculo_codeudor', $tipo_vehiculo_codeudor, $dbListas->getListaDetalles(9), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>                       
                    </div>					
                    <div class="col-md-3 form-group">
                        <label for="">Placa *</label>
                        <input type="text" class="form-control" name="placa_vehiculo_codeudor" id="placa_vehiculo_codeudor" placeholder="Placa" value="<?php echo $placa_vehiculo_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Marca *</label>
                        <input type="text" class="form-control" name="marca_vehiculo_codeudor" id="marca_vehiculo_codeudor" placeholder="Marca" value="<?php echo $marca_vehiculo_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Modelo *</label>
                        <input type="text" class="form-control" name="modelo_vehiculo_codeudor" id="modelo_vehiculo_codeudor" placeholder="Modelo" value="<?php echo $modelo_vehiculo_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                </div>
				
                <div class="row">                                                          
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Familiar 1 *</label>
                        <input type="text" class="form-control" name="nom_ref_familiar_uno_codeudor" id="nom_ref_familiar_uno_codeudor" placeholder="Ref Familiar" value="<?php echo $nom_ref_familiar_uno_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_familiar_uno_codeudor" id="tel_ref_familiar_uno_codeudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_familiar_uno_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>								
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Familiar 2 *</label>
                        <input type="text" class="form-control" name="nom_ref_familiar_dos_codeudor" id="nom_ref_familiar_dos_codeudor" placeholder="Ref Familiar" value="<?php echo $nom_ref_familiar_dos_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_familiar_dos_codeudor" id="tel_ref_familiar_dos_codeudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_familiar_dos_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                </div>
				
				
                <div class="row">                                                          
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Personal 1 *</label>
                        <input type="text" class="form-control" name="nom_ref_personal_uno_codeudor" id="nom_ref_personal_uno_codeudor" placeholder="Ref Personal" value="<?php echo $nom_ref_personal_uno_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_personal_uno_codeudor" id="tel_ref_personal_uno_codeudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_personal_uno_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
					
                    <div class="col-md-3 form-group">
                        <label for="">Ref. Personal 2 *</label>
                        <input type="text" class="form-control" name="nom_ref_personal_dos_codeudor" id="nom_ref_personal_dos_codeudor" placeholder="Ref Personal" value="<?php echo $nom_ref_personal_dos_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="tel_ref_personal_dos_codeudor" id="tel_ref_personal_dos_codeudor" placeholder="Tel&eacute;fono" value="<?php echo $tel_ref_personal_dos_codeudor; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>					
                </div>
				
				
                <div class="row">                    
                   <div class="col-md-12 form-group">
                        <label for="">Envio Notificaciones:</label>                        
                   </div>  
                   <div class="col-md-2 form-check-inline">
                        <label id="label_noti_direccion_codeudor" class="form-check-label" for="">                        
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="noti_direccion_codeudor" id="noti_direccion_codeudor" <?php echo($checked_noti_direccion_codeudor);?> value="1" > 
                        Direcci&oacute;n
                        </label>
                    </div> 
                   <div class="col-md-2 form-check-inline">
                        <label id="label_noti_correo_codeudor" class="form-check-label" for="">
                        <input style="height: 20px;" type="checkbox" class="form-check-input form-control" name="noti_correo_codeudor" id="noti_correo_codeudor" <?php echo($checked_noti_correo_codeudor);?> value="1" > 
                        Correo
                        </label>
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
                    <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_editar_credito(2);">Guardar Datos</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

                <?php
            } else if ($tipo_accion == 3) {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!-- <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_editar_credito(3);">Guardar Datos</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

                <?php
            }
            else {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!-- <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_crear_registro" nombre="btn_crear_registro" onclick="validar_crear_editar_credito(1);">Guardar Nuevo</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

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
            
            
            
            var ingreso_mensual_codeudor = document.getElementById('ingreso_mensual_codeudor');
            ingreso_mensual_codeudor.addEventListener('input', (e) => {
                var entrada = e.target.value.split(','),
                  parteEntera = entrada[0].replace(/\./g, ''),
                  parteDecimal = entrada[1],
                  salida = parteEntera.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                e.target.value = salida + (parteDecimal !== undefined ? ',' + parteDecimal : '');
            }, false);
            
            var ingreso_mensual_deudor = document.getElementById('ingreso_mensual_deudor');
            ingreso_mensual_deudor.addEventListener('input', (e) => {
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
	
	case "3": 
		
            @$txt_fecha_hoy = $_POST["txt_fecha_hoy"];
            @$txt_fecha_nacimiento = $_POST["txt_fecha_nacimiento"];
			@$campo_edad = $_POST["campo_edad"];	

            $tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($txt_fecha_nacimiento, $txt_fecha_hoy);

            if($tabla_edad_persona['anios']>0){
                    ?>
				<label for="">Edad</label>	<br />
                <label class="custom-control-label"><?php echo($tabla_edad_persona['anios']); ?> A&ntilde;os</label>
				<input type="hidden" name="<?php echo($campo_edad); ?>" id="<?php echo($campo_edad); ?>"  value="<?php echo($tabla_edad_persona['anios']); ?>"  >
                <?php	
            }
            else{
                    ?>
				<label for="">Edad</label>	<br />
                <label class="custom-control-label"> -- </label>
				<input type="hidden" name="<?php echo($campo_edad); ?>" id="<?php echo($campo_edad); ?>"  value="0"  >
				
				
				
                <?php
            }

    break;
	
	
	
	
	
		
    case "4"://Modal, Confirmacion
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
		
	case "5": //Opcion para crear equipos
                $id_usuario_crea = $_SESSION["idUsuario"];		
		
		@$persona_noti_direccion = $_POST["persona_noti_direccion"];
                @$persona_noti_correo = $_POST["persona_noti_correo"];
                @$tipo_documento_deudor = $_POST["tipo_documento_deudor"];
                @$documento_deudor = $_POST["documento_deudor"];
                @$nombre_deudor = urldecode($_POST["nombre_deudor"]);
                @$apellido_deudor = urldecode($_POST["apellido_deudor"]);
                @$fecha_nacimiento_deudor = $_POST["fecha_nacimiento_deudor"];
                @$edad_deudor = $_POST["edad_deudor"];
                @$direccion_residencia_deudor = urldecode($_POST["direccion_residencia_deudor"]);
                @$barrio_residencia_deudor = urldecode($_POST["barrio_residencia_deudor"]);
                @$ciudad_residencia_deudor = urldecode($_POST["ciudad_residencia_deudor"]);
                @$tel_casa_deudor = urldecode($_POST["tel_casa_deudor"]);
                @$tel_movil_deudor = urldecode($_POST["tel_movil_deudor"]);
                @$email_deudor = urldecode($_POST["email_deudor"]);
                @$actividad_economica_deudor = urldecode($_POST["actividad_economica_deudor"]);
                @$ingreso_mensual_deudor = $_POST["ingreso_mensual_deudor"];
                @$nombre_empresa_deudor = urldecode($_POST["nombre_empresa_deudor"]);
                @$direccion_empresa_deudor = urldecode($_POST["direccion_empresa_deudor"]);
                @$telefono_empresa_deudor = urldecode($_POST["telefono_empresa_deudor"]);
                @$tipo_vehiculo_deudor = $_POST["tipo_vehiculo_deudor"];
                @$placa_vehiculo_deudor = $_POST["placa_vehiculo_deudor"];
                @$marca_vehiculo_deudor = $_POST["marca_vehiculo_deudor"];
                @$modelo_vehiculo_deudor = $_POST["modelo_vehiculo_deudor"];
                @$nom_ref_familiar_uno_deudor = urldecode($_POST["nom_ref_familiar_uno_deudor"]);
                @$tel_ref_familiar_uno_deudor = urldecode($_POST["tel_ref_familiar_uno_deudor"]);
                @$nom_ref_familiar_dos_deudor = urldecode($_POST["nom_ref_familiar_dos_deudor"]);
                @$tel_ref_familiar_dos_deudor = urldecode($_POST["tel_ref_familiar_dos_deudor"]);
                @$nom_ref_personal_uno_deudor = urldecode($_POST["nom_ref_personal_uno_deudor"]);
                @$tel_ref_personal_uno_deudor = urldecode($_POST["tel_ref_personal_uno_deudor"]);
                @$nom_ref_personal_dos_deudor = urldecode($_POST["nom_ref_personal_dos_deudor"]);
                @$tel_ref_personal_dos_deudor = urldecode($_POST["tel_ref_personal_dos_deudor"]);
                @$noti_direccion_deudor = urldecode($_POST["noti_direccion_deudor"]);
                @$noti_correo_deudor = urldecode($_POST["noti_correo_deudor"]);
                @$tipo_documento_codeudor = $_POST["tipo_documento_codeudor"];
                @$documento_codeudor = $_POST["documento_codeudor"];
                @$nombre_codeudor = urldecode($_POST["nombre_codeudor"]);
                @$apellido_codeudor = urldecode($_POST["apellido_codeudor"]);
                @$fecha_nacimiento_codeudor = $_POST["fecha_nacimiento_codeudor"];
                @$edad_codeudor = $_POST["edad_codeudor"];
                @$direccion_residencia_codeudor = urldecode($_POST["direccion_residencia_codeudor"]);
                @$barrio_residencia_codeudor = urldecode($_POST["barrio_residencia_codeudor"]);
                @$ciudad_residencia_codeudor = urldecode($_POST["ciudad_residencia_codeudor"]);
                @$tel_casa_codeudor = urldecode($_POST["tel_casa_codeudor"]);
                @$tel_movil_codeudor = urldecode($_POST["tel_movil_codeudor"]);
                @$email_codeudor = urldecode($_POST["email_codeudor"]);
                @$actividad_economica_codeudor = urldecode($_POST["actividad_economica_codeudor"]);
                @$ingreso_mensual_codeudor = $_POST["ingreso_mensual_codeudor"];
                @$nombre_empresa_codeudor = urldecode($_POST["nombre_empresa_codeudor"]);
                @$direccion_empresa_codeudor = urldecode($_POST["direccion_empresa_codeudor"]);
                @$telefono_empresa_codeudor = urldecode($_POST["telefono_empresa_codeudor"]);
                @$tipo_vehiculo_codeudor = $_POST["tipo_vehiculo_codeudor"];
                @$placa_vehiculo_codeudor = $_POST["placa_vehiculo_codeudor"];
                @$marca_vehiculo_codeudor = $_POST["marca_vehiculo_codeudor"];
                @$modelo_vehiculo_codeudor = $_POST["modelo_vehiculo_codeudor"];
                @$nom_ref_familiar_uno_codeudor = urldecode($_POST["nom_ref_familiar_uno_codeudor"]);
                @$tel_ref_familiar_uno_codeudor = urldecode($_POST["tel_ref_familiar_uno_codeudor"]);
                @$nom_ref_familiar_dos_codeudor = urldecode($_POST["nom_ref_familiar_dos_codeudor"]);
                @$tel_ref_familiar_dos_codeudor = urldecode($_POST["tel_ref_familiar_dos_codeudor"]);
                @$nom_ref_personal_uno_codeudor = urldecode($_POST["nom_ref_personal_uno_codeudor"]);
                @$tel_ref_personal_uno_codeudor = urldecode($_POST["tel_ref_personal_uno_codeudor"]);
                @$nom_ref_personal_dos_codeudor = urldecode($_POST["nom_ref_personal_dos_codeudor"]);
                @$tel_ref_personal_dos_codeudor = urldecode($_POST["tel_ref_personal_dos_codeudor"]);
                @$noti_direccion_codeudor = $_POST["noti_direccion_codeudor"];
                @$noti_correo_codeudor = $_POST["noti_correo_codeudor"];                
                @$hdd_id_persona = $_POST["hdd_id_persona"];
                @$hdd_id_academica = $_POST["hdd_id_academica"];
                @$hdd_id_credito = $_POST["hdd_id_credito"];
                
                $resultado = $dbRegistroPersonas->InsertRegistroPersonaCredito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, $documento_deudor, $nombre_deudor, $apellido_deudor, $fecha_nacimiento_deudor, $edad_deudor, $direccion_residencia_deudor, $barrio_residencia_deudor, $ciudad_residencia_deudor, $tel_casa_deudor, $tel_movil_deudor, $email_deudor, $actividad_economica_deudor, $ingreso_mensual_deudor, $nombre_empresa_deudor, $direccion_empresa_deudor, $telefono_empresa_deudor, $tipo_vehiculo_deudor, $placa_vehiculo_deudor, $marca_vehiculo_deudor, $modelo_vehiculo_deudor, $nom_ref_familiar_uno_deudor, $tel_ref_familiar_uno_deudor, $nom_ref_familiar_dos_deudor, $tel_ref_familiar_dos_deudor, $nom_ref_personal_uno_deudor, $tel_ref_personal_uno_deudor, $nom_ref_personal_dos_deudor, $tel_ref_personal_dos_deudor, $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, $documento_codeudor, $nombre_codeudor, $apellido_codeudor, $fecha_nacimiento_codeudor, $edad_codeudor, $direccion_residencia_codeudor, $barrio_residencia_codeudor, $ciudad_residencia_codeudor, $tel_casa_codeudor, $tel_movil_codeudor, $email_codeudor, $actividad_economica_codeudor, $ingreso_mensual_codeudor, $nombre_empresa_codeudor, $direccion_empresa_codeudor, $telefono_empresa_codeudor, $tipo_vehiculo_codeudor, $placa_vehiculo_codeudor, $marca_vehiculo_codeudor, $modelo_vehiculo_codeudor, $nom_ref_familiar_uno_codeudor, $tel_ref_familiar_uno_codeudor, $nom_ref_familiar_dos_codeudor, $tel_ref_familiar_dos_codeudor, $nom_ref_personal_uno_codeudor, $tel_ref_personal_uno_codeudor, $nom_ref_personal_dos_codeudor, $tel_ref_personal_dos_codeudor, $noti_direccion_codeudor, $noti_correo_codeudor, $hdd_id_persona, $hdd_id_academica, $hdd_id_credito, $id_usuario_crea);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        
        <?php
    break;	
	
	
    case "6": //
            $id_usuario_crea = $_SESSION["idUsuario"];

            @$persona_noti_direccion = $_POST["persona_noti_direccion"];
            @$persona_noti_correo = $_POST["persona_noti_correo"];
            @$tipo_documento_deudor = $_POST["tipo_documento_deudor"];
            @$documento_deudor = $_POST["documento_deudor"];
            @$nombre_deudor = urldecode($_POST["nombre_deudor"]);
            @$apellido_deudor = urldecode($_POST["apellido_deudor"]);
            @$fecha_nacimiento_deudor = $_POST["fecha_nacimiento_deudor"];
            @$edad_deudor = $_POST["edad_deudor"];
            @$direccion_residencia_deudor = urldecode($_POST["direccion_residencia_deudor"]);
            @$barrio_residencia_deudor = urldecode($_POST["barrio_residencia_deudor"]);
            @$ciudad_residencia_deudor = urldecode($_POST["ciudad_residencia_deudor"]);
            @$tel_casa_deudor = urldecode($_POST["tel_casa_deudor"]);
            @$tel_movil_deudor = urldecode($_POST["tel_movil_deudor"]);
            @$email_deudor = urldecode($_POST["email_deudor"]);
            @$actividad_economica_deudor = urldecode($_POST["actividad_economica_deudor"]);
            @$ingreso_mensual_deudor = $_POST["ingreso_mensual_deudor"];
            @$nombre_empresa_deudor = urldecode($_POST["nombre_empresa_deudor"]);
            @$direccion_empresa_deudor = urldecode($_POST["direccion_empresa_deudor"]);
            @$telefono_empresa_deudor = urldecode($_POST["telefono_empresa_deudor"]);
            @$tipo_vehiculo_deudor = $_POST["tipo_vehiculo_deudor"];
            @$placa_vehiculo_deudor = $_POST["placa_vehiculo_deudor"];
            @$marca_vehiculo_deudor = $_POST["marca_vehiculo_deudor"];
            @$modelo_vehiculo_deudor = $_POST["modelo_vehiculo_deudor"];
            @$nom_ref_familiar_uno_deudor = urldecode($_POST["nom_ref_familiar_uno_deudor"]);
            @$tel_ref_familiar_uno_deudor = urldecode($_POST["tel_ref_familiar_uno_deudor"]);
            @$nom_ref_familiar_dos_deudor = urldecode($_POST["nom_ref_familiar_dos_deudor"]);
            @$tel_ref_familiar_dos_deudor = urldecode($_POST["tel_ref_familiar_dos_deudor"]);
            @$nom_ref_personal_uno_deudor = urldecode($_POST["nom_ref_personal_uno_deudor"]);
            @$tel_ref_personal_uno_deudor = urldecode($_POST["tel_ref_personal_uno_deudor"]);
            @$nom_ref_personal_dos_deudor = urldecode($_POST["nom_ref_personal_dos_deudor"]);
            @$tel_ref_personal_dos_deudor = urldecode($_POST["tel_ref_personal_dos_deudor"]);
            @$noti_direccion_deudor = urldecode($_POST["noti_direccion_deudor"]);
            @$noti_correo_deudor = urldecode($_POST["noti_correo_deudor"]);
            @$tipo_documento_codeudor = $_POST["tipo_documento_codeudor"];
            @$documento_codeudor = $_POST["documento_codeudor"];
            @$nombre_codeudor = urldecode($_POST["nombre_codeudor"]);
            @$apellido_codeudor = urldecode($_POST["apellido_codeudor"]);
            @$fecha_nacimiento_codeudor = $_POST["fecha_nacimiento_codeudor"];
            @$edad_codeudor = $_POST["edad_codeudor"];
            @$direccion_residencia_codeudor = urldecode($_POST["direccion_residencia_codeudor"]);
            @$barrio_residencia_codeudor = urldecode($_POST["barrio_residencia_codeudor"]);
            @$ciudad_residencia_codeudor = urldecode($_POST["ciudad_residencia_codeudor"]);
            @$tel_casa_codeudor = urldecode($_POST["tel_casa_codeudor"]);
            @$tel_movil_codeudor = urldecode($_POST["tel_movil_codeudor"]);
            @$email_codeudor = urldecode($_POST["email_codeudor"]);
            @$actividad_economica_codeudor = urldecode($_POST["actividad_economica_codeudor"]);
            @$ingreso_mensual_codeudor = $_POST["ingreso_mensual_codeudor"];
            @$nombre_empresa_codeudor = urldecode($_POST["nombre_empresa_codeudor"]);
            @$direccion_empresa_codeudor = urldecode($_POST["direccion_empresa_codeudor"]);
            @$telefono_empresa_codeudor = urldecode($_POST["telefono_empresa_codeudor"]);
            @$tipo_vehiculo_codeudor = $_POST["tipo_vehiculo_codeudor"];
            @$placa_vehiculo_codeudor = $_POST["placa_vehiculo_codeudor"];
            @$marca_vehiculo_codeudor = $_POST["marca_vehiculo_codeudor"];
            @$modelo_vehiculo_codeudor = $_POST["modelo_vehiculo_codeudor"];
            @$nom_ref_familiar_uno_codeudor = urldecode($_POST["nom_ref_familiar_uno_codeudor"]);
            @$tel_ref_familiar_uno_codeudor = urldecode($_POST["tel_ref_familiar_uno_codeudor"]);
            @$nom_ref_familiar_dos_codeudor = urldecode($_POST["nom_ref_familiar_dos_codeudor"]);
            @$tel_ref_familiar_dos_codeudor = urldecode($_POST["tel_ref_familiar_dos_codeudor"]);
            @$nom_ref_personal_uno_codeudor = urldecode($_POST["nom_ref_personal_uno_codeudor"]);
            @$tel_ref_personal_uno_codeudor = urldecode($_POST["tel_ref_personal_uno_codeudor"]);
            @$nom_ref_personal_dos_codeudor = urldecode($_POST["nom_ref_personal_dos_codeudor"]);
            @$tel_ref_personal_dos_codeudor = urldecode($_POST["tel_ref_personal_dos_codeudor"]);
            @$noti_direccion_codeudor = $_POST["noti_direccion_codeudor"];
            @$noti_correo_codeudor = $_POST["noti_correo_codeudor"];                
            @$hdd_id_persona = $_POST["hdd_id_persona"];
            @$hdd_id_academica = $_POST["hdd_id_academica"];
            @$hdd_id_credito = $_POST["hdd_id_credito"];
            
            $resultado = $dbRegistroPersonas->UpdateRegistroPersonaCredito($persona_noti_direccion, $persona_noti_correo, $tipo_documento_deudor, $documento_deudor, $nombre_deudor, $apellido_deudor, $fecha_nacimiento_deudor, $edad_deudor, $direccion_residencia_deudor, $barrio_residencia_deudor, $ciudad_residencia_deudor, $tel_casa_deudor, $tel_movil_deudor, $email_deudor, $actividad_economica_deudor, $ingreso_mensual_deudor, $nombre_empresa_deudor, $direccion_empresa_deudor, $telefono_empresa_deudor, $tipo_vehiculo_deudor, $placa_vehiculo_deudor, $marca_vehiculo_deudor, $modelo_vehiculo_deudor, $nom_ref_familiar_uno_deudor, $tel_ref_familiar_uno_deudor, $nom_ref_familiar_dos_deudor, $tel_ref_familiar_dos_deudor, $nom_ref_personal_uno_deudor, $tel_ref_personal_uno_deudor, $nom_ref_personal_dos_deudor, $tel_ref_personal_dos_deudor, $noti_direccion_deudor, $noti_correo_deudor, $tipo_documento_codeudor, $documento_codeudor, $nombre_codeudor, $apellido_codeudor, $fecha_nacimiento_codeudor, $edad_codeudor, $direccion_residencia_codeudor, $barrio_residencia_codeudor, $ciudad_residencia_codeudor, $tel_casa_codeudor, $tel_movil_codeudor, $email_codeudor, $actividad_economica_codeudor, $ingreso_mensual_codeudor, $nombre_empresa_codeudor, $direccion_empresa_codeudor, $telefono_empresa_codeudor, $tipo_vehiculo_codeudor, $placa_vehiculo_codeudor, $marca_vehiculo_codeudor, $modelo_vehiculo_codeudor, $nom_ref_familiar_uno_codeudor, $tel_ref_familiar_uno_codeudor, $nom_ref_familiar_dos_codeudor, $tel_ref_familiar_dos_codeudor, $nom_ref_personal_uno_codeudor, $tel_ref_personal_uno_codeudor, $nom_ref_personal_dos_codeudor, $tel_ref_personal_dos_codeudor, $noti_direccion_codeudor, $noti_correo_codeudor, $hdd_id_persona, $hdd_id_academica, $hdd_id_credito, $id_usuario_crea);

            
		
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
    break;	
	
	
    case "7": //Opcion buscar persona
        $id_usuario_crea = $_SESSION["idUsuario"];
	
        @$txt_documento_persona = urldecode($_POST["txt_documento_persona"]);
        $tabla_persona = $dbRegistroPersonas->getBuscarRegistroPersona($txt_documento_persona);
        $id_persona = $tabla_persona['id_persona'];		
        ?>
        <input type="hidden" value="<?php echo $id_persona; ?>" name="hdd_persona_encontrada" id="hdd_persona_encontrada" />
        <?php
    break;	
	
	case "8"://Modal, Confirmacion
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

                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                    </div>
                    <div class="modal-body centrar">
                        
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>;">Ok</button>
                    </div>

                </div>
            </div>
        </div>
        <?php
        break;
		
	 case "9"://Modal, Confirmacion
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <?php
            @$titulo = $_POST["titulo"];
            @$funcion = $_POST["funcion"];
			@$codigo_verificacion_base = $_POST["codigo_verificacion"];
			@$id_medica = $_POST["id_medica"];
			
			
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                    </div>
                    <div class="modal-body centrar">
                    	
                    	
                    	<div class="panel-body">                    	
                    			 <div class="row">
                    			 <div class="form-group">
                                    <div class="col-md-6">                   
                                        <input type="text" class="form-control" id="txt_codigo_verificacion" name="txt_codigo_verificacion" placeholder="C&oacute;digo de Verificaci&oacute;n" onblur="trim_cadena(this);">
                                        
                                        <input type="hidden" value="<?php echo($codigo_verificacion_base); ?>" name="hdd_codigo_verificacion_base" id="hdd_codigo_verificacion_base" />
                                        <input type="hidden" value="<?php echo($id_medica); ?>" name="hdd_id_medica" id="hdd_id_medica" />
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>;">Validar</button>
                                    </div>
                                </div>
                                </div>
                          </div>  
                          
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">No</button> -->
                        
                    </div>

                </div>
            </div>
        </div>
        <?php
        break;	
		
		
    case "10"://Modal, Confirmacion
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

                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                    </div>
                    <div class="modal-body centrar">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                    </div>

                </div>
            </div>
        </div>
        <?php
    break;


    case "11": //
            $id_usuario_crea = $_SESSION["idUsuario"];

            @$tipo_documento = $_POST["tipo_documento"];
            @$documento_persona = $_POST["documento_persona"];
            @$lugar_documento = urldecode($_POST["lugar_documento"]);
            @$fecha_documento = $_POST["fecha_documento"];
            @$nombre_persona = urldecode($_POST["nombre_persona"]);
            @$apellido_persona = urldecode($_POST["apellido_persona"]);
            @$fecha_nacimiento = $_POST["fecha_nacimiento"];
            @$lugar_nacimiento = urldecode($_POST["lugar_nacimiento"]);
            @$tipo_sangre = $_POST["tipo_sangre"];
            @$tel_casa_persona = urldecode($_POST["tel_casa_persona"]);
            @$tel_movil_persona = urldecode($_POST["tel_movil_persona"]);
            @$email_persona = urldecode($_POST["email_persona"]);
            @$estado_civil = $_POST["estado_civil"];
            @$direccion_casa = urldecode($_POST["direccion_casa"]);
            @$barrio_residencia = urldecode($_POST["barrio_residencia"]);
            @$ciudad_residencia = urldecode($_POST["ciudad_residencia"]);
            @$nombre_contacto_1 = urldecode($_POST["nombre_contacto_1"]);
            @$telefono_contacto_1 = urldecode($_POST["telefono_contacto_1"]);
            @$parentesco_contacto_1 = urldecode($_POST["parentesco_contacto_1"]);
            @$nombre_contacto_2 = urldecode($_POST["nombre_contacto_2"]);
            @$telefono_contacto_2 = urldecode($_POST["telefono_contacto_2"]);
            @$parentesco_contacto_2 = urldecode($_POST["parentesco_contacto_2"]);
            @$nombre_contacto_3 = urldecode($_POST["nombre_contacto_3"]);
            @$telefono_contacto_3 = urldecode($_POST["telefono_contacto_3"]);
            @$parentesco_contacto_3 = urldecode($_POST["parentesco_contacto_3"]);
            @$nombre_acudiente = urldecode($_POST["nombre_acudiente"]);
            @$telefono_acudiente = urldecode($_POST["telefono_acudiente"]);
            @$parentesco_acudiente = urldecode($_POST["parentesco_acudiente"]);
            @$eps = urldecode($_POST["eps"]);

            @$tipo_inscripcion = $_POST["tipo_inscripcion"];
            @$fecha_inscripcion = $_POST["fecha_inscripcion"];
            @$ultimo_estudio = urldecode($_POST["ultimo_estudio"]);
            @$institucion_estudio = urldecode($_POST["institucion_estudio"]);
            @$programa_incad = urldecode($_POST["programa_incad"]);
            @$jornada_incad = urldecode($_POST["jornada_incad"]);
            @$valor_programa = $_POST["valor_programa"];
            @$descuento = $_POST["descuento"];
            @$valor_neto_pagar = $_POST["valor_neto_pagar"];
            @$array_forma_pago = $_POST["array_forma_pago"];

            if($_POST["entidad_financiera"] == ""){
                @$entidad_financiera = urldecode($_POST["entidad_financiera"]);
            }else{
                @$entidad_financiera = "NULL";
            }

            if($_POST["cuota_inicial"] == ""){@$cuota_inicial = 0;}else{@$cuota_inicial = $_POST["cuota_inicial"];}
            if($_POST["valor_financiar"] == ""){@$valor_financiar = 0;}else{@$valor_financiar = $_POST["valor_financiar"];}                
            if($_POST["num_cuotas"] == ""){@$num_cuotas = 0;}else{@$num_cuotas = $_POST["num_cuotas"];}                
            if($_POST["valor_cuota"] == ""){@$valor_cuota = 0;}else{@$valor_cuota = $_POST["valor_cuota"];}
            if($_POST["fecha_mensula_pago"] == ""){@$fecha_mensula_pago = '00/00/0000';}else{@$fecha_mensula_pago = $_POST["fecha_mensula_pago"];}

            @$array_conoce_incad = $_POST["array_conoce_incad"];
            @$referido_por = urldecode($_POST["referido_por"]);

            @$hdd_id_persona = $_POST["hdd_id_persona"];
            @$hdd_id_academica = 0;

            $resultado = $dbRegistroPersonas->AddRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $array_forma_pago, $entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $id_usuario_crea, $hdd_id_persona, $hdd_id_academica);
		
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
    break;

	
	
	
	
	
}

?>