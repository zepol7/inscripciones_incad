<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../db/DbVariables.php");
require_once("../db/DbEquipos.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");




$variables = new Dbvariables();
$equipos = new DbEquipo();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbPerfiles = new DbPerfiles();



$tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);

//variables
$titulo = $variables->getVariable(1);

$lista_si_no = array();
$lista_si_no[0][0] = '1';
$lista_si_no[0][1] = 'SI';
$lista_si_no[1][0] = '0';
$lista_si_no[1][1] = 'NO';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo['valor_variable'];?></title>
        <link href="../css/estilos_1.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />      
    </head>
    <body>
    	
    	<!-- llamar_crear_registro();  -->
    	
        <?php
        $contenido->validar_seguridad(0);
        $contenido->cabecera_html();
		
		/*$id_lugar = $_SESSION["idLugarUsuario"];
		$tabla_nombre_lugar = $dbListas->getDetalle($id_lugar);
		$nombre_lugar = $tabla_nombre_lugar['nombre_detalle'];
		 */
		 $id_usuario = $_SESSION["idUsuario"];
		 $tabla_perfil_colegio = $dbPerfiles->getNombrePerfilColegio($id_usuario);
		 $nombre_colegio = $tabla_perfil_colegio['nombre_perfil'];
		 
		 if($nombre_colegio == ""){
			 $tabla_perfil_colegio = $dbPerfiles->getNombrePerfil($id_usuario);
			 $nombre_colegio = $tabla_perfil_colegio['nombre_perfil'];
		 }		 
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                    	<li><b><h3> <?php echo($nombre_colegio);?></h3></b></li>
                        <li>Formulario de Lista de Cheque de Documentos</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error' ></div>
                    <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito' ></div>
                </div>
            </div>
            
            
            <div class="row">
            	
            	<input type="hidden" value="" name="hdd_ip_publica" id="hdd_ip_publica" />
            	<input type="hidden" value="" name="hdd_ip_privada" id="hdd_ip_privada" />
            	
            	
            	<div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Buscar</div>
                        <div class="panel-body">                            
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="left inline">Documento de Identidad</label>
                                </div>
                                <div class="col-md-4">                   
                                    <input type="text" class="form-control" id="txt_busca_id" name="txt_busca_id" placeholder="Documento" onblur="trim_cadena(this);validar_documento_identidad_buscar();" >   
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="btn_crear_usuario" class="btn btn-default" onclick="buscar_registro_id();">Buscar</button>
                                    <!-- <button type="button" id="btn_crear_usuario" class="btn btn-primary" onclick="ver_todos_usuarios();">Ver todos</button>-->
                                    <?php
                                    if ($tipo_acceso_menu == 2) {
                                        ?>
                                        
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            	
            	<div class="col-md-12">
            		<div id="principal_registro"></div>
                        
                        <div id="principal_imprimir" style="display: none;"></div>
                        <div id="imprimir_pdf"></div>
                        
                        <form action="pdf.php" method=post name="form_imprimir" target="_blank">
                            <input type="hidden" name="contenido" id="contenido" value="">                        
                        </form>
		</div>
                
            </div>
        	
         </div>	
           
        

        <?php
        $contenido->footer();
        ?>

        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='chequeo.js'></script>
        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>        
    </body>
</html>
