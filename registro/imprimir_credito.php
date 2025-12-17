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
  font-size: 10px;
}
.tabla_info td { 
    padding-bottom: 3px;
    padding-top: 3px;
    padding-right: 2px;
}



.tabla_info_firma td { 
    padding: 5px;
    border-top: black 1px solid;
    border-left: black 1px solid;
    border-right: black 1px solid;
    border-bottom: black 1px solid;  
     font-size: 10px;
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
$tabla_formatos = $dbformatos->getFomato(4);
$nombre_formato = $tabla_formatos['nombre_formato'];
$codigo_formato = $tabla_formatos['codigo_formato'];
$version_formato = $tabla_formatos['version_formato'];
$fecha_formato = $tabla_formatos['format_fecha_formato'];



//Busca por el registro medico de la seleccionada
$tabla_registro = $dbRegistroPersonas->getRegistroPersona($_GET['id_registro']);
$id_persona = $tabla_registro['id_persona'];
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


$id_academica = $tabla_registro['id_academica'];
$tipo_inscripcion = $tabla_registro['nom_tipo_inscripcion'];
$fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];
$ultimo_estudio = $tabla_registro['ultimo_estudio'];
$institucion_estudio = $tabla_registro['institucion_estudio'];
$programa_incad = $tabla_registro['nom_id_programa'];
$jornada_incad = $tabla_registro['jornada_incad'];
$valor_programa = number_format($tabla_registro['valor_programa'], 0, '', '.'); 
$descuento = number_format($tabla_registro['descuento'], 0, '', '.'); 
$valor_neto_pagar = number_format($tabla_registro['valor_neto_pagar'], 0, '', '.'); 
//$forma_pago = $tabla_registro['forma_pago'];
$registro_formas_pago = $dbRegistroPersonas->getListaFormasPago($id_academica);

$entidad_financiera = $tabla_registro['entidad_financiera'];
$cuota_inicial = number_format($tabla_registro['cuota_inicial'], 0, '', '.');
$valor_financiar = number_format($tabla_registro['valor_financiar'], 0, '', '.'); 
$num_cuotas = $tabla_registro['num_cuotas'];
$valor_cuota = number_format($tabla_registro['valor_cuota'], 0, '', '.'); 
$fecha_mensula_pago = $tabla_registro['fecha_mensula_pago'];
$registro_incad_conoce = $dbRegistroPersonas->getListaReferido($id_academica);


@$persona_noti_direccion = $tabla_registro['persona_noti_direccion'];		
@$persona_noti_correo = $tabla_registro['persona_noti_correo'];

$tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $fecha_inscripcion);
$edad_anios = $tabla_edad_persona['anios'];


$tabla_credito = $dbRegistroPersonas->getCredito($_GET['id_credito']);

$id_credito = $tabla_credito['id_credito'];

$tipo_documento_deudor= $tabla_credito['nom_tipo_documento_deudor'];
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
$tipo_vehiculo_deudor= $tabla_credito['nom_tipo_vehiculo_deudor'];
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
$noti_correo_deudor= $tabla_credito['noti_correo_deudor'];

