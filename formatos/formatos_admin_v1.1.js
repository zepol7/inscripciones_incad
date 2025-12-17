
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


function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=8&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("formatos_admin_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}


function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}


function validar_editar_formato(tipo_accion) {
   
   	var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
        
   	$("#nombre_formato").removeClass("borde_error");
        $("#codigo_formato").removeClass("borde_error");
        $("#version_formato").removeClass("borde_error");                
        $("#fecha_formato").removeClass("borde_error");        
   
   	if ($('#nombre_formato').val() == '') { $("#nombre_formato").addClass("borde_error"); result = 1; }
        if ($('#codigo_formato').val() == '') { $("#codigo_formato").addClass("borde_error"); result = 1; }
        if ($('#version_formato').val() == '') { $("#version_formato").addClass("borde_error"); result = 1; }        
        if ($('#fecha_formato').val() == '') { $("#fecha_formato").addClass("borde_error"); result = 1; }
        
	if(tipo_accion == 1){ //Nuevo registro
		
		/*if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_lista_item()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}*/
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea editar el registro?", "editar_formato()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} 
        
        
   
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
        volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar Registro');

        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_error').slideUp(400).removeClass("contenedor_error_visible").addClass("contenedor_error");
                }, 4000);
    }
    
    

}

function volver_inicio() {
    mostrar_form_lista();
}

/*
function crear_formato() {

    var txt_codigo = $('#txt_codigo').val();
    var txt_nombre = $('#txt_nombre').val();
    var cmb_estado = $('#cmb_estado').val();
    var cmb_lista_editable = $('#cmb_lista_editable').val();
    var id_listas_detalle = $('#id_listas_detalle').val();
    
    var params = 'opcion=4&txt_codigo=' + txt_codigo +
            '&txt_nombre=' + txt_nombre +
            '&cmb_estado=' + cmb_estado +
            '&cmb_lista_editable=' + cmb_lista_editable +
            '&id_listas_detalle=' + id_listas_detalle;
    llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle", "validar_exito();");
    
}
*/

function editar_formato() {

    var nombre_formato = $('#nombre_formato').val();
    var codigo_formato = $('#codigo_formato').val();
    var version_formato = $('#version_formato').val();
    var fecha_formato = $('#fecha_formato').val();
    var id_formato = $('#id_formato').val();    
    
    var params = 'opcion=5&nombre_formato=' + nombre_formato +
            '&codigo_formato=' + codigo_formato +
            '&version_formato=' + version_formato +
            '&fecha_formato=' + fecha_formato +
            '&id_formato=' + id_formato;
    llamarAjax("formatos_admin_ajax.php", params, "principal_formato_detalle", "validar_exito();");
}



function seleccionar_usuarios(id_usuario) {
    var params = 'opcion=2&id_usuario=' + id_usuario;
    llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "mostrar_formulario(1);");
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





function mostrar_form_lista() {
    
    var params = 'opcion=1';
    llamarAjax("formatos_admin_ajax.php", params, "principal_formatos", "");
    //llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "validar_exito(); volver_inicio()");
    
}


function seleccionar_formato(id_formato){
    
    var params = 'opcion=2&id_formato=' + id_formato;
    llamarAjax("formatos_admin_ajax.php", params, "principal_formato_detalle", "");
    
}

