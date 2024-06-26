<?php

// Almacenando datos
$user_id_del = limpiar_cadena($_GET['user_id_del']); // Se obtiene y limpia el ID del usuario a eliminar desde la variable GET.

// Verificando usuario
$check_usuario = conexion(); // Se establece la conexión a la base de datos.
$check_usuario = $check_usuario->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$user_id_del'");

if ($check_usuario->rowCount() == 1) { // Si se encontró el usuario en la base de datos.

    $check_usuario_clase = conexion(); // Se verifica si el usuario tiene clases asociadas.
    $check_usuario_clase = $check_usuario_clase->query("SELECT usuario_identificacion FROM usuario_clase WHERE usuario_identificacion='$user_id_del' LIMIT 1");

    if ($check_usuario_clase->rowCount() <= 0) { // Si el usuario no tiene clases asociadas, se procede con la eliminación.

        $eliminar_usuario = conexion(); // Se prepara la consulta para eliminar al usuario.
        $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_identificacion=:id");

        $eliminar_usuario->execute([":id" => $user_id_del]); // Se ejecuta la eliminación.

        if ($eliminar_usuario->rowCount() == 1) { // Si se eliminó correctamente el usuario.
            echo '
                <div class="notification is-info is-light">
                    <strong>¡USUARIO ELIMINADO!</strong><br>
                    Los datos del usuario se eliminaron con éxito
                </div>
            ';
        } else { // Si ocurrió un error al eliminar el usuario.
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor intente nuevamente
                </div>
            ';
        }
        $eliminar_usuario = null; // Se libera la variable de la consulta preparada.
    } else { // Si el usuario tiene clases asociadas y no puede ser eliminado.
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No podemos eliminar el usuario ya que tiene clases registradas
            </div>
        ';
    }
    $check_usuario_clase = null; // Se libera la variable de la consulta de clases asociadas.
} else { // Si el usuario no existe en la base de datos.
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El USUARIO que intenta eliminar no existe
        </div>
    ';
}
$check_usuario = null; // Se libera la variable de la consulta principal de usuario.
?>
<?php
include('main.php');

if (isset($_POST['qr_code'])) {
    $qrCode = $_POST['qr_code'];

    try {
        $conn = conexion();

        // Buscar el usuario y clase asociados con el código QR
        $stmt = $conn->prepare("SELECT usuario_identificacion, clase_id FROM usuario_clase WHERE generated_code = :qr_code LIMIT 1");
        $stmt->bindParam(':qr_code', $qrCode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $usuarioIdentificacion = $result['usuario_identificacion'];
            $userclassID = $result['clase_id'];

            // Insertar la asistencia en la base de datos
            $stmt = $conn->prepare("INSERT INTO asistencia (usuario_identificacion, clase_id) VALUES (:usuario_identificacion, :clase_id)");
            $stmt->bindParam(':usuario_identificacion', $usuarioIdentificacion);
            $stmt->bindParam(':clase_id', $userclassID);
            $stmt->execute();

            echo "Attendance recorded successfully.";
        } else {
            echo "Invalid QR Code.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No QR Code detected.";
}
?>
MariaDB [pdo]> desc usuario_clase;
+------------------------+--------------+------+-----+---------+----------------+
| Field                  | Type         | Null | Key | Default | Extra          |
+------------------------+--------------+------+-----+---------+----------------+
| userclass_id           | int(11)      | NO   | PRI | NULL    | auto_increment |
| clase_id               | int(11)      | NO   | MUL | NULL    |                |
| usuario_identificacion | int(11)      | NO   | MUL | NULL    |                |
| generated_code         | varchar(255) | NO   |     | NULL    |                |
+------------------------+--------------+------+-----+---------+----------------+
4 rows in set (0.026 sec)

MariaDB [pdo]> desc clases;
+-----------------+--------------+------+-----+---------+----------------+
| Field           | Type         | Null | Key | Default | Extra          |
+-----------------+--------------+------+-----+---------+----------------+
| clase_id        | int(11)      | NO   | PRI | NULL    | auto_increment |
| clase_nombre    | varchar(100) | NO   |     | NULL    |                |
| clase_ubicacion | varchar(100) | NO   |     | NULL    |                |
+-----------------+--------------+------+-----+---------+----------------+
3 rows in set (0.013 sec)

MariaDB [pdo]> desc asistencia;
+------------------------+-----------+------+-----+---------------------+-------------------------------+
| Field                  | Type      | Null | Key | Default             | Extra                         |
+------------------------+-----------+------+-----+---------------------+-------------------------------+
| asistencia_id          | int(11)   | NO   | PRI | NULL                | auto_increment                |
| usuario_identificacion | int(11)   | NO   |     | NULL                |                               |
| clase_id               | int(11)   | NO   |     | NULL                |                               |
| fecha                  | timestamp | NO   |     | current_timestamp() | on update current_timestamp() |
+------------------------+-----------+------+-----+---------------------+-------------------------------+
4 rows in set (0.013 sec)