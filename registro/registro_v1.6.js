

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

function calcular_pago_neto(){
    var valor_programa = $('#valor_programa').val();
    var descuento = $('#descuento').val();
    var valor_neto = valor_programa;
    
    valor_programa = replaceAll(valor_programa, ".", "" );
    descuento = replaceAll(descuento, ".", "" );
    valor_neto = replaceAll(valor_neto, ".", "" );
    
    if(valor_programa > 0 && descuento > 0){
       var valor_neto = valor_programa - descuento;
    }
    
    if (valor_neto < 0){
        alert("El valor del descuento debe ser menor del valor de programa");
        $('#valor_programa').val('');
        $('#descuento').val('');
        $('#valor_neto_pagar').val('');
    }
    else{         
        $('#valor_neto_pagar').val(valor_neto);
    }
}


function calcular_valor_financiar(){
    var valor_neto_pagar = $('#valor_neto_pagar').val();
    var cuota_inicial = $('#cuota_inicial').val();
    var valor_financiar = valor_neto_pagar;
    
    
    valor_neto_pagar = replaceAll(valor_neto_pagar, ".", "" );
    cuota_inicial = replaceAll(cuota_inicial, ".", "" );
    valor_financiar = replaceAll(valor_financiar, ".", "" );
    
    if(valor_neto_pagar > 0 && cuota_inicial > 0){
       var valor_financiar = valor_neto_pagar - cuota_inicial;
    }
    
    if (valor_financiar < 0){
        alert("El valor de la cuento inicial no puede ser mayor que el valor neto");
        $('#valor_financiar').val('');
        $('#cuota_inicial').val('');        
    }
    else{         
        $('#valor_financiar').val(valor_financiar);
    }
}


function mostrar_opciones(id){
    
    var check_estado = $(id).is(':checked') ? 1 : 0;
    
    if(id.value == 32 && check_estado == 1){
        $('#div_credito_incad').slideDown(600).css('display', 'block')
    }
    
    if(id.value == 32 && check_estado == 0){
        $('#div_credito_incad').slideDown(600).css('display', 'none')
        $('#cuota_inicial').val('0');
        $('#valor_financiar').val('0');
        $('#num_cuotas').val('0');
        $('#valor_cuota').val('0');
        $('#fecha_mensula_pago').val('1');
        
    }
    
    if(id.value == 23 && check_estado == 1){
        $('#div_entidad_financiera').slideDown(600).css('display', 'block')
    }
    
    if(id.value == 23 && check_estado == 0){
        $('#div_entidad_financiera').slideDown(600).css('display', 'none')
        $('#entidad_financiera').val('');        
    }
    
    
    if(id.value == 39 && check_estado == 1){
        $('#div_referido_por').slideDown(600).css('display', 'block')
    }
    
    if(id.value == 39 && check_estado == 0){
        $('#div_referido_por').slideDown(600).css('display', 'none')
        $('#referido_por').val('');        
    }
    
    
}



function buscar_registro_id(){
	
	var txt_busca_id = $('#txt_busca_id').val();
	
	var params = 'opcion=2&txt_busca_id=' + txt_busca_id;

    llamarAjax("registro_ajax.php", params, "principal_registro", "");
	
}


