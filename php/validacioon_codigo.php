<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/mayusculas.js"></script>
<?php
include "../php/main.php";
include "../inc/head.php";

session_start();

function correoExiste($correo)
{
    $pdo = conexion();
    if ($pdo) {
        $consulta = "SELECT COUNT(*) FROM USUARIO WHERE usuario_email = ?";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([$correo]);
        $resultado = $stmt->fetchColumn();
        return $resultado > 0;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["usuario_clave_1"]) && isset($_POST["usuario_clave_2"]) && isset($_SESSION['codigo_recuperacion']) && isset($_SESSION['correo'])) {
    $codigo = $_POST["codigo"];
    $newpassword = limpiar_cadena($_POST["usuario_clave_1"]);
    $newpassword2 = limpiar_cadena($_POST["usuario_clave_2"]);
    $correo = $_SESSION['correo'];

    if ($newpassword != $newpassword2) {
        echo '<script>
			document.addEventListener("DOMContentLoaded", function () {
				Swal.fire({
					icon: "error",
					title: "Las contraseñas no coinciden.",
					text: "Por favor, verifica las contraseñas e intenta nuevamente."
				});
			});
		</script>';
    } else {

		if ($codigo == $_SESSION['codigo_recuperacion']) {
            if (correoExiste($correo)) {
                $pdo = conexion();

                if ($pdo) {

					$hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

                    $sql = "UPDATE USUARIO SET usuario_clave = :clave WHERE usuario_email = :email";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['clave' => $hashed_password, 'email' => $correo]);

                    if ($stmt->rowCount() > 0) {
                        echo '<script>
							document.addEventListener("DOMContentLoaded", function () {
								Swal.fire({
									icon: "success",
									title: "¡Bien hecho, Clave Restablecida!",
									text: "Tu clave ha sido restablecida correctamente.",
									position: "top-end",
									showConfirmButton: false,
									timer: 2000
								}).then((result) => {
									if (result.isConfirmed || result.isDismissed) {
										window.location.href = "../index.php";
									}
								});
							});
						</script>';
                    } else {
                        echo '<script>
							document.addEventListener("DOMContentLoaded", function () {
								Swal.fire({
									icon: "error",
									title: "Error actualizando la clave.",
									text: "Hubo un problema al actualizar tu clave. Por favor, intenta nuevamente."
								});
							});
						</script>';
                    }
                    
                } else {
                    echo '<script>
						document.addEventListener("DOMContentLoaded", function () {

							Swal.fire({
								icon: "error",
								title: "Error de conexión.",
								text: "No se pudo conectar a la base de datos. Por favor, intenta nuevamente más tarde."
							});
						});

					</script>';
                }
            } else {
                header("Location: recuperacion.php");
                exit;
            }
        } else {
            echo '<script>
				document.addEventListener("DOMContentLoaded", function () {

					Swal.fire({
						icon: "error",
						title: "Código incorrecto.",
						text: "El código ingresado no es válido. Por favor, verifica e intenta nuevamente."
					});
				});

			</script>';
        }
    }
}
?>