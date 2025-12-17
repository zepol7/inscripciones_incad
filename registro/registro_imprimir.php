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


$variables = new Dbvariables();
$equipos = new DbEquipo();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbPerfiles = new DbPerfiles();
$dbRegistroPersonas = new DbRegistroPersonas();
//Busca por el registro medico de la seleccionada
$tabla_registro = $dbRegistroPersonas->getRegistroPersona($_GET['id_registro']);
$id_persona = $tabla_registro['id_persona'];
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


$id_academica = $tabla_registro['id_academica'];
$tipo_inscripcion = $tabla_registro['nom_tipo_inscripcion'];
$fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];
$ultimo_estudio = $tabla_registro['ultimo_estudio'];
$institucion_estudio = $tabla_registro['institucion_estudio'];
$programa_incad = $tabla_registro['programa_incad'];
$jornada_incad = $tabla_registro['jornada_incad'];
$valor_programa = number_format($tabla_registro['valor_programa'], 0, '', '.'); 
$descuento = number_format($tabla_registro['descuento'], 0, '', '.'); 
$valor_neto_pagar = number_format($tabla_registro['valor_neto_pagar'], 0, '', '.'); 
$forma_pago = $tabla_registro['forma_pago'];
$registro_formas_pago = $dbRegistroPersonas->getListaFormasPago($id_academica);

$entidad_financiera = $tabla_registro['entidad_financiera'];
$cuota_inicial = number_format($tabla_registro['cuota_inicial'], 0, '', '.');
$valor_financiar = number_format($tabla_registro['valor_financiar'], 0, '', '.'); 
$num_cuotas = $tabla_registro['num_cuotas'];
$valor_cuota = number_format($tabla_registro['valor_cuota'], 0, '', '.'); 
$fecha_mensula_pago = $tabla_registro['format_fecha_mensula_pago'];

$registro_incad_conoce = $dbRegistroPersonas->getListaReferido($id_academica);
$incad_redes = $tabla_registro['incad_redes'];
$incad_fachada = $tabla_registro['incad_fachada'];
$incad_volantes = $tabla_registro['incad_volantes'];
$incad_radio = $tabla_registro['incad_radio'];
$referido_por = $tabla_registro['referido_por'];						
$titulo_formulario = $lang["r_titulo_editar"]; 





