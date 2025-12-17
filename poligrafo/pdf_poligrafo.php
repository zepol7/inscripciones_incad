<?php 
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



$id_programa = $_GET['id_programa'];
$jornada = $_GET['jornada'];
$calendario_academico = $_GET['calendario_academico'];
$nombre_archivo='Sin_Nombre';
try {
    ob_start();   
    
    include 'imprimir_poligrafo.php';
    $nombre_archivo='Poligrafo';
    
    
    $content = ob_get_clean();       

    //$html2pdf = new Html2Pdf('P', 'Legal', 'es', true, 'UTF-8');
    $html2pdf = new Html2Pdf('L', 'Letter', 'es', true, 'UTF-8');
    $html2pdf->writeHTML($content);
    $html2pdf->output($nombre_archivo.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}



?>
