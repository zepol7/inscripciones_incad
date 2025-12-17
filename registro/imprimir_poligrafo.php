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
    font-size: 12px;
    line-height: 100%;
    text-align: justify;
    line-height: 16px;
}


.td_color_red{
    color: #FF0000;    
}

.td_color_blue{
    color: #0000FF;    
}


.titulo_encabezado{
    font-family: Arial;
    font-size: 18px;    
}

.sub_titulo_encabezado{
    font-family: Arial;    
    font-size: 15px;    
}

.fondo_pagina{

}

body {
  /*background-image: url("../imagenes/hoja_cotizador.jpg");*/
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
require_once("../db/DbCotizador.php");

$variables = new Dbvariables();
$equipos = new DbEquipo();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbPerfiles = new DbPerfiles();
$dbRegistroPersonas = new DbRegistroPersonas();
$dbCotizador = new DbCotizador();

//Busca por el registro medico de la seleccionada
/*
$id_programa = $_GET['id_programa'];
$jornada = $_GET['jornada'];
$calendario_academico = $_GET['calendario_academico'];
$tabla_programa = $dbListas->getItemListaDetalleEditable($id_programa);
$tabla_jornada = $dbListas->getItemListaDetalleEditable($jornada);
$tabla_calendario = $dbListas->getItemListaDetalleEditable($calendario_academico);
$nombre_programa = $tabla_programa['nombre_lista_editable_detalle'];
$nombre_jornada = $tabla_jornada['nombre_lista_editable_detalle'];
$nombre_calendario = $tabla_calendario['nombre_lista_editable_detalle'];
*/

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


$nombre_programa = $tabla_registro['nom_id_programa'];
$nombre_jornada = $tabla_registro['nom_jornada'];
$nombre_calendario = $tabla_registro['nom_calendario_academico'];
$id_programa = $tabla_registro['id_programa'];


$nom_resolucion_programa = $tabla_registro['nom_resolucion_programa'];


$nom_fecha_inicio = $tabla_registro['nom_fecha_inicio'];
$nom_fecha_terminacion = $tabla_registro['nom_fecha_terminacion'];



$valor_programa = number_format($tabla_registro['valor_programa'], 0, '', '.'); 
$fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];

$tabla_modulos = $dbListas->getListaModulos_Programa($id_programa);


$tabla_forma_pago = $dbListas->getListaFormasPago();



//style="margin-left:-40px; margin-top:-35px;"
//width="130" 
?>
    <!--<page backimg="../imagenes/hoja_cotizador.jpg" >-->
<page>
    
    	<br />
    <table border='1' style="text-align: center; font-size:25px; margin-left:55px;" >
        <tr>
            <td colspan="3" width="600"> <b class='titulo_encabezado'>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></td>
        </tr>
        <tr>
            <td rowspan="8" width="400"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="140" ></td>
            <td colspan="2"><b class='titulo_encabezado'> FORMULARIO DE MATRICULA</b> </td>            
        </tr>
        <tr>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'>PROGRAMA</b></td>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'><?php echo($nombre_programa);?></b></td>
        </tr>
        <tr>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'>RESOLUCIÓN</b></td>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'><?php echo($nom_resolucion_programa);?></b></td>
        </tr>
        <tr>
            <td width="300" style="text-align: left;"><b class='sub_titulo_encabezado'>JORNADA</b></td>
            <td width="300" style="text-align: left;"><b class='sub_titulo_encabezado'><?php echo($nombre_jornada);?></b></td>
        </tr>        
        <tr>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'>Fecha Inicio: <?php echo($nom_fecha_inicio);?></b></td>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'>Fecha Terminación: <?php echo($nom_fecha_terminacion);?></b></td>            
        </tr>      
        <tr>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'>CALENDARIO</b></td>
            <td style="text-align: left;"><b class='sub_titulo_encabezado'><?php echo($nombre_calendario);?></b></td>
        </tr>
    </table>
    
    <br />    
    
    <table class='tabla_info' style="margin-left:55px; font-size:18px;">        
        <tr>
            <th style="text-align: center;" colspan="3"><b>DATOS PERSONALES</b></th>
        </tr>        
        <tr>
            <td colspan="3"><p><b>Nombre del Estudiante: </b><?php echo($nombre_persona." ".$apellido_persona);?></p></td>
            
        </tr>
        <tr>
            <td width="310"><p><b>Tipo de Documento: </b> <?php echo($tipo_documento);?></p></td>
            <td width="310"><p><b>N&uacute;mero de Documento: </b><?php echo($documento_persona);?></p></td>
            <td width="315"><p><b>Fecha de Expedici&oacute;n: </b><?php echo($fecha_documento);?></p></td>
        </tr>  
        <tr>
            <td colspan="2" ><p><b>Valor del Programa: </b> <?php echo($valor_programa);?></p></td>
            <td ><p><b>Fecha de Inscripci&oacute;n: </b> <?php echo($fecha_inscripcion);?></p></td>
        </tr>  
    </table>
    
    <br />    
    
    <table border='1'  style="text-align: center; font-size:18px; margin-left:55px;">        
    <tr>
        <th style="text-align: center;" colspan="2"><b>MODULOS DEL PROGRAMA</b></th>
    </tr> 
    <tr>
        <th style="text-align: center;" ><b>CÓDIGO</b></th>
        <th style="text-align: center;" ><b>NOMBRE</b></th>
    </tr> 
    
    <?php
    foreach ($tabla_modulos as $fila_modulos){
        
        $codigo_modulo = $fila_modulos['codigo_lista_editable_detalle'];
        $nombre_modulo = $fila_modulos['nombre_lista_editable_detalle'];
    ?>    
        <tr>
            <td width="200" style="text-align: left;"><p><b><?php echo($codigo_modulo);?></b></p></td>
            <td width="800" style="text-align: left;"><p><b><?php echo($nombre_modulo);?></b></p></td>            
        </tr>
        
    <?php    
    }        
    ?>
    
    </table>
    <br />    
    
    <table border='0'  style="text-align: left; font-size:14px; margin-left:55px;">        
    <?php
    foreach ($tabla_forma_pago as $fila_forma_pago){
        
        $forma_pago = $fila_forma_pago['nombre_lista_editable_detalle'];
        
        ?>
        <tr>
            <td width="1000" ><p><b><?php echo($forma_pago);?></b></p></td>            
        </tr>
        <?php
    }        
    ?>    
    </table>
    <br />        
        
    
    
    

     
     
    

    
        
    
</page>
