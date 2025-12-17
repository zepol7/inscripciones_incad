<link href="../css/estilos_1.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />  

<style type="text/css">

.tabla_info {
  border-top: black 1px solid;
  border-left: black 1px solid;
  border-right: black 1px solid;
  border-bottom: black 1px solid;  
  border-spacing: 2px;
  border-collapse: separate;   
  
}
.tabla_info td { 
    padding-bottom: 3px;
	padding-top: 3px;
	padding-right: 2px;
}

.td_info {
  
  border-bottom: black 1px solid;  
  border-collapse: separate;   
  
}

.td_color_red{
    color: #FF0000;    
}

.td_color_blue{
    color: #0000FF;    
}

.parrafo_titulo_1{
    font-family: Arial;
    font-size: 20px;    
    line-height: 100%;
    text-align: center;
    color: #0000FF;    
}

.parrafo_text_1{
    width: 50%;
    font-family: Arial;
    font-size: 20px;    
    line-height: 100%;
    text-align: justify;
}



</style>


<?php
require_once("../funciones/get_idioma.php");
require_once("../db/DbVariables.php");
require_once("../db/DbEquipos.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../db/DbRegistroPersonas.php");

require_once("../db/DbChequeo.php");

require_once("../db/DbFormatos.php");
$dbformatos = new DbFormatos();

$variables = new Dbvariables();
$equipos = new DbEquipo();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbPerfiles = new DbPerfiles();
$dbRegistroPersonas = new DbRegistroPersonas();

$dbChequeo = new DbChequeo();



//Datos fortamos
$tabla_formatos = $dbformatos->getFomato(8);
$nombre_formato = $tabla_formatos['nombre_formato'];
$codigo_formato = $tabla_formatos['codigo_formato'];
$version_formato = $tabla_formatos['version_formato'];
$fecha_formato = $tabla_formatos['format_fecha_formato'];


//Busca por el registro medico de la seleccionada
$tabla_registro = $dbRegistroPersonas->getRegistroPersona($_GET['id_registro']);
$id_persona = $tabla_registro['id_persona'];
$id_tipo_documento = $tabla_registro['tipo_documento'];
$detalle_tipo_doc = $dbListas->getDetalle($id_tipo_documento);

$tipo_documento = $tabla_registro['nom_tipo_documento'];
$documento_persona = $tabla_registro['documento_persona'];
$lugar_documento = $tabla_registro['lugar_documento'];
$fecha_documento = $tabla_registro['format_fecha_documento'];
$nombre_persona = $tabla_registro['nombre_persona'];
$apellido_persona = $tabla_registro['apellido_persona'];
$fecha_nacimiento = $tabla_registro['format_fecha_nacimiento'];
$lugar_nacimiento = $tabla_registro['lugar_nacimiento'];
$tipo_sangre = $tabla_registro['nom_tipo_sangre'];
$tel_casa_persona = $tabla_registro['tel_casa_persona'];
$tel_movil_persona = $tabla_registro['tel_movil_persona'];
$email_persona = $tabla_registro['email_persona'];
$estado_civil = $tabla_registro['nom_estado_civil'];
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
$estrato_persona = $tabla_registro['nom_estrato_persona'];
$nom_sexo = $tabla_registro['nom_sexo'];

$id_academica = $tabla_registro['id_academica'];
$tipo_inscripcion = $tabla_registro['nom_tipo_inscripcion'];
$fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];
$ultimo_estudio = $tabla_registro['ultimo_estudio'];
$nom_id_ultimo_estudio = $tabla_registro['nom_id_ultimo_estudio'];

if($ultimo_estudio==0){
    $ultimo_estudio = $nom_id_ultimo_estudio;
}

$institucion_estudio = $tabla_registro['institucion_estudio'];
$programa_incad = $tabla_registro['nom_id_programa'];
$jornada_incad = $tabla_registro['nom_jornada'];

$programa_tecnico = $tabla_registro['nom_programa_tecnico'];
$practica_laboral = $tabla_registro['nom_practica_laboral'];

$unidad_negocio = $tabla_registro['nom_unidad_negocio'];
$calendario_academico = $tabla_registro['nom_calendario_academico'];

$periodicidad_pago = $tabla_registro['nom_periodicidad_pago'];
$promotor = $tabla_registro['nom_promotor'];

