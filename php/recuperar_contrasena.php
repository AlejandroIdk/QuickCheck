<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "../php/main.php";
include "../inc/head.php";

session_start();

require_once("../PHPMailer/Exception.php");
require_once("../PHPMailer/PHPMailer.php");
require_once("../PHPMailer/SMTP.php");

function correoExiste($correo)
{
    $pdo = conexion();
    if ($pdo) {
        try {
            $consulta = "SELECT COUNT(*) FROM usuario WHERE usuario_email = ?";
            $stmt = $pdo->prepare($consulta);
            $stmt->execute([$correo]);
            $resultado = $stmt->fetchColumn();
            return $resultado > 0;
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
    return false;
}

function enviarCorreo($nombre, $correo, $asunto, $bodyHTML)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'alejandroortizbv19@gmail.com';
    $mail->Password = 'bjrhyxffuwpmybka';

    $mail->setFrom("alejandroortizbv19@gmail.com", "QUICK CHECK");
    $mail->addAddress($correo, $nombre);
    $mail->Subject = $asunto;
    $mail->Body = $bodyHTML;
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";

    try {
        return $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["correo"])) {
        $correoDestino = limpiar_cadena($_POST["correo"]);
        $num = rand(1000, 9999);
        if (correoExiste($correoDestino)) {
            $imagen = 'https://res.cloudinary.com/dqvp5awy6/image/upload/v1722353012/logomailer_s6qq89.jpg';

            $bodyHTML = '
                <div style="margin: 0 auto; width: fit-content; border: 2px solid blue; padding: 20px;">
                    <img src="' . $imagen . '" alt="Imagen" style="max-width: 100%; display: block;">
                    <br>
                    <div style="max-width: 100%;">
                        <p style="color: black;">
                            Querido usuario,
                            <br>
                            Hemos recibido una solicitud de recuperación de contraseña para tu cuenta. Para continuar con el proceso,
                            necesitamos verificar tu identidad. <br> Por favor, utiliza el siguiente código de verificación:
                        </p>
                        <h1 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">' . $num . '</h1>
                        <p style="color: black;">
                            Si no has solicitado esta acción o crees que has recibido este correo por error, por favor, ignóralo.
                        </p>
                        <p style="color: black;">
                            Gracias,<br>
                            El equipo de soporte.
                        </p>
                    </div>
                </div>
            ';

            $enviado = enviarCorreo("Usuario", $correoDestino, "RESTABLECIMIENTO DE CLAVE", $bodyHTML);


            if ($enviado) {
                $_SESSION['codigo_recuperacion'] = $num;
                $_SESSION['correo'] = $correoDestino;
                echo '<script>
					document.addEventListener("DOMContentLoaded", function () {
						Swal.fire({
							title: "¡Correo de verificación enviado correctamente!",
							text: "Hemos enviado un código de verificación a tu correo electrónico. Por favor, revisa tu bandeja de entrada.",
							icon: "success",
							showConfirmButton: true,
							confirmButtonText: "Siguiente",
							allowOutsideClick: false,
							allowEscapeKey: false
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "../vistas/validate_code.php";
							}
						});
					});
				</script>';
            } else {
                echo '<script>
					document.addEventListener("DOMContentLoaded", function () {
						Swal.fire({
							icon: "error",
							title: "Error al enviar el correo",
							text: "Surgió un error al enviar el correo, por favor vuelve a intentarlo.",
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true
						});
					});
				</script>';
            }
        } else {
            echo '<script>
				document.addEventListener("DOMContentLoaded", function () {
					Swal.fire({
						icon: "error",
						title: "¡Ups, Correo no encontrado!",
						text: "El correo electrónico que ingresaste no está conectado a una cuenta.",
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true
					});
				});
			</script>';
        }
    }
}
?>