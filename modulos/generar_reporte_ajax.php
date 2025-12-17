<?php
session_start();

require_once("../funciones/Utilidades.php");
require_once("../db/DbVariables.php");
require_once("../db/DbMuestrasAguas.php");
require_once("../db/DbParasitismoIntestinal.php");
require_once("../db/DbParasitismoIntestinalParasitos.php");
require_once("../db/DbParasitismoIntestinalBacterias.php");


/* Requires para FPDF */
require_once("../funciones/pdf/fpdf.php");
require_once("../funciones/pdf/makefont/makefont.php");
require_once("../funciones/pdf/funciones.php");
require_once("../funciones/pdf/WriteHTML.php");
require_once("../funciones/pdf/FPDI/fpdi.php");

class PDF extends FPDI {

    public $opcion;
    public $dbVariables;
    public $tituloReporte;

    function __construct($orientation, $unit, $size) {
        parent::__construct($orientation, $unit, $size);
    }

    function setData($opcion, $tituloReporte, $dbVariables) {
        $this->opcion = $opcion;
        $this->dbVariables = $dbVariables;
        $this->tituloReporte = $tituloReporte;
    }

    function Header() {
        switch ($this->opcion) {
            case "1"://Encabezado para el reporte de Acta de Muestras
                $this->Image('../imagenes/logo_gobernacion.jpg', 20, 18, 20);

                $this->SetFont('Arial', '', 10);
                $this->SetY(10);

                $this->Cell(40, 30, '', 1, 1);
                $this->SetY(10);
                $this->Cell(40, 4, ajustarCaracteres('República de'), 0, 0, 'C');

                $this->SetX(10);
                $this->SetY(14);
                $this->Cell(40, 4, ajustarCaracteres('Colombia'), 0, 0, 'C');

                $this->SetY(10);
                $this->SetX(50);
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(95, 30, ajustarCaracteres($this->tituloReporte), 1, 0, 'C');

                $this->Cell(30, 30, '', 1, 2);

                $this->SetY(10);
                $this->SetX(145);
                $this->SetFont('Arial', '', 6);
                $this->Cell(30, 5, ajustarCaracteres('CÓDIGO'), 1, 2, 'L');
                $this->Cell(30, 5, ajustarCaracteres('VERSIÓN'), 1, 2, 'L');
                $this->Cell(30, 5, ajustarCaracteres('FECHA DE APROBACIÓN'), 1, 2, 'L');
                $this->Cell(30, 15, ajustarCaracteres('PÁGINA'), 1, 2, 'L');

                $this->SetY(10);
                $this->SetX(175);
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(30, 30, ajustarCaracteres(''), 1, 0, 'C');

                $this->SetY(10);
                $this->SetX(175);
                $this->SetFont('Arial', '', 8);
                $this->Cell(30, 5, $this->dbVariables->getVariable(15)['valor_variable'], 1, 2, 'C');
                $this->Cell(30, 5, $this->dbVariables->getVariable(16)['valor_variable'], 1, 2, 'C');
                $this->Cell(30, 5, $this->dbVariables->getVariable(17)['valor_variable'], 1, 2, 'C');
                $this->Cell(30, 15, $this->PageNo() . '/{nb}', 1, 2, 'C');
                break;

            case "2"://Encabezado para el reporte de Acta de Muestras
                $this->Image('../imagenes/logo_gobernacion.jpg', 20, 18, 20);

                $this->SetFont('Arial', '', 10);
                $this->SetY(10);

                $this->Cell(40, 30, '', 1, 1);
                $this->SetY(10);
                $this->Cell(40, 4, ajustarCaracteres('República de'), 0, 0, 'C');

                $this->SetX(10);
                $this->SetY(14);
                $this->Cell(40, 4, ajustarCaracteres('Colombia'), 0, 0, 'C');

                $this->SetY(10);
                $this->SetX(50);
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(95, 30, ajustarCaracteres($this->tituloReporte), 1, 0, 'C');

                $this->Cell(30, 30, '', 1, 2);

                $this->SetY(10);
                $this->SetX(145);
                $this->SetFont('Arial', '', 6);
                $this->Cell(30, 5, ajustarCaracteres('CÓDIGO'), 1, 2, 'L');
                $this->Cell(30, 5, ajustarCaracteres('VERSIÓN'), 1, 2, 'L');
                $this->Cell(30, 5, ajustarCaracteres('FECHA DE APROBACIÓN'), 1, 2, 'L');
                $this->Cell(30, 15, ajustarCaracteres('PÁGINA'), 1, 2, 'L');

                $this->SetY(10);
                $this->SetX(175);
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(30, 30, ajustarCaracteres(''), 1, 0, 'C');

                $this->SetY(10);
                $this->SetX(175);
                $this->SetFont('Arial', '', 8);
                $this->Cell(30, 5, '' /* $this->dbVariables->getVariable(15)['valor_variable'] */, 1, 2, 'C');
                $this->Cell(30, 5, '' /* $this->dbVariables->getVariable(16)['valor_variable'] */, 1, 2, 'C');
                $this->Cell(30, 5, '' /* $this->dbVariables->getVariable(17)['valor_variable'] */, 1, 2, 'C');
                $this->Cell(30, 15, $this->PageNo() . '/{nb}', 1, 2, 'C');
                break;
        }
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, ajustarCaracteres('Laboratorio Departamental de Salud Pública de Santander') . '', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(0, 5, ajustarCaracteres('Reporte generado el: ') . date("d/m/Y"), 0, 2, 'R');
    }

