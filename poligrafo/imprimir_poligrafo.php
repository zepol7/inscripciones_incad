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

$id_programa = $_GET['id_programa'];
$jornada = $_GET['jornada'];
$calendario_academico = $_GET['calendario_academico'];


$tabla_programa = $dbListas->getItemListaDetalleEditable($id_programa);
$tabla_jornada = $dbListas->getItemListaDetalleEditable($jornada);
$tabla_calendario = $dbListas->getItemListaDetalleEditable($calendario_academico);


$nombre_programa = $tabla_programa['nombre_lista_editable_detalle'];
$nombre_jornada = $tabla_jornada['nombre_lista_editable_detalle'];
$nombre_calendario = $tabla_calendario['nombre_lista_editable_detalle'];


$tabla_modulos = $dbListas->getListaModulos_Programa($id_programa);



//style="margin-left:-40px; margin-top:-35px;"
//width="130" 
?>
    <!--<page backimg="../imagenes/hoja_cotizador.jpg" >-->
<page>
    
    	<br />
    <table border='1' style="text-align: center; font-size:25px; margin-left:55px;" >        
        <tr>
            <td rowspan="4" width="400"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="140" ></td>
            <td colspan="2"><b class='titulo_encabezado'> INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b> </td>            
        </tr>
        <tr>
            <td><b class='sub_titulo_encabezado'>PROGRAMA</b></td>
            <td><b class='sub_titulo_encabezado'><?php echo($nombre_programa);?></b></td>
        </tr>
        <tr>
            <td width="300"><b class='sub_titulo_encabezado'>JORNADA</b></td>
            <td width="300"><b class='sub_titulo_encabezado'><?php echo($nombre_jornada);?></b></td>
        </tr>
        <tr>
            <td><b class='sub_titulo_encabezado'>CALENDARIO</b></td>
            <td><b class='sub_titulo_encabezado'><?php echo($nombre_calendario);?></b></td>
        </tr>
    </table>
    <br />    
    <br />    
    <br />    
    
    
    <table border='1'  style="text-align: center; font-size:20px; margin-left:55px;">        
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
    
    

     
     
    

    
        
    
</page>
