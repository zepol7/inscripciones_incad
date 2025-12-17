<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber López - 16/09/2013
 */

require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Utilidades.php");

$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
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
        $id_lista = urldecode($_POST["id_lista"]);
        $tabla_listas_detalles = $dbListas->getListaDetallesEditabelTotal($id_lista);
        
        $tabla_listas = $dbListas->getItemListaEditable($id_lista);
        $item_lista_editable = $tabla_listas['nombre_lista_editable'];
        
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
                            <tr><th colspan='4' style="text-align: center;">Listado: <?php echo($item_lista_editable);?></th></tr>
                            <tr>
                                <!--<th style="width:5%;">Id</th>-->
                                <th style="width:10%;text-align: center;">C&oacute;digo Item</th>
                                <th style="width:36%;text-align: center;">Nombre Item</th>                                
                                <th style="width:15%;text-align: center;">Estado</th>
                                <?php
                                if($id_lista == 4){
                                ?>    
                                <th style="width:15%;text-align: center;">Detalles</th>
                                <?php
                                }
                                ?>
                                
                                
                                
                                
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_listas_detalles);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_listas_detalles as $fila_listado) {
                                @$id_listas_editable_detalle = $fila_listado['id_listas_editable_detalle'];
                                @$nombre_lista_editable_detalle = $fila_listado['nombre_lista_editable_detalle'];                                
                                @$codigo_lista_editable_detalle = $fila_listado['codigo_lista_editable_detalle'];                                
                                @$estado = $fila_listado['estado_lista_editable_detalle'];                                
                                
                                if ($estado == 1) {
                                    $estado = 'Activo';
                                    $class_estado = 'activo';
                                } else if ($estado == 0) {
                                    $estado = 'No Activo';
                                    $class_estado = 'inactivo';
                                }
                                
                                ?>
                                <tr style="cursor:pointer;">
                                    <!--<td align="center"><?php echo $id_listas_editable_detalle; ?></td>-->
                                    <td align="left" onclick="seleccionar_lista_detalle('<?php echo($id_lista);?>',  '<?php echo $id_listas_editable_detalle; ?>');"><?php echo $codigo_lista_editable_detalle; ?></td>
                                    <td align="left" onclick="seleccionar_lista_detalle('<?php echo($id_lista);?>',  '<?php echo $id_listas_editable_detalle; ?>');"><?php echo $nombre_lista_editable_detalle; ?></td>
                                    <td align="left" onclick="seleccionar_lista_detalle('<?php echo($id_lista);?>',  '<?php echo $id_listas_editable_detalle; ?>');"><span class="<?php echo $class_estado; ?>"><?php echo $estado; ?></span></td>
                                    <?php
                                    if($id_lista == 4){
                                    ?>    
                                    <td style="text-align:center;" onclick="form_detalles(<?php echo $id_listas_editable_detalle; ?>);"><img src="../imagenes/ver_lista.png" alt="logo-color" ></td>
                                    <?php
                                    }
                                    ?>

                                </tr>
                                <?php
                                $i = $i + 1;
                            }
                            
                            ?>
                                <tr><td colspan='3' style="text-align: left; cursor:pointer;"> <img onclick="seleccionar_lista_detalle(<?php echo($id_lista);?>, -1);" src="../imagenes/Add-icon.png" alt="Agregar" >  </td></tr>       
                            <?php    
                            
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="3">No se encontraron datos</td>
                            </tr>
                            <tr><td colspan='3' style="text-align: left; cursor:pointer;"> <img onclick="seleccionar_lista_detalle(<?php echo($id_lista);?>, -1);" src="../imagenes/Add-icon.png" alt="Agregar" >  </td></tr>       
                            <?php
                        }
                        ?>
                     
                    </table>
                </div>
            </div>
            
            <div class="col-md-12">
                    <div id="principal_listas_detalle" ></div>
                </div>
            
        </div>

        <script id='ajax'>
            //<![CDATA[ 
            $(function () {
                $('.paginated', 'table').each(function (i) {
                    $(this).text(i + 1);
                });

                $('table.paginated').each(function () {
                    var currentPage = 0;
                    var numPerPage = 10;
                    var $table = $(this);
                    $table.bind('repaginate', function () {
                        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
                    });
                    $table.trigger('repaginate');
                    var numRows = $table.find('tbody tr').length;
                    var numPages = Math.ceil(numRows / numPerPage);
                    var $pager = $('.pagination');
                    for (var page = 0; page < numPages; page++) {

                        $('<li><a href="#">' + (page + 1) + '</a></li>').bind('click', {
                            newPage: page
                        }, function (event) {
                            currentPage = event.data['newPage'];
                            $table.trigger('repaginate');
                            $(this).addClass('active').siblings().removeClass('active');

                        }).appendTo($pager);

                    }
                    $pager.appendTo('#paginador').find('li:first').addClass('active');
                });
            });
            //]]>
        </script>
        <br />
        <?php
        break;

    case "2": //Opcion editar listas
        $combo = new Combo_Box();
        
        $tabla_estado[0][0] = '1';
        $tabla_estado[0][1] = 'Activo';
        $tabla_estado[1][0] = '0';
        $tabla_estado[1][1] = 'Inactivo';
        
        $tabla_sino[0][0] = '1';
        $tabla_sino[0][1] = 'SI';
        $tabla_sino[1][0] = '0';
        $tabla_sino[1][1] = 'NO';
        
        
        $id_lista = $_POST['id_lista'];
        $id_detalle = $_POST['id_detalle'];
        
        
        //echo $id_lista." --- ".$id_detalle;
        
        if($id_detalle == -1) {
            $tipo_accion = 1; //Crear Lista
            $titulo_formulario = 'Crear Item';        
            $id_listas_editable_detalle = 0;
            $codigo_lista_editable_detalle = "";
            $nombre_lista_editable_detalle = "";
            $estado_lista_editable_detalle = 0;
            $estado_etapa_productiva = 0;
            $abreviatura = "";
            
            $resolucion_programa = "";
            $fecha_inicio = "";
            $fecha_terminacion = "";
            
        }
        else{
            $tipo_accion = 2; //Editar Lista
            $titulo_formulario = 'Editar Item';     
            $tabla_lista_detalle = $dbListas->getItemListaDetalleEditable($id_detalle);            
            $id_listas_editable_detalle = $tabla_lista_detalle['id_listas_editable_detalle'];
            $id_lista_editable = $tabla_lista_detalle['id_lista_editable'];
            $codigo_lista_editable_detalle = $tabla_lista_detalle['codigo_lista_editable_detalle'];
            $nombre_lista_editable_detalle = $tabla_lista_detalle['nombre_lista_editable_detalle'];
            $estado_lista_editable_detalle = $tabla_lista_detalle['estado_lista_editable_detalle'];
            $estado_etapa_productiva = $tabla_lista_detalle['etapa_productiva'];
            $abreviatura = $tabla_lista_detalle['abreviatura'];
            
            $resolucion_programa = $tabla_lista_detalle['resolucion_programa'];
            $fecha_inicio = $tabla_lista_detalle['format_fecha_inicio']; 
            $fecha_terminacion = $tabla_lista_detalle['format_fecha_terminacion'];
            
        }

        ?>
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="text-align: center; font-size: 20px;"><b><?php echo $titulo_formulario; ?></b></div>
                    <div class="panel-body">
                        <form id="frmCrearUsuario" name="frmCrearUsuario">
                            
                            <input type="hidden" name="id_listas_detalle" id="id_listas_detalle" value="<?php echo $id_listas_editable_detalle; ?>">
                            
                            <div class="form-group">
                                <label>C&oacute;digo Item</label>
                                <input type="text" class="form-control" name="txt_codigo" id="txt_codigo" placeholder="Codigo" value="<?php echo $codigo_lista_editable_detalle; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Nombre Item</label>
                                <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre" value="<?php echo $nombre_lista_editable_detalle; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Estado</label>
                                <?php $combo->get("cmb_estado", $estado_lista_editable_detalle, $tabla_estado, "Estado", "", "", "form-control", ""); ?>
                            </div>
                            <?php
                            if($id_lista == 4){
                            ?>
                                <div class="form-group">
                                <label>Abreviatura</label>
                                <input type="text" class="form-control" name="txt_abreviatura" id="txt_abreviatura" placeholder="Abreviatura" value="<?php echo $abreviatura; ?>" style=" width: 200px;">
                                </div>
                                <div class="form-group">
                                <label>Resolución del programa</label>
                                <input type="text" class="form-control" name="resolucion_programa" id="resolucion_programa" placeholder="Resolución" value="<?php echo $resolucion_programa; ?>" style=" width: 200px;">
                                </div>                           
                                <div class="form-group">
                                <label>Etapa Productiva</label>
                                <?php $combo->get("cmb_productiva", $estado_etapa_productiva, $tabla_sino, "", "", "", "form-control", ""); ?>
                                </div>
                            
                                 <!--Para Opción 2 -->
                                <input type="hidden" value="01/01/1990" name="fecha_inicio" id="fecha_inicio" />
                                <input type="hidden" value="01/01/1990" name="fecha_terminacion" id="fecha_terminacion" />     
                            
                            <?php
                            } else if($id_lista == 3){
                            ?>
                                <div class="form-group">
                                    <label for="">Fecha Inicio *</label>
                                    <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="dd/mm/aaaa" value="<?php echo $fecha_inicio;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                </div>
                                <div class="form-group">
                                    <label for="">Fecha Terminación *</label>
                                    <input type="text" class="form-control" name="fecha_terminacion" id="fecha_terminacion" placeholder="dd/mm/aaaa" value="<?php echo $fecha_terminacion;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                </div>        
                                
                                <!--Para Opción 4 -->
                                <input type="hidden" value="0" name="cmb_productiva" id="cmb_productiva" />
                                <input type="hidden" value="NULL" name="resolucion_programa" id="resolucion_programa" />
                                <input type="hidden" value="NULL" name="txt_abreviatura" id="txt_abreviatura" />
                                
                            <?php    
                            }
                            else {
                            ?>
                                <!--Para Opción 4 -->
                                <input type="hidden" value="0" name="cmb_productiva" id="cmb_productiva" />
                                <input type="hidden" value="NULL" name="resolucion_programa" id="resolucion_programa" />
                                <input type="hidden" value="NULL" name="txt_abreviatura" id="txt_abreviatura" />
                                
                                <!--Para Opción 2 -->
                                <input type="hidden" value="01/01/1990" name="fecha_inicio" id="fecha_inicio" />
                                <input type="hidden" value="01/01/1990" name="fecha_terminacion" id="fecha_terminacion" />                                
                            <?php
                            }
                            ?>
                                
                            <?php
                            if($id_lista == 9){                                
                                $tabla_modulos = $dbListas->getListaModulos($id_detalle);
                                
                            ?>
                                
                                <div class="row">    
                                    <div class="centrar panel panel-primary">
                                    <div class="panel-heading">Programa que aplica</div>

                                    <?php
                                    $tabla_programas = $dbListas->getListaTodosProgramas();

                                    $i = 1;
                                    foreach ($tabla_programas as $fila_programas) {
                                        $id_programa = $fila_programas['id_listas_editable_detalle'];
                                        $nombre_programa = $fila_programas['nombre_lista_editable_detalle'];
                                        $abreviatura = $fila_programas['abreviatura'];

                                        $checked = '';
                                        //Se recorre el array donde tien los programas encontrados
                                        if (count($tabla_modulos) != 0) {
                                            foreach ($tabla_modulos as $fila_modulos) {
                                                $id_lista_modulo = $fila_modulos['id_lista_programa'];
                                                if ($id_programa == $id_lista_modulo) {
                                                    $checked = 'checked';
                                                }
                                            }
                                        }
                                        if ($i == 1) {
                                            ?>
                                            <div class="col-md-4 form-group">
                                            <input type="checkbox" name="check_programa" id="check_programa_<?php echo $id_programa; ?>" value="<?php echo $id_programa; ?>" <?php echo $checked; ?>> <?php echo $nombre_programa; ?>
                                            </div>
                                            <?php
                                            $i = 0;
                                        } else {
                                            ?>
                                            <div class="col-md-4 form-group">    
                                            <input type="checkbox" name="check_programa" id="check_programa_<?php echo $id_programa; ?>" value="<?php echo $id_programa; ?>" <?php echo $checked; ?>> <?php echo $nombre_programa; ?>	
                                            </div>
                                            <?php
                                            $i = $i + 1;
                                        }
                                    }
                                    ?>

                                        </div>    
                                   </div>   
                                

                            
                            <?php
                            }                            
                            ?>
                                

                            <div class="centrar">
                                <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="volver_inicio(<?php echo($id_lista);?>);">Cancelar</button>
                                <?php
                                if ($tipo_accion == 1) {//Boton para crear usuario
                                    if ($tipo_acceso_menu == 2) {
                                        ?>
                                        <button type="button" class="btn btn-success" id="btn_crear" nombre="btn_crear" onclick="validar_crear_editar_lista_item(<?php echo($tipo_accion);?>);">Crear</button>
                                        <?php
                                    }
                                } else if ($tipo_accion == 2) {//Boton para editar usuario
                                    if ($tipo_acceso_menu == 2) {
                                        ?>
                                        <button type="button" class="btn btn-success" id="btn_editar" nombre="btn_editar" onclick="validar_crear_editar_lista_item(<?php echo($tipo_accion);?>);">Guardar</button>
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
        $id_usuario_crea = $_SESSION["idUsuario"];
        @$txt_codigo = urldecode($_POST["txt_codigo"]);
        @$txt_nombre = urldecode($_POST["txt_nombre"]);
        @$cmb_estado = $_POST["cmb_estado"];
        @$cmb_lista_editable = $_POST["cmb_lista_editable"];
        @$id_listas_detalle = $_POST["id_listas_detalle"];
        
        @$txt_abreviatura = $_POST["txt_abreviatura"];
        @$cmb_productiva = $_POST["cmb_productiva"];
        
        @$resolucion_programa = $_POST["resolucion_programa"];
        @$fecha_inicio = $_POST["fecha_inicio"];
        @$fecha_terminacion = $_POST["fecha_terminacion"];        
        
        //$resolucion_programa, $fecha_inicio, $fecha_terminacion
        
        @$programas_modulos = $utilidades->limpiar_tags($_POST["array_programas_modulos"]);
        
        $resultado = $dbListas->InsertItemLista($txt_codigo, $txt_nombre, $cmb_estado, $cmb_lista_editable, $id_listas_detalle, $txt_abreviatura, $cmb_productiva, $resolucion_programa, $fecha_inicio, $fecha_terminacion, $programas_modulos, $id_usuario_crea);        
        
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
        break;

    case "5": //Opcion para editar nuevo usuarios
        $id_usuario_crea = $_SESSION["idUsuario"];
        @$txt_codigo = urldecode($_POST["txt_codigo"]);
        @$txt_nombre = urldecode($_POST["txt_nombre"]);
        @$cmb_estado = $_POST["cmb_estado"];
        @$cmb_lista_editable = $_POST["cmb_lista_editable"];
        @$id_listas_detalle = $_POST["id_listas_detalle"];
        
        @$txt_abreviatura = $_POST["txt_abreviatura"];
        @$cmb_productiva = $_POST["cmb_productiva"];
        
        @$resolucion_programa = $_POST["resolucion_programa"];
        @$fecha_inicio = $_POST["fecha_inicio"];
        @$fecha_terminacion = $_POST["fecha_terminacion"];        
        
        
        @$programas_modulos = $utilidades->limpiar_tags($_POST["array_programas_modulos"]);
        
        $resultado = $dbListas->EditarItemLista($txt_codigo, $txt_nombre, $cmb_estado, $cmb_lista_editable, $id_listas_detalle, $txt_abreviatura, $cmb_productiva, $resolucion_programa, $fecha_inicio, $fecha_terminacion, $programas_modulos, $id_usuario_crea);                
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
    
    
    case "10"://Modal, Confirmacion
        
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
            <?php
            @$titulo = $_POST["titulo"];
            @$id_listas_editable_detalle = $_POST["id_listas_editable_detalle"];
            
            $tabla_detalle_programa = $dbListas->getDetallePrograma($id_listas_editable_detalle);
            
            $tabla_programa = $dbListas->getItemListaDetalleEditable($id_listas_editable_detalle);
            $nombre_programa = $tabla_programa['nombre_lista_editable_detalle'];
            
            
            $id_detalle = $tabla_detalle_programa['id'];
            $descripcion = $tabla_detalle_programa['descripcion'];
            $precio = $tabla_detalle_programa['precio'];
            $duracion = $tabla_detalle_programa['duracion'];
            $horario = $tabla_detalle_programa['horario'];
            $forma_pago = $tabla_detalle_programa['forma_pago'];
            $requisitos = $tabla_detalle_programa['requisitos'];
            
            $tipo_accion = 1;//Crear
            if($id_detalle > 0){
                $tipo_accion = 2;//Editar
            }
            if($id_detalle == ''){
               $id_detalle = 0;
            }
            
            
            
            ?>            
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">
                        <input type="hidden" id="hdd_id_detalle" name="hdd_id_detalle" value="<?php echo($id_detalle); ?>" />        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo."<br />".$nombre_programa; ?> </b></h4>
                    </div>
                    <div class="modal-body centrar">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger contenedor_error " role="alert" id='contenedor_error_detalle'></div>
                                <div class="alert alert-success contenedor_exito " role="alert" id='contenedor_exito_detalle'></div>
                            </div>
                        </div>  
                        
                        <label>Descripción</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=5 class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" onblur="trim_cadena(this);" ><?php echo $descripcion; ?></textarea>
                            </div>                            
                        </div>
                        
                        <label>Precio</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=3 class="form-control" name="precio" id="precio" placeholder="Precio" onblur="trim_cadena(this);" ><?php echo $precio; ?></textarea>
                            </div>                            
                        </div>
                        
                        <!--<label>Duración</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=3 class="form-control" name="duracion" id="duracion" placeholder="Duración" onblur="trim_cadena(this);" ><?php echo $duracion; ?></textarea>
                            </div>                            
                        </div>-->
                        <input type="hidden" id="duracion" name="duracion" value="N/A" />
                        <label>Horario</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=2 class="form-control" name="horario" id="horario" placeholder="Horario" onblur="trim_cadena(this);" ><?php echo $horario; ?></textarea>
                            </div>                            
                        </div>
                        
                        <label>Forma de pago</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=3 class="form-control" name="forma_pago" id="forma_pago" placeholder="Forma de pago" onblur="trim_cadena(this);" ><?php echo $forma_pago; ?></textarea>
                            </div>                            
                        </div>
                        
                        <label>Requisitos</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=5 class="form-control" name="requisitos" id="requisitos" placeholder="Requisitos" onblur="trim_cadena(this);" ><?php echo $requisitos; ?></textarea>
                            </div>                            
                        </div>
                        
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="validar_crear_detalle_programa('<?php echo($tipo_accion)?>', '<?php echo($id_listas_editable_detalle);?>');">Guardar Datos</button>
                        
                        <div id="div_estado_detalle"></div>
                        
                    </div>

                </div>
            </div>
        </div>
        <?php
       
    break;
    
    case "11": //Opcion para crear y editar detalle de programas
        $id_usuario_crea = $_SESSION["idUsuario"];
        @$descripcion = $utilidades->str_decode($_POST["descripcion"]);
        @$precio = $utilidades->str_decode($_POST["precio"]);
        @$duracion = $utilidades->str_decode($_POST["duracion"]);
        @$horario = $utilidades->str_decode($_POST["horario"]);
        @$forma_pago = $utilidades->str_decode($_POST["forma_pago"]);
        @$requisitos = $utilidades->str_decode($_POST["requisitos"]);
        
        @$id_detalle = urldecode($_POST["id_detalle"]);
        @$id_programa = urldecode($_POST["id_programa"]);
        @$tipo_accion = urldecode($_POST["tipo_accion"]);
        
        
                
        $resultado = $dbListas->InsertEditarDetallePrograma($descripcion, $precio, $duracion, $horario, $forma_pago, $requisitos, $id_programa, $id_detalle, $tipo_accion, $id_usuario_crea);        
        
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito_detalle" id="hdd_exito_detalle" />
        <?php
    break;

    
    
    
}
?>