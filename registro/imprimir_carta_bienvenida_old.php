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

.fondo_pagina{
    background-image: url("../imagenes/Fondo_carta.png");    
    background-color: #ffdd90;
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

$variables = new Dbvariables();
$equipos = new DbEquipo();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbPerfiles = new DbPerfiles();
$dbRegistroPersonas = new DbRegistroPersonas();
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
//$fecha_mensula_pago = $tabla_registro['format_fecha_mensula_pago'];

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


//Establecer la información local en castellano de España

    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   

?>
    <page backimg="../imagenes/Fondo_carta.png" >
    
    
    <table border='0' style="margin-left:30px; margin-top:150px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Bucaramanga, <?php echo($day_now);?> de <?php echo($months[$month_now]);?> del  <?php echo($year_now);?> </p>    
            </td>
        </tr>               
    </table>
    
    <table border='0' style="margin-left:30px; margin-top:60px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Señores</p>    
            </td>
        </tr>               
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1"><b><?php echo($nombre_firma);?></b></p>    
            </td>
        </tr>               
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Ciudad</p>    
            </td>
        </tr>               
    </table>
    
    <table border='0' style="margin-left:30px; margin-top:50px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">En nombre del INSTITUTO INCAD S.A.S, Nos permitimos darle un saludo de Bienvenida y comunicarles, que siempre estaremos comprometidos y dispuestos a ofrecer nuestras instalaciones, equipos y recurso humano, para cumplir con la formación académica integral ofrecida a nuestros estudiantes y docentes.</p>    
            </td>
        </tr>        
    </table>    
    <table border='0' style="margin-left:30px; margin-top:40px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Por lo anterior queremos recordarles, que si alguno de los estudiantes no puede continuar asistiendo a clases, o se retira este deberá seguir cumpliendo con el pago total de la obligación por concepto de matrícula del programa, cancelando la deuda económica adquirida con la entidad financiera autorizada o con el INCAD directamente.</p>    
            </td>
        </tr>        
    </table>    
    <table border='0' style="margin-left:30px; margin-top:40px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Una vez se matricule el Estudiante al INSTITUTO INCAD S.A.S, no reembolsa en ningún caso, el valor total o parcial cancelado de la matrícula del programa. Lo anterior, según lo dispuesto en el Artículo 34, parágrafo 2 del Reglamento Estudiantil.</p>    
            </td>
        </tr>        
    </table>    
    
    <table border='0' style="margin-left:30px; margin-top:40px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Atentamente,</p>    
            </td>
        </tr>               
    </table>
    
    
    
    <br />    <br />    <br />    
     <table class="tabla_info" border='0' style="margin-left:45px; margin-top:10    0px;">        
        
        <tr>
            <td width="10">&nbsp;</td>
            <td width="280">________________________________</td>
            <td width="280">________________________________</td>
        </tr>   
        <tr>
            <td width="10">&nbsp;</td>
            <td width="280"><b>OLGA LUCIA FORERO MEJIA</b></td>
            <td width="280"><b>ACEPTO: <?php echo($nombre_firma);?></b> </td>
        </tr>        
	    <tr>
            <td width="10">&nbsp;</td>
            <td width="280">Representante Legal</td>
            <td width="280"><b><?php echo($documento_firma);?></b> </td>
        </tr>         
       
    </table>
    <br />
    
     
    

    
        
    
</page>
