// -----------------------------SOLO LETRAS TILDES Y Ñ, EN MAYUCULA---------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
    // Función para permitir solo letras y caracteres especiales tildes y ñ
    function letras(elemento) {
        let valor = elemento.value;

        // Filtra solo los caracteres permitidos usando una expresión regular
        valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/g, '');

        // Convertir el valor filtrado a mayúsculas
        elemento.value = valor.toUpperCase();
    }

    // campos específicos
    let nombreInputUsuario = document.getElementById("usuario_nombre");
    let apellidoInputUsuario = document.getElementById("usuario_apellido");
    let claseNombreInput = document.getElementById("clase_nombre");


    // permitir solo letras y caracteres especiales a los campos
    if (nombreInputUsuario) {
        nombreInputUsuario.addEventListener("input", function () {
            letras(nombreInputUsuario);
        });
    }

    if (apellidoInputUsuario) {
        apellidoInputUsuario.addEventListener("input", function () {
            letras(apellidoInputUsuario);
        });
    }

    if (claseNombreInput) {
        claseNombreInput.addEventListener("input", function () {
            letras(claseNombreInput);
        });
    }

});

// -----------------------------SOLO NÚMEROS-----------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
    // Función para permitir solo números
    function Num(elemento) {
        let valor = elemento.value;
        // Eliminar caracteres que no sean números utilizando una expresión regular
        elemento.value = valor.replace(/[^\d]/g, '');
    }

    // campos específicos
    let usuarioIdentificacionInput = document.getElementById("usuario_identificacion");
    let codigoInput = document.getElementById("codigo");

    // permitir solo números a los campos
    if (usuarioIdentificacionInput) {
        usuarioIdentificacionInput.addEventListener("input", function () {
            Num(usuarioIdentificacionInput);
        });
    }

    if (codigoInput) {
        codigoInput.addEventListener("input", function () {
            Num(codigoInput);
        });
    }

});


// -----------------------------LETRAS, NÚMEROS Y CARACTERES ESPECIALES EN MAYUCULA-------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencias a los campos de nombre y apellido
    let rolNombreInput = document.getElementById("rol_nombre");
    let claseUbicacionInput = document.getElementById("clase_ubicacion");

    // Función para convertir a mayúsculas
    function letrasNumeros(elemento) {
        let valor = elemento.value;
        elemento.value = valor.toUpperCase();
    }

    // convertir a mayúsculas a los campos
    if (rolNombreInput) {
        rolNombreInput.addEventListener("input", function () {
            letrasNumeros(rolNombreInput);
        });
    }

    if (claseUbicacionInput) {
        claseUbicacionInput.addEventListener("input", function () {
            letrasNumeros(claseUbicacionInput);
        });
    }
});
