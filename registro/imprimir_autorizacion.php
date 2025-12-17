<link href="../css/estilos_1.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />  

<style type="text/css">

.tabla_info {
  border-top: black 1px solid;
  border-left: black 1px solid;
  border-right: black 1px solid;
  border-bottom: black 1px solid;  
  border-spacing: 5px;
  border-collapse: separate; 
  
  
}
.tabla_info td { 
    padding: 5px;
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
$tabla_formatos = $dbformatos->getFomato($id_formato);


//Busca por el registro medico de la seleccionada
$tabla_registro = $dbRegistroPersonas->getRegistroPersona($_GET['id_registro']);
$id_persona = $tabla_registro['id_persona'];
$tipo_documento = $tabla_registro['nom_tipo_documento'];

$id_tipo_documento = $tabla_registro['tipo_documento'];
$detalle_tipo_doc = $dbListas->getDetalle($id_tipo_documento);

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
$programa_incad = $tabla_registro['programa_incad'];
$jornada_incad = $tabla_registro['jornada_incad'];
$valor_programa = number_format($tabla_registro['valor_programa'], 0, '', '.'); 
$descuento = number_format($tabla_registro['descuento'], 0, '', '.'); 
$valor_neto_pagar = number_format($tabla_registro['valor_neto_pagar'], 0, '', '.'); 
$forma_pago = $tabla_registro['forma_pago'];
$registro_formas_pago = $dbRegistroPersonas->getListaFormasPago($id_academica);

$entidad_financiera = $tabla_registro['entidad_financiera'];
$cuota_inicial = number_format($tabla_registro['cuota_inicial'], 0, '', '.');
$valor_financiar = number_format($tabla_registro['valor_financiar'], 0, '', '.'); 
$num_cuotas = $tabla_registro['num_cuotas'];
$valor_cuota = number_format($tabla_registro['valor_cuota'], 0, '', '.'); 
$fecha_mensula_pago = $tabla_registro['format_fecha_mensula_pago'];

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
    <!--<td width="450" class="td_color_red" valign="bottom"><b>AUTORIZACI&Oacute;N PARA EL TRATAMIENTO DE DATOS</b></td>
    <td class="td_color_red" valign="top"><b>PERSONALES</b></td>-->
    <table border='0' style="width:100%; text-align: center; margin-left:45px; " >        
        <tr>            
            <td width="700"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="300" ></td>
        </tr>        
    </table>
    <br /><br />    
    
    <table border='0' style="margin-left:70px;">        
		<tr>            
        <td width="650">
			<p class="parrafo_titulo_1"><b>AUTORIZACI&Oacute;N PARA EL TRATAMIENTO DE DATOS PERSONALES</b></p>
		</td>
        </tr>    
		
        <tr>            
            <td width="650">
            <p class="parrafo_text_1">¿Autoriza usted al <b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS S.A.S.</b> para la recolección, almacenamiento y uso de sus datos personales con la finalidad de informarle sobre eventos organizados por esta Entidad relacionados con nuestras funciones, sobre los servicios que prestamos, las publicaciones que elaboramos y para solicitar que evalúe la calidad de nuestros servicios?</p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_1"><br /><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_1">Como Titular de información tiene derecho a conocer, actualizar y rectificar sus datos personales, solicitar prueba de la autorización otorgada para su tratamiento, ser informado sobre el uso que se ha dado a los mismos, presentar quejas ante el <b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS S.A.S.</b> por infracción a la ley 1581 de 2012, y sus Decretos reglamentarios 1377 de 2013 y 1074 de 2015, revocar la autorización y/o solicitar la supresión de sus datos en los casos en que sea procedente y acceder en forma gratuita a los mismos. <b>Para ejercer sus derechos puede enviar una comunicación al correo electrónico</b> <br /><b>secretaria.academica@incad.edu.co</b></p>    
            </td>
        </tr>
        <tr>            
            <td width="650">
            <p class="parrafo_text_1"><br /><br /></p>    
            </td>
        </tr>    
        <tr>            
            <td width="650">
            <p class="parrafo_text_1">EL <b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS S.A.S.</b> como Responsable del Tratamiento de la Información, tiene su ubicación como domicilio principal en la Calle 10 Nro. 22 - 77 Barrio La Universidad de Bucaramanga, Tel. 7-6713000, Teléfono Móvil 3183401921, correo electrónico <b>secretaria.academica@incad.edu.co</b> </p>    
            </td>
        </tr>        
    </table>
    
    <br /><br />    
    
    <table border='0' style="margin-left:70px;">        
        <tr>
            <td><img src="../imagenes/si_autorizo.png" alt="SI" width="80" ></td>
            <td width="200" class="td_color_blue" valign="middle"><b>&nbsp;&nbsp;SI Autorizo</b></td>
            
            <td><img src="../imagenes/no_autorizo.png" alt="SI" width="80" ></td>
            <td width="200" class="td_color_red" valign="middle"><b>&nbsp;&nbsp;NO Autorizo</b></td>
        </tr>     
    </table>
    <br /><br />    <br />
    
     <table class="tabla_info" border='0' style="width:100%; text-align: left;" >        
        <tr>
            <td width="50">&nbsp;</td>
            <td><b>FIRMA:</b></td>
            <td width="360"><b>___________________________________</b> </td>
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
            <td width="50">&nbsp;</td>
            <td><b>DATOS DE UBICACIÓN:</b> </td>
            <td width="400">
              <p><?php echo($direccion_casa." ".$tel_casa_persona." ".$tel_movil_persona." ".$email_persona);?></p>      
                
            </td>
        </tr> 
       
    </table>
    
</page>
