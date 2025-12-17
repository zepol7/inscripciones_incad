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


require_once("../funciones/Class_FirmarDocumentos.php");

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();

$dbUsuariosPefiles = new DbUsuariosPerfiles();

$dbUsuarios = new DbUsuarios();

$combo = new Combo_Box();

$FirmarDocumentos = new ClassFirmarDocumentos();


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

$contenido->validar_seguridad(0);


function dividir_nombre($nombre_completo){
    // Dividir por espacios y eliminar vacíos
    $partes = array_values(array_filter(explode(" ", trim($nombre_completo))));
    // Contar cuántas palabras hay
    $cantidad = count($partes);
    $nombre = "";
    $apellido = "";

    switch ($cantidad) {
        case 2:
            // Ej: JUAN PEREZ
            $nombre = $partes[0];
            $apellido = $partes[1];
            break;

        case 3:
            // Ej: LISBET ANGELICA RIAÑO → primer nombre y segundo nombre
            $nombre = $partes[0] . " " . $partes[1];
            $apellido = $partes[2];
            break;

        case 4:
            // Ej: JUAN CARLOS PEREZ GOMEZ → dos nombres y dos apellidos
            $nombre = $partes[0] . " " . $partes[1];
            $apellido = $partes[2] . " " . $partes[3];
            break;

        default:
            // Si hay más de 4 o menos de 2 palabras, se maneja por defecto
            $nombre = $partes[0];
            $apellido = implode(" ", array_slice($partes, 1));
            break;
    }
    return [
        "nombre" => $nombre,
        "apellido" => $apellido
    ];
}


function obtener_nombre_archivo($tipo, $id){

    switch ($tipo) {
        case "1": //Imprimir Inscripcion
            $nombre_archivo='Inscripcion_'.$id.".pdf";
        break;
        case "2": //Imprimir Tratamiento datos personales
            $nombre_archivo='Autorizacion_DP_'.$id.".pdf";
        break;
        case "3": //Imprimir Contrato de suministro
            $nombre_archivo='Contrato_Suministro_'.$id.".pdf";
        break;
        case "4": //Imprimir Credito INCAD
            $nombre_archivo='Credito_INCAD_'.$id.".pdf";
        break;
        case "5": //Imprimir Centrales de Riesgo
            $nombre_archivo='Centrales_Riesgo_'.$id.".pdf";
        break;
        case "6": //Imprimir Pagare y Carta
            $nombre_archivo='Pagare_Carta_'.$id.".pdf";
        break;
        case "7": //Imprimir Carta Compromiso
            $nombre_archivo='Carta_Compromiso_'.$id.".pdf";
        break;
        case "8": //Imprimir Carta Compromiso
            $nombre_archivo='Carta_Bienvenida_'.$id.".pdf";
        break;
        case "9": //Imprimir Contrato de suministro - bachiller
            $nombre_archivo='Contrato_Suministro_Bachiller_1_'.$id.".pdf";
        break;    
        case "10": //Imprimir Contrato de suministro - bachiller
            $nombre_archivo='Contrato_Suministro_Bachiller_2_'.$id.".pdf";
        break;
    }

    return $nombre_archivo;



}




