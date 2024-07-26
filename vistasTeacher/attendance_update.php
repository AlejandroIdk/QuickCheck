<main id="main" class="main">

    <?php
    require_once "./php/main.php";

    $id = (isset($_GET['attendance_id_up'])) ? $_GET['attendance_id_up'] : 0;
    $id = limpiar_cadena($id);

    ?>

    <div class="container pb-6 pt-6">
        <?php
        include "./inc/btn_back.php";

        $check_asistencia = conexion()->prepare("SELECT * FROM asistencia WHERE asistencia_id = :id");
        $check_asistencia->execute([':id' => $id]);

        if ($check_asistencia->rowCount() > 0) {
            $datos = $check_asistencia->fetch();
        ?>

            <div class="form-rest mb-6 mt-6"></div>

            <form action="./php/asistencia_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
                <input type="hidden" name="asistencia_id" value="<?php echo $datos['asistencia_id']; ?>">

                <div class="columns">
                    <div class="column">
                        <div class="form-group">
                            <label for="usuario_identificacion">Identificación de Usuario:</label><br>
                            <div class="select mt-3">
                                <select class="form-control" name="usuario_identificacion">
                                    <?php
                                    $usuarios = conexion()->query("SELECT * FROM usuario");
                                    if ($usuarios->rowCount() > 0) {
                                        while ($usuario = $usuarios->fetch()) {
                                            $selected = ($usuario['usuario_identificacion'] == $datos['usuario_identificacion']) ? 'selected' : '';
                                            echo '<option value="' . $usuario['usuario_identificacion'] . '" ' . $selected . '>' . $usuario['usuario_identificacion'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-group">
                            <label for="clase_id">Nombre de la Clase:</label><br>
                            <div class="select mt-3">
                                <select class="form-control" name="clase_id">
                                    <?php
                                    $clases = conexion()->query("SELECT * FROM clases");
                                    if ($clases->rowCount() > 0) {
                                        while ($clase = $clases->fetch()) {
                                            $selected = ($clase['clase_id'] == $datos['clase_id']) ? 'selected' : '';
                                            echo '<option value="' . $clase['clase_id'] . '" ' . $selected . '>' . $clase['clase_nombre'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-group">
                            <label for="fecha">Fecha de Asistencia:</label><br>
                            <input class="form-control mt-3" type="datetime" name="fecha" value="<?php echo $datos['fecha']; ?>" required>
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
        ?>
    </div>