$(document).ready(function () {
    listar_recepciones();
});
function recepcionar() {
    var params = 'opcion=2';
    llamarAjax("recepcion_ajax.php", params, "principal_recepcion", "");
}

function listar_recepciones() {

    var params = 'opcion=1&buscar=0';
    llamarAjax("recepcion_ajax.php", params, "principal_recepcion", "");
}

function frmBuscar() {
    var codigo = $('#txt_busca_cod').val();
    var clase = $('#cmb_busca_clase').val();
    var tipo = $('#cmb_busca_tipo').val();
    var fecha = $('#txt_busca_fecha').val();
    var params = 'opcion=1&buscar=1&codigo=' + codigo + '&clase=' + clase + '&tipo=' + tipo + '&fecha=' + fecha;
    llamarAjax("recepcion_ajax.php", params, "principal_recepcion", "");
}

/*Crear acta de muestra*/
function validaRecepcionar() {
    $("#frmRecepcionar").validate({
        submitHandler: function () {
            modalConfirmarGuardar("¿Realmente desea crear la recepción de la muestra?", "crearRecepcion()");
        },
    });
}

function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=5&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("recepcion_ajax.php", params, "ventanaModal", "mostrarVentana();");
}

function mostrarVentana() {
    $('#myModal').modal();
}

function crearRecepcion() {
    var clase_muestra = $("#cmb_clase").val();
    var tipo_muestra = $("#cmb_tipo").val();
    var cmb_dep = $("#cmb_dep").val();
    var cmb_mun = $("#cmb_mun").val();
    var vereda = $("#txt_vereda").val();
    var observaciones = $("#txt_observaciones").val();

    var params = 'opcion=6&clase_muestra=' + clase_muestra + '&tipo_muestra=' + tipo_muestra + '&cmb_dep=' + cmb_dep + '&cmb_mun=' + cmb_mun + '&vereda=' + vereda + '&observaciones=' + observaciones;


    switch (clase_muestra) {
        case "1"://Envia los campos requeridos para muestra de tipo agua
            var tipoMuestraAgua = $("#cmb_tipo_muestra_agua").val();
            var fechaToma = $("#txt_fecha_toma").val();
            var txt_hora_toma = $("#txt_hora_toma").val();
            var txt_min_toma = $("#txt_min_toma").val();
            var cmb_periodo_toma = $("#cmb_periodo_toma").val();
            params += '&tipoMuestraAgua=' + tipoMuestraAgua + '&fechaToma=' + fechaToma + '&txt_hora_toma=' + txt_hora_toma + '&txt_min_toma=' + txt_min_toma + '&cmb_periodo_toma=' + cmb_periodo_toma;
           
            break;
    }


    llamarAjax("recepcion_ajax.php", params, "resultadoRecepcion", "comprobarCrearRepcion();");
}

function comprobarCrearRepcion() {
    var array_hdd_exito = $('#resultadoRecepcion').text();
    //var hdd_exito = array_hdd_exito.split(";");
    if (parseInt(array_hdd_exito) > 0) {
        mensajeExitoso('La recepción ha sido creada');
        //switch (hdd_exito[1]) {
            //case "1"://Acta de Muestra de agua
                //llamarFrmActaMuestraAgua();
                listar_recepciones();
                //break;
        //}
        listar_recepciones();
    }
    else {
        mensajeError('Error al intentar crear la recepción, notifique del error al administrador del sistema');
    }
}


function visualizaMuestra(idMuestra) {
    var params = 'opcion=7&idMuestra=' + idMuestra;
    llamarAjax("recepcion_ajax.php", params, "principal_recepcion", "");
}

