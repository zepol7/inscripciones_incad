

$(function(){
    $(".solo_numeros").keydown(function(event){
        //alert(event.keyCode);
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });
});

function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}

function formatearNumero(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}




function buscar_registro_id(){
	
    var txt_busca_id = $('#txt_busca_id').val();	
    var params = 'opcion=2&txt_busca_id=' + txt_busca_id;
    llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "");
	
}


function validar_editar_registro(estado_registro, codigo_verificacion, id_medica){
	
	if(estado_registro == 2){ // No se puede editar
		modalConfirmarNoEditar("Este registro no se puede editar porque ya esta en Planilla de Vuelo");
	}
	
	if(estado_registro == 1){ // Si se puede editar
		modalConfirmarEditar("Para editar Registro debe ingresar el Codigo de Verificacion", "validar_codigo_verificacion()", codigo_verificacion, id_medica);	
	}
	
}

function validar_codigo_verificacion(){
	
	var txt_codigo_verificacion = $('#txt_codigo_verificacion').val();
	var txt_codigo_verificacion_base = $('#hdd_codigo_verificacion_base').val();
	var hdd_id_medica = $('#hdd_id_medica').val();
	
	if(txt_codigo_verificacion == txt_codigo_verificacion_base){
		llamar_editar_registro(hdd_id_medica);
	}
	else{
		alert('El codigo es incorrecto');
	}
	
}



function llamar_crear_registro($txt_busca_id) {
	
	var params = 'opcion=1&num_documento_nuevo=' + $txt_busca_id;

    llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "");
}


function llamar_editar_registro(id_registro) {
	
	var params = 'opcion=1&id_registro=' + id_registro;

    llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "");
}


function llamar_imprimir_registro(id_registro) {
	
	var params = 'opcion=12&id_registro=' + id_registro + '&imprimir=1';

        llamarAjax("inscripcion_virtual.php", params, "principal_imprimir", "imprimir_pdf(principal_imprimir);");
}


function llamar_activar_registro(id_registro){
	modalConfirmarGuardar("Realmente desea ACTIVAR el registro ELIMINADO?", "activar_registro(" + id_registro + ")");
}


function llamar_eliminar_registro(id_registro){
	
	modalConfirmarGuardar("Realmente desea ELIMINAR el registro Selecionado?", "eliminar_registro(" + id_registro + ")");
	
}

function eliminar_registro(id_registro){
	
	var params = 'opcion=12&id_registro=' + id_registro;

	llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "validar_eliminar()");
	
}

function activar_registro(id_registro){
	
	var params = 'opcion=13&id_registro=' + id_registro;

	llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "validar_activar()");
	
}



function duplicar_en(input_origen, input_destino){
        
        var txt_input_origen = $('#'+input_origen).val();
        $('#'+input_destino).val(txt_input_origen);
       
        
        
}



function llamar_nueva_inscripcion(id_persona) {
	
	var params = 'opcion=1&id_registro_persona=' + id_persona;

    llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "");
}



function llamar_credito_incad(id_credito, id_academica, id_persona) {
    
    if(id_credito >= 0){    
        var params = 'opcion=1&id_credito=' + id_credito + '&id_academica=' + id_academica + '&id_persona=' + id_persona;
        llamarAjax("registro_credito_ajax.php", params, "principal_registro", "");
    }
}



function habilitar_campo(check, campo_texto){
	
	if( $(check).is(':checked') ) {    
        $("#"+campo_texto).removeAttr("disabled",false);
    } else {    
        $("#"+campo_texto).attr("disabled",true);
        $("#"+campo_texto).val("");
    }	
}

function habilitar_campo_combo(check, campo_texto, campo_combo){
	
	if( $(check).is(':checked') ) {    
        $("#"+campo_texto).removeAttr("disabled",false);
        $("#"+campo_combo).removeAttr("disabled",false);
    } else {    
        $("#"+campo_texto).attr("disabled",true);
        $("#"+campo_texto).val("");
        
        $("#"+campo_combo).attr("disabled",true);
        $("#"+campo_combo).val("");
    }
	
}