switch ($opcion) {
    
    case "1": 
		
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
                                
                            </tr>
                            <tr>    
                                <td colspan='7'  align="center">
                                    
                                <div class="row" style="display: <?php echo($reg_visible);?>; ">

                                    <div class="col-md-2 form-group">  </div>
                                    <div class="col-md-4 form-group" style="text-align: left;">
                                    <ul>
                                        <li>
                                        <label for="">
                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="1">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=1" target="_blank"  >
                                            Inscripci&oacute;n y Tratamiento de Datos
                                            </a>
                                            </label>                                            
                                        </label>
                                        </li>

                                        <li>
                                        <label for="">
                                            
                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="3">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=3" target="_blank"  >
                                            Contrato Suministro - T&Eacute;CNICOS
                                            </a>
                                            </label>
                                        
                                            
                                        </label>
                                        </li>

                                        <li>
                                        <label for="">
                                            

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="9">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=9" target="_blank"  >
                                            Contrato Suministro - BACHILLER
                                            </a>
                                            </label>

                                        </label>
                                        </li>

                                        <li>
                                        <label for="">
                                            

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="7">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=7" target="_blank"  >
                                            Carta Compromiso
                                            </a>
                                            </label>



                                        </label>
                                        </li>

                                        <li>
                                        <label for="">                                            

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="8">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=8" target="_blank"  >
                                            Carta Bienvenida
                                            </a>
                                            </label>

                                        </label>
                                        </li>

                                        <li>
                                        <label for="">                                            

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="5">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=5&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            Centrales de Riesgo
                                            </a>
                                            </label>

                                        </label>
                                        </li>

                                        <li>
                                        <label for="">

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="4">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=4&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            Credito INCAD
                                            </a>
                                            </label>

                                        </label>
                                        </li>

                                        <li>
                                        <label for="">

                                            <label class="form-check-label" for="">
                                            <input style="width: 16px; height: 16px;" type="checkbox" class="form-check-input" name="check_archivo_pdf" id="check_archivo_pdf_<?php echo $id_academica; ?>" value="6">
                                            <a href="pdf.php?id_registro=<?php echo($id_academica);?>&tipo=6&id_credito=<?php echo($id_credito);?>" target="_blank"  >
                                            Pagare y Carta
                                            </a>
                                            </label>

                                        </label>
                                        </li>
                                        
                                    </ul>
                                    </div>

                                    <div class="col-md-4">
                                        
                                        <button id="contenedor_boton_<?php echo($id_academica);?>" type="button" class="btn-lg btn-primary" onclick="firmar_documentos(<?php echo($id_academica);?>);">Firmar los documentos seleccionados</button>
                                        <img id="contenedor_cargando_<?php echo($id_academica);?>" src="https://i.gifer.com/ZZ5H.gif" alt="Cargando..."
                                                style="display:none; width:70px; height:70px;">
                                    </div>
                                </div>
                                </td>
                            </tr> 

                            <tr>    
                                <td colspan='7'  align="center">
                                    <div id="panel_firma_<?php echo($id_academica);?>"></div>
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
                    else{
                    ?>
                    <table class="table table-bordered">
                    <tr>    
                        <td colspan='10'  align="center">    
                            <button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="llamar_nueva_inscripcion('<?php echo($id_persona);?>');">Nueva Inscripci&oacute;n</button>                            
                        </td>
                    </tr>        
                    </table>
                    <?php   
                    }
                    
                }
                else{
                    
                   
                    
                    
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


    case "2": 

        $id_academica = $_POST["id_academica"];        
        $documentos_json = $_POST["documentos"];
        $documentos = json_decode($documentos_json, true);


        //Datos persona
        $tabla_registro = $dbRegistroPersonas->getRegistroPersona($id_academica);
        $id_persona = $tabla_registro['id_persona'];
        $documento_persona = $tabla_registro['documento_persona'];        
        $nombre_persona = $tabla_registro['nombre_persona'];
        $apellido_persona = $tabla_registro['apellido_persona'];
        $id_promotor = $tabla_registro['id_promotor'];
        $tel_movil_persona = $tabla_registro['tel_movil_persona'];
        $email_persona = $tabla_registro['email_persona'];
        $direccion_casa = $tabla_registro['direccion_casa'];
        $fecha_nacimiento = $tabla_registro['format_fecha_nacimiento'];
        $fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];

        //Edad Persona
        $tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $fecha_inscripcion);
        $edad_anios = $tabla_edad_persona['anios'];

        // Contacto
        $nombre_completo_contacto_1 = $tabla_registro['nombre_contacto_1'];
        $telefono_contacto_1 = $tabla_registro['telefono_contacto_1'];
        $resultado_dividir_nombre = dividir_nombre($nombre_completo_contacto_1);

        $nombre_contacto_1 = $resultado_dividir_nombre['nombre'];
        $apellido_contacto_1 = $resultado_dividir_nombre['apellido'];     



        //Dator promotor
        $tabla_promotor = $dbUsuarios->getUsuario($id_promotor);
        $nombre_promotor = $tabla_promotor['nombre_usuario'];
        $apellido_promotor = $tabla_promotor['apellido_usuario'];
        $email_usuario_promotor = $tabla_promotor['email_usuario'];
        $numero_documento_promotor = $tabla_promotor['numero_documento'];
        $direccion_incad = Configuracion::$DIRECCION_INCAD;
        $telefono_incad = Configuracion::$TELEFONO_INCAD;


        //Secretaria Academica
        $tabla_academica = $dbUsuarios->getUsuarioPerfil(10);
        $nombre_academica = $tabla_academica['nombre_usuario'];
        $apellido_academica = $tabla_academica['apellido_usuario'];
        $email_usuario_academica = $tabla_academica['email_usuario'];
        $numero_documento_academica = $tabla_academica['numero_documento'];
        

        //Rectoria
        $tabla_rectoria = $dbUsuarios->getUsuarioPerfil(7);
        $nombre_rectoria = $tabla_rectoria['nombre_usuario'];
        $apellido_rectoria = $tabla_rectoria['apellido_usuario'];
        $email_usuario_rectoria = $tabla_rectoria['email_usuario'];
        $numero_documento_rectoria = $tabla_rectoria['numero_documento'];       
        
        $firmantes = [
                    [
                        "Nombre" => $nombre_persona,
                        "Apellido" => $apellido_persona,
                        "Nip" => $documento_persona,
                        "Telefono" => $tel_movil_persona,
                        "Indicativo" => null,
                        "Correo" => $email_persona,
                        "Direccion" => $direccion_casa,
                        "InfoAdicional" => "1",
                        "Medios" => [[
                            "CodMedio" => 4,
                            "Descripcion" => "WebApp",
                            "MediosFirmado" => [1, 3]
                        ]],
                        "VerificacionDobleFactor" => 0
                    ],
                    [
                        "Nombre" => $nombre_contacto_1,
                        "Apellido" => $apellido_contacto_1,
                        "Nip" => $documento_persona,
                        "Telefono" => $tel_movil_persona,
                        "Indicativo" => null,
                        "Correo" => $email_persona,
                        "Direccion" => $direccion_casa,
                        "InfoAdicional" => "1",
                        "Medios" => [[
                            "CodMedio" => 4,
                            "Descripcion" => "WebApp",
                            "MediosFirmado" => [1, 3]
                        ]],
                        "VerificacionDobleFactor" => 0
                    ],
                    [
                        "Nombre" => $nombre_promotor,
                        "Apellido" => $apellido_promotor,
                        "Nip" => $numero_documento_promotor,
                        "Telefono" => $telefono_incad,
                        "Indicativo" => null,
                        "Correo" => $email_usuario_promotor,
                        "Direccion" => $direccion_incad,
                        "InfoAdicional" => "1",
                        "Medios" => [[
                            "CodMedio" => 4,
                            "Descripcion" => "WebApp",
                            "MediosFirmado" => [1, 3]
                        ]],
                        "VerificacionDobleFactor" => 0
                    ],
                    [
                        "Nombre" => $nombre_academica,
                        "Apellido" => $apellido_academica,
                        "Nip" => $numero_documento_academica,
                        "Telefono" => $telefono_incad,
                        "Indicativo" => null,
                        "Correo" => $email_usuario_academica,
                        "Direccion" => $direccion_incad,
                        "InfoAdicional" =>  "1",
                        "Medios" => [[
                            "CodMedio" => 4,
                            "Descripcion" => "WebApp",
                            "MediosFirmado" => [1, 3]
                        ]],
                        "VerificacionDobleFactor" => 0
                    ],
                    
                    
                    [
                        "Nombre" => $nombre_rectoria,
                        "Apellido" => $apellido_rectoria,
                        "Nip" => $numero_documento_rectoria,
                        "Telefono" => $telefono_incad,
                        "Indicativo" => null,
                        "Correo" => $email_usuario_rectoria,
                        "Direccion" => $direccion_incad,
                        "InfoAdicional" =>  "1",
                        "Medios" => [[
                            "CodMedio" => 4,
                            "Descripcion" => "WebApp",
                            "MediosFirmado" => [1, 3]
                        ]],
                        "VerificacionDobleFactor" => 0
                    ]
            ];
        
        //$jsonFirmantes = json_encode(["Firmantes" => $firmantes], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //echo $jsonFirmantes;        

        #print_r($documentos);
        $id_suscriptor = Configuracion::$FIRMA_ID_SUSCRIPTOR;
        $id_secreto = Configuracion::$FIRMA_SECRETO_COMPARTIDO;
        
        $val_reto = $FirmarDocumentos->ObtenerRtResult($id_suscriptor);
        
        $resultado = [];
        $conteo = -1;
        
        foreach ($documentos as $doc) {
            $tipo = $doc['tipo'];
            $nombre_archivo = obtener_nombre_archivo($tipo, $id_academica);
            $archivo64 = $doc['archivo_64'];
            //$archivo64 = substr($archivo64, 0, 50);
            //echo "Tipo: $tipo <br>";
            //echo "Base64 (primeros 50 chars): " . substr($archivo64, 0, 50) . "<br><br>";
            //echo $nombre_archivo."<br />";

             $resultado[] = [
                'Archivo' => $archivo64,
                'IdPlantilla' => $conteo,
                'Descripcion' => $nombre_archivo
            ];
            $conteo--;
        }
        $documentos_json = $resultado;

        //$json_final = json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //echo $json_final;       


        // ============================================================
        // Construir JSON principal
        // ============================================================
        // Obtener IP (prioridad: cliente → proxy → servidor)
        $ip = $_SERVER['REMOTE_ADDR'] ?? '::1';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        }

        // Fecha actual formateada
        $fechaInicio = date("Y/m/d H:i:s");
        // Crear estructura principal
        $json_final  = [
            "FechaInicio" => $fechaInicio,
            "IpEstacion" => $ip,
            "IdIntegracionEmpresa" => "INCAD",
            "IdSuscriptor" => 101,
            "Usuario" => "jcrueda@incad.edu.co",
            "VerificarMedio" => false,
            "Descripcion" => "Firma de documento(s) - ".$documento_persona,
            "Documentos" => $documentos_json,
            "Firmantes" => $firmantes
        ];

        // 🔹 Serializamos el JSON (sin espacios ni saltos de línea)
        $json_serializado = json_encode($json_final, JSON_UNESCAPED_UNICODE);        


        // 🔹 Concatenamos en el orden indicado
        $cadena = $val_reto . $json_serializado . '101' . $id_secreto;

        // 🔹 Generamos el hash SHA256 y lo convertimos a Base64
        $hash_sha256_base64 = base64_encode(hash('sha256', $cadena, true));

        ///
        $respuesta_firmado = $FirmarDocumentos->AgregarPeticion($val_reto, $json_serializado, $hash_sha256_base64);
        
        // Mostrar el resultado (ya sin XML, solo el contenido del CDATA)
        echo "<pre>Respuesta:\n" . htmlspecialchars($respuesta_firmado) . "</pre>";
        
        



    break;
	
	
}

?>