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
$tabla_formatos = $dbformatos->getFomato(7);
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
$programa_incad = $tabla_registro['nom_id_programa'];
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
    $documento_firma= '';
}else{
    $nombre_firma= $nombre_persona." ".$apellido_persona;
    $documento_firma= $detalle_tipo_doc['codigo_detalle'].". ".$documento_persona;
}





?>
<page>
    
    <table border='1' style="text-align: center; margin-left:65px;" >        
        <tr>
            <td rowspan="3" width="150"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td width="370"><p><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></p></td>
            <td width="100"><p><b>CODIGO: <?php echo($codigo_formato);?></b></p></td>
        </tr>
        <tr>
            <td><b>REGISTRO Y CONTROL</b></td>
            <td><b>VERSIÓN: <?php echo($version_formato);?></b></td>
        </tr>
        <tr>
            <td width="370"><p><b><?php echo($nombre_formato);?></b></p></td>
            <td><b>FECHA: <?php echo($fecha_formato);?></b></td>
        </tr>
    </table>
    <br />    
    
    
	 <table border='0' style="margin-left:30px;">        
        <tr>            
            <td width="30">&nbsp;</td>
            <td width="640">
            <p class="parrafo_text_1" style="text-align:center;"><b>CONTRATO ORDEN DE SUMININSTROS DE SERVICIO EDUCATIVO BACHILLER</b></p>    
            </td>
        </tr>               
    </table>
	<br />    <br />    
    <table border='0' style="margin-left:30px;">        
        <tr>            
            <td width="30">&nbsp;</td>
            <td width="640">
            <p class="parrafo_text_1">Entre los suscritos la Entidad Educativa <b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS S.A.S</b> con <b>NIT 900.567.627-6</b> y en su nombre <b>OLGA LUCIA FORERO MEJIA</b> identificada con cédula de ciudadanía <b>63.365.475 de Bucaramanga</b>  quien obrará como representante legal de dicha Institución Educativa, y la persona natural estudiante o acudiente abajo firmante y cuyos datos se registran en la presente orden de suministro de servicio Educativo, se ha convenido celebrar el siguiente <b>CONTRATO ORDEN DE SUMINISTRO DE SERVICIO EDUCATIVO</b>, el cual  se  regirá  por  las  normas  del  contrato  de  suministro  regulado  por el título III del Código de Comercio así como las demás normas concordantes y en especial por las siguientes clausulas. <b>OBLIGACIONES DE INCAD.</b> <b>1.</b> Cumplir con la intensidad horaria requerida para cada programa. <b>2.</b> Programar charlas, salidas extra clase a campo donde fuese necesario, y cualquier tipo de actividades extra curriculares que beneficien el proceso de aprendizaje. 3. Colocar al servicio de los estudiantes en el proceso de aprendizaje, docentes seminaristas y tutores idóneos de acuerdo a criterios del INCAD. 4. Entregar recibo de constancia de cualquier pago hecho por el estudiante entendiéndose este como documento legal necesario en caso de cualquier reclamación. <b>5.</b> Informar a los estudiantes previamente de cualquier actividad programada mediante el cronograma de actividades de cada semestre educativo y en caso de ser una actividad extra se informará de manera directa, en cartelera y dado el caso por algún medio de comunicación masiva. <b>6</b>. Suspender al estudiante que no cumpla con  la financiación acordada del pago de matrícula hasta tanto dicho pago sea realizado, sin que la institución se haga responsable por los temas académicos dejados de ver por el estudiante en mora, debiendo presentar dicho estudiante en mora trabajos y ser evaluados por los docentes respectivos por no ser presentados a tiempo por dicho motivo, teniendo la discrecionalidad el docente respectivo previa autorización administrativa de la persona encargada para tal fin por INCAD. <b>7</b>. Aplicar sanciones respectivas cuando se requieran según manual de convivencia. <b>8.</b> No se hará devoluciones de dinero en ningún caso a pesar de no continuar sus estudios con la Institución PARÁGRAFO: El estudiante podrá aplazar, ceder o vender su cupo y las obligaciones económicas contraídas con Instituto Incad S.A.S, por el estudiante serán de obligatorio cumplimiento.  <b>9.</b>  Dar cumplimiento al Manual de Convivencia que se encuentra publicado en los canales de información utilizados por el instituto. <br /> <b>OBLIGACIONES DE LOS ESTUDIANTES O ACUDIENTES.</b> <b>1.</b> Cancelar oportunamente el valor del programa: <b><?php echo($programa_incad); ?></b>,  <b><?php echo($valor_neto_pagar_letras); ?></b> , <b>$<?php echo($valor_neto_pagar); ?></b> ; en caso de haber sido aprobada la financiación por parte de Instituto Incad S.A.S, se obliga a cancelar las cuotas en las fechas pactadas. <b>2.</b>  Portar el uniforme en los horarios de clase respectivos y abstenerse de hacerlo en eventos que no tengan nada que ver con la formación académica. <b>3.</b> Cumplir con los horarios respectivos de las horas de clase, eventos y actividades programadas <b>4.</b> Cumplir con todas las normas disciplinarias y en concordancia con la convivencia y respeto con todos los estamentos que conforman el instituto INCAD (estudiantes, Docentes, Administrativos y Directivos) <b>5.</b>  Solicitar Paz y Salvo en Tesorería, Documentación, y Académicamente con antelación y previo a la graduación respectiva, máximo con quince días de anticipación a la entrega a la clausura el programa. <b>6.</b> Cumplir con todo lo estipulado en el Manual de Convivencia.</p>    
            </td>
        </tr>               
    </table>
    <br />    <br />    
     <table class="tabla_info" border='0' style="margin-left:30px;">        
        <tr>
            <td width="10">&nbsp;</td>
            <td><b>Nombre Alumno o Acudiente: </b></td>
            <td width="250"><b><?php echo($nombre_firma);?> </b> </td>
            <td rowspan="3"><img src="../imagenes/huella.png" alt="Logo INCAD" width="100" ></td>
        </tr>        
	    <tr>
            <td width="10">&nbsp;</td>
            <td><b>Identificación: </b> </td>
            <td width="250"><b><?php echo($documento_firma);?></b> </td>
        </tr> 
        <tr>
            <td width="10">&nbsp;</td>
            <td><b>Firma:</b> </td>
            <td>
            <p>_________________________________________</p>      
            </td>
        </tr> 
       
    </table>
    <br />
    
     <table class="tabla_info" border='0' style="margin-left:30px;">        
        <tr>
            <td width="10">&nbsp;</td>
            <td><b>Firma del representante Legal:</b> </td>
            <td>
            <p>_________________________________________</p>      
            </td>
        </tr> 
       
    </table>
    <br />    
    <table class="tabla_info" border='0' style="margin-left:30px;">        
        <tr>
            <td width="10">&nbsp;</td>
            <td><b>Fecha:</b> </td>
            <td><b><?php echo($fecha_inscripcion);?> </b> </td>
            
        </tr>        
    </table>
    
    
    
        
    
</page>
