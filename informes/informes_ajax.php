<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Generar_Clave.php");

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();

$combo = new Combo_Box();

$id_usuario = $_SESSION["idUsuario"];


if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "5" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}



switch ($opcion) {
    case "1": //Crear Registro
    
    	$combo = new Combo_Box();		
	$tipo_accion = 1; //Crear Regsitro
            
    break;
	
	
    case "2": 
		
            $fecha_inicial = $_POST["fecha_inicial"];
            $fecha_final = $_POST["fecha_final"];
			
			
            $tabla_registro = $dbRegistroPersonas->getRegistroPersona("0", $fecha_inicial, $fecha_final);
            $_SESSION["excel_tabla_registro"] = $tabla_registro;
            
	?>

        <div class="row">
        <div class="col-md-12">        
               
                <div class="panel-body">
                    
                
                <div class="row">
                    <div class="col-md-12 form-group">
                        <h3 style="text-align: center;">Descargar Reporte</h3>
                        <div class="img_descargar_excel" onclick="descargar_base();"></div>
                    </div>   
                     
                    <form id="form_xls_base" name="form_xls_base" method="post" action="informes_excel.php" style="display:none;" target="_blank"></form>
                </div>                        

                </div> 
            
        </div>
        </div>

        <?php
		
		    
		

    break;
	
	
	
	
	case "3": 
		 ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <?php
            @$titulo = $_POST["titulo"];
            @$funcion = $_POST["funcion"];
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                    </div>
                    <div class="modal-body centrar">

                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>;">Si</button>
                    </div>

                </div>
            </div>
        </div>
        <?php
    break;
	
	
		
		
	
	
	
	
	
}

?>