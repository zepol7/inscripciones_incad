<?php
session_start();


require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../db/DbCotizador.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Utilidades.php");

$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$dbCotizador = new DbCotizador();
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
        
        date_default_timezone_set('America/Bogota');

        // Obtener la fecha y hora actual
        $fechaHoraColombia = date('d/m/Y H:i:s');

        // Mostrar la fecha y hora actual en la zona horaria de Colombia
        //echo "Fecha y hora actual en Colombia: " . $fechaHoraColombia;
        
        
        if(isset($_POST["id_cotizador"])){
            
            $id_cotizador = $_POST["id_cotizador"];
            $tabla_cotizador = $dbCotizador->getCotizador($_POST["id_cotizador"]);
            
            $id_programa = $tabla_cotizador['id_programa'];
            
            $tabla_listas_detalles = $dbListas->getItemListaDetalleEditable($id_programa);

            $tabla_detalle_programa = $dbCotizador->getDetallePrograma($id_programa);
            
            $nombre_completo = $tabla_cotizador['nombre_completo'];
            $fecha_cotizador = $tabla_cotizador['format_fecha_cotizador'];
            $tel_casa_persona = $tabla_cotizador['tel_casa_persona'];
            $tel_movil_persona = $tabla_cotizador['tel_movil_persona'];
            $observaciones_cotiza = $tabla_cotizador['observaciones_cotiza'];
            $email_persona = $tabla_cotizador['email_persona'];   
            
            ?>
               <script id='ajax'>
                   cambiar_lista_programa(<?php echo($id_programa);?>);
               </script>
            <?php
            
            
            $id_tipo_accion = 2;
            
        }
        else{
            $id_cotizador = 0;
            $id_programa = urldecode($_POST["id_programa"]);
            $tabla_listas_detalles = $dbListas->getItemListaDetalleEditable($id_programa);

            $tabla_detalle_programa = $dbCotizador->getDetallePrograma($id_programa);
            
            $nombre_completo = '';
            $fecha_cotizador = $fechaHoraColombia;
            $tel_casa_persona = '';
            $tel_movil_persona = '';
            $observaciones_cotiza = '';
            $email_persona = '';
            
            $id_tipo_accion = 1;
        }
        
        //echo $tabla_listas_detalles['nombre_lista_editable_detalle'];
        
        $descripcion = $tabla_detalle_programa['descripcion'];
        $precio = $tabla_detalle_programa['precio'];
        //$duracion = $tabla_detalle_programa['duracion'];
        $horario = $tabla_detalle_programa['horario'];
        $forma_pago = $tabla_detalle_programa['forma_pago'];
        $requisitos = $tabla_detalle_programa['requisitos'];
        
        
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading"><b>DATOS PERSONALES</b></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="">Fecha de Cotización  *</label>
                        <input type="text" readonly="true" class="form-control" name="fecha_cotizador" id="fecha_cotizador" placeholder="dd/mm/aaaa" value="<?php echo $fecha_cotizador;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                    </div>                    
                    <div class="col-md-4 form-group">
                        <label for="">Nombres Completo *</label>
                        <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" placeholder="Nombre Completo" value="<?php echo $nombre_completo; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>                    
                    <div class="col-md-2 form-group">
                        <label for="">Tel&eacute;fono Casa</label>
                        <input type="text" class="form-control" name="tel_casa_persona" id="tel_casa_persona" placeholder="Tel&eacute;fono Casa" value="<?php echo $tel_casa_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Tel&eacute;fono Celular  *</label>
                        <input type="text" class="form-control" name="tel_movil_persona" id="tel_movil_persona" placeholder="Tel&eacute;fono Celular" value="<?php echo $tel_movil_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>    
                    <div class="col-md-2 form-group">
                        <label for="">Correo Electr&oacute;nico</label>
                        <input type="text" class="form-control" name="email_persona" id="email_persona" placeholder="Email" value="<?php echo $email_persona; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                    </div>    
                </div>
                
                <div class="row">                      
                    <div class="col-md-12 form-group">
                        <label for="">Observac&oacute;n</label>
                        <textarea rows=2 class="form-control" name="observaciones_cotiza" id="observaciones_cotiza" placeholder="Observaciones" onblur="trim_cadena(this);" ><?php echo $observaciones_cotiza; ?></textarea>
                    </div>                            
                </div>
                
            </div>
        </div>	  
        
        <div class="panel panel-primary">
	<section id="what-we-do">
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Precio</h3>
                                <p class="card-text"><?php echo($precio);?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Descripcion</h3>
                                <p class="card-text"><?php echo($descripcion);?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Requisitos</h3>
                                <p class="card-text"><?php echo($requisitos);?></p>
                            </div>
                        </div>
                    </div>                   

                </div>

                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Forma pago</h3>
                                <p class="card-text"><?php echo($forma_pago);?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Horario</h3>
                                <p class="card-text"><?php echo($horario);?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>	
	</section>
        </div>	


        <div class="panel panel-primary">
        <div class="panel-body">
        <div class="centrar">
            
            <input type="hidden" name="hdd_id_cotizador" id="hdd_id_cotizador" value="<?php echo $id_cotizador; ?>" >
            
            <button type="button" class="btn btn-success" id="btn_editar_registro" nombre="btn_editar_registro" onclick="validar_crear_cotizador(<?php echo($id_tipo_accion);?>, <?php echo($id_programa); ?>);">Guardar Datos</button>
            <!-- <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="llamar_crear_registro();">Cancelar</button>-->
        </div>
        </div>
        </div>    
        


        
        <?php
    break;


    case "2"://Modal, Confirmacion
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

    case "3": //Opcion para crear y editar detalle de programas
        $id_usuario_crea = $_SESSION["idUsuario"];
        @$fecha_cotizador = $utilidades->str_decode($_POST["fecha_cotizador"]);
        @$nombre_completo = $utilidades->str_decode($_POST["nombre_completo"]);
        @$tel_casa_persona = $utilidades->str_decode($_POST["tel_casa_persona"]);
        @$tel_movil_persona = $utilidades->str_decode($_POST["tel_movil_persona"]);        
        @$tipo_accion = $utilidades->str_decode($_POST["tipo_accion"]);
        
        @$email_persona = $utilidades->str_decode($_POST["email_persona"]);
        @$observaciones_cotiza = $utilidades->str_decode($_POST["observaciones_cotiza"]);

        @$id_programa = $utilidades->str_decode($_POST["id_programa"]);
        
        @$id_cotizador = $utilidades->str_decode($_POST["id_cotizador"]);
        
        $resultado = $dbCotizador->InsertEditCotizador($fecha_cotizador, $nombre_completo, $tel_casa_persona, $tel_movil_persona, $id_programa, $email_persona, $observaciones_cotiza, $tipo_accion, $id_cotizador, $id_usuario_crea);        
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
    break;


    case "4":
        
        if(isset($_POST["txt_busca_id"])){
            $txt_busca_id = urldecode($_POST["txt_busca_id"]);
            $fecha_cotizador_desde = urldecode($_POST["fecha_cotizador_desde"]);
            $fecha_cotizador_hasta = urldecode($_POST["fecha_cotizador_hasta"]);
            $tabla_listas_cotizador = $dbCotizador->getListaCotizadorBuscar($txt_busca_id, $fecha_cotizador_desde, $fecha_cotizador_hasta);
        }
        else{
            $tabla_listas_cotizador = $dbCotizador->getListaCotizador();
        }
        
        
        $_SESSION["excel_tabla_listas_cotizador"] = $tabla_listas_cotizador;
        
        
        
        
        
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
                            <tr>
                                <!--<th style="width:5%;">Id</th>-->
                                <th style="width:10%;text-align: center;">Fecha</th>
                                <th style="width:20%;text-align: center;">Nombre</th>                                
                                <th style="width:15%;text-align: center;">Telefono</th>
                                <th style="width:15%;text-align: center;">Celular</th>
                                <th style="width:15%;text-align: center;">Email</th>
                                <th style="width:15%;text-align: center;">Programa</th>
                                <th colspan="2" style="width:15%;text-align: center;">Opci&oacute;n</th>
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_listas_cotizador);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_listas_cotizador as $fila_listado) {
                                @$id_cotizador = $fila_listado['id_cotizador'];
                                @$fecha_cotizador = $fila_listado['fecha_cotizador'];
                                @$nombre_completo = $fila_listado['nombre_completo'];                                
                                @$tel_casa_persona = $fila_listado['tel_casa_persona'];                                
                                @$tel_movil_persona = $fila_listado['tel_movil_persona'];
                                @$email_persona = $fila_listado['email_persona'];
                                @$nombre_programa = $fila_listado['nombre_programa'];          
                                
                                
                                ?>
                                <tr style="cursor:pointer;">
                                    <td align="left" ><?php echo $fecha_cotizador; ?></td>
                                    <td align="left" ><?php echo $nombre_completo; ?></td>
                                    <td align="left" ><?php echo $tel_casa_persona; ?></td>
                                    <td align="left" ><?php echo $tel_movil_persona; ?></td>
                                    <td align="left" ><?php echo $email_persona; ?></td>
                                    <td align="left" ><?php echo $nombre_programa; ?></td>                                    
                                    <td align="center" >
                                        <a href="pdf_cotizador.php?id_cotizador=<?php echo($id_cotizador);?>&tipo=1" target="_blank"  >Imprimir</a>
                                    </td>
                                    <td align="center" onclick="mostrar_form_editar_cotizador(<?php echo($id_cotizador);?>)" >
                                        <a href="#" >Editar</a>
                                    </td>
                                    
                                    
                                    
                                </tr>
                                <?php
                                $i = $i + 1;
                            }
                            
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="5">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                     
                    </table>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <h3 style="text-align: center;">Descargar Reporte</h3>
                    <div class="img_descargar_excel" onclick="descargar_base_excel();"></div>
                </div>   

                <form id="form_xls_base" name="form_xls_base" method="post" action="cotizador_excel.php" style="display:none;" target="_blank"></form>
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

    

    
    
    
}
?>