<p class="has-text-right pt-4 pb-4">
    <a href="#" class="button is-link is-rounded btn-back"><- Regresar atrás</a>
</p>

<script type="text/javascript">
    // Selecciona el elemento con la clase ".btn-back"
    let btn_back = document.querySelector(".btn-back");

    // Añade un evento 'click' al botón de regresar
    btn_back.addEventListener('click', function(e){
        // Evita el comportamiento predeterminado del enlace
        e.preventDefault();
        // Navega hacia atrás en el historial del navegador
        window.history.back();
    });
</script>
