<?php
    // Incluir el archivo main.php que contiene funciones y configuraciones generales
    require_once "./php/main.php";

    // Obtener el ID del usuario a actualizar desde la URL (si está presente)
    $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;

    // Limpiar el valor de $id para asegurar que sea seguro
    $id = limpiar_cadena($id);
?>

<div class="container is-fluid mb-6">
    <?php 
        // Verificar si el ID coincide con el ID de sesión actual
        if ($id == $_SESSION['id']) { 
    ?>
        <!-- Si coincide, mostrar título y subtítulo para "Mi cuenta" -->
        <h1 class="title">Mi cuenta</h1>
        <h2 class="subtitle">Actualizar datos de cuenta</h2>
    <?php } else { ?>
        <!-- Si no coincide, mostrar título y subtítulo para "Actualizar usuario" -->
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Actualizar usuario</h2>
    <?php } ?>
</div>

<div class="container pb-6 pt-6">
    <?php
        // Incluir el botón de retroceso (btn_back.php), probablemente un enlace para volver atrás
        include "./inc/btn_back.php";

        // Realizar la consulta para obtener los datos del usuario específico por su ID
        $check_usuario = conexion(); // Obtener la conexión a la base de datos desde main.php
        $check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_identificacion='$id'");

        // Verificar si se encontró algún usuario con el ID proporcionado
        if ($check_usuario->rowCount() > 0) {
            $datos = $check_usuario->fetch(); // Obtener los datos del primer usuario encontrado
    ?>

    <!-- Mostrar el nombre del usuario centrado como título -->
    <h2 class="title has-text-centered"><?php echo $datos['usuario_nombre']; ?></h2>

    <!-- Formulario para actualizar los datos del usuario -->
    <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <!-- Input oculto para el ID del usuario -->
        <input type="hidden" name="usuario_identificacion" value="<?php echo $datos['usuario_identificacion']; ?>" required>

        <!-- División de columnas para los campos -->
        <div class="columns">
            <div class="column">
                <!-- Campo para el rol del usuario -->
                <div class="control">
                    <label>Rol</label>
                    <input class="input" type="text" name="rol_code" pattern="[0-9]+" maxlength="5" required value="<?php echo $datos['rol_code']; ?>">
                </div>
            </div>
            <div class="column">
                <!-- Campo para el email del usuario -->
                <div class="control">
                    <label>Email</label>
                    <input class="input" type="email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
                </div>
            </div>
        </div>

        <!-- División de columnas para los campos -->
        <div class="columns">
            <div class="column">
                <!-- Campo para el nombre del usuario -->
                <div class="control">
                    <label>Nombres</label>
                    <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_nombre']; ?>">
                </div>
            </div>

            <div class="column">
                <!-- Campo para la identificación del usuario -->
                <div class="control">
                    <label>Identificacion</label>
                    <input class="input" type="text" name="usuario_identificacion" pattern="[0-9]{3,10}" maxlength="10" required value="<?php echo $datos['usuario_identificacion']; ?>">
                </div>
            </div>
        </div>

        <!-- División de columnas para los campos -->
        <div class="columns">
            <div class="column">
                <!-- Campo para la nueva clave del usuario -->
                <div class="control">
                    <label>Clave</label>
                    <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
            <div class="column">
                <!-- Campo para repetir la nueva clave del usuario -->
                <div class="control">
                    <label>Repetir clave</label>
                    <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
        </div>

        <!-- Botón para enviar el formulario de actualización -->
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>

    <?php 
        } else {
            // Si no se encuentra ningún usuario con el ID proporcionado, mostrar una alerta de error
            include "./inc/error_alert.php";
        }

        // Liberar la conexión a la base de datos
        $check_usuario = null;
    ?>
</div>
