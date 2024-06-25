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

    <h2 class="title has-text-centered"><?php echo $datos['usuario_nombre']; ?></h2>

    <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

        <input type="hidden" name="usuario_identificacion" value="<?php echo $datos['usuario_identificacion']; ?>" required>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Rol</label>
                    <input class="input" type="text" name="rol_code" pattern="[0-9]+" maxlength="5" required value="<?php echo $datos['rol_code']; ?>">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Email</label>
                    <input class="input" type="email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombres</label>
                    <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_nombre']; ?>">
                </div>
            </div>

            <div class="column">
                <div class="control">
                    <label>Identificacion</label>
                    <input class="input" type="text" name="usuario_identificacion" pattern="[0-9]{3,10}" maxlength="10" required value="<?php echo $datos['usuario_identificacion']; ?>">
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Clave</label>
                    <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Repetir clave</label>
                    <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>
    <?php 
        } else {
            include "./inc/error_alert.php";
        }
        $check_usuario = null;
    ?>
</div>