function validar_editar_registro(estado_registro, codigo_verificacion, id_medica){
	
	if(estado_registro == 2){ // No se puede editar
		modalConfirmarNoEditar("Este registro no se puede editar porque ya esta en Planilla de Vuelo")
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

    llamarAjax("registro_ajax.php", params, "principal_registro", "");
}


function llamar_editar_registro(id_registro) {
	
	var params = 'opcion=1&id_registro=' + id_registro;

    llamarAjax("registro_ajax.php", params, "principal_registro", "");
}


function llamar_imprimir_registro(id_registro) {
	
	var params = 'opcion=12&id_registro=' + id_registro + '&imprimir=1';

        llamarAjax("registro_ajax.php", params, "principal_imprimir", "imprimir_pdf(principal_imprimir);");
}


function duplicar_en(input_origen, input_destino){
        
        var txt_input_origen = $('#'+input_origen).val();
        $('#'+input_destino).val(txt_input_origen);
       
        
        
}



function llamar_nueva_inscripcion(id_persona) {
	
	var params = 'opcion=1&id_registro_persona=' + id_persona;

    llamarAjax("registro_ajax.php", params, "principal_registro", "");
}



function llamar_credito_incad(id_credito, id_academica, id_persona) {
    
    if(id_credito >= 0){    
        var params = 'opcion=1&id_credito=' + id_credito + '&id_academica=' + id_academica + '&id_persona=' + id_persona;
        llamarAjax("registro_credito_ajax.php", params, "principal_registro", "");
    }
}


/**
 * 
 * @param {Object} tipo_entrada 
 * 1=Ver todos
 * 2=Buscar
 * 
 */
function ver_buscar_equipos(tipo_entrada) {

    var params = 'opcion=3&txt_busca_equipos=' + $('#txt_busca_equipos').val() + '&tipo_entrada=' + tipo_entrada;

    llamarAjax("equipos_ajax.php", params, "principal_equipos", "");
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

    llamarAjax("registro_ajax.php", params, "edad_persona", "");
	
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

    llamarAjax("registro_ajax.php", params, "div_persona_buscar", "cargar_persona_creada();");
	
}

function validar_documento_identidad(){
	var txt_documento_persona = $('#txt_documento_persona').val();
	
	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	if(txt_documento_persona.length > 13){
		$('#txt_documento_persona').val('');
		
		$("#contenedor_error").addClass("contenedor_error_visible");
	    $('#contenedor_error').html('Error en el documento de Identidad');
		
	}
	
}

function validar_documento_identidad_buscar(){
	var txt_documento_persona = $('#txt_busca_id').val();
	
	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	if(txt_documento_persona.length > 13){
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
        
        $("#tipo_inscripcion").removeClass("borde_error");
        $("#fecha_inscripcion").removeClass("borde_error");
        $("#ultimo_estudio").removeClass("borde_error");
        $("#institucion_estudio").removeClass("borde_error");
        $("#programa_incad").removeClass("borde_error");
        //$("#jornada_incad").removeClass("borde_error");
        $("#valor_programa").removeClass("borde_error");
        $("#descuento").removeClass("borde_error");
        $("#valor_neto_pagar").removeClass("borde_error");
        
        $("#entidad_financiera").removeClass("borde_error");
        $("#credito_incad").removeClass("borde_error");
        $("#cuota_inicial").removeClass("borde_error");
        $("#valor_financiar").removeClass("borde_error");
        $("#num_cuotas").removeClass("borde_error");
        $("#valor_cuota").removeClass("borde_error");
        $("#fecha_mensula_pago").removeClass("borde_error");
        
        $("#referido_por").removeClass("borde_error");
        $("#programa_tecnico").removeClass("borde_error");
        $("#practica_laboral").removeClass("borde_error");
        
        $("#unidad_negocio").removeClass("borde_error");
        $("#calendario_academico").removeClass("borde_error");
        $("#jornada").removeClass("borde_error");

   
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
        
        if ($('#tipo_inscripcion').val() == '') { $("#tipo_inscripcion").addClass("borde_error"); result = 1; }
        if ($('#fecha_inscripcion').val() == '') { $("#fecha_inscripcion").addClass("borde_error"); result = 1; }
        if ($('#ultimo_estudio').val() == '') { $("#ultimo_estudio").addClass("borde_error"); result = 1; }
        if ($('#institucion_estudio').val() == '') { $("#institucion_estudio").addClass("borde_error"); result = 1; }
        if ($('#programa_incad').val() == '') { $("#programa_incad").addClass("borde_error"); result = 1; }
        if ($('#jornada_incad').val() == '') { $("#jornada_incad").addClass("borde_error"); result = 1; }
        if ($('#valor_programa').val() == '') { $("#valor_programa").addClass("borde_error"); result = 1; }
        if ($('#descuento').val() == '') { $("#descuento").addClass("borde_error"); result = 1; }
        if ($('#valor_neto_pagar').val() == '') { $("#valor_neto_pagar").addClass("borde_error"); result = 1; }
        
        if ($('input[name="check_forma_pago"]').is(':checked')) {
            
        } else {
            result = 1;
            msg_input=msg_input + "<br /> * Debe seleccionar una Forma de Pago";
        }

        $("input[name='check_forma_pago']:checked").each(function () {
            if($(this).val() == 32){
                
                if ($('#cuota_inicial').val() == '') { $("#cuota_inicial").addClass("borde_error"); result = 1; }
                if ($('#valor_financiar').val() == '') { $("#valor_financiar").addClass("borde_error"); result = 1; }
                if ($('#num_cuotas').val() == '') { $("#num_cuotas").addClass("borde_error"); result = 1; }
                if ($('#valor_cuota').val() == '') { $("#valor_cuota").addClass("borde_error"); result = 1; }
                if ($('#fecha_mensula_pago').val() == '') { $("#fecha_mensula_pago").addClass("borde_error"); result = 1; }
            }
            
            if($(this).val() == 23){
                if ($('#entidad_financiera').val() == '') { $("#entidad_financiera").addClass("borde_error"); result = 1; }
            }

            
        });
        
        
        
        $("input[name='check_conoce_incad']:checked").each(function () {
            if($(this).val() == 39){
                if ($('#referido_por').val() == '') { $("#referido_por").addClass("borde_error"); result = 1; }
            }
        });
		
        if ($('#programa_tecnico').val() == '') { $("#programa_tecnico").addClass("borde_error"); result = 1; }
        if ($('#practica_laboral').val() == '') { $("#practica_laboral").addClass("borde_error"); result = 1; }
        
        if ($('#unidad_negocio').val() == '') { $("#unidad_negocio").addClass("borde_error"); result = 1; }
        if ($('#calendario_academico').val() == '') { $("#calendario_academico").addClass("borde_error"); result = 1; }
        if ($('#jornada').val() == '') { $("#jornada").addClass("borde_error"); result = 1; }
        
        
       
	if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea editar el registro?", "editar_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} else if(tipo_accion == 3){ //Crear con persona existente
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el registro?", "agregar_registro()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	}
        
        
   
}



function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=4&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("registro_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarCargar(titulo, funcion) {
    var params = 'opcion=8&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("registro_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarEditar(titulo, funcion, codigo_verificacion, id_medica) {
	var params = 'opcion=9&titulo='+titulo+'&codigo_verificacion='+codigo_verificacion+'&id_medica='+id_medica+'&funcion='+funcion;
    llamarAjax("registro_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function modalConfirmarNoEditar(titulo) {
    var params = 'opcion=10&titulo=' + titulo;
    llamarAjax("registro_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
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
        var ultimo_estudio = $('#ultimo_estudio').val();
        var institucion_estudio = $('#institucion_estudio').val();
        var programa_incad = $('#programa_incad').val();
        var jornada_incad = $('#jornada_incad').val();
        var valor_programa =  replaceAll($('#valor_programa').val(), ".", "" );  
        var descuento = replaceAll($('#descuento').val(), ".", "" );
        var valor_neto_pagar = replaceAll($('#valor_neto_pagar').val(), ".", "" );
        var array_forma_pago = new Array();         
        
        $("input[name='check_forma_pago']:checked").each(function () {
            array_forma_pago.push($(this).val());
        });        
        var entidad_financiera = $('#entidad_financiera').val();
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
                        '&ultimo_estudio=' + ultimo_estudio +
                        '&institucion_estudio=' + institucion_estudio +
                        '&programa_incad=' + programa_incad +
                        '&jornada_incad=' + jornada_incad +
                        '&valor_programa=' + valor_programa +
                        '&descuento=' + descuento +
                        '&valor_neto_pagar=' + valor_neto_pagar +                        
                        '&array_forma_pago=' + array_forma_pago +                        
                        '&entidad_financiera=' + entidad_financiera +
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
                        '&jornada=' + jornada;   
            	 
    llamarAjax("registro_ajax.php", params, "principal_registro", "validar_exito();");
    //llamarAjax("registro_ajax.php", params, "principal_registro", "");

}


function editar_registro() {

    var hdd_id_persona = $('#hdd_id_persona').val();
    var hdd_id_academica = $('#hdd_id_academica').val();
	
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
    var ultimo_estudio = $('#ultimo_estudio').val();
    var institucion_estudio = $('#institucion_estudio').val();
    var programa_incad = $('#programa_incad').val();
    var jornada_incad = $('#jornada_incad').val();
    var valor_programa =  replaceAll($('#valor_programa').val(), ".", "" );  
    var descuento = replaceAll($('#descuento').val(), ".", "" );
    var valor_neto_pagar = replaceAll($('#valor_neto_pagar').val(), ".", "" );
    var array_forma_pago = new Array();         

    $("input[name='check_forma_pago']:checked").each(function () {
        array_forma_pago.push($(this).val());
    });        
    var entidad_financiera = $('#entidad_financiera').val();
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

                 '&tipo_inscripcion=' + tipo_inscripcion +
                 '&fecha_inscripcion=' + fecha_inscripcion +
                 '&ultimo_estudio=' + ultimo_estudio +
                 '&institucion_estudio=' + institucion_estudio +
                 '&programa_incad=' + programa_incad +
                 '&jornada_incad=' + jornada_incad +
                 '&valor_programa=' + valor_programa +
                 '&descuento=' + descuento +
                 '&valor_neto_pagar=' + valor_neto_pagar +                        
                 '&array_forma_pago=' + array_forma_pago +                        
                 '&entidad_financiera=' + entidad_financiera +
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
                 '&hdd_id_persona=' + hdd_id_persona +
                 '&hdd_id_academica=' +hdd_id_academica;					   
            	 
        llamarAjax("registro_ajax.php", params, "principal_registro", "validar_exito();");    	
	//llamarAjax("registro_ajax.php", params, "principal_registro", "");    

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
    var ultimo_estudio = $('#ultimo_estudio').val();
    var institucion_estudio = $('#institucion_estudio').val();
    var programa_incad = $('#programa_incad').val();
    var jornada_incad = $('#jornada_incad').val();
    var valor_programa =  replaceAll($('#valor_programa').val(), ".", "" );  
    var descuento = replaceAll($('#descuento').val(), ".", "" );
    var valor_neto_pagar = replaceAll($('#valor_neto_pagar').val(), ".", "" );
    var array_forma_pago = new Array();         

    $("input[name='check_forma_pago']:checked").each(function () {
        array_forma_pago.push($(this).val());
    });        
    var entidad_financiera = $('#entidad_financiera').val();
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
                 '&ultimo_estudio=' + ultimo_estudio +
                 '&institucion_estudio=' + institucion_estudio +
                 '&programa_incad=' + programa_incad +
                 '&jornada_incad=' + jornada_incad +
                 '&valor_programa=' + valor_programa +
                 '&descuento=' + descuento +
                 '&valor_neto_pagar=' + valor_neto_pagar +                        
                 '&array_forma_pago=' + array_forma_pago +                        
                 '&entidad_financiera=' + entidad_financiera +
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
                 '&hdd_id_persona=' + hdd_id_persona;                 
            	 
        llamarAjax("registro_ajax.php", params, "principal_registro", "validar_exito();");    	
	//llamarAjax("registro_ajax.php", params, "principal_registro", "");    

}




/*
 * Tipo
 * 1=crear
 * 2=editar
 */
function validar_exito() {

    var hdd_exito = $('#hdd_exito').val();
    
    var texto_exito = "";
    
    texto_exito = 'Registro guardado correctamente <br /> ';
	   
    	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 4000);
        //volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar Registro');

        window.scroll(0, 0);
        etTimeout("$('#contenedor_error').slideUp(400).removeClass('contenedor_error_visible').addClass('contenedor_error')", 4000);
    }

}





/*Para ingresar credito*/

function validar_crear_editar_credito(tipo_accion) {
   
   	
        var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	$("#label_persona_noti_direccion").removeClass("borde_error");
	$("#label_persona_noti_correo").removeClass("borde_error");
        
	$("#tipo_documento_deudor").removeClass("borde_error");
	$("#documento_deudor").removeClass("borde_error");
	$("#nombre_deudor").removeClass("borde_error");
	$("#apellido_deudor").removeClass("borde_error");
	$("#fecha_nacimiento_deudor").removeClass("borde_error");
	//$("#edad_deudor").removeClass("borde_error");
	$("#direccion_residencia_deudor").removeClass("borde_error");
	$("#barrio_residencia_deudor").removeClass("borde_error");
	$("#ciudad_residencia_deudor").removeClass("borde_error");
	$("#tel_casa_deudor").removeClass("borde_error");
	$("#tel_movil_deudor").removeClass("borde_error");
	$("#email_deudor").removeClass("borde_error");
	$("#actividad_economica_deudor").removeClass("borde_error");
	$("#ingreso_mensual_deudor").removeClass("borde_error");
	$("#nombre_empresa_deudor").removeClass("borde_error");
	$("#direccion_empresa_deudor").removeClass("borde_error");
	$("#telefono_empresa_deudor").removeClass("borde_error");
	$("#tipo_vehiculo_deudor").removeClass("borde_error");
	$("#placa_vehiculo_deudor").removeClass("borde_error");
	$("#marca_vehiculo_deudor").removeClass("borde_error");
	$("#modelo_vehiculo_deudor").removeClass("borde_error");
	$("#nom_ref_familiar_uno_deudor").removeClass("borde_error");
	$("#tel_ref_familiar_uno_deudor").removeClass("borde_error");
	$("#nom_ref_familiar_dos_deudor").removeClass("borde_error");
	$("#tel_ref_familiar_dos_deudor").removeClass("borde_error");
	$("#nom_ref_personal_uno_deudor").removeClass("borde_error");
	$("#tel_ref_personal_uno_deudor").removeClass("borde_error");
	$("#nom_ref_personal_dos_deudor").removeClass("borde_error");
	$("#tel_ref_personal_dos_deudor").removeClass("borde_error");
	$("#label_noti_direccion_deudor").removeClass("borde_error");
	$("#label_noti_correo_deudor").removeClass("borde_error");
        
	$("#tipo_documento_codeudor").removeClass("borde_error");
	$("#documento_codeudor").removeClass("borde_error");
	$("#nombre_codeudor").removeClass("borde_error");
	$("#apellido_codeudor").removeClass("borde_error");
	$("#fecha_nacimiento_codeudor").removeClass("borde_error");
	//$("#edad_codeudor").removeClass("borde_error");
	$("#direccion_residencia_codeudor").removeClass("borde_error");
	$("#barrio_residencia_codeudor").removeClass("borde_error");
	$("#ciudad_residencia_codeudor").removeClass("borde_error");
	$("#tel_casa_codeudor").removeClass("borde_error");
	$("#tel_movil_codeudor").removeClass("borde_error");
	$("#email_codeudor").removeClass("borde_error");
	$("#actividad_economica_codeudor").removeClass("borde_error");
	$("#ingreso_mensual_codeudor").removeClass("borde_error");
	$("#nombre_empresa_codeudor").removeClass("borde_error");
	$("#direccion_empresa_codeudor").removeClass("borde_error");
	$("#telefono_empresa_codeudor").removeClass("borde_error");
	$("#tipo_vehiculo_codeudor").removeClass("borde_error");
	$("#placa_vehiculo_codeudor").removeClass("borde_error");
	$("#marca_vehiculo_codeudor").removeClass("borde_error");
	$("#modelo_vehiculo_codeudor").removeClass("borde_error");
	$("#nom_ref_familiar_uno_codeudor").removeClass("borde_error");
	$("#tel_ref_familiar_uno_codeudor").removeClass("borde_error");
	$("#nom_ref_familiar_dos_codeudor").removeClass("borde_error");
	$("#tel_ref_familiar_dos_codeudor").removeClass("borde_error");
	$("#nom_ref_personal_uno_codeudor").removeClass("borde_error");
	$("#tel_ref_personal_uno_codeudor").removeClass("borde_error");
	$("#nom_ref_personal_dos_codeudor").removeClass("borde_error");
	$("#tel_ref_personal_dos_codeudor").removeClass("borde_error");
	$("#label_noti_direccion_codeudor").removeClass("borde_error");
	$("#label_noti_correo_codeudor").removeClass("borde_error");
	
	//if ($('#persona_noti_direccion').val() == '') { $("#persona_noti_direccion").addClass("borde_error_check"); result = 1; }
        
        if(!$('#persona_noti_direccion').prop('checked') && !$('#persona_noti_correo').prop('checked')) {
            $("#label_persona_noti_direccion").addClass("borde_error"); result = 1;
            $("#label_persona_noti_correo").addClass("borde_error"); result = 1;
        }        
        
                
	if ($('#persona_noti_correo').val() == '') { $("#persona_noti_correo").addClass("borde_error_check"); result = 1; }
	if ($('#tipo_documento_deudor').val() == '') { $("#tipo_documento_deudor").addClass("borde_error"); result = 1; }
	if ($('#documento_deudor').val() == '') { $("#documento_deudor").addClass("borde_error"); result = 1; }
	if ($('#nombre_deudor').val() == '') { $("#nombre_deudor").addClass("borde_error"); result = 1; }
	if ($('#apellido_deudor').val() == '') { $("#apellido_deudor").addClass("borde_error"); result = 1; }
	if ($('#fecha_nacimiento_deudor').val() == '') { $("#fecha_nacimiento_deudor").addClass("borde_error"); result = 1; }
	//if ($('#edad_deudor').val() == '') { $("#edad_deudor").addClass("borde_error"); result = 1; }
	if ($('#direccion_residencia_deudor').val() == '') { $("#direccion_residencia_deudor").addClass("borde_error"); result = 1; }
	if ($('#barrio_residencia_deudor').val() == '') { $("#barrio_residencia_deudor").addClass("borde_error"); result = 1; }
	if ($('#ciudad_residencia_deudor').val() == '') { $("#ciudad_residencia_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_casa_deudor').val() == '') { $("#tel_casa_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_movil_deudor').val() == '') { $("#tel_movil_deudor").addClass("borde_error"); result = 1; }
	if ($('#email_deudor').val() == '') { $("#email_deudor").addClass("borde_error"); result = 1; }
	if ($('#actividad_economica_deudor').val() == '') { $("#actividad_economica_deudor").addClass("borde_error"); result = 1; }
	if ($('#ingreso_mensual_deudor').val() == '') { $("#ingreso_mensual_deudor").addClass("borde_error"); result = 1; }
	if ($('#nombre_empresa_deudor').val() == '') { $("#nombre_empresa_deudor").addClass("borde_error"); result = 1; }
	if ($('#direccion_empresa_deudor').val() == '') { $("#direccion_empresa_deudor").addClass("borde_error"); result = 1; }
	if ($('#telefono_empresa_deudor').val() == '') { $("#telefono_empresa_deudor").addClass("borde_error"); result = 1; }
	if ($('#tipo_vehiculo_deudor').val() == '') { $("#tipo_vehiculo_deudor").addClass("borde_error"); result = 1; }
        
        if ($('#tipo_vehiculo_deudor').val() != 48) { 
            if ($('#placa_vehiculo_deudor').val() == '') { $("#placa_vehiculo_deudor").addClass("borde_error"); result = 1; }
            if ($('#marca_vehiculo_deudor').val() == '') { $("#marca_vehiculo_deudor").addClass("borde_error"); result = 1; }
            if ($('#modelo_vehiculo_deudor').val() == '') { $("#modelo_vehiculo_deudor").addClass("borde_error"); result = 1; }
        }
	
	if ($('#nom_ref_familiar_uno_deudor').val() == '') { $("#nom_ref_familiar_uno_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_familiar_uno_deudor').val() == '') { $("#tel_ref_familiar_uno_deudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_familiar_dos_deudor').val() == '') { $("#nom_ref_familiar_dos_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_familiar_dos_deudor').val() == '') { $("#tel_ref_familiar_dos_deudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_personal_uno_deudor').val() == '') { $("#nom_ref_personal_uno_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_personal_uno_deudor').val() == '') { $("#tel_ref_personal_uno_deudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_personal_dos_deudor').val() == '') { $("#nom_ref_personal_dos_deudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_personal_dos_deudor').val() == '') { $("#tel_ref_personal_dos_deudor").addClass("borde_error"); result = 1; }
	
        if(!$('#noti_direccion_deudor').prop('checked') && !$('#noti_correo_deudor').prop('checked')) {
            $("#label_noti_direccion_deudor").addClass("borde_error"); result = 1;
            $("#label_noti_correo_deudor").addClass("borde_error"); result = 1;
        }
        
	if ($('#tipo_documento_codeudor').val() == '') { $("#tipo_documento_codeudor").addClass("borde_error"); result = 1; }
	if ($('#documento_codeudor').val() == '') { $("#documento_codeudor").addClass("borde_error"); result = 1; }
	if ($('#nombre_codeudor').val() == '') { $("#nombre_codeudor").addClass("borde_error"); result = 1; }
	if ($('#apellido_codeudor').val() == '') { $("#apellido_codeudor").addClass("borde_error"); result = 1; }
	if ($('#fecha_nacimiento_codeudor').val() == '') { $("#fecha_nacimiento_codeudor").addClass("borde_error"); result = 1; }
	//if ($('#edad_codeudor').val() == '') { $("#edad_codeudor").addClass("borde_error"); result = 1; }
	if ($('#direccion_residencia_codeudor').val() == '') { $("#direccion_residencia_codeudor").addClass("borde_error"); result = 1; }
	if ($('#barrio_residencia_codeudor').val() == '') { $("#barrio_residencia_codeudor").addClass("borde_error"); result = 1; }
	if ($('#ciudad_residencia_codeudor').val() == '') { $("#ciudad_residencia_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_casa_codeudor').val() == '') { $("#tel_casa_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_movil_codeudor').val() == '') { $("#tel_movil_codeudor").addClass("borde_error"); result = 1; }
	if ($('#email_codeudor').val() == '') { $("#email_codeudor").addClass("borde_error"); result = 1; }
	if ($('#actividad_economica_codeudor').val() == '') { $("#actividad_economica_codeudor").addClass("borde_error"); result = 1; }
	if ($('#ingreso_mensual_codeudor').val() == '') { $("#ingreso_mensual_codeudor").addClass("borde_error"); result = 1; }
	if ($('#nombre_empresa_codeudor').val() == '') { $("#nombre_empresa_codeudor").addClass("borde_error"); result = 1; }
	if ($('#direccion_empresa_codeudor').val() == '') { $("#direccion_empresa_codeudor").addClass("borde_error"); result = 1; }
	if ($('#telefono_empresa_codeudor').val() == '') { $("#telefono_empresa_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tipo_vehiculo_codeudor').val() == '') { $("#tipo_vehiculo_codeudor").addClass("borde_error"); result = 1; }
        
        if ($('#tipo_vehiculo_codeudor').val() != 48) { 
            if ($('#placa_vehiculo_codeudor').val() == '') { $("#placa_vehiculo_codeudor").addClass("borde_error"); result = 1; }
            if ($('#marca_vehiculo_codeudor').val() == '') { $("#marca_vehiculo_codeudor").addClass("borde_error"); result = 1; }
            if ($('#modelo_vehiculo_codeudor').val() == '') { $("#modelo_vehiculo_codeudor").addClass("borde_error"); result = 1; }
        }
	
	if ($('#nom_ref_familiar_uno_codeudor').val() == '') { $("#nom_ref_familiar_uno_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_familiar_uno_codeudor').val() == '') { $("#tel_ref_familiar_uno_codeudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_familiar_dos_codeudor').val() == '') { $("#nom_ref_familiar_dos_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_familiar_dos_codeudor').val() == '') { $("#tel_ref_familiar_dos_codeudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_personal_uno_codeudor').val() == '') { $("#nom_ref_personal_uno_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_personal_uno_codeudor').val() == '') { $("#tel_ref_personal_uno_codeudor").addClass("borde_error"); result = 1; }
	if ($('#nom_ref_personal_dos_codeudor').val() == '') { $("#nom_ref_personal_dos_codeudor").addClass("borde_error"); result = 1; }
	if ($('#tel_ref_personal_dos_codeudor').val() == '') { $("#tel_ref_personal_dos_codeudor").addClass("borde_error"); result = 1; }
	
        if(!$('#noti_direccion_codeudor').prop('checked') && !$('#noti_correo_codeudor').prop('checked')) {
            $("#label_noti_direccion_codeudor").addClass("borde_error"); result = 1;
            $("#label_noti_correo_codeudor").addClass("borde_error"); result = 1;
        }

	if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_registro_credito()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea editar el registro?", "editar_registro_credito()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} 
        
        
   
}



function crear_registro_credito() {
    
        if(!$('#persona_noti_direccion').prop('checked') ) {
             var persona_noti_direccion = 0;
        }  
        else{
             var persona_noti_direccion = 1;
        }
        
        if(!$('#persona_noti_correo').prop('checked') ) {
             var persona_noti_correo = 0;
        }  
        else{
             var persona_noti_correo = 1;
        }
        
        var tipo_documento_deudor = $('#tipo_documento_deudor').val();
        var documento_deudor = $('#documento_deudor').val();
        var nombre_deudor = $('#nombre_deudor').val();
        var apellido_deudor = $('#apellido_deudor').val();
        var fecha_nacimiento_deudor = $('#fecha_nacimiento_deudor').val();
        var edad_deudor = $('#edad_deudor').val();
        var direccion_residencia_deudor = $('#direccion_residencia_deudor').val();
        var barrio_residencia_deudor = $('#barrio_residencia_deudor').val();
        var ciudad_residencia_deudor = $('#ciudad_residencia_deudor').val();
        var tel_casa_deudor = $('#tel_casa_deudor').val();
        var tel_movil_deudor = $('#tel_movil_deudor').val();
        var email_deudor = $('#email_deudor').val();
        var actividad_economica_deudor = $('#actividad_economica_deudor').val();
		var ingreso_mensual_deudor = replaceAll($('#ingreso_mensual_deudor').val(), ".", "" );
		var nombre_empresa_deudor = $('#nombre_empresa_deudor').val();
        var direccion_empresa_deudor = $('#direccion_empresa_deudor').val();
        var telefono_empresa_deudor = $('#telefono_empresa_deudor').val();
        var tipo_vehiculo_deudor = $('#tipo_vehiculo_deudor').val();
        var placa_vehiculo_deudor = $('#placa_vehiculo_deudor').val();
        var marca_vehiculo_deudor = $('#marca_vehiculo_deudor').val();
        var modelo_vehiculo_deudor = $('#modelo_vehiculo_deudor').val();
        var nom_ref_familiar_uno_deudor = $('#nom_ref_familiar_uno_deudor').val();
        var tel_ref_familiar_uno_deudor = $('#tel_ref_familiar_uno_deudor').val();
        var nom_ref_familiar_dos_deudor = $('#nom_ref_familiar_dos_deudor').val();
        var tel_ref_familiar_dos_deudor = $('#tel_ref_familiar_dos_deudor').val();
        var nom_ref_personal_uno_deudor = $('#nom_ref_personal_uno_deudor').val();
        var tel_ref_personal_uno_deudor = $('#tel_ref_personal_uno_deudor').val();
        var nom_ref_personal_dos_deudor = $('#nom_ref_personal_dos_deudor').val();
        var tel_ref_personal_dos_deudor = $('#tel_ref_personal_dos_deudor').val();
        
        if(!$('#noti_direccion_deudor').prop('checked') ) {
             var noti_direccion_deudor = 0;
        }  
        else{
             var noti_direccion_deudor = 1;
        }
        
        if(!$('#noti_correo_deudor').prop('checked') ) {
             var noti_correo_deudor = 0;
        }  
        else{
             var noti_correo_deudor = 1;
        }
        
        var tipo_documento_codeudor = $('#tipo_documento_codeudor').val();
        var documento_codeudor = $('#documento_codeudor').val();
        var nombre_codeudor = $('#nombre_codeudor').val();
        var apellido_codeudor = $('#apellido_codeudor').val();
        var fecha_nacimiento_codeudor = $('#fecha_nacimiento_codeudor').val();
        var edad_codeudor = $('#edad_codeudor').val();
        var direccion_residencia_codeudor = $('#direccion_residencia_codeudor').val();
        var barrio_residencia_codeudor = $('#barrio_residencia_codeudor').val();
        var ciudad_residencia_codeudor = $('#ciudad_residencia_codeudor').val();
        var tel_casa_codeudor = $('#tel_casa_codeudor').val();
        var tel_movil_codeudor = $('#tel_movil_codeudor').val();
        var email_codeudor = $('#email_codeudor').val();
        var actividad_economica_codeudor = $('#actividad_economica_codeudor').val();
        var ingreso_mensual_codeudor = replaceAll($('#ingreso_mensual_codeudor').val(), ".", "" );
        var nombre_empresa_codeudor = $('#nombre_empresa_codeudor').val();
        var direccion_empresa_codeudor = $('#direccion_empresa_codeudor').val();
        var telefono_empresa_codeudor = $('#telefono_empresa_codeudor').val();
        var tipo_vehiculo_codeudor = $('#tipo_vehiculo_codeudor').val();
        var placa_vehiculo_codeudor = $('#placa_vehiculo_codeudor').val();
        var marca_vehiculo_codeudor = $('#marca_vehiculo_codeudor').val();
        var modelo_vehiculo_codeudor = $('#modelo_vehiculo_codeudor').val();
        var nom_ref_familiar_uno_codeudor = $('#nom_ref_familiar_uno_codeudor').val();
        var tel_ref_familiar_uno_codeudor = $('#tel_ref_familiar_uno_codeudor').val();
        var nom_ref_familiar_dos_codeudor = $('#nom_ref_familiar_dos_codeudor').val();
        var tel_ref_familiar_dos_codeudor = $('#tel_ref_familiar_dos_codeudor').val();
        var nom_ref_personal_uno_codeudor = $('#nom_ref_personal_uno_codeudor').val();
        var tel_ref_personal_uno_codeudor = $('#tel_ref_personal_uno_codeudor').val();
        var nom_ref_personal_dos_codeudor = $('#nom_ref_personal_dos_codeudor').val();
        var tel_ref_personal_dos_codeudor = $('#tel_ref_personal_dos_codeudor').val();
        
        if(!$('#noti_direccion_codeudor').prop('checked') ) {
             var noti_direccion_codeudor = 0;
        }  
        else{
             var noti_direccion_codeudor = 1;
        }
        
        if(!$('#noti_correo_codeudor').prop('checked') ) {
             var noti_correo_codeudor = 0;
        }  
        else{
             var noti_correo_codeudor = 1;
        }
        
        var hdd_id_persona = $('#hdd_id_persona').val();
        var hdd_id_academica = $('#hdd_id_academica').val();
        var hdd_id_credito = $('#hdd_id_credito').val();
        
        var params = 'opcion=5' +             
                    '&persona_noti_direccion=' + persona_noti_direccion +
                    '&persona_noti_correo=' + persona_noti_correo +
                    '&tipo_documento_deudor=' + tipo_documento_deudor +
                    '&documento_deudor=' + documento_deudor +
                    '&nombre_deudor=' + nombre_deudor +
                    '&apellido_deudor=' + apellido_deudor +
                    '&fecha_nacimiento_deudor=' + fecha_nacimiento_deudor +
                    '&edad_deudor=' + edad_deudor +
                    '&direccion_residencia_deudor=' + direccion_residencia_deudor +
                    '&barrio_residencia_deudor=' + barrio_residencia_deudor +
                    '&ciudad_residencia_deudor=' + ciudad_residencia_deudor +
                    '&tel_casa_deudor=' + tel_casa_deudor +
                    '&tel_movil_deudor=' + tel_movil_deudor +
                    '&email_deudor=' + email_deudor +
                    '&actividad_economica_deudor=' + actividad_economica_deudor +
                    '&ingreso_mensual_deudor=' + ingreso_mensual_deudor +
                    '&nombre_empresa_deudor=' + nombre_empresa_deudor +
                    '&direccion_empresa_deudor=' + direccion_empresa_deudor +
                    '&telefono_empresa_deudor=' + telefono_empresa_deudor +
                    '&tipo_vehiculo_deudor=' + tipo_vehiculo_deudor +
                    '&placa_vehiculo_deudor=' + placa_vehiculo_deudor +
                    '&marca_vehiculo_deudor=' + marca_vehiculo_deudor +
                    '&modelo_vehiculo_deudor=' + modelo_vehiculo_deudor +
                    '&nom_ref_familiar_uno_deudor=' + nom_ref_familiar_uno_deudor +
                    '&tel_ref_familiar_uno_deudor=' + tel_ref_familiar_uno_deudor +
                    '&nom_ref_familiar_dos_deudor=' + nom_ref_familiar_dos_deudor +
                    '&tel_ref_familiar_dos_deudor=' + tel_ref_familiar_dos_deudor +
                    '&nom_ref_personal_uno_deudor=' + nom_ref_personal_uno_deudor +
                    '&tel_ref_personal_uno_deudor=' + tel_ref_personal_uno_deudor +
                    '&nom_ref_personal_dos_deudor=' + nom_ref_personal_dos_deudor +
                    '&tel_ref_personal_dos_deudor=' + tel_ref_personal_dos_deudor +
                    '&noti_direccion_deudor=' + noti_direccion_deudor +
                    '&noti_correo_deudor=' + noti_correo_deudor +
                    '&tipo_documento_codeudor=' + tipo_documento_codeudor +
                    '&documento_codeudor=' + documento_codeudor +
                    '&nombre_codeudor=' + nombre_codeudor +
                    '&apellido_codeudor=' + apellido_codeudor +
                    '&fecha_nacimiento_codeudor=' + fecha_nacimiento_codeudor +
                    '&edad_codeudor=' + edad_codeudor +
                    '&direccion_residencia_codeudor=' + direccion_residencia_codeudor +
                    '&barrio_residencia_codeudor=' + barrio_residencia_codeudor +
                    '&ciudad_residencia_codeudor=' + ciudad_residencia_codeudor +
                    '&tel_casa_codeudor=' + tel_casa_codeudor +
                    '&tel_movil_codeudor=' + tel_movil_codeudor +
                    '&email_codeudor=' + email_codeudor +
                    '&actividad_economica_codeudor=' + actividad_economica_codeudor +
                    '&ingreso_mensual_codeudor=' + ingreso_mensual_codeudor +
                    '&nombre_empresa_codeudor=' + nombre_empresa_codeudor +
                    '&direccion_empresa_codeudor=' + direccion_empresa_codeudor +
                    '&telefono_empresa_codeudor=' + telefono_empresa_codeudor +
                    '&tipo_vehiculo_codeudor=' + tipo_vehiculo_codeudor +
                    '&placa_vehiculo_codeudor=' + placa_vehiculo_codeudor +
                    '&marca_vehiculo_codeudor=' + marca_vehiculo_codeudor +
                    '&modelo_vehiculo_codeudor=' + modelo_vehiculo_codeudor +
                    '&nom_ref_familiar_uno_codeudor=' + nom_ref_familiar_uno_codeudor +
                    '&tel_ref_familiar_uno_codeudor=' + tel_ref_familiar_uno_codeudor +
                    '&nom_ref_familiar_dos_codeudor=' + nom_ref_familiar_dos_codeudor +
                    '&tel_ref_familiar_dos_codeudor=' + tel_ref_familiar_dos_codeudor +
                    '&nom_ref_personal_uno_codeudor=' + nom_ref_personal_uno_codeudor +
                    '&tel_ref_personal_uno_codeudor=' + tel_ref_personal_uno_codeudor +
                    '&nom_ref_personal_dos_codeudor=' + nom_ref_personal_dos_codeudor +
                    '&tel_ref_personal_dos_codeudor=' + tel_ref_personal_dos_codeudor +
                    '&noti_direccion_codeudor=' + noti_direccion_codeudor +
                    '&noti_correo_codeudor=' + noti_correo_codeudor +                    
                    '&hdd_id_persona=' + hdd_id_persona +
                    '&hdd_id_academica=' + hdd_id_academica +
                    '&hdd_id_credito=' + hdd_id_credito;   
            
    llamarAjax("registro_credito_ajax.php", params, "principal_registro", "validar_exito();");
    //llamarAjax("registro_ajax.php", params, "principal_registro", "");

}


function editar_registro_credito() {
    
        if(!$('#persona_noti_direccion').prop('checked') ) {
             var persona_noti_direccion = 0;
        }  
        else{
             var persona_noti_direccion = 1;
        }
        
        if(!$('#persona_noti_correo').prop('checked') ) {
             var persona_noti_correo = 0;
        }  
        else{
             var persona_noti_correo = 1;
        }
        
        var tipo_documento_deudor = $('#tipo_documento_deudor').val();
        var documento_deudor = $('#documento_deudor').val();
        var nombre_deudor = $('#nombre_deudor').val();
        var apellido_deudor = $('#apellido_deudor').val();
        var fecha_nacimiento_deudor = $('#fecha_nacimiento_deudor').val();
        var edad_deudor = $('#edad_deudor').val();
        var direccion_residencia_deudor = $('#direccion_residencia_deudor').val();
        var barrio_residencia_deudor = $('#barrio_residencia_deudor').val();
        var ciudad_residencia_deudor = $('#ciudad_residencia_deudor').val();
        var tel_casa_deudor = $('#tel_casa_deudor').val();
        var tel_movil_deudor = $('#tel_movil_deudor').val();
        var email_deudor = $('#email_deudor').val();
        var actividad_economica_deudor = $('#actividad_economica_deudor').val();
		var ingreso_mensual_deudor = replaceAll($('#ingreso_mensual_deudor').val(), ".", "" );
		var nombre_empresa_deudor = $('#nombre_empresa_deudor').val();
        var direccion_empresa_deudor = $('#direccion_empresa_deudor').val();
        var telefono_empresa_deudor = $('#telefono_empresa_deudor').val();
        var tipo_vehiculo_deudor = $('#tipo_vehiculo_deudor').val();
        var placa_vehiculo_deudor = $('#placa_vehiculo_deudor').val();
        var marca_vehiculo_deudor = $('#marca_vehiculo_deudor').val();
        var modelo_vehiculo_deudor = $('#modelo_vehiculo_deudor').val();
        var nom_ref_familiar_uno_deudor = $('#nom_ref_familiar_uno_deudor').val();
        var tel_ref_familiar_uno_deudor = $('#tel_ref_familiar_uno_deudor').val();
        var nom_ref_familiar_dos_deudor = $('#nom_ref_familiar_dos_deudor').val();
        var tel_ref_familiar_dos_deudor = $('#tel_ref_familiar_dos_deudor').val();
        var nom_ref_personal_uno_deudor = $('#nom_ref_personal_uno_deudor').val();
        var tel_ref_personal_uno_deudor = $('#tel_ref_personal_uno_deudor').val();
        var nom_ref_personal_dos_deudor = $('#nom_ref_personal_dos_deudor').val();
        var tel_ref_personal_dos_deudor = $('#tel_ref_personal_dos_deudor').val();
        
        if(!$('#noti_direccion_deudor').prop('checked') ) {
             var noti_direccion_deudor = 0;
        }  
        else{
             var noti_direccion_deudor = 1;
        }
        
        if(!$('#noti_correo_deudor').prop('checked') ) {
             var noti_correo_deudor = 0;
        }  
        else{
             var noti_correo_deudor = 1;
        }
        
        var tipo_documento_codeudor = $('#tipo_documento_codeudor').val();
        var documento_codeudor = $('#documento_codeudor').val();
        var nombre_codeudor = $('#nombre_codeudor').val();
        var apellido_codeudor = $('#apellido_codeudor').val();
        var fecha_nacimiento_codeudor = $('#fecha_nacimiento_codeudor').val();
        var edad_codeudor = $('#edad_codeudor').val();
        var direccion_residencia_codeudor = $('#direccion_residencia_codeudor').val();
        var barrio_residencia_codeudor = $('#barrio_residencia_codeudor').val();
        var ciudad_residencia_codeudor = $('#ciudad_residencia_codeudor').val();
        var tel_casa_codeudor = $('#tel_casa_codeudor').val();
        var tel_movil_codeudor = $('#tel_movil_codeudor').val();
        var email_codeudor = $('#email_codeudor').val();
        var actividad_economica_codeudor = $('#actividad_economica_codeudor').val();
		var ingreso_mensual_codeudor = replaceAll($('#ingreso_mensual_codeudor').val(), ".", "" );
        var nombre_empresa_codeudor = $('#nombre_empresa_codeudor').val();
        var direccion_empresa_codeudor = $('#direccion_empresa_codeudor').val();
        var telefono_empresa_codeudor = $('#telefono_empresa_codeudor').val();
        var tipo_vehiculo_codeudor = $('#tipo_vehiculo_codeudor').val();
        var placa_vehiculo_codeudor = $('#placa_vehiculo_codeudor').val();
        var marca_vehiculo_codeudor = $('#marca_vehiculo_codeudor').val();
        var modelo_vehiculo_codeudor = $('#modelo_vehiculo_codeudor').val();
        var nom_ref_familiar_uno_codeudor = $('#nom_ref_familiar_uno_codeudor').val();
        var tel_ref_familiar_uno_codeudor = $('#tel_ref_familiar_uno_codeudor').val();
        var nom_ref_familiar_dos_codeudor = $('#nom_ref_familiar_dos_codeudor').val();
        var tel_ref_familiar_dos_codeudor = $('#tel_ref_familiar_dos_codeudor').val();
        var nom_ref_personal_uno_codeudor = $('#nom_ref_personal_uno_codeudor').val();
        var tel_ref_personal_uno_codeudor = $('#tel_ref_personal_uno_codeudor').val();
        var nom_ref_personal_dos_codeudor = $('#nom_ref_personal_dos_codeudor').val();
        var tel_ref_personal_dos_codeudor = $('#tel_ref_personal_dos_codeudor').val();
        
        if(!$('#noti_direccion_codeudor').prop('checked') ) {
             var noti_direccion_codeudor = 0;
        }  
        else{
             var noti_direccion_codeudor = 1;
        }
        
        if(!$('#noti_correo_codeudor').prop('checked') ) {
             var noti_correo_codeudor = 0;
        }  
        else{
             var noti_correo_codeudor = 1;
        }
        
        var hdd_id_persona = $('#hdd_id_persona').val();
        var hdd_id_academica = $('#hdd_id_academica').val();
        var hdd_id_credito = $('#hdd_id_credito').val();
		
		var params = 'opcion=6' +             
                    '&persona_noti_direccion=' + persona_noti_direccion +
                    '&persona_noti_correo=' + persona_noti_correo +
                    '&tipo_documento_deudor=' + tipo_documento_deudor +
                    '&documento_deudor=' + documento_deudor +
                    '&nombre_deudor=' + nombre_deudor +
                    '&apellido_deudor=' + apellido_deudor +
                    '&fecha_nacimiento_deudor=' + fecha_nacimiento_deudor +
                    '&edad_deudor=' + edad_deudor +
                    '&direccion_residencia_deudor=' + direccion_residencia_deudor +
                    '&barrio_residencia_deudor=' + barrio_residencia_deudor +
                    '&ciudad_residencia_deudor=' + ciudad_residencia_deudor +
                    '&tel_casa_deudor=' + tel_casa_deudor +
                    '&tel_movil_deudor=' + tel_movil_deudor +
                    '&email_deudor=' + email_deudor +
                    '&actividad_economica_deudor=' + actividad_economica_deudor +
                    '&ingreso_mensual_deudor=' + ingreso_mensual_deudor +
                    '&nombre_empresa_deudor=' + nombre_empresa_deudor +
                    '&direccion_empresa_deudor=' + direccion_empresa_deudor +
                    '&telefono_empresa_deudor=' + telefono_empresa_deudor +
                    '&tipo_vehiculo_deudor=' + tipo_vehiculo_deudor +
                    '&placa_vehiculo_deudor=' + placa_vehiculo_deudor +
                    '&marca_vehiculo_deudor=' + marca_vehiculo_deudor +
                    '&modelo_vehiculo_deudor=' + modelo_vehiculo_deudor +
                    '&nom_ref_familiar_uno_deudor=' + nom_ref_familiar_uno_deudor +
                    '&tel_ref_familiar_uno_deudor=' + tel_ref_familiar_uno_deudor +
                    '&nom_ref_familiar_dos_deudor=' + nom_ref_familiar_dos_deudor +
                    '&tel_ref_familiar_dos_deudor=' + tel_ref_familiar_dos_deudor +
                    '&nom_ref_personal_uno_deudor=' + nom_ref_personal_uno_deudor +
                    '&tel_ref_personal_uno_deudor=' + tel_ref_personal_uno_deudor +
                    '&nom_ref_personal_dos_deudor=' + nom_ref_personal_dos_deudor +
                    '&tel_ref_personal_dos_deudor=' + tel_ref_personal_dos_deudor +
                    '&noti_direccion_deudor=' + noti_direccion_deudor +
                    '&noti_correo_deudor=' + noti_correo_deudor +
                    '&tipo_documento_codeudor=' + tipo_documento_codeudor +
                    '&documento_codeudor=' + documento_codeudor +
                    '&nombre_codeudor=' + nombre_codeudor +
                    '&apellido_codeudor=' + apellido_codeudor +
                    '&fecha_nacimiento_codeudor=' + fecha_nacimiento_codeudor +
                    '&edad_codeudor=' + edad_codeudor +
                    '&direccion_residencia_codeudor=' + direccion_residencia_codeudor +
                    '&barrio_residencia_codeudor=' + barrio_residencia_codeudor +
                    '&ciudad_residencia_codeudor=' + ciudad_residencia_codeudor +
                    '&tel_casa_codeudor=' + tel_casa_codeudor +
                    '&tel_movil_codeudor=' + tel_movil_codeudor +
                    '&email_codeudor=' + email_codeudor +
                    '&actividad_economica_codeudor=' + actividad_economica_codeudor +
                    '&ingreso_mensual_codeudor=' + ingreso_mensual_codeudor +
                    '&nombre_empresa_codeudor=' + nombre_empresa_codeudor +
                    '&direccion_empresa_codeudor=' + direccion_empresa_codeudor +
                    '&telefono_empresa_codeudor=' + telefono_empresa_codeudor +
                    '&tipo_vehiculo_codeudor=' + tipo_vehiculo_codeudor +
                    '&placa_vehiculo_codeudor=' + placa_vehiculo_codeudor +
                    '&marca_vehiculo_codeudor=' + marca_vehiculo_codeudor +
                    '&modelo_vehiculo_codeudor=' + modelo_vehiculo_codeudor +
                    '&nom_ref_familiar_uno_codeudor=' + nom_ref_familiar_uno_codeudor +
                    '&tel_ref_familiar_uno_codeudor=' + tel_ref_familiar_uno_codeudor +
                    '&nom_ref_familiar_dos_codeudor=' + nom_ref_familiar_dos_codeudor +
                    '&tel_ref_familiar_dos_codeudor=' + tel_ref_familiar_dos_codeudor +
                    '&nom_ref_personal_uno_codeudor=' + nom_ref_personal_uno_codeudor +
                    '&tel_ref_personal_uno_codeudor=' + tel_ref_personal_uno_codeudor +
                    '&nom_ref_personal_dos_codeudor=' + nom_ref_personal_dos_codeudor +
                    '&tel_ref_personal_dos_codeudor=' + tel_ref_personal_dos_codeudor +
                    '&noti_direccion_codeudor=' + noti_direccion_codeudor +
                    '&noti_correo_codeudor=' + noti_correo_codeudor +                    
                    '&hdd_id_persona=' + hdd_id_persona +
                    '&hdd_id_academica=' + hdd_id_academica +
                    '&hdd_id_credito=' + hdd_id_credito;   
            
    llamarAjax("registro_credito_ajax.php", params, "principal_registro", "validar_exito();");
    //llamarAjax("registro_ajax.php", params, "principal_registro", "");

}


