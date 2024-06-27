<?php
require_once "./php/main.php";

$id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
$id = limpiar_cadena($id);
?>
<div class="container is-fluid mb-6">
    <?php if ($id == $_SESSION['id']) { ?>
        <h1 class="title">Mi cuenta</h1>
        <h2 class="subtitle">Actualizar datos de cuenta</h2>
    <?php } else { ?>
        <h1 class="title">Usuarios</h1>
        <h2 class="subtitle">Actualizar usuario</h2>
    <?php } ?>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_back.php";

    /*== Verificando usuario ==*/
    $check_usuario = conexion();
    $check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_identificacion='$id'");

    if ($check_usuario->rowCount() > 0) {
        $datos = $check_usuario->fetch();
        ?>

        <div class="form-rest mb-6 mt-6"></div>

        <h2 class="title has-text-centered"><?php echo $datos['usuario_nombre'] . ' ' . $datos['usuario_apellido']; ?></h2>

        <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

            <input type="hidden" name="usuario_identificacion" value="<?php echo $datos['usuario_identificacion']; ?>" required>

            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="rol_code">Rol:</label>

                        <!-- Campo oculto para enviar rol_code -->
                        <input type="hidden" name="rol_code" value="<?php echo htmlspecialchars($datos['rol_code']); ?>">

                        <select class="form-control" disabled>
                            <?php
                            // Conexión y consulta para obtener los roles
                            $conexion = conexion();
                            $query = $conexion->query("SELECT * FROM roles");
                            $roles = $query->fetchAll();

                            // Iterar sobre los resultados y generar las opciones del select
                            foreach ($roles as $rol) {
                                // Determinar si esta opción debe ser seleccionada
                                $isSelected = ($rol['rol_code'] == $datos['rol_code']) ? 'selected' : '';

                                echo '<option value="' . $rol['rol_code'] . '" ' . $isSelected . '>' . htmlspecialchars($rol['rol_nombre']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $datos['usuario_nombre']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_apellido">Apellido:</label>
                        <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $datos['usuario_apellido']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_identificacion">Identificación:</label>
                        <input type="text" class="form-control" id="usuario_identificacion" name="usuario_identificacion" required pattern="[0-9]{3,10}" maxlength="10" value="<?php echo $datos['usuario_identificacion']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_email">Email:</label>
                        <input type="email" class="form-control" id="usuario_email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_clave_1">Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" required pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="usuario_clave_2">Confirmar Clave:</label>
                        <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" required pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                    </div>
                </div>
            </div>

            <p class="has-text-centered">
                <button type="submit" class="button btn btn-primary is-rounded mt-5">Actualizar</button>
            </p>
        </form>
    <?php
    } else {
        include "./inc/error_alert.php";
    }
    $check_usuario = null;
    ?>
</div>
