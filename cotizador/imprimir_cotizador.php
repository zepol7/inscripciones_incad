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

.fondo_pagina{

}

body {
  background-image: url("../imagenes/hoja_cotizador.jpg");
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
$tabla_cotizador = $dbCotizador->getCotizador($_GET['id_cotizador']);


$descripcion = $tabla_cotizador['descripcion'];
$precio = $tabla_cotizador['precio'];
$duracion = $tabla_cotizador['duracion'];
$horario = $tabla_cotizador['horario'];
$forma_pago = $tabla_cotizador['forma_pago'];
$requisitos = $tabla_cotizador['requisitos'];

$nombre_programa = $tabla_cotizador['nombre_programa'];

$nombre_completo = $tabla_cotizador['nombre_completo'];
$fecha_cotizador = $tabla_cotizador['fecha_cotizador'];

$email_persona = $tabla_cotizador['email_persona'];
$observaciones_cotiza = $tabla_cotizador['observaciones_cotiza'];



//style="margin-left:-40px; margin-top:-35px;"
//width="130" 
?>
    <!--<page backimg="../imagenes/hoja_cotizador.jpg" >-->
<page backimg="../imagenes/hoja_cotizador.jpg">
    <table border='0' style="margin-left:10px; margin-top:250px;">        
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1"><b>Programa: </b><?php echo($nombre_programa);?><br /></p>    
            </td>
        </tr>  
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1"><b>Nombre: </b><?php echo($nombre_completo);?><br /></p>    
            </td>
        </tr>  
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1"><b>Fecha: </b><?php echo($fecha_cotizador);?><br /></p>    
            </td>
        </tr>  
        <tr><td colspan="2">&nbsp;</td></tr>        
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Descripci&oacute;n:</b><br />
            <?php echo nl2br($descripcion);?>
            </p>    
            </td>
        </tr>  
        <tr><td colspan="2"><br /></td></tr>
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Requisitos:</b><br />
            <?php echo nl2br($requisitos);?>
            </p>    
            </td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Precio:</b><br />
            <?php echo nl2br($precio);?>
            </p>    
            </td>
        </tr>  
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Forma pago:</b><br />
            <?php echo nl2br($forma_pago);?>
            </p>    
            </td>
        </tr>  
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Horario disponible de estudio:</b><br />
            <?php echo nl2br($horario);?>
            </p>    
            </td>
        </tr>  
        
        <?php
        if($observaciones_cotiza <> ""){
        ?>
        <tr><td colspan="2"><br /></td></tr>           
        <tr>            
            <td width="10">&nbsp;</td>
            <td width="700">
            <p class="parrafo_text_1">
            <b>Observaciones:</b><br />
            <?php echo nl2br($observaciones_cotiza);?>
            </p>    
            </td>
        </tr>  
        <?php
        }
        ?>
        
        
        
        
        
        
    </table>    
       

     
     
    

    
        
    
</page>
