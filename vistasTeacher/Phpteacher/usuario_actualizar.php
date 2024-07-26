<?php
require_once "../inc/session_start.php";
require_once "main.php";

$id = limpiar_cadena($_POST['usuario_identificacion']);

$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_identificacion='$id'");

if ($check_usuario->rowCount() <= 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en el sistema
            </div>
        ';
    exit();
} else {
    $datos = $check_usuario->fetch();
}
$check_usuario = null;

$rol = limpiar_cadena($_POST['rol_code']);
$nombre = limpiar_cadena($_POST['usuario_nombre']);
$identificacion = limpiar_cadena($_POST['usuario_identificacion']);
$email = limpiar_cadena($_POST['usuario_email']);
$clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
$clave_2 = limpiar_cadena($_POST['usuario_clave_2']);

if ($rol == "" || $nombre == "" || $identificacion == "" || $email == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
    exit();
}


if (verificar_datos("[0-9]", $rol)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El ROL no coincide con el formato solicitado
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
    exit();
}

if (verificar_datos("[0-9]{3,40}", $identificacion)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La Identificacion no coincide con el formato solicitado
            </div>
        ';
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El EMAIL no coincide con el formato solicitado
            </div>
        ';
    exit();
}


if ($email != "" && $email != $datos['usuario_email']) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check_email = conexion();
        $check_email = $check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
        if ($check_email->rowCount() > 0) {
            echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                ';
            exit();
        }
        $check_email = null;
    } else {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Ha ingresado un correo electrónico no valido
                </div>
            ';
        exit();
    }
}


if ($identificacion != $datos['usuario_identificacion']) {
    $check_usuario = conexion();
    $check_usuario = $check_usuario->query("SELECT usuario_identificacion FROM usuario WHERE usuario_identificacion='$identificacion'");
    if ($check_usuario->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La identificacion ingresada ya se encuentra registrada, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_usuario = null;
}



if ($clave_1 != "" || $clave_2 != "") {
    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_2)) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Las CLAVES no coinciden con el formato solicitado
	            </div>
	        ';
        exit();
    } else {
        if ($clave_1 != $clave_2) {
            echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                Las CLAVES que ha ingresado no coinciden
		            </div>
		        ';
            exit();
        } else {
            $clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);
        }
    }
} else {
    $clave = $datos['usuario_clave'];
}


$actualizar_usuario = conexion();
$actualizar_usuario = $actualizar_usuario->prepare("UPDATE usuario SET rol_code=:rol,usuario_nombre=:nombre,usuario_identificacion=:identificacion,usuario_clave=:clave,usuario_email=:email WHERE usuario_identificacion=:id");

$marcadores = [
    ":rol" => $rol,
    ":nombre" => $nombre,
    ":identificacion" => $identificacion,
    ":clave" => $clave,
    ":email" => $email,
    ":id" => $id
];



if ($actualizar_usuario->execute($marcadores)) {
    echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO ACTUALIZADO!</strong><br>
                El usuario se actualizo con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el usuario, por favor intente nuevamente
            </div>
        ';
}
$actualizar_usuario = null;
