<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Inducción Fase I - UT Italco</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">


    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial Narrow', Arial, sans-serif;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .cab {
            margin: 0 auto;

            background-color: rgb(17, 79, 138);
            padding: 30px;
            padding-left: 150px;
            padding-right: 150px;
            color: white;

        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>

    <div class="cab">
        <div class="row">
            <div class="col-sm-6">
                <h3>INDUCCIÓN FASE I - UT ITALCO 2024

                </h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <img src="img/logo_m.png" width="150px" alt="">
            </div>
        </div>

    </div>

    <div class="container mt-4" style="width: 70%;">
        <div class="row">
            <div class="col-sm-7">
                <div class="mb-3">
                    <img src="img/0001.jpg" width="100%" alt="">
                </div>
                <p style="text-align: justify;">
                    El proceso de inducción de la Unión Temporal lTALCO, busca orientar al nuevo trabajador en la
                    cultura organizacional, el cumplimiento del Reglamento Interno de Trabajo y al finalizar estará en
                    la capacidad de identificar los peligros laborales y aspectos ambientales asociados a las
                    actividades de Mantenimiento de Paradas de planta y en Operación de las Unidades de la Refinería, de
                    acuerdo a las condiciones operativas y matriz de Identificación Peligros y valoración de Riesgos.

                </p>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        Iniciar sesión
                    </div>
                    <div class="card-body">
                        <input type="number" id="doc" class="form-control mb-2" placeholder="Usuario">
                        <input type="password" id="clave" class="form-control mb-2" placeholder="Contraseña">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6" style="text-align: right;">
                                <button class="btn btn-success" onclick="login()">Iniciar sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var url = "https://utitalco.com/fase1/2024/server/";

function login() {
    var doc = $("#doc").val();
    var clave = $("#clave").val();

    if (doc && clave != "") {
        if(doc == clave){
            $.post(
                url + "ingreso.php", {
                    doc: doc,
                    clave: clave,
                },
                function (resp) {
                    if (resp.msn == "Ok") {
                        localStorage.setItem('datosuser',JSON.stringify(resp))
                        sessionStorage.setItem("userfase", doc);
                        sessionStorage.setItem("nombres", resp.nombres);
                        sessionStorage.setItem('estado',resp.estado)
                        location = "home.php";
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Oops...",
                            text: "Acceso denegado...!",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                }
            );

        }else{
            Swal.fire({
                position: "top-end",
                icon: "info",
                title: "Oops...",
                text: "Error en usuario o contraseña...!",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    } else {
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Oops...",
            text: "Ingrese su usuario y contraseña...!",
            showConfirmButton: false,
            timer: 1500,
        });
    }
}
    </script>
    
</body>

</html>