    function setDefaultLine() {
        $this->SetLineWidth(0.1);
        $this->SetDrawColor(0, 0, 0);
    }

    function setSeparationLine() {
        $this->SetLineWidth(0.1);
        $this->SetDrawColor(120, 120, 120);
    }

    function validateSpaceHeight($neededHeight) {
        $y_aux = $this->GetY();
        if ($y_aux + $neededHeight > 269) {
            $this->AddPage();
            $y_aux = 31;
        }

        return $y_aux;
    }

    function rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage() {
        if (@$this->angle != 0) {
            @$this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

}

function imprimir_encabezado($pdf, $opcion, $tituloReporte, $dbVariables) {

    /* Encabezado FPDF */

    if (isset($pdf)) {
        $pdf->setData($opcion, $tituloReporte, $dbVariables);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->setXY(10, 30);
    }
}

/* * *********************** recibe las opciones ************************ */
$opcion = $_POST["opcion"];
switch ($opcion) {
    case "1":
        acta_de_muestra();
        break;
    case "2"://Generar reporte de envios, módulo Parasitismo_intestinal
        opcion2();
        break;
}
/* * *********************** END recibe las opciones ************************ */

function acta_de_muestra() {
    if (isset($_SESSION["idUsuario"])) {
        $utilidades = new Utilidades();

        $id_usuario = $_SESSION["idUsuario"];
        @$codMuestra = $utilidades->limpiar_tags($_POST["codMuestra"]);


        $dbVariables = new DbVariables();
        $dbMuestrasAguas = new DbMuestrasAguas();

        $muestra = $dbMuestrasAguas->getMuestra($codMuestra);

        $pdf = new PDF('P', 'mm', array(216, 279));
        $pdf->SetAutoPageBreak(true, 10);
        $pdfHTML = new PDF_HTML();

        imprimir_encabezado($pdf, 1, 'ACTA DE TOMA DE MUESTRAS DE AGUA', $dbVariables);

        $pdf->Ln(15);


        $pdf->SetFont("Arial", "B", 8);
        $pdf->Cell(97, 5, ajustarCaracteres('NÚMERO RADICADO: ' . $muestra['numero_radicado']), 0, 0, 'L');
        $pdf->Cell(97, 5, ajustarCaracteres('ACTA NÚMERO: ' . $muestra['acta_numero']), 0, 1, 'R');


        $pdf->Ln(5);

        $pdf->SetFont("Arial", "", 8);
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(25, 170));
        $pdf->setWeight(array('B'));
        $pdf->Row2(array(
            ajustarCaracteres('SOLICITANTE:'),
            ajustarCaracteres($muestra['solicitante_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(35, $y_ini_aux, 170, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(25, 120, 20, 30));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DIRECCIÓN:'),
            ajustarCaracteres($muestra['dir_s_muestra']),
            ajustarCaracteres('TELÉFONO:'),
            ajustarCaracteres($muestra['tel_s_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(35, $y_ini_aux, 120, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(155, $y_ini_aux, 20, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(175, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);

        $pdf->Ln(5);

        $pdf->SetFont("Arial", "B", 8);
        $pdf->Cell(30, 5, ajustarCaracteres('FECHA DE LA TOMA:'), 1, 0, 'L');
        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(67, 5, ajustarCaracteres($muestra['fecha_toma']), 1, 0, 'L');
        $pdf->SetFont("Arial", "B", 8);
        $pdf->Cell(30, 5, ajustarCaracteres('HORA DE LA TOMA:'), 1, 0, 'L');
        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(68, 5, ajustarCaracteres($muestra['hora_toma']), 1, 1, 'L');

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 165));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('NOMBRE EPSA:'),
            ajustarCaracteres($muestra['nom_epsa_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 165));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DIRECCIÓN EPSA:'),
            ajustarCaracteres($muestra['dir_epsa_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L', 'L', 'L', 'L', 'L'));
        $pdf->SetWidths2(array(30, 30, 30, 30, 30, 45));
        $pdf->setWeight(array('B', '', 'B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DEPARTAMENTO:'),
            ajustarCaracteres($muestra['nom_dep']),
            ajustarCaracteres('MUNICIPIO:'),
            ajustarCaracteres($muestra['nom_mun']),
            ajustarCaracteres('VEREDA:'),
            ajustarCaracteres($muestra['vereda_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(100, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(60, 135));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('¿PUNTO DE MUESTRA CONCRETADO?:'),
            ajustarCaracteres($muestra['concretado_muestra'] == 1 ? "Sí" : "No")
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 60, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 135, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(50, 10, 16, 119));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('CÓDIGO PUNTO DE MUESTREO:'),
            ajustarCaracteres($muestra['punto_muestra']),
            ajustarCaracteres('NOMBRE:'),
            ajustarCaracteres($muestra['nombre_punto_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(60, $y_ini_aux, 10, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 16, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(86, $y_ini_aux, 119, $y_fin_aux - $y_ini_aux);



        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(50, 145));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DIRECCIÓN PUNTO DE TOMA:'),
            ajustarCaracteres($muestra['dir_punto_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(60, $y_ini_aux, 145, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(15, 180));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('FUENTE:'),
            ajustarCaracteres($muestra['fuente_punto_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(25, $y_ini_aux, 180, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 165));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('TIPO DE MUESTRA:'),
            ajustarCaracteres($muestra['tipo_muestra_det'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


        $pdf->Ln(5);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 155));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('MUESTRA TOMADA POR:'),
            ajustarCaracteres($muestra['nombre_usuario_crea'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(95, 100));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('¿ACOMPAÑAMIENTO POR PARTE DE LA EMPRESA PRESTADORA?:'),
            ajustarCaracteres($muestra['acompano_epsa'] == 1 ? 'Sí' : 'No')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 95, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(105, $y_ini_aux, 100, $y_fin_aux - $y_ini_aux);

        if ($muestra['acompano_epsa'] == 1) {
            $y_ini_aux = $pdf->GetY();
            $pdf->SetAligns2(array('L', 'L'));
            $pdf->SetWidths2(array(20, 80, 15, 80));
            $pdf->setWeight(array('B', '', 'B', ''));
            $pdf->Row2(array(
                ajustarCaracteres('NOMBRE:'),
                ajustarCaracteres($muestra['nom_acompano_epsa']),
                ajustarCaracteres('CARGO:'),
                ajustarCaracteres($muestra['cargo_acompano_epsa']),
            ));
            $y_fin_aux = $pdf->GetY();
            if ($y_ini_aux > $y_fin_aux) {
                $y_ini_aux = 34;
            }
            $pdf->Rect(10, $y_ini_aux, 20, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(30, $y_ini_aux, 80, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(110, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(125, $y_ini_aux, 80, $y_fin_aux - $y_ini_aux);
        }

        $pdf->Ln(5);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 155));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('ANÁLISIS SOLICITADO:'),
            ajustarCaracteres($muestra['analisis_solicitado'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);
        if ($muestra['analisis_s_muestra'] == 53) {
            $y_ini_aux = $pdf->GetY();
            $pdf->SetAligns2(array('L'));
            $pdf->SetWidths2(array(40));
            $pdf->Row2(array(
                ajustarCaracteres($muestra['otro_analisis_s_muestra'])
            ));
            $y_fin_aux = $pdf->GetY();
            if ($y_ini_aux > $y_fin_aux) {
                $y_ini_aux = 34;
            }
            $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);
        }
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 155));
        $pdf->setWeight(array('B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('OBJETO DEL ANÁLISIS:'),
            ajustarCaracteres($muestra['objeto_analisis_solicitado'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);
        if ($muestra['obj_analisis_muestra'] == 56) {
            $y_ini_aux = $pdf->GetY();
            $pdf->SetAligns2(array('L'));
            $pdf->SetWidths2(array(40));
            $pdf->Row2(array(
                ajustarCaracteres($muestra['otro_obj_analisis_muestra'])
            ));
            $y_fin_aux = $pdf->GetY();
            if ($y_ini_aux > $y_fin_aux) {
                $y_ini_aux = 34;
            }
            $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);
        }
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L', 'L', 'L', 'L', 'L', 'L', 'L'));
        $pdf->SetWidths2(array(25, 15, 15, 70, 15, 15, 15, 25));
        $pdf->setWeight(array('B', '', 'B', '', 'B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('TEMPERATURA:'),
            ajustarCaracteres($muestra['temp_muestra'] . '°C'),
            ajustarCaracteres('COLOR:'),
            ajustarCaracteres($muestra['color_muestra']),
            ajustarCaracteres('CL.RL:'),
            ajustarCaracteres($muestra['clrl_muestra']),
            ajustarCaracteres('P.P.M.:'),
            ajustarCaracteres($muestra['ppm_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(35, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(65, $y_ini_aux, 70, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(135, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(150, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(165, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);



        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(25, 130, 15, 25));
        $pdf->setWeight(array('B', '', 'B', '', 'B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('ASPECTO:'),
            ajustarCaracteres($muestra['aspecto_muestra']),
            ajustarCaracteres('PH:'),
            ajustarCaracteres($muestra['ph_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(35, $y_ini_aux, 130, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(165, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L'));
        $pdf->SetWidths2(array(195));
        $pdf->Row2(array(
            ajustarCaracteres('OTROS: ' . $muestra['otros_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C'));
        $pdf->SetWidths2(array(195));
        $pdf->setWeight(array('B'));
        $pdf->Row2(array(
            ajustarCaracteres('OBSERVACIONES')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L'));
        $pdf->SetWidths2(array(195));
        $pdf->setWeight(array(''));
        $pdf->Row2(array(
            ajustarCaracteres($muestra['observ_muestra'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);


        $pdf->Ln(5);

        $pdf->SetFont("Arial", "B", 8);
        $pdf->Cell(195, 5, ajustarCaracteres('MUESTRA: ' . $muestra['muestra_oficial_detalle']), 0, 1, 'C');


        $pdf->Footer();

        //Se guarda el documento pdf
        $nombreArchivo = "../tmp/acta_toma_" . $id_usuario . ".pdf";
        $pdf->Output($nombreArchivo, "F");
        ?>
        <input type="hidden" id="hdd_ruta_arch_pdf" value="<?php echo($nombreArchivo); ?>" />
        <?php
    }
}

function opcion2() {
    if (isset($_SESSION["idUsuario"])) {
        $utilidades = new Utilidades();

        $id_usuario = $_SESSION["idUsuario"];
        @$cod = $utilidades->limpiar_tags($_POST["cod"]);


        $dbVariables = new DbVariables();
        $dbParasitismoIntestinal = new DbParasitismoIntestinal();
        $dbParasitismoIntestinalParasitos = new DbParasitismoIntestinalParasitos();
        $dbParasitismoIntestinalBacterias = new DbParasitismoIntestinalBacterias();

        $registro = $dbParasitismoIntestinal->getEnvioPorUsuarioYEnvio($id_usuario, $cod);

        $pdf = new PDF('P', 'mm', array(216, 279));
        $pdf->SetAutoPageBreak(true, 10);
        $pdfHTML = new PDF_HTML();

        imprimir_encabezado($pdf, 2, 'REPORTE DE PARASITOSIS INTESTINAL', $dbVariables);

        $pdf->Ln(15);

        $pdf->SetFont("Arial", "B", 8);
        //$pdf->Cell(97, 5, ajustarCaracteres('AÑO DE NOTIFICACIÓN: ' . $registro['year_notifica']), 0, 1, 'L');
        //$pdf->Cell(97, 5, ajustarCaracteres('MES DE NOTIFICACIÓN: ' . $registro['mes_notifica']), 0, 1, 'L');


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 155));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('NOTIFICA:'),
            ajustarCaracteres($registro['nombre_usuario'] . ' ' . $registro['apellido_usuario'] . ' (@' . $registro['login_usuario'] . ')'),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 90, 40, 25));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('AÑO DE NOTIFICACIÓN:'),
            ajustarCaracteres($registro['year_notifica']),
            ajustarCaracteres('MES DE NOTIFICACIÓN:'),
            ajustarCaracteres($registro['mes_notifica'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 90, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(140, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(40, 155));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('MUNICIPIO DE PROCEDENCIA:'),
            ajustarCaracteres($registro['municipio_procedencia'])
                //ajustarCaracteres('MUNICIPIO DE PROCEDENCIA:'),
                //ajustarCaracteres($registro['municipio_procedencia'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);
        //$pdf->Rect(140, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
        //$pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);


        $pdf->Ln(5);
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C'));
        $pdf->SetWidths2(array(195));
        $pdf->setWeight(array('B'));
        $pdf->Row2(array(
            ajustarCaracteres('INFORMACIÓN DEL LABORATORIO'),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 165));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('NOMBRE:'),
            ajustarCaracteres($registro['nombre_lab']),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 165));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DIRECCIÓN:'),
            ajustarCaracteres($registro['dir_lab']),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'C', 'L', 'C', 'L', 'C'));
        $pdf->SetWidths2(array(30, 30, 30, 30, 30, 45));
        $pdf->setWeight(array('B', '', 'B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('NIVEL:'),
            ajustarCaracteres($registro['nivel_lab']),
            ajustarCaracteres('# DE DISTINTIVO:'),
            ajustarCaracteres($registro['num_distintivo_lab']),
            ajustarCaracteres('N.I.T.:'),
            ajustarCaracteres($registro['nit_lab'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(100, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 90, 30, 45));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('DEPARTAMENTO:'),
            ajustarCaracteres($registro['lab_departamento']),
            ajustarCaracteres('MUNICIPIO:'),
            ajustarCaracteres($registro['lab_municipio'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 90, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'L'));
        $pdf->SetWidths2(array(30, 90, 30, 45));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('TELÉFONOS:'),
            ajustarCaracteres($registro['tel1_lab'] . ' ' . $registro['tel2_lab']),
            ajustarCaracteres('EMAIL:'),
            ajustarCaracteres($registro['email_lab'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(40, $y_ini_aux, 90, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);


        /* PARÁSITOS */
        $pdf->Ln(5);
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C'));
        $pdf->SetWidths2(array(195));
        $pdf->setWeight(array('B'));
        $pdf->Row2(array(
            ajustarCaracteres('PARÁSITOS'),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'C', 'L', 'C'));
        $pdf->SetWidths2(array(45, 55, 45, 50));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('MUESTRAS ANALIZADAS:'),
            ajustarCaracteres($registro['p_muestras']),
            ajustarCaracteres('MUESTRAS POSITIVAS:'),
            ajustarCaracteres($registro['p_muestras_positivas'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 55, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(110, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(155, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 75, 75));
        $pdf->setWeight(array('B', 'B', 'B'));
        $pdf->Row2(array(
            '',
            ajustarCaracteres('MUJERES'),
            ajustarCaracteres('HOMBRES')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 75, 75));
        $pdf->setWeight(array('B', 'B', 'B'));
        $pdf->Row2(array(
            '',
            ajustarCaracteres('GRUPOS DE EDAD'),
            ajustarCaracteres('GRUPOS DE EDAD')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15));
        $pdf->setWeight(array('B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B'));
        $pdf->Row2(array(
            ajustarCaracteres(''),
            ajustarCaracteres('0-5'),
            ajustarCaracteres('6-15'),
            ajustarCaracteres('16-20'),
            ajustarCaracteres('21-60'),
            ajustarCaracteres('>60'),
            ajustarCaracteres('0-5'),
            ajustarCaracteres('6-15'),
            ajustarCaracteres('16-20'),
            ajustarCaracteres('21-60'),
            ajustarCaracteres('>60')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(85, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(100, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(115, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

        $pdf->Rect(130, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(145, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(175, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(190, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

        /* Procesa los parasitos */
        $tablaParasitos = $dbParasitismoIntestinalParasitos->getParasitosPorReporte($registro['cod_p_i']);

        $codParasitoTmp = 0;
        $contadorTmp = 1; //Contador para dar el salto
        $contadorArrayTmp = 0;
        $parasitoArray = array();
        foreach ($tablaParasitos as $parasito) {

            if ($contadorTmp == 1) {//Asigna el codigo del parasito 
                /* Verifica si el indicador de otro parásito */
                if ($parasito['ind_otro'] == 1) {
                    $parasitoArray[$contadorArrayTmp][0] = $parasito['nom_par'] . ': ' . $parasito['texto_otro_p_i_p'];
                } else {
                    $parasitoArray[$contadorArrayTmp][0] = $parasito['nom_par'];
                }

                $parasitoArray[$contadorArrayTmp][1] = $parasito['g1_p_i_p']; //Mujer
                $parasitoArray[$contadorArrayTmp][2] = $parasito['g2_p_i_p']; //Mujer
                $parasitoArray[$contadorArrayTmp][3] = $parasito['g3_p_i_p']; //Mujer
                $parasitoArray[$contadorArrayTmp][4] = $parasito['g4_p_i_p']; //Mujer
                $parasitoArray[$contadorArrayTmp][5] = $parasito['g5_p_i_p']; //Mujer
            } else {
                $parasitoArray[$contadorArrayTmp][6] = $parasito['g1_p_i_p']; //Hombre
                $parasitoArray[$contadorArrayTmp][7] = $parasito['g2_p_i_p']; //Hombre
                $parasitoArray[$contadorArrayTmp][8] = $parasito['g3_p_i_p']; //Hombre
                $parasitoArray[$contadorArrayTmp][9] = $parasito['g4_p_i_p']; //Hombre
                $parasitoArray[$contadorArrayTmp][10] = $parasito['g5_p_i_p']; //Hombre
                $contadorArrayTmp++;
                $contadorTmp = 0;
            }

            $contadorTmp++;
        }

        foreach ($parasitoArray as $values) {
            $y_ini_aux = $pdf->GetY();
            $pdf->SetAligns2(array('L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
            $pdf->SetWidths2(array(45, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15));
            $pdf->setWeight(array('I', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B'));
            $pdf->Row2(array(
                ajustarCaracteres($values[0]),
                ajustarCaracteres($values[1]),
                ajustarCaracteres($values[2]),
                ajustarCaracteres($values[3]),
                ajustarCaracteres($values[4]),
                ajustarCaracteres($values[5]),
                ajustarCaracteres($values[6]),
                ajustarCaracteres($values[7]),
                ajustarCaracteres($values[8]),
                ajustarCaracteres($values[8]),
                ajustarCaracteres($values[10])
            ));
            $y_fin_aux = $pdf->GetY();
            if ($y_ini_aux > $y_fin_aux) {
                $y_ini_aux = 34;
            }
            $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(55, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(70, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(85, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(100, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(115, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

            $pdf->Rect(130, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(145, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(160, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(175, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(190, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        }







        /* BACTERIAS */
        $pdf->Ln(5);
        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C'));
        $pdf->SetWidths2(array(195));
        $pdf->setWeight(array('B'));
        $pdf->Row2(array(
            ajustarCaracteres('BACTERIAS'),
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'C', 'L', 'C'));
        $pdf->SetWidths2(array(45, 55, 45, 50));
        $pdf->setWeight(array('B', '', 'B', ''));
        $pdf->Row2(array(
            ajustarCaracteres('TOTAL COPROCULTIVO:'),
            ajustarCaracteres($registro['b_muestras']),
            ajustarCaracteres('COPROCULTIVOS POSITIVOS:'),
            ajustarCaracteres($registro['b_muestras_positivas'])
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 55, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(110, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(155, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 75, 75));
        $pdf->setWeight(array('B', 'B', 'B'));
        $pdf->Row2(array(
            '',
            ajustarCaracteres('COPROCULTIVO'),
            ajustarCaracteres('AISLAMIENTO')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);

        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 75, 75));
        $pdf->setWeight(array('B', 'B', 'B'));
        $pdf->Row2(array(
            '',
            ajustarCaracteres('GRUPOS DE EDAD'),
            ajustarCaracteres('GRUPOS DE EDAD')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(130, $y_ini_aux, 75, $y_fin_aux - $y_ini_aux);


        $y_ini_aux = $pdf->GetY();
        $pdf->SetAligns2(array('L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetWidths2(array(45, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15));
        $pdf->setWeight(array('B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B'));
        $pdf->Row2(array(
            ajustarCaracteres(''),
            ajustarCaracteres('0-5'),
            ajustarCaracteres('6-15'),
            ajustarCaracteres('16-20'),
            ajustarCaracteres('21-60'),
            ajustarCaracteres('>60'),
            ajustarCaracteres('0-5'),
            ajustarCaracteres('6-15'),
            ajustarCaracteres('16-20'),
            ajustarCaracteres('21-60'),
            ajustarCaracteres('>60')
        ));
        $y_fin_aux = $pdf->GetY();
        if ($y_ini_aux > $y_fin_aux) {
            $y_ini_aux = 34;
        }
        $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(55, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(70, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(85, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(100, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(115, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

        $pdf->Rect(130, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(145, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(160, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(175, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        $pdf->Rect(190, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

        /* Procesa los parasitos */
        $tablaBacterias = $dbParasitismoIntestinalBacterias->getBacteriasPorReporte($registro['cod_p_i']);

        $codParasitoTmp = 0;
        $contadorTmp = 1; //Contador para dar el salto
        $contadorArrayTmp = 0;
        $bacteriaArray = array();
        foreach ($tablaBacterias as $bacteria) {

            if ($contadorTmp == 1) {//Asigna el codigo del parasito 
                /* Verifica si el indicador de otro parásito */
                if ($bacteria['ind_otro'] == 1) {
                    $bacteriaArray[$contadorArrayTmp][0] = $bacteria['nom_bact'] . ': ' . $bacteria['texto_otro_p_i_b'];
                } else {
                    $bacteriaArray[$contadorArrayTmp][0] = $bacteria['nom_bact'];
                }

                $bacteriaArray[$contadorArrayTmp][1] = $bacteria['g1_p_i_b']; //Mujer
                $bacteriaArray[$contadorArrayTmp][2] = $bacteria['g2_p_i_b']; //Mujer
                $bacteriaArray[$contadorArrayTmp][3] = $bacteria['g3_p_i_b']; //Mujer
                $bacteriaArray[$contadorArrayTmp][4] = $bacteria['g4_p_i_b']; //Mujer
                $bacteriaArray[$contadorArrayTmp][5] = $bacteria['g5_p_i_b']; //Mujer
            } else {
                $bacteriaArray[$contadorArrayTmp][6] = $bacteria['g1_p_i_b']; //Hombre
                $bacteriaArray[$contadorArrayTmp][7] = $bacteria['g2_p_i_b']; //Hombre
                $bacteriaArray[$contadorArrayTmp][8] = $bacteria['g3_p_i_b']; //Hombre
                $bacteriaArray[$contadorArrayTmp][9] = $bacteria['g4_p_i_b']; //Hombre
                $bacteriaArray[$contadorArrayTmp][10] = $bacteria['g5_p_i_b']; //Hombre
                $contadorArrayTmp++;
                $contadorTmp = 0;
            }

            $contadorTmp++;
        }

        foreach ($bacteriaArray as $values) {
            $y_ini_aux = $pdf->GetY();
            $pdf->SetAligns2(array('L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
            $pdf->SetWidths2(array(45, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15));
            $pdf->setWeight(array('I', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B'));
            $pdf->Row2(array(
                ajustarCaracteres($values[0]),
                ajustarCaracteres($values[1]),
                ajustarCaracteres($values[2]),
                ajustarCaracteres($values[3]),
                ajustarCaracteres($values[4]),
                ajustarCaracteres($values[5]),
                ajustarCaracteres($values[6]),
                ajustarCaracteres($values[7]),
                ajustarCaracteres($values[8]),
                ajustarCaracteres($values[8]),
                ajustarCaracteres($values[10])
            ));
            $y_fin_aux = $pdf->GetY();
            if ($y_ini_aux > $y_fin_aux) {
                $y_ini_aux = 34;
            }
            $pdf->Rect(10, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(55, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(70, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(85, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(100, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(115, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);

            $pdf->Rect(130, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(145, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(160, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(175, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
            $pdf->Rect(190, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
        }



        /*
          $pdf->SetFont("Arial", "B", 8);
          $pdf->Cell(97, 5, ajustarCaracteres('NÚMERO RADICADO: ' . $muestra['numero_radicado']), 0, 0, 'L');
          $pdf->Cell(97, 5, ajustarCaracteres('ACTA NÚMERO: ' . $muestra['acta_numero']), 0, 1, 'R');


          $pdf->Ln(5);

          $pdf->SetFont("Arial", "", 8);
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(25, 170));
          $pdf->setWeight(array('B'));
          $pdf->Row2(array(
          ajustarCaracteres('SOLICITANTE:'),
          ajustarCaracteres($muestra['solicitante_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(35, $y_ini_aux, 170, $y_fin_aux - $y_ini_aux);

          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(25, 120, 20, 30));
          $pdf->setWeight(array('B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('DIRECCIÓN:'),
          ajustarCaracteres($muestra['dir_s_muestra']),
          ajustarCaracteres('TELÉFONO:'),
          ajustarCaracteres($muestra['tel_s_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(35, $y_ini_aux, 120, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(155, $y_ini_aux, 20, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(175, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);

          $pdf->Ln(5);

          $pdf->SetFont("Arial", "B", 8);
          $pdf->Cell(30, 5, ajustarCaracteres('FECHA DE LA TOMA:'), 1, 0, 'L');
          $pdf->SetFont("Arial", "", 8);
          $pdf->Cell(67, 5, ajustarCaracteres($muestra['fecha_toma']), 1, 0, 'L');
          $pdf->SetFont("Arial", "B", 8);
          $pdf->Cell(30, 5, ajustarCaracteres('HORA DE LA TOMA:'), 1, 0, 'L');
          $pdf->SetFont("Arial", "", 8);
          $pdf->Cell(68, 5, ajustarCaracteres($muestra['hora_toma']), 1, 1, 'L');

          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(30, 165));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('NOMBRE EPSA:'),
          ajustarCaracteres($muestra['nom_epsa_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(30, 165));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('DIRECCIÓN EPSA:'),
          ajustarCaracteres($muestra['dir_epsa_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L', 'L', 'L', 'L', 'L'));
          $pdf->SetWidths2(array(30, 30, 30, 30, 30, 45));
          $pdf->setWeight(array('B', '', 'B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('DEPARTAMENTO:'),
          ajustarCaracteres($muestra['nom_dep']),
          ajustarCaracteres('MUNICIPIO:'),
          ajustarCaracteres($muestra['nom_mun']),
          ajustarCaracteres('VEREDA:'),
          ajustarCaracteres($muestra['vereda_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(40, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(70, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(100, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(130, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(160, $y_ini_aux, 45, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(60, 135));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('¿PUNTO DE MUESTRA CONCRETADO?:'),
          ajustarCaracteres($muestra['concretado_muestra'] == 1 ? "Sí" : "No")
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 60, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(70, $y_ini_aux, 135, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(50, 10, 16, 119));
          $pdf->setWeight(array('B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('CÓDIGO PUNTO DE MUESTREO:'),
          ajustarCaracteres($muestra['punto_muestra']),
          ajustarCaracteres('NOMBRE:'),
          ajustarCaracteres($muestra['nombre_punto_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(60, $y_ini_aux, 10, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(70, $y_ini_aux, 16, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(86, $y_ini_aux, 119, $y_fin_aux - $y_ini_aux);



          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(50, 145));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('DIRECCIÓN PUNTO DE TOMA:'),
          ajustarCaracteres($muestra['dir_punto_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 50, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(60, $y_ini_aux, 145, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(15, 180));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('FUENTE:'),
          ajustarCaracteres($muestra['fuente_punto_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(25, $y_ini_aux, 180, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(30, 165));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('TIPO DE MUESTRA:'),
          ajustarCaracteres($muestra['tipo_muestra_det'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 30, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(40, $y_ini_aux, 165, $y_fin_aux - $y_ini_aux);


          $pdf->Ln(5);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(40, 155));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('MUESTRA TOMADA POR:'),
          ajustarCaracteres($muestra['nombre_usuario_crea'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(95, 100));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('¿ACOMPAÑAMIENTO POR PARTE DE LA EMPRESA PRESTADORA?:'),
          ajustarCaracteres($muestra['acompano_epsa'] == 1 ? 'Sí' : 'No')
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 95, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(105, $y_ini_aux, 100, $y_fin_aux - $y_ini_aux);

          if ($muestra['acompano_epsa'] == 1) {
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(20, 80, 15, 80));
          $pdf->setWeight(array('B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('NOMBRE:'),
          ajustarCaracteres($muestra['nom_acompano_epsa']),
          ajustarCaracteres('CARGO:'),
          ajustarCaracteres($muestra['cargo_acompano_epsa']),
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 20, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(30, $y_ini_aux, 80, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(110, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(125, $y_ini_aux, 80, $y_fin_aux - $y_ini_aux);
          }

          $pdf->Ln(5);

          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(40, 155));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('ANÁLISIS SOLICITADO:'),
          ajustarCaracteres($muestra['analisis_solicitado'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);
          if ($muestra['analisis_s_muestra'] == 53) {
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L'));
          $pdf->SetWidths2(array(40));
          $pdf->Row2(array(
          ajustarCaracteres($muestra['otro_analisis_s_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);
          }
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(40, 155));
          $pdf->setWeight(array('B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('OBJETO DEL ANÁLISIS:'),
          ajustarCaracteres($muestra['objeto_analisis_solicitado'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 40, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(50, $y_ini_aux, 155, $y_fin_aux - $y_ini_aux);
          if ($muestra['obj_analisis_muestra'] == 56) {
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L'));
          $pdf->SetWidths2(array(40));
          $pdf->Row2(array(
          ajustarCaracteres($muestra['otro_obj_analisis_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);
          }
          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L', 'L', 'L', 'L', 'L', 'L', 'L'));
          $pdf->SetWidths2(array(25, 15, 15, 70, 15, 15, 15, 25));
          $pdf->setWeight(array('B', '', 'B', '', 'B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('TEMPERATURA:'),
          ajustarCaracteres($muestra['temp_muestra'] . '°C'),
          ajustarCaracteres('COLOR:'),
          ajustarCaracteres($muestra['color_muestra']),
          ajustarCaracteres('CL.RL:'),
          ajustarCaracteres($muestra['clrl_muestra']),
          ajustarCaracteres('P.P.M.:'),
          ajustarCaracteres($muestra['ppm_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(35, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(50, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(65, $y_ini_aux, 70, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(135, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(150, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(165, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);



          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L', 'L'));
          $pdf->SetWidths2(array(25, 130, 15, 25));
          $pdf->setWeight(array('B', '', 'B', '', 'B', '', 'B', ''));
          $pdf->Row2(array(
          ajustarCaracteres('ASPECTO:'),
          ajustarCaracteres($muestra['aspecto_muestra']),
          ajustarCaracteres('PH:'),
          ajustarCaracteres($muestra['ph_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(35, $y_ini_aux, 130, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(165, $y_ini_aux, 15, $y_fin_aux - $y_ini_aux);
          $pdf->Rect(180, $y_ini_aux, 25, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L'));
          $pdf->SetWidths2(array(195));
          $pdf->Row2(array(
          ajustarCaracteres('OTROS: ' . $muestra['otros_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);

          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('C'));
          $pdf->SetWidths2(array(195));
          $pdf->setWeight(array('B'));
          $pdf->Row2(array(
          ajustarCaracteres('OBSERVACIONES')
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);


          $y_ini_aux = $pdf->GetY();
          $pdf->SetAligns2(array('L'));
          $pdf->SetWidths2(array(195));
          $pdf->setWeight(array(''));
          $pdf->Row2(array(
          ajustarCaracteres($muestra['observ_muestra'])
          ));
          $y_fin_aux = $pdf->GetY();
          if ($y_ini_aux > $y_fin_aux) {
          $y_ini_aux = 34;
          }
          $pdf->Rect(10, $y_ini_aux, 195, $y_fin_aux - $y_ini_aux);


          $pdf->Ln(5);

          $pdf->SetFont("Arial", "B", 8);
          $pdf->Cell(195, 5, ajustarCaracteres('MUESTRA: ' . $muestra['muestra_oficial_detalle']), 0, 1, 'C');
         */

        $pdf->Footer();

        //Se guarda el documento pdf
        $nombreArchivo = "../tmp/acta_toma_" . $id_usuario . ".pdf";
        $pdf->Output($nombreArchivo, "F");
        ?>
        <input type="hidden" id="hdd_ruta_arch_pdf" value="<?php echo($nombreArchivo); ?>" />
        <?php
    }
}
?>
