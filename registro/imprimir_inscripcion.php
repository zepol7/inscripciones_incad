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


.parrafo_text_2{
    width: 50%;
    font-family: Arial;
    font-size: 14px;    
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

//Datos fortamos
$tabla_formatos = $dbformatos->getFomato(1);
$nombre_formato = $tabla_formatos['nombre_formato'];
$codigo_formato = $tabla_formatos['codigo_formato'];
$version_formato = $tabla_formatos['version_formato'];
$fecha_formato = $tabla_formatos['format_fecha_formato'];



//Datos Datos personas Mayor de edad
$tabla_formatos_mayor = $dbformatos->getFomato(9);
$nombre_formato_mayor = $tabla_formatos_mayor['nombre_formato'];
$codigo_formato_mayor = $tabla_formatos_mayor['codigo_formato'];
$version_formato_mayor = $tabla_formatos_mayor['version_formato'];
$fecha_formato_mayor = $tabla_formatos_mayor['format_fecha_formato'];


//Datos Datos personas Menor de edad
$tabla_formatos_menor = $dbformatos->getFomato(10);
$nombre_formato_menor = $tabla_formatos_menor['nombre_formato'];
$codigo_formato_menor = $tabla_formatos_menor['codigo_formato'];
$version_formato_menor = $tabla_formatos_menor['version_formato'];
$fecha_formato_menor = $tabla_formatos_menor['format_fecha_formato'];




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


$fecha_inscripcion_partes = explode("/", $fecha_inscripcion);
$dia_inscripcion = $fecha_inscripcion_partes[0];
$mes_inscripcion = $fecha_inscripcion_partes[1];
$anio_inscripcion = $fecha_inscripcion_partes[2];


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
            <td><b>GESTI&Oacute;N COMECIAL</b></td>
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
            <th style="text-align: center;" colspan="3"><b>DATOS PERSONALES</b></th>
        </tr>        
        <tr>
            <td colspan="3"><p><b>Nombre del Estudiante: </b><?php echo($nombre_persona." ".$apellido_persona);?></p></td>
            
        </tr>
        <tr>
            <td width="223"><p><b>Tipo de Documento: </b> <?php echo($tipo_documento);?></p></td>
            <td width="223"><p><b>N&uacute;mero de Documento: </b><?php echo($documento_persona);?></p></td>
            <td width="223"><p><b>Fecha de Expedici&oacute;n: </b><?php echo($fecha_documento);?></p></td>
        </tr>
        <tr>
            <td colspan="2" width="446"><p><b>Lugar de Expedici&oacute;n: </b><?php echo($lugar_documento);?></p></td>
            <td width="223"><p><b>Fecha de Nacimiento: </b><?php echo($fecha_nacimiento);?></p></td>
        </tr>
		<tr>
            <td colspan="2" width="446"><p><b>Lugar de Nacimiento: </b><?php echo($lugar_nacimiento);?></p></td>
            <td width="223"><p><b>Edad: </b> <?php echo($edad_anios);?></p></td>            
        </tr>
        <tr>
            <td width="223"><p><b>Sexo: </b> <?php echo($nom_sexo);?></p></td>
            <td width="223"><p><b>Tipo de sangre: </b> <?php echo($tipo_sangre);?></p></td>            
            <td width="223"><p><b>Estado civil: </b> <?php echo($estado_civil);?></p></td>            
        </tr>
		<tr>
            <td colspan="2" width="446"><p><b>Direcci&oacute;n Residencia : </b><?php echo($direccion_casa);?></p></td>
            <td width="223"><p><b>Estrato: </b> <?php echo($estrato_persona);?></p></td>
        </tr>
		<tr>
            <td colspan="2" width="446"><p><b>Barrio de Residencia: </b><?php echo($barrio_residencia);?></p></td>
            <td width="223"><p><b>Tel&eacute;fono 1: </b><?php echo($tel_casa_persona);?></p></td>            
        </tr>
		<tr>
            <td colspan="2" width="446"><p><b>Ciudad de Residencia: </b><?php echo($ciudad_residencia);?></p></td>
			<td width="223"><p><b>Tel&eacute;fono 2: </b><?php echo($tel_movil_persona);?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="446"><p><b>Correo electr&oacute;nico: </b><?php echo($email_persona);?></p></td>
            <td width="223"><p><b>EPS: </b><?php echo($eps);?></p></td>
        </tr>        
		
    </table>
    
    <br />    
    <table class='tabla_info' style="margin-left:55px;">        
        <tr>
            <th style="text-align: center;" colspan="3"><b>PERSONAS DE CONTACTO</b></th>
        </tr>        
        <tr>
            <td width="229"><p><b>Nombre 1:</b> <?php echo($nombre_contacto_1);?></p></td>
            <td width="220"><p><b>Tel&eacute;fono 1:</b> <?php echo($telefono_contacto_1);?></p></td>
            <td width="220"><p><b>Parentesco 1:</b> <?php echo($parentesco_contacto_1);?></p></td>
        </tr>
        <tr>
            <td width="229"><p><b>Nombre 2:</b> <?php echo($nombre_contacto_2);?></p></td>
            <td width="220"><p><b>Tel&eacute;fono 2:</b> <?php echo($telefono_contacto_2);?></p></td>
            <td width="220"><p><b>Parentesco 2:</b> <?php echo($parentesco_contacto_2);?></p></td>            
        </tr>        
        <tr>
            <td width="229"><p><b>Nombre 3:</b> <?php echo($nombre_contacto_3);?></p></td>            
            <td width="220"><p><b>Tel&eacute;fono 2:</b> <?php echo($telefono_contacto_3);?></p></td>            
            <td width="220"><p><b>Parentesco 3:</b><?php echo($parentesco_contacto_3);?></p></td>            
        </tr>
        <tr>
            <td width="229"><p><b>Acudiente:</b> <?php echo($nombre_acudiente);?></p></td>            
            <td width="220"><p><b>Tel&eacute;fono:</b> <?php echo($telefono_acudiente);?></p></td>            
            <td width="220"><p><b>Parentesco:</b> <?php echo($parentesco_acudiente);?></p></td>            
        </tr>
    </table>
    <br />
    
    <table class='tabla_info' style="margin-left:55px;" >        
        <tr>
            <th style="text-align: center;" colspan="6"><b>INFORMACI&Oacute;N ACAD&Eacute;MICA</b></th>
        </tr>        
        <tr>
            <td colspan="3" width="335"><p><b>Tipo de Inscripci&oacute;n: </b> <?php echo($tipo_inscripcion);?></p></td>            
            <td colspan="3" width="335"><p><b>Fecha de Inscripci&oacute;n: </b> <?php echo($fecha_inscripcion);?></p></td>
        </tr>
        <tr>
            <td colspan="3" width="335"><p><b>&Uacute;ltimo Estudio Aprobado: </b> <?php echo($ultimo_estudio);?></p></td>
            <td colspan="3" width="335"><p><b>Instituci&oacute;n: </b> <?php echo($institucion_estudio);?></p></td>
        </tr>        
        <tr>
            <td colspan="4" width="446"><p><b>Programa Acad&eacute;mico INCAD: </b><?php echo($programa_incad);?></p></td>
            <td colspan="2" width="223"><p><b>Jornada: </b> <?php echo($jornada_incad);?></p></td>
        </tr>
        <tr>
            <td colspan="3" width="223"><p><b>Calendario Acad&eacute;mico: </b><?php echo($calendario_academico);?></p></td>
            <td colspan="3" width="223"><p><b>Unidad de Negocio : </b> <?php echo($unidad_negocio);?></p></td>
        </tr>
        
        <tr>
            <td colspan="6" width="670">
                <p>
                <b>Ha estudiado antes un programa t&eacute;cnico: </b><?php echo($programa_tecnico);?> &nbsp; &nbsp; 
                
                <b>Realiz&oacute; practica laboral con contrato de aprendizaje: </b> <?php echo($practica_laboral);?>
                </p></td>
            
        </tr>
		
        <tr>
            <td colspan="2" width="223"><p><b>Valor del Programa: </b> <?php echo($valor_programa);?></p></td>
            <td colspan="2" width="223"><p><b>Descuento: </b> <?php echo($descuento);?></p></td>
            <td colspan="2" width="223"><p><b>Valor Neto a Pagar: </b> <?php echo($valor_neto_pagar);?></p></td>
        </tr>
		
        <tr>
            <td colspan="6" width="669"><p><b>Formas de Pago:</b>
            <?php echo $nom_forma_pago; ?>
            </p></td>
        </tr>
        
        <tr>
            <td colspan="6" width="669"><p><b>Entidad Financiera: </b> <?php echo($entidad_financiera);?></p></td>
        </tr>
        
        <tr>
            <td colspan="2" width="223"><p><b>Cuota Inicial: </b> <?php echo($cuota_inicial);?></p></td>
            <td colspan="2" width="223"><p><b>Valor a Financiar: </b> <?php echo($valor_financiar);?></p></td>            
            <td colspan="2" width="223"><p><b>N&uacute;meros de cuotas: </b><?php echo($num_cuotas);?></p></td>
        </tr>
        <tr>            
            <td colspan="2" width="223"><p><b>Periodicidad de pago : </b><?php echo($periodicidad_pago);?></p></td>
            <td colspan="2" width="223"><p><b>Valor cuotas : </b><?php echo($valor_cuota);?></p></td>
            <td colspan="2" width="223"><p><b>Fecha mensual de Pago : </b> <?php echo($fecha_mensula_pago);?></p></td>
        </tr>
         
        <tr>
            <td colspan="6" width="669"><p><b>Como se enter&oacute; de INCAD?:</b>
            <?php
            
            $tabla_lista_conoce = $dbListas->getListaDetalles(8);
            $i = 1;
            foreach ($tabla_lista_conoce as $fila_lista_conoce) {
                $id_conoce = $fila_lista_conoce['id_detalle'];
                $nombre_conoce = $fila_lista_conoce['nombre_detalle'];

                $checked = '';
                //Se recorre el array donde tien los perfiles encontrados
                if (count($registro_incad_conoce) != 0) {
                    foreach ($registro_incad_conoce as $fila_conoce_incad) {
                        $id_conoce_pago_inscripcion = $fila_conoce_incad['id_detalle'];
                        if ($id_conoce == $id_conoce_pago_inscripcion) {
                            $checked = 'checked';
                        }
                    }
                }
                if($checked == 'checked'){
                    echo($nombre_conoce." - ");					
                }
            }
            ?>
            </p></td>
        </tr>
        
        <tr>
            <td colspan="6" width="669"><p><b>Referido por: </b> <?php echo($referido_por);?></p></td>
        </tr>
              
    </table>
    <br />
    <table border='0' style="width:100%; text-align: center; margin-left:55px;" >        
        <tr>
            <td width="669">Diligenciar el formato de inscripci&oacute;n con datos reales que puedan ser confirmados, el diligenciamiento del mismo y el pago de la inscripci&oacute;n no constituye un compromiso de admisi&oacute;n sino una reserva</td>
        </tr>        
    </table>
    
    <br /><br /><br /><br />
    
    <table border='0' style="width:100%; text-align: center; margin-left:55px;" >        
        <tr>
            <td width="335"><b>___________________________________</b> </td>
            <td width="335"><b>___________________________________</b> </td>
        </tr>        
        <tr>
            <td><b>Alumno</b> </td>
            <td><b>Acudiente</b> </td>
        </tr>       
    </table>
    <br /><br /><br /><br />
    <table border='0' style="width:100%; text-align: center; margin-left:55px;" >        
        <tr>
            <td width="669">
            <?php
            if($promotor != ''){
                echo("<b>".$promotor."</b>");
            }
            else{
            ?>
                <b>___________________________________</b>    
            <?php     
            }
            ?>
                
             </td>
            
            
        </tr>        
        <tr>
            <td><b>Promotor</b> </td>
        </tr>       
    </table>
    
</page>



<?php
if($edad_anios>=18){
?>
<page>
    <table border='1' style="text-align: center; font-size:12px; margin-left:40px;" >        
        <tr>
            <td width="200" rowspan="3"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="140" ></td>
            <td width="300"><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></td>
            <td width="150"><b>C&oacute;digo: <?php echo($codigo_formato_mayor);?></b></td>
        </tr>
        <tr>
            <td width="300"><b>GESTI&Oacute;N COMECIAL</b></td>
            <td width="150"><b>Versi&oacute;n: <?php echo($version_formato_mayor);?></b></td>
        </tr>
        <tr>
            <td width="300"><b><?php echo($nombre_formato_mayor);?></b></td>
            <td width="150"><b>Fecha: <?php echo($fecha_formato_mayor);?></b></td>
        </tr>
    </table>
    <br /> <br />    
    
    <table border='0' style="margin-left:40px;">        
        	
        <tr>            
            <td width="670">
            <p class="parrafo_text_2"><b>AUTORIZO</b> de manera previa, informada y expresa al instituto de ciencias administrativas S.A.S., instituto INCAD identificado con NIT. 900567627-6, a que mis datos personales sean tratados bajo las siguientes FINALIDADES: a) adelantar el proceso de matrícula del estudiante; b) verificar la información suministrada; c) vincular al estudiante a la actividad académica en general dentro de la institución educativa; d) desarrollar el proceso de enseñanza y aprendizaje; e) vincular al estudiante a los distintos servicios que ofrezca la institución educativa; f) enviar  información a terceros autorizados por medio de alianzas estratégicas con otras instituciones; g) contactar al estudiante vía telefónica, correo, mensaje de texto, llamadas entre otros ; h) Cobro de cartera pre jurídica y/o jurídica por cuenta propia o por medio de un tercero autorizado; i) realización de vídeos, fotografías, entre otros que permitan el registro y posterior socialización  y comunicación de las diferentes actividades académicas y culturales que organicen a responsabilidad de la institución educativa y demás que hagan parte de la formación integral del estudiante. j) Realizar el registro histórico de las diferentes actividades que se realizan con padres, estudiantes, profesores y la comunidad académica en general. La autorización aquí expresada comprende los datos sensibles del estudiante que resultan necesarios para llevar a cabo el proceso de matrícula (datos asociados al estado de salud; orientación psicológica, registros fotográficos, fílmicos) y todos los demás datos personales de naturaleza privada, semiprivada y sensible que sean requeridos a través de formatos, encuestas, evaluaciones, cuestionarios, entrevistas, entre otros, con posterioridad a la suscripción de este documento, y cuya recolección sea necesaria para el cumplimiento de finalidades legítimas orientadas a proveer mejores condiciones de aprendizaje, otorgar beneficios al estudiante y padre de familia, conocer su desempeño dentro del instituto, eventualmente su estado de salud y hábitos de vida, desarrollar programas educativos y propuestas para el bienestar y seguridad del estudiante, asignar responsabilidades, verificar el proceso educativo del estudiante y cualquier otra finalidad expuesta dentro de la firma de este documento.</p>    
            </td>
        </tr>    
        <tr>            
            <td width="670">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="670">
            <p class="parrafo_text_2">Declaro que, la información consignada en este documento y los documentos que se anexan corresponden a la realidad y asumo plena responsabilidad por la veracidad de los mismos, comprometiéndome a actualizar esta información como mínimo una vez al año, anexando los soportes que sean requeridos para ello, todo bajo el principio de la buena fe. </p>    
            </td>
        </tr>
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_2">Los datos personales que el instituto INCAD hará tratamiento, corresponden exclusivamente a aquellos que resultan pertinentes, necesarios y adecuados para el desarrollo de las finalidades previamente informadas. Adicional a lo anterior, que el uso, manejo y tratamiento de los mismos se encuentran siempre bajo el cumplimiento de la política de tratamiento de datos personales y las normas generales de protección de datos personales</p>    
            </td>
        </tr>      
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><b>DE LOS DERECHOS COMO TITULAR DE LA INFORMACIÓN:</b> Atendiendo a su condición de titular, los datos personales que sean recolectados por el instituto INCAD, podrá formular consultas peticiones y reclamos ante esta institución con el propósito de conocerlos y/o informarse sobre el tratamiento del que son objeto, y cuando los mismos deban ser actualizados, modificados o rectificados, por lo cual conozco que los derechos que me asisten como titular podrán ser consultados en la Política de tratamiento de información personal ubicada en la página web: www.incad.edu.co</p>    
            </td>
        </tr>           
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">                  
            <p class="parrafo_text_2">En constancia de lo dicho, se firma el documento a los <?php echo($dia_inscripcion);?> días del mes de <?php echo($mes_inscripcion);?> del año <?php echo($anio_inscripcion);?> </p>    
            </td>
        </tr>  
    </table>    
    <br /><br />    <br />    
     <table class="tabla_info" border='0' style="width:100%; text-align: left;" >        
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>AUTORIZO:</b></td>
            <td width="360"></td>
        </tr>        
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>NOMBRES Y APELLIDOS:</b> </td>
            <td width="360"><b><?php echo($nombre_firma);?></b> </td>
        </tr>        
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>IDENTIFICACIÓN:</b> </td>
            <td width="360"><b><?php echo($documento_firma);?></b> </td>
        </tr> 
        
        <tr>            
            <td colspan="3" ><br /><br /><br /></td>
        </tr>  
        
        <tr>
            <td width="50">&nbsp;</td>
            <td colspan="2"><b>FIRMA:</b> ____________________________________________________________________ </td>
            
        </tr> 
       
    </table>
    
