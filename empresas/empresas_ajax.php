<?php
session_start();

require_once("../db/DbUsuarios.php");
require_once("../db/DbEmpresas.php");
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
$dbEmpresas = new DbEmpresas();
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
        $txt_busca_empresa = urldecode($_POST["txt_busca_empresa"]);
        $tabla_busca_empresas = $dbEmpresas->getListaEmpresasBuscar($txt_busca_empresa);        
        $tabla_busca_empresas_programa = $dbEmpresas->getListaEmpresasProgramaBuscar($txt_busca_empresa);        
        
        $_SESSION["excel_tabla_empresas"] = $tabla_busca_empresas_programa;
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
                            <tr><th colspan='7' style="text-align: center;">Empresas para Practicas</th></tr>
                            <tr>
                                <th style="width:10%;">NIT</th>
                                <th style="width:20%;">Nombre Empresa</th>
                                <th style="width:20%;">Direcci&oacute;n</th>
                                <th style="width:10%;">Contacto</th>
                                <th style="width:10%;">Tel&eacute;fonos</th>
                                <th style="width:5%;">E-mail</th>
                                <th style="width:20%;">Programas Aplica</th>
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_busca_empresas);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_busca_empresas as $fila_empresa) {
                                @$id_empresa = $fila_empresa['id_empresa'];
                                @$nit_empresa = $fila_empresa['nit_empresa'];
                                @$nombre_empresa = $fila_empresa['nombre_empresa'];
                                @$direccion_empresa = $fila_empresa['direccion_empresa'];
                                @$nombre_contacto = $fila_empresa['nombre_contacto'];
                                @$nombre_contacto2 = $fila_empresa['nombre_contacto2'];
                                @$telefono1_contacto = $fila_empresa['telefono1_contacto'];
                                @$telefono2_contacto = $fila_empresa['telefono2_contacto'];
                                @$email_contacto = $fila_empresa['email_contacto'];
                                @$email_contacto2 = $fila_empresa['email_contacto2'];
                                @$observaciones_empresa = $fila_empresa['observaciones_empresa'];
                                
                                
                                $tabla_porgramas_empresa = $dbEmpresas->getListaProgramasEmpresas($id_empresa);
                                $cantidad_programas = count($tabla_porgramas_empresa);
                                $programas_empresas = '<ul>';
                                $contador = 1;
                                foreach ($tabla_porgramas_empresa as $fila_empresas) {
                                    if ($contador == $cantidad_programas) {
                                        $programas_empresas = $programas_empresas . "<li>".$fila_empresas['nombre_lista_editable_detalle']."</li>";
                                    } else {
                                        $programas_empresas = $programas_empresas . "<li>".$fila_empresas['nombre_lista_editable_detalle']."</li>";
                                    }
                                    $contador = $contador + 1;
                                }
                                
                                if($nombre_contacto2<>""){
                                ?>
                                <tr style="cursor:pointer;" onclick="seleccionar_empresa('<?php echo $id_empresa; ?>');">
                                    <td rowspan="2" align="left"><?php echo $nit_empresa; ?></td>
                                    <td rowspan="2" align="left"><?php echo $nombre_empresa; ?></td>
                                    <td rowspan="2" align="left"><?php echo $direccion_empresa; ?></td>
                                    <td align="left"><?php echo $nombre_contacto; ?></td>
                                    <td align="left"><?php echo $telefono1_contacto; ?></td>
                                    <td align="left"><?php echo $email_contacto; ?></td>
                                    <td rowspan="2" align="left"><?php echo $programas_empresas; ?></td>
                                </tr>
                                <tr style="cursor:pointer;" onclick="seleccionar_empresa('<?php echo $id_empresa; ?>');">
                                    <td align="left"><?php echo $nombre_contacto2; ?></td>
                                    <td align="left"><?php echo $telefono2_contacto; ?></td>
                                    <td align="left"><?php echo $email_contacto2; ?></td>                                    
                                </tr>
                                <?php   
                                }
                                else{
                                ?>
                                <tr style="cursor:pointer;" onclick="seleccionar_empresa('<?php echo $id_empresa; ?>');">
                                    <td align="left"><?php echo $nit_empresa; ?></td>
                                    <td align="left"><?php echo $nombre_empresa; ?></td>
                                    <td align="left"><?php echo $direccion_empresa; ?></td>
                                    <td align="left"><?php echo $nombre_contacto; ?></td>
                                    <td align="left"><?php echo $telefono1_contacto; ?></td>
                                    <td align="left"><?php echo $email_contacto; ?></td>
                                    <td align="left"><?php echo $programas_empresas; ?></td>
                                </tr>
                                <?php    
                                    
                                }
                                
                                $i = $i + 1;
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="7">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
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
                    var numPerPage = 20;
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

    case "2": //Opcion para crear el formulario de crear Empresa
        $combo = new Combo_Box();        

        $id_empresa = '';
        $nit_empresa = '';
        $nombre_empresa = '';
        $direccion_empresa = '';
        $nombre_contacto = '';
        $nombre_contacto2 = '';
        $telefono1_contacto = '';
        $telefono2_contacto = '';
        $email_contacto = '';
        $email_contacto2 = '';
        $observaciones_empresa = '';
        $tabla_programas_empresas = array();
         
        $tipo_accion = 1; //Crear empresa
        $titulo_formulario = 'Crear Empresa';

        if (isset($_POST['id_empresa'])) {
            $tabla_empresa = $dbEmpresas->getEmpresa($_POST['id_empresa']);
            $id_empresa = $_POST['id_empresa'];
            
            $nit_empresa = $tabla_empresa['nit_empresa'];
            $nombre_empresa = $tabla_empresa['nombre_empresa'];
            $direccion_empresa = $tabla_empresa['direccion_empresa'];
            $nombre_contacto = $tabla_empresa['nombre_contacto'];
            $nombre_contacto2 = $tabla_empresa['nombre_contacto2'];
            $telefono1_contacto = $tabla_empresa['telefono1_contacto'];
            $telefono2_contacto = $tabla_empresa['telefono2_contacto'];
            $email_contacto = $tabla_empresa['email_contacto'];
            $email_contacto2 = $tabla_empresa['email_contacto2'];
            $observaciones_empresa = $tabla_empresa['observaciones_empresa'];
            $tabla_programas_empresas = $dbEmpresas->getListaProgramasEmpresas($_POST['id_empresa']);
            
            $tipo_accion = 2; //Editar usuario
            $titulo_formulario = 'Editar Empresa';
            
        }
        ?>
        <div id="div_empresa_existe"><input type="hidden" value="true" name="hdd_empresa_existe" id="hdd_empresa_existe" /></div>
        <div id="div_nit_existe"><input type="hidden" value="true" name="hdd_nit_existe" id="hdd_nit_existe" /></div>
        <input type="hidden" value="<?php echo $id_empresa; ?>" name="hdd_id_empresa" id="hdd_id_empresa" />
        <!-- <input type="text" value="0" name="hdd_exito" id="hdd_exito" /> -->
        </br>
        </br>
        
            
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo $titulo_formulario; ?></div>
            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-6 form-group">
                        <label for="nombre_empresa">Nombres de la Empresa *</label>
                        <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" placeholder="Nombres empresa" onblur="trim_cadena(this); convertirAMayusculas(this);" value="<?php echo $nombre_empresa; ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nombre_empresa">NIT de la Empresa *</label>
                        <input type="text" class="form-control" name="nit_empresa" id="nit_empresa" placeholder="NIT" value="<?php echo $nit_empresa; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="nombre_empresa">Direcci&oacute;n de la Empresa *</label>
                        <input type="text" class="form-control" name="direccion_empresa" id="direccion_empresa" placeholder="Direccion empresa" onblur="trim_cadena(this); convertirAMayusculas(this);" value="<?php echo $direccion_empresa; ?>">
                    </div>                    
                    <div class="col-md-8 form-group">
                        <label for="nombre_contacto">Nombre de Contacto 1 *</label>
                        <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" placeholder="Contacto" onblur="trim_cadena(this); convertirAMayusculas(this);" value="<?php echo $nombre_contacto; ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nombre_contacto">Tel&eacute;fono Contacto 1 *</label>
                        <input type="text" class="form-control" name="telefono1_contacto" id="telefono1_contacto" placeholder="Tel&eacute;fono 1" value="<?php echo $telefono1_contacto; ?>" onblur="trim_cadena(this);">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="txt_email">Email 1 *</label>
                        <input type="email" class="form-control" name="email_contacto" id="email_contacto" placeholder="Email Contacto" value="<?php echo $email_contacto; ?>" onblur="trim_cadena(this);">
                    </div>
                    
                    <div class="col-md-8 form-group">
                        <label for="nombre_contacto">Nombre de Contacto 2 *</label>
                        <input type="text" class="form-control" name="nombre_contacto2" id="nombre_contacto2" placeholder="Contacto 2" onblur="trim_cadena(this); convertirAMayusculas(this);" value="<?php echo $nombre_contacto2; ?>">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="nombre_contacto">Tel&eacute;fono Contacto 2 </label>
                        <input type="text" class="form-control" name="telefono2_contacto" id="telefono2_contacto" placeholder="Tel&eacute;fono 2" value="<?php echo $telefono2_contacto; ?>" onblur="trim_cadena(this);">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="txt_email">Email 2</label>
                        <input type="email" class="form-control" name="email_contacto2" id="email_contacto2" placeholder="Email Contacto 2" value="<?php echo $email_contacto2; ?>" onblur="trim_cadena(this);">
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="txt_email">Observacines</label>
                        <textarea rows=5 class="form-control" name="observaciones_empresa" id="observaciones_empresa" placeholder="Observaciones" value="" onblur="trim_cadena(this); convertirAMayusculas(this);" > <?php echo($observaciones_empresa);?></textarea>
                    </div>
                    
                </div>  
                
                <div class="row">    
                <div class="centrar panel panel-primary">
                <div class="panel-heading">Programa que aplica</div>
                
                <?php
                $tabla_programas = $dbEmpresas->getListaProgramas();

                $i = 1;
                foreach ($tabla_programas as $fila_programas) {
                    $id_programa = $fila_programas['id_listas_editable_detalle'];
                    $nombre_programa = $fila_programas['nombre_lista_editable_detalle'];
                    $abreviatura = $fila_programas['abreviatura'];

                    $checked = '';
                    //Se recorre el array donde tien los programas encontrados
                    if (count($tabla_programas_empresas) != 0) {
                        foreach ($tabla_programas_empresas as $fila_programas_empresa) {
                            $id_programa_empresa = $fila_programas_empresa['id_programas'];
                            if ($id_programa == $id_programa_empresa) {
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
                    
                <div class="row">    
                <div class="centrar">
                    <button type="button" class="btn btn-default" id="btn_cancelar" nombre="btn_cancelar" onclick="volver_inicio();">Cancelar</button>
                    <?php
                    if ($tipo_accion == 1) {//Boton para crear Empresa
                        if ($tipo_acceso_menu == 2) {
                            ?>
                            <button type="submit" class="btn btn-success" id="btn_crear" nombre="btn_crear" onclick="validar_crear_editar_empresa(<?php echo($tipo_accion);?>);">Crear</button>
                            <?php
                        }
                    } else if ($tipo_accion == 2) {//Boton para editar Empresa
                        if ($tipo_acceso_menu == 2) {
                            ?>
                            <button type="submit" class="btn btn-success" id="btn_editar" nombre="btn_editar" onclick="validar_crear_editar_empresa(<?php echo($tipo_accion);?>);">Guardar</button>
                            <?php
                        }
                    }
                    ?>
                </div>
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
        @$nit_empresa = urldecode($_POST["nit_empresa"]);
        @$nombre_empresa = urldecode($_POST["nombre_empresa"]);
        @$direccion_empresa = urldecode($_POST["direccion_empresa"]);
        @$nombre_contacto = urldecode($_POST["nombre_contacto"]);
        @$nombre_contacto2 = urldecode($_POST["nombre_contacto2"]);
        @$telefono1_contacto = urldecode($_POST["telefono1_contacto"]);
        @$telefono2_contacto = urldecode($_POST["telefono2_contacto"]);       
        @$email_contacto = $utilidades->limpiar_tags($_POST["email_contacto"]);        
        @$email_contacto2 = $utilidades->limpiar_tags($_POST["email_contacto2"]);                
        @$observaciones_empresa = urldecode($_POST["observaciones_empresa"]);
        
        @$programas_empresas = $utilidades->limpiar_tags($_POST["array_programas_empresas"]);
        
        $resultado = $dbEmpresas->InsertEmpresa($nit_empresa, $nombre_empresa, $direccion_empresa, $nombre_contacto, $nombre_contacto2, $telefono1_contacto, $telefono2_contacto, $email_contacto, $email_contacto2, $observaciones_empresa, $programas_empresas, $id_usuario_crea);
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
        break;

    case "5": //Opcion para validar nit existente
        $nit_empresa = $_POST["nit_empresa"];
        $tipo = $_POST["tipo"];
        $id_empresa = $_POST["id_empresa"];

        if ($tipo == 1) {
            $tabla_busca_documento = $dbEmpresas->getBuscarNit($nit_empresa, $id_empresa);
        } else if ($tipo == 2) {
            $tabla_busca_documento = $dbEmpresas->getBuscarNit($nit_empresa, $id_empresa);
        }
        $cantidad = count($tabla_busca_documento);
        if ($cantidad >= 1) {
            ?>
            <input type="hidden" value="false" name="hdd_nit_existe" id="hdd_nit_existe" />
            <?php
        } else if ($cantidad == 0) {
            ?>
            <input type="hidden" value="true" name="hdd_nit_existe" id="hdd_nit_existe" />
            <?php
        }
        break;

    case "6": //Opcion para editar Empresas
        
        $id_usuario_crea = $_SESSION["idUsuario"];
        @$nit_empresa = urldecode($_POST["nit_empresa"]);
        @$nombre_empresa = urldecode($_POST["nombre_empresa"]);
        @$direccion_empresa = urldecode($_POST["direccion_empresa"]);
        @$nombre_contacto = urldecode($_POST["nombre_contacto"]);
        @$nombre_contacto2 = urldecode($_POST["nombre_contacto2"]);
        @$telefono1_contacto = urldecode($_POST["telefono1_contacto"]);
        @$telefono2_contacto = urldecode($_POST["telefono2_contacto"]);       
        @$email_contacto = $utilidades->limpiar_tags($_POST["email_contacto"]);        
        @$email_contacto2 = $utilidades->limpiar_tags($_POST["email_contacto2"]);
        @$observaciones_empresa = urldecode($_POST["observaciones_empresa"]);        
        @$hdd_id_empresa = $utilidades->limpiar_tags($_POST["hdd_id_empresa"]);        
        
        @$programas_empresas = $utilidades->limpiar_tags($_POST["array_programas_empresas"]);
        
        $resultado = $dbEmpresas->UpdateEmpresa($nit_empresa, $nombre_empresa, $direccion_empresa, $nombre_contacto, $nombre_contacto2, $telefono1_contacto, $telefono2_contacto, $email_contacto, $email_contacto2, $observaciones_empresa, $programas_empresas, $hdd_id_empresa, $id_usuario_crea);
        
        ?>
        <input type="hidden" value="<?php echo $resultado; ?>" name="hdd_exito" id="hdd_exito" />
        <?php
        
        
        break;

    case "7": //Resetea la contarseña del usuario
       

    break;

    case "8"://Modal, Confirmacion crear/editar
        ?>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>();">Si</button>
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