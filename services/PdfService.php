<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta si usas Composer

use Dompdf\Dompdf;

class PdfService {
    public function generar(array $parte): string {
        // Crear instancia Dompdf
        $dompdf = new Dompdf();

        // Crear el contenido HTML del PDF
        $html = '
            <h2 style="text-align: center;">Parte de Trabajo</h2>
            <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <tr><th>Fecha</th><td>' . htmlspecialchars($parte['fecha']) . '</td></tr>
                <tr><th>Horas normales</th><td>' . htmlspecialchars($parte['horas_trabajadas']) . '</td></tr>
                <tr><th>Horas extra</th><td>' . htmlspecialchars($parte['horas_extra']) . '</td></tr>
                <tr><th>festivo</th><td>' . htmlspecialchars($parte['dia_festivo']) . '</td></tr>
                <tr><th>Observaciones</th><td>' . nl2br(htmlspecialchars($parte['observaciones'])) . '</td></tr>';


        if (!empty($parte['firma_responsable_empresaorigen'])) {
            $html .= '<tr><th>Firma responsable empresa origen</th>
                <td><img src="' . $parte['firma_responsable_empresaorigen'] . '" width="200"></td></tr>';
        }

        if (!empty($parte['firma_responsable_airtek'])) {
            $html .= '<tr><th>Firma responsable Airtek</th>
                <td><img src="' . $parte['firma_responsable_airtek'] . '" width="200"></td></tr>';
        }

        $html .= '</table>';

        // Cargar HTML en dompdf
        $dompdf->loadHtml($html);

        // Configurar tamaño y orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Definir ruta para guardar temporalmente
        $pdfPath = __DIR__ . '/../pdf_output/parte_' . $parte['id'] . '.pdf';

        // Crear directorio si no existe
        if (!is_dir(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0777, true);
        }

        // Guardar archivo
        file_put_contents($pdfPath, $dompdf->output());

        return $pdfPath;
    }
}
