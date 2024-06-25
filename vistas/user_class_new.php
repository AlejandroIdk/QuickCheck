<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases - QR Code Attendance System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>
<body>

    <div class="container is-fluid mb-6">
        <h1 class="title">Clases</h1>
        <h2 class="subtitle">Nueva Clase</h2>
    </div>

    <div class="container pb-6 pt-6">

        <?php
            require_once "./php/main.php";
        ?>

        <div class="form-rest mb-6 mt-6"></div>

        <form action="./php/usuario_clase_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

            <div class="columns">
                <div class="column">
                    <div class="form-group">
                        <label for="usuario_identificacion">Identificación</label>
                        <div class="select">
                            <select class="form-control" name="usuario_identificacion">
                                <option value="" selected>Seleccione una opción</option>
                                <?php
                                    $usuarios = conexion()->query("SELECT * FROM usuario");
                                    if($usuarios->rowCount() > 0){
                                        $usuarios = $usuarios->fetchAll();
                                        foreach($usuarios as $usuario){
                                            echo '<option value="'.$usuario['usuario_identificacion'].'">'.$usuario['usuario_identificacion'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="form-group">
                        <label for="clase_nombre">Nombre de la Clase</label>
                        <div class="select">
                            <select class="form-control" name="clase_nombre">
                                <option value="" selected>Seleccione una opción</option>
                                <?php
                                    $clases = conexion()->query("SELECT * FROM clases");
                                    if($clases->rowCount() > 0){
                                        $clases = $clases->fetchAll();
                                        foreach($clases as $clase){
                                            echo '<option value="'.$clase['clase_nombre'].'">'.$clase['clase_nombre'].'</option>';
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

            <!-- QR Code Display -->
            <div class="row">
                <div class="col-md-12 qr-con text-center" style="display: none;">
                    <input type="hidden" class="form-control" id="generatedCode" name="generated_code">
                    <p>Toma una foto con tu código QR.</p>
                    <img class="mb-4" src="" id="qrImg" alt="">
                </div>
            </div>

            <p class="has-text-centered">
                <button type="submit" class="button is-info is-rounded">Guardar</button>
            </p>

        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- QR Code Generator Script -->
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

</body>
</html>