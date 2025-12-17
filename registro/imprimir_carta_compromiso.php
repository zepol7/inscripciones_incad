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
    width: 50%;
    font-family: Arial; 
    font-size: 15px;
    line-height: 100%;
    text-align: justify;
    line-height: 22px;
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
$tabla_formatos = $dbformatos->getFomato(11);
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


//$nombre_persona." ".$apellido_persona


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
$valor_neto_pagar_letras = numtoletras($tabla_registro['valor_neto_pagar']);

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

$tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($fecha_nacimiento, $fecha_inscripcion);
$edad_anios = $tabla_edad_persona['anios'];



if($edad_anios<18){
    $nombre_firma= $nombre_acudiente;
    $documento_firma= '_______________';
    $lugar_documento = '________________';
}else{
    $nombre_firma= $nombre_persona." ".$apellido_persona;
    $documento_firma= $detalle_tipo_doc['codigo_detalle'].". ".$documento_persona;
    $lugar_documento = $lugar_documento;
}





/*if($edad_anios<18){
    $nombre_firma= $nombre_acudiente;
    $documento_firma= '';
}else{
    $nombre_firma= $nombre_persona." ".$apellido_persona;
    $documento_firma= $documento_persona;
}*/


//Establecer la información local en castellano de España

    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   

?>
<page backimg="../imagenes/Fondo_carta.png">
    
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
    
    <table border='0' style="margin-left:30px; margin-top:50px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Bucaramanga, <?php echo($day_now);?> de <?php echo($months[$month_now]);?> del  <?php echo($year_now);?> </p>    
            </td>
        </tr>               
    </table>
    
    <table border='0' style="margin-left:30px; margin-top:70px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Señores</p>    
            </td>
        </tr>               
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1"><b>INSTITUTO INCAD</b></p>    
            </td>
        </tr>               
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Ciudad</p>    
            </td>
        </tr>               
    </table>
    
    <table border='0' style="margin-top:30px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="text-align: right;"><b>Ref: Carta de Compromiso</b></p>    
            </td>
        </tr>                                     
    </table>  
    
    <table border='0' style="margin-left:30px; margin-top:30px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Yo <b><?php echo($nombre_firma);?></b> con documento de identidad No. <b><?php echo($documento_firma);?></b> de <b><?php echo($lugar_documento);?></b>; me comprometo a entregar o firmar los documentos pendientes para la legalización de matrícula, para poder formalizar y legalizar, quedo pendiente:</p>    
            </td>
        </tr>
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="margin-top:10px;">1. _________________________________________________________________________</p>    
            </td>
        </tr>
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="margin-top:10px;">2. _________________________________________________________________________</p>    
            </td>
        </tr>
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="margin-top:10px;">3. _________________________________________________________________________</p>    
            </td>
        </tr>
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="margin-top:10px;">4. _________________________________________________________________________</p>    
            </td>
        </tr>
    </table>
    
    
    <table border='0' style="margin-left:30px; margin-top:40px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Es mi compromiso que los pendientes queden completamente legalizados el día_____de mes de_________________del año 2.0_____</p>    
            </td>
        </tr>               
    </table>
    
    
    
    <br />   
     <table class="tabla_info" border='0' style="margin-left:45px; margin-top:90px;">        
        <tr>
            <td width="10">&nbsp;</td>
            <td style="padding: 20px 0 0 0;"><b>En constancia de lo anterior, firmo:</b> </td>            
        </tr> 
        <tr>
            <td width="10">&nbsp;</td>
            <td style="padding: 50px 0 0 0;"><p>_________________________________________</p></td>
        </tr>
        <tr>
            <td width="10">&nbsp;</td>
            <td style="padding: 10px 0 0 0;"><p>CC:</p></td>
        </tr>
        
       
    </table>
    <br />
    
     
    
    
        
    
</page>
