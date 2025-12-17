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
    
    font-family: Arial; 
    font-size: 12px;
    line-height: 20px;
    text-align: justify;
}

.parrafo_text_2{
    
    font-family: Arial; 
    font-size: 18px;
    line-height: 20px;
    text-align: justify;
}

.parrafo_text_3{
    
    font-family: Arial; 
    font-size: 14px;
    line-height: 23px;
    text-align: justify;
}


.parrafo_text_4{
    
    font-family: Arial; 
    font-size: 20px;
    line-height: 20px;
    text-align: justify;
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
include('FuncionNumeros.php');


require_once("../db/DbFormatos.php");
$dbformatos = new DbFormatos();



//Datos fortamos
$tabla_formatos_p = $dbformatos->getFomato(5);
$nombre_formato_p = $tabla_formatos_p['nombre_formato'];
$codigo_formato_p = $tabla_formatos_p['codigo_formato'];
$version_formato_p = $tabla_formatos_p['version_formato'];
$fecha_formato_p = $tabla_formatos_p['format_fecha_formato'];


$tabla_formatos_c = $dbformatos->getFomato(6);
$nombre_formato_c = $tabla_formatos_c['nombre_formato'];
$codigo_formato_c = $tabla_formatos_c['codigo_formato'];
$version_formato_c = $tabla_formatos_c['version_formato'];
$fecha_formato_c = $tabla_formatos_c['format_fecha_formato'];




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
$valor_programa_letras = numtoletras($tabla_registro['valor_programa']);
$entidad_financiera = $tabla_registro['entidad_financiera'];
$cuota_inicial = number_format($tabla_registro['cuota_inicial'], 0, '', '.');
$valor_financiar = number_format($tabla_registro['valor_financiar'], 0, '', '.'); 
$valor_financiar_letras = numtoletras($tabla_registro['valor_financiar']);
$num_cuotas = $tabla_registro['num_cuotas'];
$valor_cuota = number_format($tabla_registro['valor_cuota'], 0, '', '.'); 

$fecha_mensula_pago = $tabla_registro['format_fecha_mensula_pago'];

$registro_incad_conoce = $dbRegistroPersonas->getListaReferido($id_academica);
$incad_redes = $tabla_registro['incad_redes'];
$incad_fachada = $tabla_registro['incad_fachada'];
$incad_volantes = $tabla_registro['incad_volantes'];
$incad_radio = $tabla_registro['incad_radio'];
$referido_por = $tabla_registro['referido_por'];						



$tabla_credito = $dbRegistroPersonas->getCredito($_GET['id_credito']);

$id_credito = $tabla_credito['id_credito'];

$tipo_documento_deudor= $tabla_credito['nom_tipo_documento_deudor'];

$id_tipo_documento_deudor = $tabla_credito['tipo_documento_deudor'];
$cod_tipo_doc_deudor = $dbListas->getDetalle($id_tipo_documento_deudor);
$tipo_doc_deudor = $cod_tipo_doc_deudor['codigo_detalle'];

$documento_deudor= $tabla_credito['documento_deudor'];
$nombre_deudor= $tabla_credito['nombre_deudor'];
$apellido_deudor= $tabla_credito['apellido_deudor'];
$fecha_nacimiento_deudor= $tabla_credito['format_fecha_nacimiento_deudor'];
$edad_deudor= $tabla_credito['edad_deudor'];
$direccion_residencia_deudor= $tabla_credito['direccion_residencia_deudor'];
$barrio_residencia_deudor= $tabla_credito['barrio_residencia_deudor'];
$ciudad_residencia_deudor= $tabla_credito['ciudad_residencia_deudor'];
$tel_casa_deudor= $tabla_credito['tel_casa_deudor'];
$tel_movil_deudor= $tabla_credito['tel_movil_deudor'];
$email_deudor= $tabla_credito['email_deudor'];
$actividad_economica_deudor= $tabla_credito['actividad_economica_deudor'];
$ingreso_mensual_deudor = number_format($tabla_credito['ingreso_mensual_deudor'], 0, '', '.'); 				
$nombre_empresa_deudor= $tabla_credito['nombre_empresa_deudor'];
$direccion_empresa_deudor= $tabla_credito['direccion_empresa_deudor'];
$telefono_empresa_deudor= $tabla_credito['telefono_empresa_deudor'];
$tipo_vehiculo_deudor= $tabla_credito['nom_tipo_vehiculo_deudor'];
$placa_vehiculo_deudor= $tabla_credito['placa_vehiculo_deudor'];
$marca_vehiculo_deudor= $tabla_credito['marca_vehiculo_deudor'];
$modelo_vehiculo_deudor= $tabla_credito['modelo_vehiculo_deudor'];
$nom_ref_familiar_uno_deudor= $tabla_credito['nom_ref_familiar_uno_deudor'];
$tel_ref_familiar_uno_deudor= $tabla_credito['tel_ref_familiar_uno_deudor'];
$nom_ref_familiar_dos_deudor= $tabla_credito['nom_ref_familiar_dos_deudor'];
$tel_ref_familiar_dos_deudor= $tabla_credito['tel_ref_familiar_dos_deudor'];
$nom_ref_personal_uno_deudor= $tabla_credito['nom_ref_personal_uno_deudor'];
$tel_ref_personal_uno_deudor= $tabla_credito['tel_ref_personal_uno_deudor'];
$nom_ref_personal_dos_deudor= $tabla_credito['nom_ref_personal_dos_deudor'];
$tel_ref_personal_dos_deudor= $tabla_credito['tel_ref_personal_dos_deudor'];
$noti_direccion_deudor= $tabla_credito['noti_direccion_deudor'];
$noti_correo_deudor= $tabla_credito['noti_correo_deudor'];

$tipo_documento_codeudor= $tabla_credito['nom_tipo_documento_codeudor'];

$id_tipo_documento_codeudor = $tabla_credito['tipo_documento_codeudor'];
$cod_tipo_doc_codeudor = $dbListas->getDetalle($id_tipo_documento_codeudor);
$tipo_doc_codeudor = $cod_tipo_doc_codeudor['codigo_detalle'];


$documento_codeudor= $tabla_credito['documento_codeudor'];
$nombre_codeudor= $tabla_credito['nombre_codeudor'];
$apellido_codeudor= $tabla_credito['apellido_codeudor'];
$fecha_nacimiento_codeudor= $tabla_credito['format_fecha_nacimiento_codeudor'];
$edad_codeudor= $tabla_credito['edad_codeudor'];
$direccion_residencia_codeudor= $tabla_credito['direccion_residencia_codeudor'];
$barrio_residencia_codeudor= $tabla_credito['barrio_residencia_codeudor'];
$ciudad_residencia_codeudor= $tabla_credito['ciudad_residencia_codeudor'];
$tel_casa_codeudor= $tabla_credito['tel_casa_codeudor'];
$tel_movil_codeudor= $tabla_credito['tel_movil_codeudor'];
$email_codeudor= $tabla_credito['email_codeudor'];
$actividad_economica_codeudor= $tabla_credito['actividad_economica_codeudor'];				
$ingreso_mensual_codeudor = number_format($tabla_credito['ingreso_mensual_codeudor'], 0, '', '.'); 				
$nombre_empresa_codeudor= $tabla_credito['nombre_empresa_codeudor'];
$direccion_empresa_codeudor= $tabla_credito['direccion_empresa_codeudor'];
$telefono_empresa_codeudor= $tabla_credito['telefono_empresa_codeudor'];
$tipo_vehiculo_codeudor= $tabla_credito['nom_tipo_vehiculo_codeudor'];
$placa_vehiculo_codeudor= $tabla_credito['placa_vehiculo_codeudor'];
$marca_vehiculo_codeudor= $tabla_credito['marca_vehiculo_codeudor'];
$modelo_vehiculo_codeudor= $tabla_credito['modelo_vehiculo_codeudor'];
$nom_ref_familiar_uno_codeudor= $tabla_credito['nom_ref_familiar_uno_codeudor'];
$tel_ref_familiar_uno_codeudor= $tabla_credito['tel_ref_familiar_uno_codeudor'];
$nom_ref_familiar_dos_codeudor= $tabla_credito['nom_ref_familiar_dos_codeudor'];
$tel_ref_familiar_dos_codeudor= $tabla_credito['tel_ref_familiar_dos_codeudor'];
$nom_ref_personal_uno_codeudor= $tabla_credito['nom_ref_personal_uno_codeudor'];
$tel_ref_personal_uno_codeudor= $tabla_credito['tel_ref_personal_uno_codeudor'];
$nom_ref_personal_dos_codeudor= $tabla_credito['nom_ref_personal_dos_codeudor'];
$tel_ref_personal_dos_codeudor= $tabla_credito['tel_ref_personal_dos_codeudor'];
$noti_direccion_codeudor= $tabla_credito['noti_direccion_codeudor'];          
$noti_correo_codeudor= $tabla_credito['noti_correo_codeudor'];

$numero_pagare = $tabla_credito['numero_pagare_credito'];

if($numero_pagare<=0 || $numero_pagare == ''){
    $resultado_num_pagare = $dbRegistroPersonas->ObtenerNumeroPagare($id_credito);
    //$resultado_num_pagare = $numero_pagare." -- 600";
}
else{
    $resultado_num_pagare = $numero_pagare;
    //$resultado_num_pagare = $numero_pagare." -- 500";
}




?>
<page>
    
    
    <table border='1' style="text-align: center; font-size:12px; margin-left:80px;" >        
		<tr>
            <td rowspan="3" width="160"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td width="350"><p><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></p></td>
            <td width="100"><p><b>CODIGO: <?php echo($codigo_formato_p);?></b></p></td>
        </tr>
        <tr>
            <td><b>REGISTRO Y CONTROL</b></td>
            <td><b>VERSIÓN: <?php echo($version_formato_p);?></b></td>
        </tr>
        <tr>
            <td width="350"><p><b><?php echo($nombre_formato_p);?></b></p></td>
            <td><b>FECHA: <?php echo($fecha_formato_p);?></b></td>
        </tr>
    </table>
    <br />    <br /> 
    <table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_4"><b>PAGARE No. <?php echo($resultado_num_pagare);?></b></p>    
            </td>
        </tr>               
    </table>
    
    <br />    <br /> 
    <table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Yo (Nosotros) <b><?php echo($nombre_deudor." ".$apellido_deudor);?></b>, Identificado con cedula No. <b><?php echo($tipo_doc_deudor.". ".$documento_deudor);?></b>, y <b><?php echo($nombre_codeudor." ".$apellido_codeudor);?></b> con cedula de ciudadanía No. <b><?php echo($tipo_doc_codeudor.". ".$documento_codeudor);?></b>, mayor(es) de edad, de manera libre manifiesto (amos) que adeudo (amos) a INCAD S.A.S., identificada con el N.I.T.-900.567.627-6; la suma de: <b>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</b>, moneda legal, valor que me(nos) comprometo(emos) a pagar de la siguiente manera:</p>    
            </td>
        </tr>               
    </table>	
    <br />   
	<table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1"><b>1.</b> <b>CUOTAS:</b> los suscritos pagaremos el valor adeudado mediante: <b>(<?php echo($num_cuotas);?>)</b> cuotas, cada una por valor de: <b><?php echo($valor_cuota);?></b> </p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
			<p class="parrafo_text_1"><b>2.</b> <b>INTERES MORATORIOS</b>: En caso  de  vencimiento de cada una de las  cuotas causadas se cobrara a título de sanción un interés moratorio conforme a la tasa máxima legal permitida por la Superintendencia Financiera. <b>3. PERIODICIDAD DE PAGO:</b> Los deudores me (nos) obligo (amos) a pagar de manera mensual cada una de las cuotas, iniciando el primer pago el día___ de________________ de 20___ y las demás los ____ cada mes. <b>4. FORMA DE PAGO:</b> El pago de cada una de las cuotas deberá realizarse en las oficinas del INCAD S.A.S. en Bucaramanga o mediante consignación en la cuenta corriente No. 29190284010 del Banco Bancolombia a nombre del INCAD S.A.S. PARAGRAFO: Cuando el (los) deudores (es) realicemos pago mediante deposito en las cuentas anteriores citadas, me (nos) obligo (amos) a presentar a INCAD S.A.S. copia de la constancia de pago  entregada por el banco. En caso de omitir el presente compromiso entendemos que la obligación no  será descargada y  consecuentemente se cobraran interés corriente. <b>5. CLAUSULA ACELERATORIA:</b> En caso  de presentarse mora mayor a 60 días, el (los) deudores faculto (amos) al acreedor extinguir el plazo otorgado y en consecuencia, realice el cobro  del total del capital adecuado más los correspondientes intereses moratorios, diligenciando  los espacios en blanco, según la carta de instrucciones. <b>6. PAGO DE HONORARIOS GASTOS POR COBRANZA:</b> Judicial y/0 extraprocesal: En caso de presentarse mora en el pago, el (los)deudor (eres) manifestamos de manera libre e irrevocable que serán a mi (nuestra) costa el pago de los <br /> honorarios profesionales, agencias en derecho y demás gastos derivados de la cobranza de la obligación que hemos suscrito. PARAGRAFO: Si el acreedor realiza el pagode los honorarios de manera directa a la empresa o profesional de la cobranza, sea mi (nuestro) deber reintegrar este monte al acreedor. <b>7. AUTORIZACION PARA REPORTAR Y CONSULTAR INFORMACION:</b> Los aquí suscrito en condición de deudores, de manera expresa, libre e irrevocable autorizamos a INCAD S.A.S, a quien esta trasfiera sus derechos a cualquier título a CONSULTAR, TRANSFERIR, REPORTAR, mi (nuestra) información personal y/o comercial entregada o generada ocasión de mi relación contractual o respecto de mi (nuestro habito de pago  a las centrales de riesgo. <b>8. AUTORIZACION CESION DE DERECHOS:</b> El (los) aquí firmantes autorizo (amos) a INCAD S.A.S. a transferir o ceder a cualquier título, los derechos emanados a su  favor de la presente obligación, en consecuencia, aceptamos a los nuevos acreedores sustitutos y, me (nos) comprometo a honrar y seguir cumpliendo cada una de las obligaciones que he (hemos) adquirido.</p>    	
            </td>
        </tr>               
    </table>
    <br />   
    <table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_1">Se firma en la ciudad de Bucaramanga a los ______ del mes de _______del año _______.</p>    
            </td>
        </tr>               
    </table>
	
	<br />   <br />   
	
	
     <table class="tabla_info" border='0' style="margin-left:80px;">        
        <tr>
            <td width="285">
            <p>___________________________________</p>
            </td>
            <td width="285">            
            <p>____________________________________</p>
            </td>
        </tr> 
        <tr>
            <td width="285">
            <b>Firma Deudor:</b>
            </td>
            <td width="285">            
    	    <b>Firma Codeudor:</b>
            </td>
        </tr> 
        <tr>
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_deudor." ".$apellido_deudor);?></p></td>            
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_codeudor." ".$apellido_codeudor);?></p></td>            
        </tr>        
        <tr>
            <td><p><b>Cedula: </b> <?php echo($tipo_doc_deudor.". ".$documento_deudor);?></p></td>
            <td><p><b>Cedula: </b> <?php echo($tipo_doc_codeudor.". ".$documento_codeudor);?></p></td>            
        </tr>                 
        <tr>
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="90" ></td>
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="90" ></td>
        </tr>        
        
        
       
    </table>
        
    