$valor_programa = number_format($tabla_registro['valor_programa'], 0, '', '.'); 
$descuento = number_format($tabla_registro['descuento'], 0, '', '.'); 
$valor_neto_pagar = number_format($tabla_registro['valor_neto_pagar'], 0, '', '.'); 
$nom_forma_pago = $tabla_registro['nom_id_forma_pago'];
$registro_formas_pago = $dbRegistroPersonas->getListaFormasPago($id_academica);

$entidad_financiera = $tabla_registro['entidad_financiera'];
$nom_id_entidad_financiera = $tabla_registro['nom_id_entidad_financiera'];

if($entidad_financiera == "NULL" || $entidad_financiera == 0){
    $entidad_financiera=$nom_id_entidad_financiera;    
}

$cuota_inicial = number_format($tabla_registro['cuota_inicial'], 0, '', '.');
$valor_financiar = number_format($tabla_registro['valor_financiar'], 0, '', '.'); 
$num_cuotas = $tabla_registro['num_cuotas'];
$valor_cuota = number_format($tabla_registro['valor_cuota'], 0, '', '.'); 
$fecha_mensula_pago = $tabla_registro['fecha_mensula_pago'];

$registro_incad_conoce = $dbRegistroPersonas->getListaReferido($id_academica);
$incad_redes = $tabla_registro['incad_redes'];
$incad_fachada = $tabla_registro['incad_fachada'];
$incad_volantes = $tabla_registro['incad_volantes'];
$incad_radio = $tabla_registro['incad_radio'];
$referido_por = $tabla_registro['referido_por'];						
$titulo_formulario = $lang["r_titulo_editar"]; 


$tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $fecha_inscripcion);
$edad_anios = $tabla_edad_persona['anios'];


if($edad_anios<18){
    $nombre_firma= $nombre_acudiente;
    $documento_firma= '';
}else{
    $nombre_firma= $nombre_persona." ".$apellido_persona;
    $documento_firma= $detalle_tipo_doc['codigo_detalle'].". ".$documento_persona;
}



$tabla_chequeo = $dbChequeo->getListaChequeo($id_academica);

$reg_oportunidad = $tabla_chequeo['reg_oportunidad'];
$reg_oportunidad = $dbListas->getDetalle($reg_oportunidad);

$info_basica = $tabla_chequeo['info_basica'];
$info_basica = $dbListas->getDetalle($info_basica);

$preguntas_perso = $tabla_chequeo['preguntas_perso'];
$preguntas_perso = $dbListas->getDetalle($preguntas_perso);

$info_acudiente = $tabla_chequeo['info_acudiente'];
$info_acudiente = $dbListas->getDetalle($info_acudiente);

$inscripcion_estudiante = $tabla_chequeo['inscripcion_estudiante'];
$inscripcion_estudiante = $dbListas->getDetalle($inscripcion_estudiante);

$matricula_foto = $tabla_chequeo['matricula_foto'];
$matricula_foto = $dbListas->getDetalle($matricula_foto);

$contrato_matricula = $tabla_chequeo['contrato_matricula'];
$contrato_matricula = $dbListas->getDetalle($contrato_matricula);

$fotocopia_documento_estudiante = $tabla_chequeo['fotocopia_documento_estudiante'];
$fotocopia_documento_estudiante = $dbListas->getDetalle($fotocopia_documento_estudiante);

$fotocopia_documento_acudiente = $tabla_chequeo['fotocopia_documento_acudiente'];
$fotocopia_documento_acudiente = $dbListas->getDetalle($fotocopia_documento_acudiente);

$fotocopia_certificado_ultimo_grado = $tabla_chequeo['fotocopia_certificado_ultimo_grado'];
$fotocopia_certificado_ultimo_grado = $dbListas->getDetalle($fotocopia_certificado_ultimo_grado);

$fotocopia_diploma_bachiller = $tabla_chequeo['fotocopia_diploma_bachiller'];
$fotocopia_diploma_bachiller = $dbListas->getDetalle($fotocopia_diploma_bachiller);

$carta_bienvenida = $tabla_chequeo['carta_bienvenida'];
$carta_bienvenida = $dbListas->getDetalle($carta_bienvenida);

$solicitud_academica = $tabla_chequeo['solicitud_academica'];
$solicitud_academica = $dbListas->getDetalle($solicitud_academica);

$carta_compromiso = $tabla_chequeo['carta_compromiso'];
$carta_compromiso = $dbListas->getDetalle($carta_compromiso);

