// -----------------------------SOLO LETRAS TILDES Y Ñ, EN MAYUCULA---------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function() {
    // Función para permitir solo letras y caracteres especiales (tildes y ñ)
    function letrasNumeros(elemento) {
        let valor = elemento.value;

        // Filtrar solo los caracteres permitidos usando una expresión regular
        valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/g, '');

        // Convertir el valor filtrado a mayúsculas
        elemento.value = valor.toUpperCase();
    }

    // Obtener referencias a los campos específicos
    let nombreInputUsuario = document.getElementById("usuario_nombre");
    let apellidoInputUsuario = document.getElementById("usuario_apellido");
    let claseNombreInput = document.getElementById("clase_nombre");


    // Agregar evento 'input' para permitir solo letras y caracteres especiales al campo de nombre del usuario
    if (nombreInputUsuario) {
        nombreInputUsuario.addEventListener("input", function() {
            letrasNumeros(nombreInputUsuario);
        });
    }

    if (apellidoInputUsuario) {
        apellidoInputUsuario.addEventListener("input", function() {
            letrasNumeros(apellidoInputUsuario);
        });
    }

    if (claseNombreInput) {
        claseNombreInput.addEventListener("input", function() {
            letrasNumeros(claseNombreInput);
        });
    }

});

// -----------------------------SOLO NÚMEROS-----------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function() {
    // Función para permitir solo números
    function permitirSoloNumeros(elemento) {
        let valor = elemento.value;
        // Eliminar caracteres que no sean números utilizando una expresión regular
        elemento.value = valor.replace(/[^\d]/g, '');
    }

    // Obtener referencias a los campos específicos
    let usuarioIdentificacionInput = document.getElementById("usuario_identificacion");
    let codigoInput = document.getElementById("codigo");

    // Agregar evento 'input' para permitir solo números al campo de identificación de usuario
    if (usuarioIdentificacionInput) {
        usuarioIdentificacionInput.addEventListener("input", function() {
            permitirSoloNumeros(usuarioIdentificacionInput);
        });
    }

    if (codigoInput) {
        codigoInput.addEventListener("input", function () {
            permitirSoloNumeros(codigoInput);
        });
    }

    // Puedes añadir más campos aquí según sea necesario
});


// -----------------------------LETRAS, NÚMEROS Y CARACTERES ESPECIALES EN MAYUCULA-------------------------------------------------

document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencias a los campos de nombre y apellido
    let rolNombreInput = document.getElementById("rol_nombre");
    let claseUbicacionInput = document.getElementById("clase_ubicacion");

    // Función para convertir a mayúsculas
    function letrasNumeros(elemento) {
        let valor = elemento.value;
        elemento.value = valor.toUpperCase();
    }

    // Agregar evento 'input' para convertir a mayúsculas al campo de nombre
    if (rolNombreInput) {
        rolNombreInput.addEventListener("input", function() {
            letrasNumeros(rolNombreInput);
        });
    }

    if (claseUbicacionInput) {
        claseUbicacionInput.addEventListener("input", function() {
            letrasNumeros(claseUbicacionInput);
        });
    }
});
