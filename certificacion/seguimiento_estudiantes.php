<?php
session_start();

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbPerfiles.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../db/DbListas.php");
$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$perfiles = new DbPerfiles();
$dbListas = new DbListas();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);


//variables
$titulo = $variables->getVariable(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo['valor_variable']; ?></title>
        <link href="../css/estilos_1.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">

    </head>
    <body>
        <?php
        $contenido->validar_seguridad(0);
        $contenido->cabecera_html();
        
        $tb_estados_validacion[0][0] = 1;
        $tb_estados_validacion[0][1] = "Enviado";
        $tb_estados_validacion[1][0] = 2;
        $tb_estados_validacion[1][1] = "Validado";    
        
        
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12 fondoAzul">
                    <ol class="breadcrumb">
                        <li>Seguimiento a Estudiantes y  Empresas</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error'></div>
                    <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito'></div>
                </div>
            </div>
            
            
            <div class="panel-group">
                <div class="panel panel-success">
                  <div class="panel-heading">Buscar Estudiante</div>
                  <div class="panel-body">
                      
                    <div class="form-group">
                        <div class="col-md-9 form-group">
                            <label for="">Nombre del Estudiante</label>
                            <input type="text" disabled class="form-control" id="nombre_estudiante" name="nombre_estudiante" placeholder="Nombre Estudiante" onblur="trim_cadena(this);" >   
                        </div>                                    
                        
                        <div class="col-md-3 form-group">                   
                             <br />   
                            <button type="button" id="btn_crear_usuario" class="btn btn-success btn-lg" onclick="form_buscar_estudiantes();">Buscar Estudiantes</button>
                        </div>  
                        
                        <div class="col-md-9 form-group"></div>                            
                        <div id="div_detalle_estudiante" class="col-md-9 form-group" style="display: none;">                            
                            <input type="hidden" id="id_persona" id="id_persona" value="0">   
                            <input type="hidden" id="id_academica" id="id_academica" value="0">       
                        </div>
                        
                        <div class="col-md-3 form-group">                   
                             <br />   
                            <button type="button" id="btn_crear_usuario" class="btn btn-success btn-lg" onclick="reset_estudiantes();">Limpiar Estudiantes</button>
                        </div>   
                        
                    </div>
                    
                      
                  </div>
                </div>
                
                <div class="panel panel-danger">
                  <div class="panel-heading">Buscar Empresa</div>
                  <div class="panel-body">
                      <div class="form-group">
                        <div class="col-md-9 form-group">
                            <label for="">Nombre de la Empresa</label>
                            <input type="text" disabled class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre Empresa" onblur="trim_cadena(this);" >   
                        </div>
                        <div class="col-md-3 form-group">                   
                             <br />   
                            <button type="button" id="btn_crear_usuario" class="btn btn-success btn-lg" onclick="form_buscar_empresas();">Buscar Empresa</button>
                        </div>  
                        
                        <div class="col-md-9 form-group"></div>
                        <div id="div_detalle_empresa" class="col-md-9 form-group" style="display: none;">
                            <input type="hidden" id="id_empresa" id="id_empresa" value="0">   
                        </div>
                        
                        <div class="col-md-3 form-group">                   
                             <br />   
                            <button type="button" id="btn_crear_usuario" class="btn btn-success btn-lg" onclick="reset_empresas();">Limpiar Empresas</button>
                        </div>  
                          
                          
                    </div>
                  </div>
                </div>
                
                <br /><br />
                
                <div class="panel panel-primary" id="div_persona_empresa" style="display: none;">
                    
                  <div class="panel-body">
                      <div class="form-group">
                          
                    </div>
                  </div>
                </div>
                
                
                
                
                
              </div>
            
            

            <div class="row">
                <div class="col-md-12">
                    <div id="principal_lista_estudiantes" style="width:110%; margin-left: -50px;" ></div>
                </div>
            </div>

        </div>
        <?php
        $contenido->footer();
        ?>

        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='seguimiento_estudiantes_v1.2.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>       
        <script src="../js/bootstrap/bootstrap-toggle.min.js"></script>
        
    </body>
</html>