$paz_salvo_estudiante = $tabla_chequeo['paz_salvo_estudiante'];
$paz_salvo_estudiante = $dbListas->getDetalle($paz_salvo_estudiante);

$autorizacion_centrales_riesgo = $tabla_chequeo['autorizacion_centrales_riesgo'];
$autorizacion_centrales_riesgo = $dbListas->getDetalle($autorizacion_centrales_riesgo);

$solicitud_credito = $tabla_chequeo['solicitud_credito'];
$solicitud_credito = $dbListas->getDetalle($solicitud_credito);

$consulta_datacredito = $tabla_chequeo['consulta_datacredito'];
$consulta_datacredito = $dbListas->getDetalle($consulta_datacredito);

$pagare_carta_instrucciones = $tabla_chequeo['pagare_carta_instrucciones'];
$pagare_carta_instrucciones = $dbListas->getDetalle($pagare_carta_instrucciones);

$plan_pagos = $tabla_chequeo['plan_pagos'];
$plan_pagos = $dbListas->getDetalle($plan_pagos);

$entrega_carpeta = $tabla_chequeo['entrega_carpeta'];
$entrega_carpeta = $dbListas->getDetalle($entrega_carpeta);

$registra_info_q10 = $tabla_chequeo['registra_info_q10'];
$registra_info_q10 = $dbListas->getDetalle($registra_info_q10);

$matricula_estudiante_q10 = $tabla_chequeo['matricula_estudiante_q10'];
$matricula_estudiante_q10 = $dbListas->getDetalle($matricula_estudiante_q10);

$crear_credito_q10 = $tabla_chequeo['crear_credito_q10'];
$crear_credito_q10 = $dbListas->getDetalle($crear_credito_q10);

$foto_q10 = $tabla_chequeo['foto_q10'];
$foto_q10 = $dbListas->getDetalle($foto_q10);

$confirmacion_pago = $tabla_chequeo['confirmacion_pago'];
$confirmacion_pago = $dbListas->getDetalle($confirmacion_pago);

$registra_estudiante_simat = $tabla_chequeo['registra_estudiante_simat'];
$registra_estudiante_simat = $dbListas->getDetalle($registra_estudiante_simat);

$recibe_carpeta_items = $tabla_chequeo['recibe_carpeta_items'];
$recibe_carpeta_items = $dbListas->getDetalle($recibe_carpeta_items);

$firma_contrato_matricula = $tabla_chequeo['firma_contrato_matricula'];
$firma_contrato_matricula = $dbListas->getDetalle($firma_contrato_matricula);

$devuelve_carpeta = $tabla_chequeo['devuelve_carpeta'];
$devuelve_carpeta = $dbListas->getDetalle($devuelve_carpeta);

$fecha_rev_comercial = $tabla_chequeo['format_fecha_rev_comercial'];
if($fecha_rev_comercial=='01/01/1900'){$fecha_rev_comercial='';}
$observacion_comercial = $tabla_chequeo['observacion_comercial'];
$fecha_rev_academica = $tabla_chequeo['format_fecha_rev_academica'];
if($fecha_rev_academica=='01/01/1900'){$fecha_rev_academica='';}
$observacion_academica = $tabla_chequeo['observacion_academica'];
$fecha_rev_rectoria = $tabla_chequeo['format_fecha_rev_rectoria'];
if($fecha_rev_rectoria=='01/01/1900'){$fecha_rev_rectoria='';}
$observacion_rectoria = $tabla_chequeo['observacion_rectoria'];







?>
<page>
    