$tipo_documento_codeudor= $tabla_credito['nom_tipo_documento_codeudor'];
//if($tipo_documento_codeudor=="NA"){$tipo_documento_codeudor="0";}
$documento_codeudor= $tabla_credito['documento_codeudor'];
if($documento_codeudor=="NA"){$documento_codeudor="____________";}
$nombre_codeudor= $tabla_credito['nombre_codeudor'];
if($nombre_codeudor=="NA"){$nombre_codeudor="____________ ";}
$apellido_codeudor= $tabla_credito['apellido_codeudor'];
if($apellido_codeudor=="NA"){$apellido_codeudor="____________";}
$fecha_nacimiento_codeudor= $tabla_credito['format_fecha_nacimiento_codeudor'];
if($fecha_nacimiento_codeudor=="01/01/1999"){$fecha_nacimiento_codeudor="__________";}
$edad_codeudor= $tabla_credito['edad_codeudor'];
if($edad_codeudor=="99"){$edad_codeudor="________";}
$direccion_residencia_codeudor= $tabla_credito['direccion_residencia_codeudor'];
if($direccion_residencia_codeudor=="NA"){$direccion_residencia_codeudor="__________ __________ __________";}
$barrio_residencia_codeudor= $tabla_credito['barrio_residencia_codeudor'];
if($barrio_residencia_codeudor=="NA"){$barrio_residencia_codeudor="__________ __________ __________";}
$ciudad_residencia_codeudor= $tabla_credito['ciudad_residencia_codeudor'];
if($ciudad_residencia_codeudor=="NA"){$ciudad_residencia_codeudor="__________ __________";}
$tel_casa_codeudor= $tabla_credito['tel_casa_codeudor'];
if($tel_casa_codeudor=="NA"){$tel_casa_codeudor="____________";}
$tel_movil_codeudor= $tabla_credito['tel_movil_codeudor'];
if($tel_movil_codeudor=="NA"){$tel_movil_codeudor="____________";}
$email_codeudor= $tabla_credito['email_codeudor'];
if($email_codeudor=="NA"){$email_codeudor="________________";}
$actividad_economica_codeudor= $tabla_credito['actividad_economica_codeudor'];				
if($actividad_economica_codeudor=="NA"){$actividad_economica_codeudor="__________ __________";}
$ingreso_mensual_codeudor = number_format($tabla_credito['ingreso_mensual_codeudor'], 0, '', '.'); 				
if($ingreso_mensual_codeudor=="0"){$ingreso_mensual_codeudor="____________";}
$nombre_empresa_codeudor= $tabla_credito['nombre_empresa_codeudor'];
if($nombre_empresa_codeudor=="NA"){$nombre_empresa_codeudor="__________ __________";}
$direccion_empresa_codeudor= $tabla_credito['direccion_empresa_codeudor'];
if($direccion_empresa_codeudor=="NA"){$direccion_empresa_codeudor="____________ ____________";}
$telefono_empresa_codeudor= $tabla_credito['telefono_empresa_codeudor'];
if($telefono_empresa_codeudor=="NA"){$telefono_empresa_codeudor="____________";}
$tipo_vehiculo_codeudor= $tabla_credito['nom_tipo_vehiculo_codeudor'];
if($tipo_vehiculo_codeudor=="NA"){$tipo_vehiculo_codeudor="____________";}
$placa_vehiculo_codeudor= $tabla_credito['placa_vehiculo_codeudor'];
if($placa_vehiculo_codeudor=="NA"){$placa_vehiculo_codeudor="____________";}
$marca_vehiculo_codeudor= $tabla_credito['marca_vehiculo_codeudor'];
if($marca_vehiculo_codeudor=="NA"){$marca_vehiculo_codeudor="____________";}
$modelo_vehiculo_codeudor= $tabla_credito['modelo_vehiculo_codeudor'];
if($modelo_vehiculo_codeudor=="NA"){$modelo_vehiculo_codeudor="____________";}

$nom_ref_familiar_uno_codeudor= $tabla_credito['nom_ref_familiar_uno_codeudor'];
if($nom_ref_familiar_uno_codeudor=="NA"){$nom_ref_familiar_uno_codeudor="____________";}
$tel_ref_familiar_uno_codeudor= $tabla_credito['tel_ref_familiar_uno_codeudor'];
if($tel_ref_familiar_uno_codeudor=="NA"){$tel_ref_familiar_uno_codeudor="____________";}
$nom_ref_familiar_dos_codeudor= $tabla_credito['nom_ref_familiar_dos_codeudor'];
if($nom_ref_familiar_dos_codeudor=="NA"){$nom_ref_familiar_dos_codeudor="____________";}
$tel_ref_familiar_dos_codeudor= $tabla_credito['tel_ref_familiar_dos_codeudor'];
if($tel_ref_familiar_dos_codeudor=="NA"){$tel_ref_familiar_dos_codeudor="____________";}
$nom_ref_personal_uno_codeudor= $tabla_credito['nom_ref_personal_uno_codeudor'];
if($nom_ref_personal_uno_codeudor=="NA"){$nom_ref_personal_uno_codeudor="____________";}
$tel_ref_personal_uno_codeudor= $tabla_credito['tel_ref_personal_uno_codeudor'];
if($tel_ref_personal_uno_codeudor=="NA"){$tel_ref_personal_uno_codeudor="____________";}
$nom_ref_personal_dos_codeudor= $tabla_credito['nom_ref_personal_dos_codeudor'];
if($nom_ref_personal_dos_codeudor=="NA"){$nom_ref_personal_dos_codeudor="____________";}
$tel_ref_personal_dos_codeudor= $tabla_credito['tel_ref_personal_dos_codeudor'];
if($tel_ref_personal_dos_codeudor=="NA"){$tel_ref_personal_dos_codeudor="____________";}
$noti_direccion_codeudor= $tabla_credito['noti_direccion_codeudor'];
$noti_correo_codeudor= $tabla_credito['noti_correo_codeudor'];


