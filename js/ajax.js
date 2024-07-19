// Seleccionar todos los formularios con la clase "FormularioAjax"
const formularios_ajax = document.querySelectorAll(".FormularioAjax");

// Función para manejar el envío del formulario
function enviar_formulario_ajax(e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del formulario (envío tradicional)

    // Confirmar si el usuario quiere enviar el formulario
    let enviar = confirm("¿Quieres enviar el formulario?");

    if (enviar) { // Si el usuario confirma el envío del formulario

        // Obtener los datos del formulario
        let data = new FormData(this); // 'this' se refiere al formulario actual
        let method = this.getAttribute("method"); // Método HTTP (GET o POST)
        let action = this.getAttribute("action"); // URL a la que se enviarán los datos del formulario

        // Configuración para la solicitud Fetch
        let config = {
            method: method,
            body: data // Datos del formulario a enviar
        };

        // Realizar la solicitud Fetch
        fetch(action, config)
        .then(respuesta => respuesta.text()) // Convertir la respuesta a texto
        .then(respuesta => { 
            // Manipular la respuesta recibida

            // Encontrar el contenedor donde se mostrará la respuesta
            let contenedor = document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta; // Insertar la respuesta en el contenedor
        });
    }
}

// Agregar el evento de envío del formulario a cada formulario encontrado
formularios_ajax.forEach(formulario => {
    formulario.addEventListener("submit", enviar_formulario_ajax);
});

// confirmacion de enviar formulario pero tiene que ser con sweetalert, dejar las funciones para su correcto funcionamienro solo editar el ¿quieres editar el formulario? por una alerta de sweetalert, todos los formularios estan asi con la clase formualrio_ajax