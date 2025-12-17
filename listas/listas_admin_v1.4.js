
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
    llamarAjax("listas_admin_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}


function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}


function validar_crear_editar_lista_item(tipo_accion) {
   
   	var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
   	$("#txt_codigo").removeClass("borde_error");
        $("#txt_nombre").removeClass("borde_error");
        $("#cmb_estado").removeClass("borde_error");        
        
        $("#abreviatura").removeClass("borde_error");        
        $("#resolucion_programa").removeClass("borde_error");        
        $("#fecha_inicio").removeClass("borde_error");        
        $("#fecha_terminacion").removeClass("borde_error");    
        
        
   
   	if ($('#txt_codigo').val() == '') { $("#txt_codigo").addClass("borde_error"); result = 1; }
        if ($('#txt_nombre').val() == '') { $("#txt_nombre").addClass("borde_error"); result = 1; }
        if ($('#cmb_estado').val() == '') { $("#cmb_estado").addClass("borde_error"); result = 1; }
        
        
        var cmb_lista_editable = $('#cmb_lista_editable').val();
        var id_listas_detalle = $('#id_listas_detalle').val();
        
        
        
        if (cmb_lista_editable == 4){  
           if ($('#abreviatura').val() == '') { $("#abreviatura").addClass("borde_error"); result = 1; }
           if ($('#resolucion_programa').val() == '') { $("#resolucion_programa").addClass("borde_error"); result = 1; }
        }
        if (cmb_lista_editable == 3){  
           if ($('#fecha_inicio').val() == '') { $("#fecha_inicio").addClass("borde_error"); result = 1; }
           if ($('#fecha_terminacion').val() == '') { $("#fecha_terminacion").addClass("borde_error"); result = 1; }
        }
        
        
        
        if (cmb_lista_editable == 9){          
            var programas = new Array();
            $('input:checkbox').each(function () {
                if (this.checked) {
                    programas.push($(this).val());
                }
            });

            if (programas == '') { result = 1; msg_input=msg_input+' <br />Debe selecionar por lo menos un programa'}    
        }
        
	if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_lista_item()");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea editar el registro?", "editar_lista_item()");
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
    
    var cmb_lista_editable = $('#cmb_lista_editable').val();
    	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 4000);
        volver_inicio(cmb_lista_editable);
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

function volver_inicio(id_lista) {
    mostrar_form_lista(id_lista);
}

function crear_lista_item() {  
    
    
    var txt_codigo = $('#txt_codigo').val();
    var txt_nombre = $('#txt_nombre').val();
    var cmb_estado = $('#cmb_estado').val();
    var cmb_lista_editable = $('#cmb_lista_editable').val();
    var id_listas_detalle = $('#id_listas_detalle').val();
    
    var txt_abreviatura = $('#txt_abreviatura').val();
    if(txt_abreviatura==''){txt_abreviatura='NULL'}
    var cmb_productiva = $('#cmb_productiva').val();
    if(cmb_productiva==''){cmb_productiva=0;}
    
    
    var resolucion_programa = $('#resolucion_programa').val();
    if(resolucion_programa==''){resolucion_programa='SIN DATO'}
    var fecha_inicio = $('#fecha_inicio').val();
    if(fecha_inicio==''){fecha_inicio='01/01/1990'}
    var fecha_terminacion = $('#fecha_terminacion').val();
    if(fecha_terminacion==''){fecha_terminacion='01/01/1990'}
    
    var programas_modulos = new Array();
    if(cmb_lista_editable==9){
        $("input[name='check_programa']:checked").each(function () {
            programas_modulos.push($(this).val());
        });
    }
    
    
    var params = 'opcion=4&txt_codigo=' + txt_codigo +
            '&txt_nombre=' + txt_nombre +
            '&cmb_estado=' + cmb_estado +
            '&cmb_lista_editable=' + cmb_lista_editable +
            '&id_listas_detalle=' + id_listas_detalle + 
            '&txt_abreviatura=' + txt_abreviatura +
            '&cmb_productiva=' + cmb_productiva +
            '&resolucion_programa=' + resolucion_programa +
            '&fecha_inicio=' + fecha_inicio +
            '&fecha_terminacion=' + fecha_terminacion +
            '&array_programas_modulos=' + programas_modulos;
    llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle", "validar_exito();");
    //llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle");
    
}