/*Crear acta de muestra*/
function crearActaMuestraAgua() {
    $("#frmActaMuestraAgua").validate({
        rules: {
            txtSolicitante: {
                required: true,
            },
            txt_tel_s: {
                required: true,
                number: true,
            },
            txt_dir_s: {
                required: true,
            },
            txt_fecha_toma: {
                required: true,
            },
            txt_hora_toma: {
                required: true,
                range: [1, 12],
            },
            txt_min_toma: {
                required: true,
                range: [0, 59],
            },
            cmb_periodo_toma: {
                required: true,
            },
            txt_epsa_s: {
                required: true,
            },
            txt_dir_epsa_s: {
                required: true,
            },
            cmb_dep: {
                required: true,
            },
            cmb_mun: {
                required: true,
            },
            cmb_p_concretado: {
                required: true,
            },
            txt_p_muestreo: {
                required: true,
            },
            txt_dir_p_muestreo: {
                required: true,
            },
            txt_fuente_p_muestreo: {
                required: true,
            },
            cmb_tipo_muestra: {
                required: true,
            },
            cmb_epsa_acompanante: {
                required: true,
            },
            cmb_tipo_analisis: {
                required: true,
            },
            cmb_objeto_analisis: {
                required: true,
            },
            txt_temp: {
                required: true,
                number: true,
            },
            txt_color: {
                required: true,
            },
            txt_clrl: {
                required: true,
                number: true,
            },
            txt_ppm: {
                required: true,
                number: true,
            },
            txt_aspecto: {
                required: true,
            },
            txt_ph: {
                required: true,
                number: true,
            },
            cmb_muestra: {
                required: true,
            },
            txt_codigo_p_muestreo: {
                required: true,
            }
        },
        submitHandler: function () {

            var txt_otro_tipo_muestra = $('#txt_otro_tipo_muestra').val();
            var txt_acomp_epsa = $('#txt_acomp_epsa').val();
            var txt_acomp_cargo = $('#txt_acomp_cargo').val();
            var txt_otro_tipo_analisis = $('#txt_otro_tipo_analisis').val();
            var txt_otro_objeto_analisis = $('#txt_otro_objeto_analisis').val();
            if ($('#txt_otro_tipo_muestra').is(':visible')) {
                txt_otro_tipo_muestra = txt_otro_tipo_muestra.length > 0 ? $('#txt_otro_tipo_muestra').val() : "-1";
                txt_otro_tipo_muestra === "-1" ? $('#txt_otro_tipo_muestra').addClass("error") : '';
            }
            if ($('#txt_acomp_epsa').is(':visible')) {
                txt_acomp_epsa = txt_acomp_epsa.length > 0 ? $('#txt_acomp_epsa').val() : "-1";
                txt_acomp_epsa === "-1" ? $('#txt_acomp_epsa').addClass("error") : '';
            }
            if ($('#txt_acomp_cargo').is(':visible')) {
                txt_acomp_cargo = txt_acomp_cargo.length > 0 ? $('#txt_acomp_cargo').val() : "-1";
                txt_acomp_cargo === "-1" ? $('#txt_acomp_cargo').addClass("error") : '';
            }
            if ($('#txt_otro_tipo_analisis').is(':visible')) {
                txt_otro_tipo_analisis = txt_otro_tipo_analisis.length > 0 ? $('#txt_otro_tipo_analisis').val() : "-1";
                txt_otro_tipo_analisis === "-1" ? $('#txt_otro_tipo_analisis').addClass("error") : '';
            }
            if ($('#txt_otro_objeto_analisis').is(':visible')) {
                txt_otro_objeto_analisis = txt_otro_objeto_analisis.length > 0 ? $('#txt_otro_objeto_analisis').val() : "-1";
                txt_otro_objeto_analisis === "-1" ? $('#txt_otro_objeto_analisis').addClass("error") : '';
            }

            if (txt_otro_tipo_muestra === "-1" || txt_acomp_epsa === "-1" || txt_acomp_cargo === "-1" || txt_otro_tipo_analisis === "-1" || txt_otro_objeto_analisis === "-1") {
                mensajeError('Los campos en color rojo son obligatorios');
            } else {
                var txtSolicitante = $("#txtSolicitante").val();
                var txt_tel_s = $("#txt_tel_s").val();
                var txt_dir_s = $("#txt_dir_s").val();
                var txt_fecha_toma = $("#txt_fecha_toma").val();
                var txt_hora_toma = $("#txt_hora_toma").val();
                var txt_min_toma = $("#txt_min_toma").val();
                var cmb_periodo_toma = $("#cmb_periodo_toma").val();
                var txt_epsa_s = $("#txt_epsa_s").val();
                var cmb_p_concretado = $("#cmb_p_concretado").val();
                var txt_p_muestreo = $("#txt_p_muestreo").val();
                var txt_dir_p_muestreo = $("#txt_dir_p_muestreo").val();
                var txt_fuente_p_muestreo = $("#txt_fuente_p_muestreo").val();
                var cmb_epsa_acompanante = $("#cmb_epsa_acompanante").val();
                var cmb_tipo_analisis = $("#cmb_tipo_analisis").val();
                var cmb_objeto_analisis = $("#cmb_objeto_analisis").val();
                var txt_temp = $("#txt_temp").val();
                var txt_color = $("#txt_color").val();
                var txt_clrl = $("#txt_clrl").val();
                var txt_ppm = $("#txt_ppm").val();
                var txt_aspecto = $("#txt_aspecto").val();
                var txt_ph = $("#txt_ph").val();
                var txt_otros_analisis = $("#txt_otros_analisis").val();
                var cmb_muestra = $("#cmb_muestra").val();
                var txt_codigo_p_muestreo = $("#txt_codigo_p_muestreo").val();
                var cmb_tipo_muestra = $("#cmb_tipo_muestra").val();
                var txt_dir_epsa_s = $("#txt_dir_epsa_s").val();
                var txt_observaciones_analisis = $("#txt_observaciones_analisis").val();
                var txt_otro_tipo_muestra = $('#txt_otro_tipo_muestra').val();
                var txt_acomp_epsa = $('#txt_acomp_epsa').val();
                var txt_acomp_cargo = $('#txt_acomp_cargo').val();
                var txt_otro_tipo_analisis = $('#txt_otro_tipo_analisis').val();
                var txt_otro_objeto_analisis = $('#txt_otro_objeto_analisis').val();
                var codigoMuestra = $('#hddCodigoMuestra').val();
                var params = 'opcion=4&txtSolicitante=' + txtSolicitante + '&txt_tel_s=' + txt_tel_s + '&txt_dir_s=' + txt_dir_s + '&txt_fecha_toma=' + txt_fecha_toma
                        + '&txt_hora_toma=' + txt_hora_toma + '&txt_min_toma=' + txt_min_toma + '&cmb_periodo_toma=' + cmb_periodo_toma + '&txt_epsa_s=' + txt_epsa_s
                        + '&cmb_p_concretado=' + cmb_p_concretado + '&txt_p_muestreo=' + txt_p_muestreo
                        + '&txt_dir_p_muestreo=' + txt_dir_p_muestreo + '&txt_fuente_p_muestreo=' + txt_fuente_p_muestreo + '&cmb_epsa_acompanante=' + cmb_epsa_acompanante
                        + '&cmb_tipo_analisis=' + cmb_tipo_analisis + '&cmb_objeto_analisis=' + cmb_objeto_analisis + '&txt_temp=' + txt_temp + '&txt_color=' + txt_color
                        + '&txt_clrl=' + txt_clrl + '&txt_ppm=' + txt_ppm + '&txt_aspecto=' + txt_aspecto + '&txt_ph=' + txt_ph + '&txt_otros_analisis=' + txt_otros_analisis
                        + '&cmb_muestra=' + cmb_muestra + '&txt_otro_tipo_muestra=' + txt_otro_tipo_muestra + '&txt_acomp_epsa=' + txt_acomp_epsa + '&txt_acomp_cargo=' + txt_acomp_cargo
                        + '&txt_otro_tipo_analisis=' + txt_otro_tipo_analisis + '&txt_otro_objeto_analisis=' + txt_otro_objeto_analisis + '&txt_codigo_p_muestreo=' + txt_codigo_p_muestreo
                        + '&cmb_tipo_muestra=' + cmb_tipo_muestra + '&txt_dir_epsa_s=' + txt_dir_epsa_s + '&txt_observaciones_analisis=' + txt_observaciones_analisis + '&codigoMuestra=' + codigoMuestra;
                llamarAjax("calidad_agua_ajax.php", params, "hdd_resultado", "comprobarCrearActaMuestraAgua();");
            }
        },
    });
}


