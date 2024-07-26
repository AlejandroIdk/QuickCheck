<?php
require_once "./php/main.php";

$id = (isset($_GET['userclass_id_up'])) ? $_GET['userclass_id_up'] : 0;
$id = limpiar_cadena($id);

?>
<main id="main" class="main">
    <div class="pagetitle justify-content-center">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_new">Crear Clase</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_list">Lista de Clases</a></li>
                <li class="breadcrumb-item"><a href="index.php?vista=user_class_search">Buscar Usuario</a></li>
            </ol>
        </nav>
    </div>

    <?php
    include "./inc/btn_back.php";
    ?>
    <div class="container pb-6 pt-6">
        <?php
        include "./inc/btn_back.php";

        $check_usuario = conexion()->prepare("SELECT * FROM usuario_clase WHERE userclass_id=:id");
        $check_usuario->execute([':id' => $id]);

        if ($check_usuario->rowCount() > 0) {
            $datos = $check_usuario->fetch();
        ?>

            <div class="form-rest mb-6 mt-6"></div>

            <form action="./php/usuario_clase_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
                <input type="hidden" name="userclass_id" value="<?php echo $datos['userclass_id']; ?>">

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
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-rounded" onclick="generateQrCode()">Generar Código QR</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 qr-con text-center" style="display: none;">
                        <input type="hidden" class="form-control" id="generatedCode" name="generated_code" value="<?php echo $datos['generated_code']; ?>">
                        <p>Toma una foto con tu código QR.</p>
                        <img class="mb-4" src="" id="qrImg" alt="">
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        function generateRandomCode(length) {
            const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            let randomString = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomString += characters.charAt(randomIndex);
            }

            return randomString;
        }

        function generateQrCode() {
            const qrImg = document.getElementById('qrImg');

            let text = generateRandomCode(10);
            $("#generatedCode").val(text);

            if (text === "") {
                alert("Por favor, ingresa un texto para generar un código QR.");
                return;
            } else {
                const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;

                qrImg.src = apiUrl;
                document.querySelector('.qr-con').style.display = '';
            }
        }
    </script>