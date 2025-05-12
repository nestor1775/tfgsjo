<?php
// Incluir el autoloader de Composer
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Supongamos que recibimos el ID del parte como parámetro GET
$parteId = $_GET['parte_id'];  // Se espera que pase un parámetro parte_id

// Aquí deberías obtener los datos del parte de trabajo desde tu base de datos, por ejemplo:
$parte = obtenerPartePorId($parteId);  // Función que obtiene la información de la base de datos

// Crear el contenido HTML del PDF
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

// Inicializar DomPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);  // Habilitar HTML5
$options->set('isPhpEnabled', true);  // Habilitar PHP en el HTML (en caso necesario)
$pdf = new Dompdf($options);

// Cargar el contenido HTML en DomPDF
$pdf->loadHtml($html);

// Configurar el tamaño del papel y la orientación
$pdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$pdf->render();

// Generar el archivo PDF y ofrecerlo para descarga
$pdf->stream('parte_de_trabajo.pdf', array('Attachment' => 1));  // 'Attachment' => 1 para forzar la descarga
?>