function comprobarCrearActaMuestraAgua() {
    var hdd_resultado = $('#hdd_resultado').text();
    if (hdd_resultado > 0) {
        mensajeExitoso('La muestra ha sido creada');
        imprimir_reporte_muestraAgua();
    }
    else {
        mensajeError('Error al intentar crear la muestra, notifique del error al administrador del sistema');
    }
}

function imprimir_reporte_muestraAgua() {
    var codMuestra = $('#hddCodigoMuestra').val();
    var params = "opcion=1&codMuestra=" + codMuestra;
    llamarAjax("generar_reporte_ajax.php", params, "hdd_imprimir_reporte", "mostrar_reporte();");
}


function mostrar_reporte() {
    var cont_aux = 0;
    var ruta = $("#hdd_ruta_arch_pdf").val();
    window.open("../funciones/abrir_pdf.php?ruta=" + ruta + "&nombre_arch=acta_muestra_agua_" + 1 + ".pdf", "_blank");
}

function frmMuestraAguaEpsaAcompanante() {
    var acompanante = $("#cmb_epsa_acompanante").val();
    if (acompanante == 1) {//Muestra
        $(".tr-epsa-acompanante").css({display: 'table-row'});
    } else if (acompanante == 2) {
        $(".tr-epsa-acompanante").css({display: 'none'});
    }
}

