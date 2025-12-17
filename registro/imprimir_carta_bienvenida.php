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
$tabla_formatos = $dbformatos->getFomato(12);
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

$unidad_negocio = $tabla_registro['unidad_negocio'];


switch ($unidad_negocio) {
   case 1:         
    $sub_titulo="Ref. CARTA DE BIENVENIDA BACHILLERATO";
    $tipo_carta = 1;   
   break;    
   case 2:
    $sub_titulo="Ref. CARTA DE BIENVENIDA TECNICO";   
    $tipo_carta = 2;      
   break;    
   case 3:    
     $sub_titulo="Ref. CARTA DE BIENVENIDA BACHILLERATO";    
     $tipo_carta = 1;  
   break;
   case 41:
    $sub_titulo="Ref. CARTA DE BIENVENIDA TECNICO";   
    $tipo_carta = 2;      
   break;     
   
}




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
    
    
    <table border='0' style="margin-left:30px; margin-top:150px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Bucaramanga, <?php echo($day_now);?> de <?php echo($months[$month_now]);?> del  <?php echo($year_now);?> </p>    
            </td>
        </tr>               
    </table>
    
    <table border='0' style="margin-left:30px; margin-top:40px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1">Señor (a)</p>    
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
        
    <table border='0' style="margin-top:30px;">        
        <tr>            
            <td width="50">&nbsp;</td>
            <td width="630">
            <p class="parrafo_text_1" style="text-align: right;"><b><?php echo($sub_titulo);?></b></p>    
            </td>
        </tr>                                     
    </table>      
        
        
    <?php
    //Cuerpo de la carta    
    if($tipo_carta == 1) //Bachillerato
    {
    ?>           
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">El INSTITUTO INCAD SAS, institución de educación con resoluciones de la secretaría de eduación vigente, le da la bienvenida y le ofrece un cordial y especial saludo de paz y bien</p>    
                </td>
            </tr>        
        </table>    
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">Queremos comunicarle que estamos comprometidos enel proceso de aprendizaje, por lo cual a partir de ahora el estudiante, tiene a disposición nuestra infraestructura y todos sus recursos, así como nuestro personal idoneo y capacitado para que pueda llevar a feliz término su grado de bachiller matriculado.</p>    
                </td>
            </tr>        
        </table>    
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">Igualmente recordarle que al firmar nuestro contrato de suministro de servicio educativo, en la clausula 8, claramente dejamos consignado que no hacemos devoluciones de dinero, en ningun caso, a pesar de no continuar por algunas circunstancia sus estudios.</p>    
                </td>
            </tr>        
        </table> 
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">De manera que al firmar dicho contrato, el crédito educativo y el plan de pagos, tiene un compromiso por el valor total pactado, el cual debe cancelar de forma puntual en las fechas establecidas. De no ser asi, la institución procederá de acuerdo a las políticas de cobro apobadas, para hacer efectivo el pago de las cuotas atrazadas o en su defecto el valor total del crédito pendiente.</p>    
                </td>
            </tr>        
        </table> 
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">Esperamos que la presencia suya y de ser el caso del menor matriculado en nuestra institución sea grata, productiva y con nuestro decidido apoyo pueda tener total éxito en lograr esta meta de graduarse como Bachiller Académico.</p>    
                </td>
            </tr>        
        </table>       

        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">Atentamente,</p>    
                </td>
            </tr>               
        </table>
        
    <?php    
    }
    else if($tipo_carta == 2) // Tecnico
    {
    ?>   
        <br />    <br />  
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1" style="font-size: 18px;">Cordial bienvenida a nuestra institución, nos alegra tenerle con nosotros, deseando que su estadía como estudiante INCADISTA sea grata y de beneficio para su aprendizaje y su vida.</p>    
                </td>
            </tr>        
        </table>    
        <br />    <br />  
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1" style="font-size: 18px;">Estamos comprometidos en su proceso de aprendizaje, por lo cual a partir de ahora, tiene a disposición nuestra infraestructura y todos sus recursos, así como nuestro personal idóneo y capacitado para que pueda llevar a feliz término su programa académico matriculado. </p>    
                </td>
            </tr>        
        </table>    
        <br />    <br />  
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1" style="font-size: 18px;">Igualmente recordarle que al firmar nuestro contrato de suministro de servicio educativo, en la cláusula 8, claramente dejamos consignado que no hacemos devoluciones de dinero, en ningún caso, a pesar de no continuar por algunas circunstancia sus estudios. Por lo tanto si tuviese algún motivo de fuerza mayor que le impida continuar, usted podrá académicamente aplazar o ceder su programa; sin embargo si tiene un crédito educativo pendientes con INCAD, tiene la obligación financiera de cumplir con las cuotas pactadas en el plan de pagos, de no ser así, la institución procederá de acuerdo a las políticas de cartera establecidas, para hacer efectivo el pago de las cuotas atrasadas o en su defecto el valor total del crédito pendiente.</p>    
                </td>
            </tr>        
        </table>
        <br />    <br />  <br />  <br />  
        <table border='0' style="margin-left:30px; margin-top:50px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1" style="font-size: 18px;">Por otra parte, su programa de formación matriculado,  como se indicó en la asesoría educativa, garantizamos práctica laboral a los 5 mejores estudiantes de cada grupo; para tener la oportunidad de ganarse uno de estos 5 cupos para prácticas, tenga en cuenta que se va a evaluar los siguiente aspectos, de forma transparente: 1) Puntualidad en la asistencia a clase. 2) Responsabilidad en la entrega de trabajos. 3) participación en clase. 4) Presentación personal. 5) Respeto con compañeros, docentes y personal Incad. 6) Promedio de notas de los módulos. En estos 6 aspectos se hace una valoración y un promedio ponderado el cual se hará público a todos los estudiantes.</p>    
                </td>
            </tr>        
        </table>
        <br />    <br />  
        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1" style="font-size: 18px;">Esperamos que su presencia como estudiante de nuestra institución sea grata y productiva, también junto con nuestro decidido apoyo pueda tener total éxito en lograr esta meta de estudiar, aprender y certificarse.</p>    
                </td>
            </tr>        
        </table>        
        <br />    <br />  <br />  

        <table border='0' style="margin-left:30px; margin-top:30px;">        
            <tr>            
                <td width="50">&nbsp;</td>
                <td width="630">
                <p class="parrafo_text_1">Atentamente,</p>    
                </td>
            </tr>               
        </table>
        
    <?php    
    }    
        
    
    ?>        
    
    <br />    <br />    <br />    
     <table class="tabla_info" border='0' style="margin-left:45px; margin-top:10    0px;">        
        
         
        <img style="margin-left:-40px; margin-top:-35px;" src="../imagenes/firma_olga.jpeg" alt="firma_olga" width="130" >
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
