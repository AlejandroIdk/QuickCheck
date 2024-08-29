<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regresar o Crear Clase</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <p class="has-text-right pt-4 pb-4">
            <a href="index.php?vista=class_new" class="button is-link is-rounded btn-create">Crear Nueva Clase</a>
        </p>
    </div>

    <script type="text/javascript">
        // Selecciona el elemento con la clase ".btn-create"
        let btn_create = document.querySelector(".btn-create");

        // Añade un evento 'click' al botón de crear
        btn_create.addEventListener('click', function(e) {
            // Navega a la página para crear una nueva clase
            window.location.href = 'index.php?vista=class_new';
        });
    </script>
</body>
</html>
        