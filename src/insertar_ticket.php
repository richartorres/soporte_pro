<?php

require_once '../config/database.php';

// Importamos las clases oficiales de PHPMailer al inicio del archivo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = htmlspecialchars($_POST['titulo']);
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
    $departamento = htmlspecialchars($_POST['departamento']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $prioridad = $_POST['prioridad'];

    try {
        // 1. Guardar de forma segura en la Base de Datos con PDO
        $sql = "INSERT INTO tickets (titulo, nombre_usuario, departamento, descripcion, prioridad, estado, fecha_creacion) 
                VALUES (:titulo, :nombre_usuario, :departamento, :descripcion, :prioridad, 'abierto', NOW())";
        
        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ':titulo'         => $titulo,
            ':nombre_usuario' => $nombre_usuario,
            ':departamento'   => $departamento,
            ':descripcion'    => $descripcion,
            ':prioridad'      => $prioridad
        ]);

        /* =========================================================================
        // 🚀 ENVÍO DE ALERTA AUTOMÁTICA CON PHPMAILER OFICIAL
        // =========================================================================
        
        // Carga de las librerías oficiales desde tu carpeta libs
        require_once __DIR__ . '/libs/PHPMailer/Exception.php';
        require_once __DIR__ . '/libs/PHPMailer/PHPMailer.php';
        require_once __DIR__ . '/libs/PHPMailer/SMTP.php';

        // Instanciamos la clase oficial (true activa las excepciones)
        $mail = new PHPMailer(true);

        try {
            // 2. CONFIGURACIÓN DEL SERVIDOR DE GOOGLE
            $mail->SMTPDebug = 0;                                      // 👈 CAMBIA A 0 PARA APAGAR EL TEXTO EN PANTALLA
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            
            $mail->Username   = 'soporte.tecnico@instruimos.com';       
            $mail->Password   = 'lbiifritpotyarmf';                    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // 3. REMITENTE Y DESTINATARIO
            $mail->setFrom('soporte.tecnico@instruimos.com', 'SoportePro Alertas');
            $mail->addAddress('soporte.tecnico@instruimos.com'); 

            // 4. DISEÑO HTML DEL MENSAJE
            // 4. DISEÑO HTML DEL MENSAJE ENRIQUECIDO
            $mail->isHTML(true);
            $mail->Subject = '⚠️ NUEVO TICKET DE SOPORTE - ' . $titulo . ' (Prioridad: ' . $prioridad . ')';
            $mail->Body    = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px;'>
                    <div style='background-color: #0d6efd; color: white; padding: 15px; text-align: center; border-radius: 6px 6px 0 0;'>
                        <h2 style='margin: 0;'>SoportePro - Alerta de Incidente</h2>
                    </div>
                    <div style='padding: 20px; color: #333333; line-height: 1.6;'>
                        <p style='font-size: 16px; margin-top: 0;'>Se ha registrado un nuevo reporte técnico en la red local.</p>
                        
                        <hr style='border: none; border-top: 1px solid #eeeeee;'>
                        
                        <!-- 📋 DATOS DEL COMPAÑERO Y DEL INCIDENTE -->
                        <table style='width: 100%; border-collapse: collapse; margin-bottom: 15px;'>
                            <tr>
                                <td style='padding: 6px 0; width: 35%; color: #666666;'><strong>Usuario afectado:</strong></td>
                                <td style='padding: 6px 0; color: #111111;'>" . $nombre_usuario . "</td>
                            </tr>
                            <tr>
                                <td style='padding: 6px 0; color: #666666;'><strong>Departamento / Área:</strong></td>
                                <td style='padding: 6px 0; color: #111111;'>" . $departamento . "</td>
                            </tr>
                            <tr>
                                <td style='padding: 6px 0; color: #666666;'><strong>Asunto / Incidente:</strong></td>
                                <td style='padding: 6px 0; color: #111111;'><strong>" . $titulo . "</strong></td>
                            </tr>
                            <tr>
                                <td style='padding: 6px 0; color: #666666;'><strong>Prioridad asignada:</strong></td>
                                <td style='padding: 6px 0;'><span style='background-color: #fff3cd; color: #856404; padding: 3px 8px; border-radius: 4px; font-size: 14px;'><strong>" . $prioridad . "</strong></span></td>
                            </tr>
                        </table>
                        
                        <hr style='border: none; border-top: 1px solid #eeeeee;'>
                        
                        <p style='margin-bottom: 5px;'><strong>Detalles y descripción del problema:</strong></p>
                        <blockquote style='background-color: #f8f9fa; padding: 15px; border-left: 4px solid #0d6efd; margin: 5px 0 15px 0; border-radius: 0 4px 4px 0;'>
                            " . $descripcion . "
                        </blockquote>
                        
                        <hr style='border: none; border-top: 1px solid #eeeeee;'>
                        <p style='font-size: 12px; color: #777777; text-align: center; margin-bottom: 0;'>Este es un correo automático generado por SoportePro.</p>
                    </div>
                </div>
            ";  

            // Se envía el correo de forma interna
            $mail->send();

        } catch (Exception $e) {
            error_log("Error de PHPMailer: " . $mail->ErrorInfo);
        } */

        // 🚀 RESPUESTA INMEDIATA PARA JAVASCRIPT (JSON de éxito)
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Ticket guardado correctamente']);
        exit;
        
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}
?>