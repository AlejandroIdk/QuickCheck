<body style="background-image: url('./assets/img/error.jpg'); background-size: cover; background-position: center;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <section class="hero-body text-center">
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" onclick="goBack()">Regresar Atrás</button>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
