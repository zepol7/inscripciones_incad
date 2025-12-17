function validar_llamar_poligrafo(){
    
    var result = 0;
   	var msg_input='Debe seleccionar todos los Items para cargar el Polígrafo';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
   	$("#id_programa").removeClass("borde_error");
        $("#jornada").removeClass("borde_error");
        $("#calendario_academico").removeClass("borde_error");
        
        
        if ($('#id_programa').val() == '') { $("#id_programa").addClass("borde_error"); result = 1; }
        if ($('#jornada').val() == '') { $("#jornada").addClass("borde_error"); result = 1; }
        if ($('#calendario_academico').val() == '') { $("#calendario_academico").addClass("borde_error"); result = 1; }
        
        
        
        if (result == 0) {		
            modalConfirmarGuardar("Cargar Polígrafo", "imprimir_pdf_poligrafo()");
            return false;
        } else {

        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios <br />' + msg_input);
            window.scroll(0, 0);
            return false;
        }
        
       
        
        
}




function imprimir_pdf_poligrafo(){
    
    
    var id_programa = $('#id_programa').val();
    var jornada = $('#jornada').val();
    var calendario_academico = $('#calendario_academico').val();
    
    
    setTimeout(function(){ 
        window.open("pdf_poligrafo.php?id_programa="+id_programa+"&jornada="+jornada+"&calendario_academico="+calendario_academico, "_blank");     
    }, 2000);	
}


function mostrar_formulario_flotante(tipo) {
    if (tipo == 1) { //mostrar
        $('#fondo_negro').css('display', 'block');
        $('#d_centro').slideDown(400).css('display', 'block');
    } else if (tipo == 0) { //Ocultar
        $('#fondo_negro').css('display', 'none');
        $('#d_centro').slideDown(400).css('display', 'none');
    }
}

function reducir_formulario_flotante(ancho, alto) {
    $('.div_centro').width(ancho);
    $('.div_centro').css('top', '20%');
    $('.div_interno').width(ancho/*-15*/);
}

function mostrar_formulario(tipo) {
    if (tipo == 1) { //mostrar
        $('.formulario').slideDown(600).css('display', 'block')
    } else if (tipo == 0) { //Ocultar
        $('.formulario').slideUp(600).css('display', 'none')
    }
}

function ver_todas_empresas() {

    $('#txt_busca_usuario').val("");
    var params = 'opcion=1&txt_busca_empresa=' + $('#txt_busca_empresa').val();
    llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "mostrar_formulario(1)");
}

function buscar_empresas() {
    
    var result = 0;
    $("#contenedor_error").removeClass("contenedor_error_visible");
    $("#contenedor_error").addClass("contenedor_error");
   	
    $("#txt_busca_empresa").removeClass("borde_error");
    
    if ($('#txt_busca_empresa').val() == '') { $("#txt_busca_empresa").addClass("borde_error"); result = 1; }
    
    if (result == 0) {		
        var txt_busca_empresa = $('#txt_busca_empresa').val();
        var params = 'opcion=1&txt_busca_empresa=' + txt_busca_empresa;
        llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "mostrar_formulario(1)");
        
        return false;
    } else {

        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios');
        window.scroll(0, 0);
        return false;
    }
    
    
}

function llamar_crear_poligrafo() {
    
    
    var id_programa= $('#id_programa').val();
    var jornada = $('#jornada').val();
    var calendario_academico = $('#calendario_academico').val();
    
    var params = 'opcion=2&id_programa=' + id_programa + '&jornada=' + jornada + '&calendario_academico=' + calendario_academico;
    llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "mostrar_formulario(1)");
}

function validar_usuario_existente(nombre) {
    nombre = $(nombre).val();
    var params = 'opcion=3&nombre_usuario=' + nombre;
    llamarAjax("usuarios_ajax.php", params, "div_usuario_existe", "");
}

function validar_nit_existente(documento, tipo, id_empresa) {
    documento = $(documento).val();
    if (tipo == 1) {
        var params = 'opcion=5&nit_empresa=' + documento + '&tipo=' + tipo + '&id_empresa=' + id_empresa;

        llamarAjax("poligrafos_ajax.php", params, "div_nit_existe", "");
    } else if (tipo == 2) {
        var params = 'opcion=5&nit_empresa=' + documento + '&tipo=' + tipo + '&id_empresa=' + id_empresa;

        llamarAjax("poligrafos_ajax.php", params, "div_nit_existe", "");
    }
}







