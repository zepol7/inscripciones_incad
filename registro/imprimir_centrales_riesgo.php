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

.parrafo_text_1{
    
    font-family: Arial; 
    font-size: 16px;
    line-height: 22px;
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
include('FuncionNumeros.php');


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
$tabla_formatos = $dbformatos->getFomato(3);
$nombre_formato = $tabla_formatos['nombre_formato'];
$codigo_formato = $tabla_formatos['codigo_formato'];
$version_formato = $tabla_formatos['version_formato'];
$fecha_formato = $tabla_formatos['format_fecha_formato'];


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
$valor_programa_letras = numtoletras($tabla_registro['valor_programa']);
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



$tabla_credito = $dbRegistroPersonas->getCredito($_GET['id_credito']);

$id_credito = $tabla_credito['id_credito'];

$tipo_documento_deudor= $tabla_credito['nom_tipo_documento_deudor'];

$id_tipo_documento_deudor = $tabla_credito['tipo_documento_deudor'];
$cod_tipo_doc_deudor = $dbListas->getDetalle($id_tipo_documento_deudor);
$tipo_doc_deudor = $cod_tipo_doc_deudor['codigo_detalle'];

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

$id_tipo_documento_codeudor = $tabla_credito['tipo_documento_codeudor'];
$cod_tipo_doc_codeudor = $dbListas->getDetalle($id_tipo_documento_codeudor);
$tipo_doc_codeudor = $cod_tipo_doc_codeudor['codigo_detalle'];


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
$tipo_vehiculo_codeudor= $tabla_credito['nom_tipo_vehiculo_codeudor'];
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
$noti_correo_codeudor= $tabla_credito['noti_correo_codeudor'];



if($_GET['id_credito']>0){    
    $nombre_persona_1 = $nombre_deudor." ".$apellido_deudor;
    $documento_persona_1 = $tipo_doc_deudor.". ".$documento_deudor;
    $email_persona_1 = $email_deudor;    
}
else{
    $nombre_persona_1 = $nombre_persona." ".$apellido_persona;
    $documento_persona_1 = $detalle_tipo_doc['codigo_detalle'].". ".$documento_persona;
    $email_persona_1 = $email_persona;
}



?>
<page>
    
    <table border='1' style="text-align: center; font-size:12px; margin-left:70px;" >        
        <tr>
            <td rowspan="3" width="160"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td width="350"><p><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></p></td>
            <td width="100"><p><b>CODIGO: <?php echo($codigo_formato);?></b></p></td>
        </tr>
        <tr>
            <td><b>GESTI&Oacute;N COMERCIAL</b></td>
            <td><b>VERSIÓN: <?php echo($version_formato);?></b></td>
        </tr>
        <tr>
            <td width="350"><p><b><?php echo($nombre_formato);?></b></p></td>
            <td><b>FECHA: <?php echo($fecha_formato);?></b></td>
        </tr>
    </table>
    <br />    <br /> 
    <table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">***En nuestra calidad de titulares de información, actuando libre y voluntariamente, autorizamos de manera expresa e irrevocable a <b><?php echo($nombre_persona_1);?></b> o a quien represente sus derechos, a consultar, solicitar, suministrar, reportar, procesar, y divulgar toda información que se refiera a mi comportamiento crediticio, financiero, comercial, de servicios y de terceros países de la misma naturaleza a <b>las Centrales de Riesgo (DATACREDITO, CIFIN SA.)</b> o a quien represente sus derechos.</p>    
            </td>
        </tr>               
    </table>	
    <br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Conocemos que el alcance  de esta autorización implica que el comportamiento frente a nuestras obligaciones serán registradas con el objeto de suministrar información suficiente y adecuada al mercado sobre el estado de nuestras obligaciones financieras, comerciales, crediticias, de servicios y la proveniente de terceros países de la misma naturaleza. En consecuencia, quienes se encuentran afiliados y/o tengan acceso a la central de Información podrá ser igualmente utilizada para efectos estadísticos.</p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Nuestros derechos y obligaciones así como la permanencia de nuestra información en bases de datos corresponden a lo determinado por el ordenamiento jurídico aplicable del cual, por ser carácter público, estamos enterados. Así mismo, manifestamos conocer el contenido del reglamento de las Centrales de Riesgo <b>(DATACRÉDITO, CIFIN S.A.).</b></p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">En caso de que, en el futuro, los autorizados en este documento efectúen, a favor de un tercero, una venta de cartera o una cesión a cualquier título de las obligaciones a nuestro cargo, los efectos de la presente autorización se extenderán a este en los mismos términos y condiciones. Así mismo, autorizamos a las Centrales de Riesgo (DATACRÉDITO, CIFIN S.A.) o a quien represente sus derechos, a que, en su calidad de operador, ponga nuestra información a disposición de otros operadores nacionales o extranjeros., en los términos que establece la lay, siempre y cuando su objeto sea similar al aquí establecido.*</p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">*** De igual manera <b>AUTORIZO</b> para que dichas notificaciones así como las de cobro <b>PREJURIDICO Y JURIDICO</b> me sean enviadas a mi correo electrónico: <?php echo($email_persona_1);?> o por cualquier otro medio que esté ajustado a la ley.</p>    
            </td>
        </tr>               
    </table>
	<br />   <br />   <br />   
	
	
	
     <table class="tabla_info" border='0' style="margin-left:70px;">        
	<tr>
            <td width="285">            
            <p>____________________________________</p><br/>
            <b>Firma:</b>
            </td>
        </tr> 
        <tr>
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_persona_1);?></p></td>            
            
        </tr>        
        <tr>
            <td><p><b>Cedula: </b> <?php echo($documento_persona_1);?></p></td>
            
        </tr> 
        <tr>
            <td><p><b>Fecha: </b> <?php echo($fecha_inscripcion);?></p></td>
            
        </tr> 
        <tr>
            
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="90" ></td>
        </tr> 
       
    </table>
        
    