</page>


<page>
    
    <table border='1' style="text-align: center; font-size:12px; margin-left:80px;" >        
		<tr>
            <td rowspan="3" width="160"><img src="../imagenes/incad_color.png" alt="Logo INCAD" width="150" ></td>
            <td width="350"><p><b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD</b></p></td>
            <td width="100"><p><b>CODIGO: <?php echo($codigo_formato_c);?></b></p></td>
        </tr>
        <tr>
            <td><b>REGISTRO Y CONTROL</b></td>
            <td><b>VERSIÓN: <?php echo($version_formato_c);?></b></td>
        </tr>
        <tr>
            <td width="350"><p><b><?php echo($nombre_formato_c);?></b></p></td>
            <td><b>FECHA: <?php echo($fecha_formato_c);?></b></td>
        </tr>
    </table>
    <br />    <br /> 
    <table border='0' style="margin-left:80px; text-align: center;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_2"><b>AUTORIZACION PARA LLENAR ESPACIOS EN BLANCO DEL PAGARE</b></p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_3">De conformidad con lo establecido en el Art. 622 del código de comercio, los autorizo expresa e irrevocablemente para llenar el pagare otorgado a su favor, en los espacios dejados en blanco y correspondiente a la fecha de vencimiento, periodos de pago, cuantía e intereses de mora de las obligaciones exigibles a nuestro cargo y a favor del <b>INSTITUTO DE CIENCIAS ADMINISTRATIVAS INCAD.</b></p>    
            </td>
        </tr>               
    </table>
	<br />   
	<table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_3">En mencionado título – valor era llenado por ustedes en cualquier tiempo sin previo aviso y de acuerdo a las siguientes instrucciones.</p>    
            </td>
        </tr>               
    </table>
	<br />   <br />   
	<table border='0' style="margin-left:90px;">        
        <tr>            
            <td width="610">
            <p class="parrafo_text_3"><b>1.</b> La fecha de vencimiento, periodos de pago y números de cuotas, será la del día en que sea llenado el título valor.</p>    
            </td>
        </tr>               
    </table>
	<br />
	<table border='0' style="margin-left:90px;">        
        <tr>            
            <td width="610">
            <p class="parrafo_text_3"><b>2.</b> La cuantía será igual al monto de todas las sumas de dinero que cualquiera de los firmantes este adeudando a favor de INCAD, directa o indirectamente, el día en que sea llenado, obligaciones que asumo (imos), como propias y que me (nos) comprometo (emos) a pagar de forma solidaria y mancomunadamente, incluyendo los intereses y las costas y honorarios de abogados en caso de cobro jurídico, en la ciudad de Bucaramanga</p>    
            </td>
        </tr>               
    </table>
	<br />
	<table border='0' style="margin-left:90px;">        
        <tr>            
            <td width="610">
            <p class="parrafo_text_3"><b>3.</b> En caso de incurra (amos) en mora, se causará un interés adicional, equivalente a la mitad del pactado inicialmente. En todo caso la tasa del interés de mora no podrá sobrepasar el límite vigente a esa misma fecha, de la máxima permitida por la superintendencia Financiera.</p>    
            </td>
        </tr>               
    </table>
	<br />
	<table border='0' style="margin-left:80px;">        
        <tr>            
            <td width="630">
            <p class="parrafo_text_3">El pagare así llenado será exigible inmediatamente y prestará merito ejecutivo sin ninguna otra formalidad o requerimiento alguno a los cuales renuncia el obligado. En mi calidad de titular de la obligación me comprometo a que en caso de incumplir las cláusulas del pagare a favor de INCAD, tiene la facultad de hacer exigible el Pagare ya mencionado en cualquier tiempo. </p>    
            </td>
        </tr>               
    </table>
	
	
   
	<br />   <br />   <br />   
	
	
	
     <table class="tabla_info" border='0' style="margin-left:80px;">        
        <tr>
            <td width="285">
            <p>___________________________________</p><br/>
                <b>Firma Deudor:</b>
            </td>
            <td width="285">            
            <p>____________________________________</p><br/>
                <b>Firma Codeudor:</b>
            </td>
        </tr> 
        <tr>
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_deudor." ".$apellido_deudor);?></p></td>            
            <td width="285"><p><b>Nombre: </b> <?php echo($nombre_codeudor." ".$apellido_codeudor);?></p></td>            
        </tr>        
        <tr>
            <td><p><b>Cedula: </b> <?php echo($tipo_doc_deudor.". ".$documento_deudor);?></p></td>
            <td><p><b>Cedula: </b> <?php echo($tipo_doc_codeudor.". ".$documento_codeudor);?></p></td>            
        </tr> 
        <tr>
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="100" ></td>
            <td><img src="../imagenes/huella.png" alt="Logo INCAD" width="100" ></td>
        </tr> 
        
       
    </table>
        
    
</page>
