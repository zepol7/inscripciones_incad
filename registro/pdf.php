<?php 
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



$id_registro = $_GET['id_registro'];
$tipo = $_GET['tipo'];

$modo = isset($_GET['modo']) ? $_GET['modo'] : null;
/*
if isset($_GET['modo']){

    $modo = $_GET['modo'];

}
    */



$nombre_archivo='Sin_Nombre';
try {
    ob_start();
    switch ($tipo) {
        case "1": //Imprimir Inscripcion
            include 'imprimir_inscripcion.php';
            $nombre_archivo='Inscripcion';
        break;
        case "2": //Imprimir Tratamiento datos personales
            include 'imprimir_autorizacion.php';            
            $nombre_archivo='Autorizacion_DP';
        break;
        case "3": //Imprimir Contrato de suministro
            include 'imprimir_contrato_suministro.php';            
            $nombre_archivo='Contrato_Suministro';
        break;
        case "4": //Imprimir Credito INCAD
            include 'imprimir_credito.php';            
            $nombre_archivo='Credito_INCAD';
        break;
        case "5": //Imprimir Centrales de Riesgo
            include 'imprimir_centrales_riesgo.php';            
            $nombre_archivo='Centrales_Riesgo';
        break;
        case "6": //Imprimir Pagare y Carta
            include 'imprimir_pagare_carta.php';            
            $nombre_archivo='Pagare_Carta';
        break;
        case "7": //Imprimir Carta Compromiso
            include 'imprimir_carta_compromiso.php';            
            $nombre_archivo='Carta_Compromiso';
        break;
        case "8": //Imprimir Carta Compromiso
            include 'imprimir_carta_bienvenida.php';            
            $nombre_archivo='Carta_Bienvenida';
        break;
        case "9": //Imprimir Contrato de suministro - bachiller
            include 'imprimir_contrato_suministro_bachiller.php';            
            $nombre_archivo='Contrato_Suministro_Bachiller_1';
        break;
    
        case "10": //Imprimir Contrato de suministro - bachiller
            include 'imprimir_contrato_suministro_bachiller.php';            
            $nombre_archivo='Contrato_Suministro_Bachiller_2';
        break;
    
    
		
    }
    
    
    $content = ob_get_clean();       


    if ($modo==1){
        $folder = __DIR__ . '/archivos_firma/'; 
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true); // Crear la carpeta si no existe
        }

        $ruta_archivo = $folder . $nombre_archivo . '.pdf';
        
        $html2pdf = new Html2Pdf('P', 'Letter', 'es', true, 'UTF-8');
        $html2pdf->writeHTML($content);

        //Guardar archivo
        #$html2pdf->output($ruta_archivo, 'F');
        
        //Generar base 64
        $pdfContent = $html2pdf->output('', 'S');

        // Codificar en base64
        $pdfBase64 = base64_encode($pdfContent);

        echo($pdfBase64);

        //echo"Holaaaaaa holaaa".$nombre_archivo."<br/>";

    }
    else{
        //$html2pdf = new Html2Pdf('P', 'Legal', 'es', true, 'UTF-8');        
        $html2pdf = new Html2Pdf('P', 'Letter', 'es', true, 'UTF-8');
        $html2pdf->writeHTML($content);
        $html2pdf->output($nombre_archivo.'.pdf');      
    }


    

    
    
    





} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}



?>
