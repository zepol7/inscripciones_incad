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

require_once("../funciones/Class_Generar_Clave.php");
require_once("../funciones/Class_Envio_Correo.php");


$dbRegistroPersonas = new DbRegistroPersonas();
$dbChequeo = new DbChequeo();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();

$envio_correo = new Class_Envio_Correo();

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
        
        if (isset($_POST["hdd_numero_menu"])) {
           $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
        }
        
        
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
        //$tabla_registro = $dbRegistroPersonas->getPersona($txt_busca_id);
        
        
        if (isset($_POST['id_persona'])) {           
            
            $tipo_accion = 2; //Editar Registro
            $id_persona = $_POST["id_persona"];	
            
            $tabla_registro = $dbRegistroPersonas->getPersonaID($_POST['id_persona']);
			       
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
            
            
            
        }
        else{
            $txt_busca_id = $_POST["documento_cargar"];	
        }
        
        
        
        
        
        ?>

        <input type="hidden"  id="hdd_id_persona" nombre="hdd_id_persona" value="<?php echo($id_persona);?>" />
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
                        <input type="text" class="form-control" name="documento_persona" id="documento_persona" placeholder="Documento" value="<?php echo $documento_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        <div id='div_persona_buscar'></div>	
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" name="email_persona" id="email_persona" placeholder="you@example.com" value="<?php echo $email_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    
                </div>                                
            </div>
        </div>



        <div class="panel panel-primary">
        <div class="panel-body">
        <div class="centrar">
            
            <input type="hidden"  id="hdd_tipo_acceso_menu" nombre="hdd_tipo_acceso_menu" value="<?php echo $tipo_acceso_menu; ?>" />
            <input type="hidden"  id="hdd_idmenus" nombre="hdd_idmenus" value="" />
            
            <?php
            if($tipo_accion==1){
            ?>
            <button type="button" class="btn btn-success" id="btn_registro_virtual" nombre="btn_registro_virtual" onclick="validar_crear_editar_reg_virtual(<?php echo($tipo_accion);?>, 1)">Guardar Registro Virtual</button>
            <?php    
            }else if($tipo_accion==2){
            ?>
            <button type="button" class="btn btn-success" id="btn_registro_virtual" nombre="btn_registro_virtual" onclick="validar_crear_editar_reg_virtual(<?php echo($tipo_accion);?>, 1)">Guardar Registro Virtual y Enviar Correo</button>    
            <button type="button" class="btn btn-success" id="btn_registro_virtual" nombre="btn_registro_virtual" onclick="validar_crear_editar_reg_virtual(<?php echo($tipo_accion);?>, 0)">Guardar Registro Virtual</button>    
            <?php    
            }
            ?>
            
            
            
            
            <!-- <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button> -->
            
        </div>
        </div>
        </div> 





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
                            <tr><th colspan='7' style="text-align: center;">Datos Personales</th></tr>
                            <tr>
                                <th style="width:5%;text-align:center;">Documento</th>
                                <th style="width:20%;text-align:center;">Nombre Completo</th>
                                <th style="width:10%;text-align:center;">Telefonos</th>
                                <th style="width:10%;text-align:center;">E-mail</th>
                                <th style="width:20%;text-align:center;">Link de Acceso</th>
                                <th style="width:10%;text-align:center;">Ciudad</th>
                                <th style="width:10%;text-align:center;">Opciones</th>
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
                            @$clave_verificacion = $tabla_registro[0]['clave_verificacion'];
                            
                            //$tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $format_fecha_inscripcion);
                            
                            $clave_encriptada = sha1($documento_persona."|".$clave_verificacion);
                            $url_inscripcion = "https://incad.edu.co/inscripciones/registro_virtual/index.php?usr=".$clave_encriptada;
                            
                            ?>
                            <tr>    
                                <td align="left"><?php echo $documento_persona; ?></td>
                                <td align="left"><?php echo $nombre_completo; ?></td>
                                <td align="left"><?php echo $tel_casa_persona." ".$tel_movil_persona; ?></td>
                                <td align="left"><?php echo $email_persona; ?></td>                            
                                <td align="center">
                                    <div class="alert alert-info" id="url_<?php echo($id_persona);?>"><?php echo $url_inscripcion; ?></div>  
                                    <button onclick="copyToClipboard('url_<?php echo($id_persona);?>')">Copiar Link</button>
                                    
                                </td>
                                <td align="left"><?php echo $ciudad_residencia; ?></td>
                                <td style="cursor:pointer;" onclick="form_editar_registro(<?php echo($id_persona); ?>);" align="center"><b> <a href="#">Editar Registro </a> </b></td>
                            </tr>
                            <?php
                                
                            
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="7">No se encontraron datos<br />Crear registro para Inscripci&oacute;n Virtual - Documento: <b><?php echo($txt_busca_id);?></b> </td>
                            </tr>
                            
                            <tr>
                                <td align="center" colspan="7"> 
                                
                                <button type="button" id="btn_crear_usuario" class="btn-lg btn-primary" onclick="llamar_crear_registro_virtual();">Crear Inscripci&oacute;n Virtual</button>
                                
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
                            <tr><th colspan='7' style="text-align: center;">Inscripciones</th></tr>
                            <tr>
                                <th style="width:5%;text-align:center;">Tipo de Inscripci&oacute;n</th>
                                <th style="width:5%;text-align:center;">Fecha de Inscripci&oacute;n</th>
                                <th style="width:10%;text-align:center;">Programa</th>
                                <th style="width:10%;text-align:center;">Jornada</th>                                
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
        @$tipo_documento = $_POST["tipo_documento"];
        @$documento_persona = $_POST["documento_persona"];        
        @$nombre_persona = urldecode($_POST["nombre_persona"]);
        @$apellido_persona = urldecode($_POST["apellido_persona"]);        
        @$email_persona = urldecode($_POST["email_persona"]);
        
        
        /*Para generar clave del paciente*/
        $clave_paciente = new Class_Generar_Clave();
        $InitalizationKey = $clave_paciente->generate_secret_key(16);
        $TimeStamp = $clave_paciente->get_timestamp();
        $secretkey = $clave_paciente->base32_decode($InitalizationKey);
        $clave_verificacion = $clave_paciente->oath_hotp($secretkey, $TimeStamp);
        
        

        $resultado = $dbRegistroPersonas->InsertRegistroVirtualPersona($tipo_documento, $documento_persona, $nombre_persona, $apellido_persona, $email_persona, $clave_verificacion, $id_usuario_crea);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        
        <?php
    break;	
	
	
    case "6"://
        
        @$id_registro = $utilidades->str_decode($_POST["id_registro"]);

        $tabla_persona = $dbRegistroPersonas->getPersonaID($id_registro);
        

        $nombre_completo = $tabla_persona['nombre_persona']." ".$tabla_persona['apellido_persona'];
        $email = $tabla_persona['email_persona'];
        $usuario = $tabla_persona['documento_persona'];
        $clave = $tabla_persona['clave_verificacion'];


        //Se lee el archivo con el formato de correo
        $cuerpo = "";
        $archivo_aux = fopen("./formato_correo_cita.html", "r");

        while (!feof($archivo_aux)) {
                $linea_aux = fgets($archivo_aux);
                echo($linea_aux."<br>");

                $cuerpo .= $linea_aux;
        }
        fclose($archivo_aux);

        //Se reemplazan las etiquetas con los valores respectivos de la cita
        
        $clave_encriptada = sha1($usuario."|".$clave);
        $url_inscripcion = "https://incad.edu.co/inscripciones/registro_virtual/index.php?usr=".$clave_encriptada;
        
        $cuerpo = str_replace("|*NOMBRE_COMPLETO*|", $nombre_completo, $cuerpo);
        //$cuerpo = str_replace("|*USUARIO_PERSONA*|", $usuario, $cuerpo);
        //$cuerpo = str_replace("|*CLAVE_PERSONA*|", $clave, $cuerpo);
        
        $cuerpo = str_replace("|*URL_REGISTRO_INSCRIPCION*|", $url_inscripcion, $cuerpo);
        
        //URL_REGISTRO_INSCRIPCION
        

        //Se construyen los componentes del correo
        $asunto = "Acceso Plataforma INCAD";

        $lista_destinos = array();
        $lista_destinos[0]["nombre"] = $nombre_completo;
        $lista_destinos[0]["email"] = $email;

        //Se hace el envio del correo
        $resultado = $envio_correo->enviar_correo($asunto, $lista_destinos, $cuerpo);
        ?>
        <input type="hidden" id="hdd_resultado_correo" name="hdd_resultado_correo" value="<?= $resultado ?>"/>
        <?php
    break;	
	
	
    case "7"://
        $id_usuario_crea = $_SESSION["idUsuario"];				
        @$tipo_documento = $_POST["tipo_documento"];
        @$documento_persona = $_POST["documento_persona"];        
        @$nombre_persona = urldecode($_POST["nombre_persona"]);
        @$apellido_persona = urldecode($_POST["apellido_persona"]);        
        @$email_persona = urldecode($_POST["email_persona"]);
        @$hdd_id_persona = urldecode($_POST["hdd_id_persona"]);
        @$band_email = urldecode($_POST["band_email"]);
        
        
        /*Para generar clave del paciente*/
        $clave_paciente = new Class_Generar_Clave();
        $InitalizationKey = $clave_paciente->generate_secret_key(16);
        $TimeStamp = $clave_paciente->get_timestamp();
        $secretkey = $clave_paciente->base32_decode($InitalizationKey);
        $clave_verificacion = $clave_paciente->oath_hotp($secretkey, $TimeStamp);
        
        

        $resultado = $dbRegistroPersonas->EditarRegistroVirtualPersona($tipo_documento, $documento_persona, $nombre_persona, $apellido_persona, $email_persona, $clave_verificacion, $hdd_id_persona, $band_email, $id_usuario_crea);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        
        <?php
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