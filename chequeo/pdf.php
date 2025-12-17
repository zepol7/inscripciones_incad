<?php 
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



$id_registro = $_GET['id_registro'];
$tipo = $_GET['tipo'];
$nombre_archivo='Sin_Nombre';
try {
    ob_start();
    switch ($tipo) {
        case "1": //Imprimir Inscripcion
            include 'imprimir_chequeo.php';
            $nombre_archivo='Lista_Chequeo';
        break;
		
    }
    
    
    $content = ob_get_clean();       

    //$html2pdf = new Html2Pdf('P', 'Legal', 'es', true, 'UTF-8');
	$html2pdf = new Html2Pdf('P', 'Letter', 'es', true, 'UTF-8');
    $html2pdf->writeHTML($content);
    $html2pdf->output($nombre_archivo.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}



?>