function validar_crear_editar_empresa(tipo_accion){
    
    var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
   	$("#nit_empresa").removeClass("borde_error");
        $("#nombre_empresa").removeClass("borde_error");
        $("#direccion_empresa").removeClass("borde_error");
        $("#nombre_contacto").removeClass("borde_error");
        $("#telefono1_contacto").removeClass("borde_error");
        //$("#telefono2_contacto").removeClass("borde_error");
        $("#email_contacto").removeClass("borde_error");
        
        
        if ($('#nit_empresa').val() == '') { $("#nit_empresa").addClass("borde_error"); result = 1; }
        if ($('#nombre_empresa').val() == '') { $("#nombre_empresa").addClass("borde_error"); result = 1; }
        if ($('#direccion_empresa').val() == '') { $("#direccion_empresa").addClass("borde_error"); result = 1; }
        if ($('#nombre_contacto').val() == '') { $("#nombre_contacto").addClass("borde_error"); result = 1; }
        if ($('#telefono1_contacto').val() == '') { $("#telefono1_contacto").addClass("borde_error"); result = 1; }
        //if ($('#telefono2_contacto').val() == '') { $("#telefono2_contacto").addClass("borde_error"); result = 1; }
        if ($('#email_contacto').val() == '') { $("#email_contacto").addClass("borde_error"); result = 1; }
        
        var programas = new Array();
        $('input:checkbox').each(function () {
            if (this.checked) {
                programas.push($(this).val());
            }
        });
            
        if (programas == '') { result = 1; msg_input=msg_input+' <br />Debe selecionar por lo menos un programa'}    
        
        if(tipo_accion == 1){ //Nuevo registro
		
            if (result == 0) {		
                modalConfirmarGuardar("Realmente desea crear una nueva Empresa?", "crear_empresa()");
                return false;
            } else {

            $("#contenedor_error").addClass("contenedor_error_visible");
            $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                window.scroll(0, 0);
                return false;
            }
		
	} else if(tipo_accion == 2){ //Editar registro
		
            if (result == 0) {		
                modalConfirmarGuardar("Realmente desea editar los datos de la Empresa?", "editar_empresa()");
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
    var params = 'opcion=9&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("poligrafos_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}


function confirmarEdicion(titulo, funcion) {
    var params = 'opcion=8&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("poligrafos_ajax.php", params, "ventanaModal", "mostrarVentana();");
}

function mostrarVentana() {
    $('#myModal').modal();
}


/*
 * Tipo
 * 1=crear
 * 2=editar
 */
function validar_exito() {

    var hdd_exito = $('#hdd_exito').val();
	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html('Datos guardados correctamente');
        window.scroll(0, 0);
        setTimeout(
                function () {
                    $('#contenedor_exito').slideUp(200).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 2000);
        volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar usuarios');

        window.scroll(0, 0);
        setTimeout("$('#contenedor_error').slideUp(200).removeClass('contenedor_error_visible').addClass('contenedor_error')", 3000);
    }

}

function volver_inicio() {
    
    ver_todas_empresas();
    
    /*if ($('#txt_busca_empresa').val() != '') {
        $("#listado_usuarios").submit();
    } else {//De lo contrario muestra todos los usuarios
        
    }*/
}

function crear_empresa() {

    var nit_empresa = $('#nit_empresa').val();
    var nombre_empresa = $('#nombre_empresa').val();
    var direccion_empresa = $('#direccion_empresa').val();
    var nombre_contacto = $('#nombre_contacto').val();
    var telefono1_contacto = $('#telefono1_contacto').val();
    var email_contacto = $('#email_contacto').val();   
    
    var nombre_contacto2 = $('#nombre_contacto2').val();
    var telefono2_contacto = $('#telefono2_contacto').val();
    var email_contacto2 = $('#email_contacto2').val();   
    
    var observaciones_empresa = $('#observaciones_empresa').val();
    
    var programas_empresas = new Array();
    $("input[name='check_programa']:checked").each(function () {
        programas_empresas.push($(this).val());
    });
    
    var params = 'opcion=4&nit_empresa=' + nit_empresa +
                 '&nombre_empresa=' + nombre_empresa +
                 '&direccion_empresa=' + direccion_empresa +
                 '&nombre_contacto=' + nombre_contacto +
                 '&nombre_contacto2=' + nombre_contacto2 +
                 '&telefono1_contacto=' + telefono1_contacto +
                 '&telefono2_contacto=' + telefono2_contacto +
                 '&email_contacto=' + email_contacto +
                 '&email_contacto2=' + email_contacto2 +
                 '&observaciones_empresa=' + observaciones_empresa +
                 '&array_programas_empresas=' + programas_empresas;
    llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "validar_exito();volver_inicio();");
    //llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "validar_exito(); volver_inicio()");


}

function editar_empresa() {
	
	
    var nit_empresa = $('#nit_empresa').val();
    var nombre_empresa = $('#nombre_empresa').val();
    var direccion_empresa = $('#direccion_empresa').val();
    var nombre_contacto = $('#nombre_contacto').val();
    var telefono1_contacto = $('#telefono1_contacto').val();
    var telefono2_contacto = $('#telefono2_contacto').val();
    var email_contacto = $('#email_contacto').val();
    
    var nombre_contacto2 = $('#nombre_contacto2').val();
    var telefono2_contacto = $('#telefono2_contacto').val();
    var email_contacto2 = $('#email_contacto2').val();   
    
    var observaciones_empresa = $('#observaciones_empresa').val();
    
    var hdd_id_empresa = $('#hdd_id_empresa').val();
    
    var programas_empresas = new Array();
    $("input[name='check_programa']:checked").each(function () {
        programas_empresas.push($(this).val());
    });

    var params = 'opcion=6&nit_empresa=' + nit_empresa +
                 '&nombre_empresa=' + nombre_empresa +
                 '&direccion_empresa=' + direccion_empresa +
                 '&nombre_contacto=' + nombre_contacto +
                 '&nombre_contacto2=' + nombre_contacto2 +
                 '&telefono1_contacto=' + telefono1_contacto +
                 '&telefono2_contacto=' + telefono2_contacto +
                 '&email_contacto=' + email_contacto +
                 '&email_contacto2=' + email_contacto2 +
                 '&observaciones_empresa=' + observaciones_empresa +
                 '&array_programas_empresas=' + programas_empresas + 
                 '&hdd_id_empresa=' + hdd_id_empresa;
    llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "validar_exito();volver_inicio()");
    //llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "");
	


}

function seleccionar_empresa(id_empresa) {
    var params = 'opcion=2&id_empresa=' + id_empresa;
    llamarAjax("poligrafos_ajax.php", params, "principal_empresas", "mostrar_formulario(1);");
}

function confirmar_guardar() {
    $('#d_interno').html(
            '<table border="0" cellpadding="5" cellspacing="0" align="center" style="width:100%">' +
            '<tr>' +
            '<th align="center">' +
            '<h4>&iquest;Est&aacute; seguro de guardar esta informaci&oacute;n?</h4>' +
            '</th>' +
            '</tr>' +
            '<tr>' +
            '<th align="center">' +
            '<input type="button" id="btn_cancelar_si" nombre="btn_cancelar_si" class="btnPrincipal" value="Aceptar" onclick="editar_usuarios();"/>\n' +
            '<input type="button" id="btn_cancelar_no" nombre="btn_cancelar_no" class="btnSecundario" value="Cancelar" onclick="cerrar_div_centro();"/> ' +
            '</th>' +
            '</tr>' +
            '</table>');
}

//Resetea la contraseña
function confirmar_resetear_pass(usuario) {
    confirmarEdicion('La contrase\u00f1a del usuario: ' + usuario + ' sera reemplazada por: ' + usuario + ' ¿Realmente desea realizar la acci\u00f3n?', "resetear_pass()");
}

function resetear_pass() {
    var id_usuario = $('#hdd_id_usuario').val();
    var params = 'opcion=7&id_usuario=' + id_usuario;
    llamarAjax("usuarios_ajax.php", params, "rtaResetearPass", "postResetearPass();");
}

//Funcion que verifica que la funcion: resetear_pass, se ejecute sin problemas
function postResetearPass() {
    var rtaResetearPass = $('#rtaResetearPass').text();
    if (rtaResetearPass == '1') {
        mensajeExitoso('La contrase\u00f1a ha sido reseteada');
    } else {
        mensajeError('Error al intentar resetear la contrase\u00f1a. Vuelve a intentarlo');
    }
}
