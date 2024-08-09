<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Inducción Fase I - UT Italco</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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

        .info {
            background-color: rgb(8, 49, 87);

            margin: 0 auto;

            padding: 10px;
            padding-left: 150px;
            padding-right: 150px;
            color: white;
            text-align: right;
        }
        .oculto{
            display: none;   
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
    <div class="info">
        <div class="container">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                     
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item active" href="javascript::void(0)" onclick="salir()">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-4" style="width: 70%;">
        <div class="card">
            <div class="card-header">
                Inducción Fase I UT ITALCO 2024
            </div>
            <div class="card-body">
                <p style="text-align: justify;">
                <img src="img/dibital.jpg" height="200px" hspace="5" vspace="5" style="float: left;" />

                    El proceso de inducción de la Unión Temporal lTALCO, busca orientar al nuevo trabajador en la
                    cultura organizacional, el cumplimiento del Reglamento Interno de Trabajo y al finalizar estará en
                    la capacidad de identificar los peligros laborales y aspectos ambientales asociados a las
                    actividades de Mantenimiento de Paradas de planta y en Operación de las Unidades de la Refinería, de
                    acuerdo a las condiciones operativas y matriz de Identificación Peligros y valoración de Riesgos.

                </p>
                <p>
                    <span class="badge rounded-pill text-bg-info" id="fecha">Última evaluación: 2022-02-01</span>
                    <span class="badge rounded-pill text-bg-primary" id="puntaje">Puntaje 100/90</span>
                </p>
                <a href="javascript::void(0)" class="btn btn-primary" onclick="ver()">VER INDUCCIÓN</a>
                <a href="javascript::void(0)" id="btncertificado" class="btn btn-success" onclick="certificado()">DESCARGAR CERTIFICADO</a>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var url = "https://utitalco.com/calidad/028/vbk/server/";

var userfase = sessionStorage.getItem('userfase');
var nombres = sessionStorage.getItem('nombres')
var estado = sessionStorage.getItem('estado')

var datos=JSON.parse(localStorage.getItem('datosuser'))



if(estado=='NO'){
    $('#btncertificado').addClass('oculto')
    $('#fecha').html('')
    $('#puntaje').html('')
}else{
    
    $('#fecha').html('Última evaluación: '+datos.fecha)
    $('#puntaje').html('Puntaje: '+datos.puntaje + '/100')
}

$('#dropdownMenuButton1').html(nombres)

function login() {
    var doc = $("#doc").val();
    var clave = $("#clave").val();

    if (doc && clave != "") {
        $.post(
            url + "ingreso.php", {
                doc: doc,
                clave: clave,
            },
            function (resp) {
                if (resp.msn == "Ok") {
                    sessionStorage.setItem("userfase", doc);
                    sessionStorage.setItem("nombres", resp.nombres + ' ' + resp.apellidos);

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

function salir(){
    location = 'index.php'
}

function ver(){
    location = 'fase1.php'
}

function certificado(){
    window.open('lib/certificados/certificado.html', '_blank');
}
    </script>

</body>

</html>