function calcular_edad(){
	
	//var txt_fecha_vuelo = $('#txt_fecha_vuelo').val();
	var txt_fecha_nacimiento = $('#txt_fecha_nacimiento').val();
	var d = new Date;
    let month = String(d.getMonth() + 1);
	let day = String(d.getDate());
	const year = String(d.getFullYear());
	
	if (month.length < 2) month = '0' + month;
	if (day.length < 2) day = '0' + day;
	
	var fecha_hoy = day+'/'+month+'/'+year;
	
	var params = 'opcion=3&txt_fecha_hoy=' + fecha_hoy + '&txt_fecha_nacimiento=' + txt_fecha_nacimiento;

    llamarAjax("inscripcion_virtual_ajax.php", params, "edad_persona", "");
	
}


function calcular_edad_hoy(div, campo_fecha_nac, campo_edad){
	
	var txt_fecha_nacimiento = $('#' + campo_fecha_nac).val();
	var d = new Date;
    let month = String(d.getMonth() + 1);
	let day = String(d.getDate());
	const year = String(d.getFullYear());
	
	if (month.length < 2) month = '0' + month;
	if (day.length < 2) day = '0' + day;
	
	var fecha_hoy = day+'/'+month+'/'+year;
	
	var params = 'opcion=3&txt_fecha_hoy=' + fecha_hoy + '&txt_fecha_nacimiento=' + txt_fecha_nacimiento + '&campo_edad=' + campo_edad;

    llamarAjax("registro_credito_ajax.php", params, div, "");
	
}



function validar_email( email ) 
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}


function buscar_persona_creada(){
	var txt_documento_persona = $('#documento_persona').val();
	
	var params = 'opcion=7&txt_documento_persona=' + txt_documento_persona;

    llamarAjax("inscripcion_virtual_ajax.php", params, "div_persona_buscar", "cargar_persona_creada();");
	
}

function validar_documento_identidad(){
	var txt_documento_persona = $('#txt_documento_persona').val();
	
	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	if(txt_documento_persona.length > 50){
		$('#txt_documento_persona').val('');
		
		$("#contenedor_error").addClass("contenedor_error_visible");
	    $('#contenedor_error').html('Error en el documento de Identidad');
		
	}
	
}

function validar_documento_identidad_buscar(){
	var txt_documento_persona = $('#txt_busca_id').val();
	
	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	if(txt_documento_persona.length > 50){
		$('#txt_busca_id').val('');
		
		$("#contenedor_error").addClass("contenedor_error_visible");
	    $('#contenedor_error').html('Error en el documento de Identidad');
		
	}
	
}


function cargar_persona_creada(){
	
	var hdd_persona_encontrada = $('#hdd_persona_encontrada').val();
	
	if(hdd_persona_encontrada > 0){
		$('#txt_documento_persona').val('');
		//modalConfirmarCargar("Esta persona ya existe, se van a cargar los datos encontrados", "llamar_editar_registro("+ hdd_persona_encontrada +")");
		modalConfirmarCargar("Este docuemtno ya existe, Debe ingresar otro documento", "reset_documento()");	
	}
	
	
}


function reset_documento(){
	$('#txt_documento_persona').val('');
}

/**
 * tipo_accion
 * 1 = Nuevo
 * 2 = Editar
 */