</page>


<?php    
}else{
?>
<page>
    <table border='1' style="text-align: center; font-size:12px; margin-left:40px;" >        
        <tr>
            <td width="200" rowspan="3"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="140" ></td>
            <td width="300"><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></td>
            <td width="150"><b>C&oacute;digo: <?php echo($codigo_formato_menor);?></b></td>
        </tr>
        <tr>
            <td width="300"><b>GESTI&Oacute;N COMECIAL</b></td>
            <td width="150"><b>Versi&oacute;n: <?php echo($version_formato_menor);?></b></td>
        </tr>
        <tr>
            <td width="300"><b><?php echo($nombre_formato_menor);?></b></td>
            <td width="150"><b>Fecha: <?php echo($fecha_formato_menor);?></b></td>
        </tr>
    </table>
    <br /> <br />    
    
    <table border='0' style="margin-left:40px;">        
        	
        <tr>            
            <td width="670">
            <p class="parrafo_text_2"><b>AUTORIZO</b> de manera previa, informada y expresa al instituto de ciencias administrativas S.A.S., instituto INCAD identificado con NIT. 900567627-6, a que mis datos personales y los del menor que represento sean tratados bajo las siguientes FINALIDADES: : a) adelantar el proceso de matrícula del estudiante; b) verificar la información suministrada; c) vincular al estudiante a la actividad académica en general dentro de la institución educativa; d) desarrollar el proceso de enseñanza y aprendizaje del menor; e) vincular al estudiante a los distintos servicios que ofrezca la institución educativa; e) enviar  información a terceros autorizados por medio de alianzas estratégicas con otras instituciones; f) contactar al padre, madre o acudiente del menor vía telefónica, correo, mensaje de texto, llamadas entre otros ; g) Cobro de cartera pre jurídica y/o jurídica por cuenta propia o por medio de un tercero autorizado; h) realización de vídeos, fotografías, entre otros que permitan el registro y posterior socialización  y comunicación de las diferentes actividades académicas y culturales que organicen a responsabilidad de la institución educativa y demás que hagan parte de la formación integral del estudiante. I) Realizar el registro histórico de las diferentes actividades que se realizan con padres, estudiantes, profesores y la comunidad académica en general. La autorización aquí expresada comprende los datos sensibles del menor que resultan necesarios para llevar a cabo el proceso de matrícula (datos asociados al estado de salud; orientación psicológica, registros fotográficos, fílmicos) y todos los demás datos personales de naturaleza privada, semiprivada y sensible que sean requeridos a través de formatos, encuestas, evaluaciones, cuestionarios, entrevistas, entre otros, con posterioridad a la suscripción de este documento, y cuya recolección sea necesaria para el cumplimiento de finalidades legítimas orientadas a proveer mejores condiciones de aprendizaje, otorgar beneficios al estudiante y padre de familia, conocer su desempeño dentro del instituto, eventualmente su estado de salud y hábitos de vida, desarrollar programas educativos y propuestas para el bienestar y seguridad del estudiante, asignar responsabilidades, verificar el proceso educativo del menor  y cualquier otra finalidad expuesta dentro de la firma de este documento. </p>    
            </td>
        </tr>    
        <tr>            
            <td width="670">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="670">
            <p class="parrafo_text_2">Declaro que, la información consignada en este documento y los documentos que se anexan corresponden a la realidad y asumo plena responsabilidad por la veracidad de los mismos, comprometiéndome a actualizar esta información como mínimo una vez al año, anexando los soportes que sean requeridos para ello, todo bajo el principio de la buena fe.</p>    
            </td>
        </tr>
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_2">Los datos personales que el instituto INCAD hará tratamiento, corresponden exclusivamente a aquellos que resultan pertinentes, necesarios y adecuados para el desarrollo de las finalidades previamente informadas, motivo por el cual dentro del presente documento se recolecta INFORMACION de carácter SENSIBLE del menor que represento, razón por la cual se entiende que son facultativos la decisión de ser otorgados por parte del mismo, adicional a lo anterior que el uso, manejo y tratamiento de los mismo se encuentran siempre salvaguardando el interés superior del menor, bajo el cumplimiento de la política de tratamiento de datos personales y las normas generales de protección de datos personales.</p>    
            </td>
        </tr>      
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><b>DE LOS DERECHOS COMO TITULAR DE LA INFORMACIÓN:</b> Atendiendo a su condición de titular y/o representante legal del menor, los datos personales que sean recolectados por el instituto INCAD, podrá formular consultas peticiones y reclamos ante esta institución con el propósito de conocerlos y/o informarse sobre el tratamiento del que son objeto, y cuando los mismos deban ser actualizados, modificados o rectificados, por lo cual conozco que los derechos que me asisten como titular podrán ser consultados en la política de tratamiento de información personal ubicada en la página web: www.incad.edu.co </p>    
            </td>
        </tr>           
        <tr>            
            <td width="650">
            <p class="parrafo_text_2"><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_2">En constancia de lo dicho, se firma el documento a los <?php echo($dia_inscripcion);?> días del mes de <?php echo($mes_inscripcion);?> del año <?php echo($anio_inscripcion);?> </p>    
            </td>
        </tr>  
    </table>    
    <br /><br />    <br />    
     <table class="tabla_info" border='0' style="width:100%; text-align: left;" >        
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>AUTORIZO:</b></td>
            <td width="360"></td>
        </tr>        
        <tr>
            <td width="50">&nbsp;</td>
            <td colspan="2"><b>NOMBRE DEL REPRESENTANTE LEGAL:</b> <?php echo($nombre_contacto_1); ?></td>
            
        </tr>        
        <tr>
            <td width="50">&nbsp;</td>
            <td colspan="2"><b>IDENTIFICACIÓN:</b> __________________________________________________</td>
            
        </tr>         
        <tr>            
            <td colspan="3" ><br /><br /></td>
        </tr> 
        <tr>
            <td width="50">&nbsp;</td>
            <td colspan="2"><b>FIRMA:</b> ______________________________________________________________ </td>
        </tr> 
        <tr>            
            <td colspan="3" ><br /><br /></td>
        </tr>          
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>NOMBRE DEL MENOR (ESTUDIANTE):</b> </td>
            <td width="360"><b><?php echo($nombre_persona." ".$apellido_persona);?></b> </td>
        </tr>        
       
    </table>
    
</page>


<?php    
}
?>




