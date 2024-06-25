<?php
require_once "../inc/session_start.php";
require_once "main.php";

if (!isset($_POST['rol_code'])) {
    echo '<div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              No se proporcionó el código de rol
          </div>';
    exit();
}

$code = limpiar_cadena($_POST['rol_code']);
$nombre = limpiar_cadena($_POST['rol_nombre']);

if ($code === "" || $nombre === "") {
    echo '<div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              No has llenado los campos que son obligatorios
          </div>';
    exit();
}

$check_rol = conexion()->prepare("SELECT * FROM roles WHERE rol_code = ?");
$check_rol->execute([$code]);
$existing_role = $check_rol->fetch(PDO::FETCH_ASSOC);

if (!$existing_role) {
    echo '<div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              El rol no existe en el sistema
          </div>';
    exit();
}

$update_rol = conexion()->prepare("UPDATE roles SET rol_nombre = ? WHERE rol_code = ?");
$update_rol->execute([$nombre, $code]);

if ($update_rol->rowCount() > 0) {
    echo '<div class="notification is-info is-light">
              <strong>¡ROL ACTUALIZADO!</strong><br>
              El rol se actualizó con éxito
          </div>';
} else {
    echo '<div class="notification is-danger is-light">
              <strong>¡Ocurrio un error inesperado!</strong><br>
              No se pudo actualizar el rol, por favor intente nuevamente
          </div>';
}
?>
