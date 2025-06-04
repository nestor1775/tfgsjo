<?php

require_once __DIR__ . '/../vendor/autoload.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService {
    public function generar(array $parte): string {

        $options = new Options();
        $options->set('isRemoteEnabled', true); 
        $dompdf = new Dompdf($options);

        // Ruta del logo
        $logoPath = __DIR__ . '/../img/logo.png';
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoBase64;

        // HTML con estilo mejorado
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 40px;
                    font-size: 14px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header img {
                    max-height: 80px;
                }
                h2 {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 2px solid #444;
                    padding-bottom: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 30px;
                }
                th, td {
                    border: 1px solid #aaa;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f0f0f0;
                }
                ul {
                    list-style: disc;
                    padding-left: 20px;
                }
                .section-title {
                    margin-top: 40px;
                    font-weight: bold;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <img src="' . $logoSrc . '" alt="Logo">
            </div>

            <h2>Parte de Trabajo</h2>

            <table>
                <tr><th>Fecha</th><td>' . htmlspecialchars($parte['fecha']) . '</td></tr>
                <tr><th>Horas normales</th><td>' . htmlspecialchars($parte['horas_trabajadas']) . '</td></tr>
                <tr><th>Horas extra</th><td>' . htmlspecialchars($parte['horas_extra']) . '</td></tr>
                <tr><th>Festivo</th><td>' . htmlspecialchars($parte['dia_festivo']) . '</td></tr>
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

        if (!empty($parte['trabajadores']) && is_array($parte['trabajadores'])) {
            $html .= '<div class="section-title">Trabajadores:</div><ul>';
            foreach ($parte['trabajadores'] as $trabajador) {
                $html .= '<li>' . htmlspecialchars($trabajador) . '</li>';
            }
            $html .= '</ul>';
        }

        $html .= '
        </body>
        </html>';

        // Cargar HTML
        $dompdf->loadHtml($html);

        // Configurar tamaño y orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar
        $dompdf->render();

        // Guardar PDF
        $pdfPath = __DIR__ . '/../pdf_output/parte_' . $parte['id'] . '.pdf';
        if (!is_dir(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0777, true);
        }
        file_put_contents($pdfPath, $dompdf->output());

        return $pdfPath;
    }
}