function validar_crear_editar_personas(tipo_accion) {
   
   	var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
   	$("#tipo_documento").removeClass("borde_error");
        $("#documento_persona").removeClass("borde_error");
        $("#lugar_documento").removeClass("borde_error");
        $("#fecha_documento").removeClass("borde_error");
        $("#nombre_persona").removeClass("borde_error");
        $("#apellido_persona").removeClass("borde_error");
        $("#fecha_nacimiento").removeClass("borde_error");
        $("#lugar_nacimiento").removeClass("borde_error");
        $("#tipo_sangre").removeClass("borde_error");
        $("#tel_casa_persona").removeClass("borde_error");
        $("#tel_movil_persona").removeClass("borde_error");
        $("#email_persona").removeClass("borde_error");
        $("#estado_civil").removeClass("borde_error");
        $("#direccion_casa").removeClass("borde_error");
        $("#estrato_persona").removeClass("borde_error");       
        $("#ciudad_residencia").removeClass("borde_error");
        $("#barrio_residencia").removeClass("borde_error");
        $("#nombre_contacto_1").removeClass("borde_error");
        $("#telefono_contacto_1").removeClass("borde_error");
        $("#parentesco_contacto_1").removeClass("borde_error");
        $("#nombre_contacto_2").removeClass("borde_error");
        $("#telefono_contacto_2").removeClass("borde_error");
        $("#parentesco_contacto_2").removeClass("borde_error");
        $("#nombre_contacto_3").removeClass("borde_error");
        $("#telefono_contacto_3").removeClass("borde_error");
        $("#parentesco_contacto_3").removeClass("borde_error");
        $("#nombre_acudiente").removeClass("borde_error");
        $("#telefono_acudiente").removeClass("borde_error");
        $("#parentesco_acudiente").removeClass("borde_error");
        $("#eps").removeClass("borde_error");
        $("#sexo").removeClass("borde_error");
        
        
        
        
   	if ($('#tipo_documento').val() == '') { $("#tipo_documento").addClass("borde_error"); result = 1; }
        if ($('#documento_persona').val() == '') { $("#documento_persona").addClass("borde_error"); result = 1; }
        if ($('#lugar_documento').val() == '') { $("#lugar_documento").addClass("borde_error"); result = 1; }
        if ($('#fecha_documento').val() == '') { $("#fecha_documento").addClass("borde_error"); result = 1; }
        if ($('#nombre_persona').val() == '') { $("#nombre_persona").addClass("borde_error"); result = 1; }
        if ($('#apellido_persona').val() == '') { $("#apellido_persona").addClass("borde_error"); result = 1; }
        if ($('#fecha_nacimiento').val() == '') { $("#fecha_nacimiento").addClass("borde_error"); result = 1; }
        if ($('#lugar_nacimiento').val() == '') { $("#lugar_nacimiento").addClass("borde_error"); result = 1; }
        if ($('#tipo_sangre').val() == '') { $("#tipo_sangre").addClass("borde_error"); result = 1; }
        if ($('#tel_casa_persona').val() == '') { $("#tel_casa_persona").addClass("borde_error"); result = 1; }
        if ($('#tel_movil_persona').val() == '') { $("#tel_movil_persona").addClass("borde_error"); result = 1; }
        
        if ($('#email_persona').val() == '') { 
            $("#email_persona").addClass("borde_error"); result = 1; 
        }
        else{
            if(!validar_email($('#email_persona').val()))
            {
                $("#email_persona").addClass("borde_error"); result = 1;
                msg_input=msg_input + "<br /> * El e-mail tiene formato Incorrecto";
            }
        }
        
        
        if ($('#estado_civil').val() == '') { $("#estado_civil").addClass("borde_error"); result = 1; }
        if ($('#direccion_casa').val() == '') { $("#direccion_casa").addClass("borde_error"); result = 1; }
        if ($('#estrato_persona').val() == '') { $("#estrato_persona").addClass("borde_error"); result = 1; }        
        if ($('#ciudad_residencia').val() == '') { $("#ciudad_residencia").addClass("borde_error"); result = 1; }
        if ($('#nombre_contacto_1').val() == '') { $("#nombre_contacto_1").addClass("borde_error"); result = 1; }
        if ($('#telefono_contacto_1').val() == '') { $("#telefono_contacto_1").addClass("borde_error"); result = 1; }
        if ($('#parentesco_contacto_1').val() == '') { $("#parentesco_contacto_1").addClass("borde_error"); result = 1; }
        
        if ($('#nombre_contacto_2').val() == '') { $("#nombre_contacto_2").addClass("borde_error"); result = 1; }
        if ($('#nombre_contacto_3').val() == '') { $("#nombre_contacto_3").addClass("borde_error"); result = 1; }
        
        
        /*if ($('#nombre_acudiente').val() == '') { $("#nombre_acudiente").addClass("borde_error"); result = 1; }
        if ($('#telefono_acudiente').val() == '') { $("#telefono_acudiente").addClass("borde_error"); result = 1; }
        if ($('#parentesco_acudiente').val() == '') { $("#parentesco_acudiente").addClass("borde_error"); result = 1; }*/
        if ($('#eps').val() == '') { $("#eps").addClass("borde_error"); result = 1; }        
        if ($('#sexo').val() == '') { $("#sexo").addClass("borde_error"); result = 1; }
        
        
       
	/*if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} */
            
        if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear la Pre-Inscripción?", "editar_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} 
        /*if(tipo_accion == 3){ //Crear con persona existente
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el registro?", "agregar_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	}*/
        
        
   
}



