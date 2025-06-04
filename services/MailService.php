<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class CorreoService {
    public function enviar($correoDestino, $pdfPath) {
        $mail = new PHPMailer(true);
        try {
            // Configuración SMTP con Gmail
            $mail->isSMTP();  
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail
            $mail->SMTPAuth = true;  // Autenticación SMTP
            $mail->Username = '';  // correo de Gmail
            $mail->Password = '';  // Contraseña de aplicación (No contraseña normal)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->Port = 587;  // Puerto SMTP de Gmail
            // Configuración de correo
            $mail->setFrom('', 'AirtekParte');  //remitente
            $mail->addAddress($correoDestino);  // Dirección de destino
            $mail->Subject = 'Parte en PDF';  // Asunto del correo
            $mail->Body = 'Adjunto parte de trabajo de airtek.';  // Cuerpo del correo
            $mail->addAttachment($pdfPath);  // Adjuntar el archivo PDF
            // Enviar el correo
            $mail->send();
            echo 'El correo ha sido enviado exitosamente.';
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    }
}
