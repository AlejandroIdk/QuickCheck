<?php
    require_once "main.php";

    $id = limpiar_cadena($_POST['userclass_id']);

    $check_usuario_clase = conexion()->prepare("SELECT * FROM usuario_clase WHERE userclass_id = :id");
    $check_usuario_clase->execute([':id' => $id]);

    if($check_usuario_clase->rowCount() <= 0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El usuario_clase no existe en el sistema
            </div>
        ';
        exit();
    }else{
        $datos = $check_usuario_clase->fetch();
    }

    $identificacion = limpiar_cadena($_POST['usuario_identificacion']);
    $clases = limpiar_cadena($_POST['usuario_clase_clases']);

    if($identificacion == "" || $clases == ""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    if($clases != $datos['clase_id']){
        $check_clases = conexion()->prepare("SELECT clase_id FROM clases WHERE clase_id = :clases");
        $check_clases->execute([':clases' => $clases]);
        if($check_clases->rowCount() <= 0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    La categoría seleccionada no existe
                </div>
            ';
            exit();
        }
    }

    $actualizar_usuario_clase = conexion()->prepare("UPDATE usuario_clase SET clase_id = :clases, usuario_identificacion = :identificacion WHERE userclass_id = :id");

    $marcadores = [
        ":identificacion" => $identificacion,
        ":clases" => $clases,
        ":id" => $id
    ];

    if($actualizar_usuario_clase->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡usuario_clase ACTUALIZADO!</strong><br>
                El usuario_clase se actualizó con éxito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo actualizar el usuario_clase, por favor intente nuevamente
            </div>
        ';
    }
?>
