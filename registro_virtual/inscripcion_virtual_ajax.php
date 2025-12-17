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
require_once("../db/DbUsuariosPerfiles.php");
require_once("../db/DbUsuarios.php");
require_once("../funciones/Class_Envio_Correo.php");

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();


$envio_correo = new Class_Envio_Correo();

$dbUsuariosPefiles = new DbUsuariosPerfiles();

$dbUsuarios = new DbUsuarios();

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
    case "1": //Crear Registro
       
                $combo = new Combo_Box();
		
		$tipo_accion = 1; //Crear Registro
		
		$id_persona = '';
                $tipo_documento = '';
                $documento_persona = '';
                $lugar_documento = '';
                $fecha_documento = '';
                $nombre_persona = '';
                $apellido_persona = '';
                $fecha_nacimiento = '';
                $lugar_nacimiento = '';
                $tipo_sangre = '';
                $tel_casa_persona = '';
                $tel_movil_persona = '';
                $email_persona = '';
                $estado_civil = '';
                $direccion_casa = '';
                $ciudad_residencia = '';
                $barrio_residencia = '';
                $nombre_contacto_1 = '';
                $telefono_contacto_1 = '';
                $parentesco_contacto_1 = '';
                $nombre_contacto_2 = '';
                $telefono_contacto_2 = '';
                $parentesco_contacto_2 = '';
                $nombre_contacto_3 = '';
                $telefono_contacto_3 = '';
                $parentesco_contacto_3 = '';
                $nombre_acudiente = '';
                $telefono_acudiente = '';
                $parentesco_acudiente = '';
                $eps = '';
                $estrato_persona = '';
                $sexo = '';
		
		$id_academica = '';
                $tipo_inscripcion = '';
                $fecha_inscripcion = '';
                $ultimo_estudio = '';
                $institucion_estudio = '';
                $programa_incad = '';
                $id_programa = '';
                
                $jornada_incad = '';
                $valor_programa = '';
                $descuento = '';
                $valor_neto_pagar = '';
                
                $forma_pago = '';
                $registro_formas_pago = array();
                $entidad_financiera = '';
                $credito_incad = '';
                $cuota_inicial = '';
                $valor_financiar = '';
                $num_cuotas = '';
                $valor_cuota = '';
                $fecha_mensula_pago = '';
                $registro_incad_conoce  = array();
                $incad_redes = '';
                $incad_fachada = '';
                $incad_volantes = '';
                $incad_radio = '';
                $referido_por = '';
                $programa_tecnico = '';
                $practica_laboral = '';
                
                $unidad_negocio = '';
                $calendario_academico = '';
                $jornada = '';
                $id_promotor = '';
                $periodicidad_pago = '';
                $estado_matriculado = '';
                
                $id_ultimo_estudio = '';
                $id_forma_pago = '';
                $id_entidad_financiera = '';
                
                
		
		
		if (isset($_POST['num_documento_nuevo'])) {
                    $documento_persona = $_POST['num_documento_nuevo'];
		}
		
		     
        $titulo_formulario = $lang["r_titulo_crear"];
        
		
        if (isset($_POST['id_registro'])) {
                $tipo_accion = 2; //Editar Inscripcion				
                 
                //Busca por el registro medico de la seleccionada
                $tabla_registro = $dbRegistroPersonas->getPersonaID($_POST['id_registro']);

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

                $id_estado_inscripcion = '';

                $titulo_formulario = $lang["r_titulo_editar"];        
                        
        }
        
        
    
    
    ?>
    	<input type="hidden" value="<?php echo $id_persona; ?>" name="hdd_id_persona" id="hdd_id_persona" />
    	<!--<input type="hidden" value="<?php echo $id_academica; ?>" name="hdd_id_academica" id="hdd_id_academica" />-->
    	
 			
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
                        <input type="text" class="form-control" disabled name="documento_persona" id="documento_persona" placeholder="Documento" value="<?php echo $documento_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
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
            <div class="panel-heading"><b>PERSONAS DE CONTACTO</b></div>
            <div class="panel-body">
                
                <div class="row">                	
                    <div class="col-md-6 form-group">
                        <label for="">Nombre 1*</label>
                        <input type="text" class="form-control" name="nombre_contacto_1" id="nombre_contacto_1" placeholder="Nombre" value="<?php echo $nombre_contacto_1; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); duplicar_en('nombre_contacto_1', 'nombre_acudiente');">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono 1 *</label>
                        <input type="text" class="form-control" name="telefono_contacto_1" id="telefono_contacto_1" placeholder="Tel&eacute;fono" value="<?php echo $telefono_contacto_1; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); duplicar_en('telefono_contacto_1', 'telefono_acudiente'); ">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Parentesco 1 *</label>
                        <input type="text" class="form-control" name="parentesco_contacto_1" id="parentesco_contacto_1" placeholder="Parentesco" value="<?php echo $parentesco_contacto_1; ?>" onblur="trim_cadena(this); convertirAMayusculas(this); duplicar_en('parentesco_contacto_1', 'parentesco_acudiente'); ">
                    </div>	                	
                </div>
                
                <div class="row">                	
                    <div class="col-md-6 form-group">
                        <label for="">Nombre 2</label>
                        <input type="text" class="form-control" name="nombre_contacto_2" id="nombre_contacto_2" placeholder="Nombre" value="<?php echo $nombre_contacto_2; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono 2 </label>
                        <input type="text" class="form-control" name="telefono_contacto_2" id="telefono_contacto_2" placeholder="Tel&eacute;fono" value="<?php echo $telefono_contacto_2; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Parentesco 2 </label>
                        <input type="text" class="form-control" name="parentesco_contacto_2" id="parentesco_contacto_2" placeholder="Parentesco" value="<?php echo $parentesco_contacto_2; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>	                	
                </div>
                
                <div class="row">                	
                    <div class="col-md-6 form-group">
                        <label for="">Nombre 3</label>
                        <input type="text" class="form-control" name="nombre_contacto_3" id="nombre_contacto_3" placeholder="Nombre" value="<?php echo $nombre_contacto_3; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono 3 </label>
                        <input type="text" class="form-control" name="telefono_contacto_3" id="telefono_contacto_3" placeholder="Tel&eacute;fono" value="<?php echo $telefono_contacto_3; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Parentesco 3</label>
                        <input type="text" class="form-control" name="parentesco_contacto_3" id="parentesco_contacto_3" placeholder="Parentesco" value="<?php echo $parentesco_contacto_3; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>	                	
                </div>
                
                <div class="row">                	
                    <div class="col-md-6 form-group">
                        <label for="">Acudiente *</label>
                        <input type="text" class="form-control" name="nombre_acudiente" id="nombre_acudiente" placeholder="Nombre" value="<?php echo $nombre_acudiente; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel&eacute;fono *</label>
                        <input type="text" class="form-control" name="telefono_acudiente" id="telefono_acudiente" placeholder="Tel&eacute;fono" value="<?php echo $telefono_acudiente; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Parentesco *</label>
                        <input type="text" class="form-control" name="parentesco_acudiente" id="parentesco_acudiente" placeholder="Parentesco" value="<?php echo $parentesco_acudiente; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
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
                    <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_editar_personas(2);">Guardar Datos</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

                <?php
            } 
            
            /*else if ($tipo_accion == 3) {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!--<input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_editar_personas(3);">Guardar Datos</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

                <?php
            }
            else {
                ?>
                    <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
                    <!-- <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="<?php echo $ids_menus; ?>" /> -->
                    <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
                    <button type="button" class="btn btn-success" id="btn_crear_registro" nombre="btn_crear_registro" onclick="validar_crear_editar_personas(1);">Guardar Nuevo</button>
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>

                <?php
            }*/
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
		
		$tabla_perfiles_usuario = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
		$es_admin = false;		
		
		foreach($tabla_perfiles_usuario as $fila_perfiles){			
			if($fila_perfiles['id_perfil'] == 1){
				$es_admin = true;
				break;
			}			
		}
		
		
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
                            <tr>
                                <td align="center" colspan="7">
                                	<button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="llamar_crear_registro('<?php echo($txt_busca_id);?>');">Nuevo Registro</button>
                                </td>
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
                            <tr><th colspan='10' style="text-align: center;">Inscripciones</th></tr>
                            <tr>
                                <th style="width:10%;text-align:center;">Tipo de Inscripci&oacute;n</th>
                                <th style="width:5%;text-align:center;">Fecha de Inscripci&oacute;n</th>
                                <th style="width:10%;text-align:center;">Programa</th>
                                <th style="width:10%;text-align:center;">Jornada</th>
                                <th style="width:5%;text-align:center;">Valor</th>
                                <th style="width:5%;text-align:center;">Descuento</th>
                                <th style="width:5%;text-align:center;">Valor Neto</th>
                                <th colspan="3" style="width:10%;text-align:center;">Opciones</th>
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
                                <td align="left"><?php echo $valor_programa; ?></td>
                                <td align="left"><?php echo $descuento; ?></td>
                                <td align="left"><?php echo $valor_neto_pagar; ?></td>
                                
								<?php
                                if($estado_registro == 1){
                                ?>
								
									<td style="cursor:pointer;" onclick="llamar_editar_registro(<?php echo($id_academica);?>)" align="center"><b> <a href="#">Editar inscripci&oacute;n </a> </b></td>
                                                                        <td style="cursor:pointer;" onclick="llamar_credito_incad(<?php echo($id_credito);?>, <?php echo($id_academica);?>, <?php echo($id_persona);?>)" align="center"><b> <a href="#"><?php echo($ban_credito_incad);?> </a> </b></td>    
								
									<?php
                                                                        if($es_admin==true){
										?>
										<td style="cursor:pointer;" onclick="llamar_eliminar_registro(<?php echo($id_academica);?>)" align="center"><b> <a href="#" style="color:#FF4500;">Eliminar inscripci&oacute;n </a> </b></td>
										<?php		
									}
                                                                        
                                                                        /*
									if($credito_incad == 0 && $id_entidad_financiera == 68){                                                                            
                                                                                ?>
										<td style="cursor:pointer;" align="center"><b> <a href="#"><?php echo($ban_credito_incad);?> </a> 1111</b></td>
                                                                                <?php
									}
									else if($credito_incad > 0 || $id_entidad_financiera > 0){
                                                                                ?>
										<td style="cursor:pointer;" onclick="llamar_credito_incad(<?php echo($id_credito);?>, <?php echo($id_academica);?>, <?php echo($id_persona);?>)" align="center"><b> <a href="#"><?php echo($ban_credito_incad);?> </a> </b></td>
                                                                                <?php
									}
									 else if(($credito_incad > 0 || $id_entidad_financiera > 0) && $id_credito <= 0){
										?>
										<td style="cursor:pointer;" onclick="llamar_credito_incad(<?php echo($id_credito);?>, <?php echo($id_academica);?>, <?php echo($id_persona);?>)" align="center"><b> <a href="#"><?php echo($ban_credito_incad);?> </a> </b></td>
										<?php
									}
									if($es_admin==true){
										?>
										<td style="cursor:pointer;" onclick="llamar_eliminar_registro(<?php echo($id_academica);?>)" align="center"><b> <a href="#" style="color:#FF4500;">Eliminar inscripci&oacute;n </a> </b></td>
										<?php		
									}
                                                                                                                                                  */
									?>
								<?php
                                } else if($estado_registro == 0){
                                ?>	
									<td colspan="2" style="cursor:pointer;" align="center"><b> <a href="#" style="color:#FF4500;">Registro Eliminado </a> </b></td>
								<?php
									if($es_admin==true){
										?>
										<td style="cursor:pointer;" onclick="llamar_activar_registro(<?php echo($id_academica);?>)" align="center"><b> <a href="#" style="color:#006400;">Activar inscripci&oacute;n </a> </b></td>
										<?php		
									}
								
                                } 
                                ?>	
                                
                                
                            </tr>
                            <tr>    
                                <td colspan='10'  align="center">
                                    
                                    <div class="row" style="display: <?php echo($reg_visible);?>; ">
                                    
                                    <div class="col-md-2 form-group">                                            
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=1" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Inscripcion" height="42" width="42"><br />
                                            Inscripci&oacute;n y Tratamiento de Datos
                                            </a>
                                        </label>
                                        
                                    </div>
                                    
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=3" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Contrato suministro" height="42" width="42"><br />
                                            Contrato Suministro - T&Eacute;CNICOS
                                            </a>
                                        </label>
                                    </div>
									
									<div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=9" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Contrato suministro" height="42" width="42"><br />
                                            Contrato Suministro - BACHILLER
                                            </a>
                                        </label>
                                    </div>
									
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=5&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Cantrales riesgo" height="42" width="42"><br />
                                            Centrales de Riesgo
                                            </a>
                                        </label>
                                    </div>
                                        
                                    
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=7" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Carta Compromiso" height="42" width="42"><br />
                                            Carta Compromiso
                                            </a>
                                        </label>
                                    </div>  
                                        
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=8" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Carta Bienvenida" height="42" width="42"><br />
                                            Carta Bienvenida
                                            </a>
                                        </label>
                                    </div>                                             
                                        
                                    <?php
                                    //if($credito_incad > 0 ){
                                    ?>
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=4&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Credito INCAD" height="42" width="42"><br />
                                            Credito INCAD
                                            </a>
                                        </label>
                                    </div>
									
                                    <div class="col-md-2 form-group">
                                        <label for="">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=6&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            <img src="../imagenes/boton_imprimir_p.png" alt="Pagare Carta" height="42" width="42"><br />
                                            Pagare y Carta
                                            </a>
                                        </label>
                                    </div>
									
                                    <?php
                                    //}
                                    ?>    
                                        
                                </div>
                                    

                                    

                                </td>
                            </tr> 
                            
                            
                            <?php
                                
                            
                        }
                        }
                        ?>
                    <tr>    
                        <td colspan='10'  align="center">                            
                            <button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="llamar_nueva_inscripcion('<?php echo($id_persona);?>');">Nueva Inscripci&oacute;n</button>                            
                        </td>
                    </tr>        
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
	
	
	
	
	case "3": 
		
            @$txt_fecha_hoy = $_POST["txt_fecha_hoy"];
            @$txt_fecha_nacimiento = $_POST["txt_fecha_nacimiento"];        

            $tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($txt_fecha_nacimiento, $txt_fecha_hoy);

            if($tabla_edad_persona['anios']>0){
                    ?>
                <label class="custom-control-label"><?php echo($tabla_edad_persona['anios']); ?> A&ntilde;os</label>
                <?php	
            }
            else{
                    ?>
                <label class="custom-control-label"> -- </label>
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
                @$estrato_persona = urldecode($_POST["estrato_persona"]);                
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
                @$sexo = urldecode($_POST["sexo"]);

                @$tipo_inscripcion = $_POST["tipo_inscripcion"];
                @$fecha_inscripcion = $_POST["fecha_inscripcion"];
                @$id_ultimo_estudio = urldecode($_POST["id_ultimo_estudio"]);
                @$institucion_estudio = urldecode($_POST["institucion_estudio"]);
                @$programa_incad = urldecode($_POST["programa_incad"]);                
                @$id_programa = $_POST["id_programa"];                
                @$jornada_incad = urldecode($_POST["jornada_incad"]);
                @$valor_programa = $_POST["valor_programa"];
                @$descuento = $_POST["descuento"];
                @$valor_neto_pagar = $_POST["valor_neto_pagar"];
                
                @$id_forma_pago = $_POST["id_forma_pago"];
                @$id_entidad_financiera = $_POST["id_entidad_financiera"];
                
                /*@$array_forma_pago = $_POST["array_forma_pago"];                
                if($_POST["entidad_financiera"] == ""){
                    @$entidad_financiera = "NULL";
                }else{                    
                    @$entidad_financiera = urldecode($_POST["entidad_financiera"]);
                }*/
                
                if($_POST["cuota_inicial"] == ""){@$cuota_inicial = 0;}else{@$cuota_inicial = $_POST["cuota_inicial"];}
                if($_POST["valor_financiar"] == ""){@$valor_financiar = 0;}else{@$valor_financiar = $_POST["valor_financiar"];}                
                if($_POST["num_cuotas"] == ""){@$num_cuotas = 0;}else{@$num_cuotas = $_POST["num_cuotas"];}                
                if($_POST["valor_cuota"] == ""){@$valor_cuota = 0;}else{@$valor_cuota = $_POST["valor_cuota"];}
                if($_POST["fecha_mensula_pago"] == ""){@$fecha_mensula_pago = '00/00/0000';}else{@$fecha_mensula_pago = $_POST["fecha_mensula_pago"];}
                if($_POST["periodicidad_pago"] == ""){@$periodicidad_pago = 0;}else{@$periodicidad_pago = $_POST["periodicidad_pago"];}
				
				
                
                
                @$array_conoce_incad = $_POST["array_conoce_incad"];
                @$referido_por = urldecode($_POST["referido_por"]);
				
                @$programa_tecnico = urldecode($_POST["programa_tecnico"]);
                @$practica_laboral = urldecode($_POST["practica_laboral"]);
                
                @$unidad_negocio = urldecode($_POST["unidad_negocio"]);
                @$calendario_academico = urldecode($_POST["calendario_academico"]);
                @$jornada = urldecode($_POST["jornada"]);
                
                @$id_promotor = urldecode($_POST["id_promotor"]);                
                @$estado_matriculado = urldecode($_POST["estado_matriculado"]);
                
                
                $resultado = $dbRegistroPersonas->InsertRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        
        <?php
    break;	
	
	
    case "6": //
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
            @$estrato_persona = urldecode($_POST["estrato_persona"]);                
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
            @$sexo = urldecode($_POST["sexo"]);

            @$hdd_id_persona = $_POST["hdd_id_persona"];           

            $resultado = $dbRegistroPersonas->UpdateRegistroVirtualPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $estrato_persona, $sexo, $id_usuario_crea, $hdd_id_persona);
		
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
            @$estrato_persona = urldecode($_POST["estrato_persona"]);                
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
            @$sexo = urldecode($_POST["sexo"]);

            @$tipo_inscripcion = $_POST["tipo_inscripcion"];
            @$fecha_inscripcion = $_POST["fecha_inscripcion"];
            @$id_ultimo_estudio = urldecode($_POST["id_ultimo_estudio"]);
            @$institucion_estudio = urldecode($_POST["institucion_estudio"]);
            @$programa_incad = urldecode($_POST["programa_incad"]);
            @$id_programa = $_POST["id_programa"];
            @$jornada_incad = urldecode($_POST["jornada_incad"]);
            @$valor_programa = $_POST["valor_programa"];
            @$descuento = $_POST["descuento"];
            @$valor_neto_pagar = $_POST["valor_neto_pagar"];
            
            /*@$array_forma_pago = $_POST["array_forma_pago"];
            if($_POST["entidad_financiera"] == ""){
                @$entidad_financiera = "NULL";
            }else{                
                @$entidad_financiera = urldecode($_POST["entidad_financiera"]);
            }*/
            
            @$id_forma_pago = $_POST["id_forma_pago"];
            @$id_entidad_financiera = $_POST["id_entidad_financiera"];

            if($_POST["cuota_inicial"] == ""){@$cuota_inicial = 0;}else{@$cuota_inicial = $_POST["cuota_inicial"];}
            if($_POST["valor_financiar"] == ""){@$valor_financiar = 0;}else{@$valor_financiar = $_POST["valor_financiar"];}                
            if($_POST["num_cuotas"] == ""){@$num_cuotas = 0;}else{@$num_cuotas = $_POST["num_cuotas"];}                
            if($_POST["valor_cuota"] == ""){@$valor_cuota = 0;}else{@$valor_cuota = $_POST["valor_cuota"];}
            if($_POST["fecha_mensula_pago"] == ""){@$fecha_mensula_pago = '00/00/0000';}else{@$fecha_mensula_pago = $_POST["fecha_mensula_pago"];}
			if($_POST["periodicidad_pago"] == ""){@$periodicidad_pago = 0;}else{@$periodicidad_pago = $_POST["periodicidad_pago"];}

            @$array_conoce_incad = $_POST["array_conoce_incad"];
            @$referido_por = urldecode($_POST["referido_por"]);
            @$programa_tecnico = urldecode($_POST["programa_tecnico"]);
            @$practica_laboral = urldecode($_POST["practica_laboral"]);
            
            @$unidad_negocio = urldecode($_POST["unidad_negocio"]);
            @$calendario_academico = urldecode($_POST["calendario_academico"]);
            @$jornada = urldecode($_POST["jornada"]);
            
            @$id_promotor = urldecode($_POST["id_promotor"]);
            @$estado_matriculado = urldecode($_POST["estado_matriculado"]);

            @$hdd_id_persona = $_POST["hdd_id_persona"];
            @$hdd_id_academica = 0;

            $resultado = $dbRegistroPersonas->AddRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea, $hdd_id_persona, $hdd_id_academica);
		
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
    break;
	
	
	case "12": //
            $id_usuario_crea = $_SESSION["idUsuario"];

            @$id_registro = $_POST["id_registro"];
          

            $resultado = $dbRegistroPersonas->EliminarRegistro($id_registro);
		
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_eliminar_exito" id="hdd_eliminar_exito" />
        <?php
    break;
	
    case "13": //
            $id_usuario_crea = $_SESSION["idUsuario"];

            @$id_registro = $_POST["id_registro"];
          

            $resultado = $dbRegistroPersonas->ActivarRegistro($id_registro);
		
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_eliminar_exito" id="hdd_eliminar_exito" />
        <?php
    break;



    case "14": //
        
        @$id_registro = $utilidades->str_decode($_POST["id_registro"]);

        $tabla_persona = $dbRegistroPersonas->getPersonaID($id_registro);

        $nombre_completo = $tabla_persona['nombre_persona']." ".$tabla_persona['apellido_persona'];
        $email = $tabla_persona['email_persona'];
        $usuario = $tabla_persona['documento_persona'];
        $clave = $tabla_persona['clave_verificacion'];
        $id_usuario_crea = $tabla_persona['id_usuario_crea'];
        
        
        $tabla_usuarios = $dbUsuarios->getUsuario($id_usuario_crea);        
        $email_usuario = $tabla_usuarios['email_usuario'];
        $nombre_usuario = $tabla_usuarios['nombre_usuario'];
        $apellido_usuario = $tabla_usuarios['apellido_usuario'];
        $nombre_completo_usuario = $nombre_usuario." ".$apellido_usuario;
        
        if($email_usuario==""){
            $tabla_usuarios = $dbUsuarios->getUsuario(20);        
            $email_usuario = $tabla_usuarios['email_usuario'];
            $nombre_usuario = $tabla_usuarios['nombre_usuario'];
            $apellido_usuario = $tabla_usuarios['apellido_usuario'];
            $nombre_completo_usuario = $nombre_usuario." ".$apellido_usuario;
        }

        //Se lee el archivo con el formato de correo
        $cuerpo = "";
        $archivo_aux = fopen("./formato_correo_respuesta.html", "r");

        while (!feof($archivo_aux)) {
                $linea_aux = fgets($archivo_aux);
                echo($linea_aux."<br>");

                $cuerpo .= $linea_aux;
        }
        fclose($archivo_aux);

        //Se reemplazan las etiquetas con los valores respectivos de la cita
        $cuerpo = str_replace("|*NOMBRE_COMPLETO*|", $nombre_completo, $cuerpo);
        $cuerpo = str_replace("|*USUARIO_PERSONA*|", $usuario, $cuerpo);
        
        //Se construyen los componentes del correo
        $asunto = "Respuesta Pre-Inscripcion";
        
        $lista_destinos = array();
        $lista_destinos[0]["nombre"] = $nombre_completo_usuario;
        $lista_destinos[0]["email"] = $email_usuario;
        
        echo"111Acaaaaa <br />";
        
        echo $email_usuario;
        
        
        $resultado = $envio_correo->enviar_correo($asunto, $lista_destinos, $cuerpo);
        
        echo"Acaaaaa";
        
        ?>
        <input type="hidden" id="hdd_resultado_correo" name="hdd_resultado_correo" value="<?= $resultado ?>"/>
        <?php
    break;
    
    

	
	
	
	
	
}

?>