function editar_lista_item() {

    var txt_codigo = $('#txt_codigo').val();
    var txt_nombre = $('#txt_nombre').val();
    var cmb_estado = $('#cmb_estado').val();
    var cmb_lista_editable = $('#cmb_lista_editable').val();
    var id_listas_detalle = $('#id_listas_detalle').val();
    
    var txt_abreviatura = $('#txt_abreviatura').val();
    if(txt_abreviatura==''){txt_abreviatura='NULL'}
    var cmb_productiva = $('#cmb_productiva').val();
    if(cmb_productiva==''){cmb_productiva=0;}
    
    var resolucion_programa = $('#resolucion_programa').val();
    if(resolucion_programa==''){resolucion_programa='SIN DATO'}
    
    var fecha_inicio = $('#fecha_inicio').val();
    if(fecha_inicio==''){fecha_inicio='01/01/1990'}
    var fecha_terminacion = $('#fecha_terminacion').val();
    if(fecha_terminacion==''){fecha_terminacion='01/01/1990'}
    
    
    var programas_modulos = new Array();
    if(cmb_lista_editable==9){
        $("input[name='check_programa']:checked").each(function () {
            programas_modulos.push($(this).val());
        });
    }
    
    
    var params = 'opcion=5&txt_codigo=' + txt_codigo +
            '&txt_nombre=' + txt_nombre +
            '&cmb_estado=' + cmb_estado +
            '&cmb_lista_editable=' + cmb_lista_editable +
            '&id_listas_detalle=' + id_listas_detalle +
            '&txt_abreviatura=' + txt_abreviatura +
            '&cmb_productiva=' + cmb_productiva +
            '&resolucion_programa=' + resolucion_programa +
            '&fecha_inicio=' + fecha_inicio +
            '&fecha_terminacion=' + fecha_terminacion +
            '&array_programas_modulos=' + programas_modulos;
    llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle", "validar_exito();");
    //llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle");
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





function mostrar_form_lista(id) {
    
    if(id>0){
       var id_lista = id; 
    }
    else{
      var id_lista = $(id).val();  
    }
    
    var params = 'opcion=1&id_lista=' + id_lista;
    llamarAjax("listas_admin_ajax.php", params, "principal_listas", "");
    //llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "validar_exito(); volver_inicio()");
    
}


function seleccionar_lista_detalle(id_lista, id_detalle){
    
    var params = 'opcion=2&id_lista=' + id_lista + '&id_detalle=' + id_detalle;
    llamarAjax("listas_admin_ajax.php", params, "principal_listas_detalle", "");
    
}

function form_detalles(id_listas_editable_detalle){
    var titulo = 'Editar Detalles';

    var params = 'opcion=10&titulo=' + titulo +
                 '&id_listas_editable_detalle=' + id_listas_editable_detalle;
    llamarAjax("listas_admin_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}



function validar_crear_detalle_programa(tipo_accion, id_programa) {
   
   	var result = 0;
   	var msg_input='';
   	$("#contenedor_error_detalle").removeClass("contenedor_error_visible");
   	$("#contenedor_error_detalle").addClass("contenedor_error");
   	
   	$("#descripcion").removeClass("borde_error");
        $("#precio").removeClass("borde_error");
        $("#duracion").removeClass("borde_error");        
        $("#horario").removeClass("borde_error");        
        $("#forma_pago").removeClass("borde_error");        
        $("#requisitos").removeClass("borde_error");        
        
        
   
   	if ($('#descripcion').val() == '') { $("#descripcion").addClass("borde_error"); result = 1; }
        if ($('#precio').val() == '') { $("#precio").addClass("borde_error"); result = 1; }
        if ($('#duracion').val() == '') { $("#duracion").addClass("borde_error"); result = 1; }
        if ($('#horario').val() == '') { $("#horario").addClass("borde_error"); result = 1; }
        if ($('#forma_pago').val() == '') { $("#forma_pago").addClass("borde_error"); result = 1; }
        if ($('#requisitos').val() == '') { $("#requisitos").addClass("borde_error"); result = 1; }
        if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    //modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_detalle_programa("+id_programa+")");
                    crear_detalle_programa(id_programa, tipo_accion);
                    return false;
		} else {
			
                $("#contenedor_error_detalle").addClass("contenedor_error_visible");
	        $('#contenedor_error_detalle').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    //modalConfirmarGuardar("Realmente desea editar el registro?", "editar_detalle_programa("+id_programa+")");
                    editar_detalle_programa(id_programa, tipo_accion);
                    return false;
		} else {
			
                $("#contenedor_error_detalle").addClass("contenedor_error_visible");
	        $('#contenedor_error_detalle').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} 
}

function crear_detalle_programa(id_programa, tipo_accion){
    
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    var duracion = $('#duracion').val();
    var horario = $('#horario').val();
    var forma_pago = $('#forma_pago').val();
    var requisitos = $('#requisitos').val();
    var id_detalle = $('#hdd_id_detalle').val();
    
    
    var params = 'opcion=11&descripcion=' + str_encode(descripcion) +
                 '&precio=' + str_encode(precio) +
                 '&duracion=' + str_encode(duracion) +
                 '&horario=' + str_encode(horario) +
                 '&forma_pago=' + str_encode(forma_pago) + 
                 '&requisitos=' + str_encode(requisitos) + 
                 '&id_programa=' + id_programa + 
                 '&id_detalle=' + id_detalle +
                 '&tipo_accion=' + tipo_accion;
    llamarAjax("listas_admin_ajax.php", params, "div_estado_detalle", "validar_exito_detalle()");
    //llamarAjax("listas_admin_ajax.php", params, "div_estado_detalle");
}

function editar_detalle_programa(id_programa, tipo_accion){
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    var duracion = $('#duracion').val();
    var horario = $('#horario').val();
    var forma_pago = $('#forma_pago').val();
    var requisitos = $('#requisitos').val();
    var id_detalle = $('#hdd_id_detalle').val();
    
    var params = 'opcion=11&descripcion=' + str_encode(descripcion) +
                 '&precio=' + str_encode(precio) +
                 '&duracion=' + str_encode(duracion) +
                 '&horario=' + str_encode(horario) +
                 '&forma_pago=' + str_encode(forma_pago) + 
                 '&requisitos=' + str_encode(requisitos) + 
                 '&id_programa=' + id_programa + 
                 '&id_detalle=' + id_detalle +
                 '&tipo_accion=' + tipo_accion;
    llamarAjax("listas_admin_ajax.php", params, "div_estado_detalle", "validar_exito_detalle()");
}


/*
 * Tipo
 * 1=crear
 * 2=editar
 */
function validar_exito_detalle() {

    var hdd_exito = $('#hdd_exito_detalle').val();    
    var texto_exito = "";    
    texto_exito = 'Registro guardado correctamente <br /> ';	   
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        $("#contenedor_exito_detalle").addClass("contenedor_exito_visible");
        $('#contenedor_exito_detalle').html(texto_exito);
        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_exito_detalle').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                   cerrarModalDetalle();
                }, 4000);
        
    } else {
        $("#contenedor_error_detalle").addClass("contenedor_error_visible");
        $('#contenedor_error_detalle').html('Error al guardar Registro');

        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_error_detalle').slideUp(400).removeClass("contenedor_error_visible").addClass("contenedor_error");
                   cerrarModalDetalle()
                }, 4000);
    }
}
    
    

function cerrarModalDetalle() {
    $('#modalConfirmacion').modal('hide');
}