?>
<page>
    
    <table border='1' style="width:100%; text-align: center;" >        
        <tr>
            <td rowspan="3" width="200"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td> <b> INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b> </td>
            <td width="200"><b>C&oacute;digo: F-GCO-20</b></td>
        </tr>
        <tr>
            <td><b>GESTI&Oacute;N COMECIAL</b></td>
            <td><b>Versi&oacute;n 1</b></td>
        </tr>
        <tr>
            <td><b>INSCRIPCI&Oacute;N DEL ESTUDIANTE</b></td>
            <td><b>Fecha: 11/03/2019</b></td>
        </tr>
    </table>
    <br />    
    
    <table class='tabla_info'>        
        <tr>
            <th style="text-align: center;" colspan="4"><b>DATOS PERSONALES</b></th>
        </tr>        
        <tr>
            <td><b>Nombre del Estudiante: </b></td>
            <td colspan="3"><?php echo($nombre_persona." ".$apellido_persona);?></td>                       
        </tr>
        <tr>
            <td><b>Tipo de Documento: </b></td>
            <td width="185"><?php echo($tipo_documento);?></td>
            <td><b>N&uacute;mero de Documento: </b></td>
            <td width="185"><?php echo($documento_persona);?></td>
        </tr>
        <tr>
            <td><b>Lugar de Expedici&oacute;n: </b></td>
            <td><?php echo($lugar_documento);?></td>
            <td><b>Fecha de Expedici&oacute;n: </b></td>
            <td><?php echo($fecha_documento);?></td>
        </tr>
        
        <tr>
            <td><b>Lugar de Nacimiento: </b></td>
            <td><?php echo($lugar_nacimiento);?></td>
            <td><b>Fecha de Nacimiento: </b></td>
            <td><?php echo($fecha_nacimiento);?></td>
        </tr>
        
        <tr>
            <td><b>Tipo de sangre: </b></td>
            <td><?php echo($tipo_sangre);?></td>
            <td><b>Estado civil: </b></td>
            <td><?php echo($estado_civil);?></td>
        </tr>
        
        <tr>
            <td><b>Direcci&oacute;n Residencia : </b></td>
            <td colspan="3"><?php echo($direccion_casa);?></td>
        </tr>
        <tr>
            <td><b>Barrio de Residencia: </b></td>
            <td><?php echo($barrio_residencia);?></td>
            <td><b>Ciudad de Residencia: </b></td>
            <td><?php echo($ciudad_residencia);?></td>            
        </tr>
        <tr>
            <td><b>Tel&eacute;fono Casa: </b></td>
            <td><?php echo($tel_casa_persona);?></td>
            <td><b>Tel&eacute;fono Celular: </b></td>
            <td><?php echo($tel_movil_persona);?></td>            
        </tr>
        <tr>
            <td><b>Correo electr&oacute;nico: </b></td>
            <td><?php echo($email_persona);?></td>
            <td><b>EPS: </b></td>
            <td><?php echo($eps);?></td>            
        </tr>        
    </table>
    
    <br />    
    <table class='tabla_info'>        
        <tr>
            <th style="text-align: center;" colspan="6"><b>PERSONAS DE CONTACTO</b></th>
        </tr>        
        <tr>
            <td><b>Nombre 1:</b></td>
            <td width="139"><?php echo($nombre_contacto_1);?></td>
            <td><b>Tel&eacute;fono 1</b></td>
            <td width="139"><?php echo($telefono_contacto_1);?></td>
            <td><b>Parentesco 1</b></td>
            <td width="139"><?php echo($parentesco_contacto_1);?></td>
        </tr>
        <tr>
            <td><b>Nombre 2:</b></td>
            <td><?php echo($nombre_contacto_2);?></td>
            <td><b>Tel&eacute;fono 2</b></td>
            <td><?php echo($telefono_contacto_2);?></td>
            <td><b>Parentesco 2</b></td>
            <td><?php echo($parentesco_contacto_2);?></td>
        </tr>
        <tr>
            <td><b>Nombre 3:</b></td>
            <td><?php echo($nombre_contacto_3);?></td>
            <td><b>Tel&eacute;fono 2</b></td>
            <td><?php echo($telefono_contacto_3);?></td>
            <td><b>Parentesco 3</b></td>
            <td><?php echo($parentesco_contacto_3);?></td>
        </tr>
        <tr>
            <td><b>Acudiente:</b></td>
            <td><?php echo($nombre_acudiente);?></td>
            <td><b>Tel&eacute;fono</b></td>
            <td><?php echo($telefono_acudiente);?></td>
            <td><b>Parentesco</b></td>
            <td><?php echo($parentesco_acudiente);?></td>
        </tr>                     
    </table>
    <br />
    
    <table class='tabla_info'>        
        <tr>
            <th style="text-align: center;" colspan="4"><b>INFORMACI&Oacute;N ACAD&Eacute;MICA</b></th>
        </tr>        
        <tr>
            <td><b>Tipo de Inscripci&oacute;n: </b></td>
            <td width="172"><?php echo($tipo_inscripcion);?></td>
            <td><b>Fecha de Inscripci&oacute;n: </b></td>
            <td width="172"><?php echo($fecha_inscripcion);?></td>
        </tr>
        <tr>
            <td><b>&Uacute;ltimo Estudio Aprobado: </b></td>
            <td><?php echo($ultimo_estudio);?></td>
            <td><b>Instituci&oacute;n: </b></td>
            <td><?php echo($institucion_estudio);?></td>
        </tr>        
        <tr>
            <td><b>Programa Acad&eacute;mico INCAD: </b></td>
            <td><?php echo($programa_incad);?></td>
            <td><b>Jornada: </b></td>
            <td><?php echo($jornada_incad);?></td>
        </tr>
        
        <tr>
            <td><b>Valor del Programa: </b></td>
            <td><?php echo($valor_programa);?></td>
            <td><b>Descuento: </b></td>
            <td><?php echo($descuento);?></td>
        </tr>
        
        <tr>
            <td><b>Valor Neto a Pagar: </b></td>
            <td colspan="3"><?php echo($valor_neto_pagar);?></td>
        </tr>
        
        <tr>
            <td><b>Formas de Pago:</b></td>
            <td colspan="3">
            <?php
            
            $tabla_formas_pago = $dbListas->getListaDetalles(6);
            $i = 1;
            foreach ($tabla_formas_pago as $fila_formas_pago) {
                $id_forma_pago = $fila_formas_pago['id_detalle'];
                $nombre_forma = $fila_formas_pago['nombre_detalle'];

                $checked = '';
                //Se recorre el array donde tien los perfiles encontrados
                if (count($registro_formas_pago) != 0) {
                    foreach ($registro_formas_pago as $fila_formas_pago) {
                        $id_forma_pago_inscripcion = $fila_formas_pago['id_detalle'];
                        if ($id_forma_pago == $id_forma_pago_inscripcion) {
                            $checked = 'checked';									
                        }
                    }
                }
                if ($i == 1) {
                    ?>
                    
                    <label>
                    <?php 
                    echo($nombre_forma." ");
                    if($checked == 'checked'){echo('<span>|X|</span>');}else{echo('<span>|--|</span>');}
                    ?>
                    </label>                        
                    <?php
                    $i = 0;
                } else {
                    ?>                   
                    <label>
                    <?php 
                    echo($nombre_forma." ");
                    if($checked == 'checked'){echo('<span>|X|</span>');}else{echo('<span>|--|</span>');}
                    ?>                        
                    </label>                     
                    <?php
                    $i = $i + 1;
                }
            }
            ?>
            </td>
        </tr>
        <tr>
            <td><b>Entidad Financiera: </b></td>
            <td colspan="3"><?php echo($entidad_financiera);?></td>
        </tr>
        
        <tr>
            <td><b>Cuota Inicial: </b></td>
            <td><?php echo($cuota_inicial);?></td>
            <td><b>Valor a Financiar: </b></td>
            <td><?php echo($valor_financiar);?></td>            
        </tr>
        <tr>
            <td><b>N&uacute;meros de cuotas: </b></td>
            <td><?php echo($num_cuotas);?></td>
            <td><b>Valor cuotas : </b></td>
            <td><?php echo($valor_cuota);?></td>
        </tr>
        <tr>
            <td><b>Fecha mensual de Pago : </b></td>
            <td colspan="3"><?php echo($fecha_mensula_pago);?></td>
        </tr>
        
        <tr>
            <td><b>Como se enter&oacute; de INCAD?:</b></td>
            <td colspan="3">
            <?php
            
            $tabla_lista_conoce = $dbListas->getListaDetalles(8);
            $i = 1;
            foreach ($tabla_lista_conoce as $fila_lista_conoce) {
                $id_conoce = $fila_lista_conoce['id_detalle'];
                $nombre_conoce = $fila_lista_conoce['nombre_detalle'];

                $checked = '';
                //Se recorre el array donde tien los perfiles encontrados
                if (count($registro_incad_conoce) != 0) {
                    foreach ($registro_incad_conoce as $fila_conoce_incad) {
                        $id_conoce_pago_inscripcion = $fila_conoce_incad['id_detalle'];
                        if ($id_conoce == $id_conoce_pago_inscripcion) {
                            $checked = 'checked';
                        }
                    }
                }
                if ($i == 1) {
                    ?>                    
                    <label>
                    <?php echo($nombre_conoce);
                    if($checked == 'checked'){echo('<span>|X|</span>');}else{echo('<span>|--|</span>');}
                    ?>
                    </label>                  

                    <?php
                    $i = 0;
                } else {
                    ?>                    
                    <label>
                    <?php echo($nombre_conoce);
                    if($checked == 'checked'){echo('<span>|X|</span>');}else{echo('<span>|--|</span>');}
                    ?>                    
                    </label>                    
                    <?php
                    $i = $i + 1;
                }
            }
            ?>
            </td>
        </tr>
        
        <tr>
            <td><b>Referido por: </b></td>
            <td colspan="3"><?php echo($referido_por);?></td>
        </tr>
              
    </table>
    <br /><br /><br /><br /><br />
    
    <table border='0' style="width:100%; text-align: center;" >        
        <tr>
            <td width="360"><b>___________________________________</b> </td>
            <td width="360"><b>___________________________________</b> </td>
        </tr>        
        <tr>
            <td><b>Alumno</b> </td>
            <td><b>Acudiente</b> </td>
        </tr>       
    </table>
    <br /><br /><br />
    <table border='0' style="width:100%; text-align: center;" >        
        <tr>
            <td width="700"><b>___________________________________</b> </td>
        </tr>        
        <tr>
            <td><b>Promotor</b> </td>
        </tr>       
    </table>
    
        
    
</page>
