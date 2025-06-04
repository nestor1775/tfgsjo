<?php
// Incluir el autoloader de Composer
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


$parteId = $_GET['parte_id'];  // Se espera que pase un parámetro parte_id

$parte = obtenerPartePorId($parteId);  // Función que obtiene la información de la base de datos


$html = '
    <h1>Parte de Trabajo</h1>
    <h2>Fecha: ' . $parte['fecha'] . '</h2>
    <ul>
        <li><strong>Horas trabajadas:</strong> ' . $parte['horas_trabajadas'] . '</li>
        <li><strong>Horas extra:</strong> ' . $parte['horas_extra'] . '</li>
        <li><strong>Día festivo:</strong> ' . $parte['dia_festivo'] . '</li>
        <li><strong>Observaciones:</strong> ' . $parte['observaciones'] . '</li>
    </ul>';

if (!empty($parte['firma_responsable_empresaorigen'])) {
    $html .= '
    <h3>Firma del responsable de la empresa origen:</h3>
    <img src="' . $parte['firma_responsable_empresaorigen'] . '" alt="Firma responsable origen" style="max-width: 300px; border: 1px solid #ccc;">
    ';
}

if (!empty($parte['firma_responsable_airtek'])) {
    $html .= '
    <h3>Firma del responsable de Airtek:</h3>
    <img src="' . $parte['firma_responsable_airtek'] . '" alt="Firma responsable Airtek" style="max-width: 300px; border: 1px solid #ccc;">
    ';
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);  
$options->set('isPhpEnabled', true);  
$pdf = new Dompdf($options);

$pdf->loadHtml($html);

$pdf->setPaper('A4', 'portrait');

$pdf->render();

$pdf->stream('parte_de_trabajo.pdf', array('Attachment' => 1));  // 'Attachment' => 1 para forzar la descarga
?>