?>
<page>
    
    <table border='1' style="text-align: center; font-size:12px; margin-left:60px;" >        
        <tr>
            <td rowspan="3" width="200"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td> <b> INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b> </td>
            <td width="180"><b>C&oacute;digo: <?php echo($codigo_formato);?></b></td>
        </tr>
        <tr>
            <td><b>REGSITRO Y CONTROL</b></td>
            <td><b>Versi&oacute;n: <?php echo($version_formato);?></b></td>
        </tr>
        <tr>
            <td><b><?php echo($nombre_formato);?></b></td>
            <td><b>Fecha: <?php echo($fecha_formato);?></b></td>
        </tr>
    </table>
    <br />    
    
    <table class='tabla_info' style="margin-left:60px;">        
        <tr>
            <th style="text-align: center;" colspan="6"><b>INFORMACI&Oacute;N ACAD&Eacute;MICA</b></th>
        </tr>  
        
        <tr>
            <td colspan="4" width="448"><p><b>Programa Acad&eacute;mico INCAD: </b><?php echo($programa_incad);?></p></td>
            <td colspan="2" width="224"><p><b>Fecha: </b><?php echo($fecha_inscripcion);?></p></td>
        </tr>
        <tr>
            <td colspan="2" width="224"><p><b>Valor del Programa: </b><?php echo($valor_programa);?></p></td>
            <td colspan="2" width="224"><p><b>Descuento: </b><?php echo($descuento);?></p></td>
            <td colspan="2" width="224"><p><b>Cuota Inicial: </b><?php echo($cuota_inicial);?></p></td>            
        </tr>        
        <tr>
            <td colspan="2" width="224"><p><b>Valor a Financiar: </b><?php echo($valor_financiar);?></p></td>
            <td colspan="2" width="224"><p><b>Cuotas: </b><?php echo($num_cuotas);?></p></td>
            <td colspan="2" width="224"><p><b>Valor cuotas : </b><?php echo($valor_cuota);?></p></td>
        </tr>
    </table>
    
    <br />
    <table class='tabla_info' style="margin-left:60px;"  >        
        <tr>
            <th style="text-align: center;" colspan="8"><b>DATOS PERSONALES</b></th>
        </tr>        
        <tr>
            <td colspan="5" width="420"><p><b>Nombre del Estudiante: </b><?php echo($nombre_persona." ".$apellido_persona);?></p></td>                       
            <td colspan="3" width="252"><p><b>Tipo de Documento: </b><?php echo($tipo_documento);?></p></td>            
        </tr>
        <tr>
            <td colspan="5" width="420"><p><b>Direcci&oacute;n Residencia : </b><?php echo($direccion_casa);?></p></td>
            <td colspan="3" width="250"><p><b>N&uacute;mero de Documento: </b><?php echo($documento_persona);?></p></td>            
        </tr>        
        <tr>
            <td colspan="3" width="252"><p><b>Fecha de Nacimiento: </b><?php echo($fecha_nacimiento);?> <b>Edad: </b><?php echo($edad_anios);?></p></td>
            <td colspan="5" width="420"><p><b>Barrio de Residencia: </b><?php echo($barrio_residencia);?></p></td>
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Tel&eacute;fono Casa: </b><?php echo($tel_casa_persona);?></p></td>
            <td colspan="2" width="168"><p><b>Tel&eacute;fono Celular: </b><?php echo($tel_movil_persona);?></p></td>
            <td colspan="4" width="330"><p><b>Ciudad de Residencia: </b><?php echo($ciudad_residencia);?></p></td>            
        </tr>
        <tr>    
            <td colspan="3" width="252"><p><b>Correo electr&oacute;nico: </b><?php echo($email_persona);?></p></td>            
            <td colspan="3" width="252"><p><b>Env&iacute;o Notificaci&oacute;n </b>
                <?php if($persona_noti_direccion == 1){echo('<span>Direcci&oacute;n</span> - ');}?>
                <?php if($persona_noti_correo == 1){echo('<span>Correo</span>');}?>
                </p>        
            </td>
        </tr>
        
        
        
    </table>
    <br />    
    <table class='tabla_info' style="margin-left:60px;" >        
        <tr>
            <th style="text-align: center;" colspan="8"><b>INFORMACI&Oacute;N DEL DEUDOR</b></th>
        </tr>        
        <tr>
            <td colspan="3" width="252"><p><b>Nombres: </b><?php echo($nombre_deudor." ".$apellido_deudor);?></p></td>                       
            <td colspan="3" width="252"><p><b>Tipo de Documento: </b><?php echo($tipo_documento_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Num Documento:</b><?php echo($documento_deudor);?></p></td>
        </tr>
        <tr>
            <td colspan="4" width="336"><p><b>Direcci&oacute;n Residencia : </b><?php echo($direccion_residencia_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Fecha de Nacimiento: </b><?php echo($fecha_nacimiento_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Edad: </b><?php echo($edad_deudor);?></p></td>
        </tr>        
        <tr>
            
        </tr>
        <tr>
            <td colspan="4" width="336"><p><b>Barrio de Residencia: </b><?php echo($barrio_residencia_deudor);?></p></td>
            <td colspan="4" width="336"><p><b>Ciudad de Residencia: </b><?php echo($ciudad_residencia_deudor);?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Tel. Casa: </b><?php echo($tel_casa_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tel. Celular: </b><?php echo($tel_movil_deudor);?></p></td>            
            <td colspan="4" width="336"><p><b>Correo electr&oacute;nico: </b><?php echo($email_deudor);?></p></td>            
        </tr>  
        <tr>
            <td colspan="5" width="400"><p><b>Actividad Econ&oacute;mica: </b><?php echo($actividad_economica_deudor);?></p></td>
            <td colspan="3" width="252"><p><b>Ingreso al mes: </b><?php echo($ingreso_mensual_deudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="3" width="252"><p><b>Nombre Empresa: </b><?php echo($nombre_empresa_deudor);?></p></td>                                   
            <td colspan="3" width="252"><p><b>Direcci&oacute;n: </b><?php echo($direccion_empresa_deudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Tel. Labora: </b><?php echo($telefono_empresa_deudor );?></p></td>
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Tipo Vehiculo: </b> <?php echo($tipo_vehiculo_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Placa: </b> <?php echo($placa_vehiculo_deudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Marca: </b><?php echo($marca_vehiculo_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Modelo: </b><?php echo($modelo_vehiculo_deudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Ref. Familiar: </b> <?php echo($nom_ref_familiar_uno_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b> <?php echo($tel_ref_familiar_uno_deudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Ref. Familiar: </b><?php echo($nom_ref_familiar_dos_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b><?php echo($tel_ref_familiar_dos_deudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Ref. Personal: </b> <?php echo($nom_ref_personal_uno_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b> <?php echo($tel_ref_personal_uno_deudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Ref. Personal: </b><?php echo($nom_ref_personal_dos_deudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b><?php echo($tel_ref_personal_dos_deudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="3" width="252"><p><b>Env&iacute;o Notificaci&oacute;n </b>
            <?php if($noti_direccion_deudor == 1){echo('Direcci&oacute;n');}?>    
            <?php if($noti_correo_deudor == 1){echo('Correo');}?>    
            </p></td>    
        </tr>
    </table>
    <br/>
    
    <table class='tabla_info' style="margin-left:60px;" >        
        <tr>
            <th style="text-align: center;" colspan="8"><b>INFORMACI&Oacute;N DEL CODEUDOR</b></th>
        </tr>        
        <tr>
            <td colspan="3" width="252"><p><b>Nombres: </b><?php echo($nombre_codeudor." ".$apellido_codeudor);?></p></td>                       
            <td colspan="3" width="252"><p><b>Tipo de Documento: </b><?php echo($tipo_documento_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Num Documento:</b><?php echo($documento_codeudor);?></p></td>
        </tr>
        <tr>
            <td colspan="4" width="336"><p><b>Direcci&oacute;n Residencia : </b><?php echo($direccion_residencia_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Fecha de Nacimiento: </b><?php echo($fecha_nacimiento_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Edad: </b><?php echo($edad_codeudor);?></p></td>
        </tr>        
        <tr>
            
        </tr>
        <tr>
            <td colspan="4" width="336"><p><b>Barrio de Residencia: </b><?php echo($barrio_residencia_codeudor);?></p></td>
            <td colspan="4" width="336"><p><b>Ciudad de Residencia: </b><?php echo($ciudad_residencia_codeudor);?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Tel. Casa: </b><?php echo($tel_casa_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tel. Celular: </b><?php echo($tel_movil_codeudor);?></p></td>            
            <td colspan="4" width="336"><p><b>Correo electr&oacute;nico: </b><?php echo($email_codeudor);?></p></td>            
        </tr>  
        <tr>
            <td colspan="5" width="400"><p><b>Actividad Econ&oacute;mica: </b><?php echo($actividad_economica_codeudor);?></p></td>
            <td colspan="3" width="252"><p><b>Ingreso al mes: </b><?php echo($ingreso_mensual_codeudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="3" width="252"><p><b>Nombre Empresa: </b><?php echo($nombre_empresa_codeudor);?></p></td>                                   
            <td colspan="3" width="252"><p><b>Direcci&oacute;n: </b><?php echo($direccion_empresa_codeudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Tel. Labora: </b><?php echo($telefono_empresa_codeudor );?></p></td>
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Tipo Vehiculo: </b> <?php echo($tipo_vehiculo_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Placa: </b> <?php echo($placa_vehiculo_codeudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Marca: </b><?php echo($marca_vehiculo_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Modelo: </b><?php echo($modelo_vehiculo_codeudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Ref. Familiar: </b> <?php echo($nom_ref_familiar_uno_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b> <?php echo($tel_ref_familiar_uno_codeudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Ref. Familiar: </b><?php echo($nom_ref_familiar_dos_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b><?php echo($tel_ref_familiar_dos_codeudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="2" width="168"><p><b>Ref. Personal: </b> <?php echo($nom_ref_personal_uno_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b> <?php echo($tel_ref_personal_uno_codeudor );?></p></td>            
            <td colspan="2" width="168"><p><b>Ref. Personal: </b><?php echo($nom_ref_personal_dos_codeudor);?></p></td>
            <td colspan="2" width="168"><p><b>Tels: </b><?php echo($tel_ref_personal_dos_codeudor );?></p></td>            
        </tr>
        <tr>
            <td colspan="3" width="252"><p><b>Env&iacute;o Notificaci&oacute;n </b>
            <?php if($noti_direccion_codeudor == 1){echo('Direcci&oacute;n');}?>    
            <?php if($noti_correo_codeudor == 1){echo('Correo');}?>    
            </p></td>    
        </tr>
    </table>
    
    <br />
    
    <table class='tabla_info_firma' style="margin-left:60px;" >        
        <tr>
            <td width="130" valign='top'>
                <p>
                <b>Firma Deudor</b> 
                <br /><br /><br /><br />
                <br /><br /><br />
                <b>Nombre: </b><br/>
                <?php echo($nombre_deudor." ".$apellido_deudor);?><br/>
                <b>C.C: </b><?php echo($documento_deudor);?>
                </p>
            </td>
            <td width="60" valign='top'><b>Huella</b></td>
            <td width="130" valign='top'>
                <p>
                <b>Firma Codeudor</b> 
                <br /><br /><br /><br />
                <br /><br /><br />
                <b>Nombre: </b><br/>
                <?php echo($nombre_codeudor." ".$apellido_codeudor);?> <br/>
                <b>C.C: </b> <?php echo($documento_codeudor);?>
                </p>
            </td>
            <td width="60" valign='top'><b>Huella</b></td>
            <td width="205" valign='top'>
                <b>Credito Aprobado <img src="../imagenes/huella.png" alt="Logo INCAD" width="18" ></b> 
                <b>No Aprobado <img src="../imagenes/huella.png" alt="Logo INCAD" width="18" ></b> 
                <br /><br /><br /><br />
                <br /><br /><br />
                <b>Firma Gerente: </b>                
            </td>
        </tr>        
        
    </table>
    
    
        
    
</page>
