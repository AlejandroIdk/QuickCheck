<body style="background-image: url('./assets/img/404.gif'); background-size: cover; background-position: center;">
    <div class="container d-flex justify-content-center align-items-end vh-100">
        <section class="hero-body text-center">
            <div class="row mb-5">
                <div class="col">
                    <button onclick="goBack()">Regresar Atrás</button>
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


    <style>
        button {
            background-color: black;
            color: white;
            width: 200px;
            font-size: larger;
            height: 50px;
            border: none;
            font-family: fantasy;
            border-radius: 10px;

        }

        button:hover {
            background-color: white;
            color: black;
        }
    </style>