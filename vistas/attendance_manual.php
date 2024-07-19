<div class="container-fluid mb-5">
    <h1 class="display-4">Asistencia</h1>
    <h2 class="lead">Nuevo usuario</h2>
</div>

<div class="container pb-6 pt-6">
    <div class="form-rest"></div>

    <form action="./php/asistencia.manual.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="form-group">
                    <label for="usuario_clase">Usuario:</label><br>
                    <div class="select">
                        <select class="form-control" name="usuario_identificacion">
                            <option value="" selected>Seleccione una opción</option>
                            <?php
                            require_once "./php/main.php";
                            $query = "
                            SELECT uc.usuario_identificacion, GROUP_CONCAT(c.clase_id SEPARATOR ', ') as clases_id, GROUP_CONCAT(c.clase_nombre SEPARATOR ', ') as clases_nombre
                            FROM usuario_clase uc
                            INNER JOIN clases c ON uc.clase_id = c.clase_id
                            GROUP BY uc.usuario_identificacion
                            ";
                            $asistencia = conexion()->query($query);
                            if ($asistencia->rowCount() > 0) {
                                $asistencia = $asistencia->fetchAll();
                                foreach ($asistencia as $row) {
                                    echo '<option value="' . $row['usuario_identificacion'] . '" data-clases-id="' . $row['clases_id'] . '" data-clases-nombre="' . htmlspecialchars($row['clases_nombre']) . '">' . $row['usuario_identificacion'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="form-group">
                    <label for="clase_id">ID de la Clase:</label>
                    <select class="form-control" id="clase_id" name="clase_id">
                        <!-- Options will be populated dynamically based on user selection -->
                    </select>
                </div>
            </div>
           
            <div class="col-md-6 mt-3">
                <div class="form-group">
                    <label for="fecha">Fecha asistencia:</label>
                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d\TH:i'); ?>">
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg mt-5">Registrar Asistencia</button>
        </div>
    </form>
</div>

<script>
// Script para autocompletar el campo nombre de la clase y cargar opciones de clase_id
document.addEventListener('DOMContentLoaded', function() {
    const selectUsuario = document.querySelector('select[name="usuario_identificacion"]');
    const selectClaseId = document.querySelector('select[name="clase_id"]');

    selectUsuario.addEventListener('change', function() {
        const selectedOption = selectUsuario.options[selectUsuario.selectedIndex];
        const clasesId = selectedOption.getAttribute('data-clases-id').split(', ');
        const clasesNombre = selectedOption.getAttribute('data-clases-nombre').split(', ');

        // Clear previous options
        selectClaseId.innerHTML = '';

        // Populate selectClaseId with options
        for (let i = 0; i < clasesId.length; i++) {
            const option = document.createElement('option');
            option.value = clasesId[i];
            option.textContent = clasesNombre[i];
            selectClaseId.appendChild(option);
        }

        // Initially set the class name
        inputClaseNombreAutocompletado.value = clasesNombre[0];
    });

    // Handle change in clase_id selection

});
</script>
<!-- pero quita el segundo input de clase_nombre_autocompletado -->