function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=4&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("inscripcion_virtual_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarCargar(titulo, funcion) {
    var params = 'opcion=8&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("inscripcion_virtual_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarEditar(titulo, funcion, codigo_verificacion, id_medica) {
	var params = 'opcion=9&titulo='+titulo+'&codigo_verificacion='+codigo_verificacion+'&id_medica='+id_medica+'&funcion='+funcion;
    llamarAjax("inscripcion_virtual_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarNoEditar(titulo) {
    var params = 'opcion=10&titulo=' + titulo;
    llamarAjax("inscripcion_virtual_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}


function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}


function crear_registro() {
    
        var tipo_documento = $('#tipo_documento').val();
        var documento_persona = $('#documento_persona').val();
        var lugar_documento = $('#lugar_documento').val();
        var fecha_documento = $('#fecha_documento').val();
        var nombre_persona = $('#nombre_persona').val();
        var apellido_persona = $('#apellido_persona').val();
        var fecha_nacimiento = $('#fecha_nacimiento').val();
        var lugar_nacimiento = $('#lugar_nacimiento').val();
        var tipo_sangre = $('#tipo_sangre').val();
        var tel_casa_persona = $('#tel_casa_persona').val();
        var tel_movil_persona = $('#tel_movil_persona').val();
        var email_persona = $('#email_persona').val();
        var estado_civil = $('#estado_civil').val();
        var direccion_casa = $('#direccion_casa').val();
        var estrato_persona = $('#estrato_persona').val();        
        var barrio_residencia = $('#barrio_residencia').val();                
        var ciudad_residencia = $('#ciudad_residencia').val();                
        var nombre_contacto_1 = $('#nombre_contacto_1').val();
        var telefono_contacto_1 = $('#telefono_contacto_1').val();
        var parentesco_contacto_1 = $('#parentesco_contacto_1').val();
        var nombre_contacto_2 = $('#nombre_contacto_2').val();
        var telefono_contacto_2 = $('#telefono_contacto_2').val();
        var parentesco_contacto_2 = $('#parentesco_contacto_2').val();
        var nombre_contacto_3 = $('#nombre_contacto_3').val();
        var telefono_contacto_3 = $('#telefono_contacto_3').val();
        var parentesco_contacto_3 = $('#parentesco_contacto_3').val();
        var nombre_acudiente = $('#nombre_acudiente').val();
        var telefono_acudiente = $('#telefono_acudiente').val();
        var parentesco_acudiente = $('#parentesco_acudiente').val();
        var eps = $('#eps').val();
        var sexo = $('#sexo').val();
        
        
        var tipo_inscripcion = $('#tipo_inscripcion').val();
        var fecha_inscripcion = $('#fecha_inscripcion').val();
        //var ultimo_estudio = $('#ultimo_estudio').val();
        var id_ultimo_estudio = $('#id_ultimo_estudio').val();
        
        var institucion_estudio = $('#institucion_estudio').val();
        var programa_incad = $('#programa_incad').val();        
        var id_programa = $('#id_programa').val();
        
        var jornada_incad = $('#jornada_incad').val();
        var valor_programa =  replaceAll($('#valor_programa').val(), ".", "" );  
        var descuento = replaceAll($('#descuento').val(), ".", "" );
        var valor_neto_pagar = replaceAll($('#valor_neto_pagar').val(), ".", "" );
        
        /*var array_forma_pago = new Array();         
        $("input[name='check_forma_pago']:checked").each(function () {
            array_forma_pago.push($(this).val());
        });*/
        //var entidad_financiera = $('#entidad_financiera').val();
        var id_forma_pago = $('#id_forma_pago').val();
        var id_entidad_financiera = $('#id_entidad_financiera').val();        
        
        var cuota_inicial = replaceAll($('#cuota_inicial').val(), ".", "" );
        var valor_financiar = replaceAll($('#valor_financiar').val(), ".", "" );
        var num_cuotas = $('#num_cuotas').val();
        var valor_cuota = replaceAll($('#valor_cuota').val(), ".", "" );
        var fecha_mensula_pago = $('#fecha_mensula_pago').val();        
        var array_conoce_incad = new Array(); 
        
        $("input[name='check_conoce_incad']:checked").each(function () {
            array_conoce_incad.push($(this).val());
        });
        
        var referido_por= $('#referido_por').val();
		
        var programa_tecnico= $('#programa_tecnico').val();
        var practica_laboral= $('#practica_laboral').val();
        
        var unidad_negocio= $('#unidad_negocio').val();
        var calendario_academico= $('#calendario_academico').val();
        var jornada= $('#jornada').val();
        
        var periodicidad_pago= $('#periodicidad_pago').val();
        var id_promotor= $('#id_promotor').val();
        
        var estado_matriculado= $('#estado_matriculado').val();
        
        
        
        

		
	   var params = 'opcion=5' +             
                        '&tipo_documento=' + tipo_documento +
                        '&documento_persona=' + documento_persona +
                        '&lugar_documento=' + lugar_documento +
                        '&fecha_documento=' + fecha_documento +
                        '&nombre_persona=' + nombre_persona +
                        '&apellido_persona=' + apellido_persona +
                        '&fecha_nacimiento=' + fecha_nacimiento +
                        '&lugar_nacimiento=' + lugar_nacimiento +
                        '&tipo_sangre=' + tipo_sangre +
                        '&tel_casa_persona=' + tel_casa_persona +
                        '&tel_movil_persona=' + tel_movil_persona +
                        '&email_persona=' + email_persona +
                        '&estado_civil=' + estado_civil +
                        '&direccion_casa=' + direccion_casa +   
                        '&estrato_persona=' + estrato_persona +                           
                        '&barrio_residencia=' + barrio_residencia +                                                
                        '&ciudad_residencia=' + ciudad_residencia +
                        '&nombre_contacto_1=' + nombre_contacto_1 +
                        '&telefono_contacto_1=' + telefono_contacto_1 +
                        '&parentesco_contacto_1=' + parentesco_contacto_1 +
                        '&nombre_contacto_2=' + nombre_contacto_2 +
                        '&telefono_contacto_2=' + telefono_contacto_2 +
                        '&parentesco_contacto_2=' + parentesco_contacto_2 +
                        '&nombre_contacto_3=' + nombre_contacto_3 +
                        '&telefono_contacto_3=' + telefono_contacto_3 +
                        '&parentesco_contacto_3=' + parentesco_contacto_3 +
                        '&nombre_acudiente=' + nombre_acudiente +
                        '&telefono_acudiente=' + telefono_acudiente +
                        '&parentesco_acudiente=' + parentesco_acudiente +
                        '&eps=' + eps +
                        '&sexo=' + sexo +
                        
                        '&tipo_inscripcion=' + tipo_inscripcion +
                        '&fecha_inscripcion=' + fecha_inscripcion +
                        '&id_ultimo_estudio=' + id_ultimo_estudio +
                        '&institucion_estudio=' + institucion_estudio +
                        '&programa_incad=' + programa_incad +
                        '&id_programa=' + id_programa +                      
                        '&jornada_incad=' + jornada_incad +
                        '&valor_programa=' + valor_programa +
                        '&descuento=' + descuento +
                        '&valor_neto_pagar=' + valor_neto_pagar +                        
                        '&id_forma_pago=' + id_forma_pago +                        
                        '&id_entidad_financiera=' + id_entidad_financiera +
                        '&cuota_inicial=' + cuota_inicial +
                        '&valor_financiar=' + valor_financiar +
                        '&num_cuotas=' + num_cuotas +
                        '&valor_cuota=' + valor_cuota +
                        '&fecha_mensula_pago=' + fecha_mensula_pago +
                        '&array_conoce_incad=' + array_conoce_incad +                        
                        '&referido_por=' + referido_por + 
                        '&programa_tecnico=' + programa_tecnico +
                        '&practica_laboral=' + practica_laboral +                        
                        '&unidad_negocio=' + unidad_negocio +
                        '&calendario_academico=' + calendario_academico +
                        '&jornada=' + jornada +                        
                        '&periodicidad_pago=' + periodicidad_pago +
                        '&id_promotor=' + id_promotor + 
                        '&estado_matriculado=' + estado_matriculado;   
            	 
    llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "validar_exito();");
    //llamarAjax("inscripcion_virtual.php", params, "principal_registro", "");

}


function editar_registro() {

    var hdd_id_persona = $('#hdd_id_persona').val();
    	
    var tipo_documento = $('#tipo_documento').val();
    var documento_persona = $('#documento_persona').val();
    var lugar_documento = $('#lugar_documento').val();
    var fecha_documento = $('#fecha_documento').val();
    var nombre_persona = $('#nombre_persona').val();
    var apellido_persona = $('#apellido_persona').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var lugar_nacimiento = $('#lugar_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();
    var tel_casa_persona = $('#tel_casa_persona').val();
    var tel_movil_persona = $('#tel_movil_persona').val();
    var email_persona = $('#email_persona').val();
    var estado_civil = $('#estado_civil').val();
    var direccion_casa = $('#direccion_casa').val();
    var estrato_persona = $('#estrato_persona').val();        
    var barrio_residencia = $('#barrio_residencia').val();        
    var ciudad_residencia = $('#ciudad_residencia').val();
    var nombre_contacto_1 = $('#nombre_contacto_1').val();
    var telefono_contacto_1 = $('#telefono_contacto_1').val();
    var parentesco_contacto_1 = $('#parentesco_contacto_1').val();
    var nombre_contacto_2 = $('#nombre_contacto_2').val();
    var telefono_contacto_2 = $('#telefono_contacto_2').val();
    var parentesco_contacto_2 = $('#parentesco_contacto_2').val();
    var nombre_contacto_3 = $('#nombre_contacto_3').val();
    var telefono_contacto_3 = $('#telefono_contacto_3').val();
    var parentesco_contacto_3 = $('#parentesco_contacto_3').val();
    var nombre_acudiente = $('#nombre_acudiente').val();
    var telefono_acudiente = $('#telefono_acudiente').val();
    var parentesco_acudiente = $('#parentesco_acudiente').val();
    var eps = $('#eps').val();
    var sexo = $('#sexo').val();

	
    var params = 'opcion=6' +                                    
                 '&tipo_documento=' + tipo_documento +
                 '&documento_persona=' + documento_persona +
                 '&lugar_documento=' + lugar_documento +
                 '&fecha_documento=' + fecha_documento +
                 '&nombre_persona=' + nombre_persona +
                 '&apellido_persona=' + apellido_persona +
                 '&fecha_nacimiento=' + fecha_nacimiento +
                 '&lugar_nacimiento=' + lugar_nacimiento +
                 '&tipo_sangre=' + tipo_sangre +
                 '&tel_casa_persona=' + tel_casa_persona +
                 '&tel_movil_persona=' + tel_movil_persona +
                 '&email_persona=' + email_persona +
                 '&estado_civil=' + estado_civil +
                 '&direccion_casa=' + direccion_casa +
                 '&estrato_persona=' + estrato_persona +   
                 '&barrio_residencia=' + barrio_residencia +
                 '&ciudad_residencia=' + ciudad_residencia +
                 '&nombre_contacto_1=' + nombre_contacto_1 +
                 '&telefono_contacto_1=' + telefono_contacto_1 +
                 '&parentesco_contacto_1=' + parentesco_contacto_1 +
                 '&nombre_contacto_2=' + nombre_contacto_2 +
                 '&telefono_contacto_2=' + telefono_contacto_2 +
                 '&parentesco_contacto_2=' + parentesco_contacto_2 +
                 '&nombre_contacto_3=' + nombre_contacto_3 +
                 '&telefono_contacto_3=' + telefono_contacto_3 +
                 '&parentesco_contacto_3=' + parentesco_contacto_3 +
                 '&nombre_acudiente=' + nombre_acudiente +
                 '&telefono_acudiente=' + telefono_acudiente +
                 '&parentesco_acudiente=' + parentesco_acudiente +
                 '&eps=' + eps +
                 '&sexo=' + sexo +                
                 '&hdd_id_persona=' + hdd_id_persona;
                 
            	 
        llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "validar_exito();");    	
	//llamarAjax("inscripcion_virtual.php", params, "principal_registro", "");    

}


function agregar_registro() {

    var hdd_id_persona = $('#hdd_id_persona').val();
    	
    var tipo_documento = $('#tipo_documento').val();
    var documento_persona = $('#documento_persona').val();
    var lugar_documento = $('#lugar_documento').val();
    var fecha_documento = $('#fecha_documento').val();
    var nombre_persona = $('#nombre_persona').val();
    var apellido_persona = $('#apellido_persona').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var lugar_nacimiento = $('#lugar_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();
    var tel_casa_persona = $('#tel_casa_persona').val();
    var tel_movil_persona = $('#tel_movil_persona').val();
    var email_persona = $('#email_persona').val();
    var estado_civil = $('#estado_civil').val();
    var direccion_casa = $('#direccion_casa').val();
    var barrio_residencia = $('#barrio_residencia').val(); 
    var estrato_persona = $('#estrato_persona').val();        
    var ciudad_residencia = $('#ciudad_residencia').val();
    var nombre_contacto_1 = $('#nombre_contacto_1').val();
    var telefono_contacto_1 = $('#telefono_contacto_1').val();
    var parentesco_contacto_1 = $('#parentesco_contacto_1').val();
    var nombre_contacto_2 = $('#nombre_contacto_2').val();
    var telefono_contacto_2 = $('#telefono_contacto_2').val();
    var parentesco_contacto_2 = $('#parentesco_contacto_2').val();
    var nombre_contacto_3 = $('#nombre_contacto_3').val();
    var telefono_contacto_3 = $('#telefono_contacto_3').val();
    var parentesco_contacto_3 = $('#parentesco_contacto_3').val();
    var nombre_acudiente = $('#nombre_acudiente').val();
    var telefono_acudiente = $('#telefono_acudiente').val();
    var parentesco_acudiente = $('#parentesco_acudiente').val();
    var eps = $('#eps').val();
    var sexo = $('#sexo').val();

    var tipo_inscripcion = $('#tipo_inscripcion').val();
    var fecha_inscripcion = $('#fecha_inscripcion').val();
    //var ultimo_estudio = $('#ultimo_estudio').val();
    var id_ultimo_estudio = $('#id_ultimo_estudio').val();
    
    var institucion_estudio = $('#institucion_estudio').val();
    var programa_incad = $('#programa_incad').val();
    var id_programa = $('#id_programa').val();
    var jornada_incad = $('#jornada_incad').val();
    var valor_programa =  replaceAll($('#valor_programa').val(), ".", "" );  
    var descuento = replaceAll($('#descuento').val(), ".", "" );
    var valor_neto_pagar = replaceAll($('#valor_neto_pagar').val(), ".", "" );
    
    /*var array_forma_pago = new Array();         
    $("input[name='check_forma_pago']:checked").each(function () {
        array_forma_pago.push($(this).val());
    });        
    var entidad_financiera = $('#entidad_financiera').val();*/
    
    var id_forma_pago = $('#id_forma_pago').val();
    var id_entidad_financiera = $('#id_entidad_financiera').val();        
    
    var cuota_inicial = replaceAll($('#cuota_inicial').val(), ".", "" );
    var valor_financiar = replaceAll($('#valor_financiar').val(), ".", "" );
    var num_cuotas = $('#num_cuotas').val();
    var valor_cuota = replaceAll($('#valor_cuota').val(), ".", "" );
    var fecha_mensula_pago = $('#fecha_mensula_pago').val();        
    var array_conoce_incad = new Array(); 

    $("input[name='check_conoce_incad']:checked").each(function () {
        array_conoce_incad.push($(this).val());
    });
    
    
    var referido_por= $('#referido_por').val();
    var programa_tecnico= $('#programa_tecnico').val();
    var practica_laboral= $('#practica_laboral').val();
    
    var unidad_negocio= $('#unidad_negocio').val();
    var calendario_academico= $('#calendario_academico').val();
    var jornada= $('#jornada').val();
    
    var periodicidad_pago= $('#periodicidad_pago').val();
    var id_promotor= $('#id_promotor').val();
    
    var estado_matriculado= $('#estado_matriculado').val();
	
    var params = 'opcion=11' +                                    
                 '&tipo_documento=' + tipo_documento +
                 '&documento_persona=' + documento_persona +
                 '&lugar_documento=' + lugar_documento +
                 '&fecha_documento=' + fecha_documento +
                 '&nombre_persona=' + nombre_persona +
                 '&apellido_persona=' + apellido_persona +
                 '&fecha_nacimiento=' + fecha_nacimiento +
                 '&lugar_nacimiento=' + lugar_nacimiento +
                 '&tipo_sangre=' + tipo_sangre +
                 '&tel_casa_persona=' + tel_casa_persona +
                 '&tel_movil_persona=' + tel_movil_persona +
                 '&email_persona=' + email_persona +
                 '&estado_civil=' + estado_civil +
                 '&direccion_casa=' + direccion_casa +
                 '&estrato_persona=' + estrato_persona +   
                 '&barrio_residencia=' + barrio_residencia +
                 '&ciudad_residencia=' + ciudad_residencia +
                 '&nombre_contacto_1=' + nombre_contacto_1 +
                 '&telefono_contacto_1=' + telefono_contacto_1 +
                 '&parentesco_contacto_1=' + parentesco_contacto_1 +
                 '&nombre_contacto_2=' + nombre_contacto_2 +
                 '&telefono_contacto_2=' + telefono_contacto_2 +
                 '&parentesco_contacto_2=' + parentesco_contacto_2 +
                 '&nombre_contacto_3=' + nombre_contacto_3 +
                 '&telefono_contacto_3=' + telefono_contacto_3 +
                 '&parentesco_contacto_3=' + parentesco_contacto_3 +
                 '&nombre_acudiente=' + nombre_acudiente +
                 '&telefono_acudiente=' + telefono_acudiente +
                 '&parentesco_acudiente=' + parentesco_acudiente +
                 '&eps=' + eps +
                 '&sexo=' + sexo +

                 '&tipo_inscripcion=' + tipo_inscripcion +
                 '&fecha_inscripcion=' + fecha_inscripcion +
                 '&id_ultimo_estudio=' + id_ultimo_estudio +
                 '&institucion_estudio=' + institucion_estudio +
                 '&programa_incad=' + programa_incad +
                 '&id_programa=' + id_programa +
                 '&jornada_incad=' + jornada_incad +
                 '&valor_programa=' + valor_programa +
                 '&descuento=' + descuento +
                 '&valor_neto_pagar=' + valor_neto_pagar +                        
                 '&id_forma_pago=' + id_forma_pago +                        
                 '&id_entidad_financiera=' + id_entidad_financiera +
                 '&cuota_inicial=' + cuota_inicial +
                 '&valor_financiar=' + valor_financiar +
                 '&num_cuotas=' + num_cuotas +
                 '&valor_cuota=' + valor_cuota +
                 '&fecha_mensula_pago=' + fecha_mensula_pago +
                 '&array_conoce_incad=' + array_conoce_incad +                        
                 '&referido_por=' + referido_por +
                 '&programa_tecnico=' + programa_tecnico +
                 '&practica_laboral=' + practica_laboral + 
                 '&unidad_negocio=' + unidad_negocio + 
                 '&calendario_academico=' + calendario_academico + 
                 '&jornada=' + jornada + 
                 '&periodicidad_pago=' + periodicidad_pago +
                 '&id_promotor=' + id_promotor +
                 '&estado_matriculado=' + estado_matriculado +
                 '&hdd_id_persona=' + hdd_id_persona;                 
            	 
        llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "validar_exito();");    	
	//llamarAjax("inscripcion_virtual_ajax.php", params, "principal_registro", "");    

}




/*
 * Tipo
 * 1=crear
 * 2=editar
 */
function validar_exito() {

    var hdd_exito = $('#hdd_exito').val();
    
    var texto_exito = "";
    
    texto_exito = 'Ha realizado la Pre-Inscripción Correctamente. <br /> Mas adelante un funcionario se comunicará con usted<br /> ';
	   
    	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        
        var params = "opcion=14&id_registro=" + hdd_exito;			
        llamarAjax("inscripcion_virtual_ajax.php", params, "d_envio_email", "");   
        
        
        
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        /*setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(900).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 9000);*/
        //volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar Registro');

        window.scroll(0, 0);
        etTimeout("$('#contenedor_error').slideUp(400).removeClass('contenedor_error_visible').addClass('contenedor_error')", 4000);
    }

}





