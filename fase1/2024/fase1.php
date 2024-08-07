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
      
      .oculto{
        display: none;
      }
        body {
            background-color: rgb(178, 178, 180);
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
            padding: 10px;
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

        .video-responsive {
        height: 0;
        overflow: hidden;
        padding-bottom: 56.25%;
        padding-top: 30px;
        position: relative;
        }
      .video-responsive iframe, .video-responsive object, .video-responsive embed {
        height: 100%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
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
        <div class="container row">
            <div class="col-sm-6">
                <h3>INDUCCIÓN FASE I - UT ITALCO 2024
                    
                </h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <button class="btn btn-warning" id="btnevaluacion" onclick="evaluacion()">Presentar evaluación</button>
                <button class="btn btn-danger" onclick="salir()">X</button>
            </div>
        </div>

    </div>
     
    

    <div class="container mt-2">

    <div class="video-responsive">
    <iframe  src="https://www.youtube.com/embed/sjLX-Uz2H6o?si=agEXmw-DJ6haHQTd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

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
       

var userfase = sessionStorage.getItem('userfase');
var nombres = sessionStorage.getItem('nombres')

var estado = sessionStorage.getItem('estado')

// if(estado=='SI'){
//     $('#btnevaluacion').addClass('oculto')
// }

var numpag = 1;

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

                    location = "home.html";
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

var myCarousel = document.querySelector('#carouselExampleFade')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 60000,
  wrap: false
})

function salir(){
    location = 'home.php'
}

function sumpag(){
    numpag++;
    if(numpag>64){
        numpag=64;
    }
    $('#pag').html('Página: '+numpag+'/64')
}

function restpag(){
    numpag--;
    if(numpag<1){
        numpag=1;
    }
    $('#pag').html('Página: '+numpag+'/64')
}

function evaluacion(){
    location = 'evaluacion.php'
}

    </script>
</body>

</html>