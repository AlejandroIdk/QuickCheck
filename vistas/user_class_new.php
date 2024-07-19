<div class="container is-fluid mb-6">
    <h1 class="title">Clases</h1>
    <h2 class="subtitle">Nueva Clase</h2>
</div>

<div class="container pb-6 pt-6">

    <?php
    require_once "./php/main.php";
    ?>

    <div class="form-rest"></div>

    <form action="./php/usuario_clase_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

        <div class="columns">
            <div class="column">
                <div class="form-group">
                    <label for="usuario_identificacion">Identificación:</label><br>
                    <div class="select">
                        <select class="form-control" name="usuario_identificacion">
                            <option value="" selected>Seleccione una opción</option>
                            <?php
                            $usuarios = conexion()->query("SELECT * FROM usuario");
                            if ($usuarios->rowCount() > 0) {
                                $usuarios = $usuarios->fetchAll();
                                foreach ($usuarios as $usuario) {
                                    echo '<option value="' . $usuario['usuario_identificacion'] . '">' . $usuario['usuario_identificacion'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <label for="clase_nombre">Nombre Clase:</label><br>
                    <div class="select">
                        <select class="form-control" name="clase_nombre">
                            <option value="" selected>Seleccione una opción</option>
                            <?php
                            $clases = conexion()->query("SELECT * FROM clases");
                            if ($clases->rowCount() > 0) {
                                $clases = $clases->fetchAll();
                                foreach ($clases as $clase) {
                                    echo '<option value="' . $clase['clase_nombre'] . '">' . $clase['clase_nombre'] . '</option>';
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
                <input type="hidden" class="form-control" id="generatedCode" name="generated_code">
                <p>Toma una foto con tu código QR.</p>
                <img class="mb-4" src="" id="qrImg" alt="">
            </div>
        </div>

        <p class="has-text-centered mt-2">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>

    </form>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- QR Code Generator Script -->
<script>
    // Esta función genera un código aleatorio de longitud 'length' utilizando caracteres alfanuméricos
    function generateRandomCode(length) {
        // Define los caracteres posibles para el código aleatorio
        const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Inicializa una cadena vacía para almacenar el código generado
        let randomString = '';

        // Itera 'length' veces para generar cada carácter del código
        for (let i = 0; i < length; i++) {
            // Genera un índice aleatorio dentro del rango de la longitud de 'characters'
            const randomIndex = Math.floor(Math.random() * characters.length);
            // Añade el carácter correspondiente al índice aleatorio al código generado
            randomString += characters.charAt(randomIndex);
        }

        // Retorna el código aleatorio generado
        return randomString;
    }

    // Esta función genera un código QR basado en el texto aleatorio generado
    function generateQrCode() {
        // Obtiene la referencia al elemento de imagen donde se mostrará el código QR
        const qrImg = document.getElementById('qrImg');

        // Genera un código aleatorio de longitud 10
        let text = generateRandomCode(10);
        
        // Inserta el texto generado en un campo de formulario con id 'generatedCode'
        $("#generatedCode").val(text);

        // Verifica si el texto generado está vacío
        if (text === "") {
            // Muestra una alerta si no hay texto para generar un código QR
            alert("Por favor, ingresa un texto para generar un código QR.");
            return;
        } else {
            // Construye la URL de la API para generar el código QR con el texto generado
            const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;
            
            // Asigna la URL de la API como fuente de la imagen 'qrImg' para mostrar el código QR
            qrImg.src = apiUrl;
            
            // Muestra el contenedor que contiene la imagen del código QR
            document.querySelector('.qr-con').style.display = '';
        }
    }
</script>