<br />
    <table border='1' style="text-align: center; font-size:12px; margin-left:55px;" >        
        <tr>
            <td rowspan="3" width="200"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="140" ></td>
            <td><b> INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b> </td>
            <td width="180"><b>C&oacute;digo: <?php echo($codigo_formato);?></b></td>
        </tr>
        <tr>
            <td><b>REGISTRO Y CONTROL</b></td>
            <td><b>Versi&oacute;n: <?php echo($version_formato);?></b></td>
        </tr>
        <tr>
            <td><b><?php echo($nombre_formato);?></b></td>
            <td><b>Fecha: <?php echo($fecha_formato);?></b></td>
        </tr>
    </table>
    <br />    
    <!-- width="500" -->
    
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="2"><b>DATOS PERSONALES</b></th>
        </tr>        
        <tr>
            <td colspan="2"><p><b>Nombre del Estudiante: </b><?php echo($nombre_persona." ".$apellido_persona);?></p></td>
        </tr>
        <tr>
            <td width="340"><p><b>Tipo de Documento: </b> <?php echo($tipo_documento);?></p></td>
            <td width="340"><p><b>N&uacute;mero de Documento: </b><?php echo($documento_persona);?></p></td>
        </tr>
        
        <tr>
            <td width="340"><p><b>Programa Acad&eacute;mico INCAD: </b><?php echo($programa_incad);?></p></td>
            <td width="340"><p><b>Fecha de Inscripci&oacute;n: </b> <?php echo($fecha_inscripcion);?></p></td>
        </tr>
    </table>
    
    <br />
    <table class='tabla_info' style="margin-left:55px;">
        <tr>
            <th style="text-align: center;" colspan="4"><b>Q10 GESTION COMERCIAL</b></th>
        </tr>        
        <tr>
            <td width="245"><p><b>Registrar Oportunidad: </b></p></td>
            <td width="85" class="td_info"><?php echo($reg_oportunidad['nombre_detalle']);?></td>
            <td width="245"><p><b>Información básica parte de arriba: </b></p></td>
            <td width="85" class="td_info"><?php echo($info_basica['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Preguntas personalizadas ¿Cómo se enteró?: </b> </p></td>            
            <td width="85" class="td_info"><?php echo($preguntas_perso['nombre_detalle']);?></td>            
            
            <td width="245"><p><b>Información acudiente y codeudor: </b></p></td>
            <td width="85" class="td_info"><?php echo($info_acudiente['nombre_detalle']);?></td>
        </tr>
    </table>
    
    <br />
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="4"><b>DOCUMENTOS DE ADMISION (COMERCIAL - SECRETARIA)</b></th>
        </tr>        
        <tr>
            <td width="245"><p><b>Inscripción del estudiante: </b> </p></td>
            <td width="85" class="td_info"><?php echo($inscripcion_estudiante['nombre_detalle']);?></td>            
            <td width="245"><p><b>Matrícula con foto Q10: </b></p></td>
            <td width="85" class="td_info"><?php echo($matricula_foto['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Contrato de matrícula: </b></p></td>
            <td width="85" class="td_info"><?php echo($contrato_matricula['nombre_detalle']);?></td>            
            <td width="245"><p><b>Fotocopia del documento del estudiante: </b></p></td>
            <td width="85" class="td_info"><?php echo($fotocopia_documento_estudiante['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Fotocopia del documento del acudiante y/o codeudor: </b> </p></td>
            <td width="85" class="td_info"><?php echo($fotocopia_documento_acudiente['nombre_detalle']);?></td>            
            <td width="245"><p><b>Fotocopia del certificado del ultimo año cursado (Bachillerato): </b> </p></td>
            <td width="85" class="td_info"><?php echo($fotocopia_certificado_ultimo_grado['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Fotocopia del diploma y acta de bachiller o certificacion 9° (Técnicos): </b> </p></td>
            <td width="85" class="td_info"><?php echo($fotocopia_diploma_bachiller['nombre_detalle']);?></td>            
            <td width="245"><p><b>Carta de Bienvenida: </b> </p></td>
            <td width="85" class="td_info"><?php echo($carta_bienvenida['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Solicitud Académica: </b> </p></td>
            <td width="85" class="td_info"><?php echo($solicitud_academica['nombre_detalle']);?></td>
            
            <td width="245"><p><b>Carta de Compromiso: </b> </p></td>
            <td width="85" class="td_info"><?php echo($carta_compromiso['nombre_detalle']);?></td>
        </tr>        
    </table>
    
    <br />
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="4"><b>INFORMACION FINANCIERA</b></th>
        </tr>        
        <tr>
            <td width="245"><p><b>Paz y salvo del estudiante: </b> </p></td>
            <td width="85" class="td_info"><?php echo($paz_salvo_estudiante['nombre_detalle']);?></td>            
            <td width="245"><p><b>Autorización consulta centrales de riesgo: </b></p></td>
            <td width="85" class="td_info"><?php echo($autorizacion_centrales_riesgo['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Solicitud de crédito (llenar toda la información,referencias llamar): </b> </p></td>
            <td width="85" class="td_info"><?php echo($solicitud_credito['nombre_detalle']);?></td>            
            <td width="245"><p><b>Consulta Datacredito: </b> </p></td>
            <td width="85" class="td_info"><?php echo($consulta_datacredito['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Pagaré y carta de Instrucciones (se firma en blanco con huella): </b> </p></td>
            <td width="85" class="td_info"><?php echo($pagare_carta_instrucciones['nombre_detalle']);?></td>
            
            <td width="245"><p><b>Plan de pagos (fecha y valor de cuotas): </b> </p></td>
            <td width="85" class="td_info"><?php echo($plan_pagos['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Comercial entrega a secretaria la carpeta del estudiante ordenada con sus respectivos formatos y documentos: </b> </p></td>            
            <td width="85" class="td_info"><?php echo($entrega_carpeta['nombre_detalle']);?></td>            
        </tr>
        
        
    </table>
    
    <br />
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="4"><b>SECRETARIA ACADEMICA</b></th>
        </tr>        
        <tr>
            <td width="245"><p><b>Registrar información Q10: </b> </p></td>
            <td width="85" class="td_info"><?php echo($registra_info_q10['nombre_detalle']);?></td>            
            <td width="245"><p><b>Matricular al estudiante  Q10: </b></p></td>
            <td width="85" class="td_info"><?php echo($matricula_estudiante_q10['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Crear crédito en Q10: </b> </p></td>
            <td width="85" class="td_info"><?php echo($crear_credito_q10['nombre_detalle']);?></td>            
            <td width="245"><p><b>Tomar foto Q10: </b> </p></td>
            <td width="85" class="td_info"><?php echo($foto_q10['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Confirmación del pago: </b> </p></td>
            <td width="85" class="td_info"><?php echo($confirmacion_pago['nombre_detalle']);?></td>
            
            <td width="245"><p><b>Registrar al estudiante en SIMAT O SIET: </b> </p></td>
            <td width="85" class="td_info"><?php echo($registra_estudiante_simat['nombre_detalle']);?></td>
        </tr>
        
    </table>
    
    
    <br />
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="4"><b>RECTORIA</b></th>
        </tr>        
        <tr>
            <td width="245"><p><b>Recibe carpeta con todos los items anteriores: </b> </p></td>
            <td width="85" class="td_info"><?php echo($recibe_carpeta_items['nombre_detalle']);?></td>            
            <td width="245"><p><b>Firma contrato de matricula, matricula, solicitud de credito: </b></p></td>
            <td width="85" class="td_info"><?php echo($firma_contrato_matricula['nombre_detalle']);?></td>
        </tr>
        
        <tr>
            <td width="245"><p><b>Devuelve carpeta para archivo: </b> </p></td>
            <td width="85" class="td_info"><?php echo($devuelve_carpeta['nombre_detalle']);?></td>            
        </tr>
        
    </table>
    
    <br />
    
    
    <table border='1' style="width:100%; text-align: center; margin-left:55px; font-size: 10px;" >        
        <tr>
            <td width="174"><b>RESPONSABLES</b> </td>
            <td width="120"><b>FECHA DE REVISION</b> </td>
            <td width="212"><b>OBSERVACIONES</b> </td>
            <td width="167"><b>FIRMA</b> </td>
        </tr>        
        <tr>
            <td width="174" style="text-align: left; vertical-align: middle;">COMERCIAL <br /><br /></td>
            <td width="120"><p><?php echo($fecha_rev_comercial);?></p></td>
            <td width="212" style="text-align: left; vertical-align: top; font-size: 9px;"><p><?php echo($observacion_comercial);?></p></td>
            <td width="167"><img src="firmas/firma_comercial.png" width="100" ></td>
        </tr>        
        
        <tr>
            <td width="174" style="text-align: left; vertical-align: middle;">SECRETARIA ACADEMICA <br /><br /></td>
            <td width="120"><p><?php echo($fecha_rev_academica);?></p></td>
            <td width="212" style="text-align: left; vertical-align: top; font-size: 9px;"><p><?php echo($observacion_academica);?></p></td>
            <td width="167"><img src="firmas/Firma_Academica.png" width="100" ></td>
        </tr>        
        
        <tr>
            <td width="174" style="text-align: left; vertical-align: middle;">RECTORIA <br /><br /></td>
            <td width="120"><p><?php echo($fecha_rev_rectoria);?></p></td>
            <td width="212" style="text-align: left; vertical-align: top; font-size: 9px;"><p><?php echo($observacion_rectoria);?></p></td>
            <td width="167"></td>
        </tr>        
        
        
        
        
    </table>
    
    
    
</page>
