
function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=2&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("cotizador_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}


function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}


function mostrar_form_cotizador(id_programa) {
    var params = 'opcion=1&id_programa=' + $(id_programa).val();  
    llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "");
    //llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "validar_exito(); volver_inicio()");
    
}



function mostrar_form_editar_cotizador(id_cotizador) {
    var params = 'opcion=1&id_cotizador=' + id_cotizador;  
    llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "");
    //llamarAjax("usuarios_ajax.php", params, "principal_usuarios", "validar_exito(); volver_inicio()");
    
}


function validar_crear_cotizador(tipo_accion, id_programa) {
   
   	var result = 0;
   	var msg_input='';
   	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
   	
   	$("#fecha_cotizador").removeClass("borde_error");
        $("#nombre_completo").removeClass("borde_error");
        //$("#tel_casa_persona").removeClass("borde_error");
        $("#tel_movil_persona").removeClass("borde_error");
        //$("#email_persona").removeClass("borde_error");
   
   	if ($('#fecha_cotizador').val() == '') { $("#fecha_cotizador").addClass("borde_error"); result = 1; }
        if ($('#nombre_completo').val() == '') { $("#nombre_completo").addClass("borde_error"); result = 1; }
        //if ($('#tel_casa_persona').val() == '') { $("#tel_casa_persona").addClass("borde_error"); result = 1; }
        if ($('#tel_movil_persona').val() == '') { $("#tel_movil_persona").addClass("borde_error"); result = 1; }
        //if ($('#email_persona').val() == '') { $("#email_persona").addClass("borde_error"); result = 1; }
        
        
        
	if (result == 0) {		
            modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_cotizador("+tipo_accion+", "+id_programa+")");
            return false;
        } else {

        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
            window.scroll(0, 0);
            return false;
        }
}


function crear_cotizador(tipo_accion, id_programa){
    var fecha_cotizador = $('#fecha_cotizador').val();
    var nombre_completo = $('#nombre_completo').val();
    var tel_casa_persona = $('#tel_casa_persona').val();
    var tel_movil_persona = $('#tel_movil_persona').val();
    var email_persona = $('#email_persona').val();
    var observaciones_cotiza = $('#observaciones_cotiza').val();
    var hdd_id_cotizador = $('#hdd_id_cotizador').val();
    
    
    var params = 'opcion=3&fecha_cotizador=' + fecha_cotizador +
                 '&nombre_completo=' + nombre_completo +
                 '&tel_casa_persona=' + tel_casa_persona +
                 '&tel_movil_persona=' + tel_movil_persona +
                 '&tipo_accion=' + tipo_accion + 
                 '&email_persona=' + email_persona + 
                 '&observaciones_cotiza=' + str_encode(observaciones_cotiza) + 
                 '&id_programa=' + id_programa +
                 '&id_cotizador=' + hdd_id_cotizador;
    llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "validar_exito();");
    //llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "");
}


function validar_exito() {

    var hdd_exito = $('#hdd_exito').val();    
    var texto_exito = "";    
    texto_exito = 'Registro guardado correctamente <br /> ';	   
    if (hdd_exito > 0) {
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        
        setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                   window.open("pdf_cotizador.php?id_cotizador="+hdd_exito+"&tipo=1", "_blank");     
                }, 4000);
        //volver_inicio(cmb_lista_editable);
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


function ver_todos_cotizados(){
    
    var params = 'opcion=4';
    llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "");
}


function buscar_cotizacion(){
    var txt_busca_id = $('#txt_busca_id').val();
    var fecha_cotizador_desde = $('#fecha_cotizador_desde').val();
    var fecha_cotizador_hasta = $('#fecha_cotizador_hasta').val();
    
    var params = 'opcion=4&txt_busca_id=' + txt_busca_id + 
            '&fecha_cotizador_desde=' + fecha_cotizador_desde + 
            '&fecha_cotizador_hasta=' + fecha_cotizador_hasta;    
    llamarAjax("cotizador_ajax.php", params, "principal_cotizador", "");
}



function descargar_base_excel(){
    setTimeout(function(){ 
        document.getElementById("form_xls_base").submit(); 
    }, 3000);	
}


function cambiar_lista_programa(id){
    $('#cmb_id_programa').val(id)
}


