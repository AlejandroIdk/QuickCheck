<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Espera a que el DOM esté completamente cargado

        // Selecciona todos los elementos con la clase '.navbar-burger'
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        if ($navbarBurgers.length > 0) {
            // Verifica si se encontraron elementos con la clase '.navbar-burger'

            // Itera sobre cada elemento encontrado "itera -> uno por uno"
            $navbarBurgers.forEach( el => {
                // Agrega un evento 'click' a cada elemento
                el.addEventListener('click', () => {

                    // Obtiene el valor del atributo 'data-target' del elemento
                    const target = el.dataset.target;
                    
                    // Obtiene el elemento HTML con el ID especificado en 'data-target'
                    const $target = document.getElementById(target);

                    // Alterna la clase 'is-active' en el elemento de la hamburguesa
                    el.classList.toggle('is-active');

                    // Alterna la clase 'is-active' en el elemento de destino (menú desplegable)
                    $target.classList.toggle('is-active');

                });
            });
        }
    });
</script>
<script src="./js/ajax.js"></script>
