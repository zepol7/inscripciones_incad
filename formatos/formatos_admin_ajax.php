<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber López - 16/09/2013
 */

require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../db/DbFormatos.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Utilidades.php");

$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
$dbFormatos = new DbFormatos();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
//$contenido->validar_seguridad(1);

if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "4" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}

switch ($opcion) {
    case "1": //Opcion para buscar usuarios
        
        $tabla_listas_formatos = $dbFormatos->getListaFormatos();        
        ?>
        <br />

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">

                    <div id="paginador" class="centrar">
                        <nav>
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>

                    <table class="table table-bordered paginated">
                        <thead>
                            <tr><th colspan='4' style="text-align: center;">Listado de formatos existentes</th></tr>
                            <tr>
                                <th style="width:40%;">Nombre</th>                                
                                <th style="width:10%;">C&oacute;digo</th>
                                <th style="width:10%;">Versi&oacute;n</th>
                                <th style="width:10%;">Fecha</th>                                
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_listas_formatos);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_listas_formatos as $fila_listado) {
                                
                                @$id = $fila_listado['id'];
                                @$nombre_formato = $fila_listado['nombre_formato'];
                                @$codigo_formato = $fila_listado['codigo_formato'];
                                @$version_formato = $fila_listado['version_formato'];
                                @$fecha_formato = $fila_listado['format_fecha_formato'];                             
                                
                                ?>
                                <tr style="cursor:pointer;" onclick="seleccionar_formato('<?php echo($id);?>');">
                                    <td align="left"><?php echo $nombre_formato; ?></td>
                                    <td align="left"><?php echo $codigo_formato; ?></td>
                                    <td align="left"><?php echo $version_formato; ?></td>
                                    <td align="left"><?php echo $fecha_formato; ?></td>
                                </tr>
                                <?php
                                $i = $i + 1;
                            }
                            
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="4">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                     
                    </table>
                </div>
            </div>
            
            <div class="col-md-12">
                    <div id="principal_formato_detalle" ></div>
                </div>
            
        </div>

        <br />
        <?php
        break;

    case "2": //Opcion para crear el formulario de crear usuarios
        $combo = new Combo_Box();
        
        $id_formato = $_POST['id_formato'];
        
        
        if($id_formato > 0) {                        
            
            $tipo_accion = 2; //Editar Lista
            $titulo_formulario = 'Editar Formato';     
            $tabla_formato = $dbFormatos->getFomato($id_formato);            
            @$id = $tabla_formato['id'];
            @$nombre_formato = $tabla_formato['nombre_formato'];
            @$codigo_formato = $tabla_formato['codigo_formato'];
            @$version_formato = $tabla_formato['version_formato'];
            @$fecha_formato = $tabla_formato['format_fecha_formato']; 
            
        }

        ?>        
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="text-align: center; font-size: 20px;"><b><?php echo $titulo_formulario; ?> <br /> <?php echo($nombre_formato);?></b></div>
                    <div class="panel-body">
                        <form id="frmCrearUsuario" name="frmCrearUsuario">
                            
                            <input type="hidden" name="id_formato" id="id_formato" value="<?php echo $id; ?>">
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre_formato" id="nombre_formato" placeholder="Nombre" value="<?php echo $nombre_formato; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                            </div>
                            
                            <div class="form-group">
                                <label>C&oacute;digo</label>
                                <input type="text" class="form-control" name="codigo_formato" id="codigo_formato" placeholder="Codigo" value="<?php echo $codigo_formato; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                            </div>
                            
                            <div class="form-group">
                                <label>Versi&oacute;n</label>
                                <input type="text" class="form-control" name="version_formato" id="version_formato" placeholder="Version" value="<?php echo $version_formato; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                            </div>
                            
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="text" class="form-control" name="fecha_formato" id="fecha_formato" placeholder="dd/mm/aaaa" value="<?php echo $fecha_formato;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                            </div>                                

                            <div class="centrar">
                                <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="volver_inicio();">Cancelar</button>
                                <?php
                                if ($tipo_accion == 2) {//Boton para editar usuario
                                    if ($tipo_acceso_menu == 2) {
                                        ?>
                                        <button type="button" class="btn btn-success" id="btn_editar" nombre="btn_editar" onclick="validar_editar_formato(<?php echo($tipo_accion);?>);">Guardar</button>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <br />
        <?php
        break;

    case "3": //Opcion para validar usuario existente
        $txt_busca_usuario = urldecode($_POST["nombre_usuario"]);
        $tabla_busca_persona = $dbUsuarios->getNombreUsuariosBuscar($txt_busca_usuario);
        $cantidad = count($tabla_busca_persona);
        if ($cantidad >= 1) {
            ?>
            <input type="hidden" value="false" name="hdd_usuario_existe" id="hdd_usuario_existe" />
            <?php
        } else if ($cantidad == 0) {
            ?>
            <input type="hidden" value="true" name="hdd_usuario_existe" id="hdd_usuario_existe" />
            <?php
        }
        break;

    case "4": //Opcion para crear nuevo usuarios
        /*$id_usuario_crea = $_SESSION["idUsuario"];
        @$txt_codigo = urldecode($_POST["txt_codigo"]);
        @$txt_nombre = urldecode($_POST["txt_nombre"]);
        @$cmb_estado = $_POST["cmb_estado"];
        @$cmb_lista_editable = $_POST["cmb_lista_editable"];
        @$id_listas_detalle = $_POST["id_listas_detalle"];
        
        $resultado = $dbListas->InsertItemLista($txt_codigo, $txt_nombre, $cmb_estado, $cmb_lista_editable, $id_listas_detalle, $id_usuario_crea);        
        
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
         */
        break;

    case "5": //Opcion para editar nuevo usuarios
        $id_usuario_crea = $_SESSION["idUsuario"];
       
        @$nombre_formato = urldecode($_POST["nombre_formato"]);
        @$codigo_formato = urldecode($_POST["codigo_formato"]);
        @$version_formato = urldecode($_POST["version_formato"]);
        @$fecha_formato = urldecode($_POST["fecha_formato"]);
        @$id_formato = $_POST["id_formato"];
        
        
        $resultado = $dbFormatos->EditarFormato($nombre_formato, $codigo_formato, $version_formato, $fecha_formato, $id_formato, $id_usuario_crea);                
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
     break;

    case "8"://Modal, Confirmacion
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
    
    
    
    case "9"://Modal, Confirmacion
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