</page>


<?php
if($_GET['id_credito']>0){    
    $nombre_persona_2 = $nombre_codeudor." ".$apellido_codeudor;
    $documento_persona_2 = $tipo_doc_codeudor.". ".$documento_codeudor;
    $email_persona_2 = $email_codeudor;    
?>


<page>
    
    <table border='1' style="text-align: center; font-size:12px; margin-left:70px;" >        
        <tr>
            <td rowspan="3" width="160"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td width="350"><p><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></p></td>
            <td width="100"><p><b>CODIGO: <?php echo($codigo_formato);?></b></p></td>
        </tr>
        <tr>
            <td><b>GESTI&Oacute;N COMERCIAL</b></td>
            <td><b>VERSIÓN: <?php echo($version_formato);?></b></td>
        </tr>
        <tr>
            <td width="350"><p><b><?php echo($nombre_formato);?></b></p></td>
            <td><b>FECHA: <?php echo($fecha_formato);?></b></td>
        </tr>
    </table>
    <br />    <br /> 
    <table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">***En nuestra calidad de titulares de información, actuando libre y voluntariamente, autorizamos de manera expresa e irrevocable a <b><?php echo($nombre_persona_2);?></b> o a quien represente sus derechos, a consultar, solicitar, suministrar, reportar, procesar, y divulgar toda información que se refiera a mi comportamiento crediticio, financiero, comercial, de servicios y de terceros países de la misma naturaleza a <b>las Centrales de Riesgo (DATACREDITO, CIFIN SA.)</b> o a quien represente sus derechos.</p>    
            </td>
        </tr>               
    </table>	
    <br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Conocemos que el alcance  de esta autorización implica que el comportamiento frente a nuestras obligaciones serán registradas con el objeto de suministrar información suficiente y adecuada al mercado sobre el estado de nuestras obligaciones financieras, comerciales, crediticias, de servicios y la proveniente de terceros países de la misma naturaleza. En consecuencia, quienes se encuentran afiliados y/o tengan acceso a la central de Información podrá ser igualmente utilizada para efectos estadísticos.</p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Nuestros derechos y obligaciones así como la permanencia de nuestra información en bases de datos corresponden a lo determinado por el ordenamiento jurídico aplicable del cual, por ser carácter público, estamos enterados. Así mismo, manifestamos conocer el contenido del reglamento de las Centrales de Riesgo <b>(DATACRÉDITO, CIFIN S.A.).</b></p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">En caso de que, en el futuro, los autorizados en este documento efectúen, a favor de un tercero, una venta de cartera o una cesión a cualquier título de las obligaciones a nuestro cargo, los efectos de la presente autorización se extenderán a este en los mismos términos y condiciones. Así mismo, autorizamos a las Centrales de Riesgo (DATACRÉDITO, CIFIN S.A.) o a quien represente sus derechos, a que, en su calidad de operador, ponga nuestra información a disposición de otros operadores nacionales o extranjeros., en los términos que establece la lay, siempre y cuando su objeto sea similar al aquí establecido.*</p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:70px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">*** De igual manera <b>AUTORIZO</b> para que dichas notificaciones así como las de cobro <b>PREJURIDICO Y JURIDICO</b> me sean enviadas a mi correo electrónico: <?php echo($email_persona_2);?> o por cualquier otro medio que esté ajustado a la ley.</p>    
            </td>
        </tr>               
    </table>
	<br />   <br />   <br />   
	
	
	
     <table class="tabla_info" border='0' style="margin-left:70px;">        
        <tr>        
            <td width="285">            
            <p>____________________________________</p><br/>
            <b>Firma:</b>
            </td>
        </tr> 
        <tr>
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_persona_2);?></p></td>            
        </tr>        
        <tr>
            <td><p><b>Cedula: </b> <?php echo($documento_persona_2);?></p></td>
        </tr> 
        <tr>
            <td><p><b>Fecha: </b> <?php echo($fecha_inscripcion);?></p></td>            
        </tr> 
        <tr>
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="90" ></td>
        </tr> 
       
    </table>
        
    
</page>

    
<?php    
}
?>