function frmMuestraAguaOtroAnalisisSolicitado() {
    var tipo_muestra = $("#cmb_tipo_analisis").val();
    if (tipo_muestra == 53) {//Muestra input de Otro
        $("#txt_otro_tipo_analisis").css({display: 'block'});
    } else {
        $("#txt_otro_tipo_analisis").css({display: 'none'});
    }
}

function frmMuestraAguaOtroObjetoAnalisis() {
    var tipo_muestra = $("#cmb_objeto_analisis").val();
    if (tipo_muestra == 56) {//Muestra input de Otro
        $("#txt_otro_objeto_analisis").css({display: 'block'});
    } else {
        $("#txt_otro_objeto_analisis").css({display: 'none'});
    }
}

function getTiposMuestrasFrmBuscar() {
    var id_clase_muestra = $('#cmb_busca_clase').val();
    var params = 'opcion=8&id_clase_muestra=' + id_clase_muestra;
    llamarAjax("recepcion_ajax.php", params, "cmb_busca_tipo", "");
}

function getTiposMuestrasFrmRecepcion() {
    var id_clase_muestra = $('#cmb_clase').val();
    var params = 'opcion=3&id_clase_muestra=' + id_clase_muestra;
    llamarAjax("recepcion_ajax.php", params, "cmb_tipo", "comprobarAdicionales(" + id_clase_muestra + ");");
}

function getMunicipiosFrmRecepcion() {
    var cod_dep = $('#cmb_dep').val();
    var params = 'opcion=4&cod_dep=' + cod_dep;
    llamarAjax("recepcion_ajax.php", params, "cmb_mun", "");
}

/*Función que imprime campos adicionales en el formulario de recepción*/
function comprobarAdicionales(id_clase_muestra) {
    switch (id_clase_muestra) {
        case 1://Imprime los campos requeridos para muestra de tipo agua
            var params = 'opcion=9';
            llamarAjax("recepcion_ajax.php", params, "adicionalesForm", "");
            break;
    }
}